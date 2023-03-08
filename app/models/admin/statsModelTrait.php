<?php

trait statsModelTrait
{
    function getStatsData($from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $sql = "SELECT u.customer_vids_id
                    FROM tbl_customer u
                    LEFT JOIN tbl_courses_order o
                    ON u.customer_vids_id=o.customer_id
                    WHERE  u.c_registery_date >= '".str_replace("-","/",$this->Check_Param($from))."' AND u.c_registery_date <= '".str_replace("-","/",$this->Check_Param($to))."'
                    GROUP BY u.customer_vids_id
                    ORDER BY order_course_vids_id DESC";
            $result['customerMore1Order'] = $this->doSelect($sql);

            $sql = "SELECT count(customer_vids_id) AS countUser FROM tbl_customer WHERE c_registery_date >= '".str_replace("-","/",$this->Check_Param($from))."' AND c_registery_date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['allCustomer'] = $this->doSelect($sql);

            $sql = "SELECT count(order_course_vids_id) AS countOrder FROM tbl_courses_order WHERE date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['allOrder'] = $this->doSelect($sql);

            $sql = "SELECT sum(price) as price FROM tbl_courses_order WHERE (status=11 OR status=9) AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['allPrice'] = $this->doSelect($sql);
        }
        else {
            $sql = "SELECT u.customer_vids_id,count(o.order_course_vids_id) AS countOrder
                    FROM tbl_customer u
                    LEFT JOIN tbl_courses_order o
                    ON u.customer_vids_id=o.customer_id
                    WHERE u.c_registery_date LIKE '%" . $this->jaliliDate("Y/m") . "/%'
                    GROUP BY u.customer_vids_id,order_course_vids_id
                    HAVING count(o.order_course_vids_id) >1
                    ORDER BY order_course_vids_id DESC";
            $result['customerMore1Order'] = $this->doSelect($sql);

            $sql = "SELECT count(customer_vids_id) AS countUser FROM tbl_customer WHERE c_registery_date LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
            $result['allCustomer'] = $this->doSelect($sql);

            $sql = "SELECT count(order_course_vids_id) AS countOrder FROM tbl_courses_order WHERE date LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
            $result['allOrder'] = $this->doSelect($sql);

            $sql = "SELECT sum(price) as price FROM tbl_courses_order WHERE (status=11 OR status=9) AND date LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
            $result['allPrice'] = $this->doSelect($sql);
        }

