<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>تعرفه های خدمت <?= $data['serviceInfo']['s_title'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>تعرفه های خدمت <?= $data['serviceInfo']['s_title'] ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li class="active">Tariff services</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ثبت تعرفه جدید</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای افزودن تعرفه جدید می بایست اطلاعات خواسته شده را تکمیل نمایید." class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="post_type">:پرسنل</label>
                                            <select  name="staff_id[]" id="staffs" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                <?php foreach ($data['staffs'] as $staffs) { ?>
                                                    <option data-id="<?= $staffs['staff_vids_id']; ?>" value="<?= $staffs['staff_vids_id']; ?>"><?= $staffs['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="post_type">:نوع نوبت</label>
                                            <select  name="is_vip" id="is_vip" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                <option value="0" selected>عادی</option>
                                                <option value="1">ویژه</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="branches">: شعبه</label>
                                            <select id="branches" name="branches" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                <?php foreach ($data['branches'] as $branch) { ?>
                                                    <option selected value="<?= $branch['branch_vids_id']; ?>"><?= $branch['b_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="amount">:هزینه</label>
                                            <div class="input-group" id="amountID">
                                                <input style="border-radius: 0 3px 3px 0;text-align: start;unicode-bidi: plaintext;direction: ltr" type="text" class="form-control" id="amount" name="amount" required="">
                                                <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="deposit">:بیعانه</label>
                                            <div class="input-group" id="depositID">
                                                <input style="border-radius: 0 3px 3px 0;text-align: start;unicode-bidi: plaintext;direction: ltr" type="text" class="form-control" id="deposit" name="deposit" required="">
                                                <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                            </div>
                                            <span style="width: 100%;" align="right" for="deposit">چنانچه نیاز به دریافت بیعانه نمی باشد 0 را وارد نمایید</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>

                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">مدیریت تعرفه ها</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="در این بخش لیست کامل تعرفهها به شما نمایش داده می شود که به نکات زیر توجه نمایید:<br/><br/>1- برای گرفتن خروجی می توانید از دکمه های خروجی اکسل و یا خروجی csv بسته به نیاز استفاده نمایید.<br/><br/>2- برای پرینت اطلاعات می توانید از دکمه پرینت استفاده نمایید.<br/><br/>3- در صورتی که در هنگام گرفتن خروجی یا پرینت خواستید ستونی نمایش داده نشود می توانید از بخش فیلتر ستون ها، ستون مورد نظر خود را غیرفعال نمایید تا در خروجی مورد نظر نمایش داده نشود<br/><br/>4- به علت افزایش سرعت لود اطلاعات، اطلاعات به صورت محدود از دیتابیس خوانده می شود در صورتی که می خواهید لیست کامل اطلاعات را خروجی بگیرید کافیست از قسمت نمایش در پایین جدول گزینه همه را انتخاب و سپس اقدام به گرفتن خروجی نمایید.<br/><br/>5- برای جستجو و فیلتر کردن اطلاعات می توانید از فیلدهای موجود در زیر عنوان هر ستون استفاده نمایید و در صورت تمایل می توانید به صورت همزمان چند ستون را فیلتر نمایید تا اطلاعات مد نظر شما نمایش داده شود." class="box-body">
                            <div class="table-responsive direction">
                                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">پرسنل</th>
                                        <th class="priority-1" style="text-align:center">شعبه</th>
                                        <th class="priority-1" style="text-align:center">نوع</th>
                                        <th class="priority-1" style="text-align:center">هزینه</th>
                                        <th class="priority-1" style="text-align:center">بیعانه</th>
                                        <th class="priority-1" style="text-align:center;width: 100px">وضعیت</th>
                                        <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">پرسنل</th>
                                        <th class="priority-1" style="text-align:center">شعبه</th>
                                        <th class="priority-1" style="text-align:center">نوع</th>
                                        <th class="priority-1" style="text-align:center">هزینه</th>
                                        <th class="priority-1" style="text-align:center">بیعانه</th>
                                        <th class="priority-1" style="text-align:center;width: 100px">وضعیت</th>
                                        <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
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
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <div dir="rtl" class="modal fade" id="edit-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ویرایش تعرفه </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="staffsEdit">پرسنل :</label>
                                <select name="staff_id[]" id="staffsEdit" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                    <?php foreach ($data['staffs'] as $staffs) { ?>
                                        <option data-id="<?= $staffs['staff_vids_id']; ?>" value="<?= $staffs['staff_vids_id']; ?>"><?= $staffs['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="amountEdit">هزینه :</label>
                                <div class="input-group" id="amountEditID">
                                    <input style="border-radius: 0 3px 3px 0;text-align: start;unicode-bidi: plaintext;direction: ltr" type="text" class="form-control" id="amountEdit" name="amountEdit" required="">
                                    <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="depositEdit">بیعانه :</label>
                                <div class="input-group" id="depositEditID">
                                    <input style="border-radius: 0 3px 3px 0;text-align: start;unicode-bidi: plaintext;direction: ltr" type="text" class="form-control" id="depositEdit" name="depositEdit" required="">
                                    <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="is_vipEdit">نوع نوبت :</label>
                                <select  name="is_vipEdit" id="is_vipEdit" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                    <option value="0">عادی</option>
                                    <option value="1">ویژه</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="branchesEdit">شعبه :</label>
                                <select id="branchesEdit" name="branchesEdit" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                    <?php foreach ($data['branches'] as $branch) { ?>
                                        <option value="<?= $branch['branch_vids_id']; ?>"><?= $branch['b_name']; ?></option>
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
                    <h4 class="modal-title">تغییر وضعیت تعرفه</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از تغییر وضعیت این تعرفه اطمینان دارید؟</label>
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
                    <span>در صورت فعال بودن، تعرفه در لیست های مورد نیاز نمایش داده خواهد شد.</span>
                </div>
            </div>
        </div>
    </div>

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف تعرفه</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از حذف این تعرفه اطمینان دارید؟</label>
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
                <div class="modal-footer"
                     style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>توجه کنید در صورت حذف تمامی اطلاعات مربوط به این تعرفه نیز حذف میگردد و امکان بازیابی نیز وجود ندارد.</span>
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
    (function ($, undefined) {
        $(function () {
            var $form = $("#amountID, #amountEditID, #depositID, #depositEditID");
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
    $("#btnsubmit").on('click', function () {
        var staffs = document.getElementById("staffs").value;
        var is_vip = document.getElementById("is_vip").value;
        var branches = document.getElementById("branches").value;
        var amount = removeCommas(toEnglishNumber(document.getElementById("amount").value));
        var deposit = removeCommas(toEnglishNumber(document.getElementById("deposit").value));

        if (staffs == "") {
            $.wnoty({type: 'warning', message: 'پرسنل را انتخاب کنید.'});
        } else if (amount == "") {
            $.wnoty({type: 'warning', message: 'مبلغ هزینه خدمت را وارد کنید.'});
        } else if (deposit == "") {
            $.wnoty({type: 'warning', message: 'مبلغ بیعانه را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", "<?= $data['attrId'] ?>");
                formData.append("staffs", staffs);
                formData.append("is_vip", is_vip);
                formData.append("branches", branches);
                formData.append("deposit", deposit);
                formData.append("amount", amount);

                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addServicesTariff",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            location.reload();
                        }
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }
        }
    });
</script>

<script>
    $(function () {
        let status_state_inp, type_state_inp, staff_state_inp, branch_state_inp = null;
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

        <?php
        $staffData = '<option value="">همه موارد</option>';
        foreach ($data['staffs'] as $staff) {
            $staffData .= '<option value="' . $staff['staff_vids_id'] . '">' . $staff['name'] . '</option>';
        }

        $branchData = '<option value="">همه موارد</option>';
        foreach ($data['branches'] as $branch) {
            $branchData .= '<option value="' . $branch['branch_vids_id'] . '">' . $branch['b_name'] . '</option>';
        }
        ?>

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
                const  select_array = [0, "", "", "", 4, 5, "",7];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            switch(i){
                                case 1:
                                    staff_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                                case 2:
                                    branch_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                                case 3:
                                    type_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                                case 6:
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
                },
                {
                    text: 'حذف موارد انتخابی',
                    action: function ( e, dt, node, config ) {
                        deleteSelected(e);
                    }
                }
            ],
            "columnDefs": [
                {orderable: false, targets: [7]},
                {className: "priority-1", "targets": [0, 1, 2, 3, 4, 5, 6, 7]},
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: '<?= ADMIN_PATH; ?>/getServicesTariffAjax?id=<?= $data["attrId"] ?>',
                pages: 5
            }), initComplete: function () {
                this.api().columns(1).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب پرسنل</option><?= $staffData ?></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == staff_state_inp){
                            $(select).children().eq(d).attr("selected", true);
                        }
                    });
                });
                this.api().columns(2).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب نوع</option><option value="">همه موارد</option><?= $branchData ?></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == branch_state_inp){
                            $(select).children().eq(d).attr("selected", true);
                        }
                    });
                });
                this.api().columns(3).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب نوع</option><option value="">همه موارد</option><option value="0">عادی</option><option value="1">ویژه</option></select>')
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
                this.api().columns(6).every(function () {
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
    $(document).on("click", "[id*=btn-edit-]", function () {
        document.getElementById("edit-val").value = $(this).data('id');
        $("#staffsEdit").val($(this).data('staff')).change();
        $("#is_vipEdit").val($(this).data('vip')).change();
        $("#branchesEdit").val($(this).data('branch')).change();
        $("#amountEdit").val(numberWithCommas($(this).data('price')));
        $("#depositEdit").val(numberWithCommas($(this).data('deposit')));
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var staffsEdit = document.getElementById('staffsEdit').value;
        var is_vipEdit = document.getElementById('is_vipEdit').value;
        var branchesEdit = document.getElementById('branchesEdit').value;
        var amountEdit = removeCommas(toEnglishNumber(document.getElementById("amountEdit").value));
        var depositEdit = removeCommas(toEnglishNumber(document.getElementById("depositEdit").value));

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("attrId", "<?= $data['attrId'] ?>");
            formData.append("staffsEdit", staffsEdit);
            formData.append("is_vipEdit", is_vipEdit);
            formData.append("branchesEdit", branchesEdit);
            formData.append("depositEdit", depositEdit);
            formData.append("amountEdit", amountEdit);

            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editServicesTariff",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().prev().html($('#staffsEdit option:selected').text());
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().prev().html($('#branchesEdit option:selected').text());
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().html($('#is_vipEdit option:selected').text());
                        $("#btn-edit-"+id).parent().prev().prev().prev().html(numberWithCommas(amountEdit)+" تومان");
                        $("#btn-edit-"+id).parent().prev().prev().html(numberWithCommas(depositEdit)+" تومان");

                        $("#btn-edit-"+id).data('staff', staffsEdit);
                        $("#btn-edit-"+id).data('vip', is_vipEdit);
                        $("#btn-edit-"+id).data('branch', branchesEdit);
                        $("#btn-edit-"+id).data('price', amountEdit);
                        $("#btn-edit-"+id).data('deposit', depositEdit);
                    }
                },
            });
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
        $('#status-Modal').modal('hide');
        var id = document.getElementById('status-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/statusServicesTariff",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status==="active") {
                        $("#btn-status-" + id).removeClass("btn-danger").addClass("btn-success");
                        document.getElementById("btn-status-" + id).innerHTML = 'فعال';
                    } else if (data.status==="deactive") {
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
                url: "<?= ADMIN_PATH; ?>/delServicesTariff",
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
