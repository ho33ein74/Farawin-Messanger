<div data-intro="<?= $help['t_help_txt'] ?>" class="small-box bg-yellow">
    <div class="inner">
        <p>نوبت&zwnj;های <?= jdate("F") ?></p>
        <h3><?= $check_admin_permission ? $bannerTop['reservationsThisMonthCount']['0']['Count']:0 ?></h3>
    </div>
    <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
        <i class="em em-spiral_calendar_pad" aria-role="presentation" aria-label="MONEY"></i>
    </div>
    <a href="<?= ADMIN_PATH; ?>/reservations/list" class="small-box-footer">
        <i class="fa fa-arrow-circle-left"></i>
        اطلاعات بیشتر
    </a>
</div>