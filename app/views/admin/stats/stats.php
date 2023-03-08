<?php
$orderStat = $data['orderStat'];
$keys = array_keys($orderStat);
$values = array_values($orderStat);
$values = implode(',', $values);

$orderStatOrder = $data['orderStatOrder'];
$keys_order = array_keys($orderStatOrder);
$values_order = array_values($orderStatOrder);
$values_order = implode(',', $values_order);

$orderStatPayment = $data['orderStatPaymnet'];
$keys_payment = array_keys($orderStatPayment);
$values_payment = array_values($orderStatPayment);
$values_payment = implode(',', $values_payment);
?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>گزارش های مالی کسب وکار شما | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>

    <style>
        .small-box h3 {
            font-size: 25px;
        }
    </style>
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
                <small> گزارش های مالی کسب وکار شما</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/stats"><i class="fa fa-bar-chart"></i> Stats</a></li>
            </ol>
        </section>

        <section class="content" style="min-height: unset">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div data-step="1" data-intro="به صورت پیش فرض اطلاعات ماه جاری به شما نمایش داده می شود.<br/>در صورت تمایل به مشاهده آمار در بازه دلخواه می توانید تاریخ شروع و تاریخ پایان مدنظر خود را انتخاب کرده و دکمه اعمال فیلتر را بزنید.<br/>برای حذف فیلتر از دکمه قرمز رنگ می توانید استفاده نمایید." class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">فیلتر اطلاعات</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class='row'>
                                <div class='col-md-12' style="padding-right: 0;padding-left: 0">
                                    <div class='col-md-5'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="from_date">:تاریخ شروع</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" autocomplete="off"
                                                   value="<?= htmlspecialchars($_GET['from'])!="" ? str_replace("-", "/", htmlspecialchars($_GET['from'])):""; ?>"
                                                   class="form-control range-from-example" id="from_date" name="from_date" required>
                                        </div>
                                    </div>
                                    <div class='col-md-5'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="to_date">:تاریخ پایان</label>
                                            <input style="border-radius: 3px;text-align:left" type="text" autocomplete="off"
                                                   value="<?= htmlspecialchars($_GET['to'])!="" ? str_replace("-", "/", htmlspecialchars($_GET['to'])):""; ?>"
                                                   class="form-control range-to-example" id="to_date" name="to_date" required>
                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="btnDateSubmit">:عملیات</label>
                                            <div class='row'>
                                                <div class='col-md-9 col-xs-10'>
                                                    <input id="btnDateSubmit" class="btn btn-dropbox form-control" value="اعمال فیلتر" type="submit">
                                                </div>
                                                <div class='col-md-3 col-xs-2'>
                                                    <a title="حذف فیلتر" class="btn btn-danger btn-m" href="<?= ADMIN_PATH; ?>/stats"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">اطلاعات کلی<?= ($_GET['from']!=NULL && $_GET['to']!=NULL) ? " از تاریخ ".str_replace("-","/",$_GET['from'])." تا تاریخ ".str_replace("-","/",$_GET['to']):" در ". jdate("F")." ماه ".jdate("Y"); ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class='row'>
                                <div class='col-md-12' style="padding-right: 0;padding-left: 0">
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-yellow">
                                            <div class="inner">
                                                <h3><?= $data['bannerTop']['userCount']['0']['Count'] ?></h3>
                                                <p>مشتریان ثبت شده</p>
                                            </div>
                                            <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
                                                <i class="em em-man-boy-boy" aria-role="presentation" aria-label=""></i>
                                            </div>
                                            <a href="<?= ADMIN_PATH; ?>/users" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                                                اطلاعات بیشتر </a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3><?= $data['bannerTop']['orderSaleThisMonthCount']['0']['Count'] ?></h3>
                                                <p>فروش های ثبت شده</p>
                                            </div>
                                            <div class="icon" style="top: 21px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
                                                <i class="em em-shopping_trolley" aria-role="presentation" aria-label="PAGE FACING UP"></i>
                                            </div>
                                            <a href="<?= ADMIN_PATH; ?>/sales" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                                                اطلاعات بیشتر </a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-red">
                                            <div class="inner">
                                                <h3><?= $data['bannerTop']['orderThisMonthCount']['0']['Count'] ?></h3>
                                                <p>نوبت های ثبت شده</p>
                                            </div>
                                            <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
                                                <i class="em em-wrench" aria-role="presentation" aria-label="WRENCH"></i>
                                            </div>
                                            <a href="<?= ADMIN_PATH; ?>/orders" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                                                اطلاعات بیشتر </a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-teal">
                                            <div class="inner">
                                                <h3><?= number_format(($data['getStatsData']['allPrice']['0']['price']) * 10); ?></h3>

                                                <p>مجموع کل درآمد (ریال)</p>
                                            </div>
                                            <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                                                <i class="em em-moneybag" aria-role="presentation" aria-label="MONEY BAG"></i>
                                            </div>
                                            <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                                                اطلاعات بیشتر </a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-teal">
                                            <div class="inner">
                                                <h3><?= number_format((($data['getStatsData']['allPriceMobile']['0']['price'] - ($data['getStatsData']['profitMobile']['0']['price'] + $data['getStatsData']['allPricePeykMobile']['0']['price'] + $data['getStatsData']['off_code_priceMobile']['0']['price'] + $data['getStatsData']['piece_costMobile']['0']['price'] + $data['getStatsData']['allPriceMobileProgrammer']['0']['price'] + $data['getStatsData']['MobileBank_fees']['0']['price'])) + ($data['getStatsData']['allPriceComputer']['0']['price'] - ($data['getStatsData']['profitComputer']['0']['price'] + $data['getStatsData']['allPricePeykComputer']['0']['price'] + $data['getStatsData']['off_code_priceComputer']['0']['price'] + $data['getStatsData']['piece_costComputer']['0']['price'] + $data['getStatsData']['ComputerBank_fees']['0']['price'] + $data['getStatsData']['allPriceComputerProgrammer']['0']['price'])) + ($data['getStatsData']['allPriceAccessories']['0']['price'] - ($data['getStatsData']['profitAccessories']['0']['price'] + $data['getStatsData']['allPricePeykAccessories']['0']['price'] + $data['getStatsData']['off_code_priceAccessories']['0']['price'] + $data['getStatsData']['piece_costAccessories']['0']['price'] + $data['getStatsData']['AccessoriesBank_fees']['0']['price'] + $data['getStatsData']['allPriceAccessoriesProgrammer']['0']['price']))) * 10); ?></h3>

                                                <p>مجموع کل سود (ریال)</p>
                                            </div>
                                            <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                                                <i class="em em-moneybag" aria-role="presentation" aria-label="MONEY BAG"></i>
                                            </div>
                                            <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                                                اطلاعات بیشتر </a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                </div>
            </div>

            <div class="row box" style="background: #fff;margin: 0 0 20px 0;padding-top: 20px;">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <h3><?= number_format($data['getStatsData']['allPricePeyk']['0']['price'] * 10); ?></h3>

                            <p>هزینه پیک (ریال)</p>
                        </div>
                        <div class="icon" style="top: 10px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                            <i class="em em-motor_scooter" aria-role="presentation" aria-label="MOTOR SCOOTER"></i>
                        </div>
                        <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                            اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-light-blue">
                        <div class="inner">
                            <h3><?= number_format($data['getStatsData']['piece_cost']['0']['price'] * 10); ?></h3>

                            <p>هزینه خرید قطعه (ریال)</p>
                        </div>
                        <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                            <i class="em em-floppy_disk" aria-role="presentation" aria-label="FLOPPY DISK"></i>
                        </div>
                        <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                            اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-teal" style="background-color: #a3671c !important;">
                        <div class="inner">
                            <h3><?= number_format($data['getStatsData']['allBank_fees']['0']['price'] * 10); ?></h3>

                            <p>هزینه کارمزد بانک (ریال)</p>
                        </div>
                        <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                            <i class="em em-bank" aria-role="presentation" aria-label="BANK"></i>
                        </div>
                        <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                            اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-lime">
                        <div class="inner">
                            <h3><?= number_format($data['getStatsData']['profit']['0']['price'] * 10); ?></h3>

                            <p>دستمزد تعمیرکار (ریال)</p>
                        </div>
                        <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size:40px;">
                            <i class="em em-male-mechanic" aria-role="presentation" aria-label=""></i>
                        </div>
                        <a style="cursor: pointer" class="small-box-footer"><i class="fa fa-arrow-circle-left"></i>
                            اطلاعات بیشتر </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">آمار نوبت های ثبت شده<?= ($_GET['from']!=NULL && $_GET['to']!=NULL) ? " از تاریخ ".str_replace("-","/",$_GET['from'])." تا تاریخ ".str_replace("-","/",$_GET['to']):" در ". jdate("F")." ماه ".jdate("Y"); ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart">
                                        <div id="mainOrder" style="height:350px;"></div>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">آمار تراکنش های ثبت شده<?= ($_GET['from']!=NULL && $_GET['to']!=NULL) ? " از تاریخ ".str_replace("-","/",$_GET['from'])." تا تاریخ ".str_replace("-","/",$_GET['to']):" در ". jdate("F")." ماه ".jdate("Y"); ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="chart">
                                        <div id="mainPayment" style="height:350px;"></div>
                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->

            <!-- DONUT CHART -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">نحوه آشنایی با مجموعه</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChart" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">وضعیت نوبت های ثبت شده <?= ($_GET['from']!=NULL && $_GET['to']!=NULL) ? " از تاریخ ".str_replace("-","/",$_GET['from'])." تا تاریخ ".str_replace("-","/",$_GET['to']):" در ". jdate("F")." ماه ".jdate("Y"); ?></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="pieChartOrder" style="height:250px"></canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            <!-- /.box -->

            <div class="row">
                <div class="col-md-12">
                    <div class="box" style="direction: rtl;">
                        <div class="box-header with-border">
                            <h3 class="box-title">امتیاز کاربران به خدمات<?= ($_GET['from']!=NULL && $_GET['to']!=NULL) ? " از تاریخ ".str_replace("-","/",$_GET['from'])." تا تاریخ ".str_replace("-","/",$_GET['to']):" در ". jdate("F")." ماه ".jdate("Y"); ?>:</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>سوال</th>
                                    <th style="width: 40px">امتیاز</th>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>نحوه پذیرش سفارش را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q1']=="" ? "0":$data['getStatsData']['point']['0']['pr_q1']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>سرعت پاسخگویی تیم خدمات و پشتیبانی را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q2']=="" ? "0":$data['getStatsData']['point']['0']['pr_q2']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>اطلاع رسانی وضعیت تعمیر دستگاه ارسال شده را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q3']=="" ? "0":$data['getStatsData']['point']['0']['pr_q3']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>کیفیت تعمیر دستگاه را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q4']=="" ? "0":$data['getStatsData']['point']['0']['pr_q4']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>قیمت تعمیر دستگاه را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q5']=="" ? "0":$data['getStatsData']['point']['0']['pr_q5']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>مدت زمان انجام تعمیر دستگاه را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q6']=="" ? "0":$data['getStatsData']['point']['0']['pr_q6']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>شرایط تحویل و دریافت دستگاه را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q7']=="" ? "0":$data['getStatsData']['point']['0']['pr_q7']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>نحوه برخورد اعضای تیم را چگونه ارزیابی می‌کنید؟</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-light-blue"><?= $data['getStatsData']['point']['0']['pr_q8']=="" ? "0":$data['getStatsData']['point']['0']['pr_q8']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">تعداد کاربران رای دهنده</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-yellow"><?= sizeof($data['getStatsData']['point']['1']); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">تعداد رای های ثبت شده</td>
                                    <td><span style="float: left;font-size: 11pt;"
                                              class="badge bg-green"><?= $data['getStatsData']['point']['2']['0']['countUser']; ?></span>
                                    </td>
                                </tr>
                                </tbody>
                                <!-- /.box-footer -->
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="<?= ADMIN_PATH; ?>/pointRepair" class="btn btn-sm btn-default btn-flat pull-left">
                                مشاهده لیست رای دهندگان
                            </a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
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
<script src="public/panel/plugins/chartjs/Chart.min.js"></script>
<script src="public/panel/plugins/echarts/dist/echarts.min.js"></script>