        return $result;
    }

    function statusOrderPie($from=NULL, $to=NULL)
    {//
//        if($from!=NULL AND $to!=NULL) {
//            foreach ($res as $id) {
//                $sql = "SELECT count(status) as status FROM tbl_courses_order WHERE status=? AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
//                $result[$id['title']] = $this->doSelect($sql, array($id['id']));
//            }
//        } else {
//            foreach ($res as $id) {
//                $sql = "SELECT count(status) as status FROM tbl_courses_order WHERE status=? AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
//                $result[$id['title']] = $this->doSelect($sql, array($id['id']));
//            }
//        }
//
//        return $result;
    }

    function getStatOrderSale($id, $from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $dates = array();
            $from_explode = explode("-", $from);
            $to_explode = explode("-", $to);
            $begin = new DateTime(jalali_to_gregorian($from_explode[0], $from_explode[1], $from_explode[2],'-'));
            $end = new DateTime(jalali_to_gregorian($to_explode[0], $to_explode[1], $to_explode[2],'-'));
            $end = $end->modify( '+1 day' );

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dateItem){
                $dates[] = $this->MiladiTojalili_2no($dateItem->format('Y/m/d'));
            }
            $orders = $this->getOrderShop($id, $from, $to);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['date'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        } else {
            $num_of_days_in_month = jdate("t");
            $dates = array();
            for ($i=1;$i<=$num_of_days_in_month;$i++){
                $dates[]=  jdate("Y/m/".sprintf("%02d", $i));
            }

            $orders = $this->getOrderShop($id, NULL, NULL);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['date'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        }

        return $orderStat;
    }

    function getReservationStatOrder($id, $from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $dates = array();
            $from_explode = explode("-", $from);
            $to_explode = explode("-", $to);
            $begin = new DateTime(jalali_to_gregorian($from_explode[0], $from_explode[1], $from_explode[2],'-'));
            $end = new DateTime(jalali_to_gregorian($to_explode[0], $to_explode[1], $to_explode[2],'-'));
            $end = $end->modify( '+1 day' );

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dateItem){
                $dates[] = $this->MiladiTojalili_2no($dateItem->format('Y/m/d'));
            }
            $orders = $this->getReservations($id, $from, $to);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['sre_date_create'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        } else {
            $num_of_days_in_month = jdate("t");
            $dates = array();
            for ($i=1;$i<=$num_of_days_in_month;$i++){
                $dates[]=  jdate("Y/m/".sprintf("%02d", $i));
            }

            $orders = $this->getReservations($id, NULL, NULL);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['sre_date_create'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        }

        return $orderStat;
    }

    function getStatPayment($id, $from=NULL, $to=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $dates = array();
            $from_explode = explode("-", $from);
            $to_explode = explode("-", $to);
            $begin = new DateTime(jalali_to_gregorian($from_explode[0], $from_explode[1], $from_explode[2],'-'));
            $end = new DateTime(jalali_to_gregorian($to_explode[0], $to_explode[1], $to_explode[2],'-'));
            $end = $end->modify( '+1 day' );

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dateItem){
                $dates[] = $this->MiladiTojalili_2no($dateItem->format('Y/m/d'));
            }

            $orders = $this->getOrderPayment($id, $from, $to);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['date_payment'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        } else {
            $num_of_days_in_month = jdate("t");
            $dates = array();
            for ($i=1;$i<=$num_of_days_in_month;$i++){
                $dates[]=  jdate("Y/m/".sprintf("%02d", $i));
            }

            $orders = $this->getOrderPayment($id, NULL, NULL);

            $orderStat = array();
            foreach ($dates as $date) {
                $orderStat[$date]=0;
                foreach ($orders as $order) {
                    if ($date == $this->convertNumbers($order['date_payment'])) {
                        $orderStat[$date] = @$orderStat[$date] + 1;
                    } else {
                        $orderStat[$date] = @$orderStat[$date];
                    }
                }
            }
        }

        return $orderStat;
    }

    function getReferral($from=NULL, $to=NULL)
    {
        if( $from!=NULL AND $to!=NULL) {
            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='instagram' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['instagram'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='telegram' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['telegram'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='divar' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['divar'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='google' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['google'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='direct' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['direct'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='ref' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['ref'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='other' AND date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['other'] = $this->doSelect($sql);
        } else {
            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='instagram' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['instagram'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='telegram' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['telegram'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='divar' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['divar'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='google' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['google'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='direct' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['direct'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='ref' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['ref'] = $this->doSelect($sql);

            $sql = "SELECT count(nahveyeAshnaei) as ref FROM tbl_courses_order WHERE nahveyeAshnaei='other' AND date LIKE '%".$this->jaliliDate("Y/m")."/%'";
            $result['other'] = $this->doSelect($sql);
        }

        return $result;
    }

    function getRange($startDate, $lastDate)
    {
        $dates = array();
        $current = strtotime($startDate);
        $last = strtotime($lastDate);

        while ($current <= $last) {
            $dates[] = date('Y/m/d', $current);
            $current = strtotime('+1 day', $current);
        }

        return $dates;
    }

    function bannerTop($from=NULL, $to=NULL, $widget=NULL)
    {
        if($from!=NULL AND $to!=NULL) {
            $sql = "SELECT count(*) AS Count FROM tbl_customer WHERE c_registery_date >= '".str_replace("-","/",$this->Check_Param($from))."' AND c_registery_date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['userCount'] = $this->doSelect($sql);

            $sql = "SELECT count(*) AS Count FROM tbl_courses_order WHERE date >= '".str_replace("-","/",$this->Check_Param($from))."' AND date <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['orderSaleThisMonthCount'] = $this->doSelect($sql);

            $sql = "SELECT count(*) AS Count FROM tbl_services_reservation WHERE sre_status not in (0,6) AND sre_date_create >= '".str_replace("-","/",$this->Check_Param($from))."' AND sre_date_create <= '".str_replace("-","/",$this->Check_Param($to))."'";
            $result['reservationsThisMonthCount'] = $this->doSelect($sql);
        } else {
            if($widget == "count_users_this_month") {
                $sql = "SELECT count(*) AS Count FROM tbl_customer WHERE c_registery_date LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
                $result['userCount'] = $this->doSelect($sql);
            } else if($widget == "count_courses_sale_this_month") {
                $sql = "SELECT count(*) AS Count FROM tbl_courses_order WHERE date LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
                $result['orderSaleThisMonthCount'] = $this->doSelect($sql);
            } else if($widget == "count_reservation_this_month") {
                $sql = "SELECT count(*) AS Count FROM tbl_services_reservation WHERE sre_status not in (0,6) AND sre_date_create LIKE '%" . $this->jaliliDate("Y/m") . "/%'";
                $result['reservationsThisMonthCount'] = $this->doSelect($sql);
            }
        }

        return $result;
    }
}
