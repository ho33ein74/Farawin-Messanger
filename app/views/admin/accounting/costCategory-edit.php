<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش دسته بندی | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ویرایش دسته بندی</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/costCategory"><i class="fa fa-tags"></i> Cost Category</a></li>
                <li class="active">Category Edit</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <?php
                    $style = $data['costCategory'];
                    ?>
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title" dir="rtl">اطلاعات زیر را در صورت نیاز ویرایش کنید:</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای ویرایش اطلاعات دسته بندی به راحتی می توانید بخش مورد نظر خود را ویرایش کنید."  class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="nameStyle">:عنوان دسته بندی</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $style['0']['title']; ?>"
                                                   class="form-control" id="nameStyle" name="nameStyle" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div data-step="2" data-intro="بعد از ویرایش بخش های مورد نظر با استفاده از این دکمه می توانید اطلاعات ویرایش شده را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ویرایش موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ویرایش" type="submit">
                                </div>
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
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("nameStyle").value;
        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام دسته بندی را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", "<?= $data['attrId']; ?>");
                formData.append("name", name);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editCostCategory",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            window.location.href = '<?= ADMIN_PATH; ?>/costCategory';
                        }
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>
