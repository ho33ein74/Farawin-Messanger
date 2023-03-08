<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش سوال | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
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
                <small>ویرایش سوال</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/faq"><i class="fa fa-question"></i> faq</a></li>
                <li class="active">Question Edit</li>
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
                            <h3 class="box-title">ویرایش سوال</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="type">:بخش مربوطه</label>
                                            <select style="width: 100%;" id="type" name="type" class="form-control select2Class" style="border-radius: 3px;width: 100%;direction: rtl">
                                                <option <?= $data['question']['0']['type']=="public" ? "selected":""; ?> data-id="public" value="public">عمومی</option>
                                                <option <?= $data['question']['0']['type']=="service" ? "selected":""; ?> data-id="service" value="service">خدمات</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div data-intro="سوال را در این بخش می توانید وارد نمایید." class='col-md-8'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="question">:سوال</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $data['question']['0']['question']; ?>"
                                                   class="form-control" id="question" name="question" required>
                                        </div>
                                    </div>

                                    <div id="servicesPart" style="<?= $data['question']['0']['type']=="service" ? "":"display: none"; ?>" class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="services">:خدمت مرتبط</label>
                                            <select id="services" name="services[]" class="form-control select2Class" style="width: 100%;direction: ltr;" multiple="multiple">
                                                <?php foreach($data['services'] as $service){ ?>
                                                    <option <?= ($data['question']['0']['type']=="service" && in_array($service['s_id'], $data['questionRelated'])) ? "selected":"" ?> data-id="<?= $service['s_id'] ?>" value="<?= $service['s_id'] ?>">
                                                        <?= $service['s_title'] ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div data-intro="در این بخش می توانید پاسخ سوال را به همراه تصویر و... وارد نمایید" class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="answer">:جواب</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right"
                                                      class="form-control" rows="8" id="answer"
                                                      name="answer"
                                                      required><?= $data['question']['0']['answer']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <input id="btnsubmit" class="btn btn-dropbox" value="ویرایش" type="submit">
                                </div>
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
<script src="public/panel/plugins/ckeditor4-major/ckeditor.js"></script>

<script>
    $(function() {
        $('#type').change(function(){
            $('#servicesPart').hide();
            if ($(this).val() == 'service') {
                $('#servicesPart').show();
            }
        });
    });
</script>

<script>
    CKEDITOR.replace('answer',
        {
            language: 'fa',
            allowedContent: true,
            removePlugins: 'elementspath,flash,about,language',
            font_names :'Arial;Times New Roman;Tahoma;IRANSans;B Nazanin;B Mitra;B Homa',
            extraPlugins: 'wordcount',
            filebrowserBrowseUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/browser/default/browser.html?Connector=<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/browser/default/browser.html?Type=Image&Connector=<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/browser/default/browser.html?Type=Flash&Connector=<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl: '<?= URL; ?>public/panel/plugins/ckeditor4-major/filemanager/connectors/php/upload.php?Type=Flash'
        });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var question = document.getElementById("question").value;
        var serviceId = $('#services').val();
        var type = document.getElementById("type").value;
        var answer = CKEDITOR.instances['answer'].getData();

        if (question == "") {
            $.wnoty({type: 'warning', message: 'سوال را وارد کنید.'});
        } else if (answer == "") {
            $.wnoty({type: 'warning', message: 'جواب را وارد کنید.'});
        } else if (serviceId == "" && type=="service") {
            $.wnoty({type: 'warning', message: 'خدمت را انتخاب کنید.'});
        } else {
            if (navigator.onLine) {
                var formData = new FormData();
                formData.append("question", question);
                formData.append("answer", answer);
                formData.append("type", type);
                formData.append("serviceId", serviceId);
                formData.append("id", <?= $data['attrId']; ?>);
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/editQuestion",
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
