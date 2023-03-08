<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مدیریت پوسته ها | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>مدیریت پوسته ها</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/theme"><i class="fa fa-television"></i> Appearance</a></li>
                <li class="active">Theme</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <ul class="mailbox-attachments clearfix">
                                    <li class="col-md-4">
                                        <span class="mailbox-attachment-icon has-img"><img src="public/images/theme-1.jpg" alt="Attachment"></span>

                                        <div class="mailbox-attachment-info">
                                            <a href="#" class="mailbox-attachment-name">قالب پیش فرض <i class="fa fa-camera"></i></a>
                                            <span class="mailbox-attachment-size mt-3">
                                                <button type="button" class="btn btn-block btn-success">فعال</button>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!--/.col (left) -->
                    </div>
                </div>
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

</body>
</html>
