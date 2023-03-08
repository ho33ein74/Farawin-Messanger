<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت نقش ها | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/panel/plugins/iCheck/all.css">
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
                <small>مدیریت نقش ها</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/admins"><i class="fa fa-user-secret"></i> Admins</a></li>
                <li class="active">Roles</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul data-intro="در این بخش شما می توانید اطلاعات کسب و کار خود و تنظیمات کلی سایت را مدیریت کنید."  class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">لیست نقش ها</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">افزودن نقش جدید</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- /.mange role -->
                            <div class="tab-pane active" id="tab_1">
                                <!-- /.box-header -->
                                <div data-step="1" data-intro="در این بخش لیست کامل نقش هایی که به سیستم اضافه کرده اید نمایش داده می شود که به نکات زیر توجه نمایید:<br/><br/>1- برای گرفتن خروجی می توانید از دکمه های خروجی اکسل و یا خروجی csv بسته به نیاز استفاده نمایید.<br/><br/>2- برای پرینت اطلاعات می توانید از دکمه پرینت استفاده نمایید.<br/><br/>3- در صورتی که در هنگام گرفتن خروجی یا پرینت خواستید ستونی نمایش داده نشود می توانید از بخش فیلتر ستون ها، ستون مورد نظر خود را غیرفعال نمایید تا در خروجی مورد نظر نمایش داده نشود<br/><br/>4- به علت افزایش سرعت لود اطلاعات، اطلاعات به صورت محدود از دیتابیس خوانده می شود در صورتی که می خواهید لیست کامل اطلاعات را خروجی بگیرید کافیست از قسمت نمایش در پایین جدول گزینه همه را انتخاب و سپس اقدام به گرفتن خروجی نمایید.<br/><br/>5- برای جستجو و فیلتر کردن اطلاعات می توانید از فیلدهای موجود در زیر عنوان هر ستون استفاده نمایید و در صورت تمایل می توانید به صورت همزمان چند ستون را فیلتر نمایید تا اطلاعات مد نظر شما نمایش داده شود." class="box-body">
                                    <div class="table-responsive direction">
                                        <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                                <th class="priority-1" style="text-align:center">عنوان نقش</th>
                                                <th class="priority-1" style="text-align:center;width: 100px">وضعیت</th>
                                                <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th class="priority-1" style="text-align:center;width: 30px">ردیف</th>
                                                <th class="priority-1" style="text-align:center">عنوان نقش</th>
                                                <th class="priority-1" style="text-align:center;width: 100px">وضعیت</th>
                                                <th class="priority-1" style="text-align:center;width: 100px">عملیات</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.add role -->
                            <div class="tab-pane" id="tab_2">
                                <div class="box-body">
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="title">:عنوان نقش</label>
                                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="title" name="title" required>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>

                                    <?php function display_access_list($item_list, $parent_id) { ?>
                                        <?php if(sizeof($item_list['access'])>0) { ?>
                                            <div class='col-md-4'>
                                                <hr/>
                                                <div class="form-group">
                                                    <p class="login-with-or"><i class="fa fa-circle"></i> میزان دسترسی به بخش <?= $item_list['s_name'] ?>:</p>
                                                    <hr/>
                                                    <?php foreach ($item_list['access'] as $access) { ?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="child-permission" data-permission_id="<?= $parent_id ?>" name="chb[]" value="<?= $access['sal_permisson'] ?>">
                                                                <?= $access['sal_title'] ?>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if (array_key_exists("children", $item_list)){ ?>
                                            <?php foreach ($item_list['children'] as $child) { ?>
                                                <?php display_access_list($child, $parent_id); ?>
                                            <?php } ?>
                                        <?php } ?>

                                    <?php } ?>

                                    <?php if(sizeof($data['access_list'])>0) { ?>
                                        <div class='row'>
                                            <div class="box-group" id="accordion">
                                                <?php foreach ($data['access_list'] as $item) { ?>
                                                    <div class="panel box">
                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $item['s_id'] ?>" style="color: #000">
                                                                    <?= $item['s_name'] ?>
                                                                </a>
                                                            </h4>
                                                            <input data-id="<?= $item['s_id'] ?>" class="parent-permission" name="permissions[]" type="checkbox" value="<?= $item['s_id'] ?>">
                                                        </div>

                                                        <div id="collapse_<?= $item['s_id'] ?>" class="panel-collapse collapse">
                                                            <div class="box-body">
                                                                <div class="row row-eq-height">
                                                                    <?= display_access_list($item, $item['s_id']); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="box-footer">
                                        <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
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
                    <h4 class="modal-title">تغییر وضعیت نقش</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از تغییر وضعیت این نقش اطمینان دارید؟</label>
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
                    <span>در صورت فعال بودن، نقش در لیست های مورد نیاز نمایش داده خواهد شد.</span>
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
                    <h4 class="modal-title">حذف نقش</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از حذف این نقش اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف تمامی اطلاعات مربوط به این نقش حذف میگردد و امکان بازیابی نیز وجود ندارد همچنین کارکنانی که این نقش را دارند نیز غیرفعال خواهند شد.</span>
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

<script>
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
    });

    $('input.parent-permission').on('ifChanged', function(event){
        var permissionId = $(this).data('id');
        var checked = $(this).prop('checked') ? 'check':'uncheck';
        $('input[data-permission_id="' + permissionId + '"').iCheck(checked);
    });
</script>

<script>
    $(function () {
        $('#example1 tfoot th').each(function () {
            var title = $(this).text();
            if (title == "ردیف") {
                $(this).html('-');
            } else if (title == "وضعیت") {
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
                const  select_array = [0, 1, "", 3];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            switch(i){
                                case 2:
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
                {orderable: false, targets: [3]},
                {className: "priority-1", "targets": [0, 1, 2, 3]},
                {className: "priority-2", "targets": []}
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: '<?= ADMIN_PATH; ?>/getRolesAjax',
                pages: 5
            })
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
    function getSelectedChbox() {
        var selchbox = [];
        var inpfields = $('input:checkbox.child-permission');
        var nr_inpfields = inpfields.length;
        for (var i = 0; i < nr_inpfields; i++) {
            if (inpfields[i].type == 'checkbox' && inpfields[i].checked == true) {
                selchbox.push(inpfields[i].value);
            }
        }
        return selchbox;
    }

    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var access = getSelectedChbox();

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("access", access);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addRoles",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }
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
                url: "<?= ADMIN_PATH; ?>/statusRoles",
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
                url: "<?= ADMIN_PATH; ?>/delRoles",
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
