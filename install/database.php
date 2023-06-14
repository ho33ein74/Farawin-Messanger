<?php echo '<form action="" method="post" accept-charset="utf-8">'; ?>
<?php echo '<input type="hidden" name="step" value="' . $current_step . '">'; ?>
<div class="form-group">
    <label for="hostname" class="control-label">نام هاست</label>
    <input type="text" class="form-control" name="hostname" value="localhost" style="direction: ltr;text-align: left">
</div>
<div class="form-group">
    <label for="database" class="control-label">نام دیتابیس</label>
    <input type="text" class="form-control" name="database" style="direction: ltr;text-align: left">
</div>
<div class="form-group">
    <label for="username" class="control-label">نام کاربری</label>
    <input type="text" class="form-control" name="username" style="direction: ltr;text-align: left">
</div>
<div class="form-group">
    <label for="password" class="control-label">رمز عبور</label>
    <input type="password" class="form-control" name="password" style="direction: ltr;text-align: left">
</div>
<hr class="-tw-mx-4" />
<div class="text-left">
    <button type="submit" class="btn btn-primary">بررسی دیتابیس</button>
</div>
</form>