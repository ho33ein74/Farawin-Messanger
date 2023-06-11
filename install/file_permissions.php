<?php
$error = false;
if (!is_writable('../core')) {
    $error         = true;
    $requirement1 = "<span class='label label-danger'>No (Make application/config/ writable - Permissions 0755</span>";
} else {
    $requirement1 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../index.php')) {
    $error         = true;
    $requirement2 = "<span class='label label-danger'>No (Make index.php writable) - Permissions - 0644</span>";
} else {
    $requirement2 = "<span class='label label-success'>Ok</span>";
}
if (!is_writable('../core/config-example.php')) {
    $error         = true;
    $requirement3 = "<span class='label label-danger'>No (Make core/config-example.php writable) - Permissions - 0644</span>";
} else {
    $requirement3 = "<span class='label label-success'>Ok</span>";
}

?>
<table class="table table-hover tw-text-sm">
    <thead>
        <tr>
            <th><b>فایل/پوشه</b></th>
            <th><b>وضعیت</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="tw-font-medium">core folder Writable</td>
            <td><?php echo $requirement1; ?></td>
        </tr>
        <tr>
            <td class="tw-font-medium">index.php Writable</td>
            <td><?php echo $requirement2; ?></td>
        </tr>
        <tr>
            <td class="tw-font-medium">config-example.php Writable (Auto Updated & Renamed on Install)</td>
            <td><?php echo $requirement3; ?></td>
        </tr>
    </tbody>
</table>
<hr class="-tw-mx-4" />
<?php if ($error == true) {
    echo '<div class="text-center alert alert-danger tw-mb-0">برای ادامه مراحل نصب باید خطاهای موجود را برطرف کنید</div>';
} else {
    echo '<div class="text-center">';
    echo '<form action="" method="post" accept-charset="utf-8">';
    echo '<input type="hidden" name="permissions_success" value="true">';
    echo '<div class="text-left">';
    echo '<button type="submit" class="btn btn-primary">برو به تنظیمات دیتابیس</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}