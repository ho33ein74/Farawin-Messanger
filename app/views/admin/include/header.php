<a href="<?= ADMIN_PATH; ?>/dashboard" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
        <img src="public/images/favicon/apple-icon-60x60.ico" width="25px">
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?= $data['getPublicInfo']['site_short_name']; ?></b></span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="<?= ADMIN_PATH; ?>/dashboard" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu" style="float: left">
        <ul class="nav navbar-nav">
            <?php if (@sizeof($data['publicData']['request']) > 0) { ?>
                    <li class="dropdown notifications-menu">
                        <a href="<?= ADMIN_PATH; ?>/dashboard" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="em em-bell faa-ring animated text-red" style="font-size: 12pt;"></i>
                            <span class="label label-danger" style="border-radius: 5px;color: #d9534f !important;width: 8px;height: 8px;margin-top: 5px;margin-right: 5px"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="menu">
                                    <?php if (
                                            (
                                                    $data['getPublicInfo']['sms_api_key']=="" OR
                                                    $data['getPublicInfo']['sms_secret_key']=="" OR
                                                    $data['getPublicInfo']['sms_number']=="" OR
                                                    $data['getPublicInfo']['sms_template_for_forget_password_admin']=="" OR
                                                    $data['getPublicInfo']['sms_template_login']==""
                                            )
                                            AND
                                            (
                                                    in_array("business_information_view_edit", $data['infoAdmin']['access']) OR
                                                    $data['infoAdmin'][0]['admin_role_id'] == 1
                                            )
                                    ) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/businessInformation" title="اطلاعات پنل پیامکی را کامل نمایید."><i class="fa fa-bullhorn text-red"></i>اطلاعات پنل پیامکی را کامل نمایید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['status'] AND (in_array("service_status_list_view", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/status/service" title="کد پیامک، وضعیت نوبت های رزرو شده را وارد نمایید."><i class="fa fa-hourglass-2 text-red"></i>کد پیامک، وضعیت نوبت های رزرو شده را وارد نمایید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['payment_methods'] AND (in_array("business_information_view_edit", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/businessInformation" title="روش پرداخت مورد نظر خود را فعال نمایید."><i class="fa fa-money text-red"></i>روش پرداخت مورد نظر خود را فعال نمایید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['sources'] AND (in_array("blog_source_list_view", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/sources" title="لیست منابع وبلاگ را تکمیل نمایید."><i class="fa fa-book text-red"></i>لیست منابع وبلاگ را تکمیل نمایید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['banks'] AND (in_array("account_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/accounts/add" title="لیست حساب های بانکی را تکمیل کنید."><i class="fa fa-bank text-red"></i>لیست حساب های بانکی را تکمیل کنید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['cash'] AND (in_array("cash_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/cash/add" title="لیست صندوق ها را تکمیل کنید."><i class="fa fa-money text-red"></i>لیست صندوق ها را تکمیل کنید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['cost_type'] AND (in_array("cost_category_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/costCategory" title="دسته بندی هزینه ها را تکمیل کنید."><i class="fa fa-tags text-red"></i>دسته بندی هزینه ها را تکمیل کنید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['branches'] AND (in_array("service_branch_add", $data['infoAdmin']['access'])) OR $data['infoAdmin'][0]['admin_role_id'] == 1) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/branches" title="لیست شعبه ها را تکمیل کنید."><i class="fa fa-home text-red"></i>لیست شعبه ها را تکمیل کنید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['storeroom_list'] AND (in_array("service_storeroom_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/storeroom/list" title="لیست انبارها را تکمیل کنید."><i class="fa fa-home text-red"></i>لیست انبارها را تکمیل کنید.</a></li>
                                    <?php } ?>
                                    <?php if ($data['publicData']['request']['staff'] AND (in_array("service_staff_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1)) { ?>
                                        <li><a href="<?= ADMIN_PATH; ?>/staffs" title="لیست پرسنل سالن را تکمیل کنید."><i class="fa fa-users text-red"></i>لیست پرسنل سالن را تکمیل کنید.</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            <li class="hidden-xs">
                <a title="تاریخ امروز">
                    <span><?= jdate("l, j F Y") ?></span>
                </a>
            </li>

            <?php if(in_array("service_reservation_add", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1){ ?>
                <li class="dropdown notifications-menu">
                    <a href="<?= ADMIN_PATH; ?>/reservations/new" title="ثبت نوبت جدید">
                        <i class="fa fa-calendar-plus-o"></i>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("service_reservation_list_view", $data['infoAdmin']['access']) OR $data['infoAdmin'][0]['admin_role_id'] == 1){ ?>
            <li class="dropdown messages-menu">
                <a href="reservations/list" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-calendar-check-o"></i>
                    <span class="label label-success"><?= sizeof($data['publicData']['todayReserve']) ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">لیست نوبت های امروز</li>
                    <li>
                        <ul class="menu">
                            <?php if (sizeof($data['publicData']['todayReserve'])>0) { ?>
                                <?php foreach ($data['publicData']['todayReserve'] as $todayReserve) { ?>
                                    <?php
                                    $bg = "";
                                    if(Model::jaliliDate("H:i")>$todayReserve['sre_time']){
                                        $bg = "background: #ff000036;";
                                    }
                                    ?>
                                    <li style="<?= $bg; ?>">
                                        <a href="<?= ADMIN_PATH; ?>/reservations/details/<?= $todayReserve['order_service_vids_id'] ?>">
                                            <h4 style="font-size: 13px;">
                                                <?= $todayReserve['c_display_name'] ?>
                                                <small style="top: 3px;"><?= $todayReserve['s_title'] ?> - </small>
                                                <small style="top: 3px;left: -30px;"><?= $todayReserve['sre_time'] ?></small>
                                            </h4>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li>
                                    <span>
                                        <h4 style="font-size: 13px;text-align: center">
                                            نوبتی برای امروز ثبت نشده است
                                        </h4>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="<?= ADMIN_PATH; ?>/reservations/list">نمایش لیست نوبت&zwnj;ها</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown notifications-menu">
                <a href="reservations/list" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-calendar"></i>
                    <span class="label label-warning"><?= $data['publicData']['weekReserve']['total'] ?></span>
                </a>
                <?php unset($data['publicData']['weekReserve']['total']); ?>
                <ul class="dropdown-menu">
                    <li class="header">تعداد نوبت&zwnj;های رزرو شده 7 روز آینده</li>
                    <li>
                        <ul class="menu" style="max-height:  max-content;">
                            <?php foreach ($data['publicData']['weekReserve'] as $weekReserve) { ?>
                                <li>
                                    <a href="<?= ADMIN_PATH; ?>/reservations/list?date=<?= str_replace("/", "-", $weekReserve['date']) ?>">
                                        <i class="fa fa-check text-aqua"></i>
                                        <?= $weekReserve['title'] ?>
                                        <span class="label label-success pull-left" style="padding-top: 5px;">
                                            <?= $weekReserve['count'] ?>
                                        </span>
                                        <span class="label label-primary pull-left" style="margin-left:5px;padding-top: 5px;">
                                        <?= $weekReserve['date'] ?>
                                    </span>
                                    </a>
                                </li>
                            <?php } ?>
                            </ul>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <li class="dropdown user user-menu">
                <a href="<?= ADMIN_PATH; ?>/profile" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <img src="<?= $data['infoAdmin'][0]['a_image']; ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';"
                         class="user-image" alt="<?= $data['infoAdmin'][0]['a_name']; ?>">
                    <span class="hidden-xs"><?= $data['infoAdmin'][0]['a_name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?= $data['infoAdmin'][0]['a_image']; ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';"
                             class="img-circle" alt="<?= $data['infoAdmin'][0]['a_name']; ?>">
                        <p>
                            <?= $data['infoAdmin'][0]['a_name']; ?>
                            <small><?= $data['infoAdmin'][0]['ar_title']; ?></small>
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?= ADMIN_PATH; ?>/profile" class="btn btn-default btn-flat">پروفایل</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= ADMIN_PATH; ?>/logout" class="btn btn-danger btn-flat">خروج از حساب کاربری</a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a title="مشاهده سایت" href="<?= URL; ?>" target="_blank"><i class="fa fa-desktop"></i></a>
            </li>
            <li>
                <a title="شخصی سازی قالب" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>

</nav>
