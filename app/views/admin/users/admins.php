<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>لیست کارکنان | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>لیست کارکنان</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/admins"><i class="fa fa-user-secret"></i> Admins</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ثبت کاربر جدید</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="nameAdmin">:نام و نام خانوادگی</label>
                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                   class="form-control" id="nameAdmin" name="nameAdmin" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="usernameAdmin">:نام کاربری (شماره موبایل)</label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="text"
                                                   autocomplete="false"
                                                   class="form-control" id="usernameAdmin" name="usernameAdmin"
                                                   required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="passAdmin">:کلمه عبور</label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="password"
                                                   autocomplete="false"
                                                   class="form-control" id="passAdmin" name="passAdmin" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="role">:نقش</label>
                                            <select id="role" name="role" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                <option value="" disabled="" selected="" hidden="">انتخاب نقش</option>
                                                <?php foreach ($data['roles'] as $role) { ?>
                                                    <option value="<?= $role['ar_id']; ?>"><?= $role['ar_title']; ?></option>
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

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">مدیریت کارکنان</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="در این بخش لیست کامل کارکنانی که به سیستم اضافه کرده اید به شما نمایش داده می شود که به نکات زیر توجه نمایید:<br/><br/>1- برای گرفتن خروجی می توانید از دکمه های خروجی اکسل و یا خروجی csv بسته به نیاز استفاده نمایید.<br/><br/>2- برای پرینت اطلاعات می توانید از دکمه پرینت استفاده نمایید.<br/><br/>3- در صورتی که در هنگام گرفتن خروجی یا پرینت خواستید ستونی نمایش داده نشود می توانید از بخش فیلتر ستون ها، ستون مورد نظر خود را غیرفعال نمایید تا در خروجی مورد نظر نمایش داده نشود<br/><br/>4- به علت افزایش سرعت لود اطلاعات، اطلاعات به صورت محدود از دیتابیس خوانده می شود در صورتی که می خواهید لیست کامل اطلاعات را خروجی بگیرید کافیست از قسمت نمایش در پایین جدول گزینه همه را انتخاب و سپس اقدام به گرفتن خروجی نمایید.<br/><br/>5- برای جستجو و فیلتر کردن اطلاعات می توانید از فیلدهای موجود در زیر عنوان هر ستون استفاده نمایید و در صورت تمایل می توانید به صورت همزمان چند ستون را فیلتر نمایید تا اطلاعات مد نظر شما نمایش داده شود." class="box-body">
                            <div class="table-responsive direction">
                                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">نام و نام خانوادگی</th>
                                        <th class="priority-1" style="text-align:center;">نام کاربری</th>
                                        <th class="priority-1" style="text-align:center;">نقش</th>
                                        <th class="priority-1" style="text-align:center;width: 50px">وضعیت</th>
                                        <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                        <th class="priority-1" style="text-align:center">نام و نام خانوادگی</th>
                                        <th class="priority-1" style="text-align:center;">نام کاربری</th>
                                        <th class="priority-1" style="text-align:center;">نقش</th>
                                        <th class="priority-1" style="text-align:center;width: 50px">وضعیت</th>
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

    <div dir="rtl" class="modal fade" id="status-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">تغییر وضعیت کاربر</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از تغییر وضعیت این کاربر اطمینان دارید؟</label>
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
                    <span>در صورت فعال بودن، کاربر امکان دسترسی به پنل مدیریت را خواهد شد.</span>
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
                    <h4 class="modal-title">ویرایش کاربر </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="nameAdminEdit">نام و نام خانوادگی :</label>
                                <input style="border-radius: 3px;text-align:right" type="text"
                                       class="form-control" id="nameAdminEdit" name="nameAdminEdit" required>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="roleAdminEdit">نقش :</label>
                                <select id="roleAdminEdit" name="roleAdminEdit" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                    <option value="" disabled="" selected="" hidden="">انتخاب نقش</option>
                                    <?php foreach ($data['roles'] as $role) { ?>
                                        <option value="<?= $role['ar_id']; ?>"><?= $role['ar_title']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="usernameAdminEdit">نام کاربری (شماره موبایل) :</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text"
                                       autocomplete="false"
                                       class="form-control" id="usernameAdminEdit" name="usernameAdminEdit"
                                       required>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="descriptionEdit">توضیحات :</label>
                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="descriptionEdit" name="descriptionEdit" required></textarea>
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

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف کاربر</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از حذف این کاربر اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف تمامی  مطالب مربوط به این کاربر نیز حذف میگردد و امکان بازیابی نیز وجود ندارد.</span>
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

<script>
    CKEDITOR.config.toolbar_MA=[ ['RemoveFormat','-','Format','FontSize','Bold','Italic','Underline','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList'] ];
    CKEDITOR.replace('description',
        {
            language: 'fa',
            allowedContent: true,
            toolbar:'MA'
        });
    CKEDITOR.replace('descriptionEdit',
        {
            language: 'fa',
            allowedContent: true,
            toolbar:'MA'
        });
</script>

<script>
    $(function () {
        let status_state_inp, role_state_inp = null;
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
        $rolesData = '<option value="">همه موارد</option>';
        foreach ($data['roles'] as $role) {
            $rolesData .= '<option value="' . $role['ar_id'] . '">' . $role['ar_title'] . '</option>';
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
                const  select_array = [0, 1, 2, "", "", 5];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            switch(i){
                                case 3:
                                    role_state_inp = col_search_val.replace("^", "").replace("$", "");
                                    break;
                                case 4:
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
            language: {
                buttons: {
                    colvisRestore: "نمایش همه"
                }
            },
            "columnDefs": [
                {orderable: false, targets: [5]},
                {className: "priority-1", "targets": [0, 1, 2, 3, 4, 5]},
                {className: "priority-2", "targets": []}
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: "<?= ADMIN_PATH; ?>/getAdminsAjax",
                pages: 5
            }), initComplete: function () {
                this.api().columns(3).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب نقش</option><?= $rolesData; ?></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == role_state_inp){
                            $(select).children().eq(d).attr("selected", true);
                        }
                    });
                });
                this.api().columns(4).every(function () {
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
                url: "<?= ADMIN_PATH; ?>/statusAdmins",
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
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("nameAdmin").value;
        var username = document.getElementById("usernameAdmin").value;
        var pass = document.getElementById("passAdmin").value;
        var role = document.getElementById("role").value;
        var description = CKEDITOR.instances['description'].getData();

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام ونام خانوادگی را وارد کنید.'});
        } else if (username == "") {
            $.wnoty({type: 'warning', message: 'نام کاربری (شماره موبایل) را وارد کنید.'});
        } else if (pass == "") {
            $.wnoty({type: 'warning', message: 'کلمه عبور را وارد کنید.'});
        } else if (role == "") {
            $.wnoty({type: 'warning', message: 'نقش کاربر را انتخاب کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("name", name);
                formData.append("username", username);
                formData.append("pass", pass);
                formData.append("role", role);
                formData.append("description", description);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addAdmin",
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
    $(document).on("click", "[id*=btn-edit-]", function () {
        document.getElementById("edit-val").value = $(this).data('id');
        $("#nameAdminEdit").val($(this).data('name'));
        $("#usernameAdminEdit").val($(this).data('username'));
        $("#roleAdminEdit").val($(this).data('role')).change();
        CKEDITOR.instances.descriptionEdit.setData($(this).data('description'));
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var nameAdminEdit = document.getElementById('nameAdminEdit').value;
        var usernameAdminEdit = document.getElementById('usernameAdminEdit').value;
        var roleAdminEdit = document.getElementById("roleAdminEdit").value;
        var descriptionEdit = CKEDITOR.instances['descriptionEdit'].getData();

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("name", nameAdminEdit);
            formData.append("username", usernameAdminEdit);
            formData.append("description", descriptionEdit);
            formData.append("role", roleAdminEdit);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editAdmin",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().prev().prev().prev().html(nameAdminEdit);
                        $("#btn-edit-"+id).parent().prev().prev().prev().html(usernameAdminEdit);
                        $("#btn-edit-"+id).parent().prev().prev().html($('#roleAdminEdit option:selected').text());

                        $("#btn-edit-"+id).data('name', nameAdminEdit);
                        $("#btn-edit-"+id).data('username', usernameAdminEdit);
                        $("#btn-edit-"+id).data('role', roleAdminEdit);
                        $("#btn-edit-"+id).data('description', descriptionEdit);
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
                url: "<?= ADMIN_PATH; ?>/delAdmin",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#style-row-" + id).remove();
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

</body>
</html>
