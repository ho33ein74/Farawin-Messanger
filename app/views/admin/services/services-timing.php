<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>زمان بندی خدمت <?= $data['serviceInfo']['s_title'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/panel/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="public/panel/plugins/iCheck/all.css">
    <link rel="stylesheet" href="public/css/bootstrap-clockpicker.min.css">
    <style>
        @media (max-width: 768px){
            .fc-header-toolbar {
                display: inline-block !important;
                float: none !important;
                text-align: center;
            }

            .fc .fc-toolbar-title {
                text-align: center;
                margin: 10px;
            }

            .fc .fc-col-header-cell-cushion {
                font-size: 10px;
            }
        }

        .popover {z-index: 999999999;}
    </style>
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
                <small>زمان بندی خدمت <?= $data['serviceInfo']['s_title'] ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li class="active">Timing</li>
            </ol>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="margin" dir="ltr"></div>

            <div dir="rtl">
                <div class="row mx-0">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="box aside-create-user-page">
                            <div class="box-body pl-0">
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#turn-days" role="tab" id="turn-days-tab" data-toggle="tab" aria-controls="turn-days" aria-expanded="true">بازه های زمانی</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#turn-setting" role="tab" id="turn-setting-tab" data-toggle="tab" aria-controls="turn-setting" aria-expanded="false">تنظیمات</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div id="tips_custom_day" class="box box-default collapsed-box">
                            <div class="box-header with-border" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                <h3 class="box-title">نکات تب تاریخ دلخواه</h3>
                            </div>
                            <div class="box-body" style="display: none;">
                                <div class="box-header">
                                    <p>
                                        1- چنانچه می خواهید زمانبندی های قابل نمایش در سایت صرفا برای یک تاریخ خاص باشد می توانید از این بخش استفاده نمایید.
                                    </p>
                                    <p>
                                        2- برای کارکرد صحیح این بخش پس از تعیین تاریخ های مورد نظر می بایست تنظیمات روز مورد نظر خود را بر روی گزینه "استفاده از تاریخ های دلخواه تعریف شده" تنظیم نمایید.
                                    </p>
                                    <p>
                                        3- ساعت تنظیم شده در این بخش صرفا در تاریخی که مشخص شده است نمایش داده خواهد شد.
                                    </p>
                                    <p>
                                        4- برای تعریف ساعت بر روی تاریخ مورد نظر خود کلیک کرده و در پنجره باز شده ساعات مورد نظر خود را ثبت نمایید.
                                    </p>
                                    <p>
                                        5- نشان (🟢) در سمت راست ساعت ها نشانه فعال و (🔴) نشانه غیرفعال بودن وضعیت ساعت می&zwnj;باشد.
                                    </p>
                                    <p>
                                        6- نشان (💎) در جلوی ساعات نمایشی نشانه ویژه بودن ساعت می باشد.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="tips_default" style="display: none;" class="box box-default collapsed-box">
                            <div class="box-header with-border" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                <h3 class="box-title">نکات تب پیش فرض</h3>
                            </div>
                            <div class="box-body" style="display: none;">
                                <div class="box-header">
                                    <p>
                                        1- برای کارکرد صحیح این بخش پس از تعیین زمان های مورد نظر می بایست تنظیمات روز مورد نظر خود را بر روی گزینه "استفاده از بازه های زمانی پیش فرض" تنظیم نمایید.
                                    </p>
                                    <p>
                                        2- چنانچه می خواهید برای روزهای مختلف زمانبندی متفاوتی در نظر بگیرید کافیست از تب روز مورد نظر خود گزینه "تعریف بازه های زمانی دلخواه به صورت کلی" را انتخاب نمایید.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="tips_holiday" style="display: none;" class="box box-default collapsed-box">
                            <div class="box-header with-border" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                <h3 class="box-title">نکات تب تعطیلات</h3>
                            </div>
                            <div class="box-body" style="display: none;">
                                <div class="box-header">
                                    <p>
                                        1- روزهای تعطیل رسمی را می توانید در بخش <a class="btn btn-foursquare" target="_blank" href="<?= ADMIN_PATH; ?>/holidays">مدیریت روزهای تعطیل</a> تعریف کنید.
                                    </p>
                                    <p>
                                        2- چنانچه گزینه استفاده از تاریخ های دلخواه تعریف شده را انتخاب کنید، اگر تاریخ انتخابی جزو تعطیلات باشد ساعت های تعریف شده نمایش داده خواهد شد.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="tab-content content-user-page mt-4" id="myTabContent">
                            <div class="tab-pane fade active in" role="tabpanel" id="turn-days" aria-labelledby="turn-days-tab">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_custom_day" data-toggle="tab" aria-expanded="true">تاریخ دلخواه</a></li>
                                        <li><a href="#tab_default" data-toggle="tab" aria-expanded="false">پیش فرض</a></li>
                                        <li><a href="#tab_holiday" data-toggle="tab" aria-expanded="false">تعطیلات</a></li>
                                        <li><a href="#tab_saturday" data-toggle="tab" aria-expanded="false">شنبه</a></li>
                                        <li><a href="#tab_sunday" data-toggle="tab" aria-expanded="false">یکشنبه</a></li>
                                        <li><a href="#tab_monday" data-toggle="tab" aria-expanded="false">دوشنبه</a></li>
                                        <li><a href="#tab_tuesday" data-toggle="tab" aria-expanded="true">سه شنبه</a></li>
                                        <li><a href="#tab_wednesday" data-toggle="tab" aria-expanded="false">چهارشنبه</a></li>
                                        <li><a href="#tab_thursday" data-toggle="tab" aria-expanded="false">پنج شنبه</a></li>
                                        <li><a href="#tab_friday" data-toggle="tab" aria-expanded="false">جمعه</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_custom_day">
                                            <div class="col-md-12">
                                                <div id="calendar"></div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_default">
                                            <form id="defaultForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" name="day" value="default">
                                                <input type="hidden" name="default_program" value="custom">
                                                <input type="hidden" id="count_default" name="count_default" value="<?= sizeof($data['servicesTimingManageDay']['default']) ?>">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">بازه های زمانی پیش فرض</p>
                                                    <div class="pr-2">
                                                        <div class="table-responsive" id="table-default">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-default">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['default'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['default'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[default][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[default][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[default][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[default][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[default][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[default][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="default" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('default');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="default" id="add-row-timing_default" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_holiday">
                                            <form id="holidayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" name="day" value="holiday">
                                                <input type="hidden" id="count_holiday" name="count_holiday" value="<?= sizeof($data['servicesTimingManageDay']['holiday']) ?>">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه روزهای تعطیل</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="holiday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_holiday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="holiday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_holiday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="holiday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_holiday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="holiday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_holiday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-holiday" style="<?= $data['servicesTiming'][0]['st_turn_holiday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-holiday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['holiday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['holiday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[holiday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[holiday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[holiday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[holiday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[holiday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[holiday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="holiday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('holiday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="holiday" id="add-row-timing_holiday" style="<?= $data['servicesTiming'][0]['st_turn_holiday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_saturday">
                                            <form id="saturdayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_saturday" name="count_saturday" value="<?= sizeof($data['servicesTimingManageDay']['saturday']) ?>">
                                                <input type="hidden" name="day" value="saturday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه شنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="saturday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_saturday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="saturday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_saturday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="saturday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_saturday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="saturday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_saturday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="saturday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_saturday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-saturday" style="<?= $data['servicesTiming'][0]['st_turn_saturday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-saturday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['saturday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['saturday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[saturday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[saturday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[saturday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[default][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[saturday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[saturday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="saturday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('saturday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" id="add-row-timing_saturday"  style="<?= $data['servicesTiming'][0]['st_turn_saturday'] == "custom" ? "":"display: none;"; ?>" data-day="saturday" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_sunday">
                                            <form id="sundayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_sunday" name="count_sunday" value="<?= sizeof($data['servicesTimingManageDay']['sunday']) ?>">
                                                <input type="hidden" name="day" value="sunday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه یکشنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="sunday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_sunday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="sunday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_sunday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="sunday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_sunday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="sunday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_sunday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="sunday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_sunday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-sunday" style="<?= $data['servicesTiming'][0]['st_turn_sunday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-sunday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['sunday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['sunday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[sunday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[sunday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[sunday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[sunday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[sunday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[sunday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="sunday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('sunday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="sunday" id="add-row-timing_sunday" style="<?= $data['servicesTiming'][0]['st_turn_sunday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_monday">
                                            <form id="mondayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_monday" name="count_monday" value="<?= sizeof($data['servicesTimingManageDay']['monday']) ?>">
                                                <input type="hidden" name="day" value="monday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه دوشنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="monday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_monday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="monday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_monday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="monday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_monday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="monday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_monday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="monday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_monday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-monday" style="<?= $data['servicesTiming'][0]['st_turn_monday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-monday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['monday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['monday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[monday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[monday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[monday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[monday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[monday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[monday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="monday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('monday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" id="add-row-timing_monday" data-day="monday" style="<?= $data['servicesTiming'][0]['st_turn_monday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_tuesday">
                                            <form id="tuesdayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_tuesday" name="count_tuesday" value="<?= sizeof($data['servicesTimingManageDay']['tuesday']) ?>">
                                                <input type="hidden" name="day" value="tuesday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه سه شنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="tuesday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_tuesday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="tuesday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_tuesday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="tuesday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_tuesday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="tuesday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_tuesday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="tuesday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_tuesday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-tuesday" style="<?= $data['servicesTiming'][0]['st_turn_tuesday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-tuesday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['tuesday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['tuesday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[tuesday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[tuesday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[tuesday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[tuesday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[tuesday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[tuesday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="tuesday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('tuesday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="tuesday" id="add-row-timing_tuesday" style="<?= $data['servicesTiming'][0]['st_turn_tuesday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_wednesday">
                                            <form id="wednesdayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_wednesday" name="count_wednesday" value="<?= sizeof($data['servicesTimingManageDay']['wednesday']) ?>">
                                                <input type="hidden" name="day" value="wednesday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه چهارشنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="wednesday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_wednesday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="wednesday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_wednesday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="wednesday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_wednesday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="wednesday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_wednesday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="wednesday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_wednesday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-wednesday" style="<?= $data['servicesTiming'][0]['st_turn_wednesday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-wednesday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['wednesday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['wednesday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[wednesday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[wednesday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[wednesday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[wednesday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[wednesday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[wednesday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="wednesday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('wednesday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="wednesday" id="add-row-timing_wednesday" style="<?= $data['servicesTiming'][0]['st_turn_wednesday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_thursday">
                                            <form id="thursdayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_thursday" name="count_thursday" value="<?= sizeof($data['servicesTimingManageDay']['thursday']) ?>">
                                                <input type="hidden" name="day" value="thursday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه پنج شنبه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="thursday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_thursday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="thursday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_thursday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="thursday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_thursday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="thursday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_thursday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="thursday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_thursday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-thursday" style="<?= $data['servicesTiming'][0]['st_turn_thursday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-thursday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['thursday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['thursday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[thursday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[thursday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[thursday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[thursday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[thursday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[thursday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="thursday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('thursday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="thursday" id="add-row-timing_thursday" style="<?= $data['servicesTiming'][0]['st_turn_thursday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="tab_friday">
                                            <form id="fridayForm" onsubmit="return false;">
                                                <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                                <input type="hidden" id="count_friday" name="count_friday" value="<?= sizeof($data['servicesTimingManageDay']['friday']) ?>">
                                                <input type="hidden" name="day" value="friday">

                                                <div class="py-5">
                                                    <p class="font-weight-bold mb-2">برنامه جمعه</p>
                                                    <div class="pr-2">
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="friday_program" value="default" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_friday'] == "default" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی پیش فرض
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="friday_program" value="custom_date" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_friday'] == "custom_date" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از تاریخ های دلخواه تعریف شده
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="friday_program" value="holiday" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_friday'] == "holiday" ? "checked":""; ?>>
                                                                </div>
                                                                استفاده از بازه های زمانی روزهای تعطیل
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="friday_program" value="not_turn" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_friday'] == "not_turn" ? "checked":""; ?>>
                                                                </div>
                                                                عدم نوبت دهی
                                                            </label>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <label>
                                                                <div class="iradio_flat-green">
                                                                    <input type="radio" name="friday_program" value="custom" class="flat-red" <?= $data['servicesTiming'][0]['st_turn_friday'] == "custom" ? "checked":""; ?>>
                                                                </div>
                                                                تعریف بازه های زمانی دلخواه به صورت کلی
                                                            </label>
                                                        </div>
                                                        <div class="table-responsive" id="table-friday" style="<?= $data['servicesTiming'][0]['st_turn_friday'] == "custom" ? "display: block;":"display: none;"; ?>">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <th>وضعیت</th>
                                                                    <th>ویژه</th>
                                                                    <th>ساعت شروع</th>
                                                                    <th>ساعت پایان</th>
                                                                    <th>ظرفیت</th>
                                                                    <th>توضیحات</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="tbody-friday">
                                                                <?php if(sizeof($data['servicesTimingManageDay']['friday'])>0){ ?>
                                                                    <?php $i=0; foreach($data['servicesTimingManageDay']['friday'] as $item){ ?>
                                                                        <tr>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[friday][<?= $i ?>][status]" <?= $item['sm_status'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <lable>
                                                                                    <div class="icheckbox_flat-green">
                                                                                        <input type="checkbox" name="timing[friday][<?= $i ?>][vip]" <?= $item['sm_vip'] == 1 ? "checked":""; ?> class="flat-red">
                                                                                    </div>
                                                                                </lable>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت شروع" name="timing[friday][<?= $i ?>][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_start'] ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" placeholder="ساعت پایان" name="timing[friday][<?= $i ?>][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false" value="<?= $item['sm_time_end'] ?>">
                                                                            </td>
                                                                            <td><lable><input type="text" name="timing[friday][<?= $i ?>][capacity]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_capacity'] ?>"></lable></td>
                                                                            <td><lable><input type="text" name="timing[friday][<?= $i ?>][description]" class="form-control" style="direction: ltr;text-align: left" value="<?= $item['sm_description'] ?>"></lable></td>
                                                                            <td class="text-center"><a style="cursor: pointer" data-day="friday" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>
                                                                            <?php $i++; ?>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                    <input onclick="timingFormSubmit('friday');" class="btn btn-dropbox" value="ثبت" type="submit">
                                                    <button type="button" data-day="friday" id="add-row-timing_friday" style="<?= $data['servicesTiming'][0]['st_turn_friday'] == "custom" ? "":"display: none;"; ?>" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="turn-setting" aria-labelledby="turn-setting-tab">
                                <form id="timingSettingForm" onsubmit="return false;">
                                    <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">عمومی</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div class="d-flex justify-content-between align-items-center py-5 pb-2">
                                                <label for="switcher-1">
                                                    فعال بودن حالت نوبت دهی خودکار؟
                                                </label>
                                                <div style="padding-left: 40px;">
                                                    <div class="parent-switcher">
                                                        <label class="ui-statusswitcher">
                                                            <input <?= $data['servicesTiming'][0]['st_auto_timing_enabled'] == 1 ? "checked":""; ?> type="checkbox" id="switcher-1" name="auto_timing_enable">
                                                            <span class="ui-statusswitcher-slider">
                                                                <span class="ui-statusswitcher-slider-toggle"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-muted mb-4">در صورتی که این قابلیت را فعال نمایید سیستم به صورت اتوماتیک، از بین زمان بندی های ارائه شده اولین زمان خالی را به مشتری اختصاص خواهد داد.</p>

                                            <hr/>
                                            <div class="d-flex justify-content-between align-items-center py-5">
                                                <label for="switcher-2">
                                                    نمایش تعداد روزهای فعال برای رزرو نوبت
                                                </label>

                                                <div class="input-group">
                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['servicesTiming'][0]['st_date_reservation'] ?>" class="form-control" style="direction: ltr;text-align: left" id="timing_date_reservation" name="timing_date_reservation" placeholder="به عنوان مثال 2" required>
                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon">روز</span>
                                                </div>
                                            </div>

                                            <hr/>
                                            <div class="d-flex justify-content-between align-items-center py-5">
                                                <label for="switcher-2">
                                                    نمایش تعداد روزهای فعال برای رزرو نوبت در پنل مدیریت
                                                </label>

                                                <div class="input-group">
                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['servicesTiming'][0]['st_date_reservation_for_admin'] ?>" class="form-control" style="direction: ltr;text-align: left" id="timing_date_reservation_for_admin" name="timing_date_reservation_for_admin" placeholder="به عنوان مثال 2" required>
                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon">روز</span>
                                                </div>
                                            </div>

                                            <hr/>
                                            <div class="d-flex justify-content-between align-items-center py-5">
                                                <label for="switcher-2">
                                                    مدت زمان برای تکمیل و پرداخت هزینه نوبت
                                                </label>

                                                <div class="input-group">
                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['servicesTiming'][0]['st_complete_time_reservation'] ?>" class="form-control" style="direction: ltr;text-align: left" id="complete_time_reservation" name="complete_time_reservation" placeholder="به عنوان مثال 30" required>
                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon">دقیقه</span>
                                                </div>
                                            </div>
                                            <p class="text-muted mb-4">پس از این مدت در صورت تکمیل نشدن عملیات پرداخت، زمان رزرو شده برای کاربر حذف می شود.</p>

                                            <hr/>
                                            <div class="d-flex justify-content-between align-items-center py-5">
                                                <label for="switcher-2">
                                                    مدت زمان مجاز برای رزرو نوبت ترمیم
                                                </label>

                                                <div class="input-group">
                                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['servicesTiming'][0]['st_allowed_time_book_repair_appointment'] ?>" class="form-control" style="direction: ltr;text-align: left" id="allowed_time_book_repair_appointment" name="allowed_time_book_repair_appointment" placeholder="به عنوان مثال 30" required>
                                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon">روز</span>
                                                </div>
                                            </div>
                                            <p class="text-muted mb-4">از زمان انجام خدمت این مدت زمان محاسبه خواهد شد و پس از گذشت مدت زمان مجاز، کاربر مجاز به رزرو نوبت ترمیم نمی باشد.</p>

                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="timingSettingSubmit();" class="btn btn-dropbox" value="ثبت" type="submit">
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
        <!-- /.content -->
    </div>

    <div dir="rtl" class="modal fade" id="daysTimingModal" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 id="daysTimingDateTitleModal" class="modal-title"></h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <form id="customDayForm" onsubmit="return false;">
                        <input type="hidden" name="service_id" value="<?= $data['attrId'] ?>">
                        <input type="hidden" name="custom_date_program" value="custom_date">
                        <input type="hidden" id="count_custom_date" name="count_custom_date" value="0">
                        <input type="hidden" name="day" value="custom_date">
                        <input type="hidden" name="description" id="descriptionModal">

                        <div class="py-5">
                            <div class="pr-2">
                                <div class="table-responsive" id="table-custom_date">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>وضعیت</th>
                                            <th>ویژه</th>
                                            <th>ساعت شروع</th>
                                            <th>ساعت پایان</th>
                                            <th>ظرفیت</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody-custom_date"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                            <input onclick="timingFormSubmit('customDay');" class="btn btn-dropbox" value="ثبت" type="submit">
                            <button type="button" id="add-row-timing_custom_day" data-day="custom_date" class="add-row-timing btn btn-success">افزودن ساعت جدید</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>در این بخش لیست ساعت های تعریف شده در تاریخ مورد نظر نمایش داده می شود.</span>
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
<script src="public/panel/plugins/iCheck/icheck.min.js"></script>
<script src="public/js/jquery-clockpicker.min.js"></script>
<script src='public/panel/plugins/fullcalendar/fullcalendar.js'></script>
<script src='public/panel/plugins/fullcalendar/locales-all.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'today prevYear,prev,next,nextYear',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            eventColor: 'green',
            dayPopoverFormat: {month: 'long', day: 'numeric', year: 'numeric'},
            locale: 'fa',
            buttonIcons: false, // show the prev/next text
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            displayEventTime: false,
            dayMaxEvents: true, // allow "more" link when too many events
            hiddenDays: [],
            async: false,
            showNonCurrentDates: true,
            eventSources: [
                {
                    url: '<?= ADMIN_PATH ?>/getDateTimingAndEventsAjax',
                    method: 'POST',
                    extraParams: {
                        service: '<?= $data['attrId'] ?>',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                        $('#tab_custom_day').height($('#tab_custom_day')[0].scrollHeight);
                    },
                    failure: function () {
                        $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان دریافت نوبت ها وجود ندارد.'});
                    },
                }
            ],
            dateClick: function (info) {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');

                const date = [year, month, day].join('');
                const date_select = String(info.dateStr).replaceAll("-", "");

                if (date_select < date) {
                    $.wnoty({type: 'error', message: 'تاریخ انتخابی گذشته و امکان ویرایش وجود ندارد.'});
                } else {
                    $.ajax({
                        url: '<?= ADMIN_PATH ?>/getDateEventsAjax',
                        type: 'POST',
                        data: {
                            date: info.dateStr,
                            service: '<?= $data['attrId'] ?>',
                        },
                        success: function (data) {
                            var data = JSON.parse(data);
                            var persian_ = data.date_fa;
                            var miladi_ = data.date_en;
                            $("#daysTimingDateTitleModal").text("برنامه زمانی برای تاریخ " + persian_);
                            $("#descriptionModal").val(persian_);

                            $("#count_custom_date").val(data.size);
                            $("#tbody-custom_date").html("");
                            if(data.size>0){
                                $("#tbody-custom_date").html(data.data);
                            }

                            TP_Timepicker();
                            $('input[type="checkbox"].flat-red').iCheck({
                                checkboxClass: 'icheckbox_flat-green',
                            });

                            $("#daysTimingModal").modal("show");
                        }
                    });
                }
            }
        });

        calendar.render();

        $("#daysTimingModal").on("hidden.bs.modal", function () {
            calendar.refetchEvents();
        });
    });
</script>

<script type="text/javascript">
    TP_Timepicker();

    function TP_Timepicker() {
        $('.timepicker').clockpicker({
            donetext: 'تایید',
            autoclose: true,
            twelvehour: false,
            vibrate: true,
            hourstep: 1,
            minutestep: 5, // Per 5 minutes
            'default': 'now'
        });
    }
</script>

<script>
    $('a[data-toggle="tab"]').on('click', function (e) {
        var target = $(e.target).attr("href");
        target = target.replace("#tab_","");

        const types = ["custom_day", "default", "holiday"];
        types.forEach(hide_tips);
        function hide_tips(value) {
            $("#tips_"+value).hide();
        }

        if (types.includes(target)) {
            $("#tips_"+target).show();
        }
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $('[data-showBox]').on('click', function (event) {
        event.preventDefault();
        var boxTarget = $(this).attr('data-target');
        $(boxTarget).removeClass('d-none');
    });
    $('[data-hiddenBox]').on('click', function (event) {
        event.preventDefault();
        var boxTarget = $(this).attr('data-target');
        $(boxTarget).addClass('d-none');
    });
</script>

<script>
    $(document).ready(function () {
        function get_counter_row(day){
            var counter = $("#count_"+day).val();
            counter = parseInt(counter);
            if(counter == 0 ){
                return 0;
            } else {
                return counter;
            }
        }

        function add_counter_row(day){
            counter_ = parseInt($("#count_"+day).val()) + 1;
            $("#count_"+day).val(counter_);
        }

        var days = [
            'default',
            'custom_date',
            'saturday',
            'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'holiday'
        ];

        for (i = 0, len = days.length; i < len; i++) {
            if ($("#tbody-" + days[i] + " tr").length == 0) {
                dynamic_field_default(get_counter_row(days[i]), days[i]);
                TP_Timepicker();
            }
        }

        function dynamic_field_default(number, day) {
            html = '<tr>';
            html += '<td><lable><input type="checkbox" name="timing[' + day + '][' + number + '][status]" class="flat-red"></lable></td>';
            html += '<td><lable><input type="checkbox" name="timing[' + day + '][' + number + '][vip]" class="flat-red"></lable></td>';
            html += '<td><input type="text" placeholder="ساعت شروع" name="timing[' + day + '][' + number + '][hour-start]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false"></td>';
            html += '<td><input type="text" placeholder="ساعت پایان" name="timing[' + day + '][' + number + '][hour-finish]" class="form-control timepicker" style="direction: ltr;text-align: left" autocomplete="false"></td>';
            html += '<td><lable><input type="text" name="timing[' + day + '][' + number + '][capacity]" value="1" style="direction: ltr;text-align: left" class="form-control"></lable></td>';
            if( day != "custom_date"){
                html += '<td><lable><input type="text" name="timing[' + day + '][' + number + '][description]" class="form-control"></lable></td>';
            }
            html += '<td class="text-center"><a style="cursor: pointer" data-day="' + day + '" class="btn btn-icon btn-light remove-default-field"><i class="fa fa-trash"></i></a></td>';
            html += '</tr>';
            $('#tbody-' + day).append(html);

            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
            });
        }

        $(document).on('click', '.add-row-timing', function () {
            const day = $(this).data('day');
            add_counter_row(day);
            dynamic_field_default(get_counter_row(day), day);
            TP_Timepicker();
        });

        $(document).on('click', '.remove-default-field', function () {
            $(this).closest("tr").remove();
        });
    });
</script>

<script>
    $('input[name="saturday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-saturday').show();
            $('#add-row-timing_saturday').show();
        } else {
            $('#table-saturday').hide();
            $('#add-row-timing_saturday').hide();
        }
    });

    $('input[name="sunday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-sunday').show();
            $('#add-row-timing_sunday').show();
        } else {
            $('#table-sunday').hide();
            $('#add-row-timing_sunday').hide();
        }
    });

    $('input[name="monday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-monday').show();
            $('#add-row-timing_monday').show();
        } else {
            $('#table-monday').hide();
            $('#add-row-timing_monday').hide();
        }
    });

    $('input[name="tuesday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-tuesday').show();
            $('#add-row-timing_tuesday').show();
        } else {
            $('#table-tuesday').hide();
            $('#add-row-timing_tuesday').hide();
        }
    });

    $('input[name="wednesday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-wednesday').show();
            $('#add-row-timing_wednesday').show();
        } else {
            $('#table-wednesday').hide();
            $('#add-row-timing_wednesday').hide();
        }
    });

    $('input[name="thursday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-thursday').show();
            $('#add-row-timing_thursday').show();
        } else {
            $('#table-thursday').hide();
            $('#add-row-timing_thursday').hide();
        }
    });

    $('input[name="friday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-friday').show();
            $('#add-row-timing_friday').show();
        } else {
            $('#table-friday').hide();
            $('#add-row-timing_friday').hide();
        }
    });

    $('input[name="holiday_program"]').on('ifClicked', function (event) {
        if (this.value == 'custom') {
            $('#table-holiday').show();
            $('#add-row-timing_holiday').show();
        } else {
            $('#table-holiday').hide();
            $('#add-row-timing_holiday').hide();
        }
    });
</script>

<script>
    timingFormSubmit = function (day) {
        var data = $(document.getElementById(day + 'Form')).serialize();

        if (navigator.onLine) {
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/timingServicesManageDay",
                type: 'POST',
                data: data,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    $('input[type="checkbox"].flat-red').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                    });
                }
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    }
</script>

<script>
    timingSettingSubmit = function () {
        var data = $(document.getElementById('timingSettingForm')).serialize();

        if (navigator.onLine) {
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/timingServicesSetting",
                type: 'POST',
                data: data,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});
                }
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    }
</script>

</body>
</html>