<script type="text/javascript">
    DP_Persian_();

    function DP_Persian_() {
        var to, from;
        from = $(".range-from-example").persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            "responsive": true,
            "position": "auto",
            "initialValue": false,
            initialValueType: 'persian',
            calendar: {
                persian: {
                    locale: 'fa'
                }
            },
            viewMode: 'day',
            checkYear: function (year) {
                return year >= 1400;
            },
            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });

        to = $(".range-to-example").persianDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            "responsive": true,
            "position": "auto",
            "initialValue": false,
            initialValueType: 'persian',
            calendar: {
                persian: {
                    locale: 'fa'
                }
            },
            viewMode: 'day',
            checkYear: function (year) {
                return year >= 1400;
            },
            toolbox: {
                calendarSwitch: {
                    enabled: false
                }
            },
            onSelect: function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate != unix) {
                    var cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            }
        });
    }
</script>

<script type="text/javascript">
    window.onload = LineChartOrder();
    window.onload = LineChartPayment();

    function LineChartOrder() {

        var theme = {
            textStyle: {
                fontFamily: 'iranyekanwebmediumfanum, sans-serif'
            }
        };
        var myChart = echarts.init(document.getElementById('mainOrder'), theme);

        myChart.setOption({
            title: {
                x: 'center',
                y: 'top',
                padding: [10, 0, 20, 0],
                text: '<?= ($_GET["from"]!=NULL && $_GET["to"]!=NULL) ? "نوبت های ثبت شده از تاریخ ".str_replace("-","/",$_GET["from"])." تا تاریخ ".str_replace("-","/",$_GET["to"]):"نوبت های ثبت شده در ". jdate("F")." ماه ".jdate("Y"); ?>',
                textStyle: {
                    fontSize: 14,
                    fontWeight: 'normal'
                }
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                y: 'top',
                feature: {
                    magicType: {
                        show: true,
                        title: {
                            line: '',
                            bar: ''
                        },
                        type: ['line', 'bar']
                    },
                    saveAsImage: {
                        show: true,
                        title: ' '
                    }
                }
            },
            calculable: true,
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                data: ['تعداد سفارش'],
                y: 'bottom'
            },
            xAxis: [{
                type: 'category',
                data: [<?php foreach ($keys_order as $date) {
                    echo "'$date',";
                } ?>]
            }],
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: [
                {
                    name: 'تعداد سفارش',
                    type: 'bar',
                    data: [<?= $values_order ?>]
                }
            ]
        });
    }

    function LineChartPayment() {

        var theme = {
            textStyle: {
                fontFamily: 'iranyekanwebmediumfanum, sans-serif'
            }
        };
        var myChart = echarts.init(document.getElementById('mainPayment'), theme);

        myChart.setOption({
            title: {
                x: 'center',
                y: 'top',
                padding: [10, 0, 20, 0],
                text: '<?= ($_GET["from"]!=NULL && $_GET["to"]!=NULL) ? " تراکنش های ثبت شده از تاریخ ".str_replace("-","/",$_GET["from"])." تا تاریخ ".str_replace("-","/",$_GET["to"]):"تراکنش های ثبت شده در ". jdate("F")." ماه ".jdate("Y"); ?>',
                textStyle: {
                    fontSize: 14,
                    fontWeight: 'normal'
                }
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
                show: true,
                y: 'top',
                feature: {
                    magicType: {
                        show: true,
                        title: {
                            line: '',
                            bar: ''
                        },
                        type: ['line', 'bar']
                    },
                    saveAsImage: {
                        show: true,
                        title: ' '
                    }
                }
            },
            calculable: true,
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                data: ['تعداد تراکنش ها'],
                y: 'bottom'
            },
            xAxis: [{
                type: 'category',
                data: [<?php foreach ($keys_payment as $date) {
                    echo "'$date',";
                } ?>]
            }],
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            series: [
                {
                    name: 'تعداد تراکنش ها',
                    type: 'bar',
                    data: [<?= $values_payment ?>]
                }
            ]
        });
    }
