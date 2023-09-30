<?php
$info = $data['reservationInfo']['0'];

$staffList = '';
foreach ($data['Staffs'] as $manInfo) {
    $staffList .= '<option value="' . $manInfo['staff_vids_id'] . '">' . $manInfo['name'] . '</option>';
}

$productList = '';
foreach ($data['products'] as $product) {
    $productList .= '<option value="' . $product['product_vids_id'].'###'.$product['storeroom_id'] . '">' . $product['name'] . '</option>';
}

$payment_amount =0;
foreach ($data['paymentLog'] as $item) {
    $payment_amount += $item['price'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>مشاهده جزئیات نوبت <?= $data['attrId']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <style>
        @keyframes fa-blink {
            0% {
                opacity: 1;
            }
            25% {
                opacity: 0.25;
            }
            50% {
                opacity: 0.5;
            }
            75% {
                opacity: 0.75;
            }
            100% {
                opacity: 0;
            }
        }

        .fa-blink {
            -webkit-animation: fa-blink 1.75s linear infinite;
            -moz-animation: fa-blink 1.75s linear infinite;
            -ms-animation: fa-blink 1.75s linear infinite;
            -o-animation: fa-blink 1.75s linear infinite;
            animation: fa-blink 1.75s linear infinite;
        }
    </style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <?php require('app/views/admin/include/header.php'); ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar direction">
        <?php require('app/views/admin/include/sidebar.php'); ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>مشاهده جزئیات نوبت <?= $data['attrId']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/reservations/list"><i class="fa fa-hand-scissors-o"></i> Reservations</a></li>
                <li><a style="cursor: auto">نوبت <?= $data['attrId']; ?></a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row" dir="rtl">

                <div class="col-md-4">
                    <div style="padding: 0" class="col-md-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-blue">
                                <img class="profile-user-img img-responsive img-circle" style="position: absolute;width: 50px;margin-top: -5px;"  onerror="this.src='public/images/user-default-image.jpg'"  src="<?= $info['c_image']; ?>" alt="<?= $info['c_display_name']; ?>">
                                <h3 style="margin-right: 0;" class="widget-user-username">
                                    <a style="font-size: 18px;margin-right: 60px;color: white;" href="<?= ADMIN_PATH; ?>/users/view/<?= $info['customer_vids_id']; ?>">
                                        <?= $info['c_display_name']; ?>
                                    </a>
                                </h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <?php if ($info['c_mobile_num'] != NULL) { ?>
                                        <li>
                                            <a>شماره موبایل <span class="pull-left" dir="ltr"><?= $info['c_mobile_num']; ?></span></a>
                                        </li>
                                    <?php } ?>
                                    <?php if ($info['c_phone_num'] != NULL) { ?>
                                        <li>
                                            <a>شماره ثابت <span class="pull-left" dir="ltr"><?= $info['c_phone_num']; ?></span></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 0" class="col-md-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header">
                                <h3 style="margin-left: 0;font-size: 18px;margin-right: 0;"
                                    class="widget-user-username">
                                    سود مجموعه:
                                    <span style="float: left;margin-right: 5px;">تومان</span>
                                    <span id="sood" style="float: left;direction: ltr">0</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="box box-default box-solid">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                            <h3 class="box-title">اطلاعات نوبت</h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td width="40%">وضعیت نوبت:</td>
                                    <td>
                                        <span style="margin-right: 3px;margin-left: 3px;" class="badge"><?= $info['statusTitle'] ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>تاریخ ثبت درخواست:</td>
                                    <td><span><?= $info['sre_time_create']; ?> - <?= $info['sre_date_create']; ?></span></td>
                                </tr>
                                <tr>
                                    <td>شماره پیگیری:</td>
                                    <td>
                                        <span id="myInput"><?= $info['order_service_vids_id']; ?></span>
                                        <div title="کپی کردن شماره پیگیری" onclick="copyToClipboard('#myInput')"
                                             style="float: left;cursor: pointer;" data-clipboard-text="<?= $info['order_service_vids_id']; ?>" class="icon copy">
                                            <i style="color: #424242!important;display: inline-block;vertical-align: middle;" class="fa fa-fw fa-copy"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>نوع رزرو:</td>
                                    <td>
                                        <span style="margin-right: 3px;margin-left: 3px;<?= $info['sre_vip'] == "1" ? "background: #ffd700;":""; ?>" class="badge"><?= $info['sre_vip'] == "1" ? "ویژه":"عادی"; ?></span>
                                    </td>
                                </tr>
                                <?php if ($info['pay_title'] != NULL) { ?>
                                    <tr>
                                        <td>نحوه پرداخت:</td>
                                        <td>
                                            <?= $info['pay_title'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>وضعیت پرداخت:</td>
                                    <td>
                                        <?= $info['sre_pay'] == 1 ? '<span style="margin-right: 3px;margin-left: 3px;background-color: darkgreen;" class="badge">پرداخت شده</span>' : '<span style="margin-right: 3px;margin-left: 3px;background-color: darkred;" class="badge">پرداخت نشده</span>'; ?>
                                        <?= ($info['sre_pay'] == 1 AND $info['sre_price_prepayment']!=0 AND $info['sre_price_payment']==$info['sre_price_prepayment']) ? '<span style="margin-right: 3px;margin-left: 3px;background-color: #65b38f;" class="badge">بیعانه دریافت شده است</span>' : ''; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>نوع ثبت:</td>
                                    <td>
                                        <?= $info['reason_create'] == NULL ? 'از طریق سایت' : 'از طریق پنل مدیریت ('.$info['a_name'].')'; ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                            <h3 class="box-title">جزئیات خدمات درخواستی</h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-group" id="accordion">
                                <div class="box-body direction">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td style="vertical-align: middle;text-align: center">ردیف</td>
                                                <td style="vertical-align: middle;text-align: center">عنوان خدمت</td>
                                                <td style="vertical-align: middle;text-align: center">شعبه</td>
                                                <td style="vertical-align: middle;text-align: center">پرسنل</td>
                                                <td style="vertical-align: middle;text-align: center">زمان نوبت رزرو شده</td>
                                                <td style="vertical-align: middle;text-align: center">هزینه خدمت</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align: middle;text-align: center"><span>1</span></td>
                                                    <td style="vertical-align: middle;text-align: center"><span><?= $info['s_title']; ?></span></td>
                                                    <td style="vertical-align: middle;text-align: center"><span><?= $info['b_name'] ?></span></td>
                                                    <td style="vertical-align: middle;text-align: center"><?= $info['name']; ?></td>
                                                    <td style="vertical-align: middle;text-align: center"><?=  $info['sre_day']." ".$info['sre_date']." ساعت ".$info['sre_time']; ?></td>
                                                    <td style="vertical-align: middle;text-align: center"><?= number_format($info['sre_price_total']). " تومان"; ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" style="vertical-align: middle;text-align: left">مبلغ پرداخت شده:</td>
                                                    <td colspan="1" style="vertical-align: middle;text-align: center">
                                                        <?= number_format($payment_amount). " تومان"; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="vertical-align: middle;text-align: left">تخفیف:</td>
                                                    <td colspan="1" style="vertical-align: middle;text-align: center">
                                                        <?= number_format($info['sre_off_code_price']). " تومان"; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="vertical-align: middle;text-align: left">مبلغ باقیمانده:</td>
                                                    <td colspan="1" style="vertical-align: middle;text-align: center">
                                                        <?= number_format($info['sre_price_total']-$payment_amount-$info['sre_off_code_price']). " تومان"; ?>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a class="btn btn-box-tool btn-xs btn-warning" style="padding: 5px;color: #fff" href="<?= ADMIN_PATH; ?>/reservations/edit/<?= $data['attrId']; ?>" target="_blank">
                                ویرایش جزئیات رزرو
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                            <h3 class="box-title">توضیحات و وضعیت درخواست</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class='col-md-5'>
                                <div class='col-md-12' style="padding-right: 0;padding-left: 0">
                                    <div class="form-group" style="text-align:right">
                                        <label style="width: 100%" align="right" for="descAccounting">توضیحات:</label>
                                        <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="6" id="descAccounting" name="descAccounting"><?= $info['sre_accounting_description'] ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class='col-md-7'>
                                <div class='col-md-12' style="padding: 0;">
                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="done_date">تاریخ انجام خدمت:</label>
                                            <input style="border-radius: 0 3px 3px 0;text-align:left" type="text"
                                                   value="<?= $info['sre_done_date'] ?>"
                                                   class="form-control DatePickerPersian" id="done_date"
                                                   name="done_date">
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="statusOrder">وضعیت نوبت:</label>
                                            <select id="statusOrder" name="statusOrder" class="form-control" style="border-radius: 0 3px 3px 0;width: 100%;direction: rtl" required>
                                                <option value="0" disabled="" selected="" hidden="">-</option>
                                                <?php foreach ($data['status'] as $statusInfo) { ?>
                                                    <?php if($statusInfo['show_in_status'] == 1) { ?>
                                                        <option value="<?= $statusInfo['id']; ?>" <?= $statusInfo['id'] == $info['sre_status'] ? "selected" : ""; ?>>
                                                            <?= $statusInfo['title']; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="sms_status_order">پیامک مورد نظر:</label>
                                            <div class="input-group">
                                                <select id="sms_status_order" name="sms_status_order" class="form-control" style="border-radius: 0 3px 3px 0;width: 100%;direction: rtl" required>
                                                    <option value="-" disabled="" selected="" hidden="">-</option>
                                                    <?php foreach ($data['status'] as $statusInfo) { ?>
                                                        <?php if($statusInfo['show_in_sms'] == 1) { ?>
                                                            <option value="<?= $statusInfo['id']; ?>">
                                                                <?= $statusInfo['title']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <span style="border-radius: 3px 0 0 3px;padding: 0px;" class="input-group-addon">
                                                <button style="line-height: 1.2;height: 32px;border-radius: 3px 0 0 3px;" class="btn btn-xs btn-primary" id="sendSMS">ارسال پیامک</button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-success" id="confirm">ویرایش اطلاعات</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                            <h3 class="box-title">پرسنل</h3>

                            <div class="box-tools pull-right">
                                <?php if(sizeof($data['StaffsList'])>0){ ?>
                                    <span class="btn btn-box-tool btn-xs btn-success" style="padding: 5px;color: #fff">
                                        <?= sizeof($data['StaffsList']) ?> نفر
                                    </span>
                                <?php } ?>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="staffList">
                                <p>برای افزودن شخص جدید، افزودن شخص را بزنید.</p>
                                <?php
                                if (sizeof($data['StaffsList']) > 0) {
                                    $i = 1;
                                    $profit = 0;
                                    $bank_fees = 0;
                                    foreach ($data['StaffsList'] as $item) {
                                        if ($i % 2) {
                                            $color = "#f0f0f0";
                                        } else {
                                            $color = "#fafafa";
                                        }
                                        ?>
                                        <div class="col-md-12" style="padding: 15px 0;background: <?= $color; ?>">
                                            <div class="col-md-6" style="padding-right: 0;padding-left: 0;">
                                                <div class="col-md-1" style="padding: 5% 0;text-align: center;">
                                                    <a style="cursor: pointer" class="remove_field">
                                                        <img style="width: 20px;" src="public/images/Delete.png">
                                                    </a>
                                                </div>
                                                <div class="col-md-7" style="padding-left: 5px;padding-right: 5px;">
                                                    <label style="direction: rtl;width: 100%" align="right" for="staffId_<?= $i; ?>">شخص:</label>
                                                    <div class="input-group">
                                                        <span id="settlement_label_<?= $i; ?>" style="border-radius: 0px 3px 3px 0px;<?= $item['os_settlement_sold'] == 1 ? "background-color: rgb(191, 240, 161);" : ""; ?>" class="input-group-addon">
                                                             <input id="settlement_item_<?= $i; ?>" name="settlement_item[]" <?= $item['os_settlement_sold'] == 1 ? "checked" : ""; ?> onchange="statecheck(this.id,'settlement_label_<?= $i; ?>')" type="checkbox">
                                                        </span>
                                                        <select id="staffId_<?= $i; ?>" name="repairmanId[]" class="form-control" style="border-radius: 3px 0 0 3px;width: 100%;direction: rtl">
                                                            <?php foreach ($data['Staffs'] as $manInfo) { ?>
                                                                <option value="<?= $manInfo['staff_vids_id']; ?>" <?= $manInfo['staff_vids_id'] == $item['staff_id'] ? "selected" : ""; ?>>
                                                                    <?= $manInfo['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="staff_prepare_date_<?= $i; ?>">تاریخ انجام:</label>
                                                        <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control DatePickerPersian" value="<?= $item['os_prepare_date']; ?>" id="staff_prepare_date_<?= $i; ?>" name="staff_prepare_date[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0;padding-left: 0;">
                                                <div class="col-md-6" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="staff_profit_<?= $i; ?>">دستمزد:</label>
                                                        <div class="input-group AddCommaToPrice"
                                                             id="staff_profit_costID_<?= $i; ?>">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" value="<?= number_format($item['os_profit']); ?>" id="staff_profit_<?= $i; ?>" name="staff_piece_cost[]" required="">
                                                            <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="staff_bank_fees_<?= $i; ?>">کارمزد بانک:</label>
                                                        <div class="input-group AddCommaToPrice" id="staff_bank_feesID_<?= $i; ?>">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" value="<?= number_format($item['os_bank_fees']); ?>" id="staff_bank_fees_<?= $i; ?>" name="staff_bank_fees[]">
                                                            <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $profit += $item['os_profit'];
                                        $bank_fees += $item['os_bank_fees'];
                                        $i++;
                                    }
                                    $all_money = $profit + $bank_fees;
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-success" id="repairmanBtn">ویرایش اطلاعات</button>
                            <button class="btn btn-primary" id="add_field_button">افزودن شخص جدید</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                            <h3 class="box-title">لوازم و کالاهای مصرفی</h3>

                            <div class="box-tools pull-right">
                                <?php if(sizeof($data['productsList'])>0){ ?>
                                    <span class="btn btn-box-tool btn-xs btn-success" style="padding: 5px;color: #fff">
                                        <?= sizeof($data['productsList']) ?> کالا
                                    </span>
                                <?php } ?>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="productsList">
                                <p>برای افزودن کالای جدید، افزودن کالا را بزنید.</p>
                                <?php
                                if (sizeof($data['productsList']) > 0) {
                                    $i = 1;
                                    $all_product = array();
                                    foreach ($data['productsList'] as $item) {
                                        $all_product[] = $item['srp_id'];
                                        if ($i % 2) {
                                            $color = "#f0f0f0";
                                        } else {
                                            $color = "#fafafa";
                                        }
                                        ?>
                                        <div class="col-md-12" style="padding: 15px 0;background: <?= $color; ?>">
                                            <div class="col-md-5" style="padding-right: 0;padding-left: 0;">
                                                <input type="hidden" value="<?= $item['srp_id']; ?>" id="pro_id_<?= $i; ?>" name="product_id[]">

                                                <div class="col-md-1" style="padding: 5% 0;text-align: center;">
                                                    <a style="cursor: pointer" class="remove_field">
                                                        <img style="width: 20px;" src="public/images/Delete.png">
                                                    </a>
                                                </div>

                                                <div class="col-md-7" style="padding-left: 5px;padding-right: 5px;">
                                                    <label style="direction: rtl;width: 100%" align="right" for="product_<?= $i; ?>">کالا:</label>
                                                    <div class="input-group" style="width: 100%;">
                                                        <select id="product_<?= $i; ?>" name="product[]" class="form-control select2Class" style="border-radius: 3px 0 0 3px;width: 100%;direction: rtl">
                                                            <?php foreach ($data['products'] as $product) { ?>
                                                                <option value="<?= $product['product_vids_id']; ?>###<?= $item['storeroom_id']; ?>" <?= $product['product_vids_id']."###".$item['storeroom_id'] == $item['product_id']."###".$item['storeroom_id'] ? "selected" : ""; ?>>
                                                                    <?= $product['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="date_<?= $i; ?>">تاریخ استفاده:</label>
                                                        <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control DatePickerPersian" value="<?= $item['srp_date']; ?>" id="date_<?= $i; ?>" name="date[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7" style="padding-right: 0;padding-left: 0;">
                                                <div class="col-md-3" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="count_<?= $i; ?>">تعداد:</label>
                                                        <div class="input-group">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" value="<?= $item['srp_count']; ?>" id="count_<?= $i; ?>" name="count[]" required="">
                                                            <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">عدد</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="price_<?= $i; ?>">قیمت:</label>
                                                        <div class="input-group AddCommaToPrice" id="priceID_<?= $i; ?>">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" value="<?= number_format($item['srp_price']); ?>" id="price_<?= $i; ?>" name="price[]">
                                                            <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="padding-left: 5px;padding-right: 5px;">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="rpeice_desc_1">توضیحات:</label>
                                                        <div class="input-group" style="width:100%">
                                                            <input style="border-radius: 0 3px 3px 0;text-align:right" type="text" value="<?= $item['srp_desc'] ?>" class="form-control" id="desc_<?= $i; ?>" name="desc[]" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" value='<?= json_encode($all_product); ?>' id="all_product_id" name="all_product_id">
                            <button class="btn btn-success" id="productBtn">ویرایش اطلاعات</button>
                            <button class="btn btn-primary" id="add_product_field_button">افزودن کالای جدید</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                            <h3 class="box-title">مالی</h3>

                            <div class="box-tools pull-right">
                                <?php if(sizeof($data['paymentLog'])>0){ ?>
                                    <span class="btn btn-box-tool btn-xs btn-success" style="padding: 5px;color: #fff">
                                        <?= sizeof($data['paymentLog']) ?> تراکنش
                                    </span>
                                <?php } ?>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if (sizeof($data['paymentLog']) > 0) { ?>
                                <div class="box-group" id="accordion">
                                    <?php
                                    $i = 1;
                                    foreach ($data['paymentLog'] as $item) {
                                        ?>
                                        <div class="panel<?= $item['status'] == 1 ? " box box-success" : " box box-danger"; ?>">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                       href="<?= $_SERVER['REQUEST_URI']; ?>#collapse_<?= $i; ?>" style="color: #000">
                                                        <?php if( $item['afterpay']!="بیعانه"){ ?>
                                                            شماره پیگیری <?= $item['afterpay']; ?> - <?= number_format($item['price']); ?> تومان
                                                        <?php } else {  ?>
                                                            پرداخت  <?= $item['afterpay']; ?> - <?= number_format($item['price']); ?> تومان
                                                        <?php } ?>
                                                    </a>
                                                </h4>
                                                <a target="_blank"  class="btn btn-warning btn-xs" style="float: left;" href="<?= ADMIN_PATH; ?>/payment/edit/<?= $item['payment_vids_id']; ?>?p=service" title="ویرایش تراکنش">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            </div>
                                            <div id="collapse_<?= $i; ?>"
                                                 class="panel-collapse collapse<?= sizeof($data['paymentLog']) == 1 && $i == 1 ? " in" : ""; ?>">
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td width="40%">مبلغ پرداختی:</td>
                                                            <td><?= number_format($item['price']); ?> تومان</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">شماره پیگیری درگاه بانک:</td>
                                                            <td>
                                                                <?php if($item['image']!=NULL){ ?>
                                                                    <?= $item['afterpay']; ?> <a style="cursor: pointer" onclick='window.open("public/images/bank-receipt/<?= $item['image']; ?>", "Popup","titlebar=no, toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=auto, height=auto")' ><i class="fa fa-image"></i></a>
                                                                <?php } else { ?>
                                                                    <?= $item['afterpay']; ?>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        if ($info['sre_off_code'] != "-") {
                                                            ?>
                                                            <tr>
                                                                <td width="40%">کد تخفیف استفاده شده:</td>
                                                                <td><?= $info['sre_off_code']!="" ? $info['sre_off_code']:"-"; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="40%">مبلغ تخفیف:</td>
                                                                <td><?= $info['sre_off_code_price']!="" ? number_format($info['sre_off_code_price'])." تومان":"0 تومان"; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td width="40%">پرداخت به:</td>
                                                            <td>
                                                                <?php
                                                                if ($item['type'] == "cash") {
                                                                    $bank = "صندوق (نقدی)"." - ".$item['c_name'];
                                                                } elseif ($item['type'] == "bank") {
                                                                    $bank = "حساب بانکی"." - ".$item['b_name'];
                                                                } else {
                                                                    $bank = "-";
                                                                }
                                                                ?>
                                                                <?= $bank; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">تاریخ و زمان پرداخت:</td>
                                                            <td>
                                                                <?= date("H:m:s", $item['time_payment']) . ' - ' . $item['date_payment']; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                            <?php } else { ?>
                                <p>در حال حاضر تراکنشی ثبت نشده است.</p>
                            <?php } ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a class="btn btn-box-tool btn-xs btn-primary" style="padding: 5px;color: #fff" href="<?= ADMIN_PATH; ?>/payment/add/<?= $info['order_service_vids_id']; ?>?p=service" target="_blank">
                                افزودن تراکنش جدید
                            </a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    <div class="box box-default box-solid collapsed-box">
                        <div class="box-header with-border" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                            <h3 class="box-title">پیامک های ارسال شده</h3>

                            <div class="box-tools pull-right">
                                <?php if(sizeof($data['bookingLatestActivity'])>0){ ?>
                                    <span class="btn btn-box-tool btn-xs btn-success" style="padding: 5px;color: #fff">
                                        <?= sizeof($data['bookingLatestActivity']) ?> پیامک
                                    </span>
                                <?php } ?>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <?php
                            if (sizeof($data['bookingLatestActivity']) > 0) {
                                ?>
                                <div class="box-body direction">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px;">ردیف</th>
                                                <th>ارسال کننده</th>
                                                <th>متن پیامک</th>
                                                <th>زمان ارسال</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $i = 1;
                                            foreach ($data['bookingLatestActivity'] as $activity_data) {
                                                $date = explode(" ", $activity_data['log_time']);
                                                $newData = $date['1'] . " - " . Model::miladi_to_jalali($date['0'], "-");
                                                ?>
                                                <tr>
                                                    <td style="vertical-align: middle;width: 5%">
                                                        <p><?= $i; ?></p>
                                                    </td>
                                                    <td style="vertical-align: middle;width: 15%">
                                                        <p><?= $activity_data['name']!="" ? $activity_data['name']:"ارسال خودکار"; ?></p>
                                                    </td>
                                                    <td style="vertical-align: middle">
                                                        <p title="<?= $activity_data['activity']; ?>"><?= nl2br($activity_data['activity']); ?></p>
                                                    </td>
                                                    <td style="vertical-align: middle;width: 15%">
                                                        <?= $newData; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <?php

                            } else {
                                ?>
                                <div class="text-center"
                                     style="padding-bottom: 10px !important;padding-top: 10px !important;direction: rtl">
                                    در حال حاضر پیامکی ارسال نشده است!
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>
            <!-- /.row -->
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

<script>
    var max_fields = 10; //maximum input boxes allowed
    var color;
    var x = <?= sizeof($data['StaffsList']); ?>, x_count = <?= sizeof($data['StaffsList']); ?>;
    var p = <?= sizeof($data['productsList']); ?>, p_count = <?= sizeof($data['productsList']); ?>;
    $("#add_field_button").click(function (e) {
        e.preventDefault();
        if (x_count < max_fields) {
            x++;
            x_count++;
            if (x_count % 2) {
                color = "#f0f0f0";
            } else {
                color = "#fafafa";
            }
            $("#staffList").append('<div class="col-md-12" style="padding: 15px 0;background: ' + color + '"><div class="col-md-6" style="padding-right: 0;padding-left: 0;"><div class="col-md-1" style="padding: 5% 0;text-align: center;"><a style="cursor: pointer" class="remove_field"><img style="width: 20px;" src="public/images/Delete.png"></a></div><div class="col-md-7" style="padding-left: 5px;padding-right: 5px;"><label style="direction: rtl;width: 100%" align="right" for="staffId_' + x + '">شخص:</label><div class="input-group"><span id="settlement_label_' + x + '" style="border-radius: 0px 3px 3px 0px; background-color: rgb(255, 255, 255);" class="input-group-addon"><input id="settlement_item_' + x + '" name="settlement_item[]" onchange="statecheck(this.id,\'settlement_label_' + x + '\')" type="checkbox"></span><select id="staffId_' + x + '" name="repairmanId[]" class="form-control" style="border-radius: 3px 0 0 3px;width: 100%;direction: rtl"><option value="0" disabled="" selected="" hidden="">-</option><?= $staffList; ?></select></div></div><div class="col-md-4" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="staff_prepare_date_' + x + '">تاریخ انجام:</label><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control DatePickerPersian" id="staff_prepare_date_' + x + '" name="staff_prepare_date[]"></div></div></div><div class="col-md-6" style="padding-right: 0;padding-left: 0;"><div class="col-md-6" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="staff_profit_' + x + '">دستمزد:</label><div class="input-group AddCommaToPrice" id="staff_profit_costID_' + x + '"><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" id="staff_profit_' + x + '" name="staff_piece_cost[]" required=""><span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span></div></div></div><div class="col-md-6" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="staff_bank_fees_' + x + '">کارمزد بانک:</label><div class="input-group AddCommaToPrice" id="staff_bank_feesID_' + x + '"><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" id="staff_bank_fees_' + x + '" name="staff_bank_fees[]"><span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span></div></div></div></div></div>');
            DP_Persian();
            AddCommaToPrice_function();
        } else {
            $.wnoty({type: 'warning', message: 'حداکثر ' + max_fields + ' مورد می توانید اضافه نمایید.'});
        }
    });

    $("#staffList").on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        x_count--;
    });

    $("#add_product_field_button").click(function (e) {
        e.preventDefault();
        if (p_count < max_fields) {
            p++;
            p_count++;
            if (p_count % 2) {
                color = "#f0f0f0";
            } else {
                color = "#fafafa";
            }
            $("#productsList").append('<div class="col-md-12" style="padding: 15px 0;background: ' + color + '"><div class="col-md-5" style="padding-right: 0;padding-left: 0;"><input type="hidden" value="0" id="pro_id_'+ p +'" name="product_id[]"><div class="col-md-1" style="padding: 5% 0;text-align: center;"><a style="cursor: pointer" class="remove_field"><img style="width: 20px;" src="public/images/Delete.png"></a></div><div class="col-md-7" style="padding-left: 5px;padding-right: 5px;"><label style="direction: rtl;width: 100%" align="right" for="product_' + p + '">کالا:</label><div class="input-group" style="width: 100%;"><select id="product_' + p + '" name="product[]" class="form-control select2Class" style="border-radius: 3px 0 0 3px;width: 100%;direction: rtl"><option value="0" disabled="" selected="" hidden="">-</option><?= $productList; ?></select></div></div> <div class="col-md-4" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="date_' + p + '">تاریخ استفاده:</label><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control DatePickerPersian" id="date_' + p + '" name="date[]"></div></div></div><div class="col-md-7" style="padding-right: 0;padding-left: 0;"><div class="col-md-3" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="count_' + p + '">تعداد:</label><div class="input-group"><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" id="count_' + p + '" name="count[]" required=""><span style="border-radius: 3px 0 0 3px;" class="input-group-addon">عدد</span></div></div></div><div class="col-md-3" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="price_' + p + '">قیمت:</label><div class="input-group AddCommaToPrice" id="priceID_' + p + '"><input style="border-radius: 0 3px 3px 0;text-align:left" type="text" class="form-control" id="price_' + p + '" name="price[]"><span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span></div></div></div><div class="col-md-6" style="padding-left: 5px;padding-right: 5px;"><div class="form-group" style="text-align:right"><label for="rpeice_desc_1">توضیحات:</label><div class="input-group" style="width:100%"><input style="border-radius: 0 3px 3px 0;text-align:right" type="text" class="form-control" id="desc_' + p + '" name="desc[]" required=""></div></div></div></div> </div>');
            DP_Persian();
            AddCommaToPrice_function();
            $(".select2Class").select2();
        } else {
            $.wnoty({type: 'warning', message: 'حداکثر ' + max_fields + ' مورد می توانید اضافه نمایید.'});
        }
    });

    $("#productsList").on("click", ".remove_field", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove();
        p_count--;
    });

    function statecheck(layer, label) {
        var myLayer = document.getElementById(label);
        var input = myLayer.getElementsByTagName('input')[0];

        if (input.checked == true) {
            myLayer.style.backgroundColor = "#bff0a1";
        } else {
            myLayer.style.backgroundColor = "#fff";
        }
    }
</script>

<script type="text/javascript">
    $("#sood").html("<?= number_format($info['sre_price_total'] - $all_money); ?>");

    DP_Persian();
</script>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $.wnoty({type: 'success', message: 'شماره پیگیری باموفقیت کپی شد.'});
    }
</script>

<script>
    AddCommaToPrice_function();

    function AddCommaToPrice_function() {
        var $form = $(".AddCommaToPrice");
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
                return (input === 0) ? "" : input.toLocaleString("en-US");
            });
        });

        $form.on("submit", function (event) {
            var $this = $(this);
            var arr = $this.serializeArray();
            for (var i = 0; i < arr.length; i++) {
                arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
            }
            event.preventDefault();
        });
    }
</script>

<script>
    $("#confirm").on("click", function () {
        $("#confirm").html('در حال ثبت...');
        $("#confirm").attr("disabled", "disabled");

        var descAccounting = $('#descAccounting').val();
        var statusOrder = document.getElementById("statusOrder").value;
        var done_date = toEnglishNumber(document.getElementById("done_date").value);
        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", "<?= $data['attrId']; ?>");
            formData.append("descAccounting", descAccounting);
            formData.append("statusOrder", statusOrder);
            formData.append("done_date", done_date);

            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editReservationDetails",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    $("#confirm").html('ویرایش اطلاعات');
                    $("#confirm").removeAttr("disabled");

                    if (data.status == "ok") {
                        location.reload();
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });

    $("#sendSMS").on("click", function () {
        var sms_status_order = document.getElementById("sms_status_order").value;

        if(sms_status_order == "-"){
            $.wnoty({type: 'error', message: 'ابتدا یکی از وضعیت ها را انتخاب کنید.'});
        } else {
            $("#sendSMS").html('در حال ارسال...');
            $("#sendSMS").attr("disabled", "disabled");

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", "<?= $info['order_service_vids_id']?>");
                formData.append("status", sms_status_order);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/sendReservationsSMS",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
                    }
                });
                $("#sendSMS").html('ارسال پیامک');
                $("#sendSMS").removeAttr("disabled");
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ارسال پیامک وجود ندارد.'});
            }
        }
    });

    $("#repairmanBtn").on('click', function () {
        $("#repairmanBtn").html('در حال ثبت...');
        $("#repairmanBtn").attr("disabled", "disabled");
        var staffs = [];

        var elements = document.querySelectorAll('[id^=staffId_]');
        for (var i = 0; i < elements.length; i++) {
            if ((elements[i].value != 0) && (elements[i].value != "")) {
                staffs.push({
                    "staffId": elements[i].value,
                    "settlement_sold": $("#settlement_item_" + elements[i].id.replace("staffId_", "")).is(":checked"),
                    "prepare_date": toEnglishNumber(document.getElementById("staff_prepare_date_" + elements[i].id.replace("staffId_", "")).value),
                    "profit": removeCommas(document.getElementById("staff_profit_" + elements[i].id.replace("staffId_", "")).value),
                    "bank_fees": removeCommas(document.getElementById("staff_bank_fees_" + elements[i].id.replace("staffId_", "")).value),
                });
            }
        }

        if (navigator.onLine) {
            var formData = new FormData();
            formData.append("id", "<?= $data['attrId']; ?>");
            formData.append("staffs", JSON.stringify(staffs));
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/editStaffsList",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});

                    $("#repairmanBtn").html('ویرایش اطلاعات');
                    $("#repairmanBtn").removeAttr("disabled");
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });

    $("#productBtn").on('click', function () {
            $("#productBtn").html('در حال ثبت...');
            $("#productBtn").attr("disabled", "disabled");
            var products = [];

            var elements = document.querySelectorAll('[id^=product_]');
            for (var i = 0; i < elements.length; i++) {
                if ((elements[i].value != 0) && (elements[i].value != "")) {
                    let productInfo = elements[i].value.split('###');
                    products.push({
                        "productId": productInfo[0],
                        "storeroom": productInfo[1],
                        "srpId": document.getElementById("pro_id_" + elements[i].id.replace("product_", "")).value,
                        "date": toEnglishNumber(document.getElementById("date_" + elements[i].id.replace("product_", "")).value),
                        "count": document.getElementById("count_" + elements[i].id.replace("product_", "")).value,
                        "price": removeCommas(document.getElementById("price_" + elements[i].id.replace("product_", "")).value),
                        "desc": removeCommas(document.getElementById("desc_" + elements[i].id.replace("product_", "")).value),
                    });
                }
            }

            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", <?= $data['attrId']; ?>);
                formData.append("all_product_id", document.getElementById("all_product_id").value);
                formData.append("products", JSON.stringify(products));
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editProductsList",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        $("#productBtn").html('ویرایش اطلاعات');
                        $("#productBtn").removeAttr("disabled");

                        if (data.status == "ok") {
                            document.getElementById("all_product_id").value = data.data;
                        }
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        }
    );
</script>

</body>
</html>
