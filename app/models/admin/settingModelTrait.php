<?php

trait settingModelTrait
{
//    methods contacting
    function methodsContactingEdit($post)
    {
        try {
            $sql = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";

            if($post['part'] == "floatContactSetting"){
                $this->doQuery($sql, [$post['float_contact'], "float_contact"]);
                $this->doQuery($sql, [$post['float_contact_position'], "float_contact_position"]);
                $this->doQuery($sql, [$post['float_contact_size'], "float_contact_size"]);
                $this->doQuery($sql, [$post['float_contact_color'], "float_contact_color"]);
                $this->doQuery($sql, [$post['float_contact_text'], "float_contact_text"]);
                $this->doQuery($sql, [$post['float_contact_icons_animation_speed'], "float_contact_icons_animation_speed"]);
                $this->doQuery($sql, [$post['float_contact_icons_animation_pause'], "float_contact_icons_animation_pause"]);
                $this->doQuery($sql, [$post['float_contact_online_badge'], "float_contact_online_badge"]);

                $this->ActivityLog("ویرایش تنظیمات دکمه شناور");
            } else if($post['part'] == "floatButtonMenu"){
                $this->doQuery($sql, [$post['float_contact_menu_size'], "float_contact_menu_size"]);
                $this->doQuery($sql, [$post['float_contact_menu_backdrop'], "float_contact_menu_backdrop"]);
                $this->doQuery($sql, [$post['float_contact_menu_show_header'], "float_contact_menu_show_header"]);
                $this->doQuery($sql, [$post['float_contact_menu_show_header_close_btn'], "float_contact_menu_show_header_close_btn"]);
                $this->doQuery($sql, [$post['float_contact_menu_header_close_btn_bg_color'], "float_contact_menu_header_close_btn_bg_color"]);
                $this->doQuery($sql, [$post['float_contact_menu_header_close_btn_color'], "float_contact_menu_header_close_btn_color"]);
                $this->doQuery($sql, [$post['float_contact_menu_header_text'], "float_contact_menu_header_text"]);
                $this->doQuery($sql, [$post['float_contact_menu_sub_header_text'], "float_contact_menu_sub_header_text"]);
                $this->doQuery($sql, [$post['float_contact_items_icon_type'], "float_contact_items_icon_type"]);
                $this->doQuery($sql, [$post['float_contact_menu_popup_style'], "float_contact_menu_popup_style"]);
                $this->doQuery($sql, [$post['float_contact_popup_animation'], "float_contact_popup_animation"]);
                $this->doQuery($sql, [$post['float_contact_sidebar_animation'], "float_contact_sidebar_animation"]);
                $this->doQuery($sql, [$post['float_contact_menu_items_animation'], "float_contact_menu_items_animation"]);
                $this->doQuery($sql, [$post['float_contact_menu_click_away'], "float_contact_menu_click_away"]);

                $this->ActivityLog("ویرایش تنظیمات منوی دکمه شناور");
            }

            $this->response_success("اطلاعات راه های ارتباطی با موفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function saveMethodsContactingPriority($list, $order = 0)
    {
        try {
            $sql = "UPDATE tbl_methods_contacting SET mc_priority=? WHERE mc_id=?";
            foreach ($list as $item) {
                $order++;
                $this->doQuery($sql, array($order, $item["id"]));
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusMethodsContacting($post)
    {
        try {
            $this->doQuery("UPDATE tbl_methods_contacting SET mc_status=(case when mc_status=1 then 0 else 1 end) WHERE mc_id=?", array($post['id']));

            $result = $this->doSelect("SELECT mc_status, mc_title FROM tbl_methods_contacting WHERE mc_id=?", array($post['id']), 1);
            if ($result['mc_status'] == 1) {
                $this->ActivityLog("فعالسازی وضعیت " . $result['mc_title']);
                $this->response_success($result['mc_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعالسازی وضعیت " . $result['mc_title']);
                $this->response_success($result['mc_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editMethodsContacting($post)
    {
        try {
            $sql = "SELECT * FROM tbl_methods_contacting WHERE mc_id=?";
            $result = $this->doSelect($sql, array($post['id']));
            if (sizeof($result) <= 0) {
                $this->response_error("آیتم مورد نظر یافت نشد");
            } else {
                $sql = "UPDATE tbl_methods_contacting SET 
                                  mc_title=?, 
                                  mc_link=?, 
                                  mc_description=?, 
                                  mc_show_in_float_button=?, 
                                  mc_show_in_float_button_slider=?, 
                                  mc_show_in_footer=?, 
                                  mc_show_in_login_page=?, 
                                  mc_show_in_mobile=?, 
                                  mc_show_in_desktop=?  
                            WHERE mc_id=?";
                $params = array(
                    $post['titleEdit'],
                    $post['linkEdit'],
                    $post['descriptionEdit'],
                    $post['show_in_float_buttonEdit'],
                    $post['show_in_float_button_sliderEdit'],
                    $post['show_in_footerEdit'],
                    $post['show_in_login_pageEdit'],
                    $post['show_in_mobileEdit'],
                    $post['show_in_desktopEdit'],
                    $post['id']
                );
                $this->doQuery($sql, $params);

                $this->ActivityLog("ویرایش اطلاعات " . $post['titleEdit']);
                $this->response_success("اطلاعات " . $post['titleEdit'] . " با موفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

//    settings method
    function businessInformationEdit($post)
    {
        try {
            $sql = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";

            if($post['part'] == "publicSetting"){
                $this->doQuery($sql, [$post['site'], "site"]);
                $this->doQuery($sql, [$post['site_short_name'], "site_short_name"]);
                $this->doQuery($sql, [$post['meta_keyword'], "meta_keyword"]);
                $this->doQuery($sql, [$post['site_public'], "site_public"]);
                $this->doQuery($sql, [$post['theme_color'], "theme_color"]);
                $this->doQuery($sql, [$post['offline_mode'], "offline_mode"]);
                $this->doQuery($sql, [$post['meta_description'], "meta_description"]);
                $this->doQuery($sql, [$post['admin_path'], "admin_path"]);
                $this->doQuery($sql, [$post['active_user_experience'], "active_user_experience"]);
                $this->doQuery($sql, [$post['active_wallet'], "active_wallet"]);
                $this->doQuery($sql, [$post['active_vip_account'], "active_vip_account"]);
                $this->doQuery($sql, [$post['need_to_login_for_add_to_cart'], "need_to_login_for_add_to_cart"]);
                $this->doQuery($sql, [$post['customJS_position'], "customJS_position"]);
                $this->doQuery($sql, [$post['blog_item_per_page'], "blog_item_per_page"]);
                $this->doQuery($sql, [$post['service_item_per_page'], "service_item_per_page"]);
                $this->doQuery($sql, [$post['development_mode'], "development_mode"]);
                $this->doQuery($sql, [$post['development_mode_text'], "development_mode_text"]);
                $this->doQuery($sql, [$post['offline_mode'], "offline_mode"]);
                $this->doQuery($sql, [$post['admin_ip_lock'], "admin_ip_lock"]);
                $this->doQuery($sql, [$post['admin_ip'], "admin_ip"]);
                $this->doQuery($sql, [$post['meta_description'], "meta_description"]);
                $this->doQuery($sql, [htmlspecialchars($post['customJS']), "customJS"]);
                $this->doQuery($sql, [$post['cookie_duration'], "cookie_duration"]);

                $manifest = file_get_contents("public/images/favicon/manifest.json");
                $data = json_decode($manifest, TRUE);
                $data['name'] = $post['site'];
                $data['short_name'] = $post['site_short_name'];
                $data['description'] = $post['meta_description'];
                $data['background_color'] = $post['theme_color'];
                $data['theme_color'] = $post['theme_color'];
                $data['status_bar'] = $post['theme_color'];
                $data['start_url'] = URL.ADMIN_PATH."/dashboard";
                $data['icons'] = array(
                    array(
                        "src" => URL."public/images/favicon/android-icon-36x36.ico",
                        "sizes" => "36x36",
                        "type" => "image/png",
                        "density" => "0.75",
                    ),
                    array(
                        "src" => URL."public/images/favicon/android-icon-48x48.ico",
                        "sizes" => "48x48",
                        "type" => "image/png",
                        "density" => "1.0",
                    ),
                    array(
                        "src" => URL."public/images/favicon/android-icon-72x72.ico",
                        "sizes" => "72x72",
                        "type" => "image/png",
                        "density" => "1.5",
                    ),
                    array(
                        "src" => URL."public/images/favicon/android-icon-96x96.ico",
                        "sizes" => "96x96",
                        "type" => "image/png",
                        "density" => "2.0",
                    ),
                    array(
                        "src" => URL."public/images/favicon/android-icon-144x144.ico",
                        "sizes" => "144x144",
                        "type" => "image/png",
                        "density" => "3.0",
                    ),
                    array(
                        "src" => URL."public/images/favicon/android-icon-192x192.ico",
                        "sizes" => "192x192",
                        "type" => "image/png",
                        "density" => "4.0",
                    ),
                );
                $manifest = file_put_contents("public/images/favicon/manifest.json", json_encode($data));

                $this->ActivityLog("ویرایش تنظیمات عمومی سایت");
            } else if($post['part'] == "header"){
                $this->doQuery($sql, [$post['notification'], "notification"]);
                $this->doQuery($sql, [$post['notification_message'], "notification_message"]);
                $this->doQuery($sql, [$post['notification_text_position'], "notification_text_position"]);
                $this->doQuery($sql, [$post['notification_background_color'], "notification_background_color"]);
                $this->doQuery($sql, [$post['notification_text_color'], "notification_text_color"]);

                $this->ActivityLog("ویرایش اطلاعات هدر");
            } else if($post['part'] == "footer"){
                $this->doQuery($sql, [$post['footer_logo'], "footer_logo"]);
                $this->doQuery($sql, [$post['footer_about'], "footer_about"]);
                $this->doQuery($sql, [$post['copyright'], "copyright"]);
                $this->doQuery($sql, [$post['enamad_link'], "enamad_link"]);
                $this->doQuery($sql, [$post['enamad_image'], "enamad_image"]);
                $this->doQuery($sql, [$post['samandehi_link'], "samandehi_link"]);
                $this->doQuery($sql, [$post['samandehi_image'], "samandehi_image"]);
                $this->doQuery($sql, [$post['zarinpal_link'], "zarinpal_link"]);
                $this->doQuery($sql, [$post['zarinpal_image'], "zarinpal_image"]);

                $this->ActivityLog("ویرایش اطلاعات فوتر");
            } else if($post['part'] == "businessInfo"){
                $this->doQuery($sql, [$post['legal_name'], "legal_name"]);
                $this->doQuery($sql, [$post['managemen_name'], "managemen_name"]);
                $this->doQuery($sql, [$post['business_type'], "business_type"]);
                $this->doQuery($sql, [$post['field_of_activity'], "field_of_activity"]);
                $this->doQuery($sql, [$post['national_id'], "national_id"]);
                $this->doQuery($sql, [$post['economic_code'], "economic_code"]);
                $this->doQuery($sql, [$post['registration_number'], "registration_number"]);
                $this->doQuery($sql, [$post['province'], "province"]);
                $this->doQuery($sql, [$post['city'], "city"]);
                $this->doQuery($sql, [$post['address'], "address"]);
                $this->doQuery($sql, [$post['postal_code'], "postal_code"]);
                $this->doQuery($sql, [$post['location'], "location"]);

                $this->ActivityLog("ویرایش اطلاعات کسب و کار");
            } else if($post['part'] == "sms"){
                $this->doQuery($sql, [$post['sms_status'], "sms_status"]);
                $this->doQuery($sql, [$post['sms_site'], "sms_site"]);
                $this->doQuery($sql, [$post['sms_api_key'], "sms_api_key"]);
                $this->doQuery($sql, [$post['sms_secret_key'], "sms_secret_key"]);
                $this->doQuery($sql, [$post['sms_number'], "sms_number"]);
                $this->doQuery($sql, [$post['sms_template_for_forget_password_admin'], "sms_template_for_forget_password_admin"]);
                $this->doQuery($sql, [$post['sms_template_login'], "sms_template_login"]);

                $this->ActivityLog("ویرایش اطلاعات پنل پیامک");
            } else if($post['part'] == "googleCaptcha"){
                $this->doQuery($sql, [$post['google_captcha_status'], "google_captcha_status"]);
                $this->doQuery($sql, [$post['google_captcha_site_key'], "google_captcha_site_key"]);
                $this->doQuery($sql, [$post['google_secret_site_key'], "google_secret_site_key"]);

                $this->ActivityLog("ویرایش اطلاعات گوگل کپچا");
            } else if($post['part'] == "telegramBot"){
                $this->doQuery($sql, [$post['bot_status'], "bot_status"]);
                $this->doQuery($sql, [$post['bot_token'], "bot_token"]);
                $this->doQuery($sql, [$post['channel_service_reservation'], "channel_service_reservation"]);
                $this->doQuery($sql, [$post['channel_payment'], "channel_payment"]);
                $this->doQuery($sql, [$post['channel_blog'], "channel_blog"]);

                $this->ActivityLog("ویرایش اطلاعات ربات تلگرام");
            } else if($post['part'] == "comments"){
                $this->doQuery($sql, [$post['comment_item_per_page'], "comment_item_per_page"]);
                $this->doQuery($sql, [$post['comment_limit_for_user'], "comment_limit_for_user"]);
                $this->doQuery($sql, [$post['comment_confirm_method'], "comment_confirm_method"]);
                $this->doQuery($sql, [$post['comment_reply_button'], "comment_reply_button"]);
                $this->doQuery($sql, [$post['comment_show_for_login_user'], "comment_show_for_login_user"]);
                $this->doQuery($sql, [$post['comment_word_check'], "comment_word_check"]);
                $this->doQuery($sql, [$post['comment_word_forbidden'], "comment_word_forbidden"]);

                $this->ActivityLog("ویرایش اطلاعات دیدگاه ها");
            }

            $this->response_success("اطلاعات با موفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editLogo($post)
    {
        try {
            if (isset($_FILES["image"]["name"])) {
                $dir = "public/images/logos/";

                $type = "logo";
                if($post['type']=="dark"){
                    $type = "logo_dark";
                }

                unlink($dir . $this->getPublicInfo($type));

                $nameImg = time() . "_" . rand(1, 9999) . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $nameImg);

                $sql3 = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";
                $params = [$nameImg, $type];
                $this->doQuery($sql3, $params);

                $this->ActivityLog("ویرایش لوگو");
                $this->response_success("لوگو باموفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editFavIcon($post)
    {
        try {
            if (isset($_FILES["image"]["name"])) {
                require('public/library/php-ico/class-php-ico.php');
                $destination = 'public/images/favicon/';
                $nameImg = time() . "_" . rand(1, 9999) . "_" . $_FILES['image']['name'];

                unlink($destination . $this->getPublicInfo('favicon'));
                move_uploaded_file($_FILES["image"]["tmp_name"], $destination . $nameImg);

                $this->doQuery("UPDATE tbl_settings SET `value`=? WHERE `key`=?", array($nameImg, "favicon"));

                $ico_lib = new PHP_ICO();
                $ico_lib->add_image($destination . $nameImg, array(array(57, 57)));
                $ico_lib->save_ico($destination."apple-icon-57x57.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(60, 60)));
                $ico_lib->save_ico($destination."apple-icon-60x60.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(72, 72)));
                $ico_lib->save_ico($destination."apple-icon-72x72.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(76, 76)));
                $ico_lib->save_ico($destination."apple-icon-76x76.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(114, 114)));
                $ico_lib->save_ico($destination."apple-icon-114x114.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(120, 120)));
                $ico_lib->save_ico($destination."apple-icon-120x120.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(120, 120)));
                $ico_lib->save_ico($destination."apple-icon-120x120.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(144, 144)));
                $ico_lib->save_ico($destination."apple-icon-144x144.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(152, 152)));
                $ico_lib->save_ico($destination."apple-icon-152x152.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(180, 180)));
                $ico_lib->save_ico($destination."apple-icon-180x180.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(192, 192)));
                $ico_lib->save_ico($destination."android-icon-192x192.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(144, 144)));
                $ico_lib->save_ico($destination."android-icon-144x144.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(36, 36)));
                $ico_lib->save_ico($destination."android-icon-36x36.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(48, 48)));
                $ico_lib->save_ico($destination."android-icon-48x48.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(72, 72)));
                $ico_lib->save_ico($destination."android-icon-72x72.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(96, 96)));
                $ico_lib->save_ico($destination."android-icon-96x96.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(32, 32)));
                $ico_lib->save_ico($destination."favicon-32x32.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(96, 96)));
                $ico_lib->save_ico($destination."favicon-96x96.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(16, 16)));
                $ico_lib->save_ico($destination."favicon-16x16.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(512, 512)));
                $ico_lib->save_ico($destination."favicon-512x512.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(16, 16)));
                $ico_lib->save_ico($destination."favicon.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(144, 144)));
                $ico_lib->save_ico($destination."ms-icon-144x144.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(70, 70)));
                $ico_lib->save_ico($destination."ms-icon-70x70.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(150, 150)));
                $ico_lib->save_ico($destination."ms-icon-150x150.ico");
                $ico_lib->add_image($destination . $nameImg, array(array(310, 310)));
                $ico_lib->save_ico($destination."ms-icon-310x310.ico");

                $this->ActivityLog("ویرایش لوگو favIcon");
                $this->response_success("لوگو favicon باموفقیت ویرایش شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editLogoSquare($post)
    {
        if (isset($_FILES["image"]["name"])) {
            $dir = "public/images/logos/";

            $type = "logo_square";
            if($post['type']=="dark"){
                $type = "logo_square_dark";
            }

            unlink($dir . $this->getPublicInfo($type));
            $nameImg = time() . "_" . rand(1, 9999) . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $nameImg);

            $sql3 = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";
            $params = [$nameImg, $type];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش لوگو مربعی");
        }

        $this->response_success("لوگو کوچک باموفقیت ویرایش شد");
    }

    function editLogin_admin_background($post)
    {
        if (isset($_FILES["image"]["name"])) {
            $dir = "public/images/";

            unlink($dir . $this->getPublicInfo('login_admin_background'));
            $nameImg = time() . "_" . rand(1, 9999) . "_" . $_FILES['image']['name'];
            move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $nameImg);

            $sql3 = "UPDATE tbl_settings SET `value`=? WHERE `key`=?";
            $params = [$nameImg, "login_admin_background"];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش تصویر پس زمینه صفحه لاگین پنل مدیریت");
        }

        $this->response_success("تصویر بکگراند صفحه لاگین باموفقیت ویرایش شد");
    }

    function getPaymentMethodsAjax($get)
    {
        $columns = array(
            array('db' => 'pay_id', 'dt' => 0),
            array('db' => 'pay_title', 'dt' => 1),
            array('db' => 'pay_desc', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($d != ""){
                        return $d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'user_type', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d == 3){
                        return "کاربران عادی";
                    } else if($d == 4){
                        return "همکاران";
                    } else if($d == 0){
                        return "عمومی";
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'pay_merchant', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    if($d != ""){
                        return $d;
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'pay_status', 'dt' => 5,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pay_id'] . '" data-id="' . $row['pay_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pay_id'] . '" data-id="' . $row['pay_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'pay_id', 'dt' => 6,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش اطلاعات روش پرداخت" data-target="#edit-Modal" id="btn-edit-' . $row['pay_id'] . '" data-id="' . $row['pay_id'] . '" data-name="' . $row['pay_title'] . '" data-description="' . $row['pay_desc'] . '" data-type="' . $row['user_type'] . '" data-merchant="' . $row['pay_merchant'] . '" data-payto="' . $row['pay_to'] . '" data-paytype="' . $row['pay_type'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_payment_methods $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(pay_id) FROM tbl_payment_methods $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(pay_id) FROM tbl_payment_methods");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function editPaymentMethods($post)
    {
        try {
            $sql = "UPDATE tbl_payment_methods SET pay_type=?, pay_to=?, pay_title=?, pay_desc=?, pay_merchant=?, user_type=? WHERE pay_id=?";
            $params = [$post['payment_type'], $post['payment_payTo'], $post['titleEdit'], $post['descriptionEdit'],  $post['merchantEdit'],  $post['typeEdit'], $post['id']];
            $this->doQuery($sql, $params);

            $this->ActivityLog("ویرایش اطلاعات ".$post['titleEdit']." در روش های پرداخت");
            $this->response_success("روش پرداخت ".$post['titleEdit']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function statusPaymentMethodsAjax($post)
    {
        try {
            $this->doQuery("UPDATE tbl_payment_methods SET pay_status=(case when pay_status=1 then 0 else 1 end) WHERE pay_id=?", array($post['id']));
            $result = $this->doSelect("SELECT pay_status, pay_title FROM tbl_payment_methods WHERE pay_id=?", array($post['id']), 1);

            if ($result['pay_status'] == 1) {
                $this->ActivityLog("فعال کردن وضعیت " . $result['pay_title'] . " در روش های پرداخت");
                $this->response_success("روش پرداخت ".$result['pay_title']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعال کردن وضعیت " . $result['pay_title'] . " در روش های پرداخت");
                $this->response_success("روش پرداخت ".$result['pay_title']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function settingsEdit($post, $id)
    {
        if($post['passNew'] != "") {
            $pass = $this->Check_Param($this->hash_value_sha1($this->hash_value_md5($post['passNew'])));
            $this->doQuery("UPDATE tbl_admin SET a_password=? WHERE a_id=?", array($pass, $id));

            $this->ActivityLog("تغییر کلمه عبور");
        }

        $sql = "UPDATE tbl_admin SET a_name=?, a_email=? WHERE a_id=?";
        $params = array($post['name'], $post['email'], $id);
        $this->doQuery($sql, $params);

        $this->ActivityLog("تغییر اطلاعات کاربری");
        $this->response_success("اطلاعات باموفقیت ویرایش شد");
    }

    function dataDelete($post)
    {
        if ($post['userInfo']) {
            $this->doQuery("DELETE FROM tbl_customer");
            $this->doQuery("ALTER TABLE tbl_customer AUTO_INCREMENT=1;");
        }

        if ($post['adminActivity']) {
            $this->doQuery("DELETE FROM tbl_admin_activity");
            $this->doQuery("ALTER TABLE tbl_admin_activity AUTO_INCREMENT=1;");
        }

        $this->response_success("اطلاعات باموفقیت حذف شد");
    }

//    color method
    function getColorAjax($get)
    {
        $columns = array(
            array('db' => 'color_id', 'dt' => 0),
            array(
                'db'        => 'color_name', 'dt' => 1,
                'formatter' => function ($d, $row) {
                    return '<span style="border: 1px solid #000;width: 20px !important;height: 20px !important;display: inline-block;margin: 0px 0 0 5px !important;border-radius: 20px !important;vertical-align: middle;background-color: '.$row["color_code"].';"></span>'.$d;
                }
            ),
            array(
                'db'        => 'color_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    return '<a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit-Modal" id="btn-edit-style-'.$row['color_id'].'" data-code="'.$row['color_code'].'" data-name="'.$row['color_name'].'" data-id="'.$row['color_id'].'">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                <button data-toggle="modal"
                                                        data-target="#del-Modal"
                                                        id="btn-del-style-' . $row['color_id'] . '"
                                                        data-id="' . $row['color_id'] . '"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                                                </button>';
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings,
            "SELECT * FROM tbl_color $where $order $limit"
        );

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT COUNT(color_id) FROM tbl_color $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT COUNT(color_id) FROM tbl_color"
        );
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw"            => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function addColor($post)
    {
        try {
            $result = $this->doSelect("SELECT * FROM tbl_color WHERE color_name=?", array($post['name']));

            if (sizeof($result) > 0) {
                $this->response_warning("رنگ دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_color (color_name,color_code) VALUES (?,?)";
                $params = [$post['name'], $post['code']];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن رنگ " . $post['name'] . " در بخش رنگبندی محصولات فروشگاه");
                $this->response_success("رنگ ".$post['name']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editColor($post)
    {
        try {
            $sql = "UPDATE tbl_color SET color_name=?, color_code=? WHERE color_id=?";
            $params = array($post['name'], $post['code'], $post['id']);
            $this->doQuery($sql, $params);

            $this->ActivityLog("ویرایش رنگ " . $post['name']);
            $this->response_success("رنگ ".$post['name']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delColor($post)
    {
        try {
            $result = $this->doSelect("SELECT color_name FROM tbl_color WHERE color_id=?", array($post['id']));
            if(sizeof($result)>0) {
                $this->ActivityLog("حذف رنگ " . $result['0']['color_name'] . " از بخش رنگبندی محصولات فروشگاه");
                $this->doQuery("DELETE FROM tbl_color WHERE color_id=?", array($post['id']));

                $this->response_success("رنگ مورد نظر باموفقیت حذف شد");
            } else {
                $this->response_error("رنگ مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function getColors($attrId = '')
    {
        if ($attrId != '') {
            $sql = "SELECT * FROM tbl_color WHERE color_id=? AND color_status=1";
            $result = $this->doSelect($sql, array($attrId));
        } else {
            $sql = "SELECT * FROM tbl_color WHERE color_status=1 ORDER BY color_name ASC";
            $result = $this->doSelect($sql);
        }

        return $result;
    }

//    provinces method
    function getProvinceAjax($get)
    {
        $columns = array(
            array('db' => 'pro_id', 'dt' => 0),
            array('db' => 'pro_name', 'dt' => 1),
            array('db' => 'pro_status', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pro_id'] . '" data-id="' . $row['pro_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['pro_id'] . '" data-id="' . $row['pro_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'pro_id', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش استان" data-target="#edit-Modal" id="btn-edit-' . $row['pro_id'] . '" data-id="' . $row['pro_id'] . '" data-name="' . $row['pro_name'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف استان" data-target="#del-Modal" id="btn-del-style-' . $row['pro_id'] . '" data-id="' . $row['pro_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array(""));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_provinces $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(pro_id) FROM tbl_provinces $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(pro_id) FROM tbl_provinces");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function statusProvince($post)
    {
        try {
            $this->doQuery( "UPDATE tbl_provinces SET pro_status=(case when pro_status=1 then 0 else 1 end) WHERE pro_id=?", array($post['id']));

            $result = $this->doSelect("SELECT pro_status, pro_name FROM tbl_provinces WHERE pro_id=?", array($post['id']), 1);
            if ($result['pro_status'] == 1) {
                $this->ActivityLog("فعال کردن وضعیت استان" . $result['pro_name'] . " در بخش استانها");
                $this->response_success("استان ".$result['pro_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعال کردن وضعیت استان" . $result['pro_name'] . " در بخش استان ها");
                $this->response_success("استان ".$result['pro_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addProvince($post)
    {
        try {
            $sql = "SELECT * FROM tbl_provinces WHERE pro_name=?";
            $param = array($post['title']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning("استان دیگری با این مشخصات قبلا ثبت شده است", "exist");
            } else {
                $sql2 = "INSERT INTO tbl_provinces (pro_name) VALUES (?)";
                $this->doQuery($sql2, array($post['title']));

                $this->ActivityLog("افزودن " . $post['title'] . " در استان ها");
                $this->response_success("استان ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editProvince($post)
    {
        try {
            $sql = "UPDATE tbl_provinces SET pro_name=? WHERE pro_id=?";
            $this->doQuery($sql, array($post['titleEdit'], $post['id']));

            $this->ActivityLog("ویرایش اطلاعات استان ".$post['titleEdit']);
            $this->response_success("استان ".$post['titleEdit']." باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delProvince($post)
    {
        try {
            $result = $this->doSelect("SELECT pro_name FROM tbl_provinces WHERE pro_id=?", array($post['id']));
            if(sizeof($result)>0) {
                $this->ActivityLog("حذف استان " . $result['0']['pro_name']);
                $this->doQuery("DELETE FROM tbl_provinces WHERE pro_id=?", array($post['id']));
                $this->doQuery("DELETE FROM tbl_cities WHERE province_id=?", array($post['id']));

                $this->response_success("استان ".$result['0']['pro_name']." باموفقیت حذف شد");
            } else {
                $this->response_error("استان مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

//    cities method
    function getCitiesAjax($get)
    {
        $columns = array(
            array('db' => 'ci_id', 'dt' => 0),
            array('db' => 'ci_name', 'dt' => 1),
            array('db' => 'province_id', 'dt' => 2,
                'formatter' => function ($d, $row) {
                    if($d != 0){
                        $result = $this->doSelect("SELECT pro_name FROM tbl_provinces WHERE pro_id=?", array($d), 1);
                        return $result['pro_name'];
                    } else {
                        return "-";
                    }
                }
            ),
            array('db' => 'ci_status', 'dt' => 3,
                'formatter' => function ($d, $row) {
                    if($d==1){
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ci_id'] . '" data-id="' . $row['ci_id'] . '" class="btn btn-success btn-xs">فعال</button>';
                    } else {
                        return '<button data-toggle="modal" data-target="#status-Modal" id="btn-status-' . $row['ci_id'] . '" data-id="' . $row['ci_id'] . '" class="btn btn-danger btn-xs">غیرفعال</button>';
                    }
                }
            ),
            array('db' => 'pro_id', 'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btn='';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="ویرایش شهر" data-target="#edit-Modal" id="btn-edit-' . $row['ci_id'] . '" data-id="' . $row['ci_id'] . '" data-name="' . $row['ci_name'] . '" data-provinces="' . $row['province_id'] . '" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>';
                    $btn .= '<button style="margin: 1px;" data-toggle="modal" title="حذف شهر" data-target="#del-Modal" id="btn-del-style-' . $row['ci_id'] . '" data-id="' . $row['ci_id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $btn;
                }
            )
        );

        $bindings = array();
        $where = $this->filter($get, $columns, $bindings, array("province_id"));
        $order = $this->order($get, $columns);
        $limit = $this->limit($get, $columns);

        $data = $this->sql_exec($bindings, "SELECT * FROM tbl_cities $where $order $limit");

        // Data set length after filtering
        $resFilterLength = $this->sql_exec($bindings, "SELECT count(ci_id) FROM tbl_cities $where");
        $recordsFiltered = $resFilterLength[0][0];

        // Total data set length
        $resTotalLength = $this->sql_exec("SELECT count(ci_id) FROM tbl_cities");
        $recordsTotal = $resTotalLength[0][0];

        $dataSelect = array(
            "draw" => isset ($get['draw']) ? intval($get['draw']) : 0,
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $this->data_output($columns, $data)
        );

        echo json_encode($dataSelect);
    }

    function getCities()
    {
        return $this->doSelect("SELECT * FROM tbl_cities WHERE ci_status=1");
    }

    function statusCities($post)
    {
        try {
            $this->doQuery("UPDATE tbl_cities SET ci_status=(case when ci_status=1 then 0 else 1 end) WHERE ci_id=?", array($post['id']));
            $result = $this->doSelect("SELECT ci_status, ci_name FROM tbl_cities WHERE ci_id=?", array($post['id']), 1);
            $this->ActivityLog("ویرایش وضعیت شهر ".$result['ci_name']);

            if ($result['ci_status'] == 1) {
                $this->ActivityLog("فعال کردن وضعیت شهر" . $result['ci_name'] . " در بخش شهرها");
                $this->response_success("شهر ".$result['ci_name']." باموفقیت فعال شد", "active");
            } else {
                $this->ActivityLog("غیرفعال کردن وضعیت شهر" . $result['ci_name'] . " در بخش شهرها");
                $this->response_success("شهر ".$result['ci_name']." باموفقیت غیرفعال شد", "deactive");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function addCities($post)
    {
        try {
            $sql = "SELECT * FROM tbl_cities WHERE ci_name=? and province_id=?";
            $param = array($post['title'], $post['provinceId']);
            $result = $this->doSelect($sql, $param);

            if (sizeof($result) > 0) {
                $this->response_warning('شهر دیگری با این مشخصات قبلا ثبت شده است.', "exist");
            } else {
                $sql2 = "INSERT INTO tbl_cities (ci_name,province_id) VALUES (?,?)";
                $params = [$post['title'], $post['provinceId']];
                $this->doQuery($sql2, $params);

                $this->ActivityLog("افزودن " . $post['title'] . " در شهرها");
                $this->response_success("شهر ".$post['title']." با موفقیت ثبت شد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function editCities($post)
    {
        try {
            $sql3 = "UPDATE tbl_cities SET ci_name=?, province_id=? WHERE ci_id=?";
            $params = [$post['titleEdit'], $post['provinceIdEdit'], $post['id']];
            $this->doQuery($sql3, $params);

            $this->ActivityLog("ویرایش اطلاعات شهر ".$post['titleEdit']);
            $this->response_success("شهر مورد نظر باموفقیت ویرایش شد");
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function delCities($post)
    {
        try {
            $result = $this->doSelect("SELECT ci_name FROM tbl_cities WHERE ci_id=?", array($post['id']));
            if(sizeof($result)>0) {
                $this->ActivityLog("حذف شهر " . $result['0']['ci_name'] . " از بخش شهرها");
                $this->doQuery("DELETE FROM tbl_cities WHERE ci_id=?", array($post['id']));

                $this->response_success("شهر " . $result['0']['ci_name'] . " باموفقیت حذف شد");
            } else {
                $this->response_error("شهر مورد نظر یافت نشد");
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}

?>
