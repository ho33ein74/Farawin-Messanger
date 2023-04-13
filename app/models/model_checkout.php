<?php

class model_checkout extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function paymentChekout($userId, $data)
    {
        $orderInfo = null;
        if (isset($data['Authority'])) {
            $sql = "SELECT sre.*,s.s_title FROM tbl_services_reservation sre
                        LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                        WHERE sre.beforepay=?";
            $orderInfo = $this->doSelect($sql, array($data['Authority']));
        } else if (isset($data['reservation_tracking'])) {
            $sql = "SELECT sre.*,s.s_title FROM tbl_services_reservation sre 
                        LEFT JOIN tbl_services s ON sre.service_id=s.s_id 
                    WHERE sre.order_service_vids_id=? AND sre.user_id=? AND sre.sre_status=0";
            $orderInfo = $this->doSelect($sql, array($data['reservation_tracking'], $userId));
        }

        if (sizeof($orderInfo) > 0) {
            if ($orderInfo[0]['payment_method_id'] == 2 and $orderInfo[0]['sre_price_prepayment'] > 0) {
                $zp = new zarinpal();
                $payType = $this->getPayType($orderInfo[0]['payment_method_id']);
                $pay_result = $zp->verify($payType['pay_merchant'], $orderInfo[0]['sre_price_prepayment'], $payType['test_status'], false);

                if (isset($pay_result["Status"]) && $pay_result["Status"] == 100) {
                    $sql = "update tbl_services_reservation set sre_pay=1, sre_date_payment=?, sre_time_payment=?, sre_status=1,afterpay=?,sre_price_payment=? where beforepay=?";
                    $this->doQuery($sql, array(self::jalali_date(), self::jalali_date("H:i:s"), $pay_result["RefID"], $orderInfo[0]['sre_price_prepayment'], $pay_result["Authority"]));

                    $sql = "SELECT sre.*,pm.pay_title,s.s_title,b.b_name,u.c_display_name,u.c_mobile_num,ss.name,r.title
                                FROM tbl_services_reservation sre 
                                LEFT JOIN tbl_payment_methods pm ON sre.payment_method_id=pm.pay_id
                                LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                                LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                                LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                                LEFT JOIN tbl_services_staff ss ON sre.staff_id=ss.staff_vids_id
                                LEFT JOIN tbl_status r ON sre.sre_status=r.id
                                WHERE sre.beforepay=?";
                    $reservation = $this->doSelect($sql, array($data['Authority']), 1);

                    $channel = $this->getPublicInfo('channel_service_reservation');
                    if ($channel != "") {
                        $caption = "🔹 شماره پیگیری: " . $reservation['order_service_vids_id'] . "\n\n" .
                            "🔹 زمان ثبت : " . $reservation['sre_time_create'] . " - " . $reservation['sre_date_create'] . "\n\n" .
                            "🔹 نام مشتری: " . $reservation['c_display_name'] . "\n\n" .
                            "🔹 شماره تماس: " . $reservation['c_mobile_num'] . "\n\n" .
                            "🔹 شعبه: " . $reservation['b_name'] . "\n\n" .
                            "🔹 پرسنل: " . $reservation['name'] . "\n\n" .
                            "🔹 خدمت: " . $reservation['s_title'] . "\n\n" .
                            "🔹 زمان رزرو شده: " . $reservation['sre_day'] . " " . $reservation['sre_date'] . " ساعت " . $reservation['sre_time'] . "\n\n" .
                            "🔹 هزینه خدمت: " . number_format($reservation['sre_price_total']) . " تومان\n\n" .
                            "🔹 بیعانه : " . number_format($reservation['sre_price_prepayment']) . " تومان\n\n" .
                            "🔹 مبلغ پرداختی: " . number_format($reservation['sre_price_payment']) . " تومان\n\n" .
                            "🔹 نحوه پرداخت : " . $reservation['pay_title'];
                        Model::telegram_send_message($caption, $channel);
                    }

                    $sql = "SELECT * FROM tbl_payment_log WHERE order_vids_id=? AND beforepay=? AND afterpay=?";
                    $params = array($reservation['order_service_vids_id'], $pay_result["Authority"], $pay_result["RefID"]);
                    $result = $this->doSelect($sql, $params);

                    if (sizeof($result) == 0) {
                        $vids_pay = $this->getLastId("payment");

                        $payInfo = $this->doSelect("SELECT * FROM tbl_payment_methods WHERE pay_id=?", array($reservation['payment_method_id']), 1);

                        $sql = "INSERT INTO tbl_payment_log (payment_vids_id,order_vids_id,user_ip,part,price,beforepay,afterpay,time_payment,date_payment,`type`,pay_to,status,date_created) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                        $params = array($vids_pay, $reservation['order_service_vids_id'], $data['user_ip'], 1, $reservation['sre_price_prepayment'], $pay_result["Authority"], $pay_result["RefID"], time(), self::jalali_date("Y/m/d"), $payInfo['pay_type'], $payInfo['pay_to'], 1, self::jalali_date("Y/m/d"));
                        $this->doQuery($sql, $params);
                        $this->updateLastId("payment");;

                        $caption = "🔹 شماره پیگیری: " . $reservation['order_service_vids_id'] . "\n\n" .
                            "🔹 مبلغ پرداختی " . number_format($reservation['sre_price_prepayment']) . " تومان\n\n" .
                            "🔹 تاریخ: " . $this->jalali_date();
                        "🔹 ساعت: " . $this->jalali_date("H:i:s");

                        $channel = $this->getPublicInfo('channel_payment');
                        if ($channel != "") {
                            Model::telegram_send_message($caption, $channel);
                        }
                    }

                    $sql = "update tbl_discounts_user_used set du_status=1 where order_id=? AND du_status=0";
                    $params = array($reservation['order_service_vids_id']);
                    $this->doQuery($sql, $params);

                    $this->sendConfirmSMS($reservation['order_service_vids_id']);

                    return $reservation;
                } else {
                    return "error-" . $pay_result["Message"];
                }
            } else {
                if ($orderInfo[0]['sre_status'] == "0") {
                    $sql = "update tbl_services_reservation set sre_pay=0, sre_status=1 where order_service_vids_id=? AND user_id=?";
                    $this->doQuery($sql, array($data['reservation_tracking'], $userId));

                    $this->sendConfirmSMS($data['reservation_tracking']);

                    $sql = "SELECT sre.*,pm.pay_title,s.s_title,b.b_name,u.c_display_name,u.c_mobile_num,ss.name,r.title
                                FROM tbl_services_reservation sre 
                                LEFT JOIN tbl_payment_methods pm ON sre.payment_method_id=pm.pay_id
                                LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                                LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                                LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                                LEFT JOIN tbl_services_staff ss ON sre.staff_id=ss.staff_vids_id
                                LEFT JOIN tbl_status r ON sre.sre_status=r.id
                                WHERE sre.order_service_vids_id=?";
                    $reservation = $this->doSelect($sql, array($data['reservation_tracking']), 1);

                    $channel = $this->getPublicInfo('channel_service_reservation');
                    if ($channel != "") {
                        $caption = "🔹 شماره پیگیری: " . $reservation['order_service_vids_id'] . "\n\n" .
                            "🔹 زمان ثبت : " . $reservation['sre_time_create'] . " - " . $reservation['sre_date_create'] . "\n\n" .
                            "🔹 نام مشتری: " . $reservation['c_display_name'] . "\n\n" .
                            "🔹 شماره تماس: " . $reservation['c_mobile_num'] . "\n\n" .
                            "🔹 شعبه: " . $reservation['b_name'] . "\n\n" .
                            "🔹 پرسنل: " . $reservation['name'] . "\n\n" .
                            "🔹 خدمت: " . $reservation['s_title'] . "\n\n" .
                            "🔹 زمان رزرو شده: " . $reservation['sre_day'] . " " . $reservation['sre_date'] . " ساعت " . $reservation['sre_time'] . "\n\n" .
                            "🔹 هزینه خدمت: " . number_format($reservation['sre_price_total']) . " تومان\n\n" .
                            "🔹 بیعانه : " . number_format($reservation['sre_price_prepayment']) . " تومان\n\n" .
                            "🔹 مبلغ پرداختی: " . number_format($reservation['sre_price_payment']) . " تومان\n\n" .
                            "🔹 نحوه پرداخت : " . $reservation['pay_title'];
                        Model::telegram_send_message($caption, $channel);
                    }

                    return $reservation;
                } else {
                    return "error-" . "درخواست مورد نظر قبلا ثبت شده است.";
                }
            }
        } else {
            return "error-" . "درخواست مورد نظر یافت نشد.";
        }
    }

    function sendConfirmSMS($id)
    {
        $result = $this->doSelect("SELECT * FROM tbl_status WHERE id=?", array(1), 1);

        if ($result['code'] != "") {
            $sqlMobile = "SELECT sre.sre_day,sre.sre_date,sre.sre_time,sre.sre_vip,sre.sre_price_payment,
                                                 sre.order_service_vids_id,u.c_mobile_num,u.c_display_name,s.s_title,
                                                 u.c_name,u.c_family
                                       FROM tbl_services_reservation sre
                                       LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                                       LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                                       WHERE sre.order_service_vids_id=?";
            $resultMobile = $this->doSelect($sqlMobile, array($id), 1);
            $vip = '';
            if ($resultMobile['sre_vip'] == 1) {
                $vip = " ویژه";
            }
            $serviceText = $resultMobile['s_title'] . $vip;
            $dateText = $resultMobile['sre_day'] . " " . $resultMobile['sre_date'] . " ساعت " . $resultMobile['sre_time'];
            $priceText = number_format($resultMobile['sre_price_payment']);
            $business_name = $this->getPublicInfo('site_short_name');

            $text_sms = str_replace(
                ["[SERVICE]", "[DATE]", "[PRICE]", "[RCODE]", "[BNAME]", "[CFNAME]", "[CLNAME]"],
                [$serviceText, $dateText, $priceText, $resultMobile['order_service_vids_id'], $business_name, $resultMobile['c_name'], $resultMobile['c_family']],
                $result['text']
            );

            $input_data = array();
            if ($this->getPublicInfo('sms_site') == "faraz") {
                if (strpos($result['text'], '[SERVICE]') !== false) {
                    $input_data['SERVICE'] = $serviceText;
                }
                if (strpos($result['text'], '[DATE]') !== false) {
                    $input_data['DATE'] = $dateText;
                }
                if (strpos($result['text'], '[PRICE]') !== false) {
                    $input_data['PRICE'] = $priceText;
                }
                if (strpos($result['text'], '[RCODE]') !== false) {
                    $input_data['RCODE'] = $resultMobile['order_service_vids_id'];
                }
                if (strpos($result['text'], '[BNAME]') !== false) {
                    $input_data['BNAME'] = $business_name;
                }
                if (strpos($result['text'], '[CFNAME]') !== false) {
                    $input_data['CFNAME'] = $resultMobile['c_name'];
                }
                if (strpos($result['text'], '[CLNAME]') !== false) {
                    $input_data['CLNAME'] = $resultMobile['c_family'];
                }
            } else {
                $i = 0;
                if ($this->getPublicInfo('sms_secret_key') != "") {
                    $key_name = "Parameter";
                    $value_name = "ParameterValue";
                } else {
                    $key_name = "name";
                    $value_name = "value";
                }

                if (strpos($result['text'], '[SERVICE]') !== false) {
                    $input_data[$i][$key_name] = "SERVICE";
                    $input_data[$i][$value_name] = $serviceText;
                    $i++;
                }
                if (strpos($result['text'], '[DATE]') !== false) {
                    $input_data[$i][$key_name] = "DATE";
                    $input_data[$i][$value_name] = $dateText;
                    $i++;
                }
                if (strpos($result['text'], '[PRICE]') !== false) {
                    $input_data[$i][$key_name] = "PRICE";
                    $input_data[$i][$value_name] = $priceText;
                    $i++;
                }
                if (strpos($result['text'], '[RCODE]') !== false) {
                    $input_data[$i][$key_name] = "RCODE";
                    $input_data[$i][$value_name] = $resultMobile['order_service_vids_id'];
                    $i++;
                }
                if (strpos($result['text'], '[BNAME]') !== false) {
                    $input_data[$i][$key_name] = "BNAME";
                    $input_data[$i][$value_name] = $business_name;
                    $i++;
                }
                if (strpos($result['text'], '[CFNAME]') !== false) {
                    $input_data[$i][$key_name] = "CFNAME";
                    $input_data[$i][$value_name] = $resultMobile['c_name'];
                    $i++;
                }
                if (strpos($result['text'], '[CLNAME]') !== false) {
                    $input_data[$i][$key_name] = "CLNAME";
                    $input_data[$i][$value_name] = $resultMobile['c_family'];
                }
            }
            $this->sendSMS($this->convert_numbers($result['code']), $resultMobile['c_mobile_num'], $input_data);

            $sql2 = "INSERT INTO tbl_services_reservation_log (admin_id,reservation_id,activity_type,activity) VALUES (?,?,?,?)";
            $params = array(0, $id, "send_sms_reservation", $text_sms);
            $this->doQuery($sql2, $params);
        }
    }
}

?>