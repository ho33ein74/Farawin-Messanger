<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ثبت دریافتی جدید | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ثبت دریافتی جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/payment"><i class="fa fa-money"></i> Payment</a></li>
                <li class="active"> Add new payment</li>
            </ol>
        </section>

        <?php if($data['publicData']['request']['banks']){  ?>
            <div class="col-lg-12 col-xs-12">
                <div style="direction: rtl" class="alert alert-danger callout callout-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    برای استفاده از این بخش ابتدا از بانکداری قسمت افزودن بانک جدید، حداقل یک حساب بانکی اضافه نمایید.
                </div>
            </div>
        <?php } ?>

        <?php if($data['publicData']['request']['cash']){  ?>
            <div class="col-lg-12 col-xs-12">
                <div style="direction: rtl" class="alert alert-danger callout callout-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    برای استفاده از این بخش ابتدا از بانکداری قسمت افزودن صندوق جدید، حداقل یک صندوق اضافه نمایید.
                </div>
            </div>
        <?php } ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ثبت دریافتی جدید</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای افزودن هزینه جدید می بایست اطلاعات خواسته شده را تکمیل نمایید.<br/><br/>توجه داشته باشید چنانچه حساب بانکی و صندوق اضافه نکرده اید ابتدا به بخش ثبت حساب بانکی و یا ثبت صندوق رفته و آن قسمت را تکمیل نمایید."  class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12' style="padding-right: 0;padding-left: 0">

                                        <div class='col-md-3'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="partType">: بخش مربوطه</label>
                                                <select  id="partType" name="partType" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl" required <?= (isset($_GET['p']) and htmlspecialchars($_GET['p']) !== null) ? "disabled='disabled'":""; ?>>
                                                    <option disabled="" selected="" hidden=""></option>
                                                    <option <?= htmlspecialchars($_GET['p'])=="service" ? "selected='selected'":""; ?> value="1">خدمات</option>
                                                    <option value="3">سایر</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='col-md-3'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="order_number">:شماره سفارش</label>
                                                <input style="border-radius: 3px;text-align: left;" type="text" value="<?php $uri = $_SERVER["REQUEST_URI"]; $uriArray = explode('/', $uri);  echo str_replace("?p=service", "", $uriArray[4]); ?>"
                                                       class="form-control" id="order_number" name="order_number"
                                                       required>
                                            </div>
                                        </div>

                                        <div class='col-md-3'>
                                            <div class="form-group" style="text-align:right">
                                                <label style="width: 100%;" for="order_price">:مبلغ پرداخت شده</label>
                                                <div class="input-group" id="order_priceID">
                                                    <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr"
                                                           type="text"
                                                           class="form-control" id="order_price" name="order_price"
                                                           required="">
                                                    <span style="border-radius: 3px 0 0 3px;"
                                                          class="input-group-addon">تومان</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-md-3'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="order_afterpay">:شماره پیگیری</label>
                                                <input style="border-radius: 3px;text-align:left;direction: ltr" type="text"
                                                       class="form-control" id="order_afterpay" name="order_afterpay"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12' style="padding-right: 0;padding-left: 0">
                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="order_type">: نحوه پرداخت</label>
                                                <select id="order_type" name="order_type" class="form-control select2Class"
                                                        style="border-radius: 3px;width: 100%;"
                                                        required>
                                                    <option data-id="cash" value="cash">صندوق (نقدی)</option>
                                                    <option data-id="bank" value="bank">حساب بانکی</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="order_typePay">: مقصد</label>
                                                <select id="order_typePay" name="order_typePay"
                                                        class="form-control select2Class"
                                                        style="border-radius: 3px;width: 100%;"
                                                        required>
                                                    <?php foreach ($data['cashInfo'] as $type) { ?>
                                                        <option  value="<?= $type['cash_vids_id']; ?>">
                                                            <?= $type['c_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="order_date">:تاریخ پرداخت</label>
                                                <input style="border-radius: 3px;text-align:left" type="text"
                                                       class="form-control DatePickerPersian" id="order_date" name="order_date" required>
                                            </div>
                                        </div>

                                        <div class='col-md-6'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="coverNews" style="direction: rtl;">
                                                    <a style="color: #3d3d3d" title="در صورت نیاز می توانید یک تصویر از فیش واریز، فاکتور و... را نیز به این پرداخت اضافه نمایید.">
                                                        <i style="margin-left: 5px" class="fa fa-question-circle"></i>
                                                    </a>انتخاب فیش واریز، فاکتور و...:</label>
                                                <br/>
                                                <div class='col-md-12'>
                                                    <input style="float: right;" type='file' id="coverNews" accept=".jpg, .jpeg, .png"/>
                                                </div>
                                                <div class='col-md-12' style="margin-bottom: 20px">
                                                    <div class="gallery"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ثبت" type="submit">
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
    function getPaymentType(th) {
        jQuery.ajax({
            url: "<?= ADMIN_PATH; ?>/getPaymentType?id=" + $(th).find(':selected').attr('data-id'),
            type: 'GET',
            dataType: "json",
            headers: {"Content-type": "application/json"},
            success: function (json) {
                $('#order_typePay').html('');
                $.each(json, function (key, value) {
                    $('#order_typePay').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
        });
    }

    $(document).on('change', '#order_type', function (e) {
        getPaymentType(this);
    });
</script>

<script type="text/javascript">
    DP_Persian();
</script>

<script>
    function previewImages() {
        var $preview = $('.gallery').empty();
        if (this.files) $.each(this.files, readAndPreview);
        function readAndPreview(i, file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                $.wnoty({type: 'error', message: 'فایل انتخاب شده عکس نمی باشد.'});
            }
            var reader = new FileReader();
            $(reader).on("load", function () {
                $preview.append($("<img/>", {src: this.result, width: 150, height: 150}));
            });
            reader.readAsDataURL(file);
        }
    }
    $('#coverNews').on("change", previewImages);
</script>

<script>
    (function ($, undefined) {
        $(function () {
            var $form = $("#order_priceID");
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
        $("#order_price,#order_number").inputFilter(function(value) {
            return /^[0-9,]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var order_number = document.getElementById("order_number").value;
        var partType = document.getElementById("partType").value;
        var order_price = document.getElementById("order_price").value;
        var order_afterpay = document.getElementById("order_afterpay").value;
        var order_type = document.getElementById("order_type").value;
        var order_typePay = document.getElementById("order_typePay").value;
        var order_date = toEnglishNumber(document.getElementById("order_date").value);
        var coverNews = document.getElementById("coverNews");
        var cover = coverNews.files[0];

        if (partType == "") {
            $.wnoty({type: 'warning', message: 'بخش مربوطه را انتخاب کنید.'});
        } else if (order_number == "") {
            $.wnoty({type: 'warning', message: 'شماره سفارش را وارد کنید.'});
        } else if (order_price == "") {
            $.wnoty({type: 'warning', message: 'مبلغ پرداخت شده را وارد کنید.'});
        } else if (order_afterpay == "") {
            $.wnoty({type: 'warning', message: 'شماره پیگیری را وارد کنید.'});
        } else if (order_date == "") {
            $.wnoty({type: 'warning', message: 'تاریخ پرداخت را وارد کنید.'});
        }
        else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("order_number", order_number);
                formData.append("partType", partType);
                formData.append("order_price", removeCommas(order_price));
                formData.append("order_afterpay", order_afterpay);
                formData.append("order_type", order_type);
                formData.append("order_typePay", order_typePay);
                formData.append("order_date", order_date.replace(" ", ""));
                formData.append("image", cover);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addPayment",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            window.location.href = '<?= ADMIN_PATH; ?>/payment';
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
