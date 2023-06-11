<form action="" method="post" accept-charset="utf-8" id="installForm">
    <?php echo '<input type="hidden" name="step" value="' . $current_step . '">'; ?>
    <?php echo '<input type="hidden" name="hostname" value="' . $_POST['hostname'] . '">'; ?>
    <?php echo '<input type="hidden" name="username" value="' . $_POST['username'] . '">'; ?>
    <?php echo '<input type="hidden" name="password" value="' . $_POST['password'] . '">'; ?>
    <?php echo '<input type="hidden" name="database" value="' . $_POST['database'] . '">'; ?>
    <h4>اطلاعات دامنه</h4>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label for="base_url" class="control-label">آدرس پایه</label>
                    <input type="url" class="form-control"
                               value="<?php echo $this->guess_base_url(); ?>"
                               name="base_url"
                               id="base_url"
                               style="direction: ltr;text-align: left" required>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label for="web_title" class="control-label">عنوان وبسایت</label>
                    <input type="text" class="form-control" name="web_title" id="web_title" style="direction: rtl;text-align: right" required>
                </div>
            </div>
        </div>

        <hr/>
        <h4 style="margin-top: 15px">اطلاعات ورود ادمین</h4>
        <hr/>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="lastname" class="control-label">نام خانوادگی</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="firstname" class="control-label">نام</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="admin_mobile" class="control-label">شماره موبایل (نام کاربری)</label>
                    <input style="direction: ltr;text-align: left" type="tel" class="form-control" name="admin_mobile" id="admin_mobile" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="admin_email" class="control-label">ایمیل</label>
                    <input style="direction: ltr;text-align: left" type="email" class="form-control" name="admin_email" id="admin_email" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="admin_passwordr" class="control-label">تکرار رمز عبور</label>
                    <input type="password" class="form-control" name="admin_passwordr" id="admin_passwordr" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="admin_password" class="control-label">رمز عبور</label>
                    <input type="password" class="form-control" name="admin_password" id="admin_password" required>
                </div>
            </div>
        </div>

        <hr class="-tw-mx-4"/>

        <div class="text-left">
            <button type="submit" class="btn btn-success" id="installBtn">نصب</button>
        </div>
</form>