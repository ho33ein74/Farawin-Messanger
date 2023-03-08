<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>افزودن صندوق جدید | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>افزودن صندوق جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/cash/add"><i class="fa fa-money"></i> Cash</a></li>
                <li class="active">Add New Cash</li>
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
                            <h3 class="box-title">افزودن صندوق جدید</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای افزودن صندوق جدید می بایست اطلاعات خواسته شده را تکمیل نمایید." class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="name">:نام صندوق</label>
                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                   class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>

                                    <div class='col-md-3'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="current_balance">:موجودی فعلی صندوق</label>
                                            <div class="input-group" id="current_balanceID">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text"
                                                       class="form-control" id="current_balance" name="current_balance"
                                                       required="">
                                                <span style="border-radius: 3px 0 0 3px;"
                                                      class="input-group-addon">تومان</span>
                                            </div>
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
                                                    <option <?= $currency['c_default']==1 ?"selected='selected'":""; ?> value="<?= $currency['c_id']; ?>">
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
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="8" id="desc" name="desc"></textarea>
                                        </div>
                                    </div>
                                </div>



                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" name="btnsubmit" class="btn btn-dropbox" value="ثبت"
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
    (function ($, undefined) {
        $(function () {
            var $form = $("#current_balanceID");
            var $input = $form.find("input");
            $input.on("keyup", function (event) {
                var selection = window.getSelection().toString();
                if (selection !== '') {
                    return;
                }
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                    return;
                }
                var $this = $(this);
                var input = $this.val();
                var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt(input, 10) : 0;
                $this.val(function () {
                    return input.toLocaleString("en-US");
                });
            });
            $form.on("submit", function (event) {
                var $this = $(this);
                var arr = $this.serializeArray();
                for (var i = 0; i < arr.length; i++) {
                    arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
                }
                ;
                event.preventDefault();
            });
        });
    })(jQuery);
</script>

<script>
   $(document).ready(function() {
        $("#current_balance").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("name").value;
        var curreny = document.getElementById("curreny").value;
        var current_balance = document.getElementById("current_balance").value;
        var desc = document.getElementById("desc").value;

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام صندوق را وارد کنید.'});
        } else if (curreny == "") {
            $.wnoty({type: 'warning', message: 'واحد پول را انتخاب کنید.'});
        } else {
            var formData = new FormData();
            formData.append("name", name);
            formData.append("curreny", curreny);
            formData.append("current_balance", removeCommas(current_balance));
            formData.append("desc", desc);
            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addCash",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            window.location.href = '<?= ADMIN_PATH; ?>/cash';
                        }
                    }
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>
