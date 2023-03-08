<div data-intro="<?= $help['t_help_txt'] ?>" class="small-box bg-red">
    <div class="inner">
        <p>اعتبار پنل پیامک</p>
        <h3 dir="rtl"><?= $check_admin_permission ? number_format($getCreditInfo):0 ?></h3>
    </div>
    <div class="icon" style="top: 17px;color: rgba(0, 0, 0, 0.4);font-size: 40px;">
        <i class="em em-moneybag" aria-role="presentation" aria-label="WRENCH"></i>
    </div>
    <a nofollow href="<?= $check_admin_permission ? ($getSmsSite == "faraz" ? "https://farazsms.com/login-page/":"https://sms.ir/loginform/"):ADMIN_PATH."/dashboard#"; ?>" target="_blank" class="small-box-footer">
        <i class="fa fa-arrow-circle-left"></i>
        اطلاعات بیشتر
    </a>
</div>