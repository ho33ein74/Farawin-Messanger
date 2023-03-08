<div data-intro="<?= $help['t_help_txt'] ?>" class="small-box bg-aqua">
    <div class="inner">
        <p>مشتریان <?= jdate("F") ?></p>
        <h3><?= $check_admin_permission ? $bannerTop['userCount']['0']['Count']:0 ?></h3>
    </div>
    <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
        <i class="em em-woman-woman-girl-girl" aria-role="presentation" aria-label=""></i>
    </div>
    <a href="<?= ADMIN_PATH; ?>/users" class="small-box-footer">
        <i class="fa fa-arrow-circle-left"></i>
        اطلاعات بیشتر
    </a>
</div>