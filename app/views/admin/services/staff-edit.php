<?php
$staffInfo = $data['staffInfo'];
?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش پرسنل | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ویرایش پرسنل</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/staffs"><i class="fa fa-meh-o"></i> Staffs</a></li>
                <li class="active">Staff Edit</li>
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
                            <h3 class="box-title">ویرایش پرسنل</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای ویرایش اطلاعات پرسنل به راحتی می توانید بخش مورد نظر خود را ویرایش کنید.<br/>توجه داشته باشید صحت شماره کارت و شماره شبا بررسی می شود و در صورت اشتباه بودن امکان ویرایش وجود ندارد." class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="nameRepair">:نام و نام خانوادگی</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $staffInfo['0']['name']; ?>" class="form-control" id="nameRepair" name="nameRepair" required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="expertise">:تخصص</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $staffInfo['0']['expertise']; ?>" class="form-control" id="expertise" name="expertise" required>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="no_sheba">:شماره شبا</label>
                                            <div class="input-group">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" type="tel" maxlength="24" value="<?= $staffInfo['0']['no_sheba']; ?>" class="form-control" id="no_sheba" name="no_sheba">
                                                <span style="border-radius: 3px 0 0 3px;padding: 6px;" id="no_card_img" class="input-group-addon">
                                                    IR
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="no_card">:شماره کارت</label>
                                            <div class="input-group">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" type="tel" maxlength="19" onkeyup="setBankLogo();" value="<?= $staffInfo['0']['no_card']; ?>" class="form-control" id="no_card" name="no_card">
                                                <span style="border-radius: 3px 0 0 3px;padding: 6px;" id="no_card_img" class="input-group-addon">
                                                    <img id="bankLogo" style="width: 20px" src="../../../../public/images/onlinePayment3.png">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-4' hidden>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="score">:امتیاز</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" value="<?= $staffInfo['0']['score']; ?>" class="form-control" id="score" name="score" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class='row'>
                                    <div class='col-md-8'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="description">:توضیحات</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right" maxlength="250" class="form-control" rows="4" id="description" name="description" required><?= $staffInfo['0']['t_description']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="cover">:تصویر شخص</label>

                                            <div class="file-upload">
                                                <div style="display: <?= $staffInfo['0']['image']!="" ? "none":"block" ?>;" class="image-upload-wrap">
                                                    <input class="file-upload-input" type="file" id="cover" name="cover" onchange="readURL(this);" accept="image/*">
                                                    <div class="drag-text">
                                                        <h5 class=" text-center">عکس مورد نظر را انتخاب کنید</h5>
                                                    </div>
                                                </div>
                                                <div style="display: <?=$staffInfo['0']['image']!="" ? "block":"none" ?>;" class="file-upload-content">
                                                    <img class="file-upload-image" src="public/images/staffs/<?= $staffInfo['0']['image']; ?>" alt="your image">
                                                    <div class="image-title-wrap">
                                                        <button type="button" onclick="removeUpload()" class="remove-image">حذف</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div data-step="2" data-intro="بعد از ویرایش بخش های مورد نظر با استفاده از این دکمه می توانید اطلاعات ویرایش شده را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ویرایش موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ویرایش" type="submit">
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
<script src="../../../../public/js/iban.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>

<script>
    CKEDITOR.config.toolbar_MA=[ ['RemoveFormat','-','Format','FontSize','Bold','Italic','Underline','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList'] ];
    CKEDITOR.replace('description',
        {
            language: 'fa',
            allowedContent: true,
            toolbar:'MA'
        });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        setBankLogo();
    });
</script>

<script>
    $(document).ready(function() {
        $("#no_sheba,#no_card").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("nameRepair").value;
        var expertise = document.getElementById("expertise").value;
        var no_sheba = document.getElementById("no_sheba").value;
        var no_card = document.getElementById("no_card").value;
        var description = CKEDITOR.instances['description'].getData();
        var coverPost = document.getElementById("cover");
        var cover = coverPost.files[0];

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام و نام خانوادگی فرد را وارد کنید.'});
        } else if (no_sheba != "-" && !IBAN.isValid("IR" + no_sheba)) {
            $.wnoty({type: 'warning', message: 'شماره شبا صحیح نمی باشد.'});
        } else if (no_card!="-" && !checkCartDigit(no_card.replace(/-/g, ""))) {
            $.wnoty({type: 'warning', message: 'شماره کارت صحیح نمی باشد.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", <?= $data['attrId']; ?>);
                formData.append("name", name);
                formData.append("expertise", expertise);
                formData.append("description", description);
                formData.append("no_sheba", no_sheba);
                formData.append("no_card", no_card);
                formData.append("cover", cover);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editStaff",
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
        }
    });
</script>

</body>
</html>
