<?php

trait privateTrait
{
    function getPublicInfo($value = '')
    {
        if ($value == "") {
            $sql = "SELECT `key`,`value` FROM tbl_settings";
            $result = self::doSelect($sql);

            foreach ($result as $item) {
                $res[$item['key']] = $item['value'];
            }

            return $res;
        } else {
            $result = self::doSelect("SELECT `value` FROM tbl_settings WHERE `key`=?", array($value), 1)['value'];
            return $result;
        }
    }

    function getDomainsInfo($type="", $name = '')
    {
        if ($type == "") {
            $sql = "SELECT domain_name,domain_title,domain_code,domain_prority FROM tbl_domains";
            $result = self::doSelect($sql);

            $res = array();
            foreach ($result as $item) {
                $res[$item['domain_name']][] = $item;
            }
            return $res;
        } else {
            $param = array($type, $name);
            return self::doSelect("SELECT * FROM tbl_domains WHERE `domain_name`=? AND `domain_code`=?", $param, 1);
        }
    }

    function getPage($link = '')
    {
        $result = self::doSelect("SELECT p.*,d.a_name FROM tbl_page p LEFT JOIN tbl_admin d ON p.writer=d.a_id WHERE p.p_status in (1,2) AND link= ?", array($link), 1);
        return $result;
    }

