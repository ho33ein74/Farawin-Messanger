<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت دسته بندی های <?= $data['attrId'] == 'blog' ? 'مطالب':'آموزش ها'; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link href="public/css/bootstrap-treeview.css" rel="stylesheet">
    <link href="public/css/select2totree.css" rel="stylesheet">
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
                <small>لیست دسته بندی های <?= $data['attrId'] == 'blog' ? 'مطالب':'آموزش ها'; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <?php if($data['attrId'] == 'blog'){ ?>
                    <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/blog"><i class="fa fa-newspaper-o"></i> Blog</a></li>
                <?php } ?>
                <li class="active">Category</li>
            </ol>
        </section>

        <section class="content" style="min-height: unset;padding-bottom: 0">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-4">
                        <!-- general form elements disabled -->
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">ثبت دسته بندی  جدید</h3>
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
                                                <label style="width: 100%" align="right" for="title">:عنوان دسته بندی </label>
                                                <input style="border-radius: 3px;text-align:right" type="text"
                                                       class="form-control" id="title" name="title" required>
                                            </div>
                                        </div>

                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label style="width: 100%" align="right" for="slug">:آدرس دسته بندی </label>
                                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" maxlength="40" autocomplete="off"
                                                       class="form-control" id="slug" name="slug" required>
                                            </div>
                                        </div>

                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="parent">:دسته مادر</label>
                                                <select style="width: 100%;" id="parent" name="parent" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" multiple>
                                                    <option value="0" disabled="" hidden="">انتخاب دسته بندی</option>
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
                                <h3 class="box-title">مدیریت دسته بندی های <?= $data['attrId'] == 'blog' ? 'مطالب':'آموزش ها'; ?></h3>
                            </div>
                            <!-- /.box-header -->
                            <div data-step="1" data-intro="در این بخش لیست دسته بندی هایی که به سیستم اضافه کرده اید به شما نمایش داده می شود که به نکات زیر توجه نمایید:<br/><br/>1- برای گرفتن خروجی می توانید از دکمه های خروجی اکسل و یا خروجی csv بسته به نیاز استفاده نمایید.<br/><br/>2- برای پرینت اطلاعات می توانید از دکمه پرینت استفاده نمایید.<br/><br/>3- در صورتی که در هنگام گرفتن خروجی یا پرینت خواستید ستونی نمایش داده نشود می توانید از بخش فیلتر ستون ها، ستون مورد نظر خود را غیرفعال نمایید تا در خروجی مورد نظر نمایش داده نشود<br/><br/>4- به علت افزایش سرعت لود اطلاعات، اطلاعات به صورت محدود از دیتابیس خوانده می شود در صورتی که می خواهید لیست کامل اطلاعات را خروجی بگیرید کافیست از قسمت نمایش در پایین جدول گزینه همه را انتخاب و سپس اقدام به گرفتن خروجی نمایید.<br/><br/>5- برای جستجو و فیلتر کردن اطلاعات می توانید از فیلدهای موجود در زیر عنوان هر ستون استفاده نمایید و در صورت تمایل می توانید به صورت همزمان چند ستون را فیلتر نمایید تا اطلاعات مد نظر شما نمایش داده شود." class="box-body">
                                <div class="table-responsive direction">
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                            <th class="priority-1" style="text-align:center">نام</th>
                                            <th class="priority-1" style="text-align:center">آدرس</th>
                                            <th class="priority-1" style="text-align:center">دسته مادر</th>
                                            <th class="priority-1" style="text-align:center;"><?= $data['attrId'] == 'blog' ? 'پست ثبت شده':'آموزش های ثبت شده'; ?></th>
                                            <th class="priority-1" style="text-align:center">وضعیت</th>
                                            <th class="priority-1" style="text-align:center;width: <?= $data['attrId'] == 'blog' ? 100:200; ?>px">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th class="priority-1" style="text-align:center;width: 50px">ردیف</th>
                                            <th class="priority-1" style="text-align:center">نام</th>
                                            <th class="priority-1" style="text-align:center">آدرس</th>
                                            <th class="priority-1" style="text-align:center">دسته مادر</th>
                                            <th class="priority-1" style="text-align:center;"><?= $data['attrId'] == 'blog' ? 'پست ثبت شده':'آموزش های ثبت شده'; ?></th>
                                            <th class="priority-1" style="text-align:center">وضعیت</th>
                                            <th class="priority-1" style="text-align:center;width: <?= $data['attrId'] == 'blog' ? 100:200; ?>px">عملیات</th>
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
                    <h4 class="modal-title">تغییر وضعیت دسته بندی </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا  از تغییر وضعیت این دسته بندی  اطمینان دارید؟</label>
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
                    <span>در صورت فعال بودن، دسته بندی  در لیست های مورد نیاز نمایش داده خواهد شد.</span>
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
                    <h4 class="modal-title">حذف دسته بندی </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از حذف این دسته بندی  اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف تمامی  مطالب مربوط به این دسته بندی  نیز حذف میگردد و امکان بازیابی نیز وجود ندارد.</span>
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
                    <h4 class="modal-title">ویرایش دسته بندی </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-6">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="titleEdit">عنوان دسته بندی :</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="slugEdit">آدرس دسته بندی :</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="slugEdit" name="slugEdit" required="">
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="parentEdit">دسته مادر :</label>
                                <select style="width: 100%;" id="parentEdit" name="parentEdit" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" multiple>
                                    <option value="0" disabled="" hidden="">انتخاب دسته بندی</option>
                                </select>
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
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
<script src="public/js/select2totree.js"></script>

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
    $("#slug,#slugEdit").keypress(function(event){
        var ew = event.which;
        if(ew == 32) $.wnoty({type: 'error', message: 'در آدرس نمی توانید از فاصله استفاده کنید.'});
        if(ew == 45) return true;
        if(48 <= ew && ew <= 57) return true;
        if(65 <= ew && ew <= 90) return true;
        if(97 <= ew && ew <= 122) return true;
        return false;
    });
