<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>ویرایش برگه <?= $data['pageInfo']['title']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div id="loading" style="display: none">
    <div class="snippet">
        <img src="public/images/favicon/apple-icon-60x60.png" alt="">
        <div class="stage">
            <div class="dot-floating"></div>
        </div>
    </div>
    <div class="overlay-loading"></div>
</div>
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
                <small>ویرایش برگه <?= $data['pageInfo']['title']; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/page"><i class="fa fa-clone"></i> Page</a></li>
                <li class="active">Edit Page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">ویرایش برگه <?= $data['pageInfo']['title']; ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="box-body">
                                <div class='row'>
                                    <div data-intro="عنوان مورد نظر خود را در این بخش وارد نمایید." class='col-md-8'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="title">:عنوان برگه</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" value="<?= $data['pageInfo']['title']; ?>"
                                                   class="form-control" id="title" name="title" required>
                                        </div>
                                    </div>

                                    <div data-intro="کلمات کلیدی مورد استفاده برای برگه را در این بخش وارد نمایید." class='col-md-4'>
                                        <div class="form-group" style="text-align:right">
                                            <label dir="rtl" for="mainKeyword">تگ کلمات کلیدی (keywords):</label>
                                            <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="mainKeyword" value="<?= $data['pageInfo']['main_tag']; ?>" name="mainKeyword">
                                        </div>
                                    </div>

                                    <div data-intro="آدرس برگه می بایست به صورت یکتا باشد و قبلا ثبت نشده باشد که در صورت تکراری بودن به شما هشدار داده می شود." class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="width: 100%;" align="right" for="slug">:آدرس برگه</label>
                                            <div class="input-group">
                                                <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="<?= $data['pageInfo']['link']; ?>" class="form-control" id="slug" name="slug" <?= $data['pageInfo']['readonly_link']==1 ? "readonly":""; ?>>
                                                <span style="direction: ltr;border-radius: 3px 0 0 3px" class="input-group-addon"><?= URL; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-intro="محتوای برگه را با استفاده از ابزار در نظر گرفته شده می توانید در بخش زیر وارد نمایید." class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label align="right" for="desc">:محتوا برگه</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right"
                                                      class="form-control" rows="8" id="desc"
                                                      name="desc" required><?= $data['pageInfo']['description']; ?></textarea>
                                        </div>
                                    </div>

                                    <div data-intro="توضیحات در مورد برگه را می توانید در این بخش وارد نمایید. این توضیحات در متا تگ description نمایش داده می شود." class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label dir="rtl"  style="width: 100%" align="right" for="metaDescription">تگ توضیحات (meta description):</label>
                                            <textarea style="border-radius: 3px;resize: vertical;text-align:right"
                                                      class="form-control" rows="4" id="metaDescription"
                                                      name="metaDescription"><?= $data['pageInfo']['metaDescription']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
                <div class="col-md-3">

                    <div class="box box-info">
                        <!-- /.box-header -->
                        <div class="box-body text-center">
                            <div class="box-header with-border">
                                <h3 class="box-title">انتشار</h3>
                            </div>
                            <a data-intro="بعد از تکمیل موارد می توانید برای ذخیره برگه از این دکمه استفاده نمایید." id="btnsubmit" name="btnsubmit" class="btn btn-app mt-5">
                                <i class="fa fa-save"></i> ذخیره
                            </a>
                            <input id="address-val" type="hidden" value="1"/>
                            <div data-intro="وضعیت برگه را می توانید از این بخش انتخاب نمایید. با انتخاب گزینه فعال برگه در سایت قابل نمایش خواهد بود و گزینه غیرفعال برگه به صورت پیش نویس ذخیره می شود." class="form-group text-right">
                                <label>وضعیت</label>
                                <select class="form-control" id="status" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option <?= $data['pageInfo']['p_status'] == 1 ? "selected='selected'" : "" ?> value="1">فعال</option>
                                    <option <?= $data['pageInfo']['p_status'] == 0 ? "selected='selected'" : "" ?> value="0">غیرفعال</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div data-intro="در این بخش عکس کاور برگه را می توانید انتخاب نمایید. تا حد امکان سعی کنید که حجم تصویر زیاد نباشد تا باعث کند شدن لود صفحه نگردد." class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">تصویر بند انگشتی</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="file-upload">
                            <div style="display: none;" class="image-upload-wrap">
                                <input class="file-upload-input" type="file" id="cover" name="cover" onchange="readURL(this);" accept="image/*">
                                <div class="drag-text">
                                    <h5 class=" text-center">عکس مورد نظر را انتخاب کنید</h5>
                                </div>
                            </div>
                            <div style="display: block;" class="file-upload-content">
                                <img style="width: 100%;" class="file-upload-image" src="public/images/page/<?= $data['pageInfo']['cover']; ?>" alt="your image">
                                <div class="image-title-wrap">
                                    <button type="button" onclick="removeUpload()" class="remove-image">حذف</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <?php require('app/views/admin/include/footer.php'); ?>
    </footer>
    <?php require('app/views/admin/include/skinSidebar.php'); ?>
