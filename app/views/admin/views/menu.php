<?php function displayList($list, $type) { ?>
    <ol class="dd-list">
        <?php foreach($list as $item) { ?>
            <li class="dd-item dd3-item <?= array_key_exists("children", $item) ? "dd-collapsed":"" ?>" data-id="<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-name="<?= $type == "sidebar" ? $item["s_name"]:$item["l_name"]; ?>">
                <div class="dd-handle dd3-handle"><?= $type == "sidebar" ? $item["s_name"]:$item["l_name"]; ?></div>
                <div class="dd3-content">
                    <span><?= $type == "sidebar" ? $item["s_name"]:$item["l_name"]; ?></span>
                    <div class='pull-left'>
                        <?php if(($type == "sidebar" AND $item["s_status"] == "1") OR $item["l_status"] == "1"){ ?>
                            <button style="margin: 1px;" data-toggle="modal" title="وضعیت" data-target="#status-Modal" id="btn-status-<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-id="<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                        <?php } else { ?>
                            <button style="margin: 1px;" data-toggle="modal" title="وضعیت" data-target="#status-Modal" id="btn-status-<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-id="<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" class="btn btn-danger btn-xs"><i class="fa fa-eye-slash"></i></button>
                        <?php } ?>
                        <button style="margin: 1px;<?= ($type == "sidebar" and $item["s_removable"] == "0") ? "display: none":"" ?>" data-toggle="modal" title="حذف" data-target="#del-Modal" id="btn-del-style-<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-id="<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                        <button style="margin: 1px;" data-toggle="modal" title="ویرایش" data-target="#edit-Modal" id="btn-edit-<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-id="<?= $type == "sidebar" ? $item["s_id"]:$item["l_id"]; ?>" data-name="<?= $type == "sidebar" ? $item["s_name"]:$item["l_name"]; ?>" data-link="<?= $type == "sidebar" ? $item["s_link"]:$item["l_link"]; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button>
                    </div>
                </div>
                <?php if (array_key_exists("children", $item)){ ?>
                    <?php displayList($item["children"], $type); ?>
                <?php } ?>
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
    <title>مدیریت فهرست های <?= $data['attrId'] == "header" ?  'هدر': ($data['attrId'] == "sidebar" ?  'سایدبار': 'فوتر'); ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/css/jquery.nestable.css">
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
                <small>لیست لینک های <?= $data['attrId'] == "header" ?  'هدر': ($data['attrId'] == "sidebar" ?  'سایدبار': 'فوتر'); ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/menu/<?= $data['attrId'] ?>"><i class="fa fa-television"></i> Appearance</a></li>
                <li class="active">Edit links of <?= $data['attrId'] ?></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div  class="col-md-4">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">افزودن گزینه های فهرست</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <div <?= $data['attrId'] == "sidebar" ? "style='display: none'":"" ?> class="panel box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a style="color: inherit;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                                برگه ها
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="true" style="">
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <!-- Custom Tabs (Pulled to the right) -->
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab_11-1" data-toggle="tab" aria-expanded="true">لیست همه</a></li>

                                                        <li style="display: none"><a href="#tab_12-2" data-toggle="tab" aria-expanded="false">جستجو</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab_11-1">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div style="max-height: 200px;overflow: scroll;">
                                                                            <div class="form-group" style="margin-right: 10px;">
                                                                                <?php foreach($data['pageInfo'] as $page){ ?>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <input type="checkbox" name="page" data-link="<?= $page['link'] ?>" data-id="<?= $page['p_id'] ?>" value="<?= $page['p_id'] ?>">
                                                                                            <?= $page['title'] ?>
                                                                                        </label>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <input id="btnsubmit_page" class="btn btn-dropbox" value="ثبت" type="submit">
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                        <div class="tab-pane" id="tab_12-2">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div class="form-group" style="text-align:right">
                                                                            <label style="width: 100%" align="right" for="title_page">:عبارت مورد نظر </label>
                                                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                                                   class="form-control" id="title_page" name="title_page" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="response_page"></div>
                                                                </div>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer">
                                                                    <input id="btnsubmit_search_page" class="btn btn-dropbox" value="ثبت" type="submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- nav-tabs-custom -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div <?= $data['attrId'] == "sidebar" ? "style='display: none'":"" ?> class="panel box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a style="color: inherit;" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                                نوشته ها
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <!-- Custom Tabs (Pulled to the right) -->
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab_21-1" data-toggle="tab" aria-expanded="true">لیست همه</a></li>

                                                        <li style="display: none"><a href="#tab_22-2" data-toggle="tab" aria-expanded="false">جستجو</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab_21-1">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div style="max-height: 200px;overflow: scroll;">
                                                                            <div class="form-group" style="margin-right: 10px;">
                                                                                <?php foreach($data['blog'] as $blog){ ?>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <input type="checkbox" name="blog" data-link="blog/article/<?= $blog['slug'] ?>" data-id="<?= $blog['n_id'] ?>" value="<?= $blog['n_id'] ?>">
                                                                                            <?= $blog['title'] ?>
                                                                                        </label>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <input id="btnsubmit_blog" class="btn btn-dropbox" value="ثبت" type="submit">
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                        <div class="tab-pane" id="tab_22-2">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div class="form-group" style="text-align:right">
                                                                            <label style="width: 100%" align="right" for="title_blog">:عبارت مورد نظر </label>
                                                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                                                   class="form-control" id="title_blog" name="title_blog" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="response_blog"></div>
                                                                </div>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer">
                                                                    <input id="btnsubmit_search_blog" class="btn btn-dropbox" value="ثبت" type="submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- nav-tabs-custom -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a style="color: inherit;" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                                پیوندهای دلخواه
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse <?= $data['attrId'] == "sidebar" ? "in":"" ?>" aria-expanded="<?= $data['attrId'] == "sidebar" ? "true":"false" ?>" style="<?= $data['attrId'] == "sidebar" ? "":"height: 0px;" ?>">
                                        <div class="box-body">
                                            <div class="box-body">
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label style="width: 100%" align="right" for="title">:عنوان لینک </label>
                                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                                   class="form-control" id="title" name="title" required>
                                                        </div>
                                                    </div>

                                                    <div class='col-md-12'>
                                                        <div class="form-group" style="text-align:right">
                                                            <label style="width: 100%" align="right" for="slug">:آدرس لینک </label>
                                                            <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" maxlength="40" autocomplete="off"
                                                                   class="form-control" id="slug" name="slug" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div <?= $data['attrId'] == "sidebar" ? "style='display: none'":"" ?> class="panel box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a style="color: inherit;" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                                                دسته ها
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <!-- Custom Tabs (Pulled to the right) -->
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab_31-1" data-toggle="tab" aria-expanded="true">لیست همه</a></li>

                                                        <li style="display: none"><a href="#tab_32-2" data-toggle="tab" aria-expanded="false">جستجو</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab_31-1">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div style="max-height: 200px;overflow: scroll;">
                                                                            <div class="form-group" style="margin-right: 10px;">
                                                                                <?php foreach($data['category'] as $category){ ?>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <input type="checkbox" name="category" data-link="blog/category/<?= $category['id'] ?>/<?= str_replace(" ", "-", $category['name']) ?>" data-id="<?= $category['id'] ?>" value="<?= $category['id'] ?>">
                                                                                            <?= $category['name'] ?>
                                                                                        </label>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <input id="btnsubmit_category" class="btn btn-dropbox" value="ثبت" type="submit">
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                        <div class="tab-pane" id="tab_32-2">
                                                            <div class="box-body">
                                                                <div class='row'>
                                                                    <div class='col-md-12' style="padding: 0">
                                                                        <div class="form-group" style="text-align:right">
                                                                            <label style="width: 100%" align="right" for="title_category">:عبارت مورد نظر </label>
                                                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                                                   class="form-control" id="title_category" name="title_category" required>
                                                                        </div>
                                                                    </div>
                                                                    <div id="response_category"></div>
                                                                </div>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer">
                                                                    <input id="btnsubmit_search_category" class="btn btn-dropbox" value="ثبت" type="submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane -->
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- nav-tabs-custom -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-8">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">ساختار لینک های <?= $data['attrId'] == "header" ?  'هدر': ($data['attrId'] == "sidebar" ?  'سایدبار': 'فوتر'); ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div data-intro="با استفاده از ماوس می توانید لینک های زیر را جا به جا نمایید. برای داشتن زیر منو می توانید لینک مورد نظر را به سمت چپ یا راست با استفاده از ماوس بکشید." class="cf nestable-lists" dir="rtl">
                                <div class="dd" id="nestable">
                                    <?= displayList($data['menuFullList'], $data['attrId']); ?>
                                </div>
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

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف لینک </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از حذف این لینک  اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف تمامی  مطالب مربوط به این لینک نیز حذف میگردد و امکان بازیابی نیز وجود ندارد.</span>
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
                    <h4 class="modal-title">ویرایش لینک </h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold row" style="display: inline;block">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="titleEdit">عنوان لینک :</label>
                                <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="titleEdit" name="titleEdit" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:right">
                                <label style="width: 100%;" align="right" for="slugEdit">آدرس لینک :</label>
                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text" class="form-control" id="slugEdit" name="slugEdit" required="">
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
                <div class="modal-footer"
                     style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                    <span>در صورت فعال بودن، کلمه کلیدی در لیست های مورد نیاز نمایش داده خواهد شد.</span>
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

<script>
    $(document).ready(function () {
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target), output = list.data('output');

            if (navigator.onLine) {
                $.ajax({
                    method: "POST",
                    url: "<?= ADMIN_PATH; ?>/saveMenuList",
                    data: {
                        type: "<?= $data['attrId']; ?>",
                        list: list.nestable('serialize')
                    }
                }).fail(function(jqXHR, textStatus, errorThrown){
                    $.wnoty({type: 'error', message: 'متاسفانه خطایی رخ داده است.'});
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        };

        <?php if($data['attrId'] == "header") { ?>
        var depth = 2;
        <?php } else if($data['attrId'] == "sidebar") { ?>
        var depth = 4;
        <?php } else { ?>
        var depth = 1;
        <?php } ?>

        $('#nestable').nestable({
            'group': 1,
            'maxLevels': 2,
            'maxDepth': depth,
            'effect': {
                'animation': 'fade',
                'time': 'slow'
            },
        }).on('change', updateOutput);
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
    $(document).on("click", "[id*=btnsubmit_]", function () {
        var section = $(this).attr('id').replace('btnsubmit_','').replace('search_','');

        var checkedValues = $('input[name='+section+']:checked').map(function() {
            return this.value;
        }).get().join(',');

        if (checkedValues == "") {
            $.wnoty({type: 'warning', message: 'حداقل می بایست یک مورد را انتخاب نمایید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال ثبت...");

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("checkedValues", checkedValues);
                formData.append("part", section);
                formData.append("type", "<?= $data['attrId']; ?>");
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addLink",
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

    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var slug = toEnglishNumber(document.getElementById("slug").value);

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان لینک  را وارد کنید.'});
        } else if (slug == "") {
            $.wnoty({type: 'warning', message: 'آدرس لینک  را وارد کنید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال ثبت...");

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("slug", slug);
                formData.append("type", "<?= $data['attrId']; ?>");
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addLink",
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
        if($(this).data('link') == "-"){
            $("#slugEdit").prop('disabled', true);
        } else {
            $("#slugEdit").prop('disabled', false);
        }
    });

    $(document).on("click", "#edit-submit", function () {
        $('#edit-Modal').modal('hide');
        var id = document.getElementById('edit-val').value;
        var titleEdit = document.getElementById('titleEdit').value;
        var slugEdit = document.getElementById('slugEdit').value;

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            formData.append("titleEdit", titleEdit);
            formData.append("slugEdit", slugEdit);
            formData.append("type", "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editLink",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-edit-"+id).parent().prev().html(titleEdit);
                        $("#btn-edit-"+id).data('name', titleEdit);
                        $("#btn-edit-"+id).data('link', slugEdit);
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
            formData.append("type",  "<?= $data['attrId']; ?>");
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/delLink",
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
                url: "<?= ADMIN_PATH; ?>/statusLink",
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

</body>
</html>