</script>

<script type="text/javascript">
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
        {
            value: <?= $data['referral']['telegram']['0']['ref']; ?>,
            color: "#3db4f8",
            label: "تلگرام"
        },
        {
            value: <?= $data['referral']['instagram']['0']['ref']; ?>,
            color: "#fc8d21",
            label: "اینستاگرام"
        },
        {
            value: <?= $data['referral']['divar']['0']['ref']; ?>,
            color: "#fc2140",
            label: "تبلیغات مجازی"
        },
        {
            value: <?= $data['referral']['google']['0']['ref']; ?>,
            color: "#f921fc",
            label: "جستجو در اینترنت"
        },
        {
            value: <?= $data['referral']['direct']['0']['ref']; ?>,
            color: "#3021fc",
            label: "مستقیم"
        },
        {
            value: <?= $data['referral']['ref']['0']['ref']; ?>,
            color: "#35fc21",
            label: "دوستان و آشنایان"
        },
        {
            value: <?= $data['referral']['other']['0']['ref']; ?>,
            color: "#fcf421",
            label: "سایر"
        },
    ];
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
</script>

<script type="text/javascript">
    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    var pieChartCanvas = $("#pieChartOrder").get(0).getContext("2d");
    var pieChartOrder = new Chart(pieChartCanvas);
    var PieData = [
        <?php
            foreach($data['statusOrderPie'] as $key => $value){
        ?>
            {
                value: <?= $value['0']['status']; ?>,
                color: getRandomColor(),
                label:  "<?= $key; ?>"
            },
        <?php
        }
        ?>
    ];
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChartOrder.Doughnut(PieData, pieOptions);
</script>

