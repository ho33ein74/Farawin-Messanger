<h4 class="bold text-success">نصب با موفقیت انجام شد!</h4>

<?php if (isset($config_copy_failed)) { ?>
<p class="text-danger">
    کپی فایل در مسیر core/config-example.php ناموفق بود. لطفا به آدرس
    core/config/
    رفته و فایل config-example.php کپی کرده و نام آن را به config.php تغییر دهید.
</p>
<?php } ?>

<p>
    <b>پوشه install را حذف کنید</b> و با آدرس <a href="<?= $_POST['base_url']; ?>manage"
        target="_blank"><?= $_POST['base_url']; ?>manage</a> به عنوان ادمین وارد شوید.
</p>

<hr />
<h4>
    <b>برای مشاهده سایت - <a href="<?= $_POST['base_url']; ?>"
            target="_blank">
            اینجا
        </a>  را کلیک کنید
    </b>
</h4>
<hr />
