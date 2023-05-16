<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Unix Team">
        <link rel="icon" href="../../public/images/favicon/favicon.ico" />
        <title>نصب سیستم مدیریت رزرواسیون ونسا</title>
        <link rel='stylesheet' type='text/css' href='../../public/library/bootstrap/css/bootstrap.min.css' />

        <link rel='stylesheet' type='text/css' href='install.css' />

        <script type='text/javascript'  src='../../public/js/jquery-3.4.1.min.js'></script>
        <script type='text/javascript'  src='../../public/js/feather-icons/feather.min.js'></script>
        <script type='text/javascript'  src='../../public/js/jquery-validation/jquery.validate.min.js'></script>
        <script type='text/javascript'  src='../../public/js/jquery-validation/jquery.form.js'></script>

    </head>
    <body>
        <div class="install-box">

            <div class="card card-install">
                <div class="card-header text-center">                    
                    <h2>نصب سیستم مدیریت رزرواسیون ونسا</h2>
                </div>
                <div class="card-body no-padding">
                    <div class="tab-container clearfix">
                        <div class="container">
                            <div class="row">
                                <div id="pre-installation" class="tab-title col-sm-4 active">
                                    <i data-feather="circle" class="icon"></i><strong> پیش نیازهای قبل از نصب</strong></span>
                                </div>
                                <div id="configuration" class="tab-title col-sm-4">
                                    <i data-feather="circle" class="icon"></i><strong> تنظیمات</strong>
                                </div>
                                <div id="finished" class="tab-title col-sm-4">
                                    <i data-feather="circle" class="icon"></i><strong> اتمام نصب</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="alert-container">

                    </div>


                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="pre-installation-tab">
                            <div class="section">
                                <p>1. لطفا بررسی کنید که تنظیمات PHP شما با موارد خواسته شده مطابقت داشته باشد:</p>
                                <hr />
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="25%">تنظیمات PHP</th>
                                                <th width="27%">نسخه کنونی</th>
                                                <th>نسخه موردنیاز</th>
                                                <th class="text-center">وضعیت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>نسخه PHP</td>
                                                <td><?= $current_php_version; ?></td>
                                                <td><?= $php_version_required; ?>+</td>
                                                <td class="text-center">
                                                    <?php if ($php_version_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="section">
                                <p>2. لطفا اطمینان حاصل کنید که موارد زیر نصب و فعال شده باشند :</p>
                                <hr />
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="25%">تنظیمات/اکستنشن ها</th>
                                                <th width="27%">تنظیمات کنونی</th>
                                                <th>تنظیمات موردنیاز</th>
                                                <th class="text-center">وضعیت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MySQLi</td>
                                                <td> <?php if ($mysql_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($mysql_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GD</td>
                                                <td> <?php if ($gd_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($gd_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>cURL</td>
                                                <td> <?php if ($curl_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($curl_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>mbstring</td>
                                                <td> <?php if ($mbstring_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($mbstring_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>intl</td>
                                                <td> <?php if ($intl_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($intl_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>json</td>
                                                <td> <?php if ($json_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($json_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>mysqlnd</td>
                                                <td> <?php if ($mysqlnd_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($mysqlnd_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>xml</td>
                                                <td> <?php if ($xml_success) { ?>
                                                        On
                                                    <?php } else { ?>
                                                        Off
                                                    <?php } ?>
                                                </td>
                                                <td>On</td>
                                                <td class="text-center">
                                                    <?php if ($xml_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>date.timezone</td>
                                                <td> <?php
                                                    if ($timezone_success) {
                                                        echo $timezone_settings;
                                                    } else {
                                                        echo "Null";
                                                    }
                                                    ?>
                                                </td>
                                                <td>Timezone</td>
                                                <td class="text-center">
                                                    <?php if ($timezone_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>zlib.output_compression</td>
                                                <td> <?php if ($zlib_success) { ?>
                                                        Off
                                                    <?php } else { ?>
                                                        On
                                                    <?php } ?>
                                                </td>
                                                <td>Off</td>
                                                <td class="text-center">
                                                    <?php if ($zlib_success) { ?>
                                                        <i data-feather="check-circle" class="status-icon"></i>
                                                    <?php } else { ?>
                                                        <i data-feather="x-circle" class="status-icon"></i>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="section">
                                <p>3. لطفا اطیمنان حاصل کنید دسترسی <strong>writable</strong> بر روی این فایل ها یا پوشه ها وجود داشته باشد:</p>
                                <hr />
                                <div>
                                    <table>
                                        <tbody>
                                            <?php
                                            foreach ($writeable_directories as $value) {
                                                ?>
                                                <tr>
                                                    <td style="width:87%;"><?= $value; ?></td>
                                                    <td class="text-center">
                                                        <?php if (is_writeable(".." . $value)) { ?>
                                                            <i data-feather="check-circle" class="status-icon"></i>
                                                            <?php
                                                        } else {
                                                            $all_requirement_success = false;
                                                            ?>
                                                            <i data-feather="x-circle" class="status-icon"></i>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button <?php
                                if (!$all_requirement_success) {
                                    echo "disabled=disabled";
                                }
                                ?> class="btn btn-info form-next text-white"> ادامه <i data-feather="chevron-left" class='icon'></i></button>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="configuration-tab">
                            <form name="config-form" id="config-form" action="do_install.php" method="post">

                                <div class="section clearfix">
                                    <p>1. لطفا جزئیات اتصال به دیتابیس خود را وارد کنید.</p>
                                    <hr />
                                    <div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="web_title" class=" col-md-3">عنوان وبسایت</label>
                                                <div class=" col-md-9">
                                                    <input id="web_title" type="text" value="" name="web_title" class="form-control" placeholder="عنوان وبسایت" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="root_path" class=" col-md-3">آدرس دامنه</label>
                                                <div class=" col-md-9">
                                                    <input id="root_path" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" type="text" value="" name="root_path" class="form-control" placeholder="For exp: https://test.ir/" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="host" class=" col-md-3">هاست دیتابیس</label>
                                                <div class="col-md-9">
                                                    <input type="text" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" id="host" value="localhost" name="host" class="form-control" placeholder="هاست دیتابیس(معمولا همان localhost است)" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="dbuser" class=" col-md-3">کاربر دیتابیس</label>
                                                <div class=" col-md-9">
                                                    <input id="dbuser" type="text" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="dbuser" class="form-control" autocomplete="off" placeholder="نام کاربر دیتابیس" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="dbpassword" class=" col-md-3">رمز عبور</label>
                                                <div class=" col-md-9">
                                                    <input id="dbpassword" type="password" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="dbpassword" class="form-control" autocomplete="off" placeholder="رمزی که برای کاربر دیتابیس انتخاب کرده اید" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="dbname" class=" col-md-3">نام دیتابیس</label>
                                                <div class=" col-md-9">
                                                    <input id="dbname" type="text" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="dbname" class="form-control" placeholder="نام دیتابیس" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section clearfix">
                                    <p>2. لطفا جزئیات کاربر ادمین برای کار با سیستم را مشخص کنید</p>
                                    <hr />
                                    <div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="admin_name" class=" col-md-3">نام و نام خانوادگی</label>
                                                <div class="col-md-9">
                                                    <input type="text" value=""  id="admin_name"  name="admin_name" class="form-control"  placeholder="نام و نام خانوادگی شما" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="admin_username" class=" col-md-3">شماره موبایل (نام کاربری)</label>
                                                <div class=" col-md-9">
                                                    <input id="admin_username" type="number" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="admin_username" class="form-control" placeholder="شماره موبایل شما" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="email" class=" col-md-3">ایمیل</label>
                                                <div class=" col-md-9">
                                                    <input id="email" type="text" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="email" class="form-control" placeholder="ایمیل شما" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group clearfix">
                                            <div class="row">
                                                <label for="password" class=" col-md-3">رمز عبور</label>
                                                <div class=" col-md-9">
                                                    <input id="password" type="password" style="direction: ltr;text-align: start;unicode-bidi: plaintext;" name="password" class="form-control" placeholder="رمز عبور برای ورود به سیستم" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info form-next">
                                        <span class="loader text-white hide"><span> لطفا منتظر بمانید...</span></span>
                                        <span class="button-text text-white"> اتمام <i data-feather="chevron-left" class='icon'></i></span> 
                                    </button>
                                </div>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="finished-tab">
                            <div class="section">
                                <div class="clearfix">
                                    <i data-feather="check-circle" height="2.5rem" width="2.5rem" stroke-width="3" class='status mr10'></i><span class="pull-left"  style="line-height: 50px;">تبریک می گوییم! شما با موفقیت سیستم مدیریت رزرواسیون ونسا را نصب کردید</span>
                                </div>

                                <div style="margin: 15px 0 15px 55px; color: #d73b3b;">
                                   فراموش نکنید که پوشه <b>install</b> را حتما حذف کنید!
                                </div>

                                <a class="go-to-login-page" href="<?= $dashboard_url; ?>">
                                    <div class="text-center">
                                        <div style="font-size: 100px;"><i data-feather="monitor" height="7rem" width="7rem" class="mb-2"></i></div>
                                        <div>برو به صفحه ورود</div>
                                    </div>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">

    var onFormSubmit = function ($form) {
        $form.find('[type="submit"]').attr('disabled', 'disabled').find(".loader").removeClass("hide");
        $form.find('[type="submit"]').find(".button-text").addClass("hide");
        $("#alert-container").html("");
    };
    var onSubmitSussess = function ($form) {
        $form.find('[type="submit"]').removeAttr('disabled').find(".loader").addClass("hide");
        $form.find('[type="submit"]').find(".button-text").removeClass("hide");
    };

    feather.replace();

    $(document).ready(function () {
        var $preInstallationTab = $("#pre-installation-tab"),
                $configurationTab = $("#configuration-tab");

        $(".form-next").click(function () {
            if ($preInstallationTab.hasClass("active")) {
                $preInstallationTab.removeClass("active");
                $configurationTab.addClass("active");
                $("#pre-installation").find("svg").remove();
                $("#pre-installation").prepend('<i data-feather="check-circle" class="icon"></i>');
                feather.replace();
                $("#configuration").addClass("active");
                $("#host").focus();
            }
        });

        $("#config-form").submit(function () {
            var $form = $(this);
            onFormSubmit($form);
            $form.ajaxSubmit({
                dataType: "json",
                success: function (result) {
                    onSubmitSussess($form, result);
                    if (result.success) {
                        $configurationTab.removeClass("active");
                        $("#configuration").find("svg").remove();
                        $("#configuration").prepend('<i data-feather="check-circle" class="icon"></i>');
                        $("#finished").find("svg").remove();
                        $("#finished").prepend('<i data-feather="check-circle" class="icon"></i>');
                        feather.replace();
                        $("#finished").addClass("active");
                        $("#finished-tab").addClass("active");
                    } else {
                        $("#alert-container").html('<div class="alert alert-danger" role="alert">' + result.message + '</div>');
                    }
                }
            });
            return false;
        });

    });
</script>