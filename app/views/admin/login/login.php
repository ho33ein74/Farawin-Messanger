<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ورود به پنل مدیریت | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php if($data['getPublicInfo']['google_captcha_status'] == "1" AND ($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL)){ ?>
        <script src='https://www.google.com/recaptcha/api.js?render=<?= $data['getPublicInfo']['google_captcha_site_key']; ?>'></script>
    <?php } ?>
    <?php require('app/views/admin/include/publicCSS.php'); ?>
</head>
<body class="hold-transition login-page" style="background-image: url('public/images/<?= $data['getPublicInfo']['login_admin_background']; ?>');background-repeat: no-repeat;
        background-attachment: fixed;background-size: cover;">
<div class="login-box" style="background:#fff;margin:5% auto 0% auto">
    <div class="login-logo" style="padding-top: 25px;">
        <img src="public/images/logos/<?= $data['getPublicInfo']['logo']; ?>" alt="<?= $data['getPublicInfo']['site']; ?>" style="width: 90%;">
    </div>
    <hr/>
    <!-- /.login-logo -->
    <div class="login-box-body login-signin" style="padding-top:2px">
        <p class="login-box-msg"><strong>ورود به سامانه</strong></p>
        <div class="form-group has-feedback">
            <input type="email" class="form-control"
                   style="text-align: start;unicode-bidi: plaintext;padding-left: 34px;direction: ltr" name="username" id="username" placeholder="شماره موبایل"
                   required>
            <span style="left: 0;" class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <div class="input-group">
                <span id="pass-change-status" class="input-group-addon"><i id="pass-status" class="fa fa-eye-slash"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="کلمه عبور" style="padding-right: 10px;text-align: start;unicode-bidi: plaintext;">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px">
            <button style="margin-top:10px" type="submit" name="login" id="login"
                    class="btn btn-primary btn-block btn-small">
                <div id="titr">ورود</div>
            </button>
        </div>
        <div class="row" style="font-size: 10pt;">
            <div class="col-xs-12">
                <a href="<?= ADMIN_PATH; ?>/forgetPassword" style="color: inherit;">.کلمه عبور را فراموش کرده اید؟! <span>اینجا کلیک کنید</span></a>
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->

    <!-- /.login-logo -->
    <div class="login-box-body login-auth" style="display: none;padding-top:2px">
        <p class="login-box-msg"><strong>کد تایید برنامه Google Authenticate را وارد نمایید</strong></p>
        <div class="form-group has-feedback">
            <input type="number" class="form-control" style="text-align: start;unicode-bidi: plaintext;padding-left: 34px;padding-right: 0px;direction: ltr" autocomplete="off" name="code" id="code" placeholder="کد تایید" required>
            <span style="left: 0;" class="fa fa-google form-control-feedback"></span>
        </div>
        <div class="row" style="margin-bottom: 15px">
            <button style="margin-top:10px" type="submit" name="authBtn" id="authBtn"
                    class="btn btn-primary btn-block btn-small">
                <div id="titr">تایید</div>
            </button>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
    $(document).ready(function () {
        $("#username").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
</script>

<script>
    $("#pass-change-status").on('click', function () {
        var passwordInput = document.getElementById('password');
        var passStatus = document.getElementById('pass-status');
        if (passwordInput.type == 'password') {
            passwordInput.type = 'text';
            passStatus.className = 'fa fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            passStatus.className = 'fa fa-eye';
        }
    });
</script>

<script>
    <?php if($data['getPublicInfo']['google_captcha_status'] == "1" AND ($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL)){ ?>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?= $data['getPublicInfo']['google_captcha_site_key']; ?>', {action: 'action_name'}).then(function (token) {
            <?php } ?>
            $("#login").on('click', function () {
                var username = document.getElementById("username").value;
                var password = document.getElementById("password").value;
                if (password == "" && username == "") {
                    $.wnoty({type: 'warning', message: 'لطفا تمامی فیلدهای دارای * را به صورت دقیق تکمیل کنید.'});
                }
                else {
                    if (navigator.onLine) {
                        var formData = new FormData();
                        formData.append("username", username);
                        formData.append("password", password);
                        $.ajax({
                            url: "<?= ADMIN_PATH; ?>/loginCheck",
                            data: formData,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});

                                if (data.status == "auth") {
                                    $(".login-signin").hide();
                                    $(".login-auth").show();
                                } else if (data.status == "ok") {
                                    window.location = "<?= ADMIN_PATH; ?>/dashboard";
                                }
                            }
                        });
                    } else {
                        $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان اعتبارسنجی وجود ندارد.'});
                    }
                }
            });

            $("#authBtn").on('click', function () {
                var username = document.getElementById("username").value;
                var code = document.getElementById("code").value;
                if (code == "") {
                    $.wnoty({type: 'warning', message: 'لطفا کد تایید را وارد نمایید.'});
                } else {
                    if (navigator.onLine) {
                        var formData = new FormData();
                        formData.append("username", username);
                        formData.append("code", code);
                        $.ajax({
                            url: "<?= ADMIN_PATH; ?>/authCheck",
                            data: formData,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});

                                if (data.status == "ok") {
                                    window.location = "<?= ADMIN_PATH; ?>/dashboard";
                                }
                            },
                        });
                    } else {
                        $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان اعتبارسنجی وجود ندارد.'});
                    }
                }
            });
            <?php if($data['getPublicInfo']['google_captcha_status'] == "1" AND ($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL)){ ?>
        });
    });
    <?php } ?>
</script>
</body>

</html>
