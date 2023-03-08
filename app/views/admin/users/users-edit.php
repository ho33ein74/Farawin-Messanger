<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش اطلاعات <?= $data['getUserInfo']['c_name'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ویرایش اطلاعات <?= $data['getUserInfo']['c_name'] ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/users"><i class="fa fa-users"></i> Users</a></li>
                <li class="active"> Edit user info</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش اطلاعات مشتری</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای ویرایش اطلاعات مشتری به راحتی می توانید بخش مورد نظر خود را ویرایش کنید."  class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class="col-lg-12">
                                        <div class="cu personal-pro ajaxform">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="name" class="">نام</label>
                                                            <input id="name" type="text" name="name" class="form-control" value="<?= $data['getUserInfo']['c_name'] ?>"  style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="family" class="">نام خانوادگی</label>
                                                            <input id="family" type="text" name="family" class="form-control" value="<?= $data['getUserInfo']['c_family'] ?>"
                                                                   style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="display_name" class="">نام نمایشی</label>
                                                            <input id="display_name" type="text" name="display_name" class="form-control" value="<?= $data['getUserInfo']['c_display_name'] ?>" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="mobile" class="">شماره موبایل</label>
                                                            <input id="mobile" type="text" name="mobile" value="<?= $data['getUserInfo']['c_mobile_num'] ?>" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: ltr" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="phone" class="">شماره ثابت</label>
                                                            <input id="phone" type="text" name="phone" value="<?= $data['getUserInfo']['c_phone_num'] ?>" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: ltr" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="email" class="">ایمیل</label>
                                                            <input id="email" type="text" name="email" value="<?= $data['getUserInfo']['c_email'] ?>" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: ltr" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='col-md-3'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="birthday">تاریخ تولد</label>
                                                        <?php $birth_date = json_decode($data['getUserInfo']['c_birthday'], true) ?>
                                                        <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text" class="form-control DatePickerPersian" value="<?= $birth_date!="" ? $birth_date['year']."/".$birth_date['month']."/".$birth_date['day']:"" ?>" id="birthday" name="birthday">
                                                    </div>
                                                </div>

                                                <div class='col-md-3'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="provinceId">استان</label>
                                                        <select id="provinceId" name="provinceId" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['provinces'] as $province) { ?>
                                                                <option <?= $data['getUserInfo']['province_id'] == $province['pro_id'] ? "selected":"" ?> data-id="<?= $province['pro_id']; ?>" value="<?= $province['pro_id']; ?>"><?= $province['pro_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class='col-md-3'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="cityId">شهر</label>
                                                        <select id="cityId" name="cityId" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['city'] as $city) { ?>
                                                                <option <?= $data['getUserInfo']['city_id'] == $city['id'] ? "selected":"" ?> data-id="<?= $city['pro_id']; ?>" value="<?= $city['id']; ?>"><?= $city['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class='col-md-3'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label align="right" for="no_card">شماره کارت</label>
                                                        <div class="input-group">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" type="tel" maxlength="19" value="<?= $data['getUserInfo']['c_cart_no'] ?>" onkeyup="setBankLogo();" class="form-control" id="no_card" name="no_card">
                                                            <span style="border-radius: 3px 0 0 3px;padding: 6px;" id="no_card_img" class="input-group-addon">
                                                                <img id="bankLogo" style="width: 20px" src="public/images/onlinePayment3.png">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="arithmetic" class="">وضعیت</label>
                                                            <select id="arithmetic" name="arithmetic" class="form-control select2Class" style="border-radius: 3px;width: 100%;" required>
                                                                <option <?= $data['getUserInfo']['c_arithmetic'] == 1 ? "selected":"" ?> value="1">خوش حساب</option>
                                                                <option <?= $data['getUserInfo']['c_arithmetic'] == 2 ? "selected":"" ?> value="2">بد حساب</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='col-md-4'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label style="width: 100%" align="right" for="cover">تصویر پروفایل</label>

                                                        <div class="file-upload">
                                                            <div style="display: <?= $data['getUserInfo']['c_image']!="" ? "none":"block" ?>;" class="image-upload-wrap">
                                                                <input class="file-upload-input" type="file" id="cover" name="cover" onchange="readURL(this);" accept="image/*">
                                                                <div class="drag-text">
                                                                    <h5 class=" text-center">عکس مورد نظر را انتخاب کنید</h5>
                                                                </div>
                                                            </div>
                                                            <div style="display: <?= $data['getUserInfo']['c_image']!="" ? "block":"none" ?>;" class="file-upload-content">
                                                                <img class="file-upload-image" src="<?= $data['getUserInfo']['c_image']; ?>" alt="your image">
                                                                <div class="image-title-wrap">
                                                                    <button type="button" onclick="removeUpload()" class="remove-image">حذف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-step="2" data-intro="بعد از ویرایش بخش های مورد نظر با استفاده از این دکمه می توانید اطلاعات ویرایش شده را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ویرایش موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                <input id="btn-submit-mobile" class="btn btn-dropbox" value="ویرایش" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php require('app/views/admin/include/footer.php'); ?>
</footer>
<?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>

<script>
    $(document).ready(function() {
        $("#mobile,#phone,#no_card").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });

        DP_Persian();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        setBankLogo();
    });
</script>

<script>
    function getCity(th, id) {
        var formData = new FormData();
        formData.append("states", $(th).find(':selected').attr('data-id'));
        $.ajax({
            url: "<?= ADMIN_PATH; ?>/getCityByProvince",
            data: formData,
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (json) {
                $('#'+id).html('');
                $.each(json, function (key, value) {
                    $.each(value, function (key, item) {
                        $('#'+id).append($('<option>', {
                            value: item.id,
                            text: item.name,
                            "data-name": item.name
                        }));
                        $("#"+id).select2({
                            placeholder: "انتخاب نمایید...",
                            allowClear: true
                        });
                    });
                });
            },
        });
    }

    $(document).on('change', '#provinceId', function (e) {
        getCity(this, "cityId");
    });
</script>

<script>
    $("#btn-submit-mobile").on('click', function () {
        var name = document.getElementById("name").value;
        var family = document.getElementById("family").value;
        var display_name = document.getElementById("display_name").value;
        var mobile = document.getElementById("mobile").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("email").value;
        var no_card = document.getElementById("no_card").value;
        var arithmetic = document.getElementById("arithmetic").value;
        var provinceId = document.getElementById("provinceId").value;
        var cityId = document.getElementById("cityId").value;
        var birthday = toEnglishNumber(document.getElementById("birthday").value);
        var coverBrand = document.getElementById("cover");
        var cover = coverBrand.files[0];

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام مشتری را وارد کنید.'});
        } else if (family == "") {
            $.wnoty({type: 'warning', message: 'نام خانوادگی مشتری را وارد کنید.'});
        } else if (display_name == "") {
            $.wnoty({type: 'warning', message: 'نام نمایشی مشتری را وارد کنید.'});
        } else if (mobile == "") {
            $.wnoty({type: 'warning', message: 'شماره موبایل را وارد کنید.'});
        } else if (provinceId == "") {
            $.wnoty({type: 'warning', message: 'استان مورد نظر را انتخاب کنید.'});
        } else if (cityId == "") {
            $.wnoty({type: 'warning', message: 'شهر مورد نظر را انتخاب کنید.'});
        } else if (no_card!="" && !checkCartDigit(no_card.replace(/-/g, ""))) {
            $.wnoty({type: 'warning', message: 'شماره کارت صحیح نمی باشد.'});
        } else {
            $("#btn-submit-mobile").attr("disabled", "disabled");
            document.getElementById("btn-submit-mobile").value =("در حال ویرایش...");

            var formData = new FormData();
            formData.append("id", <?= $data['attrId'] ?>);
            formData.append("name", name);
            formData.append("family", family);
            formData.append("display_name", display_name);
            formData.append("mobile", mobile);
            formData.append("phone", phone);
            formData.append("provinceId", provinceId);
            formData.append("cityId", cityId);
            formData.append("arithmetic", arithmetic);
            formData.append("email", email);
            formData.append("no_card", no_card);
            formData.append("birthday", birthday);
            formData.append("cover", cover);

            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editUser",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
                    }
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }

            $("#btn-submit-mobile").removeAttr("disabled");
            document.getElementById("btn-submit-mobile").value =("ویرایش");
        }
    });
</script>

</body>
</html>