    function ActivityLog($activity, $id='', $data=NULL)
    {
        try {
            $this->cookie_init();
            if ($id != '') {
                $adminId = $id;
            } else {
                $adminId = $this->decrypt($this->cookie_get('adminId'), KEY);
            }
            $ip = $this->get_client_ip();
            $detect = $this->detect_browser();

            $sql2 = "INSERT INTO tbl_admin_activity (admin_id, ip, platform, browser, activity, data_changed) VALUES (?,?,?,?,?,?)";
            $params = array($adminId, $ip, $detect['platform'], $detect['name'], $activity, $data);
            $this->doQuery($sql2, $params);
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getinfoUser($id)
    {
        $sql = "SELECT c.*,p.pro_name,ci.ci_name FROM tbl_customer c 
                        LEFT JOIN tbl_provinces p ON c.province_id=p.pro_id
                        LEFT JOIN tbl_cities ci ON c.city_id=ci.ci_id
                        WHERE customer_vids_id=?";
        $result = $this->doSelect($sql, array($id), 1);
        return $result;
    }

    public function get_role_allow_access($id): array
    {
        $result = $this->doSelect("SELECT path FROM tbl_admin_role_access WHERE role_id=?", array($id));
        return array_column($result, 'path');
    }

    public function getLastId($activity)
    {
        $sql = "SELECT " . $activity . "_id as vids from tbl_vids";
        $result = $this->doSelect($sql);

        return $result[0]['vids'];
    }

    public function updateLastId($activity)
    {
        $sql = "UPDATE tbl_vids SET " . $activity . "_id=" . $activity . "_id+1";
        $this->doQuery($sql);
    }

    function getScoreItem($id, $type)
    {
        return $this->doSelect("SELECT COUNT(r_id) count, SUM(r_rate) sum, FORMAT(AVG(r_rate), 2) avg FROM tbl_rating WHERE item_id=? AND r_type=?", array($id, $type), 1);
    }

    function getIcons()
    {
        return $this->doSelect("SELECT * FROM tbl_icons WHERE i_status=1");
    }

    function sendSMS($pattern_code, $mobile, $input_data)
    {
        $setting = $this->getPublicInfo();
        if ($setting['sms_status'] == 1) {
            $siteSMS = $setting['sms_site'];
            $sms_api_key = $setting['sms_api_key'];
            $sms_secret_key = $setting['sms_secret_key'];
            $sms_number = $setting['sms_number'];

            if ($sms_api_key != "" and $pattern_code != "") {
                if ($siteSMS == "faraz") {
                    $client = new SoapClient("http://188.0.240.110/class/sms/wsdlservice/server.php?wsdl");
                    $result = $client->sendPatternSms($sms_number, array($mobile), $sms_api_key, $sms_secret_key, $pattern_code, $input_data);
                } else if ($siteSMS == "sms_ir") {
                    if ($sms_secret_key != "") {
                        $data = array(
                            "ParameterArray" => $input_data,
                            "Mobile" => $mobile,
                            "TemplateId" => $pattern_code,
                        );

                        $SmsIR_UltraFastSend = new SmsIR_UltraFastSend($sms_api_key, $sms_secret_key);
                        $result = $SmsIR_UltraFastSend->UltraFastSend($data);
                    } else {
                        $data = array(
                            "parameters" => $input_data,
                            "mobile" => $mobile,
                            "templateId" => $pattern_code,
                        );

                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://api.sms.ir/v1/send/verify',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => json_encode($data),
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Accept: text/plain',
                                'x-api-key: ' . $sms_api_key
                            ),
                        ));
                        $result = curl_exec($curl);
                        curl_close($curl);
                    }
                }

                return $result;
            }
        }
    }

    function getMethodsContacting($key="", $check_status = false)
    {
        $where = "mc_status in (0, 1)";
        if($check_status){
            $where = "mc_status=1";
        }

        if ($key == "") {
            $sql = "SELECT * FROM tbl_methods_contacting WHERE ".$where." ORDER BY mc_priority ASC";
            $result = self::doSelect($sql);

            $res = array();
            foreach ($result as $item) {
                $res[$item['mc_key']] = $item;
            }
            return $res;
        } else {
            $param = array($key);
            return self::doSelect("SELECT * FROM tbl_methods_contacting WHERE `mc_key`=?", $param, 1);
        }
    }

    function checkRedirectLink($link)
    {
        $sql = "SELECT * FROM tbl_redirect WHERE old_url=?";
        $result = $this->doSelect($sql, array($link));
        return $result;
    }

    function calViewer($item_id, $ip, $type)
    {
        $sql = "SELECT * FROM `tbl_view` WHERE `item_id` = ? AND `type` = ? AND `ip` = ? AND `date` = ?";
        $params = array($item_id, $type, $ip, self::jalali_date());
        $res = $this->doSelect($sql, $params);

        if (sizeof($res) == 0) {
            $sql = "INSERT INTO tbl_view (item_id,type,ip,date) VALUES (?,?,?,?)";
            $value = array($item_id, $type, $ip, self::jalali_date());
            $this->doQuery($sql, $value);

            if ($type == "blog") {
                $this->doQuery("UPDATE tbl_blog SET view=view+1 WHERE n_id=?", array($item_id));
            } else if ($type == "service") {
                $this->doQuery("UPDATE tbl_services SET s_view=s_view+1 WHERE s_id=?", array($item_id));
            } else if ($type == "faq") {
                $this->doQuery("UPDATE tbl_faq SET view=view+1 WHERE id=?", array($item_id));
            } else {
                $this->doQuery("UPDATE tbl_page SET view=view+1 WHERE p_id=?", array($item_id));
            }
        }
    }

    function getRelatedFaq($id, $type)
    {
        $sql = "SELECT f.* FROM tbl_faq f 
                    LEFT JOIN tbl_faq_related fr ON f.id=fr.faq_id
                    WHERE fr.item_id=? AND fr.type=? AND f.status=1 ORDER BY f.id DESC";
        $result = $this->doSelect($sql, array($id, $type));
        return $result;
    }

    function getProvinces()
    {
        $result = $this->doSelect("SELECT * FROM tbl_provinces WHERE pro_status=1");
        return $result;
    }

    function getCity($id)
    {
        $sql = "SELECT ci_id as id, ci_name as name FROM tbl_cities WHERE province_id=? and ci_status=1";
        $result = $this->doSelect($sql, array($id));

        return $result;
    }

    function getCityByProvince($post)
    {
        if (isset($post)) {
            $states = explode(",", $post['states']);
            foreach ($states as $id) {
                $sql = "SELECT ci_id as id, ci_name as name FROM tbl_cities WHERE province_id=? and ci_status=1";
                $result[] = $this->doSelect($sql, array($id));
            }

            if (sizeof($result) > 0) {
                echo json_encode($result);
            } else {
                echo "notfound";
            }
        }
    }

    function getContactSubject($check = TRUE)
    {
        if ($check) {
            $sql = "SELECT cs_id as id,cs_title as title FROM tbl_contact_subject WHERE cs_status=1";
        } else {
            $sql = "SELECT cs_id as id,cs_title as title FROM tbl_contact_subject";
        }
        return $this->doSelect($sql);
    }

    function getPayType($id = '', $justOneSelect = 1)
    {
        if ($id == "") {
            $sql = "SELECT * FROM tbl_payment_methods WHERE user_type=0 AND pay_status=1";
            return $this->doSelect($sql);
        } else {
            $sql = "SELECT * FROM tbl_payment_methods WHERE user_type=0 AND pay_status=1 AND pay_id=?";
            $params = array($id);
            if ($justOneSelect == 1) {
                return $this->doSelect($sql, $params, $justOneSelect);
            } else {
                return $this->doSelect($sql, $params);
            }
        }
    }

    function getMenuDisplay($type, $parent_id = 0)
    {
        $sql = "SELECT l_id,l_name as title,l_link as link,l_parent_id, l_menu_type as menu_type FROM tbl_link WHERE l_parent_id=? AND l_type=? AND l_status=? ORDER BY l_order";
        $params = array($parent_id, $type, 1);
        $result = self::doSelect($sql, $params);

        foreach ($result as &$value) {
            $subresult = $this->getMenuDisplay($type, $value["l_id"]);

            if (count($subresult) > 0) {
                $value['children'] = $subresult;
            }
        }
        unset($value);

        return $result;
    }

    function get_all_page_links($count, $page_Number, $href, $per_page, $get_params)
    {
        unset($get_params['url']); // delete url parameter;
        $params = http_build_query($get_params);
        $params = $params!="" ? "?".$params:"";

        $output = '';
        if (!isset($page_Number)) $page_Number = 1;
        if ($per_page != 0)
            $pages = ceil($count / $per_page);
        if ($pages > 1) {
            $output = '<div class="items-center justify-center sm:flex hidden">';
            if ($page_Number == 1) {
                $output .= '<div class="ml-3 opacity-60">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M6.64577 6.43275L2.05275 6.02655C1.02199 6.02655 0.186279 6.8704 0.186279 7.9112C0.186279 8.952 1.02199 9.79585 2.05275 9.79585L6.64577 9.38965C7.45439 9.38965 8.10996 8.7277 8.10996 7.9112C8.10996 7.09333 7.45439 6.43275 6.64577 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M22.0696 6.50741C21.9978 6.43492 21.7296 6.12856 21.4777 5.87418C20.0081 4.28084 16.1709 1.67543 14.1635 0.878077C13.8588 0.750884 13.0881 0.480085 12.675 0.460937C12.2808 0.460937 11.9043 0.552571 11.5453 0.733104C11.097 0.986123 10.7394 1.38548 10.5417 1.85596C10.4157 2.18147 10.218 3.15935 10.218 3.17713C10.0216 4.24528 9.91455 5.98222 9.91455 7.90243C9.91455 9.72964 10.0216 11.3955 10.1827 12.4814C10.2003 12.5005 10.3981 13.7137 10.6135 14.1294C11.0076 14.8899 11.7783 15.3603 12.6032 15.3603H12.675C13.2127 15.3426 14.3423 14.8707 14.3423 14.8543C16.2427 14.057 19.9891 11.5774 21.4953 9.92932C21.4953 9.92932 21.9206 9.50534 22.1048 9.24138C22.392 8.86117 22.5355 8.39069 22.5355 7.92021C22.5355 7.39503 22.3744 6.90677 22.0696 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= ' </div>';
            } else {
                $output .= '<a class="ml-3 hover:opacity-80" href="' . $href . "/page/" . ($page_Number - 1) . $params . '" data-turbolinks="false" wire:click.prevent="previousPage" rel="prev">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M6.64577 6.43275L2.05275 6.02655C1.02199 6.02655 0.186279 6.8704 0.186279 7.9112C0.186279 8.952 1.02199 9.79585 2.05275 9.79585L6.64577 9.38965C7.45439 9.38965 8.10996 8.7277 8.10996 7.9112C8.10996 7.09333 7.45439 6.43275 6.64577 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M22.0696 6.50741C21.9978 6.43492 21.7296 6.12856 21.4777 5.87418C20.0081 4.28084 16.1709 1.67543 14.1635 0.878077C13.8588 0.750884 13.0881 0.480085 12.675 0.460937C12.2808 0.460937 11.9043 0.552571 11.5453 0.733104C11.097 0.986123 10.7394 1.38548 10.5417 1.85596C10.4157 2.18147 10.218 3.15935 10.218 3.17713C10.0216 4.24528 9.91455 5.98222 9.91455 7.90243C9.91455 9.72964 10.0216 11.3955 10.1827 12.4814C10.2003 12.5005 10.3981 13.7137 10.6135 14.1294C11.0076 14.8899 11.7783 15.3603 12.6032 15.3603H12.675C13.2127 15.3426 14.3423 14.8707 14.3423 14.8543C16.2427 14.057 19.9891 11.5774 21.4953 9.92932C21.4953 9.92932 21.9206 9.50534 22.1048 9.24138C22.392 8.86117 22.5355 8.39069 22.5355 7.92021C22.5355 7.39503 22.3744 6.90677 22.0696 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= ' </a>';
            }

            $output .= ' <ul class="flex items-center flex-row">';
            if (($page_Number - 3) > 0) {
                if ($page_Number == 1) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= 1;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/1' . $params . '">';
                    $output .= 1;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            if (($page_Number - 3) > 1) {
                $output .= '<li class="mx-1">';
                $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white">';
                $output .= "...";
                $output .= '</span>';
                $output .= '</li>';
            }

            for ($i = ($page_Number - 2); $i <= ($page_Number + 2); $i++) {
                if ($i < 1) continue;
                if ($i > $pages) break;
                if ($page_Number == $i) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= $i;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/' . $i . $params . '">';
                    $output .= $i;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            if (($pages - ($page_Number + 2)) > 1) {
                $output .= '<li class="mx-1">';
                $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white">';
                $output .= "...";
                $output .= '</span>';
                $output .= '</li>';
            }
            if (($pages - ($page_Number + 2)) > 0) {
                if ($page_Number == $pages) {
                    $output .= '<li class="mx-1">';
                    $output .= '<span class="min-w-pagination h-8 flex items-center justify-center border border-gray-300 dark:bg-dark-930 dark:border-opacity-0 border-opacity-30 text-white bg-biscay-700 rounded">';
                    $output .= $pages;
                    $output .= '</span>';
                    $output .= '</li>';
                } else {
                    $output .= '<li class="mx-1">';
                    $output .= '<a class="min-w-pagination h-8 flex items-center justify-center border dark:text-gray-920 border-gray-300 border-opacity-30 text-biscay-700 rounded transition duration-200 hover:bg-biscay-650 hover:text-white" href="' . $href . '/page/' . $pages . $params . '">';
                    $output .= $pages;
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }

            $output .= '</ul>';

            if ($page_Number < $pages) {
                $output .= '<a class="mr-3 hover:opacity-80" href="' . $href . '/page/' . ($page_Number + 1) . $params . '" data-turbolinks="false" wire:click.prevent="nextPage" rel="next">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M16.6145 6.43275L21.2075 6.02655C22.2383 6.02655 23.074 6.8704 23.074 7.9112C23.074 8.952 22.2383 9.79585 21.2075 9.79585L16.6145 9.38965C15.8059 9.38965 15.1503 8.7277 15.1503 7.9112C15.1503 7.09333 15.8059 6.43275 16.6145 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M1.19065 6.50741C1.26243 6.43492 1.53062 6.12856 1.78255 5.87418C3.25216 4.28084 7.08938 1.67543 9.09672 0.878077C9.40147 0.750884 10.1722 0.480085 10.5853 0.460937C10.9794 0.460937 11.356 0.552571 11.7149 0.733104C12.1632 0.986123 12.5208 1.38548 12.7186 1.85596C12.8445 2.18147 13.0423 3.15935 13.0423 3.17713C13.2387 4.24528 13.3457 5.98222 13.3457 7.90243C13.3457 9.72964 13.2387 11.3955 13.0775 12.4814C13.0599 12.5005 12.8622 13.7137 12.6468 14.1294C12.2526 14.8899 11.4819 15.3603 10.6571 15.3603H10.5853C10.0476 15.3426 8.91793 14.8707 8.91793 14.8543C7.0176 14.057 3.27112 11.5774 1.76494 9.92932C1.76494 9.92932 1.33964 9.50534 1.15543 9.24138C0.868281 8.86117 0.724707 8.39069 0.724707 7.92021C0.724707 7.39503 0.885889 6.90677 1.19065 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= '</a>';
            } else {
                $output .= '<div class="mr-3 opacity-60">';
                $output .= '<svg class="text-biscay-700 dark:text-white" width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
                $output .= '<path opacity="0.4" d="M16.6145 6.43275L21.2075 6.02655C22.2383 6.02655 23.074 6.8704 23.074 7.9112C23.074 8.952 22.2383 9.79585 21.2075 9.79585L16.6145 9.38965C15.8059 9.38965 15.1503 8.7277 15.1503 7.9112C15.1503 7.09333 15.8059 6.43275 16.6145 6.43275" fill="currentColor"></path>';
                $output .= '<path d="M1.19065 6.50741C1.26243 6.43492 1.53062 6.12856 1.78255 5.87418C3.25216 4.28084 7.08938 1.67543 9.09672 0.878077C9.40147 0.750884 10.1722 0.480085 10.5853 0.460937C10.9794 0.460937 11.356 0.552571 11.7149 0.733104C12.1632 0.986123 12.5208 1.38548 12.7186 1.85596C12.8445 2.18147 13.0423 3.15935 13.0423 3.17713C13.2387 4.24528 13.3457 5.98222 13.3457 7.90243C13.3457 9.72964 13.2387 11.3955 13.0775 12.4814C13.0599 12.5005 12.8622 13.7137 12.6468 14.1294C12.2526 14.8899 11.4819 15.3603 10.6571 15.3603H10.5853C10.0476 15.3426 8.91793 14.8707 8.91793 14.8543C7.0176 14.057 3.27112 11.5774 1.76494 9.92932C1.76494 9.92932 1.33964 9.50534 1.15543 9.24138C0.868281 8.86117 0.724707 8.39069 0.724707 7.92021C0.724707 7.39503 0.885889 6.90677 1.19065 6.50741" fill="currentColor"></path>';
                $output .= '</svg>';
                $output .= '</div>';
            }

            $output .= '</div>';

            $output .= '<div class="flex sm:hidden items-center justify-between w-full flex-row-reverse">';

            if ($page_Number < $pages) {
                $output .= '<a href="' . $href . '/page/' . ($page_Number + 1) . $params . '" data-turbolinks="false" rel="next" class="border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه بعد';
                $output .= '</a>';
            } else {
                $output .= '<button rel="next" class="opacity-30 cursor-not-allowed border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه بعد';
                $output .= '</button>';
            }

            if ($page_Number == 1) {
                $output .= '<button disabled="" rel="prev" class="opacity-30 cursor-not-allowed border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه قبل';
                $output .= '</button>';
            } else {
                $output .= '<a href="' . $href . "/page/" . ($page_Number - 1) . $params . '" data-turbolinks="false" wire:click.prevent="previousPage" rel="prev" class="border border-gray-700 text-gray-700 rounded-md bg-white shadow-md py-2 px-6 font-medium text-base hover:text-white hover:bg-biscay-700 hover:border-white transition duration-200">';
                $output .= 'صفحه قبل';
                $output .= '</a>';
            }

            $output .= '</div>';
        }
        return $output;
    }

    function getCommentData($id, $type, $userId, $limit = 20)
    {
        $sql = "SELECT cm_id,cm_answer_id,cm_reply_admin_id,cm_date,cm_time,c_display_name,b.c_image,cm_text,l.cl_id as liked,
				(SELECT COUNT(cl_id) as count FROM tbl_comment_like WHERE comment_id=a.cm_id AND cl_type=?) as likeCount
                FROM tbl_comments a
                LEFT JOIN tbl_customer b ON a.cm_user_id=b.customer_vids_id
                LEFT JOIN tbl_comment_like l ON (a.cm_id=l.comment_id AND l.cl_type=? AND user_id='$userId')
                WHERE a.p_id=? AND a.cm_status=1 AND a.cm_type=? AND a.reply=0 ORDER BY cm_id DESC LIMIT " . $limit;
        $result = $this->doSelect($sql, array($type, $type, $id, $type));

        $res = array();
        $res['count'] = sizeof($result) > 0 ? sizeof($result) : 0;
        foreach ($result as $item) {
            $res['comments']["comment-" . $item['cm_id']]['comment'] = $item;

            $sql_reply = "SELECT cm_id,cm_answer_id,cm_reply_admin_id,cm_date,cm_time,c_display_name,b.c_image,cm_text,l.cl_id as liked,
				(SELECT COUNT(cl_id) as count FROM tbl_comment_like WHERE comment_id=a.cm_id AND cl_type=?) as likeCount
                FROM tbl_comments a
                LEFT JOIN tbl_customer b ON a.cm_user_id=b.customer_vids_id
                LEFT JOIN tbl_comment_like l ON (a.cm_id=l.comment_id AND l.cl_type=? AND user_id='$userId')
                WHERE a.p_id=? AND a.cm_status=1 AND a.cm_type=? AND a.cm_answer_id=? ORDER BY cm_id DESC";
            $reply = $this->doSelect($sql_reply, array($type, $type, $id, $type, $item['cm_id']));

            if (sizeof($reply) > 0) {
                $res['count'] = $res['count'] + sizeof($reply);
                $res['comments']["comment-" . $item['cm_id']]['reply'] = $reply;
            } else {
                $res['comments']["comment-" . $item['cm_id']]['reply'] = NULL;
            }
        }

        return $res;
    }

    function getProfileNotification($userId)
    {
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $result['service'] = $this->doSelect("SELECT count(*) as count FROM tbl_services_reservation WHERE user_id=? AND sre_status=0", array($userId));

        return $result;
    }

    function checkServiceTiming($serviceId, $date, $time, $userId)
    {
        //حذف زمان های منقضی شده
        $sql = "DELETE FROM tbl_services_reservation WHERE sre_timestamp_expire<? AND sre_status=0";
        $this->doQuery($sql, array(time()));

        $check_date = explode("_", $date);
        $dateInfo = jgetdate(jmktime(0, 0, 0, $check_date[1], $check_date[2], $check_date[0]), "", '', 'en');
        $days = array('saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday');
        $rows_select = 'st_turn_' . $days[$dateInfo['wday']];

        $sql = "SELECT * FROM tbl_services_timing WHERE service_id=?";
        $turn_status = $this->doSelect($sql, array($serviceId), 1);

        if ($turn_status[$rows_select] == "not_turn" || ($turn_status[$rows_select] == "holiday" && $turn_status['st_turn_holiday'] == "not_turn")) {
            return false;
        } else {
            if (jcheckdate($check_date[1], $check_date[2], $check_date[0])) {
                if ($turn_status[$rows_select] == "custom") {
                    $title_day = $days[$dateInfo['wday']];
                } else {
                    $title_day = $turn_status[$rows_select];
                }

                //چک کردن اینکه تاریخ و ساعت ورودی وجود داشته باشد
                if ($turn_status[$rows_select] == "custom_date") {
                    $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_status=1 AND sm_title_day=? AND sm_time_start=? AND sm_description=?";
                    $turns = $this->doSelect($sql, array($serviceId, $title_day, str_replace("_", ":", $time), str_replace("_", "/", $date)));
                } else {
                    $sql = "SELECT * FROM tbl_services_timing_manage_day WHERE service_id=? AND sm_status=1 AND sm_title_day=? AND sm_time_start=?";
                    $turns = $this->doSelect($sql, array($serviceId, $title_day, str_replace("_", ":", $time)));
                }
                if (sizeof($turns) > 0) {
                    //چک کردن ظرفیت نوبت
                    $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status!=6";
                    $reservationCount = $this->doSelect($sql, array($serviceId, str_replace("_", "/", $date), str_replace("_", ":", $time)));

                    $sql = "SELECT COUNT(*) as count FROM tbl_services_reservation WHERE service_id=? AND sre_date=? AND sre_time=? AND sre_status=0 AND user_id=?";
                    $reservationUserCount = $this->doSelect($sql, array($serviceId, str_replace("_", "/", $date), str_replace("_", ":", $time), $userId));

                    if ($turns['0']['sm_capacity'] >= ($reservationCount[0]['count'] + 1) or $reservationUserCount[0]['count'] > 0) {
                        return array(
                            "status" => true,
                            "day" => $dateInfo['weekday'],
                            "capacity" => $turns['0']['sm_capacity'],
                            "description" => $turns['0']['sm_description'],
                            "turn_type" => $turn_status[$rows_select],
                            "is_vip" => (int)$turns['0']['sm_vip']
                        );
                    } else {
                        return array(
                            "status" => false,
                            "is_vip" => "0"
                        );
                    }
                } else {
                    return array(
                        "status" => false,
                        "is_vip" => "0"
                    );
                }
            } else {
                return array(
                    "status" => false,
                    "is_vip" => "0"
                );
            }
        }
    }

    function getBookingLatestActivity($order_id)
    {
        $sql = "SELECT srl.*,u.a_name as name FROM tbl_services_reservation_log srl
                LEFT JOIN tbl_admin u ON srl.admin_id=u.a_id
                WHERE srl.reservation_id = ? ORDER BY srl.idusr_activity DESC";
        $result = $this->doSelect($sql, array($order_id));

        return $result;
    }

    function getBookingData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $select_one = False)
    {
        $sql = "SELECT sre.*,u.*,r.title as statusTitle,r.percent,r.background_color,s.s_title,s.s_cover,s.s_slug,b.b_name,ss.name,p.pay_title
                    FROM tbl_services_reservation sre
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    LEFT JOIN tbl_customer u ON sre.user_id=u.customer_vids_id
                    LEFT JOIN tbl_branches b ON sre.branch_id=b.branch_vids_id
                    LEFT JOIN tbl_payment_methods p ON sre.payment_method_id=p.pay_id
                    LEFT JOIN tbl_services_staff ss ON sre.staff_id=ss.staff_vids_id
                    LEFT JOIN tbl_status r ON sre.sre_status=r.id
                    WHERE $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }

    function getBlogData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $join = '', $select_one = False)
    {
        $sql = "SELECT a.*,b.name,b.link,d.title AS sourceName,d.image AS sourceImg,d.title AS sourceName,d.link AS sourceLink,e.a_name AS writer,e.a_id AS writerId,e.a_image as writerImage,e.a_desc as writerDesc,ar.ar_title as writerRole,
                    (SELECT COUNT(cm_id) FROM `tbl_comments` WHERE cm_status=1 AND cm_type='blog' AND p_id=a.n_id) as commentCount,
					(SELECT COUNT(l_id) as count FROM tbl_like WHERE item_id=a.n_id AND l_type='blog') as likeCount, l.l_id as liked,
					(SELECT COUNT(b_id) as count FROM tbl_bookmarks WHERE item_id=a.n_id AND b_type='blog') as bookmarkCount, bo.b_id as bookmarked
                    FROM tbl_blog a
                    LEFT JOIN tbl_category b ON a.cat_id=b.id
                    LEFT JOIN tbl_sources d ON a.source=d.so_id
                    LEFT JOIN tbl_admin e ON a.writer=e.a_id
                    LEFT JOIN tbl_admin_role ar ON e.admin_role_id=ar.ar_id
                    LEFT JOIN tbl_like l ON (a.n_id=l.item_id AND l.l_type='blog' AND l.user_id='$userId')
                    LEFT JOIN tbl_bookmarks bo ON (a.n_id=bo.item_id AND bo.b_type='blog' AND bo.user_id='$userId')
                    $join
                    $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }

    function getServiceData($print_query = False, $userId = False, $where = '', $order = '', $limit = '', $input = array(), $join = '', $select_one = False)
    {
        $sql = "SELECT s.*,
                    (SELECT COALESCE(AVG(r_rate), 0) FROM `tbl_rating` WHERE r_type='service' AND item_id=s.s_id) as rating, 
                    (SELECT case when l_id is null then '0' else '1' end isset FROM tbl_like WHERE user_id='$userId' AND item_id=s.s_id AND l_type='service') as liked, 
                    (SELECT COUNT(l_id) as count FROM tbl_like WHERE item_id=s.s_id AND l_type='service') as likeCount,
                    (SELECT case when b_id is null then '0' else '1' end isset FROM tbl_bookmarks WHERE user_id='$userId' AND item_id=s.s_id AND b_type='service') as bookmarked,                                 
                    (SELECT COUNT(b_id) as count FROM tbl_bookmarks WHERE item_id=s.s_id AND b_type='service') as bookmark_count
                    FROM tbl_services s
                    LEFT JOIN tbl_like l ON (s.s_id=l.item_id AND l.l_type='service' AND user_id='$userId')
                    $join
                    $where $order $limit";

        if ($print_query) {
            file_put_contents("query.json", print_r($sql, true));
        }

        if ($select_one) {
            $result = $this->doSelect($sql, $input, 1);
        } else {
            $result = $this->doSelect($sql, $input);
        }

        return $result;
    }
}