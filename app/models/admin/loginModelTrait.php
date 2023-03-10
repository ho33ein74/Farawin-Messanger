<?php
trait loginModelTrait
{
    function Login($form)
    {
        try {
            $username = $this->Check_Param($form['username']);
            if(!function_exists('password_verify')) {
                $this->response_error("password_hash not supported, Upgrade PHP version");
            } else {
                $password = $this->Check_Param($form['password']);
                if (!empty($username) and !empty($password)) {
                    $result = $this->doSelect("SELECT * FROM tbl_admin WHERE a_username=?  AND a_status=1", array($username));

                    if (sizeof($result) > 0) {
                        if (password_verify($password, $result[0]['a_password'])) {
                            if ($result[0]['google_auth_status'] == 0) {
                                $this->cookieInit();
                                $this->cookieSet('adminId', $this->Encrypt($result[0]['a_id'], KEY), $this->getPublicInfo('cookie_duration'));
                                $this->ActivityLog("ورود به پنل مدیریت", $result[0]['a_id']);
                                $this->response_success(".باموفقیت وارد شدید :)");
                            } else {
                                $this->response_success("برای ورود می بایست کد تایید گوگل را وارد نمایید", "auth");
                            }
                        } else {
                            $this->response_error(".اطلاعات وارد شده صحیح نمی باشد");
                        }
                    } else {
                        $this->response_error("کاربری با این مشخصات یافت نشد!");
                    }
                } else {
                    $this->response_error(".اطلاعات وارد شده صحیح نمی باشد");
                }
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function logout()
    {
        unset($_COOKIE['adminId']);
        setcookie('adminId', null, -1, '/');
    }

    function authCheck($form)
    {
        try {
            $username = $this->Check_Param($form['username']);
            $result = $this->doSelect("SELECT * FROM tbl_admin WHERE a_username=? AND a_status=1", array($username));

            if (sizeof($result) > 0 and !empty($username)) {
                $pga = new PHPGangsta_GoogleAuthenticator();
                if ($pga->verifyCode($result[0]['google_secret_code'], $form['code'], 2)) {
                    $this->cookieInit();
                    $this->cookieSet('adminId', $this->Encrypt($result[0]['a_id'], KEY), $this->getPublicInfo('cookie_duration'));
                    $this->ActivityLog("ورود به پنل مدیریت", $result[0]['a_id']);

                    $this->response_success(".باموفقیت وارد شدید :)");
                } else {
                    $this->response_error("کد وارد شده صحیح نمی باشد");
                }
            } else {
                $this->response_error("نام کاربری وارد شده یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function forgetPasswordSendSMS($form)
    {
        try {
            $username = $this->Check_Param($form['username']);

            $result = $this->doSelect("SELECT * FROM tbl_admin WHERE a_username=? AND a_status=1", array($username), 1);

            if (sizeof($result) > 0 and !empty($username)) {
                $digits = 8;
                $code = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
                $password = password_hash($code, PASSWORD_DEFAULT);

                $sql = "UPDATE tbl_admin SET a_password=? WHERE a_id=?";
                $params = array($password, $result['a_id']);
                $this->doQuery($sql, $params);

                if($this->getPublicInfo('sms_site') == "faraz") {
                    $input_data = array(
                        "VerificationCode" => $code
                    );
                } else {
                    if($this->getPublicInfo('sms_secret_key') !="") {
                        $input_data = array(
                            array(
                                "Parameter" => "VerificationCode",
                                "ParameterValue" => $code,
                            )
                        );
                    } else {
                        $input_data = array(
                            array(
                                "name" => "VerificationCode",
                                "value" => $code,
                            )
                        );
                    }
                }
                $this->sendSMS($this->getPublicInfo('sms_template_for_forget_password_admin'), $result['a_username'], $input_data);

                $this->response_success(".رمز عبور جدید به شماره ".$username." ارسال شد");
            } else {
                $this->response_error("اطلاعات وارد شده صحیح نمی باشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function googleAuthentication($post, $id)
    {
        try {
            $pga = new PHPGangsta_GoogleAuthenticator();
            $result = $this->doSelect( "SELECT google_secret_code FROM tbl_admin WHERE a_id=?", array($id), 1);

            if($pga->verifyCode($result['google_secret_code'], $post['code'], 2)) {
                $this->doQuery("UPDATE tbl_admin SET google_auth_status=1 WHERE a_id=?", array($id));

                $this->ActivityLog("فعالسازی ورود 2 مرحله ای گوگل");
                $this->response_success("ورود 2 مرحله ای گوگل باموفقیت فعال شد");
            } else {
                $this->response_error("کد وارد شده صحیح نمی باشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function googleAuthenticationDeactive($id)
    {
        try {
            $sql = "UPDATE tbl_admin SET google_auth_status=(case when google_auth_status=1 then 0 else 1 end) WHERE a_id=?";
            $this->doQuery($sql, array($id));

            $this->ActivityLog("غیرفعالسازی ورود 2 مرحله ای گوگل");
            $this->response_success("ورود 2 مرحله ای گوگل باموفقیت غیرفعال شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}
