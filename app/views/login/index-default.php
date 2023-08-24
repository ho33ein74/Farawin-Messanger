<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>ورود به حساب کاربری <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="og:image:width" content="697">
    <meta property="og:image:height" content="299">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="twitter:description" content="<?= $data['getPublicInfo']['site']; ?>، <?= $data['getPublicInfo']['meta_description']; ?>">
    <meta property="twitter:title" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:description" content="<?= $data['getPublicInfo']['site']; ?>، <?= $data['getPublicInfo']['meta_description']; ?>">
    <meta property="og:title" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta name="description" content="<?= $data['getPublicInfo']['meta_description']; ?>">
    <meta name="article:publisher" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <link rel="canonical" href="<?= Model::str_left_replace("//", "/", URL. $_SERVER['REQUEST_URI']) ?>"/>

    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="public/css/login.auth.css">

    <?php require('app/views/include/favicon.php'); ?>

    <style>
        #login_code {
            letter-spacing: 2px;
            color: hsl(0deg 0% 47%) !important;
            border: 1px solid hsl(0deg 0% 93%) !important;
            padding: 30px 21px 27px 21px !important;
            font-size: 20px !important;
            text-align: start !important;
            unicode-bidi: plaintext;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-7 login-info-desktop bg-sky w-100 p-5 d-flex align-items-center">
            <img class="top-right" src="public/images/top-right.png" alt="">
            <img class="top-left" src="public/images/dots.png" alt="">
            <img class="bottom-right" src="public/images/dots.png" alt="">
            <div class="p-5">
                <h2 class="text-light font-weight-light mb-5"><?= $data['getPublicInfo']['site']; ?></h2>
                <!-- repair -->
                <?php foreach($data['icons'] as $icon){ ?>
                    <div class="item mt-4">
                        <a class="d-inline-block">
                            <div class="d-inline-block mr-3 frame radius-10">
                                <img class="d-inline-block p-2"width="65" height="65" src="public/images/icons/<?= $icon['i_icon'] ?>" alt="<?= $icon['i_title'] ?>">
                            </div>
                            <div class="d-inline-block description">
                                <h6 class="text-white font-weight-bold"><?= $icon['i_title'] ?></h6>
                                <p class="text-light mb-0"><?= $icon['i_description'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            </div>
            <div class="bottom-left">
                <a href="about" class="text-white mr-4 font-weight-light">درباره <?= $data['getPublicInfo']['site']; ?></a>
            </div>
        </div>

        <div class="col-md-5 login-form bg-powder d-flex align-items-center p-5">
            <div class="w-100">
                <div class="text-center logo">
                    <a href="<?= URL; ?>">
                        <img class="d-inline-block" src="public/images/logos/<?= $data['getPublicInfo']['logo']; ?>" style="width: 300px" alt="<?= $data['getPublicInfo']['site']; ?>"/>
                    </a>
                </div>
                <!-- storeNumberForm -->
                <div class="w-100 d-flex justify-content-center" id="store-number-form">
                    <input type="hidden" name="previous" id="previous" value="">
                    <div class="custome-size">
                        <div class="bg-white shadow-sm w-100 radius-10 p-4">
                            <div class="d-flex justify-content-between">
                                <h3 class="d-inline-block text-cloud mb-3">ورود / ثبت‌نام</h3>
                                <img class="d-inline-block" width="39" height="39" src="public/images/import.png" alt="">
                            </div>
                            <div class="form-group mt-4 item">
                                <label class="text-cloud">شماره همراه</label>
                                <div class="text-right fields">
                                    <input type="number" pattern="/d*" onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" maxlength="11" dir="ltr" name="username" id="username" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                           name="phone_number" autocomplete="off" value="" class="form-control phone-number radius-10 text-right" placeholder="09********">
                                    <i class="icon-phone"></i>
                                </div>
                                <div id="username-error" class="invalid-feedback" style="display:none"></div>
                            </div>
                            <div class="mt-3 logged text-center">
                                <span class="text-silver">برای ورود/ثبت نام شماره موبایل خود را وارد نمایید.</span>
                            </div>
                            <div class="text-right submit mt-3">
                                <button class="btn bg-sky login-btn text-light radius-10" id="store-number">
                                    ادامه
                                    <i class="icon-long-arrow-left d-inline-block "></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-4 text-center social-media">
                            <?php if (
                                isset($data['getMethodsContacting']['telegram']) and
                                $data['getMethodsContacting']['telegram']['mc_show_in_login_page'] == "1" and
                                $data['getMethodsContacting']['telegram']['mc_link'] != NULL
                            ) { ?>
                                <a href="<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>" target="_blank" class="telegram text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-telegram-plane"></i>
                                </a>
                            <?php } ?>

                            <?php if (
                                isset($data['getMethodsContacting']['linkedin']) and
                                $data['getMethodsContacting']['linkedin']['mc_show_in_login_page'] == "1" and
                                $data['getMethodsContacting']['linkedin']['mc_link'] != NULL
                            ) { ?>
                                <a href="<?= $data['getMethodsContacting']['linkedin']['mc_link']; ?>" target="_blank" class="linkedin text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-linkedin-in"></i>
                                </a>
                            <?php } ?>

                            <?php if (
                                isset($data['getMethodsContacting']['instagram']) and
                                $data['getMethodsContacting']['instagram']['mc_show_in_login_page'] == "1" and
                                $data['getMethodsContacting']['instagram']['mc_link'] != NULL
                            ) { ?>
                                <a href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>" target="_blank" class="instagram text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-instagram"></i>
                                </a>
                            <?php } ?>

                            <?php if (
                                isset($data['getMethodsContacting']['instagram']) and
                                $data['getMethodsContacting']['aparat']['mc_show_in_login_page'] == "1" and
                                $data['getMethodsContacting']['aparat']['mc_link'] != NULL
                            ) { ?>
                                <a href="<?= $data['getMethodsContacting']['aparat']['mc_link']; ?>" target="_blank" class="aparat text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-film"></i>
                                </a>
                            <?php } ?>
                            <span class="text-silver d-block mt-2">ما را در شبکه های اجتماعی دنبال کنید</span>
                        </div>
                    </div>
                </div>
                <!-- storeNumberForm -->

                <!-- verifyCodeForm -->
                <div class="w-100 d-none justify-content-center" id="verifyCode-form">
                    <div class="custome-size">
                        <div class="bg-white shadow-sm w-100 radius-10 p-4">
                            <div class="form-validate-forget" name="verifyCode-form">
                                <input type="hidden" name="previous" id="previous" value="">
                                <input id="user_id" type="hidden" name="user_id" value="">
                                <div class="d-flex justify-content-between">
                                    <h3 class="d-inline-block text-cloud mb-3">تایید شماره موبایل.</h3>
                                    <img class="d-inline-block" width="39" height="39" src="public/images/sms.png" alt="">
                                </div>
                                <span class="text-silver">کد تایید برای شماره <span id="showPhones"></span> ارسال شد<i class="icon-smile-beam ml-2"></i></span>

                                <div class="form-group mt-3">
                                    <label class="text-cloud">کد تایید را وارد نمایید</label>
                                    <div class="d-flex justify-content-center">
                                        <input type="text" class="form-control radius-10" dir="ltr" maxlength="4"  name="password" id="login_code" placeholder="1234">
                                        <input type="hidden" id="status_user">
                                    </div>
                                    <div id="code-error" class="invalid-feedback" style="display:none"></div>
                                </div>
                                <div class="form-group mt-3">
                                    <div class="timer-box">
                                        <img width="33" height="33" src="public/images/progress-check.png" alt="">
                                        <span class="d-inline-block" id="timer"></span>
                                        <span class="d-inline-block">ثانیه تا درخواست مجدد کد</span>
                                    </div>
                                    <div class="resend-code">
                                        <a class="small font-weight-bold" id="resend-code" href="javascript:;">
                                            <img width="31" height="31" src="public/images/reset.png" alt="">
                                            دریافت مجدد کد تایید
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-3 logged text-center">
                                    <span class="text-silver">شماره موبایل را اشتباه وارد کردید؟</span>
                                    <a class="font-weight-bold" href="login">تغییر شماره موبایل</a>
                                </div>
                                <div class="text-right submit mt-3">
                                    <button type="submit" id="login_button" class="btn bg-sky login-btn text-light radius-10">
                                        ورود
                                        <i class="icon-long-arrow-left d-inline-block "></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center social-media">
                            <?php if ($data['getMethodsContacting']['telegram']['mc_show_in_login_page'] == "1" AND $data['getMethodsContacting']['telegram']['mc_link'] != NULL) { ?>
                                <a href="<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>" target="_blank" class="telegram text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-telegram-plane"></i>
                                </a>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['linkedin']['mc_show_in_login_page'] == "1" AND $data['getMethodsContacting']['linkedin']['mc_link'] != NULL) { ?>
                                <a href="<?= $data['getMethodsContacting']['linkedin']['mc_link']; ?>" target="_blank" class="linkedin text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-linkedin-in"></i>
                                </a>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['instagram']['mc_show_in_login_page'] == "1" AND $data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                                <a href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>" target="_blank" class="instagram text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-instagram"></i>
                                </a>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['aparat']['mc_show_in_login_page'] == "1" AND $data['getMethodsContacting']['aparat']['mc_link'] != NULL) { ?>
                                <a href="<?= $data['getMethodsContacting']['aparat']['mc_link']; ?>" target="_blank" class="aparat text-silver mx-2">
                                    <i class="d-inline-block bg-powder radius-10 icon-film"></i>
                                </a>
                            <?php } ?>
                            <span class="text-silver d-block mt-2">ما را در شبکه های اجتماعی دنبال کنید</span>
                        </div>
                    </div>
                </div>
                <!-- verifyCodeForm -->
            </div>
        </div>
    </div>
</div>

<script src="public/js/jquery-3.4.1.min.js" type="text/javascript"></script>
<script src="public/js/login.auth.js"></script>
<script src="public/js/validate.min.js"></script>
<script src="public/js/validation.messages_fa.js"></script>

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
    $('#username').focus();

    $(document).ready(function () {
        $('#username').keypress(function(e) {
            if(e.which == 13) {
                submitForm();
            }
        });

        $("#store-number").click(function (e) {
            e.preventDefault();
            submitForm();
        });
    });

    function submitForm(){
        var phoneNumber = $('#username').val();

        if(phoneNumber.length == 11) {
            var formData = new FormData();
            formData.append("phone", phoneNumber);
            $.ajax({
                url: "login/mobile",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $('#code-error').html(data.msg).show();

                    if (data.status == "ok") {
                        document.getElementById("status_user").value = data.data.type;
                        $("#showPhones").html($('#username').val());
                        $('#store-number-form').removeClass('d-flex').addClass('d-none');
                        $('#verifyCode-form').removeClass('d-none').addClass('d-flex');
                        $('#login_code').focus();
                    } else {
                        $('#username-error').html(data.msg).show();
                    }
                },
            });
        } else {
            $('#username-error').html("لطفا یک شماره موبایل معتبر وارد نمایید.").show();
        }
    }

    $("#login_button").on("click", function () {
        var login_code = document.getElementById("login_code").value;

        if("" == login_code){
            $('#code-error').html("لطفا رمز ورود یکبار مصرف را به صورت دقیق وارد نمایید.").show();
        } else{
            var formData = new FormData();
            formData.append("code", login_code);
            $.ajax({
                url: "login/verifyMobile",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $('#code-error').html(data.msg).show();

                    if (data.status == "ok") {
                        if($('#status_user').val()=="old"){
                            window.location.href = "<?= htmlspecialchars($_GET['backURL'])=="" ? URL:htmlspecialchars($_GET['backURL']); ?>";
                        } else {
                            window.location.href = "user/profile";
                        }
                    }
                },
            });
        }
    });

    $("#resend-code").click(function (e) {
        e.preventDefault();
        var phoneNumber = $('#username').val();

        $.ajax({
            type: 'post',
            url: "login/resendCode",
            data: {
                'phone': phoneNumber
            },
            success: function (response) {
                if (!response.includes("ok")) {
                    $('#username-error').html("متاسفانه خطایی رخ داده است.").show();
                }
            }
        });
    });
</script>

</body>
</html>