</div>
<?php require('app/views/admin/include/publicJS.php'); ?>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="http://editor.highcharts.com/integrations/ckeditor.js" type="text/javascript" charset="utf-8"></script>

<script>
    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
</script>

<script>
    $('#slug').change(function(e) {
        var slug = document.getElementById("slug").value;

        var formData = new FormData();
        formData.append("slug", slug);
        formData.append("id", <?= $data['attrId']; ?>);
        if (navigator.onLine) {
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/checkSlug",
                type: "POST",
                data : formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "ok") {
                        document.getElementById("address-val").value = 1;
                    } else {
                        $.wnoty({type: data.noty_type, message: data.msg});
                        document.getElementById("address-val").value = 0;
                    }
                }
            });
        } else {
            document.getElementById("address-val").value = 0;
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    });
</script>

<script>
    CKEDITOR.replace('desc',
        {
            language: 'fa',
            allowedContent: true,
            removePlugins: 'elementspath,flash,about,language',
            font_names :'Arial;Times New Roman;Tahoma;IRANSans;B Nazanin;B Mitra;B Homa',
            extraPlugins: 'image2',
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
        var address = document.getElementById("address-val").value;
        var title = document.getElementById("title").value;
        var mainKeyword = document.getElementById("mainKeyword").value;
        var slug = document.getElementById("slug").value;
        var desc = CKEDITOR.instances['desc'].getData();
        var metaDescription = document.getElementById("metaDescription").value;
        var status = document.getElementById("status").value;
        var coverPost = document.getElementById("cover");
        var cover = coverPost.files[0];

        if (title == "") {
            $.wnoty({type: 'error', message: 'عنوان برگه را وارد کنید.'});
        } else if (slug == "") {
            $.wnoty({type: 'error', message: 'آدرس برگه را وارد کنید.'});
        } else if (desc == "") {
            $.wnoty({type: 'error', message: 'محتوا برگه را وارد کنید.'});
        } else {
            if(address == 1) {
                if (navigator.onLine) {
                    var formData = new FormData();
                    formData.append("id", <?= $data['attrId']; ?>);
                    formData.append("title", title);
                    formData.append("mainKeyword", mainKeyword);
                    formData.append("slug", slug);
                    formData.append("desc", desc);
                    formData.append("metaDescription", metaDescription);
                    formData.append("status", status);
                    formData.append("cover", cover);
                    $.ajax({
                        url: "<?= ADMIN_PATH; ?>/editPage",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            data = JSON.parse(data);
                            $.wnoty({type: data.noty_type, message: data.msg});

                            if (data.status == "ok") {
                                window.location.href = '<?= ADMIN_PATH; ?>/pages';
                            }
                        }
                    });
                } else {
                    $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
                }
            } else {
                $.wnoty({type: 'error', message: 'آدرس پیج معتبر نمی باشد؛ آن را اصلاح و مجددا تلاش نمایید.'});
            }
        }
    });
</script>

</body>
</html>
