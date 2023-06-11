<?php echo '<form action="" method="post" accept-charset="utf-8">'; ?>
<?php echo '<input type="hidden" name="step" value="' . $current_step . '">'; ?>
<div class="form-group">
    <label for="hostname" class="control-label">نام هاست</label>
    <input type="text" class="form-control" name="hostname" value="localhost">
</div>
<div class="form-group">
    <label for="database" class="control-label">نام دیتابیس</label>
    <input type="text" class="form-control" name="database">
</div>
<div class="form-group">
    <label for="username" class="control-label">نام کاربری</label>
    <input type="text" class="form-control" name="username">
</div>
<div class="form-group">
    <label for="password" class="control-label"><i class="glyphicon glyphicon-info-sign"
            title='از استفاده از تک کوتیشن (&lsquo;) و دابل کوتیشن(&ldquo;) در رمز عبور دیتابیس خود خودداری کنید'></i>
        رمز عبور</label>
    <input type="password" class="form-control" name="password">
</div>
<hr class="-tw-mx-4" />
<div class="text-left">
    <button type="submit" class="btn btn-primary">بررسی دیتابیس</button>
</div>
</form>