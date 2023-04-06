<?php

trait viewsModelTrait
{
    function publicData($id = '')
    {
        $sql = "SELECT count(*) AS num FROM tbl_comments WHERE cm_status=0";
        $result['newComments'] = $this->doSelect($sql);

        $sql = "SELECT count(*) AS num FROM tbl_contact WHERE co_status=0";
        $result['newContact'] = $this->doSelect($sql);

        $sql = "SELECT count(*) AS num FROM tbl_services_reservation WHERE sre_status=1";
        $result['newReserve'] = $this->doSelect($sql);

        $sql = "SELECT sre.*,s.s_title,c.c_display_name FROM tbl_services_reservation sre
                    LEFT JOIN tbl_services s ON sre.service_id=s.s_id
                    LEFT JOIN tbl_customer c ON sre.user_id=c.customer_vids_id
                    WHERE sre.sre_status!=0 and sre.sre_date=? ORDER  BY sre.sre_time ASC";
        $result['todayReserve'] = $this->doSelect($sql, array(self::jaliliDate()));

        $totalReserve = 0;
        for ($i = 1; $i <= 7; $i++) {
            $new_date = self::JalaliAfter(self::jaliliDate(), $i);
            $date_split = explode("/", $new_date);

            $time = jmktime(0, 0, 0, $date_split['1'], $date_split['2'], $date_split['0']);
            $dateInfo = jgetdate($time, "", '', 'en');
            $result['weekReserve'][$i]['title'] = $dateInfo['weekday'];
            $result['weekReserve'][$i]['date'] = $new_date;

            $sql = "SELECT count(*) as num FROM tbl_services_reservation WHERE sre_status!=0 and sre_date=?";
            $res = $this->doSelect($sql, array($new_date), 1);
            $result['weekReserve'][$i]['count'] = $res['num'];
            $totalReserve += $res['num'];
        }
        $result['weekReserve']['total'] = $totalReserve;

        $cost_type = $this->doSelect("SELECT count(*) AS num FROM tbl_cost_type");
        $cost_type['0']['num'] == 0 ? $result['request']["cost_type"] = true : "";

        $banks = $this->doSelect("SELECT count(*) AS num FROM tbl_banks WHERE b_status=1");
        $banks['0']['num'] == 0 ? $result['request']["banks"] = true : "";

        $cash = $this->doSelect("SELECT count(*) AS num FROM tbl_cash WHERE c_status=1");
        $cash['0']['num'] == 0 ? $result['request']["cash"] = true : "";

        $storeroom_list = $this->doSelect("SELECT count(*) AS num FROM tbl_storeroom WHERE s_status=1");
        $storeroom_list['0']['num'] == 0 ? $result['request']["storeroom_list"] = true : "";

        $branch = $this->doSelect("SELECT count(*) AS num FROM tbl_branches WHERE b_status=1");
        $branch['0']['num'] == 0 ? $result['request']["branches"] = true : "";

        $sources = $this->doSelect("SELECT count(*) AS num FROM tbl_sources WHERE status=1");
        $sources['0']['num'] == 0 ? $result['request']["sources"] = true : "";

        $payment_methods = $this->doSelect("SELECT count(*) AS num FROM tbl_payment_methods WHERE pay_status=1");
        $payment_methods['0']['num'] == 0 ? $result['request']["payment_methods"] = true : "";

        $status = $this->doSelect("SELECT count(*) AS num FROM tbl_status WHERE `code` IS NULL AND `type` = 'service'");
        $status['0']['num'] > 0 ? $result['request']["status"] = true : "";

        return $result;
    }

    function getDashboardItems($adminId)
    {
        $sql = "SELECT a_selected_dashboard_id FROM tbl_admin WHERE a_id=?";
        $dashboard = $this->doSelect($sql, array($adminId), 1);

        $sql = "SELECT data_item FROM tbl_page WHERE link=?";
        $dashboard_selected = $this->doSelect($sql, array($dashboard['a_selected_dashboard_id']), 1);

        $view_data = $this->make_dashboard($adminId, $dashboard_selected['data_item']);

        return $view_data;
    }

    private function make_dashboard($adminId, $elements)
    {
        $view = "";
        if ($elements) {
            $elements = json_decode($elements, true);
            foreach ($elements as $element) {
                $view .= "<div class='row'>";

                $columns = $this->get_array_value((array)$element, "columns");
                $column_ratio = explode("-", $this->get_array_value((array)$element, "ratio"));

                if ($columns) {
                    foreach ($columns as $key => $value) {
                        $view .= "<div class='col-md-" . $this->_get_column_class_value($key, $columns, $column_ratio) . "'>";
                        foreach ($value as $content) {
                            $widget = $this->get_array_value((array)$content, "widget");
                            if ($widget) {
                                $view .= $this->_make_dashboard_widgets($adminId, $widget);
                            }
                        }
                        $view .= "</div>";
                    }
                }

                $view .= "</div>";
            }
            return $view;
        }
    }

    function _make_widgets($dashboard_id = 1)
    {
        $default_widgets_array = $this->doSelect("SELECT t_href FROM tbl_template WHERE t_part=?", array("dashboard"));
        $widgets_array = array();
        foreach ($default_widgets_array as $item) {
            $widgets_array[] = $item['t_href'];
        }

        //when its edit mode, we have to remove the widgets which have already in the dashboard
        $dashboard_selected = $this->doSelect("SELECT data_item FROM tbl_page WHERE p_id=?", array($dashboard_id), 1);
        $dashboard_elements_array = json_decode($dashboard_selected['data_item'], true);

        if ($dashboard_elements_array) {
            foreach ($dashboard_elements_array as $element) {
                $columns = $this->get_array_value((array)$element, "columns");
                if ($columns) {
                    foreach ($columns as $contents) {
                        foreach ($contents as $content) {
                            $widget = $this->get_array_value((array)$content, "widget");
                            if (in_array($widget, $widgets_array)) {
                                $widgets_array = $this->array_remove_by_value($widgets_array, $widget);
                            }
                        }
                    }
                }
            }
        }

        return $this->_make_widgets_row($widgets_array);
    }

    function _make_widgets_row($widgets_array = array(), $permissions_array = array())
    {
        $widgets = "";

        foreach ($widgets_array as $key => $value) {
            $error_class = "";
            if (count($permissions_array) && !is_numeric($key) && !$this->get_array_value($permissions_array, $key)) {
                $error_class = "error";
            }

            if (is_numeric($key)) {
                $data_value = $value;
            } else {
                $data_value = $key;
            }

            $widgets .= "<div data-value=" . $data_value . " class='mb5 widget clearfix p10 bg-white $error_class'>";
            $widgets .= $this->_widgets_row_data(array($key => $value));
            $widgets .= "</div>";
        }

        if ($widgets) {
            return $widgets;
        } else {
            return "<span class='text-off empty-area-text'>ویجت دیگری در دسترس نیست</span>";
        }
    }

