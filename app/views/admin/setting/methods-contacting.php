<?php function displayList($list) { ?>
<ol class="dd-list">
    <?php foreach($list as $item) { ?>
        <?php
            $dataInfo = array(
                "id" => $item['mc_id'],
                "title" => $item['mc_title'],
                "link" => $item['mc_link'],
                "description" => $item['mc_description'],
                "show_in_float_button" => $item['mc_show_in_float_button'],
                "show_in_float_button_slider" => $item['mc_show_in_float_button_slider'],
                "show_in_footer" => $item['mc_show_in_footer'],
                "show_in_login_page" => $item['mc_show_in_login_page'],
                "show_in_mobile" => $item['mc_show_in_mobile'],
                "show_in_desktop" => $item['mc_show_in_desktop']
            );
        ?>
        <li class="dd-item dd3-item <?= array_key_exists("children", $item) ? "dd-collapsed":"" ?>" data-id="<?= $item["mc_id"]; ?>">
            <div class="dd-handle dd3-handle"><?= $item["mc_title"]; ?></div>
            <div class="dd3-content">
                <span><?= $item["mc_title"]; ?></span>
                <div class='pull-left'>
                    <?php if($item["mc_status"] == "1"){ ?>
                        <button style="margin: 1px;" data-toggle="modal" title="وضعیت" data-target="#status-Modal" id="btn-status-<?= $item["mc_id"]; ?>" data-id="<?= $item["mc_id"]; ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                    <?php } else { ?>
                        <button style="margin: 1px;" data-toggle="modal" title="وضعیت" data-target="#status-Modal" id="btn-status-<?= $item["mc_id"]; ?>" data-id="<?= $item["mc_id"]; ?>" class="btn btn-danger btn-xs"><i class="fa fa-eye-slash"></i></button>
                    <?php } ?>
                    <button style="margin: 1px;" data-toggle="modal" title="ویرایش" data-target="#edit-Modal" id="btn-edit-<?= $item["mc_id"]; ?>" data-id="<?= $item["mc_id"]; ?>" data-info='<?= json_encode($dataInfo, true) ?>' class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>
                </div>
            </div>
        </li>
    <?php } ?>
</ol>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>تنظیمات راه های ارتباطی | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/css/jquery.nestable.css">
    <link href="public/css/tagsinput.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="public/panel/plugins/colorpicker/bootstrap-colorpicker.min.css">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <?php require('app/views/admin/include/header.php'); ?>
    </header>

    <aside class="main-sidebar direction">
        <?php require('app/views/admin/include/sidebar.php'); ?>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>تنظیمات راه های ارتباطی</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/methodsContacting"><i class="fa fa-weixin"></i> Methods contacting</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="margin" dir="ltr"></div>

            <div dir="rtl">
                <div class="row mx-0">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="box aside-create-user-page">
                            <div class="box-header">
                                <h4 class="box-header-title">
                                    تنظیمات
                                </h4>
                            </div>
                            <div class="box-body pl-0">
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#methodsContacting" role="tab" id="methodsContacting-tab" data-toggle="tab" aria-controls="methodsContacting" aria-expanded="true">لیست راه های ارتباطی</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#floatButton" id="floatButton-tab" role="tab" data-toggle="tab" aria-controls="floatButton" aria-expanded="false">دکمه شناور</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#floatButtonMenu" id="floatButtonMenu-tab" role="tab" data-toggle="tab" aria-controls="floatButtonMenu" aria-expanded="false">منوی دکمه شناور</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="tab-content content-user-page mt-4" id="myTabContent">
                            <div class="tab-pane fade active in" role="tabpanel" id="methodsContacting" aria-labelledby="methodsContacting-tab">
                                <form id="informationForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">لیست راه های ارتباطی</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div data-intro="با استفاده از ماوس می توانید لینک های زیر را جا به جا نمایید. برای داشتن زیر منو می توانید لینک مورد نظر را به سمت چپ یا راست با استفاده از ماوس بکشید." class="cf nestable-lists" dir="rtl">
                                                        <div class="dd" id="nestable">
                                                            <?= displayList($data['getMethodsContacting']); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="floatButton" aria-labelledby="floatButton-tab">
                                <form id="informationForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات دکمه شناور</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact">:دکمه شناور تماس با ما</label>
                                                            <div class="input-group">
                                                                <select id="float_contact" name="float_contact" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['status'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['float_contact'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_position">:موقعیت دکمه در صفحه</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_position" name="float_contact_position" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_position'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_position'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-columns"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_size">:سایز دکمه</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_size" name="float_contact_size" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_size'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_size'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-columns"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_color">:رنگ دکمه</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['float_contact_color']; ?>" class="form-control my-colorpicker1" id="float_contact_color" name="float_contact_color" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_text">:متن دکمه</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['float_contact_text']; ?>" class="form-control" id="float_contact_text" name="float_contact_text" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_icons_animation_speed">:سرعت انیمیشن آیکن ها</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="number" value="<?= $data['getPublicInfo']['float_contact_icons_animation_speed']; ?>" class="form-control" id="float_contact_icons_animation_speed" name="float_contact_icons_animation_speed" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon">میلی ثانیه</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_icons_animation_pause">:مکث انیمیشن آیکن ها</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="number" value="<?= $data['getPublicInfo']['float_contact_icons_animation_pause']; ?>" class="form-control" id="float_contact_icons_animation_pause" name="float_contact_icons_animation_pause" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon">میلی ثانیه</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_online_badge">:نشان آنلاین روی دکمه</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_online_badge" name="float_contact_online_badge" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['status'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_online_badge'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['float_contact_online_badge'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_floatContactSetting" type="button" onclick="saveInfo('floatContactSetting')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="floatButtonMenu" aria-labelledby="floatButtonMenu-tab">
                                <form id="floatButtonMenuForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات منوی دکمه شناور</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_size">سایز منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_size" name="float_contact_menu_size" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_menu_size'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_size'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-columns"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_backdrop">پس زمینه تیره بیرون منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_backdrop" name="float_contact_menu_backdrop" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['status'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_backdrop'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['float_contact_online_badge'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_show_header">نمایش هدر در منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_show_header" name="float_contact_menu_show_header" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_show_header'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['float_contact_menu_show_header'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_show_header_close_btn">نمایش دکمه بستن منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_show_header_close_btn" name="float_contact_menu_show_header_close_btn" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_show_header_close_btn'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['float_contact_menu_show_header_close_btn'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_header_close_btn_bg_color">رنگ پس زمینه دکمه بستن:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['float_contact_menu_header_close_btn_bg_color']; ?>" class="form-control my-colorpicker1" id="float_contact_menu_header_close_btn_bg_color" name="float_contact_menu_header_close_btn_bg_color" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_header_close_btn_color">رنگ متن دکمه بستن:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['float_contact_menu_header_close_btn_color']; ?>" class="form-control my-colorpicker1" id="float_contact_menu_header_close_btn_color" name="float_contact_menu_header_close_btn_color" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_header_text">متن هدر:</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['float_contact_menu_header_text']; ?>" class="form-control" id="float_contact_menu_header_text" name="float_contact_menu_header_text" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_sub_header_text">متن فرعی هدر:</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['float_contact_menu_sub_header_text']; ?>" class="form-control" id="float_contact_menu_sub_header_text" name="float_contact_menu_sub_header_text" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_items_icon_type">نحوه نمایش آیتم های منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_items_icon_type" name="float_contact_items_icon_type" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_items_icon_type'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_items_icon_type'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-ellipsis-h"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_popup_style">نحوه نمایش منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_popup_style" name="float_contact_menu_popup_style" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_menu_popup_style'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_popup_style'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_popup_animation">انیمیشن پاپ اپ منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_popup_animation" name="float_contact_popup_animation" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_popup_animation'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_popup_animation'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-magic"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_sidebar_animation">انیمیشن منوی کشویی منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_sidebar_animation" name="float_contact_sidebar_animation" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_sidebar_animation'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_sidebar_animation'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-magic"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_items_animation">انیمیشن آیتم های منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_items_animation" name="float_contact_menu_items_animation" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['float_contact_menu_items_animation'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_items_animation'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-magic"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="float_contact_menu_click_away">بستن منو با کلیک بیرون از منو:</label>
                                                            <div class="input-group">
                                                                <select id="float_contact_menu_click_away" name="float_contact_menu_click_away" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <?php foreach ($data['getDomainsInfo']['status'] as $item) { ?>
                                                                        <option <?= $data['getPublicInfo']['float_contact_menu_click_away'] == $item['domain_code'] ? "selected='selected'" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                            <?= $item['domain_title']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-mouse-pointer"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_floatButtonMenu" type="button" onclick="saveInfo('floatButtonMenu')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
    </div>
    <!-- /.content-wrapper -->

    <div dir="rtl" class="modal fade" id="edit-Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ویرایش راه ارتباطی </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="titleEdit">عنوان:</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="linkEdit">لینک:</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="linkEdit" name="linkEdit" required="">
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="descriptionEdit">توضیحات مختصر:</label>
                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="descriptionEdit" name="descriptionEdit" required></textarea>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_float_buttonEdit">نمایش در منوی دکمه شناور:</label>
                                <select id="show_in_float_buttonEdit" name="show_in_float_buttonEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_float_button_sliderEdit">نمایش در اسلایدر دکمه شناور:</label>
                                <select id="show_in_float_button_sliderEdit" name="show_in_float_button_sliderEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_footerEdit">نمایش در فوتر:</label>
                                <select id="show_in_footerEdit" name="show_in_footerEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_login_pageEdit">نمایش در صفحه لاگین:</label>
                                <select id="show_in_login_pageEdit" name="show_in_login_pageEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_mobileEdit">نمایش در موبایل:</label>
                                <select id="show_in_mobileEdit" name="show_in_mobileEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" for="show_in_desktopEdit">نمایش در دسکتاپ:</label>
                                <select id="show_in_desktopEdit" name="show_in_desktopEdit" class="form-control" style="width: 100%;">
                                    <?php foreach ($data['getDomainsInfo']['yes_no'] as $item) { ?>
                                        <option value="<?= $item['domain_code']; ?>">
                                            <?= $item['domain_title']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <p class="email-wrap">
                            <input id="edit-val" type="hidden" value="#"/>
                        </p>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <div class="row" style="margin-right: 0;margin-left: 15px;">
                        <div class="sign-up-inside-login">
                            <button id="edit-submit" class="btn btn-danger">ویرایش</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div dir="rtl" class="modal fade" id="status-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">تغییر وضعیت</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از تغییر وضعیت این لینک اطمینان دارید؟</label>
                            <input id="status-val" type="hidden" value="#"/>
                        </p>
                        <div class="row" style="margin-right: 0;margin-left: 15px;">
                            <div class="sign-up-inside-login">
                                <button id="status-submit" class="btn btn-danger">ویرایش</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>در صورت فعال بودن، در لیست های مورد نیاز نمایش داده خواهد شد.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="public/js/jquery.nestable.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
<script src="public/js/tagsinput.js"></script>
<script src="public/panel/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<script>
    $('.my-colorpicker1').colorpicker();
</script>

<script>
    $(document).ready(function () {
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target), output = list.data('output');

            if (navigator.onLine) {
                $.ajax({
                    method: "POST",
                    url: "<?= ADMIN_PATH; ?>/saveMethodsContactingPriority",
                    data: {
                        list: list.nestable('serialize')
                    }
                }).fail(function(jqXHR, textStatus, errorThrown){
                    $.wnoty({type: 'error', message: 'متاسفانه خطایی رخ داده است.'});
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        };

        $('#nestable').nestable({
            'group': 1,
            'maxLevels': 2,
            'maxDepth': 1,
            'effect': {
                'animation': 'fade',
                'time': 'slow'
            },
        }).on('change', updateOutput);
    });
</script>

<script>
    $(document).on("click", "[id*=btn-edit-]", function () {
        let info = $(this).data('info');
        $("#edit-val").val(info.id);
        $("#titleEdit").val(info.title);
        $("#linkEdit").val(info.link);
        $("#descriptionEdit").val(info.description);
        $("#show_in_float_buttonEdit").val(info.show_in_float_button).change();
        $("#show_in_float_button_sliderEdit").val(info.show_in_float_button_slider).change();
        $("#show_in_footerEdit").val(info.show_in_footer).change();
        $("#show_in_login_pageEdit").val(info.show_in_login_page).change();
        $("#show_in_mobileEdit").val(info.show_in_mobile).change();
        $("#show_in_desktopEdit").val(info.show_in_desktop).change();

        const popup = ["16", "17", "18"];
        console.log("id", info.id);
        if(popup.includes(info.id)){
            $("#show_in_footerEdit").prop('disabled', true);
            $("#show_in_login_pageEdit").prop('disabled', true);
        } else {
            $("#show_in_footerEdit").prop('disabled', false);
            $("#show_in_login_pageEdit").prop('disabled', false);
        }
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById('titleEdit').value;
        var linkEdit = document.getElementById('linkEdit').value;
        var descriptionEdit = document.getElementById('descriptionEdit').value;
        var show_in_float_buttonEdit = document.getElementById('show_in_float_buttonEdit').value;
        var show_in_float_button_sliderEdit = document.getElementById('show_in_float_button_sliderEdit').value;
        var show_in_footerEdit = document.getElementById('show_in_footerEdit').value;
        var show_in_login_pageEdit = document.getElementById('show_in_login_pageEdit').value;
        var show_in_mobileEdit = document.getElementById('show_in_mobileEdit').value;
        var show_in_desktopEdit = document.getElementById('show_in_desktopEdit').value;

        if (navigator.onLine) {
            var formData = new FormData();
            if(titleEdit == ""){
                $.wnoty({type: 'warning', message: 'عنوان را وارد کنید.'});
            } else {
                formData.append("id", id);
                formData.append("titleEdit", titleEdit);
                formData.append("linkEdit", linkEdit);
                formData.append("descriptionEdit", descriptionEdit);
                formData.append("show_in_float_buttonEdit", show_in_float_buttonEdit);
                formData.append("show_in_float_button_sliderEdit", show_in_float_button_sliderEdit);
                formData.append("show_in_footerEdit", show_in_footerEdit);
                formData.append("show_in_login_pageEdit", show_in_login_pageEdit);
                formData.append("show_in_mobileEdit", show_in_mobileEdit);
                formData.append("show_in_desktopEdit", show_in_desktopEdit);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editMethodsContacting",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            var info = {
                                "id": id,
                                "title": titleEdit,
                                "link": linkEdit,
                                "description": descriptionEdit,
                                "show_in_float_button": show_in_float_buttonEdit,
                                "show_in_float_button_slider": show_in_float_button_sliderEdit,
                                "show_in_footer": show_in_footerEdit,
                                "show_in_login_page": show_in_login_pageEdit,
                                "show_in_mobile": show_in_mobileEdit,
                                "show_in_desktop": show_in_desktopEdit
                            }
                            $("#btn-edit-" + id).data('info', info);
                        }
                    },
                });
            }
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-status-]", function () {
        document.getElementById("status-val").value = $(this).data('id');
    });

    $(document).on("click", "#status-submit", function () {
        if (navigator.onLine) {
            $('#status-Modal').modal('hide');
            var id = document.getElementById('status-val').value;

            var formData = new FormData();
            formData.append("id", id);
            formData.append("type", "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/statusMethodsContacting",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status==="active") {
                        $("#btn-status-" + id).removeClass("btn-danger").addClass("btn-success");
                        document.getElementById("btn-status-" + id).innerHTML = '<i class="fa fa-eye"></i>';
                    } else if (data.status==="deactive") {
                        $("#btn-status-" + id).removeClass("btn-success").addClass("btn-danger");
                        document.getElementById("btn-status-" + id).innerHTML = '<i class="fa fa-eye-slash"></i>';
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#float_contact_icons_animation_speed,#float_contact_icons_animation_pause").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    function saveInfo(part) {
        var formData = new FormData();

        if(part == "floatContactSetting"){
            formData.append("float_contact", document.getElementById("float_contact").value);
            formData.append("float_contact_position", document.getElementById("float_contact_position").value);
            formData.append("float_contact_size", document.getElementById("float_contact_size").value);
            formData.append("float_contact_color", document.getElementById("float_contact_color").value);
            formData.append("float_contact_text", document.getElementById("float_contact_text").value);
            formData.append("float_contact_icons_animation_speed", document.getElementById("float_contact_icons_animation_speed").value);
            formData.append("float_contact_icons_animation_pause", document.getElementById("float_contact_icons_animation_pause").value);
            formData.append("float_contact_online_badge", document.getElementById("float_contact_online_badge").value);
        } else if(part == "floatButtonMenu"){
            formData.append("float_contact_menu_size", document.getElementById("float_contact_menu_size").value);
            formData.append("float_contact_menu_backdrop", document.getElementById("float_contact_menu_backdrop").value);
            formData.append("float_contact_menu_show_header", document.getElementById("float_contact_menu_show_header").value);
            formData.append("float_contact_menu_show_header_close_btn", document.getElementById("float_contact_menu_show_header_close_btn").value);
            formData.append("float_contact_menu_header_close_btn_bg_color", document.getElementById("float_contact_menu_header_close_btn_bg_color").value);
            formData.append("float_contact_menu_header_close_btn_color", document.getElementById("float_contact_menu_header_close_btn_color").value);
            formData.append("float_contact_menu_header_text", document.getElementById("float_contact_menu_header_text").value);
            formData.append("float_contact_menu_sub_header_text", document.getElementById("float_contact_menu_sub_header_text").value);
            formData.append("float_contact_items_icon_type", document.getElementById("float_contact_items_icon_type").value);
            formData.append("float_contact_menu_popup_style", document.getElementById("float_contact_menu_popup_style").value);
            formData.append("float_contact_popup_animation", document.getElementById("float_contact_popup_animation").value);
            formData.append("float_contact_sidebar_animation", document.getElementById("float_contact_sidebar_animation").value);
            formData.append("float_contact_menu_items_animation", document.getElementById("float_contact_menu_items_animation").value);
            formData.append("float_contact_menu_click_away", document.getElementById("float_contact_menu_click_away").value);
        }

        $("#btnsubmit_"+part).html("در حال ویرایش...");
        $("#btnsubmit_"+part).attr("disabled", "disabled");

        if (navigator.onLine) {
            formData.append("part", part);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/methodsContactingEdit",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    $("#btnsubmit_"+part).html("ویرایش");
                    $("#btnsubmit_"+part).removeAttr("disabled");
                }
            });
        } else {
            $("#btnsubmit_"+part).html("ویرایش");
            $("#btnsubmit_"+part).removeAttr("disabled");
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
        }
    }
</script>

</body>
</html>