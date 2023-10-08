<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش نوبت <?= $data['attrId'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/css/default/reservation.css"/>
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
                <small>ویرایش نوبت <?= $data['attrId'] ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/reservations/list"><i class="fa fa-hand-scissors-o"></i> Reservations</a></li>
                <li class="active"> Edit booked info</li>
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
                            <h3 class="box-title">ویرایش نوبت <?= $data['attrId'] ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class="col-lg-12">
                                        <div class="cu personal-pro ajaxform">

                                            <div class="row">
                                                <div data-step="1" data-intro="می توانید با استفاده از این بخش بر اساس شماره موبایل یا نام و نام خانوادگی مشتری، اطلاعات مشتری را پر کنید<br/> توجه کنید که نشانه‌ی 🟢 نشان دهنده مشتری خوش حساب و 🔴 نشان دهنده مشتری بد حساب می باشد" class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="Customer">
                                                            :جستجوی مشتری
                                                            <a style="color: #3d3d3d" title="در این بخش می توانید براساس نام و نام خانوادگی مشتری و یا شماره موبایل بین مشتریان خود جستجو کنید">
                                                                <i style="margin-left: 5px" class="fa fa-question-circle"></i>
                                                            </a>
                                                        </label>

                                                        <select id="Customer" name="Customer" class="form-control" style="width: 100%;direction: ltr;text-align: start;unicode-bidi: plaintext;">
                                                            <option id="customer-null" data-num="" data-fname="" data-lname="" data-mask="" value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['userGetLatest'] as $getUser) { ?>
                                                                <option <?= $getUser['customer_vids_id']==$data['reservationInfo'][0]['customer_vids_id'] ? "selected='selected'":""; ?>  value="<?= $getUser['customer_vids_id']; ?>" id="customer-<?= $getUser['customer_vids_id']; ?>" data-num="<?= $getUser['c_mobile_num']; ?>" data-fname="<?= $getUser['c_name']; ?>" data-lname="<?= $getUser['c_family']; ?>" data-mask="<?= $getUser['c_phone_num']; ?>"><?= $getUser['c_arithmetic']==1 ? "🟢":"🔴"; ?> <?= $getUser['c_display_name']; ?> - <?= $getUser['c_mobile_num']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="CustomerName" class="">:نام</label>
                                                            <input id="CustomerName" value="<?= $data['reservationInfo'][0]['c_name']; ?>" type="text" name="CustomerName" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="CustomerFamily" class="">:نام خانوادگی</label>
                                                            <input id="CustomerFamily" value="<?= $data['reservationInfo'][0]['c_family']; ?>" type="text" name="CustomerFamily" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="CustomerNumber" class="">:شماره موبایل</label>
                                                            <input id="CustomerNumber" value="<?= $data['reservationInfo'][0]['c_mobile_num']; ?>" type="text" name="CustomerNumber" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="CustomerPhone" class="">:شماره در دسترس (ثابت یا موبایل)</label>
                                                            <input id="CustomerPhone" value="<?= $data['reservationInfo'][0]['c_phone_num']; ?>" type="text" name="CustomerPhone" class="form-control" style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div data-intro="می توانید با استفاده از این بخش از بین خدمات فعال، خدمت مورد نظر را انتخاب نمایید" class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="service">:خدمت</label>

                                                        <select id="service" name="service" class="form-control select2Class" style="width: 100%;direction: ltr;text-align: start;unicode-bidi: plaintext;">
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['services'] as $service) { ?>
                                                                <option <?= $service['s_id']==$data['reservationInfo'][0]['service_id'] ? "selected='selected'":""; ?> value="<?= $service['s_id']; ?>"><?= $service['s_title']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="dateSelected" class="">:تاریخ رزرو</label>
                                                            <input id="dateSelected" value="<?= $data['reservationInfo'][0]['sre_date']; ?>" type="text" name="dateSelected" class="form-control" readonly style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="timeSelected" class="">:ساعت رزرو</label>
                                                            <input id="timeSelected" value="<?= $data['reservationInfo'][0]['sre_time']; ?>" type="text" name="timeSelected" class="form-control" readonly style="text-align: start;unicode-bidi: plaintext;border-radius: 3px;width: 100%;direction: rtl" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="branch">:شعبه</label>
                                                        <select id="branch" name="branch" class="form-control select2Class" style="width: 100%;direction: ltr;text-align: start;unicode-bidi: plaintext;">
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['getBranches'] as $branch) { ?>
                                                                <option <?= $branch['branch_vids_id']==$data['reservationInfo'][0]['branch_id'] ? "selected":""; ?> data-id="<?= $branch['branch_vids_id']; ?>" value="<?= $branch['branch_vids_id']; ?>"><?= $branch['b_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class='col-md-3'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="staff">:پرسنل</label>
                                                        <select id="staff" name="staff" class="form-control" style="border-radius: 3px;width: 100%;" required>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="priceService" class="">:هزینه خدمت</label>
                                                            <div class="input-group AddCommaToPrice">
                                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" value="<?= number_format($data['reservationInfo'][0]['sre_price_total']); ?>" readonly type="text" class="form-control" id="priceService" name="priceService" required="">
                                                                <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group" style="text-align:right">
                                                        <div class="input text">
                                                            <label for="depositService" class="">:بیعانه مورد نیاز</label>
                                                            <div class="input-group AddCommaToPrice">
                                                                <input style="border-radius: 0 3px 3px 0;text-align:left;direction: ltr;" value="<?= number_format($data['reservationInfo'][0]['sre_price_prepayment']); ?>" readonly type="text" class="form-control" id="depositService" name="depositService" required="">
                                                                <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">تومان</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="relative items-center overflow-hidden" dir="rtl">
                                                <div id="boxBookingContainer" class="box boxTakingTurnsOnline">
                                                    <div class="ContentCenter01 ContentCenterTakingTurnsOnline">
                                                        <div class="select-date" style="background-color: rgba(220, 207, 197, 1);">
                                                            <ul class="select-MonthYear">
                                                                <li>
                                                                    <a id="btnPrevMonthMatabSetTime" title="ماه قبل">></a>
                                                                </li>
                                                                <li>
                                                                    <span class="dark:text-white" id="lblMonthMatabSetTime"><?= jdate("F", '', '', '', 'en') ?></span>
                                                                    <span id="lblYearMatabSetTime"><?= jdate("Y", '', '', '', 'en') ?></span>
                                                                    <span id="lblYearMatabSetTimeCu" style="display: none; visibility: hidden"><?= jdate("m", '', '', '', 'en') ?></span>
                                                                </li>
                                                                <li>
                                                                    <a id="btnNextMonthMatabSetTime" title="ماه بعد"><</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="btn-options bg-white dark:bg-dark-930">
                                                            <input id="btnGetFirstVisit" class="k-button" type="button" value="اولین وقت خالی" onclick="getFirstVisit()">
                                                            <input style="width: 120px;"  id="btnToday" class="k-button" type="button" value="امروز" onclick="getTodayDate()">
                                                        </div>

                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="ContentFooter01 ContentFooterTakingTurnsOnline">
                                                        <div id="TimeSpans" class="show-less"></div>
                                                        <div id="LoaderTimes" class="loader">
                                                            <div class="loaders">
                                                                <div class="loader">
                                                                    <div class="ball-spin-fade-loader">
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                        <div></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-step="6" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                                <input id="btn-submit" class="btn btn-dropbox" value="ثبت" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
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
<input type="hidden" id="is_vip" value="<?= $data['reservationInfo'][0]['sre_vip'] ?>" />
<input type="hidden" id="hdfToday" value="<?= jdate("Y_m_d", '', '', '', 'en') ?>" />
<input type="hidden" id="hdfFirstVisit" value="<?= jdate("Y_m_d", '', '', '', 'en') ?>" />

<footer class="main-footer">
    <?php require('app/views/admin/include/footer.php'); ?>
</footer>
<?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="public/js/default/slick.min.js"></script>

<script type="text/x-kendo-template" id="weekColumnTemplate">
    <div class="week-col week_no_#:weekNumber#">
        <ul class="week-col-items">
        </ul>
    </div>
</script>
<script type="text/x-kendo-template" id="daysRowTemplate">
    <div class="day-col #:shortDate#">
        <div class="date-time-span">
            <span class="day-caption">#:dayCaption#</span>
        </div>
        <ul class="time-spans booking_row_#:shortDate#"></ul>
    </div>
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
    }
</script>

<script type="text/javascript">
    var holderID = 'TimeSpans';
    var globalGuid, gMonth, slider;
    var year = parseInt($("#lblYearMatabSetTime").html());
    var month = parseInt($("#lblYearMatabSetTimeCu").html());
    gMonth = month;
    var today = $("#hdfFirstVisit").val().split("_");

    InitSelectedMonthDays(month, year, today[2]);
    $(document).on('change', '#service', function (e) {
        $("#dateSelected").val("");
        $("#timeSelected").val("");
        $('#staff').html('');
        $("#is_vip").val("");
        $("#priceService").val("");
        $("#depositService").val("");
        InitSelectedMonthDays(month, year, today[2]);
    });
    $(document).on('change', '#staff', function (e) {
        var price= $(this).find(':selected').data("price");
        var deposit= $(this).find(':selected').data('deposit');
        $("#priceService").val(numberWithCommas(price));
        $("#depositService").val(numberWithCommas(deposit));
    });

    $("#btnNextMonthMatabSetTime").attr("data-month", month);
    $("#btnPrevMonthMatabSetTime").attr("data-month", month);
    $("#btnPrevMonthMatabSetTime").click(function () {
        var year = parseInt($("#lblYearMatabSetTime").html());
        gMonth = parseInt(gMonth) - 1;
        if (gMonth < 1) {
            gMonth = 12;
            InitSelectedMonthDays(12, year - 1);
            $(this).attr("data-month", 12);
            $("#btnNextMonthMatabSetTime").attr("data-month", 12);
            $("#lblYearMatabSetTime").html(year - 1);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(12));
        } else {
            InitSelectedMonthDays(gMonth, year);
            $(this).attr("data-month", gMonth);
            $("#btnNextMonthMatabSetTime").attr("data-month", gMonth);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(gMonth));
        }
    });
    $("#btnNextMonthMatabSetTime").click(function () {
        var year = parseInt($("#lblYearMatabSetTime").html());
        gMonth = parseInt(gMonth) + 1;
        if (gMonth > 12) {
            gMonth = 1;
            InitSelectedMonthDays(1, year + 1);
            $(this).attr("data-month", 1);
            $("#btnPrevMonthMatabSetTime").attr("data-month", 1);
            $("#lblYearMatabSetTime").html(year + 1);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(1));
        } else {
            InitSelectedMonthDays(gMonth, year);
            $(this).attr("data-month", gMonth);
            $("#btnPrevMonthMatabSetTime").attr("data-month", gMonth);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(gMonth));
        }
    });
    function getShamsiMonthNameMatabSetTime(month) {
        switch (month) {
            case 1:
                return "فروردین";
            case 2:
                return "اردیبهشت";
            case 3:
                return "خرداد";
            case 4:
                return "تیر";
            case 5:
                return "مرداد";
            case 6:
                return "شهریور";
            case 7:
                return "مهر";
            case 8:
                return "آبان";
            case 9:
                return "آذر";
            case 10:
                return "دی";
            case 11:
                return "بهمن";
            case 12:
                return "اسفند";
        }
        return "";
    }
    function loadDays(url, guid, y, m, whatToDoNext, isFirstVisit) {
        if (navigator.onLine) {
            $.ajax({
                url: '<?= ADMIN_PATH; ?>/initDaysBooking',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({
                    url,
                    guid,
                    y,
                    m,
                    isFirstVisit
                }),
                type: 'post',
                success: function (res) {
                    if (whatToDoNext) {
                        whatToDoNext(res);
                    }
                },
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان دریافت زمان ها وجود ندارد.'});
        }
    }
    function InitSelectedMonthDays(m, y, d) {
        gMonth = m;
        var guid = $("#service").val();
        var url = "<?= htmlspecialchars($_GET['url']) ?>";

        $("#" + holderID).addClass('blury');
        $("#LoaderTimes").show();

        loadDays(url, guid, y, m, function (res) {
            if (res.status != "error") {
                if (res && res.constructor == Array) {
                    $('#' + holderID).html("").removeClass("slick-initialized slick-slider");
                    InitVisitTimes(res, res);
                    InitSlider();
                    var today = $("#hdfToday").val().split("_");
                    if (d != 0 && d != undefined) {
                        var elClass = d == today[2] ? ".today-col" : ".first-visit";
                        var index = $('#' + holderID).find(elClass).data().slickIndex;
                        $('#' + holderID).slick('slickGoTo', index);
                    }
                }
            } else {
                $.wnoty({type: 'warning', message: res.msg});
            }
        });
    }
    function bindTemplate(template, obj) {
        var result = template;
        if (template && obj) {
            for (var prop in obj) {
                result = result.replace('#:' + prop + '#', obj[prop]).replace('#:' + prop + '#', obj[prop]).replace('#:' + prop + '#', obj[prop]);
            }
        }
        return result;
    }
    function bindDayTemplate(obj) {
        var result = '';
        if (obj) {
            if (obj.hasSetTimes && obj.setTimeItems && obj.setTimeItems.length > 0) {
                for (var i = 0; i < obj.setTimeItems.length; i++) {
                    if(obj.setTimeItems[i].isVip) {
                        result += '<li><a style="cursor: pointer" title="رزرو VIP" onclick="' + obj.setTimeItems[i].onclick + '" class="group items-center flex relative justify-center">' + obj.setTimeItems[i].caption + '<span class="absolute text-white bg-red-450 rounded w-8 h-4 flex items-center justify-center text-xs -top-1 -right-1" style="padding-top:.25rem;">VIP</span></a></li>';
                    } else {
                        result += '<li><a style="cursor: pointer" onclick="' + obj.setTimeItems[i].onclick + '">' + obj.setTimeItems[i].caption + '</a></li>';
                    }
                }
            } else {
                result += '<li class="no-visit"><i></i></li>';
            }
        }

        return result;
    }
    function binddayItemTemplate(data) {
        var result = '';

        if (data) {
            result += '<span>' + data.dayCaption + '</span>';
            result += '<div class="sec_time sec_time_' + data.shortDate + '">';
            if (data.hasMultiTimeSections) {
                result += '<ul class="times_items"></ul>';
            }
            result += '</div>';
        }

        return result;
    }
    function bindtimeTemplate(data) {
        var result = '';
        if (data && data.setTimeItems && data.setTimeItems.length > 0) {
            for (var i = 0; i < data.setTimeItems.length; i++) {
                result += '<span class="sec_time">'+ data.setTimeItems[i].caption +'</span>';
            }
        }
        return result;
    }
    function InitVisitTimesDen(view, data) {
        var weekColumnTemplate = $("#weekColumnTemplate").html();
        var numberOfWeeks = view.length / 7;
        var i;
        var col;

        for (i = 1; i <= numberOfWeeks; i++) {
            var startOfWeek = 7 * (i - 1);
            var endOfWeek = (7 * i) - 1;
            var j = 0;
            data[startOfWeek].weekNumber = i;
            var weekCol = bindTemplate(weekColumnTemplate, data[startOfWeek]);

            $("#" + holderID).append(weekCol);

            for (j = startOfWeek; j <= endOfWeek; j++) {
                var liClasses = "";
                if (data[j].isHoliday) liClasses += "holiday ";
                if (data[j].isFirstVisit) liClasses += "first-visit ";
                if (data[j].today) liClasses += "today-col ";
                if (data[j].isNotInMonth || !data[j].hasSetTimes) liClasses += "not-in-month ";
                if (data[j].setTimeItems != null && data[j].setTimeItems.length > 1) liClasses += "multi-time ";
                liClasses = "class='" + liClasses + "'";

                if (data[j].hasSetTimes) {
                    if (data[j].setTimeItems.length > 1) {
                        data[j].hasMultiTimeSections = true;

                        var dayItems = binddayItemTemplate(data[j]);
                        $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");

                        var k = 0;
                        for (k = 0; k < data[j].setTimeItems.length; k++) {

                            data[j].cnt = k;
                            var tt = bindtimeTemplate(data[j]);
                            $(".week_no_" + i).find(".sec_time_" + data[j].shortDate).children(".times_items").append("<li>" + tt + "</li>");
                        }
                    } else {
                        data[j].hasMultiTimeSections = false;

                        data[j].cnt = 0;
                        var tt = bindtimeTemplate(data[j]);


                        var dayItems = binddayItemTemplate(data[j]);
                        $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");

                        $(".week_no_" + i).find(".sec_time_" + data[j].shortDate).append(tt);
                    }
                } else {
                    data[j].hasMultiTimeSections = false;

                    data[j].cnt = 0;

                    var dayItems = binddayItemTemplate(data[j]);
                    $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");
                }
            }
        }
    }
    function InitVisitTimes(view, data) {
        var i;
        var col;

        for (i = 0; i < view.length; ++i) {
            col = data[i].shortDate;
            if ($("#" + holderID).find('.' + col).length === 0) {
                var dayCol = bindTemplate($("#daysRowTemplate").html(), data[i]);
                $("#" + holderID).append(dayCol);

                if (data[i].hasSetTimes) {
                    var daySetTimes = bindDayTemplate(data[i]);
                    $("#" + holderID).find(".booking_row_" + col).append(daySetTimes);
                }
                if (data[i].isFirstVisit) {
                    $("#" + holderID).find("." + col).addClass("first-visit");
                }
                if (data[i].today) {
                    $("#" + holderID).find("." + col).addClass("today-col");
                }
                if (data[i].isHoliday) {
                    $("#" + holderID).find("." + col).addClass("holiday");
                }
            }
        }

        var maxChild = 7;
        $.each($("ul.time-spans"), function (index, val) {
            var thisLength = $(this).children().length;
            if (maxChild > thisLength) {
                for (var j = 0; j < maxChild - thisLength; j++) {
                    var mockData = {};
                    mockData.hasSetTimes = false;
                    var daySetTimes = bindDayTemplate(mockData);

                    $(this).append(daySetTimes);
                }
            }
        });


        for (i = 0; i < data.length; ++i) {
            col = data[i].shortDate;
            $(".booking_" + col).append(bindTemplate($("#daysRowTemplate").html(), data[i]));
        }

        $(".day-col:odd").addClass("odd-day");

        var hasVisit = $.makeArray($("ul.time-spans > li:not(.no-visit)").parent());
        var all = $.makeArray($("ul.time-spans"));

        var noVisits = all.filter(function (el) {
            return hasVisit.indexOf(el) < 0;
        });

        $.each(noVisits, function () { $(this).addClass("has-no-visit"); });
    }
    function InitSliderDen() {
        $("#" + holderID).removeClass('blury');
        $("#LoaderTimes").hide();

        $('#' + holderID).slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: true,
        });
    }
    function InitSlider() {
        $("#" + holderID).removeClass('blury');
        $("#LoaderTimes").hide();

        $('#' + holderID).slick({
            infinite: false,
            slidesToShow: 7,
            slidesToScroll: 7,
            rtl: true,
            responsive: [
                {
                    breakpoint: 760,
                    settings: {
                        infinite: false,
                        slidesToShow: 6,
                        slidesToScroll: 6,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        infinite: false,
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        infinite: false,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 426,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1,
                        rtl: true,
                    }
                }
            ]
        });
    }
    function getFirstVisit() {
        if ($('#' + holderID).find(".first-visit").length > 0) {
            var index = $('#' + holderID).find('.first-visit').data().slickIndex;

            $('#' + holderID).slick('slickGoTo', index);
        } else {
            if (navigator.onLine) {
                var guid = $("#service").val();
                if(guid != null) {
                    $.ajax({
                        type: "POST",
                        url: '<?= ADMIN_PATH; ?>/getFirstFreeBooking',
                        data: JSON.stringify({
                            guid
                        }),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (msg) {
                            if (msg.status != "error") {
                                if (msg.d != "") {
                                    if (msg.d.indexOf("-") == -1) {
                                    } else {
                                        var date = msg.d.split("-");
                                        InitSelectedMonthDays(date[1], date[0], date[2]);
                                        $("#lblYearMatabSetTime").html(date[0]);
                                        $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(parseInt(date[1])));
                                    }
                                } else {
                                    $.wnoty({type: 'warning', message: "در حال حاضر نوبتی برای رزرو یافت نشد."});
                                }
                            } else {
                                $.wnoty({type: 'warning', message: msg.msg});
                            }
                        },
                        beforeSend: function () {
                        }
                    });
                } else {
                    $.wnoty({type: 'warning', message: "ابتدا خدمت مورد نظر خود را انتخاب نمایید."});
                }
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان دریافت زمان ها وجود ندارد.'});
            }
        }
    }
    function getTodayDate() {
        var date = $("#hdfToday").val().split("_");

        if ($('#' + holderID).find(".today-col").length == 0) InitSelectedMonthDays(date[1], date[0], date[2]);
        else {
            var index = $('#' + holderID).find('.today-col').data().slickIndex;
            $('#' + holderID).slick('slickGoTo', index);
        }

        $("#lblYearMatabSetTime").html(date[0]);
        $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(parseInt(date[1])));
    }
    function setDayBooking(date, time, is_vip) {
        $("#dateSelected").val(date.replaceAll("_", "/"));
        $("#timeSelected").val(time.replace("_", ":"));
        $("#is_vip").val(is_vip);
        $('#staff').html('');
        $("#priceService").val("");
        $("#depositService").val("");
        getStaffService();
    }

    getStaffService(<?= $data['reservationInfo'][0]['staff_id'] ?>);
    function getStaffService(id='') {
        if($("#is_vip").val()!="" && $("#branch").val()!="" && $("#service").val()!="") {
            if (navigator.onLine) {
                jQuery.ajax({
                    url: "<?= ADMIN_PATH; ?>/getStaffService?service_id=" + $("#service").val() + "&branch_id=" + $("#branch").val() + "&is_vip=" + $("#is_vip").val(),
                    type: 'GET',
                    dataType: "json",
                    timeout: 25000,
                    headers: {"Content-type": "application/json"},
                    success: function (json) {
                        $('#staff').html('');
                        $("#priceService").val("");
                        $("#depositService").val("");
                        if(json.length == 0){
                            $.wnoty({type: 'warning', message: 'برای زمان و تاریخ انتخابی هیچ پرسنلی وجود ندارد.'});
                        } else {
                            $('#staff').html('<option value="" disabled="" selected="" hidden="">-</option>');
                            $.each(json, function (key, value) {
                                $('#staff').append($('<option>', {
                                    "value": value.operator_id,
                                    "text": value.name,
                                    "data-price": value.st_price,
                                    "data-deposit": value.st_deposit,
                                }));
                            });
                            if(id!=""){
                                $("#staff").val(id).change();
                            }
                        }
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان دریافت لیست پرسنل وجود ندارد.'});
            }
        } else {
            $.wnoty({type: 'warning', message: 'برای انتخاب پرسنل ابتدا زمان مورد نظر و شعبه را انتخاب نمایید.'});
        }
    }
</script>

<script>
    $("#Customer").select2({
        placeholder: "انتخاب نمایید...",
        allowClear: true,
        tags: true
    });

    $(document).on('change', '#Customer', function (e) {
        var id= $(this).val();
        document.getElementById('CustomerName').value=$("#customer-"+id).data('fname');
        document.getElementById('CustomerFamily').value=$("#customer-"+id).data('lname');
        document.getElementById('CustomerNumber').value=$("#customer-"+id).data('num');
        if(id!=null) {
            $("#CustomerNumber").prop("disabled", true);
        } else {
            $("#CustomerNumber").prop("disabled", false);
        }
        document.getElementById('CustomerPhone').value=$("#customer-"+id).data('mask');
    });
</script>

<script>
    $("#btn-submit").on('click', function () {
        var branch = document.getElementById("branch").value;
        var Customer = document.getElementById("Customer").value;
        var CustomerName = document.getElementById("CustomerName").value;
        var CustomerFamily = document.getElementById("CustomerFamily").value;
        var CustomerNumber = document.getElementById("CustomerNumber").value;
        var CustomerPhone = document.getElementById("CustomerPhone").value;
        var service = document.getElementById("service").value;
        var dateSelected = document.getElementById("dateSelected").value;
        var timeSelected = document.getElementById("timeSelected").value;
        var staff = document.getElementById("staff").value;
        var is_vip = document.getElementById("is_vip").value;

        if (branch == "") {
            $.wnoty({type: 'warning', message: 'شعبه را انتخاب کنید.'});
        } else if (CustomerName == "") {
            $.wnoty({type: 'warning', message: 'نام مشتری را وارد کنید.'});
        } else if (CustomerFamily == "") {
            $.wnoty({type: 'warning', message: 'نام خانوادگی مشتری را وارد کنید.'});
        } else if (CustomerNumber == "") {
            $.wnoty({type: 'warning', message: 'شماره موبایل مشتری را وارد کنید.'});
        } else if (service == "") {
            $.wnoty({type: 'warning', message: 'خدمت را انتخاب کنید.'});
        } else if (dateSelected == "") {
            $.wnoty({type: 'warning', message: 'تاریخ رزرو را انتخاب کنید.'});
        } else if (timeSelected == "") {
            $.wnoty({type: 'warning', message: 'ساعت رزرو را انتخاب کنید.'});
        } else if (staff == "") {
            $.wnoty({type: 'warning', message: 'یکی از پرسنل را انتخاب کنید.'});
        } else if (is_vip == "") {
            $.wnoty({type: 'warning', message: 'یکی از نوبت های موجود را انتخاب کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("id", <?= $data['attrId'] ?>);
                formData.append("Customer", Customer);
                formData.append("CustomerName", CustomerName);
                formData.append("CustomerFamily", CustomerFamily);
                formData.append("CustomerNumber", CustomerNumber);
                formData.append("CustomerPhone", CustomerPhone);
                formData.append("branch", branch);
                formData.append("branch_old", "<?= $data['reservationInfo'][0]['branch_id'] ?>");
                formData.append("service", service);
                formData.append("service_old", "<?= $data['reservationInfo'][0]['service_id'] ?>");
                formData.append("dateSelected", dateSelected);
                formData.append("dateSelected_old", "<?= $data['reservationInfo'][0]['sre_date'] ?>");
                formData.append("timeSelected", timeSelected);
                formData.append("timeSelected_old", "<?= $data['reservationInfo'][0]['sre_time'] ?>");
                formData.append("staff", staff);
                formData.append("staff_old", "<?= $data['reservationInfo'][0]['staff_id'] ?>");
                formData.append("is_vip", is_vip);
                formData.append("is_vip_old", "<?= $data['reservationInfo'][0]['sre_vip'] ?>");

                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editBooking",
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
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ثبت وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>