    private function _widgets_row_data($widget_array)
    {
        $key = key($widget_array);
        $value = $widget_array[key($widget_array)];
        if (is_numeric($key)) {
            $template_href = $value;
        } else {
            $template_href = $key;
        }

        $result = $this->doSelect("SELECT * FROM tbl_template WHERE t_href=?", array($template_href), 1);
        $widget_render = "";

        if ($result['t_image'] != NULL) {
            $widget_render .= '<img id="widget-image" src="public/images/template/' . $result['t_theme'] . '/' . $result['t_image'] . '" alt="widget" class="w-100" style="width:100%">';
        }
        $widget_render .= "<span class='float-start text-right' style='margin-top: 5px;'>";
        $widget_render .= $result['t_title'];
        $widget_render .= '<a style="margin: 1px 1px 1px 3px;" title="جابه جا کردن ویجت" class="btn btn-primary btn-xs"><i class="fa fa-arrows"></i></a>';
        $widget_render .= '</span>';
        $widget_render .= '<span class="float-end">';
        if ($result['t_is_custom']) {
            $widget_render .= '<a style="margin: 1px;" data-toggle="modal" data-target="#edit-Modal" title="' . $result['t_title'] . '" data-id="' . $result['t_id'] . '" data-title="' . $result['t_title'] . '" data-show_title="' . $result['t_show_title'] . '" data-description="' . $result['t_description'] . '" data-post-widget="' . $result['t_href'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></a>';
            $widget_render .= '<a style="margin: 1px;" title="حذف ویجت" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $result['t_id'] . '" data-id="' . $result['t_id'] . '" data-title="' . $result['t_title'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>';
        }
        $widget_render .= '</span>';

        return $widget_render;
    }

    function _make_editable_rows($dashboard_id = 1)
    {
        $dashboard_selected = $this->doSelect("SELECT data_item FROM tbl_page WHERE p_id=?", array($dashboard_id), 1);
        $elements = json_decode($dashboard_selected['data_item'], true);
        $view = "";

        if ($elements) {
            foreach ($elements as $element) {
                $column_ratio = $this->get_array_value((array)$element, "ratio");
                $column_ratio_explode = explode("-", $column_ratio);

                $view .= "<row class='widget-row clearfix d-flex bg-white' data-column-ratio='" . $column_ratio . "'>";
                $view .= "<div class='float-start row-controller text-off font-16'>";
                $view .= '<span class="move"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu icon-16"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></span>';
                $view .= '<span class="delete delete-widget-row"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span>';
                $view .= "</div>";

                $view .= "<div class = 'float-start clearfix row-container row pr15 pl15'>";

                $columns = $this->get_array_value((array)$element, "columns");

                if ($columns) {
                    foreach ($columns as $key => $value) {
                        $column_class_value = $this->_get_column_class_value($key, $columns, $column_ratio_explode);
                        $view .= "<div class = 'pr0 pl15 widget-column col-md-" . $column_class_value . " col-sm-" . $column_class_value . "'>
                                    <div id = 'add-column-panel-" . rand(500, 10000) . "' class = 'add-column-panel add-column-drop text-center p15'>";

                        foreach ($value as $content) {
                            $widget_value = $this->get_array_value((array)$content, "widget");
                            $view .= $this->_make_widgets_row(array($widget_value => $this->get_array_value((array)$content, "title")));
                        }

                        $view .= "</div></div>";
                    }
                }
                $view .= "</div></row>";
            }
            return $view;
        }
    }

    private function _get_column_class_value($key, $columns, $column_ratio)
    {
        $columns_array = array(1 => 12, 2 => 6, 3 => 4, 4 => 3);

        $column_count = count($columns);
        $column_ratio_count = count($column_ratio);

        $class_value = $column_ratio[$key];

        if ($column_count < $column_ratio_count) {
            $class_value = $columns_array[$column_count];
        }

        return $class_value;
    }

    private function _make_dashboard_widgets($adminId, $widget = "")
    {
        $widget_name = $widget;
        if ($widget == "credit_sms_panel") {
            $check_admin_permission = $this->admin_permission_check("dashboard_sms_info_view", $adminId);
            $getCreditInfo = $this->getCreditInfo();
            $getSmsSite = $this->getPublicInfo("sms_site");
        } else if ($widget == "chart_reservation_this_month") {
            $check_admin_permission = $this->admin_permission_check("service_reservation_list_view", $adminId);
            $getReservationStatOrder = $this->getReservationStatOrder(NULL, NULL);
        } else if ($widget == "last_activity") {
            $latestActivity = $this->latestActivity($adminId);
        } else if ($widget == "last_users_register") {
            $check_admin_permission = $this->admin_permission_check("users_list_view", $adminId);
            $userGetlatest = $this->userGetlatest(12);
        } else if ($widget == "last_blog_article") {
            $check_admin_permission = $this->admin_permission_check("blog_list_view", $adminId);
            $latestNews = $this->latestNews();
        } else if ($widget == "count_reservation_this_month") {
            $check_admin_permission = $this->admin_permission_check("service_reservation_list_view", $adminId);
            $bannerTop = $this->bannerTop(NULL, NULL, $widget);
        } else if ($widget == "count_users_this_month") {
            $check_admin_permission = $this->admin_permission_check("users_list_view", $adminId);
            $bannerTop = $this->bannerTop(NULL, NULL, $widget);
        } else if ($widget == "clock") {
            $clock_style_version = 1;
        } else if ($widget == "clock2") {
            $clock_style_version = 2;
        } else { // for custom widget
            $widget_name = "custom-widget";
        }

        $help = $this->doSelect("SELECT * FROM tbl_template WHERE t_href=?", array($widget), 1);

        ob_start();
        include('app/views/admin/template/' . $widget_name . '.php');
        return ob_get_clean();
    }

    function getMenuFullListWithAccess($parent_id = 0)
    {
        $sql = "SELECT * FROM tbl_sidebar WHERE s_parent_id=? ORDER BY s_order";
        $result = $this->doSelect($sql, array($parent_id));

        foreach ($result as &$value) {
            $sql = "SELECT * FROM tbl_sidebar_access_list WHERE sidebar_id_part=?";
            $value['access'] = $this->doSelect($sql, array($value["s_id"]));

            $sub_result = $this->getMenuFullListWithAccess($value["s_id"]);
            if (count($sub_result) > 0) {
                $value['children'] = $sub_result;
            }
        }
        unset($value);

        return $result;
    }

    function getMenuFullList($type, $parent_id = 0)
    {
        if ($type == "sidebar") {
            $sql = "SELECT * FROM tbl_sidebar WHERE s_parent_id=? ORDER BY s_order";
            $params = array($parent_id);
        } else {
            $sql = "SELECT l_id,l_name,l_link,l_parent_id,l_status FROM tbl_link WHERE l_parent_id=? AND l_type=? ORDER BY l_order";
            $params = array($parent_id, $type);
        }
        $result = $this->doSelect($sql, $params);

        foreach ($result as &$value) {
            if ($type == "sidebar") {
                $subresult = $this->getMenuFullList($type, $value["s_id"]);
            } else {
                $subresult = $this->getMenuFullList($type, $value["l_id"]);
            }

            if (count($subresult) > 0) {
                $value['children'] = $subresult;
            }
        }
        unset($value);

        return $result;
    }

    function getMenuSidebar($admin, $parent_id = 0)
    {
        $sidebar_menu_allow_access = array();
        $sql = "SELECT a.*,ar.ar_title FROM tbl_admin a
                    LEFT JOIN tbl_admin_role ar ON a.admin_role_id=ar.ar_id
                    WHERE a.a_id=? AND a.a_status=1";
        $admin_info = $this->doSelect($sql, array($admin), 1);

        $sql = "SELECT * FROM tbl_sidebar WHERE s_parent_id=? AND s_status=1 ORDER BY s_order";
        $result = $this->doSelect($sql, array($parent_id));

        foreach ($result as &$value) {
            $value['access']['count'] = 0;
            if ($admin_info['admin_role_id'] != 1) {
                $sql = "SELECT s.* FROM tbl_admin_role_access a 
                            LEFT JOIN tbl_sidebar_access_list s ON a.path=s.sal_permisson
                            WHERE a.role_id=? AND s.sidebar_menu_id=?";
                $access_list = $this->doSelect($sql, array($admin_info['admin_role_id'], $value["s_id"]));

                if (sizeof($access_list) <= 0) {
                    $sql = "SELECT s.* FROM tbl_admin_role_access a 
                                LEFT JOIN tbl_sidebar_access_list s ON a.path=s.sal_permisson
                                WHERE a.role_id=? AND s.sidebar_id_main_part=?";
                    $access_list = $this->doSelect($sql, array($admin_info['admin_role_id'], $value["s_id"]));
                }

                if (sizeof($access_list) <= 0) {
                    $sql = "SELECT s.* FROM tbl_admin_role_access a 
                            LEFT JOIN tbl_sidebar_access_list s ON a.path=s.sal_permisson
                            WHERE a.role_id=? AND s.sidebar_id_part=?";
                    $access_list = $this->doSelect($sql, array($admin_info['admin_role_id'], $value["s_id"]));
                }

                $value['access']['count'] = sizeof($access_list);
                $value['access']['list'] = array_column($access_list, 'sal_permisson');
            }

            $sub_result = $this->getMenuSidebar($admin, $value["s_id"]);
            if (count($sub_result) > 0) {
                $value['children'] = $sub_result;
            }

            if ($value['access']['count'] > 0 or $admin_info['admin_role_id'] == 1) {
                $sidebar_menu_allow_access[] = $value;
            }
        }
        unset($value);

        return $sidebar_menu_allow_access;
    }

    function getMenuSidebar_($parent_id = 0)
    {
        $sidebar_menu_allow_access = array();
        $sql = "SELECT * FROM tbl_sidebar WHERE s_parent_id=? AND s_status=1 ORDER BY s_order";
        $result = $this->doSelect($sql, array($parent_id));

        foreach ($result as &$value) {
            $sql = "SELECT * FROM tbl_sidebar_access_list WHERE sidebar_menu_id=?";
            $access_list = $this->doSelect($sql, array($value["s_id"]));

            if (sizeof($access_list) <= 0) {
                $sql = "SELECT * FROM tbl_sidebar_access_list WHERE sidebar_id_main_part=?";
                $access_list = $this->doSelect($sql, array($value["s_id"]));
            }

            $value['access']['count'] = sizeof($access_list);
            $value['access']['list'] = array_column($access_list, 'sal_permisson');

            $sub_result = $this->getMenuSidebar_($value["s_id"]);
            if (count($sub_result) > 0) {
                $value['children'] = $sub_result;
            }

            if (true) {
                $sidebar_menu_allow_access[] = $value;
            }
        }
        unset($value);

        return $result;
    }

    function saveMenuList($type, $list, $parent_id = 0, $order = 0)
    {
        try {
            if ($type == "sidebar") {
                $sql = "UPDATE tbl_sidebar SET s_parent_id=?, s_order=? WHERE s_id=?";
            } else {
                $sql = "UPDATE tbl_link SET l_parent_id=?, l_order=? WHERE l_id=?";
            }
            foreach ($list as $item) {
                $order++;

                $this->doQuery($sql, array($parent_id, $order, $item["id"]));

                if (array_key_exists("children", $item)) {
                    $this->saveMenuList($type, $item["children"], $item["id"], $order);
                }
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addLink($post)
    {
        try {
            if (isset($post['part'])) {
                $ids = explode(",", $post['checkedValues']);
                $counter = 0;
                foreach ($ids as $id) {
                    if ($post['part'] == "page") {
                        $info = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=?", array($id), 1);
                        $title = $info['title'];
                        $link = $info['link'];
                    } else if ($post['part'] == "category") {
                        $info = $this->doSelect("SELECT * FROM tbl_category WHERE id=?", array($id), 1);
                        $title = $info['name'];
                        $link = "blog/category/" . $info['id'] . "/" . str_replace(" ", "-", $info['name']);
                    } else if ($post['part'] == "blog") {
                        $info = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($id), 1);
                        $title = $info['title'];
                        $link = "blog/category/" . $info['id'] . "/" . str_replace(" ", "-", $info['title']);
                    } else if ($post['part'] == "services") {
                        $_where = "WHERE s.s_id=?";
                        $_input = array($id);
                        $_order = "";
                        $_limit = "";
                        $_join = "";
                        $info = $this->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

                        $title = $info['s_title'];
                        $link = "services/" . $info['s_slug'];
                    }

                    $sql = "SELECT * FROM tbl_link WHERE l_name=? AND l_link=? AND l_type=?";
                    $param = array($title, $link, $post['type']);
                    $result = $this->doSelect($sql, $param);

                    if (sizeof($result) == 0) {
                        $order = $this->doSelect("SELECT MAX(l_order) as l_order FROM tbl_link WHERE l_parent_id=0 AND l_type=?", array($post['type']));
                        $sql2 = "INSERT INTO tbl_link (l_name, l_link, l_type, l_order) VALUES (?,?,?,?)";
                        $params = [$title, $link, $post['type'], ($order[0]['l_order'] + 1)];
                        $this->doQuery($sql2, $params);

                        $this->ActivityLog("افزودن " . $post['title'] . " در بخش لینک ها");
                        $counter++;
                    }
                }
                if ($counter == sizeof($ids)) {
                    $this->response_success("لینک جدید با موفقیت ثبت شد");
                } else {
                    $this->response_warning("تعدادی از لینک های انتخابی با موفقیت ثبت ولی تعدادی از لینک ها از قبل ثبت شده اند و مجدد ثبت نشدند", "someLinkExist");
                }
            } else {
                $sql = "SELECT * FROM tbl_link WHERE l_name=? AND l_link=? AND l_type=?";
                $param = array($post['title'], $post['slug'], $post['type']);
                $result = $this->doSelect($sql, $param);

                if (sizeof($result) > 0) {
                    $this->response_warning("لینک دیگری با این مشخصات قبلا ثبت شده است", "exist");
                } else {
                    $order = $this->doSelect("SELECT MAX(l_order) as l_order FROM tbl_link WHERE l_parent_id=0 AND l_type=?", array($post['type']));

                    $sql2 = "INSERT INTO tbl_link (l_name, l_link, l_type, l_order) VALUES (?,?,?,?)";
                    $params = [$post['title'], $post['slug'], $post['type'], ($order[0]['l_order'] + 1)];
                    $this->doQuery($sql2, $params);

                    $this->ActivityLog("افزودن " . $post['title'] . " در بخش لینک ها");
                    $this->response_success("لینک " . $post['title'] . " با موفقیت ثبت شد");
                }
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusLink($post)
    {
        try {
            if ($post['type'] == "sidebar") {
                $this->doQuery("UPDATE tbl_sidebar SET s_status=(case when s_status=1 then 0 else 1 end) WHERE s_id=?", array($post['id']));

                $result = $this->doSelect("SELECT s_status, s_name FROM tbl_sidebar WHERE s_id=?", array($post['id']), 1);

                if ($result['s_status'] == 1) {
                    $this->ActivityLog("فعالسازی وضعیت " . $result['name'] . " در منوی سایدبار");
                    $this->response_success("لینک مورد نظر باموفقیت فعال شد", "active");
                } else {
                    $this->ActivityLog("غیرفعالسازی وضعیت " . $result['name'] . " در منوی سایدبار");
                    $this->response_success("لینک مورد نظر باموفقیت غیرفعال شد", "deactive");
                }
            } else {
                $this->doQuery("UPDATE tbl_link SET l_status=(case when l_status=1 then 0 else 1 end) WHERE l_id=?", array($post['id']));

                $pos = "فوتر";
                if ($post['type'] == "header") {
                    $pos = "هدر";
                }

                $result = $this->doSelect("SELECT l_status, l_name FROM tbl_link WHERE l_id=?", array($post['id']), 1);

                if ($result['l_status'] == 1) {
                    $this->ActivityLog("فعالسازی وضعیت " . $result['l_name'] . " در " . $pos);
                    $this->response_success("لینک مورد نظر باموفقیت فعال شد", "active");
                } else {
                    $this->ActivityLog("غیرفعالسازی وضعیت " . $result['l_name'] . " در " . $pos);
                    $this->response_success("لینک مورد نظر باموفقیت غیرفعال شد", "deactive");
                }
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editLink($post)
    {
        try {
            if ($post['type'] == "sidebar") {
                $sql = "SELECT * FROM tbl_sidebar WHERE s_id=?";
            } else {
                $sql = "SELECT * FROM tbl_link WHERE l_id=?";
            }
            $result = $this->doSelect($sql, array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("لینک مورد نظر یافت نشد");
            } else {
                if ($post['type'] == "sidebar") {
                    $sql = "UPDATE tbl_sidebar SET s_name=?, s_link=?  WHERE s_id=?";
                } else {
                    $sql = "UPDATE tbl_link SET l_name=?, l_link=?  WHERE l_id=?";
                }
                $params = [$post['titleEdit'], $post['slugEdit'], $post['id']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات لینک " . $post['titleEdit']);
                $this->response_success("لینک " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delLink($post)
    {
        try {
            if ($post['type'] == "sidebar") {
                $result = $this->doSelect("SELECT s_name FROM tbl_sidebar WHERE s_id=?", array($post['id']));
                $this->doQuery("UPDATE tbl_sidebar SET s_parent_id=0 WHERE s_parent_id=?", [$post['id']]);
                $this->doQuery("DELETE FROM tbl_sidebar WHERE s_id=?", array($post['id']));

                $this->ActivityLog("حذف لینک " . $result['0']['s_name']);
                $this->response_success("لینک " . $result['0']['s_name'] . " باموفقیت حذف شد");
            } else {
                $result = $this->doSelect("SELECT l_name FROM tbl_link WHERE l_id=?", array($post['id']));
                $this->doQuery("UPDATE tbl_link SET l_parent_id=0 WHERE l_parent_id=? AND l_type=?", [$post['id'], $post['type']]);
                $this->doQuery("DELETE FROM tbl_link WHERE l_id=?", array($post['id']));

                $this->ActivityLog("حذف لینک " . $result['0']['l_name']);
                $this->response_success("لینک " . $result['0']['l_name'] . " باموفقیت حذف شد");
            }

        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getTemplates($part = 'main')
    {
        $sql = "SELECT * FROM tbl_template WHERE t_status=1 AND t_part=? ORDER BY t_id ASC";
        $result = $this->doSelect($sql, array($part));
        return $result;
    }

    function getPageInfo($attrId = '')
    {
        if ($attrId == '') {
            $sql = "SELECT * FROM tbl_page WHERE p_status=1";
            $result = $this->doSelect($sql);
        } else {
            $sql = "SELECT * FROM tbl_page WHERE p_id=?";
            $result = $this->doSelect($sql, array($attrId), 1);
        }

        return $result;
    }

    function getPageAjax($get)
    {
        $columns = array(
            array('db' => 'p_id', 'dt' => 0),
            array('db' => 'title', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return $this->summary($d, 75);
                }
            ),
            array('db' => 'cover', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    $file = '<img onerror="this.src=\'public/images/default_cover.jpg\'" width="80px" height="50px" src="public/images/page/' . $d . '">';

                    return $file;
                }
            ),
            array('db' => 'view', 'dt' => 3),
            array('db' => 'a_name', 'dt' => 4),
            array('db' => 'date_created', 'dt' => 5),
            array(
                'db' => 'p_status', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['p_id'] . '" data-id="' . $row['p_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else if ($d == 0) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['p_id'] . '" data-id="' . $row['p_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    } else {
                        return '<button class="btn btn-success btn-xs">فعال</button>';
                    }
                }
            ),
            array(
                'db' => 'p_id', 'dt' => 7,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    if ($row['type'] == "dashboard") {
                        $btn = '<a style="margin: 1px;" class="btn btn-success btn-xs" target="_blank" href="' . URL . ADMIN_PATH . '/dashboard"><i class="fa fa-eye"></i></a>';
                    } else {
                        if ($row['p_status'] == 1 || $row['p_status'] == 2) {
                            $btn = '<a style="margin: 1px;" class="btn btn-success btn-xs" target="_blank" href="' . URL . $row['link'] . '"><i class="fa fa-eye"></i></a>';
                        } else {
                            $btn = '<a  style="margin: 1px;"class="btn btn-success btn-xs" target="_blank" href="' . URL . 'preview/' . $row['link'] . '"><i class="fa fa-eye"></i></a>';
                        }
                    }
                    $btn .= '<a style="margin: 1px;" title="ویرایش برگه" class="btn btn-warning btn-xs" href="' . ADMIN_PATH . '/pages/edit/' . $row['p_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    if ($row['removable'] == 1) {
                        $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $row['p_id'] . '" data-id="' . $row['p_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    }
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT a.*,d.a_name FROM tbl_page a
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(p_id) FROM tbl_page a
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(p_id) FROM tbl_page a
                LEFT JOIN tbl_admin d
                ON a.writer=d.a_id"
        );
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addPage($post, $admin)
    {
        try {
            $sql = "SELECT * FROM tbl_page WHERE link=?";
            $param = array($post['slug']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("صفحه دیگری با این آدرس قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/page/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql = "INSERT INTO tbl_page (writer,title,link,metaDescription,cover,main_tag,description,date_created,time,p_status) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $params = [$admin, $post['title'], $post['slug'], $post['metaDescription'], $coverImg, $post['mainKeyword'], htmlspecialchars($post['desc']), $this->jaliliDate(), $this->jaliliDate("H:i"), $post['status']];
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در بخش برگه ها");
                $this->response_success("برگه جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editPage($post, $admin)
    {
        $result = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=?", array($post['id']));

        if (sizeof($result) <= 0) {
            $this->response_error("برگه مورد نظر یافت نشد");
        } else {
            $dirCover = "public/images/page/";

            $coverImg = NULL;
            if (isset($_FILES["cover"]["tmp_name"])) {
                unlink($dirCover . $result[0]['cover']);
                $coverImg = time() . "_" . $_FILES["cover"]["name"];
                move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
            }

            if (isset($_FILES["cover"]["name"])) {
                $sql2 = "UPDATE tbl_page SET title=?, link=?, metaDescription=?, cover=?, main_tag=?, description=?, p_status=? WHERE p_id=?";
                $params = [$post['title'], $post['slug'], $post['metaDescription'], $coverImg, $post['mainKeyword'], htmlspecialchars($post['desc']), $post['status'], $post['id']];
            } else {
                $sql2 = "UPDATE tbl_page SET title=?, link=?, metaDescription=?, main_tag=?, description=?, p_status=? WHERE p_id=?";
                $params = [$post['title'], $post['slug'], $post['metaDescription'], $post['mainKeyword'], htmlspecialchars($post['desc']), $post['status'], $post['id']];
            }
            $this->doQuery($sql2, $params);

            $this->ActivityLog("ویرایش " . $post['title'] . " در بخش برگه ها");
            $this->response_success("برگه " . $post['title'] . " با موفقیت ویرایش شد");
        }
    }

    function statusPage($post)
    {
        try {
            $this->doQuery("UPDATE tbl_page SET p_status=(case when p_status=1 then 0 else 1 end) WHERE p_id=?", array($post['id']));
            $result = $this->doSelect("SELECT title,p_status FROM tbl_page WHERE p_id=?", array($post['id']), 1);

            if ($result['p_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت " . $result['title'] . " در برگه ها ");
                $this->response_success("برگه مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت " . $result['title'] . " در برگه ها ");
                $this->response_success("برگه مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delPage($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $result = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=?", array($post['id']));
                unlink("public/images/page/" . $result[0]['cover']);
                $this->doQuery("DELETE FROM tbl_page WHERE p_id=?", array($post['id']));

                $this->ActivityLog("حذف " . $result['0']['title'] . " از بخش برگه ها");
                $this->response_success("برگه " . $result['0']['title'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("برگه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetPage($id)
    {
        $result = $this->doSelect("SELECT p_id FROM tbl_page WHERE p_id= ?", array($id));
        return $result;
    }

    function getPageWidgetAjax($get)
    {
        $columns = array(
            array('db' => 'ip_id', 'dt' => 0,
                'formatter' => function ($d, $row) {
                    return '<div class="custom-checkbox"><input type="checkbox" class="checkbox" data-id="' . $d . '"><label for="' . $d . '"></label></div>';
                }
            ),
            array('db' => 'ip_id', 'dt' => 1),
            array('db' => 'ip_title', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return $this->summary($d, 100);
                }
            ),
            array('db' => 't_title', 'dt' => 3),
            array(
                'db' => 'ip_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ip_id'] . '" data-id="' . $row['ip_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ip_id'] . '" data-id="' . $row['ip_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array(
                'db' => 'ip_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<a style="margin: 1px;" title="ویرایش ابزارک" class="btn btn-warning btn-xs" href="' . ADMIN_PATH . '/pages/widget-edit/' . $row['ip_id'] . '"><i class="fa fa-pencil-square-o"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" data-target="#del-Modal" id="btn-del-style-' . $row['ip_id'] . '" data-id="' . $row['ip_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = "ORDER BY ip_order ASC";
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT ip.*,t.t_title FROM tbl_page_widget ip LEFT JOIN tbl_template t ON ip.template_id=t.t_id $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(ip_id) FROM tbl_page_widget ip LEFT JOIN tbl_template t ON ip.template_id=t.t_id $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(ip_id) FROM tbl_page_widget ip LEFT JOIN tbl_template t ON ip.template_id=t.t_id"
        );
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getWidgetInfo($attrId = '')
    {
        if ($attrId == '') {
            $sql = "SELECT * FROM tbl_page_widget WHERE ip_status=1";
            $result = $this->doSelect($sql);
        } else {
            $sql = "SELECT * FROM tbl_page_widget WHERE ip_id=?";
            $result = $this->doSelect($sql, array($attrId), 1);
        }

        return $result;
    }

    function addCustomWidget($post)
    {
        try {
            $sql = "SELECT * FROM tbl_template WHERE t_part=? AND t_title=? AND t_is_custom=?";
            $param = array("dashboard", $post['title'], 1);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("ویجت دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_template (t_part,t_href,t_title,t_description,t_is_custom,t_theme,t_show_title,t_is_default_widget,t_status) VALUES (?,?,?,?,?,?,?,?,?)";
                $params = array("dashboard", "custom_" . $this->generateRandomString(10), $post['title'], $post['description'], 1, $this->getPublicInfo('theme'), $post['show_title'], 0, 1);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست ویجت ها");
                $this->response_success("ویجت " . $post['title'] . " باموفقیت افزوده شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delCustomWidget($post)
    {
        try {
            $sql = "SELECT * FROM tbl_template WHERE t_id=?";
            $result = $this->doSelect($sql, array($post['id']));

            if (sizeof($result) == 0) {
                $this->response_error("ویجت مورد نظر یافت نشد");
            } else {
                $this->doQuery("DELETE FROM tbl_template WHERE t_id=?", array($post['id']));

                $this->ActivityLog("حذف ویجت " . $result[0]['t_title'] . " از لیست ویجت های داشبورد");
                $this->response_success("ویجت " . $result[0]['t_title'] . " باموفقیت حذف شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addWidget($post)
    {
        try {
            $sql = "SELECT * FROM tbl_page_widget WHERE page_id=? AND template_id=? AND ip_title=?";
            $param = array($post['page_id'], $post['template_id'], $post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("ابزارک دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $order = $this->doSelect("SELECT MAX(ip_order) as order_num FROM tbl_page_widget WHERE page_id=?", array($post['page_id']), 1);
                $sql2 = "INSERT INTO tbl_page_widget (page_id,template_id,ip_title,ip_order,ip_content,ip_status) VALUES (?,?,?,?,?,?)";
                $params = array($post['page_id'], $post['template_id'], $post['title'], ($order['order_num'] + 1), serialize($post['options']), $post['is_active']);
                $this->doQuery($sql2, $params);

                $page = $this->doSelect("SELECT title FROM tbl_page WHERE p_id=?", array($post['page_id']), 1);
                $this->ActivityLog("افزودن " . $post['title'] . " در لیست ابزارک های " . $page['title']);
                $this->response_success("ابزارک " . $post['title'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editWidget($post)
    {
        try {
            $param = array($post['page_id'], $post['template_id'], $post['title'], $post['id']);
            $result = $this->doSelect("SELECT * FROM tbl_page_widget WHERE page_id=? AND template_id=? AND ip_title=? AND ip_id!=?", $param);

            if (sizeof($result) > 0) {
                $this->response_warning("ابزارک دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql3 = "UPDATE tbl_page_widget SET ip_title=?, ip_content=?, ip_status=? WHERE ip_id=?";
                $params = array($post['title'], serialize($post['options']), $post['is_active'], $post['id']);
                $this->doQuery($sql3, $params);

                $page = $this->doSelect("SELECT title FROM tbl_page WHERE p_id=?", array($post['page_id']), 1);
                $this->ActivityLog("ویرایش اطلاعات " . $post['title'] . " در لیست ابزارک های " . $page['title']);
                $this->response_success("اطلاعات ابزارک " . $post['title'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editDashboardWidget($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("صفحه مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_page SET data_item=? WHERE p_id=?";
                $params = array($post['data'], $post['id']);
                $this->doQuery($sql, $params);

                $page = $this->doSelect("SELECT title FROM tbl_page WHERE p_id=?", array($post['id']), 1);

                $this->ActivityLog("ویرایش ابزارک های صفحه " . $page['title']);
                $this->response_success("صفحه " . $page['title'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function widgetOrder($post)
    {
        try {
            foreach ($post['order'] as $order) {
                $this->doQuery("UPDATE tbl_page_widget SET ip_order=? WHERE ip_id=?", array($order['position'], $order['id']));
            }

            $this->response_success("ترتیب جدید با موفقیت ذخیره شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function widgetStatus($post)
    {
        try {
            $this->doQuery("UPDATE tbl_page_widget SET ip_status=(case when ip_status=1 then 0 else 1 end) WHERE ip_id=?", array($post['id']));
            $result = $this->doSelect("SELECT ip_status, ip_title FROM tbl_page_widget WHERE ip_id=?", array($post['id']), 1);

            if ($result['ip_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت ابزارک " . $result['ip_title']);
                $this->response_success("ابزارک " . $result['ip_title'] . " باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت ابزارک " . $result['ip_title']);
                $this->response_success("ابزارک " . $result['ip_title'] . " باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function widgetDel($post)
    {
        try {
            if ($post['type'] == "single") {
                $result = $this->doSelect("SELECT ip_title FROM tbl_page_widget WHERE ip_id=?", array($post['id']), 1);
                $this->doQuery("DELETE FROM tbl_page_widget WHERE ip_id=?", array($post['id']));

                $this->ActivityLog("حذف ابزارک " . $result['ip_title']);
                $this->response_success("ابزارک " . $result['ip_title'] . " باموفقیت حذف شد");
            } else {
                $ids = explode(",", $post['id']);
                foreach ($ids as $id) {
                    $result = $this->doSelect("SELECT ip_title FROM tbl_page_widget WHERE ip_id=?", array($id), 1);
                    $this->doQuery("DELETE FROM tbl_page_widget WHERE ip_id=?", array($id));
                    $this->ActivityLog("حذف ابزارک " . $result['ip_title']);
                }
                $this->response_success("ابزارک های مورد نظر باموفقیت حذف شدند");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getIssetWidget($id)
    {
        $result = $this->doSelect("SELECT ip_id FROM tbl_page_widget WHERE ip_id= ?", array($id));
        return $result;
    }

    function getIconsAjax($get)
    {
        $columns = array(
            array('db' => 'i_id', 'dt' => 0),
            array('db' => 'i_title', 'dt' => 1),
            array('db' => 'i_icon', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return '<img onerror="this.src=\'public/images/user-default-image.jpg\'" height="30px" src="public/images/icons/' . $d . '">';
                }
            ),
            array('db' => 'i_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['i_id'] . '" data-id="' . $row['i_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['i_id'] . '" data-id="' . $row['i_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'i_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش نماد" data-target="#edit-Modal" id="btn-edit-' . $row['i_id'] . '" data-id="' . $row['i_id'] . '" data-name="' . $row['i_title'] . '" data-description="' . $row['i_description'] . '" data-image="public/images/icons/' . $row['i_icon'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف نماد" data-target="#del-Modal" id="btn-del-style-' . $row['i_id'] . '" data-id="' . $row['i_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_icons $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(i_id) FROM tbl_icons $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(i_id) FROM tbl_icons");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusIcons($post)
    {
        try {
            $this->doQuery("UPDATE tbl_icons SET i_status=(case when i_status=1 then 0 else 1 end) WHERE i_id=?", array($post['id']));
            $result = $this->doSelect("SELECT i_status, i_title FROM tbl_icons WHERE i_id=?", array($post['id']), 1);

            if ($result['status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت نماد " . $result['i_title']);
                $this->response_success("نماد " . $result['i_title'] . " باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت نماد " . $result['i_title']);
                $this->response_success("نماد " . $result['i_title'] . " باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addIcons($post)
    {
        try {
            $sql = "SELECT * FROM tbl_icons WHERE i_title=?";
            $result = $this->doSelect($sql, array($post['title']));

            if (sizeof($result) > 0) {
                $this->response_warning("نماد دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/icons/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql = "INSERT INTO tbl_icons (i_title,i_description,i_icon) VALUES (?,?,?)";
                $params = array($post['title'], $post['description'], $coverImg);
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست آیکون ها و نمادها");
                $this->response_success("نماد " . $post['title'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editIcons($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_icons WHERE i_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("نماد مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/icons/";

                $coverImg = NULL;
                if (isset($_FILES["coverEdit"]["tmp_name"])) {
                    $result = $this->doSelect("SELECT * FROM tbl_icons WHERE i_id=?", array($post['id']), 1);
                    if ($result['i_icon'] != NULL) {
                        unlink($dirCover . $result['i_icon']);
                    }
                    $coverImg = time() . "_" . $_FILES["coverEdit"]["name"];
                    move_uploaded_file($_FILES["coverEdit"]["tmp_name"], $dirCover . $coverImg);

                    $sql3 = "UPDATE tbl_icons SET i_icon=? WHERE i_id=?";
                    $params = [$coverImg, $post['id']];
                    $this->doQuery($sql3, $params);
                }

                $sql = "UPDATE tbl_icons SET i_title=?, i_description=? WHERE i_id=?";
                $params = array($post['titleEdit'], $post['descriptionEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات نماد " . $post['titleEdit']);
                $this->response_success("نماد " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delIcons($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_icons WHERE i_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $dirCover = "public/images/icons/";
                if ($result['0']['i_icon'] != NULL) {
                    unlink($dirCover . $result['0']['i_icon']);
                }

                $this->doQuery("DELETE FROM tbl_icons WHERE i_id=?", array($post['id']));

                $this->ActivityLog("حذف نماد " . $result['0']['i_title']);
                $this->response_success("نماد " . $result['0']['i_title'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("نماد مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function resetMainDashboard($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_page WHERE p_id=? AND type=?", array($post['id'], "dashboard"));

            if (sizeof($result) <= 0) {
                $this->response_error("صفحه مورد نظر یافت نشد");
            } else {
                $params = array($this->getPublicInfo('dashboard_default'), $post['id']);
                $this->doQuery("UPDATE tbl_page SET data_item=? WHERE p_id=?", $params);

                $this->ActivityLog("ریست ویجت های صفحه " . $result['0']['title']);
                $this->response_success($result['0']['title'] . " باموفقیت ریست شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSliderAjax($get)
    {
        $columns = array(
            array('db' => 's_id', 'dt' => 0),
            array('db' => 's_title', 'dt' => 1),
            array('db' => 's_status', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 's_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<a style="margin: 1px;" title="مشاهده تصاویر" class="btn btn-success btn-xs" href="' . ADMIN_PATH . '/slider/images/' . $row['s_id'] . '"><i class="fa fa-image"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش بنر" data-target="#edit-Modal" id="btn-edit-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" data-name="' . $row['s_title'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف بنر" data-target="#del-Modal" id="btn-del-style-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_slider $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(s_id) FROM tbl_slider $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(s_id) FROM tbl_slider");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getIssetSlider($id)
    {
        $result = $this->doSelect("SELECT s_id FROM tbl_slider WHERE s_id= ?", array($id));
        return $result;
    }

    function getSlider($id = '')
    {
        if ($id != '') {
            $result = $this->doSelect("SELECT * FROM tbl_slider WHERE s_id=?", array($id));
            return $result;
        } else {
            $result = $this->doSelect("SELECT * FROM tbl_slider WHERE s_status=1");
            return $result;
        }
    }

    function statusSlider($post)
    {
        try {
            $this->doQuery("UPDATE tbl_slider SET s_status=(case when s_status=1 then 0 else 1 end) WHERE s_id=?", array($post['id']));
            $result = $this->doSelect("SELECT s_status, s_title FROM tbl_slider WHERE s_id=?", array($post['id']), 1);

            if ($result['s_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت اسلایدر " . $result['s_title']);
                $this->response_success("اسلایدر مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت اسلایدر " . $result['s_title']);
                $this->response_success("اسلایدر مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addSlider($post)
    {
        try {
            $sql = "SELECT * FROM tbl_slider WHERE s_title=?";
            $param = array($post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("اسلایدر دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_slider (s_title,s_create_date) VALUES (?,?)";
                $params = [$post['title'], $this->jaliliDate()];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در اسلایدرها");
                $this->response_success("اسلایدر " . $post['title'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editSlider($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_slider WHERE s_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("اسلایدر مورد نظر یافت نشد");
            } else {
                $sql3 = "UPDATE tbl_slider SET s_title=? WHERE s_id=?";
                $params = array($post['titleEdit'], $post['id']);
                $this->doQuery($sql3, $params);

                $this->ActivityLog("ویرایش اطلاعات اسلایدر " . $post['titleEdit']);
                $this->response_success("اطلاعات اسلایدر " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delSlider($post)
    {
        try {
            $result = $this->doSelect("SELECT s_title FROM tbl_slider WHERE s_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_slider WHERE s_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_slider_image WHERE slider_id=?", array($post['id']));

                $this->ActivityLog("حذف اسلایدر " . $result['0']['s_title']);
                $this->response_success("اسلایدر " . $result['0']['s_title'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("اسلایدر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSliderImagesAjax($get)
    {
        $columns = array(
            array('db' => 'si_id', 'dt' => 0),
            array('db' => 'si_title', 'dt' => 1),
            array('db' => 'si_link', 'dt' => 2),
            array('db' => 'si_image', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return '<img onerror="this.src=\'public/images/user-default-image.jpg\'" height="30px" src="public/images/slider/' . $d . '">';
                }
            ),
            array('db' => 'si_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['si_id'] . '" data-id="' . $row['si_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['si_id'] . '" data-id="' . $row['si_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'si_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش اطلاعات تصویر" data-target="#edit-Modal" id="btn-edit-' . $row['si_id'] . '" data-id="' . $row['si_id'] . '" data-name="' . $row['si_title'] . '" data-link="' . $row['si_link'] . '" data-image="public/images/slider/' . $row['si_image'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف تصویر" data-target="#del-Modal" id="btn-del-style-' . $row['si_id'] . '" data-id="' . $row['si_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if ($where == "") {
            $where .= "WHERE slider_id=" . $get['id'];
        } else {
            $where .= " AND slider_id=" . $get['id'];
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_slider_image $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(si_id) FROM tbl_slider_image $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(si_id) FROM tbl_slider_image WHERE slider_id=" . $get['id']);
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusSliderImages($post)
    {
        try {
            $this->doQuery("UPDATE tbl_slider_image SET si_status=(case when si_status=1 then 0 else 1 end) WHERE si_id=?", array($post['id']));
            $result = $this->doSelect("SELECT si_status, si_title FROM tbl_slider_image WHERE si_id=?", array($post['id']), 1);

            if ($result['si_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت تصویر اسلایدر " . $result['si_title']);
                $this->response_success("تصویر مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت تصویر اسلایدر " . $result['si_title']);
                $this->response_success("تصویر مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addSliderImages($post)
    {
        try {
            $sql = "SELECT * FROM tbl_slider_image WHERE si_title=?";
            $param = array($post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("تصویر دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/slider/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql2 = "INSERT INTO tbl_slider_image (slider_id,si_title,si_link,si_image) VALUES (?,?,?,?)";
                $params = array($post['id'], $post['title'], $post['link'], $coverImg);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست تصاویر اسلایدر");
                $this->response_success("تصویر جدید با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editSliderImages($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_slider_image WHERE si_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("تصویر مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/slider/";

                $coverImg = NULL;
                if (isset($_FILES["coverEdit"]["tmp_name"])) {
                    $result = $this->doSelect("SELECT * FROM tbl_slider_image WHERE si_id=?", array($post['id']), 1);
                    if ($result['si_image'] != NULL) {
                        unlink($dirCover . $result['si_image']);
                    }
                    $coverImg = time() . "_" . $_FILES["coverEdit"]["name"];
                    move_uploaded_file($_FILES["coverEdit"]["tmp_name"], $dirCover . $coverImg);
                    $sql3 = "UPDATE tbl_slider_image SET si_image=? WHERE si_id=?";
                    $params = [$coverImg, $post['id']];
                    $this->doQuery($sql3, $params);
                }

                $sql3 = "UPDATE tbl_slider_image SET si_title=?, si_link=? WHERE si_id=?";
                $params = [$post['titleEdit'], $post['linkEdit'], $post['id']];
                $this->doQuery($sql3, $params);

                $this->ActivityLog("ویرایش اطلاعات اسلایدر " . $post['titleEdit']);
                $this->response_success("اطلاعات تصویر " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delSliderImages($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_slider_image WHERE si_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $dirCover = "public/images/slider/";
                $result = $this->doSelect("SELECT * FROM tbl_slider_image WHERE si_id=?", array($post['id']), 1);
                if ($result['si_image'] != NULL) {
                    unlink($dirCover . $result['si_image']);
                }
                $this->doQuery("DELETE FROM tbl_slider_image WHERE si_id=?", array($post['id']));

                $this->ActivityLog("حذف تصویر " . $result['si_title'] . " از اسلایدر");
                $this->response_success("تصویر " . $result['0']['si_title'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("تصویر اسلایدر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getBannersAjax($get)
    {
        $columns = array(
            array('db' => 'b_id', 'dt' => 0),
            array('db' => 'b_title', 'dt' => 1),
            array('db' => 'b_type', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return "تکی";
                    } else if ($d == 2) {
                        return "2 تایی";
                    } else if ($d == 3) {
                        return "3 تایی";
                    } else if ($d == 4) {
                        return "4 تایی";
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'b_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['b_id'] . '" data-id="' . $row['b_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['b_id'] . '" data-id="' . $row['b_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'b_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<a style="margin: 1px;" title="مشاهده تصاویر" class="btn btn-success btn-xs" href="' . ADMIN_PATH . '/banners/images/' . $row['b_id'] . '"><i class="fa fa-image"></i></a>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش بنر" data-target="#edit-Modal" id="btn-edit-' . $row['b_id'] . '" data-id="' . $row['b_id'] . '" data-name="' . $row['b_title'] . '" data-type="' . $row['b_type'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف بنر" data-target="#del-Modal" id="btn-del-style-' . $row['b_id'] . '" data-id="' . $row['b_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_banner $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(b_id) FROM tbl_banner $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(b_id) FROM tbl_banner");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getIssetBanners($id)
    {
        $result = $this->doSelect("SELECT b_id FROM tbl_banner WHERE b_id= ?", array($id));
        return $result;
    }

    function getBanners($id = '')
    {
        if ($id != '') {
            $result = $this->doSelect("SELECT * FROM tbl_banner WHERE b_id=?", array($id));
            return $result;
        } else {
            $result = $this->doSelect("SELECT * FROM tbl_banner WHERE b_status=1");
            return $result;
        }
    }

    function statusBanners($post)
    {
        try {
            $this->doQuery("UPDATE tbl_banner SET b_status=(case when b_status=1 then 0 else 1 end) WHERE b_id=?", array($post['id']));
            $result = $this->doSelect("SELECT b_status, b_title FROM tbl_banner WHERE b_id=?", array($post['id']), 1);

            if ($result['b_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت بنر " . $result['b_title']);
                $this->response_success("بنر مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت بنر " . $result['b_title']);
                $this->response_success("بنر مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addBanners($post)
    {
        try {
            $sql = "SELECT * FROM tbl_banner WHERE b_title=? and b_type=?";
            $param = array($post['title'], $post['type']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("بنر دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql = "INSERT INTO tbl_banner (b_title,b_type,b_create_date) VALUES (?,?,?)";
                $params = array($post['title'], $post['type'], $this->jaliliDate());
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در بنرهای تبلیغاتی");
                $this->response_success("بنر " . $post['title'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editBanners($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_banner WHERE b_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("بنر مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_banner SET b_title=?, b_type=? WHERE b_id=?";
                $params = array($post['titleEdit'], $post['typeEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات بنر " . $post['titleEdit']);
                $this->response_success("اطلاعات بنر " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delBanners($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_blog WHERE n_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $result = $this->doSelect("SELECT b_title FROM tbl_banner WHERE b_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_banner WHERE b_id=?", array($post['id']));

                $this->ActivityLog("حذف بنر " . $result['0']['b_title']);
                $this->response_success("بنر " . $result['0']['b_title'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("بنر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getBannersImagesAjax($get)
    {
        $columns = array(
            array('db' => 'bi_id', 'dt' => 0),
            array('db' => 'bi_description', 'dt' => 1),
            array('db' => 'bi_link', 'dt' => 2),
            array('db' => 'bi_image', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    return '<img onerror="this.src=\'public/images/user-default-image.jpg\'" height="30px" src="public/images/banner/' . $d . '">';
                }
            ),
            array('db' => 'bi_status', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['bi_id'] . '" data-id="' . $row['bi_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['bi_id'] . '" data-id="' . $row['bi_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'bi_id', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش تصویر" data-target="#edit-Modal" id="btn-edit-' . $row['bi_id'] . '" data-id="' . $row['bi_id'] . '" data-description="' . $row['bi_description'] . '" data-link="' . $row['bi_link'] . '" data-image="public/images/banner/' . $row['bi_image'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف تصویر" data-target="#del-Modal" id="btn-del-style-' . $row['bi_id'] . '" data-id="' . $row['bi_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        if ($where == "") {
            $where .= "WHERE banner_id=" . $get['id'];
        } else {
            $where .= " AND banner_id=" . $get['id'];
        }

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_banner_image $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(bi_id) FROM tbl_banner_image $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(bi_id) FROM tbl_banner_image WHERE banner_id=" . $get['id']);
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusBannersImages($post)
    {
        try {
            $this->doQuery("UPDATE tbl_banner_image SET bi_status=(case when bi_status=1 then 0 else 1 end) WHERE bi_id=?", array($post['id']));
            $result = $this->doSelect("SELECT bi_status, bi_description FROM tbl_banner_image WHERE bi_id=?", array($post['id']), 1);

            if ($result['bi_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت تصویر " . $result['bi_description']);
                $this->response_success("تصویر مورد نظر باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت تصویر " . $result['bi_description']);
                $this->response_success("تصویر مورد نظر باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addBannersImages($post)
    {
        try {
            $sql = "SELECT * FROM tbl_banner_image WHERE bi_description=?";
            $param = array($post['description']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("تصویر دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $dirCover = "public/images/banner/";

                $coverImg = NULL;
                if (isset($_FILES["cover"]["tmp_name"])) {
                    $coverImg = time() . "_" . $_FILES["cover"]["name"];
                    move_uploaded_file($_FILES["cover"]["tmp_name"], $dirCover . $coverImg);
                }

                $sql2 = "INSERT INTO tbl_banner_image (banner_id,bi_description,bi_link,bi_image) VALUES (?,?,?,?)";
                $params = array($post['id'], $post['description'], $post['link'], $coverImg);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['description'] . " در لیست تصاویر بنرهای تبلیغاتی");
                $this->response_success("تصویر " . $post['description'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editBannersImages($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_banner_image WHERE bi_id=?", array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("تصویر مورد نظر یافت نشد");
            } else {
                $dirCover = "public/images/banner/";

                $coverImg = NULL;
                if (isset($_FILES["coverEdit"]["tmp_name"])) {
                    $result = $this->doSelect("SELECT * FROM tbl_banner_image WHERE bi_id=?", array($post['id']), 1);
                    if ($result['bi_image'] != NULL) {
                        unlink($dirCover . $result['bi_image']);
                    }
                    $coverImg = time() . "_" . $_FILES["coverEdit"]["name"];
                    move_uploaded_file($_FILES["coverEdit"]["tmp_name"], $dirCover . $coverImg);

                    $sql = "UPDATE tbl_banner_image SET bi_image=? WHERE bi_id=?";
                    $params = array($coverImg, $post['id']);
                    $this->doQuery($sql, $params);
                }

                $sql = "UPDATE tbl_banner_image SET bi_description=?, bi_link=? WHERE bi_id=?";
                $params = array($post['descriptionEdit'], $post['linkEdit'], $post['id']);
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات تصویر " . $post['descriptionEdit'] . " در بنرهای تبلیغاتی");
                $this->response_success("اطلاعات تصویر " . $post['descriptionEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delBannersImages($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_banner_image WHERE bi_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $dirCover = "public/images/banner/";
                if ($result['0']['bi_image'] != NULL) {
                    unlink($dirCover . $result['0']['bi_image']);
                }

                $this->doQuery("DELETE FROM tbl_banner_image WHERE bi_id=?", array($post['id']));

                $this->ActivityLog("حذف تصویر " . $result['0']['bi_description']);
                $this->response_success("تصویر " . $result['0']['bi_description'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("تصویر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getSearchesAjax($get)
    {
        $columns = array(
            array('db' => 's_id', 'dt' => 0),
            array('db' => 's_phrase', 'dt' => 1),
            array('db' => 's_count_result', 'dt' => 2),
            array('db' => 's_count_search', 'dt' => 3),
            array('db' => 's_suggest_search', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#suggest-Modal" id="btn-suggest-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#suggest-Modal" id="btn-suggest-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 's_management_selection', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if ($d == 1) {
                        return '<button data-toggle="modal" data-target="#management-Modal" id="btn-management-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#management-Modal" id="btn-management-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 's_id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    $btn = '';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف کلمه" data-target="#del-Modal" id="btn-del-style-' . $row['s_id'] . '" data-id="' . $row['s_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_searches $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(s_id) FROM tbl_searches $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(s_id) FROM tbl_searches");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addSearches($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_searches WHERE s_phrase=?", array($post['title']));

            if (sizeof($result) > 0) {
                $this->response_warning("کلمه دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql = "INSERT INTO tbl_searches (s_phrase,s_suggest_search,s_management_selection,s_date) VALUES (?,?,?,?)";
                $params = [$post['title'], $post['suggestSearch'], $post['managementSelection'], $this->jaliliDate()];
                $this->doQuery($sql, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در لیست کلمه های جتجوی پرتکرار");
                $this->response_success("کلمه " . $post['title'] . " با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delSearches($post)
    {
        try {
            $result = $this->doSelect("SELECT s_phrase FROM tbl_searches WHERE s_id=?", array($post['id']));
            if (sizeof($result) > 0) {
                $this->doQuery("DELETE FROM tbl_searches WHERE s_id=?", array($post['id']));

                $this->ActivityLog("حذف کلمه " . $result['0']['s_phrase'] . " از لیست کلمات جستجو پرتکرار");
                $this->response_success("کلمه " . $result['0']['s_phrase'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("کلمه مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusSuggestSearches($post)
    {
        try {
            $this->doQuery("UPDATE tbl_searches SET s_suggest_search=(case when s_suggest_search=1 then 0 else 1 end) WHERE s_id=?", array($post['id']));
            $result = $this->doSelect("SELECT s_suggest_search, s_phrase FROM tbl_searches WHERE s_id=?", array($post['id']), 1);

            if ($result['s_suggest_search'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت کلمه " . $result['s_phrase'] . " در نمایش لیست پیشنهادی کلمه های جستجوی پرتکرار");
                $this->response_success("کلمه " . $result['s_phrase'] . "در پیشنهادهای سرچ نمایش داده می شود.", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت کلمه " . $result['s_phrase'] . " در نمایش لیست پیشنهادی کلمه های جستجوی پرتکرار");
                $this->response_success("کلمه " . $result['s_phrase'] . " از پیشنهادهای سرچ حذف شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusManagementSearches($post)
    {
        try {
            $this->doQuery("UPDATE tbl_searches SET s_management_selection=(case when s_management_selection=1 then 0 else 1 end) WHERE s_id=?", array($post['id']));
            $result = $this->doSelect("SELECT s_management_selection, s_phrase FROM tbl_searches WHERE s_id=?", array($post['id']), 1);

            if ($result['s_management_selection'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت کلمه " . $result['s_phrase'] . " در  لیست ویژه کلمه های جستجوی پرتکرار");
                $this->response_success("کلمه " . $result['s_phrase'] . " در لیست ویژه نمایش داده می شود", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت کلمه " . $result['s_phrase'] . " در  لیست ویژه کلمه های جستجوی پرتکرار");
                $this->response_success("کلمه " . $result['s_phrase'] . " از لیست ویزه حذف شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function checkSlug($post)
    {
        try {
            if (isset($post['id'])) {
                $result = $this->doSelect("SELECT p_id FROM tbl_page WHERE link= ? AND p_id != ?", array($post['slug'], $post['id']));
            } else {
                $result = $this->doSelect("SELECT p_id FROM tbl_page WHERE link= ?", array($post['slug']));
            }

            if (sizeof($result) > 0) {
                $this->response_warning("این آدرس قبلا ثبت شده است", "exist");
            } else {
                $this->response_success("آدرس مورد تایید است");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addRedirect($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_redirect WHERE old_url=?", array($post['old_url']));

            if (sizeof($result) > 0) {
                $this->response_warning("این لینک قبلا ایجاد شده است");
            } else {
                $sql2 = "INSERT INTO tbl_redirect (old_url,new_url,type) VALUES (?,?,?)";
                $params = array($post['old_url'], $post['new_url'], $post['type']);
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['old_url'] . " در لیست ریدایرکت ها");
                $this->response_success("لینک جدید باموفقیت افزوده شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getRedirectLinkAjax($get)
    {
        $columns = array(
            array('db' => 'r_id', 'dt' => 0),
            array('db' => 'old_url', 'dt' => 1),
            array('db' => 'new_url', 'dt' => 2),
            array('db' => 'type', 'dt' => 3),
            array('db' => 'r_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $dataInfo = array(
                        "id" => $row['r_id'],
                        "old_url" => $row['old_url'],
                        "new_url" => $row['new_url'],
                        "type" => $row['type']
                    );
                    $btn = '';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش لینک" data-target="#edit-Modal" id="btn-edit-' . $row['r_id'] . '" data-info=' . json_encode($dataInfo, true) . ' class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف لینک" data-target="#del-Modal" id="btn-del-style-' . $row['r_id'] . '" data-id="' . $row['r_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_redirect $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(r_id) FROM tbl_redirect $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(r_id) FROM tbl_redirect");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function editRedirect($post)
    {
        try {
            $sql3 = "UPDATE tbl_redirect SET old_url=?, new_url=?, type=? WHERE r_id=?";
            $params = [$post['old_urlEdit'], $post['new_urlEdit'], $post['typeEdit'], $post['id']];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش اطلاعات لینک " . $post['old_urlEdit']);
            $this->response_success("اطلاعات لینک باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delRedirect($post)
    {
        try {
            $result = $this->doSelect("SELECT old_url FROM tbl_redirect WHERE r_id=?", array($post['id']), 1);
            $this->ActivityLog("حذف لینک " . $result['b_title'] . " از دایرکت ها");
            $this->doQuery("DELETE FROM tbl_redirect WHERE r_id=?", array($post['id']));

            $this->response_success("اطلاعات لینک باموفقیت حذف شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

}
