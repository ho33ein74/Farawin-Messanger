<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش هزینه | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>ویرایش هزینه</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/cost"><i class="fa fa-money"></i> Cost</a></li>
                <li class="active"> Add new cost</li>
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
                            <h3 class="box-title">ویرایش هزینه</h3>
                        </div>
                        <!-- /.box-header -->
                        <div data-step="1" data-intro="برای ویرایش هزینه مورد نظر به راحتی می توانید بخش مورد نظر خود را ویرایش کنید."  class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-12' style="padding-right: 0;padding-left: 0">

                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="partType">: بخش مربوطه</label>
                                                <select id="partType" name="partType" class="form-control select2Class"
                                                        style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                    <option disabled="" selected="" hidden=""></option>
                                                    <option <?= $data['CostLog']['0']['part_type']==1 ? "selected='selected'":""; ?> value="1">خدمات</option>
                                                    <option <?= $data['CostLog']['0']['part_type']==3 ? "selected='selected'":""; ?> value="3">سایر</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label for="costType">: نوع هزینه</label>
                                                <select id="costType" name="costType" class="form-control select2Class"
                                                        style="border-radius: 3px;width: 100%;direction: rtl"
                                                        required>
                                                    <option disabled="" selected="" hidden=""></option>
                                                    <?php
                                                    foreach ($data['costType'] as $type) {
                                                        ?>
                                                        <option <?= $data['CostLog']['0']['cost_type']==$type['cost_category_vids_id'] ? "selected='selected'":""; ?> value="<?= $type['cost_category_vids_id']; ?>">
                                                            <?= $type['title']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <div class="form-group" style="text-align:right">
                                                <label style="width: 100%;" for="order_price">:مبلغ پرداخت شده</label>
                                                <div class="input-group" id="order_priceID">
                                                    <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr"
                                                           type="text"
                                                           value="<?= number_format($data['CostLog']['0']['price']); ?>"
                                                           class="form-control" id="order_price" name="order_price"
                                                           required="">
                                                    <span style="border-radius: 3px 0 0 3px;"
                                                          class="input-group-addon">تومان</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='col-md-5'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="order_date">:تاریخ پرداخت</label>
                                                <input style="border-radius: 3px;text-align:left" type="text"
                                                       value="<?= $data['CostLog']['0']['date']; ?>"
                                                       class="form-control DatePickerPersian" id="order_date" name="order_date" required>
                                            </div>
                                        </div>

                                        <div class='col-md-7'>
                                            <div class="form-group" style="text-align:right">
                                                <label align="right" for="desc">:توضیحات</label>
                                                <input style="border-radius: 3px;text-align:right" type="text"
                                                       value="<?= $data['CostLog']['0']['description']; ?>"
                                                       class="form-control" id="desc" name="desc"
                                                       required>
                                            </div>
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

<script type="text/javascript">
    DP_Persian();
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
        $("#order_price").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var costType = document.getElementById("costType").value;
        var partType = document.getElementById("partType").value;
        var order_price = document.getElementById("order_price").value;
        var desc = document.getElementById("desc").value;
        var order_date = toEnglishNumber(document.getElementById("order_date").value);

        if (partType == "") {
            $.wnoty({type: 'warning', message: 'بخش مربوطه را انتخاب کنید.'});
        } else if (costType == "0") {
            $.wnoty({type: 'warning', message: 'نوع هزینه را انتخاب کنید.'});
        } else if (order_price == "") {
            $.wnoty({type: 'warning', message: 'مبلغ پرداخت شده را وارد کنید.'});
        } else if (order_date == "") {
            $.wnoty({type: 'warning', message: 'تاریخ پرداخت را وارد کنید.'});
        }
        else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", "<?= $data['attrId']; ?>");
                formData.append("costType", costType);
                formData.append("partType", partType);
                formData.append("order_price", removeCommas(order_price));
                formData.append("desc", desc);
                formData.append("order_date", order_date.replace(" ", ""));
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editCost",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
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
