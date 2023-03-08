<?php

class model_services extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getIssetServiceSlug($slug)
    {
        $_where = "WHERE s.s_slug=? AND s.s_status=1";
        $_input = array($slug);
        $_order = "";
        $_limit = "";
        $_join = "";
        return $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getServices($userId, $get)
    {
        $sort_type = $this->Check_Param($get['orderby']);
        if($sort_type=='oldest') { // قدیمی ترین
            $order = "s.s_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "s.s_view DESC";
        } else if($sort_type=='rating') { // میانگین رتبه
            $order = "CAST(rating AS DECIMAL(10,2)) DESC";
        } else { // جدیدترین
            $order = "s.s_id DESC";
        }

        $page = 1;
        $get = explode("/", htmlspecialchars($get['url']));
        if(!empty($get[2]) and is_numeric($get[2])) {
            $page = $get[2];
        }
        $perPage = $this->getPublicInfo('service_item_per_page');
        $start = ($page-1)*$perPage;
        if($start < 0) $start = 0;

        $_where = "WHERE s.s_status=1";
        $_input = array();
        $_order = "ORDER BY $order";
        $_limit = "LIMIT $start, $perPage";
        $_join = "";
        return $this->getServiceData(False, $this->checkLogin, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getItemsPagination($get)
    {
        $sort_type = $this->Check_Param($get['orderby']);
        if($sort_type=='oldest') { // قدیمی ترین
            $order = "s.s_id ASC";
        } else if($sort_type=='view') { // پربازدیدترین
            $order = "s.s_view DESC";
        } else if($sort_type=='rating') { // میانگین رتبه
            $order = "CAST(rating AS DECIMAL(10,2)) DESC";
        } else { // جدیدترین
            $order = "s.s_id DESC";
        }

        $_where = "WHERE s.s_status=1";
        $_input = array();
        $_order = "ORDER BY $order";
        $_limit = "";
        $_join = "";
        $result = $this->getServiceData(False, $this->checkLogin, $_where, $_order, $_limit, $_input, $_join, False);

        $url = "services";

        $url_check = explode("/", htmlspecialchars($get['url']));
        $pageNo = $url_check[2];

        return $this->getAllPageLinks(sizeof($result), $pageNo, $url, $this->getPublicInfo('service_item_per_page'), $get);
    }

    function getServicesRandom($id, $count=3)
    {
        $_where = "WHERE s.s_status=1 AND s.s_id!=?";
        $_input = array($id);
        $_order = "ORDER BY rand() DESC";
        $_limit = "LIMIT ".$count;
        $_join = "";
        return $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);
    }

    function getCalendarFile($id, $userId)
    {
        if($id!="" AND $userId!=False) {
            $sql = "SELECT sre.*,s.s_title FROM tbl_services_reservation sre
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    WHERE sre.sre_status=1 and sre.order_service_vids_id=? AND sre.user_id=?";
            $orderInfo = $this->doSelect($sql, array($id, $userId), 1);

            if($orderInfo['s_title']!="") {
                date_default_timezone_set('Asia/Tehran');
                $event = array(
                    'location' => $this->getPublicInfo('province').", ".$this->getPublicInfo('city').", ".$this->getPublicInfo('address'),
                    'description' => "رزرو خدمت " . $orderInfo['s_title'] . " برای روز " . $orderInfo['sre_day'] ." ".$orderInfo['sre_date'] . " ساعت " . $orderInfo['sre_time']."\n"."  شماره پیگیری: ".$id,
                    'dtstart' => self::jaliliToMiladi($orderInfo['sre_date'], "/", "-") . " " . $orderInfo['sre_time'],
                    'dtend' => self::jaliliToMiladi($orderInfo['sre_date'], "/", "-") . " " . $orderInfo['sre_time'],
                    'summary' => "رزرو خدمت " . $orderInfo['s_title'],
                    'url' => URL
                );

                $ics = new ICS($event);
                header('Content-type: text/calendar; charset=utf-8');
                header('Content-Disposition: attachment; filename=reservation-'.$id.'.ics');
                echo $ics->to_string();
            } else {
                header("Location:" . URL ."/notfound");
            }
        } else {
            header("Location:" . URL ."/notfound");
        }
    }

    function getServicesTag($id)
    {
        $sql = "SELECT * FROM tbl_services_tag s LEFT JOIN tbl_tags t ON s.tag_id=t.t_id WHERE s.service_id=?";
        return $this->doSelect($sql, array($id));
    }

    function getServicesTiming($id)
    {
        return $this->doSelect("SELECT * FROM tbl_services_timing WHERE service_id=?", array($id), 1);
    }

    function getServicePortfolio($id)
    {
        return $this->doSelect("SELECT * FROM tbl_images WHERE post_id=? AND i_type=? ORDER BY i_order ASC", array($id, "service-portfolio"));
    }

    function getIssetStaff($id)
    {
        return $this->doSelect( "SELECT staff_vids_id FROM tbl_services_staff WHERE staff_vids_id= ?", array($id));
    }

    function getServicesTariff($serviceId)
    {
        $sql = "SELECT ss.staff_vids_id,ss.name,ss.image,ss.score,ss.expertise
                    FROM tbl_services_tariff st 
                    LEFT JOIN tbl_services_staff ss ON st.operator_id=ss.staff_vids_id 
                    WHERE service_id=? AND st.st_status=1
                    GROUP BY ss.r_id,ss.name,ss.image,ss.score,ss.expertise";
        return $this->doSelect($sql, array($serviceId));
    }

    function get_staff_info($id="")
    {
        $sql = "SELECT * FROM tbl_services_staff WHERE staff_vids_id=? and status=1";
        return $this->doSelect($sql, array($id), 1);
    }

    function checkTurnBookingUser($serviceId, $userId)
    {
        $sql = "SELECT * FROM tbl_services_reservation WHERE service_id=? AND user_id=? AND sre_status=0";
        return $this->doSelect($sql, array($serviceId, $userId));
    }

    function getRelatedBlog($id)
    {
        $sql = "SELECT b.* FROM tbl_services_related_blog s 
                    LEFT JOIN tbl_blog b ON s.blog_id=b.n_id 
                    WHERE s.service_id=? 
                    ORDER BY b.n_id DESC 
                    LIMIT 4";
        return $this->doSelect($sql, array($id));
    }

    function getFirstFree()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $result = array();
        $days= array('saturday','sunday', 'monday','tuesday','wednesday','thursday','friday');

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($data['guid']), 1);

        $today = self::jaliliDate();
        $max_reservation_date = self::JalaliAfter($today, $turn_status['st_date_reservation']);
        $periods = $this->createDateRangeArray(
            Model::jaliliToMiladi($today, "/", "_"),
            Model::jaliliToMiladi($max_reservation_date, "/", "_")
        );

        $first_date = "";
        foreach ($periods as $period) {
            $date_fa = explode("/", $period['fa']);

            $time = jmktime(0, 0, 0, $date_fa[1], $date_fa[2], $date_fa[0]);
            $dateInfo = jgetdate($time);

            $rows_select = 'st_turn_' . $days[$dateInfo['wday']];
            if ($turn_status[$rows_select] != "not_turn") {
                if ($turn_status[$rows_select] == "custom") {
                    $title_day = $days[$dateInfo['wday']];
                } else {
                    $title_day = $turn_status[$rows_select];
                }

                $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_title_day=? ORDER BY sm_time_start ASC";
                $turns = $this->doSelect($sql, array($data['guid'], $title_day));

                if (sizeof($turns) > 0) {
                    foreach ($turns as $turn) {
                        if ($turn_status[$rows_select] == "custom_date") {
                            $check_date_for_timing = $turn['sm_description'];
                        } else {
                            $check_date_for_timing = $period['fa'];
                        }
                        $check_time = str_replace("/", "", $check_date_for_timing) . str_replace(":", "", $turn['sm_time_start']);

                        if ($check_time >= self::jaliliDate("YmdHi")) {
                            if (str_replace("/", "", $max_reservation_date) > str_replace("/", "", $check_date_for_timing)) {
                                //در حالت تاریخ دلخواه چک می شود که تاریخ انتخابی با تاریخ روز یکی باشد
                                if ($turn_status[$rows_select] == "custom_date" and $check_date_for_timing != $period['fa']) {
                                    continue;
                                }

                                // خالی بودن زمان چک می شود
                                $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                                $reservationCount = $this->doSelect($sql, array($data['guid'], $check_date_for_timing, $turn['sm_time_start']));
                                if ($turn['sm_capacity'] >= ($reservationCount[0]['count'] + 1)) {
                                    $first_date = str_replace("/", "-", $period['fa']);
                                    break 2;
                                }
                            }
                        }
                    }
                }
            }
        }

        $result['d'] = $first_date;

        echo json_encode($result, true);
    }

    function initDays($userId)
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body,true);
        $result = array();
        $dayInfo = array();
        $days= array('saturday','sunday', 'monday','tuesday','wednesday','thursday','friday');
        $day_count = 31;
        if($data['m']>6 && $data['m']<12 ){
            $day_count = 30;
        } else if($data['m']==12) {
            if($this->sLeapYear($data['y'])) {
                $day_count = 30;
            } else {
                $day_count = 29;
            }
        }

        //حذف زمان های منقضی شده
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($data['guid']), 1);

        $isFirstVisit = false;
        $counter = 1;

        for($i=1;$i<=$day_count;$i++) {
            $today = self::jaliliDate();
            $max_reservation_date = self::JalaliAfter($today, $turn_status['st_date_reservation']);
            $date = $data['y'] . "/" . str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT);

            $time = jmktime(0, 0, 0, $data['m'], $i, $data['y']);
            $dateInfo = jgetdate($time, "", '', 'en');

            $dayInfo['dayCaption'] = str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT) . " " . $dateInfo['weekday'];
            $dayInfo['shortDate'] = Model::jaliliToMiladi($date, "/", "_");
            $dayInfo['today'] = $date == $today;
            $dayInfo['date'] = $date;
            $dayInfo['isNotInMonth'] = $data['m'] == self::jaliliDate("m");

            $sql = "SELECT * FROM tbl_holidays WHERE h_date=? AND h_status=1";
            $res = $this->doSelect($sql, array(str_pad($data['m'], 2, '0', STR_PAD_LEFT) . "/" . str_pad($i, 2, '0', STR_PAD_LEFT)));
            $isHoliday = false;
            if ($dateInfo['weekday'] == "جمعه" or sizeof($res) > 0) {
                $isHoliday = true;
            }
            $dayInfo['isHoliday'] = $isHoliday;

            $rows_select = 'st_turn_' . $days[$dateInfo['wday']];

            $hasSetTimes = false;
            if ($turn_status[$rows_select] == "not_turn" || ($turn_status[$rows_select] == "holiday" && $turn_status['st_turn_holiday'] == "not_turn")) {
                $hasSetTimes = false;
            } else if (str_replace("/", "", $date) >= self::jaliliDate("Ymd")) {
                if($turn_status[$rows_select]=="custom"){
                    $title_day = $days[$dateInfo['wday']];
                } else  {
                    $title_day = $turn_status[$rows_select];
                }

                $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_title_day=? AND sm_status=1 ORDER BY sm_time_start ASC";
                $turns = $this->doSelect($sql, array($data['guid'], $title_day));

                $turnsInfo_item = array();
                $turnsInfo = array();

                if (sizeof($turns) > 0) {
                    $hasSetTimes = true;
                    foreach ($turns as $turn) {
                        if ($turn_status[$rows_select] == "custom_date") {
                            $check_date_for_timing = $turn['sm_description'];
                        } else {
                            $check_date_for_timing = $date;
                        }
                        $check_time = str_replace("/", "", $check_date_for_timing) . str_replace(":", "", $turn['sm_time_start']);

                        if ($check_time >= self::jaliliDate("YmdHi")) {
                            if (str_replace("/", "", $max_reservation_date) > str_replace("/", "", $check_date_for_timing)) {
                                //در حالت تاریخ دلخواه چک می شود که تاریخ انتخابی با تاریخ روز یکی باشد
                                if($turn_status[$rows_select] == "custom_date" and $check_date_for_timing != $date) {
                                    continue;
                                }

                                // خالی بودن زمان چک می شود
                                $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                                $reservationCount = $this->doSelect($sql, array($data['guid'], $check_date_for_timing, $turn['sm_time_start']));
                                if ($turn['sm_capacity'] >= ($reservationCount[0]['count'] + 1)) {
                                    if ($counter == 1) {
                                        if (!$isFirstVisit) {
                                            $isFirstVisit = true;
                                            $counter++;
                                        }
                                    }
                                    $turnsInfo_item['caption'] = $turn['sm_time_start'];
                                    $turnsInfo_item['isVip'] = $turn['sm_vip'] == 1;
                                    if ($userId != False) {
                                        $turnsInfo_item['url'] = "bookedInit?date=" . str_replace("/", "_", $check_date_for_timing) . "&time=" . str_replace(":", "_", $turn['sm_time_start']) . "&ugid=" . $data['guid'];
                                    } else {
                                        $turnsInfo_item['url'] = $data['url'] == "" ? "login" : "login?backURL=" . $data['url'];
                                    }
                                    $turnsInfo[] = $turnsInfo_item;
                                }
                            }
                        }
                    }
                }
            }

            $dayInfo['isFirstVisit'] = $isFirstVisit;
            if ($isFirstVisit) {
                $isFirstVisit = false;
            }

            $dayInfo['hasSetTimes'] = $hasSetTimes;
            $dayInfo['setTimeItems'] = $turnsInfo;

            $result[] = $dayInfo;
        }

        echo json_encode($result, true);
    }

}
?>