<?php

trait calendarModel
{
    function getAllEventsAjax($post)
    {
        try {
            $periods = $this->create_date_range_array(
                $this->convert_numbers($post['start']),
                $this->convert_numbers($post['end']),
            );

            $jayParsedAry = array();
            foreach ($periods as $period) {
                $sql = "SELECT sre.*,u.c_display_name,s.s_title,s.s_calendar_background_color FROM tbl_services_reservation sre
                            LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                            LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                            WHERE sre.sre_date=?";
                $reservation_list = $this->doSelect($sql, array($period['fa']));
                if (sizeof($reservation_list) > 0) {
                    foreach ($reservation_list as $reservation_item) {
                        $jayParsedAry[] = [
                            "title" => $reservation_item['c_display_name'] . " - " . $reservation_item['s_title'],
                            "description" => $reservation_item['c_display_name'] . " - " . $reservation_item['s_title'],
                            "start" => $period['en'] . "T" . $reservation_item['sre_time'] . ":00",
                            "end" => $period['en'] . "T" . $reservation_item['sre_time'] . ":00",
                            "groupId" => $reservation_item['service_id'],
                            "service_id" => $reservation_item['service_id'],
                            "url" => URL . ADMIN_PATH . "/reservations/details/" . $reservation_item['order_service_vids_id'],
                            "color" => $reservation_item['s_calendar_background_color'] != NULL ? $reservation_item['s_calendar_background_color'] : "red",
                            "background" => $reservation_item['s_calendar_background_color'] != NULL ? $reservation_item['s_calendar_background_color'] : "red",
                            "weekends" => false
                        ];
                    }
                }
            }

            echo json_encode($jayParsedAry);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getDateTimingAndEventsAjax($post)
    {
        try {
            $periods = $this->create_date_range_array(
                $this->convert_numbers($post['start']),
                $this->convert_numbers($post['end']),
            );

            $jayParsedAry = array();
            foreach ($periods as $period) {
                $sql = "SELECT sm.*,s.s_calendar_background_color FROM tbl_services_timing_manage_day sm
                            LEFT JOIN tbl_services s ON sm.service_id=s.s_id
                            WHERE sm.service_id=? AND sm.sm_description=? AND sm.sm_title_day='custom_date' 
                            ORDER BY sm.sm_time_start ASC";
                $reservation_list = $this->doSelect($sql, array($post['service'], $period['fa']));
                if (sizeof($reservation_list) > 0) {
                    foreach ($reservation_list as $reservation_item) {
                        $is_vip_txt = "";
                        if ($reservation_item['sm_vip'] == 1) {
                            $is_vip_txt = " (💎)";
                        }

                        if($reservation_item['sm_status'] == 0){
                            $background = "red";
                        } else {
                            $background = "green";
                        }

                        $jayParsedAry[] = [
                            "title" => $reservation_item['sm_time_start'] . " - " . $reservation_item['sm_time_end'] . $is_vip_txt,
                            "description" => "تا " . $reservation_item['sm_time_end'],
                            "start" => $period['en'] . "T" . $reservation_item['sm_time_start'] . ":00",
                            "end" => $period['en'] . "T" . $reservation_item['sm_time_end'] . ":00",
                            "service_id" => $reservation_item['service_id'],
                            "jalali_date" => $period['fa'],
                            "color" => $background,
                        ];
                    }
                }
            }

            echo json_encode($jayParsedAry);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getDateEventsAjax($post)
    {
        try {
            $jayParsedAry = array();
            $date = $this->miladi_to_jalali_2no($post['date'], "-");

            $jayParsedAry["date_fa"] = $date;
            $jayParsedAry["date_en"] = $post['date'];

            $sql = "SELECT * FROM tbl_services_timing_manage_day 
                        WHERE service_id=? AND sm_description=? AND sm_title_day='custom_date' 
                        ORDER BY sm_time_start ASC";
            $result = $this->doSelect($sql, array($post['service'], $date));

            $tr_col = '';
            if (sizeof($result) > 0) {
                $i = 0;
                foreach ($result as $item) {
                    $tr_col .= '<tr>';
                    $tr_col .= '<td>';
                    $tr_col .= '<lable>';
                    $tr_col .= '<div class="icheckbox_flat-green">';
                    $tr_col .= '<input type="checkbox" name="timing[custom_date][' . $i . '][status]" ' . ($item['sm_status'] == 1 ? "checked" : "") . ' class="flat-red">';
                    $tr_col .= '</div>';
                    $tr_col .= '</lable>';
                    $tr_col .= '</td>';
                    $tr_col .= '<td>';
                    $tr_col .= '<lable>';
                    $tr_col .= '<div class="icheckbox_flat-green">';
                    $tr_col .= '<input type="checkbox" name="timing[custom_date][' . $i . '][vip]" ' . ($item['sm_vip'] == 1 ? "checked" : "") . ' class="flat-red">';
                    $tr_col .= '</div>';
                    $tr_col .= '</lable>';
                    $tr_col .= '</td>';
                    $tr_col .= '<td>';
                    $tr_col .= '<input type="text" placeholder="ساعت شروع" name="timing[custom_date][' . $i . '][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="' . $item['sm_time_start'] . '">';
                    $tr_col .= '</td>';
                    $tr_col .= '<td>';
                    $tr_col .= '<input type="text" placeholder="ساعت پایان" name="timing[custom_date][' . $i . '][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="' . $item['sm_time_end'] . '">';
                    $tr_col .= '</td>';
                    $tr_col .= '<td>';
                    $tr_col .= '<lable>';
                    $tr_col .= '<input type="text" name="timing[custom_date][' . $i . '][capacity]" class="form-control" style="direction: ltr;text-align: left" value="' . $item['sm_capacity'] . '">';
                    $tr_col .= '</lable>';
                    $tr_col .= '</td>';
                    $tr_col .= '<td class="text-center">';
                    $tr_col .= '<a style="cursor: pointer" data-day="custom_date" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a>';
                    $tr_col .= '</td>';
                    $i++;
                    $tr_col .= '</tr>';
                }
            }

            $jayParsedAry["data"] = $tr_col;
            $jayParsedAry["size"] = sizeof($result);

            echo json_encode($jayParsedAry);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}