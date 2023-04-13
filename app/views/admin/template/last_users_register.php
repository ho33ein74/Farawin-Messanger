<div data-intro="<?= $help['t_help_txt'] ?>" class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">آخرین مشتریان ثبت شده</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <ul class="users-list clearfix">
            <?php
            if (sizeof($userGetlatest) > 0) {
                foreach ($userGetlatest as $user_data) {
                    if ($user_data['c_image'] == "0") {
                        $url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user_data['c_mobile_num']))) . "?d=identicon&r=x";
                    } else {
                        $url = $user_data['c_image'];
                    }
                    ?>

                    <li>
                        <img style="width: 40px;height: 40px" src="<?= $url; ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';" alt="<?= $check_admin_permission ? $user_data['c_display_name']:"-------"; ?>">
                        <a class="users-list-name" dir="rtl" href="<?= ADMIN_PATH; ?>/users/view/<?= $user_data['customer_vids_id']; ?>" title="<?= $check_admin_permission ? $user_data['c_display_name']:"-------"; ?>">
                            <?= $check_admin_permission ? $user_data['c_display_name']:"-------"; ?>
                        </a>
                        <span class="users-list-date" title="<?= $check_admin_permission ? $user_data['c_registery_date']:"---"; ?>">
                            <?php
                                $date = Model::jalali_to_miladi($user_data['c_registery_date']);
                                $resDate = Model::days_away_to($date);
                                if ($resDate == 0) {
                                    echo $check_admin_permission ? "امروز":"---";
                                } else if ($resDate == 1) {
                                    echo $check_admin_permission ? "دیروز":"---";
                                } else {
                                    echo $check_admin_permission ? $resDate . " روز قبل":"---";
                                }
                            ?>
                        </span>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <div class="text-center" style="padding-bottom: 10px !important;padding-top: 10px !important;direction: rtl">
                    متاسفانه در حال حاضر کاربری ثبت نشده است!
                </div>
            <?php } ?>
        </ul>
        <!-- /.users-list -->
    </div>
    <!-- /.box-body -->

    <?php if (sizeof($userGetlatest) > 0) { ?>
        <div class="box-footer clearfix">
            <a href="<?= ADMIN_PATH; ?>/users" class="btn btn-sm btn-default btn-flat pull-left">مشاهده
                همه</a>
        </div>
    <?php } ?>
    <!-- /.box-footer -->

    <?php if (!$check_admin_permission) { ?>
        <div class="overlay" style="background: rgba(255,255,255,.8);">
            <p style="display: flex;justify-content: center;align-items: center;height: 100%;">متاسفانه به اطلاعات این بخش دسترسی ندارید</p>
        </div>
    <?php } ?>
</div>