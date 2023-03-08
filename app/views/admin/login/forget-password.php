<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>فراموشی کلمه عبور | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php if($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL){ ?>
        <script src='https://www.google.com/recaptcha/api.js?render=<?= $data['getPublicInfo']['google_captcha_site_key']; ?>'></script>
    <?php } ?>
    <?php require('app/views/admin/include/publicCSS.php'); ?>
</head>
<body class="hold-transition login-page" style="background-image: url('public/images/<?= $data['getPublicInfo']['login_admin']; ?>');background-repeat: no-repeat;
    background-attachment: fixed;background-size: cover;">
<div class="login-box" style="background:#fff;margin:5% auto 0% auto">

    <div class="login-logo" style="padding-top: 25px;">
        <img src="public/images/logos/<?= $data['getPublicInfo']['logo']; ?>" alt="<?= $data['getPublicInfo']['site']; ?>" style="width: 90%;">
    </div>
    <hr/>
    <!-- /.login-logo -->
    <div class="login-box-body" style="padding-top:2px">
        <p class="login-box-msg"><strong>فراموشی کلمه عبور</strong></p>
        <div class="form-group has-feedback">
            <input type="email" class="form-control"
                   style="text-align: start;unicode-bidi: plaintext;padding-left: 34px;direction: ltr" name="username" id="username" placeholder="شماره موبایل"
                   required>
            <span style="left: 0;" class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <button style="margin-top:10px" type="submit" name="login" id="login"
                        class="btn btn-success btn-block btn-small">
                    <div id="titr">ارسال پیامک</div>
                </button>
            </div>
            <div class="col-xs-6">
                <a style="margin-top:10px" href="<?= ADMIN_PATH; ?>/login"
                        class="btn btn-default btn-block btn-small">
                    <div id="titr">ورود</div>
                </a>
            </div>
            <!-- /.col -->
        </div>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
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
    <?php if($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL){ ?>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?= $data['getPublicInfo']['google_captcha_site_key']; ?>', {action: 'action_name'}).then(function (token) {
            <?php } ?>
            $("#login").on('click', function () {
                var username = document.getElementById("username").value;
                if (username == "") {
                    $.wnoty({type: 'warning', message: 'لطفا شماره موبایل خود را به صورت دقیق تکمیل کنید.'});
                } else {
                    if (navigator.onLine) {
                        var formData = new FormData();
                        formData.append("username", username);
                        $.ajax({
                            url: "<?= ADMIN_PATH; ?>/forgetPasswordSendSMS",
                            data: formData,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                data = JSON.parse(data);
                                $.wnoty({type: data.noty_type, message: data.msg});
                            }
                        });
                    } else {
                        $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ارسال پیامک وجود ندارد.'});
                    }
                }
            });
            <?php if($data['getPublicInfo']['google_captcha_site_key'] != "" OR $data['getPublicInfo']['google_captcha_site_key'] != NULL){ ?>
        });
    });
    <?php } ?>
</script>
</body>

</html>
