<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت کدهای تخفیف | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
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
                <small>لیست کدهای تخفیف</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Discounts</li>
            </ol>
        </section>

        <section class="content" style="min-height: unset;padding-bottom: 0">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ثبت کد تخفیف جدید</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="type_code">:بخش مورد استفاده </label>
                                            <select style="width: 100%;" id="type_code" name="type_code" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl">
                                                <option selected data-id="service" value="service">خدمات</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="title">:عنوان کد تخفیف </label>
                                            <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="code">:کد تخفیف </label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" id="code" name="code" class="form-control" autocomplete="off">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="getCode(this, 'add');"><i class="fa fa-plus-circle"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="number_of_use">:تعداد دفعات استفاده </label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="number_of_use" name="number_of_use" required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="percent">:درصد تخفیف </label>
                                            <div class="input-group" id="percentID">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text" class="form-control" min="0" max="100" id="percent" name="percent"required="">
                                                <span style="border-radius: 3px 0 0 3px;"
                                                      class="input-group-addon">درصد</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" name="first_order" id="first_order">
                                                <label class="mt-1 mr-3" for="first_order">ویژه اولین سفارش</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" name="discounted_products" id="discounted_products">
                                                <label class="mt-1 mr-3" for="discounted_products">قابل استفاده روی خدمت تخفیف خورده</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="allowed_for_each_user">:دفعات مجاز برای هر کاربر</label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="allowed_for_each_user" value="1" name="allowed_for_each_user" required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="dateExpire">:تاریخ انقضا کد</label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control DatePickerPersian" id="dateExpire" name="dateExpire" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="price">:سقف مبلغ تخفیف </label>
                                            <div class="input-group" id="priceID">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text" class="form-control" id="price" name="price"required="">
                                                <span style="border-radius: 3px 0 0 3px;"
                                                      class="input-group-addon">تومان</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12 for_services'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="services">خدماتی که تخفیف در آن اعمال گردد؟</label>
                                            <select style="width: 100%;" id="services" name="services" class="form-control select2Class" multiple style="border-radius: 3px;width: 100%;direction: rtl">
                                                <option value="0" disabled="" hidden="">انتخاب خدمت</option>
                                                <?php foreach($data['services'] as $service){ ?>
                                                    <option data-id="<?= $service['s_id'] ?>" value="<?= $service['s_id'] ?>">
                                                        <?= $service['s_title'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12 for_services'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="staffs">تخفیف متعلق به خدمات کدام پرسنل می باشد؟</label>
                                            <select  name="staff_id[]" id="staffs" class="form-control select2tag" style="border-radius: 3px;width: 100%;direction: rtl" required multiple="" >
                                                <?php foreach ($data['Staffs'] as $staffs) { ?>
                                                    <option data-id="<?= $staffs['staff_vids_id']; ?>" value="<?= $staffs['staff_vids_id']; ?>"><?= $staffs['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="description">:توضیحات</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="description" name="description" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">مدیریت کدهای تخفیف</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="در این بخش لیست کدهای تخفیف ای که به سیستم اضافه کرده اید به شما نمایش داده می شود که به نکات زیر توجه نمایید:<br/><br/>1- برای گرفتن خروجی می توانید از دکمه های خروجی اکسل و یا خروجی csv بسته به نیاز استفاده نمایید.<br/><br/>2- برای پرینت اطلاعات می توانید از دکمه پرینت استفاده نمایید.<br/><br/>3- در صورتی که در هنگام گرفتن خروجی یا پرینت خواستید ستونی نمایش داده نشود می توانید از بخش فیلتر ستون ها، ستون مورد نظر خود را غیرفعال نمایید تا در خروجی مورد نظر نمایش داده نشود<br/><br/>4- به علت افزایش سرعت لود اطلاعات، اطلاعات به صورت محدود از دیتابیس خوانده می شود در صورتی که می خواهید لیست کامل اطلاعات را خروجی بگیرید کافیست از قسمت نمایش در پایین جدول گزینه همه را انتخاب و سپس اقدام به گرفتن خروجی نمایید.<br/><br/>5- برای جستجو و فیلتر کردن اطلاعات می توانید از فیلدهای موجود در زیر عنوان هر ستون استفاده نمایید و در صورت تمایل می توانید به صورت همزمان چند ستون را فیلتر نمایید تا اطلاعات مد نظر شما نمایش داده شود." class="box-body">
                            <div class="table-responsive direction">
                                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">عنوان</th>
                                        <th class="priority-1" style="text-align:center">کد</th>
                                        <th class="priority-1" style="text-align:center;">درصد تخفیف</th>
                                        <th class="priority-1" style="text-align:center;">سقف تخفیف</th>
                                        <th class="priority-1" style="text-align:center;">تعداد استفاده</th>
                                        <th class="priority-1" style="text-align:center;">تاریخ انقضا</th>
                                        <th class="priority-1" style="text-align:center">وضعیت</th>
                                        <th class="priority-1" style="text-align:center;width: 150px">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">عنوان</th>
                                        <th class="priority-1" style="text-align:center">کد</th>
                                        <th class="priority-1" style="text-align:center;">درصد تخفیف</th>
                                        <th class="priority-1" style="text-align:center;">سقف تخفیف</th>
                                        <th class="priority-1" style="text-align:center;">تعداد استفاده</th>
                                        <th class="priority-1" style="text-align:center;">تاریخ انقضا</th>
                                        <th class="priority-1" style="text-align:center">وضعیت</th>
                                        <th class="priority-1" style="text-align:center;width: 150px">عملیات</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
        </section>
        <!-- /.content -->
    </div>

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف کد تخفیف </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از حذف این کد تخفیف اطمینان دارید؟</label>
                            <input id="del-val" type="hidden" value="#"/>
                        </p>
                        <div class="row" style="margin-right: 0;margin-left: 15px;">
                            <div class="sign-up-inside-login">
                                <button id="delete-submit" class="btn btn-danger">حذف</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>توجه کنید در صورت حذف تمامی اطلاعات مربوط به این کد تخفیف نیز حذف میگردد و امکان بازیابی نیز وجود ندارد.</span>
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
                    <h4 class="modal-title">ویرایش کد تخفیف </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="titleEdit">:عنوان کد تخفیف </label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="type_codeEdit">:بخش مورد استفاده </label>
                                <select style="width: 100%;" id="type_codeEdit" name="type_codeEdit" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" disabled>
                                    <option data-id="service" value="service">خدمات</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" dir="ltr" for="statusEdit">:وضعیت کد</label>
                                <select class="form-control" id="statusEdit" name="statusEdit" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="1">فعال</option>
                                    <option value="2">استفاده شده</option>
                                    <option value="0">غیرفعال</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="codeEdit">:کد تخفیف</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" id="codeEdit" name="codeEdit" class="form-control" autocomplete="off">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" onclick="getCode(this, 'edit');"><i class="fa fa-plus-circle"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="number_of_useEdit">:تعداد دفعات استفاده </label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="number_of_useEdit" name="number_of_useEdit" required>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="percentEdit">:درصد تخفیف </label>
                                <div class="input-group" id="percentEditID">
                                    <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text" class="form-control" min="0" max="100" id="percentEdit" name="percentEdit"required="">
                                    <span style="border-radius: 3px 0 0 3px;"
                                          class="input-group-addon">درصد</span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <div class="custom-checkbox">
                                    <input type="checkbox" name="first_orderEdit" id="first_orderEdit">
                                    <label class="mt-1 mr-3" for="first_orderEdit">ویژه اولین سفارش</label>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <div class="custom-checkbox">
                                    <input type="checkbox" name="discounted_productsEdit" id="discounted_productsEdit">
                                    <label class="mt-1 mr-3" for="discounted_productsEdit">قابل استفاده روی خدمت تخفیف خورده</label>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" dir="ltr" for="allowed_for_each_userEdit">:دفعات مجاز برای هر کاربر</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="allowed_for_each_userEdit" name="allowed_for_each_userEdit" required>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group" style="text-align:right">
                                <label align="right" dir="ltr" for="expireDateEdit">:تاریخ انقضا کد</label>
                                <input style="border-radius: 3px;text-align:left" type="text" class="form-control DatePickerPersian" id="expireDateEdit" name="expireDateEdit" required>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="descriptionEdit">:توضیحات</label>
                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="descriptionEdit" name="descriptionEdit" required></textarea>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="priceEdit">:سقف مبلغ تخفیف </label>
                                <div class="input-group" id="priceEditID">
                                    <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text" class="form-control" id="priceEdit" name="priceEdit" required="">
                                    <span style="border-radius: 3px 0 0 3px;"
                                          class="input-group-addon">تومان</span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12 for_servicesEdit'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="servicesEdit">خدماتی که تخفیف در آن اعمال گردد؟</label>
                                <select style="width: 100%;" id="servicesEdit" name="servicesEdit" class="form-control select2Class" multiple style="border-radius: 3px;width: 100%;direction: rtl">
                                    <option value="0" disabled="" hidden="">انتخاب خدمت</option>
                                    <?php foreach($data['services'] as $service){ ?>
                                        <option data-id="<?= $service['s_id'] ?>" value="<?= $service['s_id'] ?>">
                                            <?= $service['s_title'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12 for_servicesEdit'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%" dir="ltr" align="right" for="staffsEdit">تخفیف متعلق به خدمات کدام پرسنل می باشد؟</label>
                                <select  name="staff_id[]" id="staffsEdit" class="form-control select2tag" style="border-radius: 3px;width: 100%;direction: rtl" required multiple="" >
                                    <?php foreach ($data['Staffs'] as $staffs) { ?>
                                        <option data-id="<?= $staffs['staff_vids_id']; ?>" value="<?= $staffs['staff_vids_id']; ?>"><?= $staffs['name']; ?></option>
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
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
    $(function () {
        $('.select2tag').select2({
            tags: true
        });
    });

    (function ($, undefined) {
        $(function () {
            var $form = $("#priceID, #min_price_applyID, #priceEditID, #min_price_applyEditID");
            var $input = $form.find("input");
            $input.on("keyup", function (event) {
                var selection = window.getSelection().toString();
                if (selection !== '') {
                    return;
                }
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                    return;
                }
                var $this = $(this);
                var input = $this.val();
                var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt(input, 10) : 0;
                $this.val(function () {
                    return input.toLocaleString("en-US");
                });
            });
            $form.on("submit", function (event) {
                var $this = $(this);
                var arr = $this.serializeArray();
                for (var i = 0; i < arr.length; i++) {
                    arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
                }
                ;
                event.preventDefault();
            });
        });
    })(jQuery);
</script>

<script>
    var keys = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var code='';

    function getCode(btn, type){
        var code=generateCode(10);
        if(type == "add"){
            document.getElementById('code').value = code;
        } else {
            document.getElementById('codeEdit').value = code;
        }
    }

    function generateCode(len){
        code='';
        for(var i=0; i<len; i++){
            code+=keys.charAt(Math.floor(Math.random()*keys.length));
        }

        return code;
    }
</script>

<script type="text/javascript">
    DP_Persian();
</script>

<script>
    $(function () {
        let status_state_inp = null;
        $('#example1 tfoot th').each(function () {
            var title = $(this).text();
            if (title == "ردیف") {
                $(this).html('-');
            } else if (title == "عملیات") {
                $(this).html('-');
            } else if (title == "تعداد استفاده") {
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
                const  select_array = [0, 1, 2, 3, 4, 5, 6, "", 8];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            status_state_inp = col_search_val.replace("^", "").replace("$", "");
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
                },
                {
                    text: 'حذف موارد انتخابی',
                    action: function ( e, dt, node, config ) {
                        deleteSelected(e);
                    }
                }
            ],
            language: {
                buttons: {
                    colvisRestore: "نمایش همه"
                }
            },
            "columnDefs": [
                {orderable: false, targets: [8]},
                {className: "priority-1", "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8]},
                {className: "priority-2", "targets": []}
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: '<?= ADMIN_PATH; ?>/getDiscountsAjax',
                pages: 5
            }), initComplete: function () {
                this.api().columns(7).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب وضعیت</option><option value="">همه موارد</option><option value="2">استفاده شده</option><option value="1">فعال</option><option value="0">غیرفعال</option></select>')
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
    $(document).on('change', '#type_code', function (e) {
        if($(this).val() == "service") {
            $(".for_services").show();
        }
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var code = toEnglishNumber(document.getElementById("code").value);
        var number_of_use = toEnglishNumber(document.getElementById("number_of_use").value);
        var type_code = document.getElementById("type_code").value;
        var percent = toEnglishNumber(document.getElementById("percent").value);
        var allowed_for_each_user = toEnglishNumber(document.getElementById("allowed_for_each_user").value);
        var first_order = document.getElementById("first_order").checked;
        var discounted_products = document.getElementById("discounted_products").checked;
        var dateExpire = toEnglishNumber(document.getElementById("dateExpire").value);
        var min_price_apply = toEnglishNumber(removeCommas(document.getElementById("min_price_apply").value));
        var price = toEnglishNumber(removeCommas(document.getElementById("price").value));
        var description = document.getElementById("description").value;
        var services =$("#services").val();
        var staffs =$("#staffs").val();

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان کد تخفیف را وارد کنید.'});
        } else if (code == "") {
            $.wnoty({type: 'warning', message: 'کد تخفیف را وارد کنید.'});
        } else if (number_of_use == "") {
            $.wnoty({type: 'warning', message: 'تعداد دفعات استفاده از کد تخفیف را وارد نمایید.'});
        } else if (allowed_for_each_user == "") {
            $.wnoty({type: 'warning', message: 'تعداد دفعات مجاز استفاده از کد تخفیف برای هر کاربر را وارد نمایید.'});
        } else if (percent == "") {
            $.wnoty({type: 'warning', message: 'درصد کد تخفیف را وارد کنید.'});
        } else if (dateExpire == "") {
            $.wnoty({type: 'warning', message: 'تاریخ انقضای کد تخفیف را وارد کنید.'});
        } else if (price == "") {
            $.wnoty({type: 'warning', message: 'سقف مبلغ تخفیف را وارد کنید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال ثبت...");

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("type_code", type_code);
                formData.append("code", code);
                formData.append("number_of_use", number_of_use);
                formData.append("percent", percent);
                formData.append("dateExpire", dateExpire);
                formData.append("min_price_apply", min_price_apply);
                formData.append("price", price);
                formData.append("first_order", first_order);
                formData.append("discounted_products", discounted_products);
                formData.append("allowed_for_each_user", allowed_for_each_user);
                formData.append("description", description);
                formData.append("services", services);
                formData.append("staffs", staffs);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addDiscounts",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            location.reload();
                        }
                    }
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }

            $("#btnsubmit").removeAttr("disabled");
            document.getElementById("btnsubmit").value =("ثبت");
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-edit-]", function () {
        document.getElementById("edit-val").value = $(this).data('id');
        $("#titleEdit").val($(this).data('tilte'));
        $("#codeEdit").val($(this).data('code'));
        $("#number_of_useEdit").val($(this).data('number_of_use'));
        $("#percentEdit").val($(this).data('percent'));
        $("#statusEdit").val($(this).data('status'));
        $("#type_codeEdit").val($(this).data('type')).change();
        $("#expireDateEdit").val($(this).data('expire_date'));
        $("#min_price_applyEdit").val(numberWithCommas($(this).data('min_price_apply')));
        $("#priceEdit").val(numberWithCommas($(this).data('price')));
        $("#allowed_for_each_userEdit").val(numberWithCommas($(this).data('allowed_for_each_user')));
        document.getElementById("discounted_productsEdit").checked = $(this).data('discounted_products');
        document.getElementById("first_orderEdit").checked = $(this).data('first_order');
        $("#descriptionEdit").val($(this).data('description'));
        $("#servicesEdit").val($(this).data('services')).change();
        $("#staffsEdit").val($(this).data('staffs')).change();

        if($(this).data('type') == "service") {
            $(".for_servicesEdit").show();
        }
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById("titleEdit").value;
        var codeEdit = toEnglishNumber(document.getElementById("codeEdit").value);
        var number_of_useEdit = toEnglishNumber(document.getElementById("number_of_useEdit").value);
        var type_codeEdit = document.getElementById("type_codeEdit").value;
        var percentEdit = toEnglishNumber(document.getElementById("percentEdit").value);
        var statusEdit = toEnglishNumber(document.getElementById("statusEdit").value);
        var expireDateEdit = toEnglishNumber(document.getElementById("expireDateEdit").value);
        var min_price_applyEdit = toEnglishNumber(removeCommas(document.getElementById("min_price_applyEdit").value));
        var priceEdit = toEnglishNumber(removeCommas(document.getElementById("priceEdit").value));
        var descriptionEdit = document.getElementById("descriptionEdit").value;
        var servicesEdit =$("#servicesEdit").val();
        var staffsEdit =$("#staffsEdit").val();
        var allowed_for_each_userEdit = toEnglishNumber(document.getElementById("allowed_for_each_userEdit").value);
        var first_orderEdit = document.getElementById("first_orderEdit").checked;
        var discounted_productsEdit = document.getElementById("discounted_productsEdit").checked;

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("titleEdit", titleEdit);
            formData.append("codeEdit", codeEdit);
            formData.append("number_of_useEdit", number_of_useEdit);
            formData.append("type_codeEdit", type_codeEdit);
            formData.append("percentEdit", percentEdit);
            formData.append("statusEdit", statusEdit);
            formData.append("allowed_for_each_userEdit", allowed_for_each_userEdit);
            formData.append("discounted_productsEdit", discounted_productsEdit);
            formData.append("first_orderEdit", first_orderEdit);
            formData.append("expireDateEdit", expireDateEdit);
            formData.append("min_price_applyEdit", min_price_applyEdit);
            formData.append("priceEdit", priceEdit);
            formData.append("descriptionEdit", descriptionEdit);
            formData.append("servicesEdit", servicesEdit);
            formData.append("staffsEdit", staffsEdit);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editDiscounts",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().prev().prev().html(titleEdit);
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().prev().html(codeEdit);
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().html(percentEdit+" درصد");
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().html(numberWithCommas(priceEdit)+" تومان");
                        $("#btn-edit-"+id).parent().prev().prev().html(expireDateEdit);
                        if(statusEdit==1){
                            statusView = '<div class="btn btn-success btn-xs">فعال</i></div>';
                        } else if(statusEdit==2){
                            statusView = '<div class="btn btn-info btn-xs">استفاده شده</i></div>';
                        } else {
                            statusView = '<div class="btn btn-danger btn-xs">غیرفعال</i></div>';
                        }
                        $("#btn-edit-"+id).parent().prev().html(statusView);

                        $("#btn-edit-"+id).data('title', titleEdit);
                        $("#btn-edit-"+id).data('code', codeEdit);
                        $("#btn-edit-"+id).data('number_of_use', number_of_useEdit);
                        $("#btn-edit-"+id).data('type', type_codeEdit);
                        $("#btn-edit-"+id).data('percent', percentEdit);
                        $("#btn-edit-"+id).data('expire_date', expireDateEdit);
                        $("#btn-edit-"+id).data('status', statusEdit);
                        $("#btn-edit-"+id).data('min_price_apply', min_price_applyEdit);
                        $("#btn-edit-"+id).data('price', priceEdit);
                        $("#btn-edit-"+id).data('description', descriptionEdit);
                        $("#btn-edit-"+id).data('services', servicesEdit);
                        $("#btn-edit-"+id).data('staffs', staffsEdit);
                        $("#btn-edit-"+id).data('discounted_products', discounted_productsEdit);
                        $("#btn-edit-"+id).data('allowed_for_each_user', allowed_for_each_userEdit);
                        $("#btn-edit-"+id).data('first_order', first_orderEdit);
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-del-style-]", function () {
        document.getElementById("del-val").value = $(this).data('id');
    });

    $(document).on("click", "#delete-submit", function () {
        $('#del-Modal').modal('hide');
        var id = document.getElementById('del-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/delDiscounts",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-del-style-"+id).parent().parent().remove();
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان حذف وجود ندارد.'});
        }
    });
</script>

</body>
</html>