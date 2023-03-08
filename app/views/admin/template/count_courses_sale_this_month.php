<div data-intro="<?= $help['t_help_txt'] ?>" class="small-box bg-green">
    <div class="inner">
        <p>تعداد فروش دوره <?= jdate("F") ?></p>
        <h3><?= $check_admin_permission ? $bannerTop['orderSaleThisMonthCount']['0']['Count']:0 ?></h3>
    </div>
    <div class="icon" style="top: 21px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
        <i class="em em-female-student" aria-role="presentation" aria-label="PAGE FACING UP"></i>
    </div>
    <a href="<?= ADMIN_PATH; ?>/sales" class="small-box-footer">
        <i class="fa fa-arrow-circle-left"></i>
        اطلاعات بیشتر
    </a>
</div>