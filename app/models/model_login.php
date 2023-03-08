<?php

class model_login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function mobileLogin($form)
    {
        try {
            $mobile = self::Check_Param($form['phone']);

            if(
                (self::Validate_mobile($mobile) and preg_match("/^09[0-9]{9}$/", $mobile)) or
                (ENAMAD_USER_ACTIVE == 1 and $mobile == ENAMAD_USERNAME)
            ){
                if($mobile != ENAMAD_USERNAME) {
                    $result = $this->doSelect("SELECT * FROM tbl_customer WHERE `c_mobile_num`=?", array($mobile));
                    $digits = 4;
                    $active_code = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);

                    if (sizeof($result) > 0 and !empty($mobile)) {
                        $sql = "UPDATE tbl_customer SET c_verification_code=? WHERE c_mobile_num=?";
                        $params = [$active_code, $mobile];
                        $this->doQuery($sql, $params);

                        $result[0]['c_status'] == "0" ? $status = "new" : $status = "old";
                    } else {
                        $url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($mobile))) . "?d=identicon&s=50&r=x";

                        $vids = $this->getLastId("customer");

                        $sql = "INSERT INTO tbl_customer (customer_vids_id,c_display_name,c_mobile_num,c_image,c_registery_date,c_verification_code,c_status) VALUES (?,?,?,?,?,?,?)";
                        $params = array($vids, "کاربر " . rand(100, 999) . time() . $vids . rand(10, 99), $mobile, $url, self::jaliliDate(), $active_code, 0);
                        $res = $this->doQuery($sql, $params);
                        $id = Model::$conn->lastInsertId();

                        $this->updateLastId("customer");
                        $status = "new";
                    }

                    if ($id != "" or $status == "old" or $status == "new") {
                        if ($this->getPublicInfo('sms_site') == "faraz") {
                            $input_data = array(
                                "VerificationCode" => $active_code
                            );
                        } else {
                            if ($this->getPublicInfo('sms_secret_key') != "") {
                                $input_data = array(
                                    array(
                                        "Parameter" => "VerificationCode",
                                        "ParameterValue" => $active_code,
                                    )
                                );
                            } else {
                                $input_data = array(
                                    array(
                                        "name" => "VerificationCode",
                                        "value" => $active_code,
                                    )
                                );
                            }
                        }
                        $this->sendSMS($this->getPublicInfo('sms_template_login'), $mobile, $input_data);
                    }
                } else {
                    $status = "old";
                }

                Model::sessionSet('mobile_for_verify', $mobile);
                $data = array(
                    "type" => $status
                );
                $this->response_success("", "ok", "", $data);
            } else {
                $this->response_warning("شماره موبایل وارد شده معتبر نمی باشد", "Invalid");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function verifyMobileLogin($form)
    {
        $mobile = Model::sessionGet('mobile_for_verify');
        $code = self::Check_Param($form['code']);
        if(ENAMAD_USER_ACTIVE == 1 and $mobile == ENAMAD_USERNAME) {
            if ($code == ENAMAD_PASSWORD) {
                Model::cookieSet('userId', Model::Encrypt(1000, KEY), 1);
                unset($_SESSION['mobile_for_verify']);

                $this->response_success("باموفقیت وارد سایت شدید.");
            } else {
                $this->response_error("رمز ورود یکبار مصرف صحیح نمی باشد.");
            }
        } else {
            $params = array($code, $mobile);
            $result = $this->doSelect("SELECT * FROM tbl_customer WHERE `c_verification_code`=? AND `c_mobile_num`=?", $params);

            if (sizeof($result) > 0 and !empty($code)) {
                Model::cookieSet('userId', Model::Encrypt($result[0]['customer_vids_id'], KEY), $this->getPublicInfo('cookie_duration'));

                $sql = "UPDATE tbl_customer SET c_verification_code=? WHERE customer_vids_id=?";
                $this->doQuery($sql, array(NULL, $result[0]['customer_vids_id']));
                unset($_SESSION['mobile_for_verify']);

                $this->response_success("باموفقیت وارد سایت شدید.");
            } else {
                $this->response_error("رمز ورود یکبار مصرف صحیح نمی باشد.");
            }
        }
    }

    function resendCode()
    {
        $mobile = Model::sessionGet('mobile_for_verify');
        $result = $this->doSelect("SELECT * FROM tbl_customer WHERE `c_mobile_num`=?", array($mobile), 1);

        if (sizeof($result) > 0 and !empty($mobile)) {
            try {
                if($this->getPublicInfo('sms_site') == "faraz") {
                    $input_data = array(
                        "VerificationCode" => $result['c_verification_code']
                    );
                } else {
                    if($this->getPublicInfo('sms_secret_key') !="") {
                        $input_data = array(
                            array(
                                "Parameter" => "VerificationCode",
                                "ParameterValue" => $result['c_verification_code'],
                            )
                        );
                    } else {
                        $input_data = array(
                            array(
                                "name" => "VerificationCode",
                                "value" => $result['c_verification_code'],
                            )
                        );
                    }
                }
                $this->sendSMS($this->getPublicInfo('sms_template_login'), $mobile, $input_data);

                echo "ok";
            } catch (Exeption $e) {
                echo "error";
            }
        } else {
            echo "mobile not found";
        }
    }
}
?>