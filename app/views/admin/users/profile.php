<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>پروفایل | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>پروفایل</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/profile"><i class="fa fa-user"></i> Profile</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" data-id="<?= $data['attrId']; ?>">
            <div class="row">
                <!-- left column -->
                <div data-intro="برای تغییر کلمه عبور و اطلاعات شخصی خود می توانید از بخش زیر استفاده نمایید." class="col-md-6">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">اطلاعات کاربری</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="username">:نام کاربری</label>
                                            <input style="border-radius: 3px;text-align:left" type="username"
                                                   class="form-control" id="username" name="username"
                                                   value="<?= $data['infoAdmin'][0]['a_username']; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="name">:نام و نام خانوادگی</label>
                                            <input style="border-radius: 3px;text-align:right;direction: rtl" type="name"
                                                   class="form-control" id="name" name="name"
                                                   value="<?= $data['infoAdmin'][0]['a_name']; ?>">
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="email">:ایمیل</label>
                                            <input style="border-radius: 3px;text-align:left" type="email"
                                                   class="form-control" id="email" name="email"
                                                   value="<?= $data['infoAdmin'][0]['a_email']; ?>">
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="passNew">:کلمه عبور جدید</label>
                                            <input style="border-radius: 3px;text-align:left" type="password"
                                                   class="form-control" id="passNew" name="passNew" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="RepassNew">:تکرار کلمه عبور جدید</label>
                                            <input style="border-radius: 3px;text-align:left" type="password"
                                                   class="form-control" id="RepassNew" name="RepassNew" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ویرایش" type="submit">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->

                <div data-intro="برای امنیت بیشتر می توانید از ورود 2 مرحله ای گوگل استفاده نمایید. که در صورت فعال شدن این بخش در صفحه لاگین پس از وارد کردن نام کاربری و کلمه عبور کد ساخته شده توسط گوگل از شما خواسته می شود که می بایست با توجه به کد ساخته شده در نرم افزار Google Authenticate آن را وارد نمایید." class="col-md-6">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 dir="rtl" class="box-title">ورود 2 مرحله ای گوگل</h3>
                        </div>
                        <!-- /.box-header -->
                        <?php if($data['infoAdmin'][0]['google_auth_status']==0){ ?>
                            <div class="box-body">
                                <div class="box-body">
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label style="direction: rtl;">لطفاً برنامه Google Authenticate را در تلفن خود دانلود و نصب کنید و کد زیر را برای پیکربندی دستگاه خود اسکن کنید.</label>
                                            </div>
                                            <div style="float: right;width: 100%;margin-top: 10px;text-align: center">
                                                <img src="<?= $data['qr_code']; ?>" width="30%"/>
                                            </div>
                                        </div>

                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="code">:کد تایید</label>
                                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text"
                                                       class="form-control" id="code" name="code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnSubmitG2A" class="btn btn-dropbox" value="فعالسازی" type="submit">
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="box-body">
                                <div class="box-body">
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class="form-group" style="text-align:right">
                                                <label style="direction: rtl;">در حال حاضر ورود 2 مرحله ای شما فعال می باشد.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnSubmitG2D" class="btn btn-danger" value="غیرفعالسازی" type="submit">
                                </div>
                            </div>
                        <?php } ?>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div  data-intro="برای تغییر تصویر آواتار خود می توانید از بخش زیر استفاده نمایید." class="col-md-6">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">آواتار</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="avatar" style="direction: rtl;">انتخاب تصویر (سایز
                                                مناسب 300*300)</label>
                                        </div>
                                        <div>
                                            <input style="margin-top: -10px;float: right;" type='file' accept="image/*"
                                                   onchange="previewImg(this,'prevAvatar')"
                                                   id="avatar"/>
                                        </div>
                                        <div style="float: right;width: 200px;margin-top: 10px;text-align: center">
                                            <img height="130px" src="<?= $data['infoAdmin'][0]['a_image']; ?>"
                                                 onerror="this.src='public/images/default_cover.jpg'"
                                                 style="width: 100%;height: auto;" id="prevAvatar"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input id="btnSubmitAvatar" class="btn btn-dropbox" value="ویرایش" type="submit">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var passNew = document.getElementById("passNew").value;
        var RepassNew = document.getElementById("RepassNew").value;

        if ((RepassNew != "" || passNew != "") && RepassNew != passNew) {
            $.wnoty({type: 'warning', message: 'کلمه عبور با تکرار آن مطابقت ندارد.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("name", name);
                formData.append("email", email);
                formData.append("passNew", passNew);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/settingsEdit",
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

<script>
    $("#btnSubmitG2A").on('click', function () {
        var code = document.getElementById("code").value;
        if (code != "") {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("code", code);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/googleAuthentication",
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
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان تغییر وضعیت وجود ندارد.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'کد تاییدی که در نرم افزار نمایش داده شده را وارد نمایید.'});
        }
    });
</script>

<script>
    $("#btnSubmitG2D").on('click', function () {
        if (navigator.onLine) {
            var formData = new FormData();
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/googleAuthenticationDeactive",
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
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان تغییر وضعیت وجود ندارد.'});
        }
    });
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
                switch (id) {
                    case "prevAvatar":
                        $("img[name='prevAvatar']").attr("src", "");
                        break;
                    default:
                        $("#" + id).attr("src", "public/images/placeholder.jpg");
                        break;
                }
            }
        }
    }
</script>

<script>
    $("#btnSubmitAvatar").on('click', function () {
        var input = document.getElementById("avatar");
        file = input.files[0];

        formData = new FormData();
        if (file != undefined) {
            if (!!file.type.match(/image.*/)) {
                formData.append("image", file);
                if (navigator.onLine) {
                    $.ajax({
                            url: "<?= ADMIN_PATH; ?>/editAvatar",
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

</body>
</html>