</script>

<script>
    function formatState(state) {
        return state.text;
    };

    $("#parent").select2ToTree({
        matcher: function (params, data) {
            var original_matcher = $.fn.select2.defaults.defaults.matcher;
            var result = original_matcher(params, data);
            if (result && data.children && result.children && data.children.length != result.children.length) {
                result.children = data.children;
            }
            return result;
        }
    });

    $("#parentEdit").select2ToTree({
        matcher: function (params, data) {
            var original_matcher = $.fn.select2.defaults.defaults.matcher;
            var result = original_matcher(params, data);
            if (result && data.children && result.children && data.children.length != result.children.length) {
                result.children = data.children;
            }
            return result;
        }
    });

    var myCategory = <?= json_encode($data['categoryChild']) ?>;

    $("#parent").select2ToTree({
        treeData: {
            dataArr: myCategory
        },
        maximumSelectionLength: 1,
        templateResult: formatState,
        templateSelection: formatState
    });

    $("#parentEdit").select2ToTree({
        treeData: {
            dataArr: myCategory
        },
        maximumSelectionLength: 1,
        templateResult: formatState,
        templateSelection: formatState
    });
</script>

<script>
    $(function () {
        let status_state_inp, cat_state_inp = null;
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
        $categoryData = '<option value="">همه موارد</option>';
        foreach ($data['category'] as $category) {
            $categoryData .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
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
                const  select_array = [0, 1, 2, "", 4, "", 6];
                for (i = 0; i < data.columns["length"]; i++) {
                    var col_search_val = data.columns[i].search.search;
                    if (col_search_val != "") {
                        if (select_array[i] !== "") {
                            $("input", $("tfoot th")[i]).val(col_search_val);
                        } else {
                            switch(i){
                                case 3:
                                    cat_state_inp = col_search_val.replace("^", "").replace("$", "");
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
                {orderable: false, targets: [6]},
                {className: "priority-1", "targets": [0, 1, 2, 3, 4, 5, 6]},
                {className: "priority-2", "targets": []}
            ],
            "ajax": $.fn.dataTable.pipeline({
                url: "<?= ADMIN_PATH; ?>/getCategoryAjax?type=<?= $data['attrId']; ?>",
                pages: 5
            }), initComplete: function () {
                this.api().columns(3).every(function () {
                    var column = this;
                    var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب دسته بندی</option><?= $categoryData; ?></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    $(select).children().each(function(d, j) {
                        if(j.value == cat_state_inp){
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
    $(document).on("click", "[id*=btn-status-]", function () {
        document.getElementById("status-val").value = $(this).data('id');
    });

    $(document).on("click", "#status-submit", function () {
        $('#status-Modal').modal('hide');
        var id = document.getElementById('status-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("type", "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/statusCategory",
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
        var title = document.getElementById("title").value;
        var slug = toEnglishNumber(document.getElementById("slug").value);
        var parent = document.getElementById("parent").value;
        var description = CKEDITOR.instances['description'].getData();

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان دسته بندی  را وارد کنید.'});
        } else if (slug == "") {
            $.wnoty({type: 'warning', message: 'آدرس دسته بندی  را وارد کنید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال ثبت...");
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("type", "<?= $data['attrId']; ?>");
                formData.append("slug", slug);
                formData.append("description", description);
                formData.append("parent", parent);

                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addCategory",
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
        $("#titleEdit").val($(this).data('name'));
        $("#slugEdit").val($(this).data('link'));
        if($(this).data('parent-category') != 0) {
            $("#parentEdit").val($(this).data('parent-category')).change();
        }
        CKEDITOR.instances.descriptionEdit.setData($(this).data('description'));
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById('titleEdit').value;
        var slugEdit = document.getElementById('slugEdit').value;
        var parentEdit = document.getElementById("parentEdit").value;
        var descriptionEdit = CKEDITOR.instances['descriptionEdit'].getData();

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("titleEdit", titleEdit);
            formData.append("slugEdit", slugEdit);
            formData.append("descriptionEdit", descriptionEdit);
            formData.append("parentEdit", (parentEdit!="" ? parentEdit:0));
            formData.append("type", "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editCategory",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-" + id).parent().prev().prev().prev().prev().prev().html(titleEdit);
                        $("#btn-edit-" + id).parent().prev().prev().prev().prev().html(slugEdit);
                        $("#btn-edit-" + id).parent().prev().prev().prev().html($("#parentEdit").find(':selected').html());

                        $("#btn-edit-"+id).data('name', titleEdit);
                        $("#btn-edit-"+id).data('link', slugEdit);
                        $("#btn-edit-"+id).data('description', descriptionEdit);
                        $("#btn-edit-"+id).data('parent-category', parentEdit);
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
            formData.append("id", "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/delCategory",
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
