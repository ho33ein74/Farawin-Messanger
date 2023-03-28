<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت <?= $data['pageInfo']['title']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>مدیریت <?= $data['pageInfo']['title']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/pages"><i class="fa fa-clone"></i> Page</a></li>
                <li class="active">Edit Page</li>
            </ol>
        </section>

        <section class="content" style="min-height: unset;padding-bottom: 0">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">مدیریت <?= $data['pageInfo']['title']; ?></h3>
                            <?php if($data['pageInfo']['link'] == "dashboard-main"){ ?>
                                <div class="box-tools pull-right">
                                    <button data-toggle="modal" data-target="#reset-Modal" class="btn btn-warning">
                                        ریست داشبورد
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="از منوی سمت راست می توانید ویجت های مورد نظر خود را انتخاب و به ویجت های نمایشی در صفحه داشبورد اضافه نمایید." class="box-body">

                            <div class="page-container overflow-auto ">
                                <div class="scrollable-page main-scrollable-page ps ps__rtl" style="height: 728px; position: relative;">
                                    <div id="page-content" class="page-wrapper clearfix">

                                        <div class="clearfix">
                                            <div class="p15 pt0 pl0 col-md-3" id="widget-container-area" style="position: sticky;top: 5rem;overflow: visible;">
                                                <div class="text-center bg-white">
                                                    <div class="box p15 col-md-12">
                                                        <a class="btn btn-default col-md-12 block" title="افزودن ویجت"  data-toggle="modal" data-target="#custom-widget-Modal">
                                                            افزودن ویجت
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round" class="feather feather-plus-circle icon-16">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="12" y1="8" x2="12" y2="16"></line>
                                                                <line x1="8" y1="12" x2="16" y2="12"></line>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <div class="add-column-panel js-widget-container p15 pt0 col-md-12" id="add-column-panel-1000000">
                                                        <?= $data['templates'] ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p15 pt0 pr0 col-md-9 pl0 ml298" id="widget-row-container">
                                                <div class="card">
                                                    <form id="dashboard-form" class="general-form" role="form" method="post" accept-charset="utf-8" novalidate="novalidate">
                                                        <input type="hidden" name="data" id="widgets-data" value="[]">
                                                        <input type="hidden" name="id" value="<?= $data['attrId'] ?>">
                                                        <input type="hidden" name="title" value="<?= $data['pageInfo']['title']; ?>">
                                                        <input type="hidden" name="color" value="#f1c40f">

                                                        <div class="card-body clearfix">
                                                            <div class="col-md-12 p15 bg-off-white float-end" id="widget-row-area">
                                                                <div id="widget-column-container">
                                                                    <?= $data['widgets'] ?>
                                                                </div>

                                                                <div id="add-column-button" class="dropdown-toggle w100p p10 bg-white text-center clickable collapsed" data-bs-toggle="collapse" data-bs-target="#add-column-collapse-panel" aria-expanded="false">
                                                                    افزودن سطر
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle icon-16">
                                                                        <circle cx="12" cy="12" r="10"></circle>
                                                                        <line x1="12" y1="8" x2="12" y2="16"></line>
                                                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                                                    </svg>
                                                                </div>
                                                                <div class="font-100p first-row-of-widget collapse" id="add-column-collapse-panel" style="">
                                                                    <div class="card mb0">
                                                                        <div class="list-group text-center">
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="12">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-12 col-md-12">
                                                                                        <div class="grid-bg">1</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="6-6">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                        <div class="grid-bg">1/2</div>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                        <div class="grid-bg">1/2</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="4-4-4">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-4 col-md-4">
                                                                                        <div class="grid-bg">1/3</div>
                                                                                    </div>
                                                                                    <div class="col-xs-4 col-md-4">
                                                                                        <div class="grid-bg">1/3</div>
                                                                                    </div>
                                                                                    <div class="col-xs-4 col-md-4">
                                                                                        <div class="grid-bg">1/3</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="3-6-3">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                        <div class="grid-bg">2/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="3-3-3-3">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="3-3-6">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                        <div class="grid-bg">1/2</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="6-3-3">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-6 col-md-6">
                                                                                        <div class="grid-bg">1/2</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="4-8">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-4 col-md-4">
                                                                                        <div class="grid-bg">1/3</div>
                                                                                    </div>
                                                                                    <div class="col-xs-8 col-md-8">
                                                                                        <div class="grid-bg">2/3</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="3-9">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-9 col-md-9">
                                                                                        <div class="grid-bg">3/4</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="9-3">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-9 col-md-9">
                                                                                        <div class="grid-bg">3/4</div>
                                                                                    </div>
                                                                                    <div class="col-xs-3 col-md-3">
                                                                                        <div class="grid-bg">1/4</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                            <a class="p10 text-center list-group-item column-grid-link" data-column-value="8-4">
                                                                                <div class="clearfix row">
                                                                                    <div class="col-xs-8 col-md-8">
                                                                                        <div class="grid-bg">2/3</div>
                                                                                    </div>
                                                                                    <div class="col-xs-4 col-md-4">
                                                                                        <div class="grid-bg">1/3</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="box-footer" style="display: block;">
                                                    <button class="btn btn-success" id="btnsubmit">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ps__rail-x" style="left: 1px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 1032px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <?php if($data['pageInfo']['link'] == "dashboard-main"){ ?>
        <div dir="rtl" class="modal fade" id="reset-Modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="color: #fff;background: #2484c6;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">ریست داشبورد</h4>
                    </div>
                    <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                        <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                            <p class="email-wrap">
                                <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از انجام این کار اطمینان دارید؟</label>
                                <input id="reset-val" type="hidden" value="<?= $data['attrId'] ?>"/>
                            </p>
                            <div class="row" style="margin-right: 0;margin-left: 15px;">
                                <div class="sign-up-inside-login">
                                    <button id="reset-submit" class="btn btn-danger">ریست</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                        <span>با ریست کردن داشبورد تمامی تغییرات شما حذف و داشبورد به صورت پیش فرض برمیگردد</span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف ویجت</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا از حذف این ویجت اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف امکان بازیابی نیز وجود ندارد.</span>
                </div>
            </div>
        </div>
    </div>

    <div dir="rtl" class="modal fade" id="edit-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">ویرایش برند </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="titleEdit">عنوان برند (فارسی) :</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="coverEdit">تصویر برند :</label>

                                <div class="file-upload">
                                    <div class="image-upload-wrap image-upload-wrap-edit">
                                        <input class="file-upload-input file-upload-input-edit" type="file" id="coverEdit" name="coverEdit" onchange="readURL(this, 'edit');" accept="image/*">
                                        <div class="drag-text">
                                            <h5 class=" text-center">عکس مورد نظر را انتخاب کنید</h5>
                                        </div>
                                    </div>
                                    <div class="file-upload-content file-upload-content-edit">
                                        <img class="file-upload-image file-upload-image-edit" alt="your image">
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload('edit')" class="remove-image">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="title_enEdit">عنوان برند (انگلیسی) :</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="title_enEdit" name="title_enEdit" required="">
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

    <div dir="rtl" class="modal fade" id="custom-widget-Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">افزودن ویجت</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-8">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="title">عنوان ویجت:</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="title" name="title" required="">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" style="text-align:right">
                                <label for="show_title">نمایش عنوان:</label>
                                <select id="show_title" name="show_title" class="form-control" style="border-radius: 3px;">
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12'>
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="description">محتوا:</label>
                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" id="description" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <div class="row" style="margin-right: 0;margin-left: 15px;">
                        <div class="sign-up-inside-login">
                            <button id="add-submit" class="btn btn-primary">افزودن</button>
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
<script src="public/js/app.all.js"></script>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
     function getRandomAlphabet(length) {
        var result = '',
            chars = 'abcdefghijklmnopqrstuvwxyz';
        for (var i = length; i > 0; --i)
            result += chars[Math.round(Math.random() * (chars.length - 1))];
        return result;
    }

    //adjust height of widgets container
    function adjustHeightOfWidgetContainer() {
        if ($('.js-widget-container').height() > $(window).height() - 175) {
            $('.js-widget-container').height($(window).height() - 170).addClass("overflow-y-scroll");
        }
    }

    //prepare the columns according to column size
    function addNewColumn(columnValue) {
        var newColumnDiv = "",
            columns = columnValue.split("-");

        for (var i = 0; i < columns.length; i++) {
            newColumnDiv = newColumnDiv + "<div class='pr0 pl15 widget-column col-md-" + columns[i] + " col-sm-" + columns[i] + "'><div id='add-column-panel-" + getRandomAlphabet(5) + "' class='add-column-panel add-column-drop text-center p15'><span class='text-off empty-area-text'>ویجت ها را به اینجا بکشید و رها کنید</span></div></div>";
        }

        $("#widget-column-container").append("<row class='widget-row clearfix d-flex bg-white' data-column-ratio='" + columnValue + "'><div class='float-start row-controller text-off font-16'><span class='move'><i data-feather='menu' class='icon-16'></i></span><span class='delete delete-widget-row'><i data-feather='x' class='icon-16'></i></span></div><div class='float-start clearfix row-container row pr15 pl15'>" + newColumnDiv + "</div></row>");

        //new row added. hide the collapse panel
        $("#add-column-button").trigger("click");

        feather.replace();

        setTimeout(function () {
            initSortable();
        }, 500);
    }

    //initialize sortable
    function initSortable() {
        var options = {
            animation: 150,
            chosenClass: "sortable-chosen",
            ghostClass: "sortable-ghost",
            filter: ".empty-area-text",
            cancel: ".empty-area-text",
            onAdd: function (e) {
                //moved to the new column/row. save the widget position
                saveWidgetPosition();

                removeEmptyAreaText(e.to);
                addEmptyAreaText(e.to);
                addEmptyAreaText(e.from);
            },
            onUpdate: function (e) {
                //moved to the same column/row. save the widget position
                saveWidgetPosition();

                removeEmptyAreaText(e.to);
                addEmptyAreaText(e.to);
                addEmptyAreaText(e.from);
            }
        };

        //make elements sortable
        $(".add-column-panel").each(function (index) {

            var id = this.id;
            options.group = "add-column-panel";
            Sortable.create($("#" + id)[0], options);
        });

        //make the widget rows sortable
        options.group = "widget-column-container";
        Sortable.create($("#widget-column-container")[0], options);
    }

    //remove drag/drop text from new added area if there is no elements available
    function removeEmptyAreaText(index) {
        if ($(index).has("div").length > 0 && $(index).attr("id") !== "widget-column-container") {
            $(index).find("span.empty-area-text").remove();
        }
    }

    //add drag/drop text from removed area if there is no elements available
    function addEmptyAreaText(index) {
        if ($(index).has("div").length < 1) {
            if ($(index).hasClass("js-widget-container")) {
                //if it's widgets container area
                $(index).html("<span class='text-off empty-area-text'>ویجت دیگری در دسترس نیست</span>");
            } else {
                //if it's widgets row area
                $(index).html("<span class='text-off empty-area-text'>ویجت ها را به اینجا بکشید و رها کنید</span>");
            }
        }
    }

    //save the widget's position
    function saveWidgetPosition() {
        var rows = [];

        $(".widget-row").each(function (index) {
            var columns = [],
                $widgetColumn = $(this).find(".widget-column"),
                columnRatio = $(this).attr("data-column-ratio");

            if ($widgetColumn) {
                $widgetColumn.each(function (index) {
                    var widget = $(this).find(".widget").attr("data-value");
                    if (widget) {
                        var widgets = [];
                        $(this).find(".widget").each(function (index) {
                            var widgetValue = $(this).attr("data-value");
                            if (widgetValue) {
                                widgets.push({widget: widgetValue, title: $(this).find(".float-start").text()});
                            }
                        });
                        columns.push(widgets);
                    }
                });
            }
            if (columns.length) {
                rows.push({columns: columns, ratio: columnRatio});
            }
        });

        //convert array to json data and save into an input field
        $("#widgets-data").val(JSON.stringify(rows));
    }
</script>

<script>
    $(document).ready(function () {
        $("#add-column-collapse-panel .list-group-item").click(function () {
            //show widgets after adding the first row
            if ($("#add-column-collapse-panel").hasClass("first-row-of-widget")) {
                $("#add-column-collapse-panel").removeClass("first-row-of-widget");
                adjustHeightOfWidgetContainer();
            }
            var columnValue = $(this).attr("data-column-value");
            addNewColumn(columnValue);
        });

        //delete widget row
        $('body #widget-column-container').on('click', '.delete-widget-row', function () {
            //restore the selected widgets to widgets container
            var widgetColumn = $(this).closest(".widget-row").find(".widget-column");

            widgetColumn.each(function (index) {
                var widgets = $(this).find(".widget").attr("data-value");
                if (widgets) {
                    $(this).find(".widget").each(function (index) {
                        var widget = $(this).attr("data-value"),
                            widgetRow = $(this).html(),
                            errorClass = "";

                        if ($(this).hasClass("error")) {
                            errorClass = "error";
                        }

                        $(".js-widget-container").append("<div data-value=" + widget + " class='mb5 widget clearfix p10 bg-white " + errorClass + "'>" + widgetRow + "</div>");
                    });
                }
            });

            //remove drag/drop text from widget container
            removeEmptyAreaText($(".js-widget-container"));

            //remove the row finally
            $(this).closest(".widget-row").fadeOut(300, function () {
                $(this).closest(".widget-row").remove();
                saveWidgetPosition();
            });

            adjustHeightOfWidgetContainer();
        });
    });
</script>

<script>
    $(document).ready(function () {
        var hasRows = <?= $data['widgets'] ? 1:0; ?>;
        if (hasRows) {
            //initialize sortable if it's edit mode and there are widgets in dashboard
            initSortable();
        } else {
            //show the add row button in full width and initialize the functionable class to the collapse panel
            $("#add-column-collapse-panel").addClass("first-row-of-widget");
        }

        //in edit mode, store the existing data to input field
        saveWidgetPosition();
        adjustHeightOfWidgetContainer();

        $(window).resize(function () {
            adjustHeightOfWidgetContainer();
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var data = $(document.getElementById('dashboard-form')).serialize();

        if (navigator.onLine) {
            $("#btnsubmit").attr("disabled", "disabled");
            $("#btnsubmit").html('در حال ثبت');
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editDashboardWidget",
                type: 'POST',
                data: data,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});
                },
            });
            $("#btnsubmit").removeAttr("disabled");
            $("#btnsubmit").html('ذخیره اطلاعات');
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script>
    $("#add-submit").on('click', function () {
        $('#custom-widget-Modal').modal('hide');

        var title = document.getElementById('title').value;
        var show_title = document.getElementById('show_title').value;
        var description = document.getElementById('description').value;
        if(title == ""){
            $.wnoty({type: 'warning', message: 'عنوان ویجت را وارد کنید.'});
        } else if(description == ""){
            $.wnoty({type: 'warning', message: 'محتوای ویجت را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("show_title", show_title);
                formData.append("description", description);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addCustomWidget",
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
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        }
    });
</script>

<?php if($data['pageInfo']['link'] == "dashboard-main"){ ?>
<script>
    $("#reset-submit").on('click', function () {
        $('#reset-Modal').modal('hide');
        var id = document.getElementById('reset-val').value;

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/resetMainDashboard",
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
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>
<?php } ?>

<script>
    $(document).on("click", "[id*=btn-edit-]", function () {
        document.getElementById("edit-val").value = $(this).data('id');
        $("#titleEdit").val($(this).data('name'));
        $("#typeEdit").val($(this).data('type')).change();
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById('titleEdit').value;
        var typeEdit = document.getElementById('typeEdit').value;

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("titleEdit", titleEdit);
            formData.append("typeEdit", typeEdit);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editBanners",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().prev().prev().html(titleEdit);
                        $("#btn-edit-"+id).parent().prev().prev().html($("#typeEdit").find(':selected').data('name'));

                        $("#btn-edit-"+id).data('name', titleEdit);
                        $("#btn-edit-"+id).data('type', typeEdit);
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
                url: "<?= ADMIN_PATH; ?>/delCustomWidget",
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
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان حذف وجود ندارد.'});
        }
    });
</script>

</body>
</html>