<script>
    $(document).on("click", "#btnDateSubmit", function () {
        var from_date = toEnglishNumber(document.getElementById('from_date').value);
        var to_date = toEnglishNumber(document.getElementById('to_date').value);

        if(from_date==""){
            $.wnoty({type: 'warning', message: 'تاریخ شروع را وارد کنید.'});
        } else if(to_date==""){
            $.wnoty({type: 'warning', message: 'تاریخ پایان را وارد کنید.'});
        } else if(from_date.length < 10){
            $.wnoty({type: 'warning', message: 'تاریخ شروع معتبر نمی باشد.'});
        } else if(to_date.length < 10){
            $.wnoty({type: 'warning', message: 'تاریخ پایان معتبر نمی باشد.'});
        } else if(from_date > "<?= jdate("Y/m/d") ?>"){
            $.wnoty({type: 'warning', message: 'تاریخ شروع نمی تواند از تاریخ امروز بزرگتر باشد.'});
        }  else if(to_date > "<?= jdate("Y/m/d") ?>"){
            $.wnoty({type: 'warning', message: 'تاریخ پایان نمی تواند از تاریخ امروز بزرگتر باشد.'});
        } else {
            if(from_date.replace(/\//gi, "")<=to_date.replace(/\//gi, "")) {
                var from_date_change = from_date.replace(/\//gi, "-");
                var to_date_change = to_date.replace(/\//gi, "-");

                window.location.href = "<?= ADMIN_PATH; ?>/stats?from=" + from_date_change + "&to=" + to_date_change;
            } else {
                $.wnoty({type: 'warning', message: 'تاریخ شروع نمی تواند از تاریخ پایان بزرگتر باشد.'});
            }
        }

    });
</script>

</body>
</html>
