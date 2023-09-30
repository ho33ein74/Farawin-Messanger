<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مشاهده اطلاعات کاربر | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <?php require('app/views/admin/include/header.php'); ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar direction">
        <?php require('app/views/admin/include/sidebar.php'); ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>مشاهده اطلاعات کاربر</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/users"><i class="fa fa-users"></i> Users</a></li>
                <li><a style="cursor: auto"> اطلاعات کاربر</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row" dir="rtl">
                <div class="col-md-4">
                    <div data-step="1" data-intro="در این قسمت اطلاعات کلی مشتری نمایش داده می شود"  class="col-md-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-blue">
                                <img class="profile-user-img img-responsive img-circle"
                                     onerror="this.src='public/images/user-default-image.jpg'"
                                     src="<?= $data['getUserInfo']['c_image'] ?>" alt="<?= $data['getUserInfo']['c_name']; ?>">
                                <h3 style="text-align: center;margin-left:0;margin-right: 0;" class="widget-user-username">
                                    <?= $data['getUserInfo']['c_name']!="" ? $data['getUserInfo']['c_name']." ".$data['getUserInfo']['c_family']:$data['getUserInfo']['c_display_name']; ?>
                                    <a data-step="2" data-intro="برای ویرایش اطلاعات مشتری می توانید از این دکمه استفاده نمایید."  href="<?= ADMIN_PATH; ?>/users/edit/<?= $data['getUserInfo']['customer_vids_id'] ?>"  class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                </h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li>
                                        <a>استان و شهر <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['province_id']!=NULL ? $data['getUserInfo']['pro_name']." - ".$data['getUserInfo']['ci_name']:"-"; ?></span></a>
                                    </li>
                                    <li>
                                        <a>شماره موبایل <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['c_mobile_num'] ?></span></a>
                                    </li>
                                    <li>
                                        <a>شماره ثابت <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['c_phone_num']!=NULL ? $data['getUserInfo']['c_phone_num']:"-"; ?></span></a>
                                    </li>
                                    <li>
                                        <a>ایمیل <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['c_email']!=NULL ? $data['getUserInfo']['c_email']:"-"; ?></span></a>
                                    </li>
                                    <li>
                                        <a>تاریخ تولد <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['c_birthday']!=NULL ? json_decode($data['getUserInfo']['c_birthday'], true)['year']."/".json_decode($data['getUserInfo']['c_birthday'], true)['month']."/".json_decode($data['getUserInfo']['c_birthday'], true)['day']:"-"; ?></span></a>
                                    </li>
                                    <li>
                                        <a>تاریخ عضویت <span class="pull-left"><?= $data['getUserInfo']['c_registery_date'] ?></span></a>
                                    </li>
                                    <li data-step="3" data-intro="در این قسمت وضعیت مشتری را می توانید ببینید که خوش حساب است یا بد حساب.<br/>از قسمت ویرایش مشخصات می توانید وضعیت را تغییر دهید.<br/>به صورت پیش فرض همه مشتریان خوش حساب هستند" >
                                        <a>وضعیت مشتری <span class="pull-left"><?= $data['getUserInfo']['c_arithmetic']==1 ? '<span class="btn btn-success btn-xs">خوش حساب</span>':'<span class="btn btn-danger btn-xs">بد حساب</span>' ?></span></a>
                                    </li>
                                    <li>
                                        <a>شماره کارت <span class="pull-left" dir="ltr"><?= $data['getUserInfo']['c_cart_no']!=NULL ? $data['getUserInfo']['c_cart_no']:"-"; ?></span></a>
                                    </li>
                                    <li>
                                        <a>نوبت های رزرو شده <span class="pull-left"><span style="margin: 1px" class="pull-right badge bg-green" title="نوبت های انجام شده"><?= count($data['userReservations']['success']) ?></span><span style="margin: 1px" class="pull-right badge bg-red-gradient" title="نوبت های لغو شده"><?= count($data['userReservations']['cancel']) ?></span><span style="margin: 1px" class="pull-right badge bg-danger" title="تعداد کل نوبت های رزرو شده"><?= count($data['userReservations']['all']) ?></span></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Custom Tabs (Pulled to the right) -->
                    <div class="nav-tabs-custom">
                        <ul data-step="4" data-intro="از این قسمت می توانید لیست نوبت های رزرو شده را مشاهده نمایید."  class="nav nav-tabs pull-right">
                            <li class="active"><a href="<?= $_SERVER['REQUEST_URI']; ?>#tab_documents" data-toggle="tab" aria-expanded="true">اسناد و مدارک</a></li>
                            <li class=""><a href="<?= $_SERVER['REQUEST_URI']; ?>#tab_services" data-toggle="tab" aria-expanded="false">نوبت های رزرو شده</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_documents">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-md-12">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">ثبت مدرک جدید</h3>
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
                                                                <label style="width: 100%" align="right" for="title">نوع مدرک:</label>
                                                                <input style="border-radius: 3px;text-align:right" type="text"
                                                                       class="form-control" id="title" name="title" required>
                                                            </div>
                                                        </div>

                                                        <div class='col-md-12'>
                                                            <div class="form-group" style="text-align:right">
                                                                <label style="width: 100%" align="right" for="cover">فایل:</label>

                                                                <div class="file-upload">
                                                                    <div class="image-upload-wrap image-upload-wrap-add">
                                                                        <input class="file-upload-input file-upload-input-add" type="file" id="cover" name="cover" onchange="readURL(this, 'add');" accept="*">
                                                                        <div class="drag-text">
                                                                            <h5 class=" text-center">فایل مورد نظر را انتخاب کنید</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="file-upload-content file-upload-content-add">
                                                                        <img class="file-upload-image file-upload-image-add" onerror="this.onerror=null;this.src='public/images/document.png';" alt="your image">
                                                                        <div class="image-title-wrap">
                                                                            <button type="button" onclick="removeUpload('add')" class="remove-image">حذف</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                    <div class="col-md-12">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">مدیریت مدارک</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="products">
                                                    <?php if(sizeof($data['documents'])>0){ ?>
                                                        <ul class="listing-items">
                                                            <?php foreach($data['documents'] as $document){ ?>
                                                                <li class="col-lg-4 col-md-6 col-xs-12 col-12 no-padding">
                                                                    <div class="product-box">
                                                                        <div class="status-in-slider">
                                                                            <?= $document['cd_title'] ?>
                                                                            <div class="checkbox-status-in-slider ">
                                                                                <button data-toggle="modal" data-target="#del-Modal" id="btn-del-style-<?= $document['cd_id'] ?>" data-id="<?= $document['cd_id'] ?>" class="btn btn-danger btn-xs">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>

                                                                        <a class="product-box-img" href="public/images/documents/<?= $document['cd_document'] ?>" target="_blank">
                                                                            <img class="lazyload" src="public/images/documents/<?= $document['cd_document'] ?>"
                                                                                 onerror="this.onerror=null;this.src='public/images/document.png';"
                                                                                 data-src="public/images/documents/<?= $document['cd_document'] ?>" alt="<?= $document['cd_title'] ?>">
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    <?php } else { ?>
                                                        <div style="text-align: center">
                                                            <img style="width:30%;margin-bottom:20px;" src="public/images/nodocument.png">
                                                            <p style="text-align: center;">در حال حاضر مدرکی ثبت نشده است.</p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_services">
                                <?php if (count($data['userReservations']['all']) > 0) { ?>
                                    <ul class="timeline timeline-inverse">
                                        <?php foreach ($data['userReservations']['all'] as $reservation) { ?>
                                            <li>
                                                <i title="<?= $reservation['statusTitle'] ?>" class="fa fa-bell-o bg-<?= $reservation['sre_status']==1 ? "yellow": ($reservation['sre_status']==4 ? "green":($reservation['sre_status']==5 ? "green":($reservation['sre_status']==6 ? "red":"blue"))); ?>"></i>
                                                <div class="timeline-item">
                                                        <span style="float: left;direction: ltr;" class="time">
                                                            <?= $reservation['statusTitle']; ?>
                                                        </span>

                                                    <h3 class="timeline-header"><?= $reservation['order_service_vids_id']; ?></h3>

                                                    <div class="timeline-body">
                                                        <p>
                                                            خدمت : <span><?= $reservation['s_title']; ?></span>
                                                        </p>
                                                        <p>
                                                            تاریخ رزرو شده : <span><?= $reservation['sre_day']." ".$reservation['sre_date']." ساعت ".$reservation['sre_time']; ?></span>
                                                        </p>
                                                        <p>
                                                            تاریخ ثبت درخواست : <span><?= $reservation['sre_time_create']." - ".$reservation['sre_date_create']; ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="timeline-footer" style="text-align: left;">
                                                        <a href="<?= ADMIN_PATH; ?>/reservations/details/<?= $reservation['order_service_vids_id']; ?>"
                                                           class="btn btn-primary btn-xs">مشاهده جزئیات نوبت</a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                        <li>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </li>
                                    </ul>
                                <?php } else { ?>
                                    <div style="text-align: center">
                                        <img style="width:15%;margin-bottom:20px;" src="public/images/notification.png">
                                        <p style="text-align: center;">در حال حاضر نوبتی ایجاد نشده است.</p>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.tab-pane -->
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

    <div dir="rtl" class="modal fade" id="del-Modal" role="dialog">
        <div class="modal-dialog" style="width: 300px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="color: #fff;background: #2484c6;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">حذف مدرک</h4>
                </div>
                <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                    <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                        <p class="email-wrap">
                            <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                                از حذف این مدرک اطمینان دارید؟</label>
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
                    <span>توجه کنید در صورت حذف امکان بازیابی نیز وجود ندارد.</span>
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
    $('.image-upload-wrap-add').bind('dragover', function() {
        $('.image-upload-wrap-add').addClass('image-dropping');
    });
    $('.image-upload-wrap-add').bind('dragleave', function() {
        $('.image-upload-wrap-add').removeClass('image-dropping');
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var coverSlider = document.getElementById("cover");
        var cover = coverSlider.files[0];

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان مدرک را وارد کنید.'});
        } else {
            $("#btnsubmit").attr("disabled", "disabled");
            document.getElementById("btnsubmit").value =("در حال ثبت...");

            var formData = new FormData();
            formData.append("title", title);
            formData.append("cover", cover);
            formData.append("id", <?= $data['attrId'] ?>);
            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addDocuments",
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
                url: "<?= ADMIN_PATH; ?>/delDocuments",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status == "ok") {
                        $("#btn-del-style-"+id).parent().parent().parent().parent().remove();
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