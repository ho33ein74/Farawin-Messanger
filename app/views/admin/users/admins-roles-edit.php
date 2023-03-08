<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش نقش | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/panel/plugins/iCheck/all.css">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper">

    <header class="main-header">
        <?php require('app/views/admin/include/header.php'); ?>
    </header>

    <aside class="main-sidebar direction">
        <?php require('app/views/admin/include/sidebar.php'); ?>
    </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>ویرایش نقش</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/admins"><i class="fa fa-user-secret"></i> Admins</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/admins/roles">Roles</a></li>
                <li class="active">Edit</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش نقش</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-8'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="titleEdit">:عنوان</label>
                                            <input style="border-radius: 3px;text-align:right" type="text"
                                                   value="<?= $data['rolesInfo']['0']['ar_title']; ?>"
                                                   class="form-control" id="titleEdit" name="titleEdit" required>
                                        </div>
                                    </div>
                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label for="statusEdit">: وضعیت</label>
                                            <select id="statusEdit" name="statusEdit" class="form-control select2Class"
                                                    style="border-radius: 3px;width: 100%;"
                                                    required>
                                                <option <?php if ($data['rolesInfo']['0']['ar_status']==1) { ?>selected="selected"<?php } ?> value="1"> فعال </option>
                                                <option <?php if ($data['rolesInfo']['0']['ar_status']==0) { ?>selected="selected"<?php } ?> value="0"> غیرفعال </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr/>

                                <?php function display_access_list($item_list, $parent_id, $access_list) { ?>
                                    <?php if(sizeof($item_list['access'])>0) { ?>
                                        <div class='col-md-4'>
                                            <hr/>
                                            <div class="form-group">
                                                <p class="login-with-or"><i class="fa fa-circle"></i> میزان دسترسی به بخش <?= $item_list['s_name'] ?>:</p>
                                                <hr/>
                                                <?php foreach ($item_list['access'] as $access) { ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" class="child-permission"
                                                                   <?= in_array($access['sal_permisson'], $access_list) ? "checked":""; ?>
                                                                   data-permission_id="<?= $parent_id ?>"
                                                                   name="chb[]"
                                                                   value="<?= $access['sal_permisson'] ?>">
                                                            <?= $access['sal_title'] ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if (array_key_exists("children", $item_list)){ ?>
                                        <?php foreach ($item_list['children'] as $child) { ?>
                                            <?php display_access_list($child, $parent_id, $access_list); ?>
                                        <?php } ?>
                                    <?php } ?>

                                <?php } ?>

                                <?php if(sizeof($data['access_list'])>0) { ?>
                                    <div class='row'>
                                        <div class="box-group" id="accordion">
                                            <?php foreach ($data['access_list'] as $item) { ?>
                                                <div class="panel box">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?= $item['s_id'] ?>" style="color: #000">
                                                                <?= $item['s_name'] ?>
                                                            </a>
                                                        </h4>
                                                        <input data-id="<?= $item['s_id'] ?>" class="parent-permission" name="permissions[]" type="checkbox" value="<?= $item['s_id'] ?>">
                                                    </div>

                                                    <div id="collapse_<?= $item['s_id'] ?>" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                            <div class="row row-eq-height">
                                                                <?= display_access_list($item, $item['s_id'], $data['rolesInfo']['access']); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ویرایش" type="submit">
                                </div>
                                <!-- /.box-body -->
                            </div>

                        </div>
                        <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <?php require('app/views/admin/include/footer.php'); ?>
</footer>
<?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="public/panel/plugins/iCheck/icheck.min.js"></script>

<script>
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_flat-green',
    });

    $('input.parent-permission').on('ifChanged', function(event){
        var permissionId = $(this).data('id');
        var checked = $(this).prop('checked') ? 'check':'uncheck';
        $('input[data-permission_id="' + permissionId + '"').iCheck(checked);
    });
</script>

<script>
    function getSelectedChbox() {
        var selchbox = [];
        var inpfields = $('input:checkbox.child-permission');
        var nr_inpfields = inpfields.length;
        for (var i = 0; i < nr_inpfields; i++) {
            if (inpfields[i].type == 'checkbox' && inpfields[i].checked == true) {
                selchbox.push(inpfields[i].value);
            }
        }
        return selchbox;
    }

    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("titleEdit").value;
        var status = document.getElementById("statusEdit").value;
        var access = getSelectedChbox();

        if (title == "") {
            $.wnoty({type: 'warning', message: 'عنوان را وارد کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("title", title);
                formData.append("status", status);
                formData.append("access", access);
                formData.append("id", <?= $data['attrId']; ?>);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editRoles",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
                    },
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>
