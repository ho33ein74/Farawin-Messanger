<?php
$license_info = Model::un_serialize_license_info();
?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>داشبورد | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small> پنل مدیریت</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <?= $data['license_error_msg']; ?>

            <?php if($data['dashboardItems'] == ""){ ?>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 text-center">
                        ویجت های انتخابی در اینجا نمایان می شوند
                    </div>
                </div>
            <?php } else { ?>
                <?= $data['dashboardItems']; ?>
            <?php } ?>
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
<script src="public/js/jquery.codehim.clock.js"></script>

<script>
    const time = document.getElementById('time');
    if (time !== null) {
        const myVar = setInterval(myTimer, 1000);
        function myTimer() {
            const d = new Date();
            const options = {hour12: false};
            time.innerHTML = d.toLocaleTimeString('en-US', options);
        }
        $(document).ready(function () {
            $(".clock-place").CodehimClock();
        });
    }

    const time2 = document.getElementById('time2');
    if (time2 !== null) {
        const myVar2 = setInterval(myTimer2, 1000);

        function myTimer2() {
            const d = new Date();
            const options = {hour12: false};
            time2.innerHTML = d.toLocaleTimeString('en-US', options);
        }

        $(document).ready(function () {
            $(".clock-place2").CodehimClock();
        });
    }
</script>

<script>
    $(document).on("click", "[id*=btn-send-telegram-]", function () {
        document.getElementById("telegram-val").value = $(this).data('id');
    });
    $(document).on("click", "#send-telegram-submit", function () {
        $('#telegram-Modal').modal('hide');
        var id = document.getElementById('telegram-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/sendBlog",
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
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ارسال وجود ندارد.'});
        }
    });
</script>

<script>
    $(document).on("click", "[id*=btn-status-blog-]", function () {
        document.getElementById("status-val").value = $(this).data('id');
    });

    $(document).on("click", "#status-submit", function () {
        $('#status-Modal').modal('hide');
        var id = document.getElementById('status-val').value;
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", id);
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/statusBlog",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    if (data.status==="active") {
                        $("#btn-status-blog-" + id).removeClass("btn btn-danger btn-xs").addClass("btn btn-success btn-xs");
                        document.getElementById("btn-status-blog-" + id).innerHTML = 'فعال';
                    } else if (data.status==="deactive") {
                        $("#btn-status-blog-" + id).removeClass("btn btn-success btn-xs").addClass("btn btn-danger btn-xs");
                        document.getElementById("btn-status-blog-" + id).innerHTML = 'غیرفعال';
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

</body>
</html>
