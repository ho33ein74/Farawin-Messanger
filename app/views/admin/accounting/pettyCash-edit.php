<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش اطلاعات تنخواه گردان <?= $data['pettyCashInfo']['0']['p_name']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ویرایش اطلاعات تنخواه گردان <?= $data['pettyCashInfo']['0']['p_name']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/pettyCash/add"><i class="fa fa-briefcase"></i> Petty Cash</a></li>
                <li class="active">Edit Petty Cash</li>
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
                            <h3 class="box-title">ویرایش اطلاعات تنخواه گردان <?= $data['pettyCashInfo']['0']['p_name']; ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای ویرایش اطلاعات تنخواه به راحتی می توانید بخش مورد نظر خود را ویرایش کنید."  class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-9'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="name">:نام تنخواه گردان</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $data['pettyCashInfo']['0']['p_name']; ?>"
                                                   class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>

                                    <div class='col-md-3'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="curreny">: واحد پول</label>
                                            <select id="curreny" name="curreny" class="form-control select2Class"
                                                    style="border-radius: 3px;width: 100%;direction: rtl"
                                                    required>
                                                <?php
                                                foreach ($data['currency'] as $currency) {
                                                    ?>
                                                    <option <?= $currency['c_id']==$data['pettyCashInfo']['0']['p_currency'] ?"selected='selected'":""; ?> value="<?= $currency['c_id']; ?>">
                                                        <?= $currency['c_name']; ?> - <?= $currency['c_short_name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%" align="right" for="desc">:توضیحات</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="8" id="desc" name="desc"><?= $data['pettyCashInfo']['0']['p_desc']; ?></textarea>
                                        </div>
                                    </div>
                                </div>



                                <div data-step="2" data-intro="بعد از ویرایش بخش های مورد نظر با استفاده از این دکمه می توانید اطلاعات ویرایش شده را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ویرایش موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" name="btnsubmit" class="btn btn-dropbox" value="ویرایش"
                                           type="submit">
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
        var curreny = document.getElementById("curreny").value;
        var desc = document.getElementById("desc").value;

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام تنخواه گردان را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", <?= $data['attrId'] ?>);
                formData.append("name", name);
                formData.append("curreny", curreny);
                formData.append("desc", desc);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editpettyCash",
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
