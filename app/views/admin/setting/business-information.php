<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>تنظیمات و اطلاعات کسب و کار | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
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
                <small>تنظیمات پیکربندی</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/businessInformation"><i class="fa fa-cog"></i> Setting & Business information</a></li>
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
                                        <a href="#information" id="information-tab" role="tab" data-toggle="tab" aria-controls="information" aria-expanded="true">عمومی</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#businessInformation" id="businessInformation-tab" role="tab" data-toggle="tab" aria-controls="businessInformation" aria-expanded="false">اطلاعات کسب و کار</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#header" id="header-tab" role="tab" data-toggle="tab" aria-controls="header" aria-expanded="false">پیام اطلاع رسانی</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#footer" id="footer-tab" role="tab" data-toggle="tab" aria-controls="footer" aria-expanded="false">فوتر</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#logoes" role="tab" id="logoes-tab" data-toggle="tab" aria-controls="logoes" aria-expanded="false">لوگو و تصاویر</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#comments" role="tab" id="comments-tab" data-toggle="tab" aria-controls="comments" aria-expanded="false">دیدگاه</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#payment" role="tab" id="payment-tab" data-toggle="tab" aria-controls="payment" aria-expanded="false">روش های پرداخت</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#sms" role="tab" id="sms-tab" data-toggle="tab" aria-controls="sms" aria-expanded="false">پنل پیامک</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#telegramBot" role="tab" id="telegramBot-tab" data-toggle="tab" aria-controls="telegramBot" aria-expanded="false">ربات تلگرام</a>
                                    </li>
                                    <li role="presentation" class="">
                                        <a href="#recaptcha" role="tab" id="recaptcha-tab" data-toggle="tab" aria-controls="recaptcha" aria-expanded="false">ریکپچا گوگل</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="tab-content content-user-page mt-4" id="myTabContent">

                            <div class="tab-pane fade active in" role="tabpanel" id="information" aria-labelledby="information-tab">
                                <form id="informationForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات عمومی</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div data-intro="عنوان سایت خود را در این بخش وارد نمایید." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="site">:عنوان سایت</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right"
                                                                       type="text"
                                                                       value="<?= $data['getPublicInfo']['site']; ?>"
                                                                       class="form-control" id="site" name="site" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="عنوان خلاصه سایت خود را در این بخش وارد نمایید." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="site_short_name">:عنوان خلاصه سایت</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right"
                                                                       type="text"
                                                                       value="<?= $data['getPublicInfo']['site_short_name']; ?>"
                                                                       class="form-control" id="site_short_name" name="site_short_name" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="از موتورهای جستجو درخواست کن تا محتوای سایت را بررسی نکنند." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="site_public">:نمایش به موتورهای جستجو</label>
                                                            <div class="input-group">
                                                                <select id="site_public" name="site_public" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['site_public']=="index" ? "selected":""; ?> value="index">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['site_public']=="noindex" ? "selected":""; ?> value="noindex">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['site_public'] == "index" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="در صورت فعال بودن این بخش کاربر می تواند از کیف پول استفاده کند و آن را شارژ و برای خریدها از آن استفاده نماید" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="active_wallet">:کیف پول</label>
                                                            <div class="input-group">
                                                                <select id="active_wallet" name="active_wallet" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['active_wallet']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['active_wallet']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['active_wallet'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="blog_item_per_page">:تعداد مطالب وبلاگ در هر صفحه</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['blog_item_per_page']; ?>" class="form-control" id="blog_item_per_page" name="blog_item_per_page" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="service_item_per_page">:تعداد خدمات در هر صفحه</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['service_item_per_page']; ?>" class="form-control" id="service_item_per_page" name="service_item_per_page" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="customJS_position">:محل اضافه شدن کدهای سفارشی</label>
                                                            <div class="input-group">
                                                                <select id="customJS_position" name="customJS_position" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['customJS_position']=="top" ? "selected":""; ?> value="top">داخل تگ هد</option>
                                                                    <option <?= $data['getPublicInfo']['customJS_position']=="bottom" ? "selected":""; ?> value="bottom">انتهای برگه</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="با تغییر دادن این مسیر، مسیر دایرکتوری از دیفالت admin به مقدار مورد نظر شما تغییر پیدا خواهد کرد." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label dir="rtl" align="right" for="admin_path">
                                                                <span data-toggle="tooltip" title="" class="badge bg-light-blue circle" data-original-title="با تغییر دادن این مسیر، مسیر دایرکتوری از دیفالت admin به مقدار مورد نظر شما تغییر پیدا خواهد کرد."><i class="fa fa-info"></i></span>
                                                                مسیر دایرکتوری پنل مدیریت:
                                                            </label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['admin_path']; ?>" class="form-control" id="admin_path" name="admin_path" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="مدت زمان ذخیره سازی کوکی ها را بر اساس تعداد روز در این بخش وارد نمایید." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="cookie_duration">:مدت زمان ذخیره کوکی ها (روز)</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['cookie_duration']; ?>" class="form-control" id="cookie_duration" name="cookie_duration" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="در صورت فعال بودن این بخش فقط پنل مدیریت فعال خواهد بود" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="development_mode">:حالت توسعه (خاموشی فروشگاه)</label>
                                                            <div class="input-group">
                                                                <select id="development_mode" name="development_mode" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['development_mode']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['development_mode']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['development_mode'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12' style="padding: 0">
                                                        <div data-intro="متن حالت توسعه را در این بخش بنویسید. به جای صفحه اصلی سایت این متن به کاربران نمایش داده خواهد شد." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="development_mode_text">:متن حالت توسعه</label>
                                                                <div class="input-group">
                                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:right;direction: rtl"  class="form-control" rows="5" id="development_mode_text"  name="development_mode_text"><?= $data['getPublicInfo']['development_mode_text']; ?></textarea>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="توضیحی مختصر در مورد کسب و کار خود در این بخش بنویسید. این بخش در مت تگ description نمایش داده می شود." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="meta_description">:توضیحات سایت</label>
                                                                <div class="input-group">
                                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:right;direction: rtl" class="form-control" rows="5" id="meta_description" name="meta_description"><?= $data['getPublicInfo']['meta_description']; ?></textarea>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="کلمات کلیدی در مورد برند خود را در این بخش بنویسید. این کلمات در متا تگ keyword نمایش داده می شود." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="meta_keyword">:کلمات کلیدی سایت</label>
                                                                <div class="input-group">
                                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:right;direction: rtl" class="form-control" rows="10" id="meta_keyword" name="meta_keyword"><?= $data['getPublicInfo']['meta_keyword']; ?></textarea>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="چنانچه از ابزار خاصی مانند گوگل آنالیتیکس یا... می خواهید استفاده نمایید کد آن را در این بخش می توانید بنویسید." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label dir="rtl" align="right" for="customJS">کدسفارشی (Google Analytics, نوتیفیکیشن, چت آنلاین و...):</label>
                                                                <div class="input-group">
                                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:left;direction: ltr" class="form-control" rows="10" id="customJS" name="customJS"><?= $data['getPublicInfo']['customJS']; ?></textarea>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="نمایش بنر تستی بودن فروشگاه در بالای هدر سایت" class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label dir="rtl" align="right" for="admin_ip_lock">محدود کردن Ip های قابل دسترسی به پنل مدیریت:</label>
                                                            <div class="input-group">
                                                                <select id="admin_ip_lock" name="admin_ip_lock" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['admin_ip_lock']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['admin_ip_lock']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['admin_ip_lock'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="لیست آی پی های مجاز برای دسترسی به پنل مدیریت را در این بخش وارد نمایید." class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label dir="rtl" align="right" for="admin_ip">IP های مجاز(ای پی فعلی شما: <?= $data['user_ip'] ?>):</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left;display: none" type="text" value="<?= $data['getPublicInfo']['admin_ip']; ?>" class="form-control" id="admin_ip" name="admin_ip[]" data-role="tagsinput">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-internet-explorer"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="display: none" data-intro="کد رنگ مورد نظر خود را انتخاب نمایید این رنگ در استاتوس بار موبایل استفاده خواهد شد." class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="theme_color">:رنگ قالب</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['theme_color']; ?>" class="form-control my-colorpicker1" id="theme_color" name="theme_color" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="display: none" data-intro="برای نمایش دکمه شناور تماس با ما در صفحات سایت می توانید از این گزینه استفاده نمایید." class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="offline_mode">:حالت آفلاین پنل مدیریت</label>
                                                            <div class="input-group">
                                                                <select id="offline_mode" name="offline_mode" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['offline_mode'] == "1" ? "selected='selected'" : "" ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['offline_mode'] == "0" ? "selected='selected'" : "" ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['offline_mode'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_publicSetting" type="button" onclick="saveInfo('publicSetting')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="businessInformation" aria-labelledby="businessInformation-tab">
                                <form id="businessInformationForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">اطلاعات کسب و کار</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="legal_name">نام قانونی کسب و کار:</label>
                                                            <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['legal_name']; ?>" class="form-control" id="legal_name" name="legal_name" required>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="management_name">نام و نام خانوادگی مدیریت مجموعه:</label>
                                                            <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['management_name']; ?>" class="form-control" id="management_name" name="management_name" required>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="business_type">نوع کسب و کار:</label>
                                                            <select id="business_type" name="business_type" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                <option disabled="" selected="" hidden=""></option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="1" ? "selected='selected'":""; ?> value="1">خدماتی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="2" ? "selected='selected'":""; ?> value="2">بازرگانی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="3" ? "selected='selected'":""; ?> value="3">تولیدی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="4" ? "selected='selected'":""; ?> value="4">مختلط</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="5" ? "selected='selected'":""; ?> value="5">اینترنتی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="6" ? "selected='selected'":""; ?> value="6">خانگی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="7" ? "selected='selected'":""; ?> value="7">تک مالکیتی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="8" ? "selected='selected'":""; ?> value="8">شراکت</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="9" ? "selected='selected'":""; ?> value="9">شرکت سهامی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="10" ? "selected='selected'":""; ?> value="10">شرکت با مسئولیت‌های محدود</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="11" ? "selected='selected'":""; ?> value="11">شرکت تعاونی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="12" ? "selected='selected'":""; ?> value="12">روستایی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="13" ? "selected='selected'":""; ?> value="13">خانوادگی</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="14" ? "selected='selected'":""; ?> value="14">کوچک</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="15" ? "selected='selected'":""; ?> value="15">واسطه ‌گری</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="16" ? "selected='selected'":""; ?> value="16">تجاری</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="17" ? "selected='selected'":""; ?> value="17">کامپیوتری</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="18" ? "selected='selected'":""; ?> value="18">فناوری و اطلاعات</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="19" ? "selected='selected'":""; ?> value="19">مالی و سرمایه ‌گذاری</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="20" ? "selected='selected'":""; ?> value="20">وابسته به موبایل</option>
                                                                <option <?= $data['getPublicInfo']['business_type']=="21" ? "selected='selected'":""; ?> value="21">دانشگاهی</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="field_of_activity">زمینه فعالیت:</label>
                                                            <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['field_of_activity']; ?>" class="form-control" id="field_of_activity" name="field_of_activity" required>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="national_id">شناسه ملی:</label>
                                                            <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['national_id']; ?>" class="form-control" id="national_id" name="national_id" required>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="economic_code">کد اقتصادی:</label>
                                                            <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['economic_code']; ?>" class="form-control" id="economic_code" name="economic_code" required>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="registration_number">شماره ثبت:</label>
                                                            <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left"  type="text" value="<?= $data['getPublicInfo']['registration_number']; ?>" class="form-control" id="registration_number" name="registration_number" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class='row'>
                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="province">استان:</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['province']; ?>" class="form-control" id="province" name="province" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="city">شهر:</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['city']; ?>" class="form-control" id="city" name="city" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="postal_code">کدپستی:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['postal_code']; ?>" class="form-control" id="postal_code" name="postal_code" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="address">آدرس:</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['address']; ?>" class="form-control" id="address" name="address" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="location" dir="rtl">آدرس iframe نقشه گوگل (جهت نمایش در صفحه ارتباط با ما):</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['location']; ?>" class="form-control" id="location" name="location" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-map-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_businessInfo" type="button" onclick="saveInfo('businessInfo')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="header" aria-labelledby="header-tab">
                                <form id="headerForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات پیام اطلاع رسانی در هدر</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div class='col-md-12' style="padding: 0">
                                                        <div data-intro="نمایش بنر اطلاع سانی فروشگاه در بالای هدر سایت" class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="notification">:بنر اطلاع رسانی</label>
                                                                <div class="input-group">
                                                                    <select id="notification" name="notification" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                        <option <?= $data['getPublicInfo']['notification']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                        <option <?= $data['getPublicInfo']['notification']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                    </select>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['notification'] == "1" ? "on" : "off" ?>"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="موقعیت متن اطلاع سانی" class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="notification_text_position">:موقعیت متن</label>
                                                                <div class="input-group">
                                                                    <select id="notification_text_position" name="notification_text_position" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                        <?php foreach ($data['getDomainsInfo']['notification_text_position'] as $item) { ?>
                                                                            <option <?= $data['getPublicInfo']['notification_text_position'] == $item['domain_code'] ? "selected" : "" ?> value="<?= $item['domain_code']; ?>">
                                                                                <?= $item['domain_title']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>

                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-align-<?= $data['getPublicInfo']['notification_text_position'] ?>"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="کد رنگ مورد نظر خود را انتخاب نمایید این رنگ به عنوان رنگ پس زمینه استفاده خواهد شد." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="notification_background_color">:رنگ پس زمینه اطلاع رسانی</label>
                                                                <div class="input-group">
                                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['notification_background_color']; ?>" class="form-control my-colorpicker1" id="notification_background_color" name="notification_background_color" required>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="کد رنگ مورد نظر خود را انتخاب نمایید این رنگ به عنوان رنگ متن اطلاع رسانی استفاده خواهد شد." class='col-md-6'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="notification_text_color">:رنگ متن اطلاع رسانی</label>
                                                                <div class="input-group">
                                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['getPublicInfo']['notification_text_color']; ?>" class="form-control my-colorpicker1" id="notification_text_color" name="notification_text_color" required>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div data-intro="متن اطلاع رسانی را در این بخش وارد نمایید." class='col-md-12'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label align="right" for="notification_message">:متن اطلاع رسانی</label>
                                                                <div class="input-group">
                                                                    <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['notification_message']; ?>" class="form-control" id="notification_message" name="notification_message" required>
                                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-font"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_header" type="button" onclick="saveInfo('header')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="footer" aria-labelledby="footer-tab">
                                <form id="footerForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات فوتر</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="footer_logo">:نمایش لوگو</label>
                                                            <div class="input-group">
                                                                <select id="footer_logo" name="footer_logo" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['footer_logo']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['footer_logo']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['footer_logo'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class='row'>
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="enamad_link">:لینک نماد اعتماد</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['enamad_link']; ?>" class="form-control" id="enamad_link" name="enamad_link" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="enamad_image">:تصویر نماد اعتماد</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['enamad_image']; ?>" class="form-control" id="enamad_image" name="enamad_image" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-image"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="samandehi_link">:لینک نماد ساماندهی</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['samandehi_link']; ?>" class="form-control" id="samandehi_link" name="samandehi_link" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="samandehi_image">:تصویر نماد ساماندهی</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['samandehi_image']; ?>" class="form-control" id="samandehi_image" name="samandehi_image" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-image"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="zarinpal_link">:لینک نماد زرین پال</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['zarinpal_link']; ?>" class="form-control" id="zarinpal_link" name="zarinpal_link" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-link"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="zarinpal_image">:تصویر نماد زرین پال</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['zarinpal_image']; ?>" class="form-control" id="zarinpal_image" name="zarinpal_image" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-image"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="copyright">:متن کپی رایت</label>
                                                            <div class="input-group">
                                                                <input style="direction: rtl;border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $data['getPublicInfo']['copyright']; ?>" class="form-control" id="copyright" name="copyright" required="">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-copyright"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="متنی کوتاه در مورد سایت در این بخش بنویسید. این متن برای نمایش در فوتر استفاده می شود." class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="footer_about">:متن درباره ما در فوتر</label>
                                                            <div class="input-group">
                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right;direction: rtl" class="form-control" rows="5" id="footer_about" name="footer_about"><?= $data['getPublicInfo']['footer_about']; ?></textarea>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_footer" type="button" onclick="saveInfo('footer')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="payment" aria-labelledby="payment-tab">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">تنظیمات روش های پرداخت</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive direction">
                                            <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                                    <th class="priority-1" style="text-align:center">عنوان</th>
                                                    <th class="priority-1" style="text-align:center">توضیحات</th>
                                                    <th class="priority-1" style="text-align:center">دسترسی</th>
                                                    <th class="priority-1" style="text-align:center;">مرچنت آیدی</th>
                                                    <th class="priority-1" style="text-align:center">وضعیت</th>
                                                    <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                                    <th class="priority-1" style="text-align:center">عنوان</th>
                                                    <th class="priority-1" style="text-align:center">توضیحات</th>
                                                    <th class="priority-1" style="text-align:center">دسترسی</th>
                                                    <th class="priority-1" style="text-align:center;">مرچنت آیدی</th>
                                                    <th class="priority-1" style="text-align:center">وضعیت</th>
                                                    <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="sms" aria-labelledby="sms-tab">
                                <form id="smsForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات پنل پیامک</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div data-intro="برای ارسال وضعیت سفارشات و پیامک ورود برای کابران می توانید از این بخش وضعیت ارسال پیامک را انتخاب نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_status">ارسال پیامک:</label>
                                                            <div class="input-group">
                                                                <select id="sms_status" name="sms_status" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['sms_status'] == "1" ? "selected='selected'" : "" ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['sms_status'] == "0" ? "selected='selected'" : "" ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['sms_status'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="می توانید از این بخش شرکت ارائه دهنده پنل پیامک را انتخاب نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_site">پنل پیامک:</label>
                                                            <div class="input-group">
                                                                <select id="sms_site" name="sms_site" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['sms_site'] == "sms_ir" ? "selected='selected'" : "" ?> value="sms_ir">ایده پردازان (sms.ir)</option>
                                                                    <option <?= $data['getPublicInfo']['sms_site'] == "faraz" ? "selected='selected'" : "" ?> value="faraz">فراز اس ام اس</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="API_Key دریافتی از پنل پیامکی را در این بخش وارد نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_api_key">API_Key:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['sms_api_key']; ?>" class="form-control" id="sms_api_key" name="sms_api_key" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="Secret_Key دریافتی از پنل پیامکی را در این بخش وارد نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_secret_key">Secret_Key:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['sms_secret_key']; ?>" class="form-control" id="sms_secret_key" name="sms_secret_key" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-key"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="شماره ای که با آن پیامک ها ارسال می شود را در این بخش وارد نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_number">شماره ارسال:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['sms_number']; ?>" class="form-control" id="sms_number" name="sms_number" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr/>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_template_for_forget_password_admin">کد پیامک فراموشی رمزعبور ادمین:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['sms_template_for_forget_password_admin']; ?>" class="form-control" id="sms_template_for_forget_password_admin" name="sms_template_for_forget_password_admin" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="sms_template_login">کد پیامک تایید شماره موبایل کاربر:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['sms_template_login']; ?>" class="form-control" id="sms_template_login" name="sms_template_login" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <strong class="col-md-12 pt-2 pb-2">
                                                        <a href="#" class="green" data-toggle="modal" data-target="#versmsmodal">نمایش الگوهای اعتبارسنجی</a>
                                                    </strong>
                                                </div>

                                                <div class="modal fade" style="display: none;" id="versmsmodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">فهرست الگوهای اعتبارسنجی</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-3 px-3">
                                                                <p class="text-muted"><strong>راهنما:</strong></p>
                                                                <p class="pb-4">وارد پنل پیامکی خود شوید، سپس الگو‌های زیر را یک به یک ثبت کرده و منتظر تایید بمانید، پس از تایید شدن الگوها از طرف پنل پیامکی خود، می‌توانید حالت ارسال پیامک را فعال نمایید.</p>
                                                                <p class="pb-4">توجه داشته باشید که از عبارتی که در متن نمونه گفته شده در متن پیامک استفاده کنید تا ارسال به درستی انجام شود</p>
                                                                <p class="font-weight-bold">1. الگوی پیام ورود به حساب کاربری</p>
                                                                <div class="w-100">
                                                                    <p>نام الگو: <code class="eng">تایید شماره موبایل کاربر</code></p>
                                                                    <p>متن پیام: </p>
                                                                    <p>
                                                                        <code>
                                                                            سلام<br/>
                                                                            کد تایید شما <span class="eng">VerificationCode</span> می باشد.<br/>
                                                                            <?= $data['getPublicInfo']['site_short_name']; ?>
                                                                        </code>
                                                                    </p>
                                                                </div>

                                                                <p class="font-weight-bold">2. الگوی پیام فراموشی رمزعبور ادمین</p>
                                                                <div class="w-100">
                                                                    <p>نام الگو: <code class="eng">فراموشی رمزعبور ادمین</code></p>
                                                                    <p>متن پیام: </p>
                                                                    <p>
                                                                        <code>
                                                                            رمز ورود جدید:  <span class="eng">VerificationCode</span><br/>
                                                                            <?= $data['getPublicInfo']['site_short_name']; ?>
                                                                        </code>
                                                                    </p>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer text-center">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">پنهان کردن</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_sms" type="button" onclick="saveInfo('sms')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="recaptcha" aria-labelledby="recaptcha-tab">
                                <form id="recaptchaForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات ریکپچا 3 گوگل (امنیتی)</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div data-intro="برای فعالسازی ریکپچای گوگل می توانید از این بخش استفاده نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="google_captcha_status">وضعیت ریکپچای گوگل:</label>
                                                            <div class="input-group">
                                                                <select id="google_captcha_status" name="google_captcha_status" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['google_captcha_status'] == "1" ? "selected='selected'" : "" ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['google_captcha_status'] == "0" ? "selected='selected'" : "" ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['google_captcha_status'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="google_captcha_site_key">کلید عمومی گوگل کپچا (Site Key):</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['google_captcha_site_key']; ?>" class="form-control" id="google_captcha_site_key" name="google_captcha_site_key" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-google"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="google_secret_site_key">کلید خصوصی گوگل کپچا (Secret Key):</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['google_secret_site_key']; ?>" class="form-control" id="google_secret_site_key" name="google_secret_site_key" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-google"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_googleCaptcha" type="button" onclick="saveInfo('googleCaptcha')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="telegramBot" aria-labelledby="telegramBot-tab">
                                <form id="telegramBotForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات ربات تلگرام</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class="box-header" style="padding-top: 20px; background: #ff482a; margin-bottom: 15px;border-radius: 7px">
                                                            <p style="color: #fff"> ⚠️ توجه: بعد از ساخت ربات در بات فادر، می بایست آن را در تمامی کانال های مورد نظر خود ادمین کنید و دسترسی ارسال پیام را به ربات بدهید</p>
                                                        </div>
                                                    </div>

                                                    <div data-intro="برای فعالسازی ربات تلگرام می توانید از این بخش استفاده نمایید." class='col-md-4'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="bot_status">وضعیت ربات:</label>
                                                            <div class="input-group">
                                                                <select id="bot_status" name="bot_status" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['bot_status'] == "1" ? "selected='selected'" : "" ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['bot_status'] == "0" ? "selected='selected'" : "" ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['bot_status'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="برای اینکه بتوانید مطالب بخش وبلاگ را در کانال خود منتشر نمایید می بایست یک ربات در بات فادر بسازید و توکن دریافتی را در این بخش وارد نمایید. توجه داشته باشید که ربات ساخته شده حتما می بایست در کانال شما ادمین باشد تا امکان ارسال پیام داشته باشد." class='col-md-8'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="bot_token">توکن ربات تلگرام:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['bot_token']; ?>" class="form-control" id="bot_token" name="bot_token" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="آیدی کانال تلگرام خود را  به همراه @ در این بخش وارد نمایید" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="channel_service_reservation">آیدی عددی کانال تلگرام برای خدمات:<a style="direction: rtl;color: #3d3d3d" title="برای یافتن آیدی عددی یک پیام از کانال را به ربات @myIdRobot ارسال نمایید."><i style="margin-left: 5px" class="fa fa-question-circle"></i></a>
                                                            </label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['channel_service_reservation']; ?>" class="form-control" id="channel_service_reservation" name="channel_service_reservation" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="آیدی کانال تلگرام خود را  به همراه @ در این بخش وارد نمایید" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="channel_payment">آیدی عددی کانال تلگرام برای پرداخت ها: <a style="direction: rtl;color: #3d3d3d" title="برای یافتن آیدی عددی یک پیام از کانال را به ربات @myIdRobot ارسال نمایید."><i style="margin-left: 5px" class="fa fa-question-circle"></i></a>
                                                            </label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['channel_payment']; ?>" class="form-control" id="channel_payment" name="channel_payment" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="آیدی کانال تلگرام خود را  به همراه @ در این بخش وارد نمایید" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="channel_blog">آیدی عددی کانال تلگرام برای وبلاگ:<a style="direction: rtl;color: #3d3d3d" title="برای یافتن آیدی عددی یک پیام از کانال را به ربات @myIdRobot ارسال نمایید."><i style="margin-left: 5px" class="fa fa-question-circle"></i></a></label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="url" value="<?= $data['getPublicInfo']['channel_blog']; ?>" class="form-control" id="channel_blog" name="channel_blog" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_telegramBot" type="button" onclick="saveInfo('telegramBot')" class="btn btn-dropbox">ویرایش</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="logoes" aria-labelledby="logoes-tab">
                                <form id="logoForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات لوگو و تصاویر</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div class="col-md-12">
                                                        <div class="box-header" style="background: #1291f3; padding-top: 20px; margin-bottom: 15px;border-radius: 7px">
                                                            <p style="color: #fff">بعد از تغییر تصاویر برای اعمال و مشاهده تغییرات حتما کش مرورگر خود را پاک نمایید.</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">لوگو (حالت روشن):</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="logo_light" style="direction: rtl;">انتخاب تصویر (سایز مناسب 299*697):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/*" onchange="previewImg(this,'prevLogo')" id="logo_light"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center">
                                                                                <img height="130px" src="public/images/logos/<?= $data['getPublicInfo']['logo']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevLogo"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmitLogo" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">لوگو کوچک (حالت روشن):</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="logo_square" style="direction: rtl;">انتخاب تصویر (سایز مناسب 300*300):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/*" onchange="previewImg(this,'prevLogoSquare')" id="logo_square"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center">
                                                                                <img height="130px" src="public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevLogoSquare"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmitLogoSquare" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">لوگو (حالت تاریک):</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="logo_dark" style="direction: rtl;">انتخاب تصویر (سایز مناسب 299*697):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/*" onchange="previewImg(this,'prevLogoDark')" id="logo_dark"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center;background: rgba(14, 35, 56,1);">
                                                                                <img height="130px" src="public/images/logos/<?= $data['getPublicInfo']['logo_dark']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevLogoDark"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmitLogoDark" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">لوگو کوچک (حالت تاریک):</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="logo_square_dark" style="direction: rtl;">انتخاب تصویر (سایز مناسب 300*300):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/*" onchange="previewImg(this,'prevLogoSquareDark')" id="logo_square_dark"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center;background: rgba(14, 35, 56,1);">
                                                                                <img height="130px" src="public/images/logos/<?= $data['getPublicInfo']['logo_square_dark']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevLogoSquareDark"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmitLogoSquareDark" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">تصویر Favicon:</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="favicon" style="direction: rtl;">انتخاب تصویر png (سایز مناسب 512*512):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/png,image/svg" onchange="previewImg(this,'prevFavIcon')" id="favicon"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center">
                                                                                <img height="130px" src="public/images/favicon/<?= $data['getPublicInfo']['favicon']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevFavIcon"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmiFavicon" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <div class="col-md-12" style="border: 1px solid #eee;border-radius: 7px;">
                                                            <div class="box-header with-border">
                                                                <h3 dir="rtl" class="box-title">پس زمینه پنل مدیریت:</h3>
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body">
                                                                <div class="box-body">
                                                                    <div class='row'>
                                                                        <div class='col-md-12'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label for="login_admin_background" style="direction: rtl;">انتخاب تصویر (سایز مناسب 720*1080):</label>
                                                                            </div>
                                                                            <div>
                                                                                <input style="margin-top: -10px;float: right;" type='file' accept="image/*" onchange="previewImg(this,'prevLogin_admin_background')" id="login_admin_background"/>
                                                                            </div>
                                                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center">
                                                                                <img height="130px" src="public/images/<?= $data['getPublicInfo']['login_admin_background']; ?>" onerror="this.src='public/images/Album+Cover+icon2-01.png'" style="max-width: 100%;max-height: 100px;" id="prevLogin_admin_background"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <input id="btnSubmitLogin_admin_background" class="btn btn-dropbox" value="ویرایش" type="submit">
                                                                </div>
                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="comments" aria-labelledby="comments-tab">
                                <form id="informationForm" onsubmit="return false;">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">تنظیمات دیدگاه</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="box-body" dir="ltr">
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="comment_item_per_page">:تعداد نمایش دیدگاه ها در هر صفحه</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['comment_item_per_page']; ?>" class="form-control" id="comment_item_per_page" name="comment_item_per_page" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="comment_limit_for_user">:محدود سازی تعداد دیدگاه برای هر کاربر</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="tel" value="<?= $data['getPublicInfo']['comment_limit_for_user']; ?>" class="form-control" id="comment_limit_for_user" name="comment_limit_for_user" required>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-code"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="در این بخش می توانید مشخص کنید که نظرات به چه صورت تایید شوند" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="comment_confirm_method">:نحوه تایید دیدگاه</label>
                                                            <div class="input-group">
                                                                <select id="comment_confirm_method" name="comment_confirm_method" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['comment_confirm_method']=="auto" ? "selected":""; ?> value="auto">تایید خودکار</option>
                                                                    <option <?= $data['getPublicInfo']['comment_confirm_method']=="admin" ? "selected":""; ?> value="admin">تایید توسط ادمین</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['comment_confirm_method'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="در صورت فعال بودن این گزینه کاربران می توانند نظرات را پاسخ دهند" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="comment_reply_button">:دکمه پاسخ به دیدگاه</label>
                                                            <div class="input-group">
                                                                <select id="comment_reply_button" name="comment_reply_button" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['comment_reply_button']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['comment_reply_button']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['comment_reply_button'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="در صورت فعال بودن این گزینه نظرات فقط برای کاربرانی که به حساب کاربری خود وارد شده باشند نمایش داده می شود" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label align="right" for="comment_show_for_login_user">:نمایش دیدگاه فقط برای کاربران سایت</label>
                                                            <div class="input-group">
                                                                <select id="comment_show_for_login_user" name="comment_show_for_login_user" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['comment_show_for_login_user']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['comment_show_for_login_user']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['comment_show_for_login_user'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div data-intro="وضعیت بررسی کلمات ممنوع به صورت اتوماتیک" class='col-md-6'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label dir="rtl" align="right" for="comment_word_check">بررسی کلمات ممنوع:</label>
                                                            <div class="input-group">
                                                                <select id="comment_word_check" name="comment_word_check" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                                    <option <?= $data['getPublicInfo']['comment_word_check']=="1" ? "selected":""; ?> value="1">فعال</option>
                                                                    <option <?= $data['getPublicInfo']['comment_word_check']=="0" ? "selected":""; ?> value="0">غیرفعال</option>
                                                                </select>
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-toggle-<?= $data['getPublicInfo']['comment_word_check'] == "1" ? "on" : "off" ?>"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div data-intro="لیست کلمات ممنوعی که کاربر نباید در متن نظر خود استفاده کند را در این بخش وارد نمایید." class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label dir="rtl" align="right" for="comment_word_forbidden">کلمات ممنوع:</label>
                                                            <div class="input-group">
                                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left;display: none" type="text" value="<?= $data['getPublicInfo']['comment_word_forbidden']; ?>" class="form-control" id="comment_word_forbidden" name="comment_word_forbidden[]" data-role="tagsinput">
                                                                <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-align-right"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="box-footer">
                                                    <button id="btnsubmit_comments" type="button" onclick="saveInfo('comments')" class="btn btn-dropbox">ویرایش</button>
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

    <div dir="rtl" class="modal fade" id="status-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">تغییر وضعیت روش پرداخت</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از تغییر وضعیت این روش پرداخت اطمینان دارید؟</label>
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
                <div class="modal-footer"
                     style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>در صورت فعال بودن، روش پرداخت در لیست های مورد نیاز نمایش داده خواهد شد.</span>
                </div>
            </div>
        </div>
    </div>

    <div dir="rtl" class="modal fade" id="edit-Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ویرایش روش پرداخت</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-6">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="titleEdit">عنوان روش پرداخت:</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="merchantEdit">مرچنت آیدی:</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="merchantEdit" name="merchantEdit" required="">
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="descriptionEdit">توضیحات :</label>
                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="descriptionEdit" name="descriptionEdit" required></textarea>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="typeEdit">نوع دسترسی این روش پرداخت:</label>
                                <select id="typeEdit" name="typeEdit" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                    <option value="0">عمومی</option>
                                    <option value="1">مدیر سایت</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="payment_payTo">مقصد:</label>
                                <select id="payment_payTo" name="payment_payTo" class="form-control" style="border-radius: 3px;width: 100%;" required>
                                    <?php foreach ($data['cashInfo'] as $type) { ?>
                                        <option  value="<?= $type['cash_vids_id']; ?>"><?= $type['c_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="payment_type">نحوه پرداخت:</label>
                                <select id="payment_type" name="payment_type" class="form-control" style="border-radius: 3px;width: 100%;" required>
                                    <option data-id="cash" value="cash">صندوق (نقدی-آفلاین)</option>
                                    <option data-id="bank" value="bank">حساب بانکی متصل (آنلاین)</option>
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
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
<script src="public/js/tagsinput.js"></script>
<script src="public/panel/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<script>
    $('.my-colorpicker1').colorpicker();
</script>

<script>
    function previewImg(input, id) {
        if (input.files && input.files[0]) {
            if (input.files[0].size / 1024 / 1024 <= 1) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#" + id).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                $.wnoty({type: 'error', message: 'حجم تصویر می بایست کمتر از 1 مگابایت باشد.'});
                $("#" + input.id).val("");
                $("#" + id).attr("src", "public/images/placeholder.jpg");
            }
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#registration_number,#national_id,#economic_code,#registration_number,#postal_code,#telegram_channel_for_payments,#telegram_channel_for_orders").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnSubmitLogin_admin_background").on('click', function () {
        var input = document.getElementById("login_admin_background");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editLogin_admin_background",
                            data: formData,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            },
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $("#btnSubmitLogo").on('click', function () {
        var input = document.getElementById("logo_light");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    formData.append("type", "light");
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editLogo",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $("#btnSubmitLogoDark").on('click', function () {
        var input = document.getElementById("logo_dark");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    formData.append("type", "dark");
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editLogo",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $("#btnSubmitLogoSquare").on('click', function () {
        var input = document.getElementById("logo_square");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    formData.append("type", "light");
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editLogoSquare",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $("#btnSubmitLogoSquareDark").on('click', function () {
        var input = document.getElementById("logo_square_dark");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    formData.append("type", "dark");
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editLogoSquare",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $("#btnSubmiFavicon").on('click', function () {
        var input = document.getElementById("favicon");

        file = input.files[0];
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("image", file);
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editFavIcon",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        }
                    );
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'warning', message: 'یک تصویر معتبر انتخاب کنید.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'یک تصویر انتخاب کنید.'});
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-status-]", function () {
        document.getElementById("status-val").value = $(this).data('id');
    });

    $(document).on("click", "#status-submit", function () {
        $('#status-Modal').modal('hide');
        var id = document.getElementById('status-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/statusPaymentMethodsAjax",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status ==="active") {
                        $("#btn-status-" + id).removeClass("btn-danger").addClass("btn-success");
                        document.getElementById("btn-status-" + id).innerHTML = 'فعال';
                    } else if (data.status ==="deactive") {
                        $("#btn-status-" + id).removeClass("btn-success").addClass("btn-danger");
                        document.getElementById("btn-status-" + id).innerHTML = 'غیرفعال';
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-edit-]", async function () {
        document.getElementById("edit-val").value = $(this).data('id');
        $("#titleEdit").val($(this).data('name'));
        $("#descriptionEdit").val($(this).data('description'));
        $("#merchantEdit").val($(this).data('merchant'));
        $("#typeEdit").val($(this).data('type')).change();
        $("#payment_type").val($(this).data('paytype')).change();
        await getPaymentType($(this).data('payto'));
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById('titleEdit').value;
        var merchantEdit = document.getElementById('merchantEdit').value;
        var descriptionEdit = document.getElementById('descriptionEdit').value;
        var typeEdit = document.getElementById("typeEdit").value;
        var payment_type = document.getElementById("payment_type").value;
        var payment_payTo = document.getElementById("payment_payTo").value;

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("titleEdit", titleEdit);
            formData.append("merchantEdit", merchantEdit);
            formData.append("descriptionEdit", descriptionEdit);
            formData.append("typeEdit", typeEdit);
            formData.append("payment_type", payment_type);
            formData.append("payment_payTo", payment_payTo);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editPaymentMethods",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().html(titleEdit);
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().html(descriptionEdit);
                        $("#btn-edit-"+id).parent().prev().prev().prev().html($('#typeEdit option:selected').text());
                        $("#btn-edit-"+id).parent().prev().prev().html(merchantEdit);

                        $("#btn-edit-"+id).data('name', titleEdit);
                        $("#btn-edit-"+id).data('merchant', merchantEdit);
                        $("#btn-edit-"+id).data('description', descriptionEdit);
                        $("#btn-edit-"+id).data('type', typeEdit);
                        $("#btn-edit-"+id).data('paytype', payment_type);
                        $("#btn-edit-"+id).data('payto', payment_payTo);
                    }
                }
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
        }
    });
</script>

<script>
    $(function () {
        let status_state_inp, type_state_inp = null;
        $('#example1 tfoot th').each(function () {
            var title = $(this).text();
            if (title == "ردیف") {
                $(this).html('-');
            } else if (title == "عملیات") {
                $(this).html('-');
            } else {
                $(this).html('<input style="text-align: start;unicode-bidi: plaintext;" type="text" placeholder="جستجو ' + title + '" />');
            }
        });

        $.fn.dataTable.pipeline = function (opts) {
            var conf = $.extend({
                pages: 5,     // number of pages to cache
                url: '',      // script url
                data: null,   // function or object with parameters to send to the server matching how `ajax.data` works in DataTables
                method: 'GET' // Ajax HTTP method
            }, opts);

            // Private variables for storing the cache
            var cacheLower = -1;
            var cacheUpper = null;
            var cacheLastRequest = null;
            var cacheLastJson = null;

            return function (request, drawCallback, settings) {
                var ajax = false;
                var requestStart = request.start;
                var drawStart = request.start;
                var requestLength = request.length;
                var requestEnd = requestStart + requestLength;

                if (settings.clearCache) {
                    ajax = true;
                    settings.clearCache = false;
                } else if (cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper) {
                    ajax = true;
                } else if (JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
                    JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
                    JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
                ) {
                    ajax = true;
                }

                cacheLastRequest = $.extend(true, {}, request);

                if (ajax) {
                    if (requestStart < cacheLower) {
                        requestStart = requestStart - (requestLength * (conf.pages - 1));

                        if (requestStart < 0) {
                            requestStart = 0;
                        }
                    }

                    cacheLower = requestStart;
                    cacheUpper = requestStart + (requestLength * conf.pages);

                    request.start = requestStart;
                    request.length = requestLength * conf.pages;

                    if (typeof conf.data === 'function') {
                        var d = conf.data(request);
                        if (d) {
                            $.extend(request, d);
                        }
                    } else if ($.isPlainObject(conf.data)) {
                        $.extend(request, conf.data);
                    }

                    settings.jqXHR = $.ajax({
                        "type": conf.method,
                        "url": conf.url,
                        "data": request,
                        "dataType": "json",
                        "cache": true,
                        "success": function (json) {
                            cacheLastJson = $.extend(true, {}, json);

                            if (cacheLower != drawStart) {
                                json.data.splice(0, drawStart - cacheLower);
                            }
                            if (requestLength >= -1) {
                                json.data.splice(requestLength, json.data.length);
                            }

                            drawCallback(json);
                        }
                    });
                } else {
                    json = $.extend(true, {}, cacheLastJson);
                    json.draw = request.draw;
                    json.data.splice(0, requestStart - cacheLower);
                    json.data.splice(requestLength, json.data.length);

                    drawCallback(json);
                }
            }
        };

        $.fn.dataTable.Api.register('clearPipeline()', function () {
            return this.iterator('table', function (settings) {
                settings.clearCache = true;
            });
        });

        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "rowReorder": true,
            "stateSave": true,
            "stateLoadParams": function(settings, data) {
                const  select_array = [0, 1, 2, "", 4, "", 6];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            switch(i){
                                case 3:
                                    type_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                                case 5:
                                    status_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                            }
                        }
                    }
                }
            },
            "pageLength": 10,
            "autoWidth": true,
            "processing": true,
            "fixedHeader": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, 99999999], [10, 25, 50, 100, "همه"]],
            "dom": '<"top"Bf>rt<"bottom"lip><"clear">',
            "buttons": [
                {
                    extend: 'collection',
                    text: '<span class="fa fa-download"></span> خروجی اطلاعات',
                    buttons: [
                        {
                            extend: 'print',
                            text: '<span class="fa fa-print"></span> پرینت',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    search: 'applied',
                                    order: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<span class="fa fa-file-excel-o"></span> خروجی اکسل',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    search: 'applied',
                                    order: 'applied'
                                }
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<span class="fa fa-file-excel-o"></span> خروجی csv',
                            "charset": "utf-8",
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    search: 'applied',
                                    order: 'applied'
                                }
                            }
                        }
                    ]
                },
                {
                    extend: 'colvis',
                    // collectionLayout: 'two-column',
                    postfixButtons: [ 'colvisRestore' ],
                    text: '<span class="fa fa-filter"></span> فیلتر ستون ها'
                }
            ],
            language: {
                buttons: {
                    colvisRestore: "نمایش همه"
                }
            },
            "columnDefs": [
                {orderable: false, targets: [6]},
                {className: "priority-1", "targets": [0, 1, 2, 3, 4, 5, 6]},
                {className: "priority-2", "targets": []}
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: "<?= ADMIN_PATH; ?>/getPaymentMethodsAjax",
                pages: 5
            }), initComplete: function () {
                this.api().columns(3).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب نوع دسترسی</option><option value="">همه موارد</option><option value="0">عمومی</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == type_state_inp){
                            $(select).children().eq(d).attr("selected", true);
                        }
                    });
                });
                this.api().columns(5).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب وضعیت</option><option value="">همه موارد</option><option value="1">فعال</option><option value="0">غیرفعال</option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == status_state_inp){
                            $(select).children().eq(d).attr("selected", true);
                        }
                    });
                });
            }
        });

        table.on('draw.dt', function () {
            var info = table.page.info();
            table.column(0, {search: 'applied', order: 'applied', page: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

        table.columns().every(function () {
            var column = this;
            $('input', this.footer()).on('keyup change', function () {
                if (column.search() !== this.value) {
                    column.search(this.value).draw();
                }
            });
        });

        $('#example1 tfoot tr').appendTo('#example1 thead');
    });
</script>

<script>
    function saveInfo(part) {
        var formData = new FormData();

        if(part == "publicSetting"){
            formData.append("site", document.getElementById("site").value);
            formData.append("site_short_name", document.getElementById("site_short_name").value);
            formData.append("meta_keyword", document.getElementById("meta_keyword").value);
            formData.append("site_public", document.getElementById("site_public").value);
            formData.append("theme_color", document.getElementById("theme_color").value);
            formData.append("offline_mode", document.getElementById("offline_mode").value);
            formData.append("meta_description", document.getElementById("meta_description").value);
            formData.append("admin_path", document.getElementById("admin_path").value);
            formData.append("development_mode", document.getElementById("development_mode").value);
            formData.append("active_wallet", document.getElementById("active_wallet").value);
            formData.append("customJS_position", document.getElementById("customJS_position").value);
            formData.append("blog_item_per_page", document.getElementById("blog_item_per_page").value);
            formData.append("service_item_per_page", document.getElementById("service_item_per_page").value);
            formData.append("development_mode_text", document.getElementById("development_mode_text").value);
            formData.append("admin_ip_lock", document.getElementById("admin_ip_lock").value);
            formData.append("admin_ip", document.getElementById("admin_ip").value);
            formData.append("customJS", document.getElementById("customJS").value);
            formData.append("cookie_duration", document.getElementById("cookie_duration").value);
        } else if(part == "header"){
            formData.append("notification", document.getElementById("notification").value);
            formData.append("notification_message", document.getElementById("notification_message").value);
            formData.append("notification_text_position", document.getElementById("notification_text_position").value);
            formData.append("notification_background_color", document.getElementById("notification_background_color").value);
            formData.append("notification_text_color", document.getElementById("notification_text_color").value);
        } else if(part == "footer"){
            formData.append("footer_logo", document.getElementById("footer_logo").value);
            formData.append("footer_about", document.getElementById("footer_about").value);
            formData.append("copyright", document.getElementById("copyright").value);
            formData.append("enamad_link", document.getElementById("enamad_link").value);
            formData.append("enamad_image", document.getElementById("enamad_image").value);
            formData.append("samandehi_link", document.getElementById("samandehi_link").value);
            formData.append("samandehi_image", document.getElementById("samandehi_image").value);
            formData.append("zarinpal_link", document.getElementById("zarinpal_link").value);
            formData.append("zarinpal_image", document.getElementById("zarinpal_image").value);
        } else if(part == "businessInfo"){
            formData.append("legal_name", document.getElementById("legal_name").value);
            formData.append("management_name", document.getElementById("management_name").value);
            formData.append("business_type", document.getElementById("business_type").value);
            formData.append("field_of_activity", document.getElementById("field_of_activity").value);
            formData.append("national_id", document.getElementById("national_id").value);
            formData.append("economic_code", document.getElementById("economic_code").value);
            formData.append("registration_number", document.getElementById("registration_number").value);
            formData.append("province", document.getElementById("province").value);
            formData.append("city", document.getElementById("city").value);
            formData.append("address", document.getElementById("address").value);
            formData.append("postal_code", document.getElementById("postal_code").value);
            formData.append("location", document.getElementById("location").value);
        } else if(part == "sms"){
            formData.append("sms_status", document.getElementById("sms_status").value);
            formData.append("sms_site", document.getElementById("sms_site").value);
            formData.append("sms_api_key", document.getElementById("sms_api_key").value);
            formData.append("sms_secret_key", document.getElementById("sms_secret_key").value);
            formData.append("sms_number", document.getElementById("sms_number").value);
            formData.append("sms_template_for_forget_password_admin", document.getElementById("sms_template_for_forget_password_admin").value);
            formData.append("sms_template_login", document.getElementById("sms_template_login").value);
        } else if(part == "googleCaptcha"){
            formData.append("google_captcha_status", document.getElementById("google_captcha_status").value);
            formData.append("google_captcha_site_key", document.getElementById("google_captcha_site_key").value);
            formData.append("google_secret_site_key", document.getElementById("google_secret_site_key").value);
        } else if(part == "telegramBot"){
            formData.append("bot_status", document.getElementById("bot_status").value);
            formData.append("bot_token", document.getElementById("bot_token").value);
            formData.append("channel_service_reservation", document.getElementById("channel_service_reservation").value);
            formData.append("channel_payment", document.getElementById("channel_payment").value);
            formData.append("channel_blog", document.getElementById("channel_blog").value);
        } else if(part == "comments"){
            formData.append("comment_item_per_page", document.getElementById("comment_item_per_page").value);
            formData.append("comment_limit_for_user", document.getElementById("comment_limit_for_user").value);
            formData.append("comment_confirm_method", document.getElementById("comment_confirm_method").value);
            formData.append("comment_reply_button", document.getElementById("comment_reply_button").value);
            formData.append("comment_show_for_login_user", document.getElementById("comment_show_for_login_user").value);
            formData.append("comment_word_check", document.getElementById("comment_word_check").value);
            formData.append("comment_word_forbidden", document.getElementById("comment_word_forbidden").value);
        }

        $("#btnsubmit_"+part).html("در حال ویرایش...");
        $("#btnsubmit_"+part).attr("disabled", "disabled");

        if (navigator.onLine) {
            formData.append("part", part);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/businessInformationEdit",
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

<script>
    function getPaymentType(itemSelected) {
        var timeout_iter = 0;
        jQuery.ajax({
            url: "<?= ADMIN_PATH; ?>/getPaymentType?id=" + $("#payment_type").find(':selected').val(),
            type: 'GET',
            dataType: "json",
            timeout: 25000,
            headers: {"Content-type": "application/json"},
            error: function (xhr, status, error) {
                if (status == 'timeout') {
                    timeout_iter++;
                    if (timeout_iter <= 2) {
                        $.ajax(this);
                        return;
                    } else {
                        $.wnoty({type: 'warning', message: 'پاسخی از سرور دریافت نشد.'});
                    }
                } else if (xhr.status == 500) {
                    $.wnoty({type: 'warning', message: 'لطفا دوباره تلاش کنید.'});
                } else if (xhr.readyState == 0) {
                    $.wnoty({type: 'warning', message: 'خطا در ارتباط اینترنتی لطفا دوباره تلاش کنید.'});
                }
            },
            success: function (json) {
                $('#payment_payTo').html('');
                $.each(json, function (key, value) {
                    $('#payment_payTo').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
                $("#payment_payTo").val(itemSelected).change();
            },
        });
    }
</script>

</body>
</html>