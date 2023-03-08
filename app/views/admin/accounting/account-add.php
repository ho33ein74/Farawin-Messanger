<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>افزودن بانک جدید | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>افزودن بانک جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL.ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL.ADMIN_PATH; ?>/accounts"><i class="fa fa-bank"></i>  Banks</a></li>
                <li class="active">Add New Bank</li>
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
                            <h3 class="box-title">افزودن بانک جدید</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای افزودن بانک می بایست اطلاعات خواسته شده را تکمیل نمایید.<br/>توجه داشته باشید صحت شماره کارت و شماره شبا بررسی می شود و در صورت اشتباه بودن امکان ثبت وجود ندارد." class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="name">:نام بانک</label>
                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                   class="form-control" id="name" name="name" required>
                                        </div>
                                    </div>

                                    <div class='col-md-3'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="branch">:شعبه</label>
                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                   class="form-control" id="branch" name="branch" required>
                                        </div>
                                    </div>

                                    <div class='col-md-2'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="default_bank">: بانک پیش فرض</label>
                                            <select id="default_bank" name="default_bank" class="form-control"
                                                    style="border-radius: 3px;width: 100%;direction: rtl"
                                                    required>
                                                <option value="1" selected="selected">بله</option>
                                                <option value="0">خیر</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-3'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="account_opening_date">:تاریخ افتتاح حساب</label>
                                            <input style="border-radius: 3px;text-align:left" type="text"
                                                   class="form-control DatePickerPersian" id="account_opening_date" name="account_opening_date" required>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="account_type">: نوع حساب</label>
                                            <select id="account_type" name="account_type" class="form-control select2Class"
                                                    style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                <option value="قرض الحسنه" >قرض الحسنه</option>
                                                <option value="جاری" >جاری</option>
                                                <option value="سپرده کوتاه مدت" >سپرده کوتاه مدت</option>
                                                <option value="سپرده بلند مدت" >سپرده بلند مدت</option>
                                                <option value="سایر" >سایر</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
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

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="current_balance">:موجودی فعلی بانک</label>
                                            <div class="input-group" id="current_balanceID">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr" type="text"
                                                       class="form-control" id="current_balance" name="current_balance"
                                                       required="">
                                                <span style="border-radius: 3px 0 0 3px;"
                                                      class="input-group-addon">ریال</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="account_number">:شماره حساب</label>
                                            <input style="border-radius: 3px;text-align:left;direction: ltr;" type="tel"
                                                   class="form-control" id="account_number" name="account_number" required>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="no_sheba">:شماره شبا</label>
                                            <div class="input-group">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" type="tel" maxlength="24" class="form-control" id="no_sheba" name="no_sheba">
                                                <span style="border-radius: 3px 0 0 3px;padding: 6px;" class="input-group-addon">IR</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="no_card">:شماره کارت</label>
                                            <div class="input-group">
                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" type="tel" maxlength="19" onkeyup="setBankLogo();"
                                                       class="form-control" id="no_card" name="no_card">
                                                <span style="border-radius: 3px 0 0 3px;padding: 6px;" id="no_card_img" class="input-group-addon">
                                                    <img id="bankLogo" style="width: 20px" src="public/images/onlinePayment3.png">
                                                <input type="hidden" id="logo_name" name="logo_name" value="<?= $data['bankInfo']['0']['b_logo']; ?>">
                                                </span>
                                            </div>
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
<script src="public/js/iban.js"></script>

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
        $("#current_balance,#account_number,#no_sheba,#no_card").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script type="text/javascript">
    DP_Persian();
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var name = document.getElementById("name").value;
        var branch = document.getElementById("branch").value;
        var logo_name = document.getElementById("logo_name").value;
        var current_balance = document.getElementById("current_balance").value;
        var account_opening_date = toEnglishNumber(document.getElementById("account_opening_date").value);
        var account_type = document.getElementById("account_type").value;
        var curreny = document.getElementById("curreny").value;
        var default_bank = document.getElementById("default_bank").value;
        var account_number = document.getElementById("account_number").value;
        var no_sheba = document.getElementById("no_sheba").value;
        var no_card = document.getElementById("no_card").value;
        var desc = document.getElementById("desc").value;

        if (name == "") {
            $.wnoty({type: 'warning', message: 'نام بانک را وارد کنید.'});
        } else if (branch == "") {
            $.wnoty({type: 'warning', message: 'شعبه بانک را وارد کنید.'});
        } else if (account_number == "") {
            $.wnoty({type: 'warning', message: 'شماره حساب را وارد کنید.'});
        } else if (no_sheba != "-" && !IBAN.isValid("IR" + no_sheba)) {
            $.wnoty({type: 'warning', message: 'شماره شبا صحیح نمی باشد.'});
        } else if (no_card!="-" && !checkCartDigit(no_card.replace(/-/g, ""))) {
            $.wnoty({type: 'warning', message: 'شماره کارت صحیح نمی باشد.'});
        } else {
            var formData = new FormData();
            formData.append("name", name);
            formData.append("branch", branch);
            formData.append("logo_name", logo_name);
            formData.append("current_balance", removeCommas(current_balance));
            formData.append("account_opening_date", account_opening_date);
            formData.append("account_type", account_type);
            formData.append("curreny", curreny);
            formData.append("default_bank", default_bank);
            formData.append("account_number", account_number);
            formData.append("no_sheba", no_sheba);
            formData.append("no_card", no_card);
            formData.append("desc", desc);

            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addAccount",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            window.location.href = '<?= ADMIN_PATH; ?>/accounts';
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
