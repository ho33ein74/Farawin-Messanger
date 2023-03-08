<?php
class model_bookedInit extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getIssetService($serviceId)
    {
        $_where = "WHERE s.s_id=? AND s.s_status=1";
        $_input = array($serviceId);
        $_order = "";
        $_limit = "";
        $_join = "";
        return $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getServicesTariff($serviceId, $vip=0)
    {
        $sql = "SELECT st.*,ss.name,ss.image,ss.score
                    FROM tbl_services_tariff st 
                    LEFT JOIN tbl_services_staff ss ON st.operator_id=ss.staff_vids_id 
                    WHERE service_id=? AND st.st_is_vip=? AND st.st_status=1";
        $result = $this->doSelect($sql, array($serviceId, $vip));

        return $result;
    }

    function getIssetServicesTariff($tariffId)
    {
        $sql = "SELECT * FROM tbl_services_tariff WHERE st_id=? AND st_status=1";
        $result = $this->doSelect($sql, array($tariffId));

        return $result;
    }

    function getDateInfo($serviceId, $date, $time, $reservaationId)
    {
        $dateSplit = explode("_", $date);

        $sql = "SELECT * FROM tbl_services_reservation WHERE sre_id=?";
        $reservationList = $this->doSelect($sql, array($reservaationId), 1);

        $dateInfo = array(
            'date' => str_replace("_","/",$date),
            'expireDate' => gmdate('Y-m-d\TH:i:s', $reservationList['sre_timestamp_expire']),
            'time' => str_replace("_",":",$time),
            'title' => jgetdate(jmktime(0,0,0,$dateSplit[1], $dateSplit[2], $dateSplit[0]) , "" , '' , 'en' )['weekday']
        );
        return $dateInfo;
    }

    function savePreReservation($serviceId, $date, $time, $day, $vip, $userId)
    {
        if($userId != False) {
            $timestamp = time();
            $date = str_replace("_", "/", $date);
            $time = str_replace("_", ":", $time);

            //حذف زمان های منقضی شده
            $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
            $this->doQuery($sql, array($timestamp));

            $sql = "SELECT * FROM tbl_services_reservation WHERE service_id=? AND user_id=? AND sre_date=? AND sre_time=? AND sre_status=0";
            $reservationList = $this->doSelect($sql, array($serviceId, $userId, $date, $time));
            if (sizeof($reservationList) == 0) {
                $sql = "DELETE FROM tbl_services_reservation WHERE service_id=? AND user_id=? AND sre_status=0";
                $this->doQuery($sql, array($serviceId, $userId));

                $servicesTimingInfo = $this->doSelect("SELECT * FROM tbl_services_timing WHERE service_id=?", array($serviceId), 1);

                $sql = "INSERT INTO tbl_services_reservation (user_id,service_id,sre_date,sre_time,sre_day,sre_vip,sre_is_need_to_prepayment,sre_price_prepayment,sre_price_payment,sre_price_total,sre_timestamp_expire,sre_date_create,sre_time_create) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $value = array($userId, $serviceId, $date, $time, $day, $vip, 0, 0, 0, 0, $timestamp + ($servicesTimingInfo['st_complete_time_reservation'] * 60), self::jaliliDate(), jdate("H:i:s"));
                $this->doQuery($sql, $value);
                return Model::$conn->lastInsertId();
            } else {
                return $reservationList[0]['sre_id'];
            }
        }
    }

    function checkTurnBookingUser($serviceId, $date, $time, $userId)
    {
        $date = str_replace("_", "/", $date);
        $time = str_replace("_", ":", $time);

        $sql = "SELECT * FROM tbl_services_reservation WHERE service_id=? AND user_id=? AND sre_date=? AND sre_time=? AND sre_status=1";
        return $this->doSelect($sql, array($serviceId, $userId, $date, $time));
    }

    function saveOrder($userId, $data)
    {
        try {
            $serviceId = Model::Decrypt($data['serviceId'], KEY);
            $date = str_replace("_", "/", Model::Decrypt($data['date'], KEY));
            $time = str_replace("_", ":", Model::Decrypt($data['time'], KEY));
            $tariff = Model::Decrypt($data['tariff'], KEY);
            $gateway = Model::Decrypt($data['gateway'], KEY);

            $callbackURL = $this->getPublicInfo('root').'checkout';
            $checkPayType = $this->getPayType($gateway, 0);
            $checkServices = $this->getIssetService($serviceId);
            $checkServicesTariff = $this->getIssetServicesTariff($tariff);
            if (sizeof($checkServices)>0) {
                if (sizeof($checkPayType)>0) {
                    if (sizeof($checkServicesTariff)>0) {
                        $sql = "SELECT * FROM tbl_services_reservation WHERE service_id=? AND user_id=? AND sre_date=? AND sre_time=? AND sre_status=0";
                        $reservationList = $this->doSelect($sql, array($serviceId, $userId, $date, $time));
                        if (sizeof($reservationList) > 0) {
                            $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND st_id=?";
                            $tariffInfo = $this->doSelect($sql, array($serviceId, $tariff), 1);
                            $is_need_to_prepayment=0;
                            if($tariffInfo['st_deposit']>0){
                                $is_need_to_prepayment=1;
                                $priceTotal = $tariffInfo['st_deposit'];
                            } else {
                                $priceTotal = $tariffInfo['st_price'];
                            }


                            $payType = $this->getPayType($gateway, 1);
                            $userInfo = $this->getinfoUser($userId);
                            $beforepay = '-';

                            $order_shop_vids = $this->getLastId("order_service");
                            $order_tracking = $userInfo['customer_vids_id'] . $order_shop_vids;

                            $sql = "SELECT * FROM tbl_discounts d 
                                        LEFT JOIN tbl_discounts_user_used du ON d.dc_id=du.dc_id 
                                        WHERE du.user_id=? AND du.du_status=0";
                            $offerCode = $this->doSelect($sql, array($userId));
                            $off_code_price = 0;
                            $off_code = NULL;
                            if(sizeof($offerCode)>0) {
                                $calculateOffer = ($tariffInfo['st_price'] * $offerCode[0]['dc_percent']) / 100;
                                if ($calculateOffer > $offerCode[0]['dc_price']) {
                                    $calculateOffer = $offerCode[0]['dc_price'];
                                }

                                $off_code_price = $calculateOffer;
                                $off_code = $offerCode[0]['dc_code'];

                                if ($is_need_to_prepayment == 0) {
                                    $priceTotal -= $calculateOffer;
                                }

                                $sql = "UPDATE tbl_discounts_user_used SET order_id=? WHERE user_id=? AND du_status=0";
                                $params = array($order_tracking, $userId);
                                $this->doQuery($sql, $params);
                            }

                            $sql = "UPDATE tbl_services_reservation SET order_service_vids_id=?, branch_id=?, staff_id=?, beforepay=?, payment_method_id=?, sre_is_need_to_prepayment=?, sre_price_prepayment=?, sre_price_total=?, sre_off_code=?, sre_off_code_price=? WHERE sre_status=0 AND user_id=?";
                            $params = [$order_tracking, $tariffInfo['branch_id'], $tariffInfo['operator_id'], $beforepay, $payType['pay_id'], $is_need_to_prepayment, $tariffInfo['st_deposit'], $tariffInfo['st_price'], $off_code, $off_code_price, $userId];
                            $this->doQuery($sql, $params);

                            $this->updateLastId("order_service");

                            if ($gateway == 2 AND $priceTotal>0) { //زرین پال
                                $zp = new zarinpal();
                                $pay_result = $zp->request($payType['pay_merchant'], $priceTotal, $this->getPublicInfo('site'), $userInfo['c_email'], $userInfo['c_mobile_num'], $callbackURL, $payType['test_status'], false);
                                $beforepay = $pay_result['Authority'];

                                $sql = "UPDATE tbl_services_reservation SET beforepay=? WHERE sre_status=0 AND user_id=?";
                                $params = array($beforepay, $userId );
                                $this->doQuery($sql, $params);

                                if (isset($pay_result["Status"]) && $pay_result["Status"] == 100) {
                                    $this->response_success("در حال انتقال به درگاه پرداخت...", "success", $pay_result["StartPay"]);
                                } else {
                                    $this->response_error($pay_result["Status"] . " - " . $pay_result["Message"]);
                                }
                            } else {
                                $this->response_success("در حال انتقال به صفحه جزئیات رزرو...", "success", "checkout?reservation_tracking=" . $order_tracking);
                            }
                        } else {
                            $this->response_error("زمان انتخاب شده توسط کاربر دیگری رزرو و یا منقضی شده است");
                        }
                    } else {
                        $this->response_error("پرسنل انتخابی یافت نشد پرسنل دیگری انتخاب نمایید");
                    }
                } else {
                    $this->response_error("روش پرداخت دیگری را انتخاب نمایید");
                }
            } else {
                $this->response_error("خدمت مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function calculatePayment($userId, $post)
    {
        try {
            $operator_id = Model::Decrypt($post['operator_id'], KEY);
            $service_id = Model::Decrypt($post['service_id'], KEY);
            $is_vip = Model::Decrypt($post['is_vip'], KEY);

            $checkServices = $this->getIssetService($service_id);
            if(sizeof($checkServices)>0) {
                $sql = "SELECT * FROM tbl_services_staff WHERE staff_vids_id=? AND status=1";
                $operator_info = $this->doSelect($sql, array($operator_id));
                if(sizeof($operator_info)>0) {
                    $sql = "SELECT * FROM tbl_services_tariff WHERE service_id=? AND operator_id=? AND st_is_vip=? AND st_status=1";
                    $tariff_info = $this->doSelect($sql, array($service_id, $operator_id, $is_vip));
                    if(sizeof($tariff_info)>0) {
                        $sql = "SELECT * FROM tbl_discounts_user_used WHERE user_id=? AND du_status=0";
                        $discounts_info = $this->doSelect($sql, array($userId));
                        if(sizeof($discounts_info)>0){
                            $sql = "SELECT * FROM tbl_discounts WHERE dc_id=? AND dc_status=1";
                            $codeInfo = $this->doSelect($sql, array($discounts_info[0]['dc_id']));
                            $calculateOffer = ($tariff_info[0]['st_price'] * $codeInfo[0]['dc_percent']) / 100;
                            if ($calculateOffer > $codeInfo[0]['dc_price']) {
                                $calculateOffer = $codeInfo[0]['dc_price'];
                            }
                        } else {
                            $calculateOffer = 0;
                        }

                        $data = array(
                            "price" => number_format($tariff_info['0']['st_price']), //هزینه خدمت
                            "deposit" => number_format($tariff_info['0']['st_deposit']), //بیعانه
                            "offer" => number_format($calculateOffer), //تخفیف
                            "total_pay" =>  number_format($tariff_info[0]['st_price'] - ($calculateOffer ?? 0)), //هزینه کل خدمت
                            "total" => number_format($tariff_info['0']['st_deposit']>0 ? $tariff_info['0']['st_deposit']:($tariff_info[0]['st_price'] - ($calculateOffer ?? 0))), //مبلغ قابل پرداخت
                            "code" =>$codeInfo[0]['dc_code'], //کد تخفیف
                        );

                        $this->response_success("محاسبات به روز شد", "ok", "", $data);
                    } else {
                        $this->response_error("تعرفه ای یافت نشد");
                    }
                } else {
                    $this->response_error("شخص مورد نظر یافت نشد");
                }
            } else {
                $this->response_error("خدمت مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function checkCode($userId, $serviceId, $tariff, $status, $code, $print=0)
    {
        try {
            $serviceId = Model::Decrypt($serviceId, KEY);
            $tariff = Model::Decrypt($tariff, KEY);
            $this->doQuery("DELETE FROM tbl_discounts_user_used WHERE user_id=? and du_status=0", array($userId));
            $checkServicesTariff = $this->getIssetServicesTariff($tariff);

            if($status == "confirm") {
                //کد وجود دارد یا خیر؟
                $codeInfo = $this->doSelect("SELECT * FROM tbl_discounts WHERE dc_code=? AND dc_status=1", array($code));
                if (sizeof($codeInfo) > 0) {
                    //بخش مربوطه برای استفاده از کد تخفیف
                    if($codeInfo[0]['dc_type'] == "service") {
                        // خدمات مجاز برای استفاده از کد
                        $sql = "SELECT * FROM tbl_discounts_service WHERE service_id=? AND dc_id=? AND dcc_status=1";
                        $discountService = $this->doSelect($sql, array($serviceId, $codeInfo[0]['dc_id']));
                        if(sizeof($discountService)>0 or $codeInfo[0]['dc_for_all_service'] == 1) {
                            //وجود داشتن پرسنل انتخابی
                            if (sizeof($checkServicesTariff) > 0) {
                                //پرسنل مجاز برای استفاده از کد
                                $sql = "SELECT * FROM tbl_discounts_staff WHERE staff_id=? AND dc_id=? AND ds_status=1";
                                $discountStaff = $this->doSelect($sql, array($checkServicesTariff[0]['operator_id'], $codeInfo[0]['dc_id']));
                                if(sizeof($discountStaff)>0 or $codeInfo[0]['dc_for_all_staff'] == 1) {
                                    //ویژه اولین سفارش
                                    $checkUserOrderUseOffer = True;
                                    if ($codeInfo[0]['dc_first_order'] == "1") {
                                        $userOrderCount = $this->doSelect("SELECT COUNT(*) as count FROM tbl_services_reservation WHERE user_id=? AND sre_status not in (0)", array($userId), 1);
                                        if ($userOrderCount['count'] > 0) {
                                            $checkUserOrderUseOffer = False;
                                        }
                                    }
                                    if ($checkUserOrderUseOffer) {
                                        //تعداد دفعات استفاده از کد تخفیف
                                        $checkAllUserUseOffer = $this->doSelect("SELECT COUNT(*) as count FROM tbl_discounts_user_used WHERE dc_id=? AND du_status =1", array($codeInfo[0]['dc_id']), 1);
                                        if (($checkAllUserUseOffer['count'] + 1) <= $codeInfo[0]['dc_number_of_use']) {
                                            //تعداد دفعات مجاز استفاده برای هر کاربر
                                            $checkUserUseOffer = $this->doSelect("SELECT COUNT(*) as count FROM tbl_discounts_user_used WHERE dc_id=? AND user_id =? AND du_status =1", array($codeInfo[0]['dc_id'], $userId), 1);
                                            if (($checkUserUseOffer['count'] + 1) <= $codeInfo[0]['dc_allowed_for_each_user']) {
                                                // بررسی تاریخ انقضا کد
                                                if (self::jaliliDate('Ymd') <= str_replace("/", "", $codeInfo[0]['dc_expire_date'])) {
                                                    $sql = "INSERT INTO tbl_discounts_user_used (user_id,dc_id,order_id,du_used_date,du_status) VALUES (?,?,?,?,?)";
                                                    $value = array($userId, $codeInfo[0]['dc_id'], null, self::jaliliDate(), 0);
                                                    $this->doQuery($sql, $value);

                                                    $calculateOffer = ($checkServicesTariff[0]['st_price'] * $codeInfo[0]['dc_percent']) / 100;
                                                    if ($calculateOffer > $codeInfo[0]['dc_price']) {
                                                        $calculateOffer = $codeInfo[0]['dc_price'];
                                                    }

                                                    $result = array(
                                                        "status" => "success",
                                                        "reason" => "ok",
                                                        "text" => 'کد تخفیف ' . $code . ' به ارزش ' . number_format($calculateOffer) . ' تومان اعمال شد!',
                                                        "amount" => $checkServicesTariff[0]['st_price'] - $calculateOffer,
                                                        "price_principal" => $checkServicesTariff[0]['st_price'],
                                                        "deposit_amount" => $checkServicesTariff[0]['st_deposit'],
                                                        "offer" => $calculateOffer,
                                                    );
                                                } else {
                                                    $result = array(
                                                        "status" => "error",
                                                        "reason" => "expired",
                                                        "text" => 'زمان مجاز برای استفاده از کد تخفیف ' . $code . ' به پایان رسیده است!'
                                                    );
                                                }
                                            } else {
                                                $result = array(
                                                    "status" => "error",
                                                    "reason" => "userBeforeUsed",
                                                    "text" => 'تعداد دفعات مجاز شما برای استفاده از کد تخفیف ' . $code . ' به پایان رسیده است!'
                                                );
                                            }
                                        } else {
                                            $result = array(
                                                "status" => "error",
                                                "reason" => "completeUsed",
                                                "text" => 'تعداد دفعات مجاز استفاده از کد تخفیف ' . $code . ' به پایان رسیده است!'
                                            );
                                        }
                                    } else {
                                        $result = array(
                                            "status" => "error",
                                            "reason" => "oldUser",
                                            "text" => 'کد تخفیف ' . $code . ' ویژه سفارش اول می باشد!'
                                        );
                                    }
                                } else {
                                    $result = array(
                                        "status" => "error",
                                        "reason" => "no",
                                        "text" => 'کد تخفیف ' . $code . ' قابل استفاده برای این پرسنل نمی باشد.',
                                    );
                                }
                            } else {
                                $result = array(
                                    "status" => "error",
                                    "reason" => "needSelectStaff",
                                    "text" => 'پرسنل مورد نظر خود را انتخاب نمایید.'
                                );
                            }
                        } else {
                            $result = array(
                                "status" => "error",
                                "reason" => "no",
                                "text" => 'کد تخفیف ' . $code . ' قابل استفاده برای این خدمت نمی باشد.',
                            );
                        }
                    } else {
                        $result = array(
                            "status" => "error",
                            "reason" => "no",
                            "text" => 'کد تخفیف ' . $code . ' قابل استفاده برای خدمات نمی باشد.',
                        );
                    }
                } else {
                    $result = array(
                        "status" => "error",
                        "reason" => "no",
                        "text" => 'کد تخفیف ' . $code . ' وجود ندارد!',
                    );
                }
            } else {
                $checkServicesTariff = $this->getIssetServicesTariff($tariff);

                $result = array(
                    "status" => "success",
                    "reason" => "ok",
                    "text" => 'کد تخفیف ' . $code . ' از سبد شما حذف شد!',
                    "amount" => $checkServicesTariff[0]['st_price'],
                    "price_principal" => $checkServicesTariff[0]['st_price'],
                    "offer" => 0,
                );
            }

            if($print){
                echo json_encode($result);
            } else {
                return $result;
            }
        } catch (Exception $e) {
            $result = array(
                "status" => "error",
                "reason" => "exception",
                "text" => $e->getMessage(),
            );

            if($print){
                echo json_encode($result);
            } else {
                return $result;
            }
        }
    }

    function getOffCodeUsed($userId){
        return $this->doSelect("SELECT * FROM tbl_discounts d LEFT JOIN tbl_discounts_user_used du ON d.dc_id=du.dc_id WHERE du.user_id=? AND du.du_status=0", array($userId));
    }

}
?>