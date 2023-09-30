<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>افزودن مطلب جدید | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>افزودن مطلب جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/blog"><i class="fa fa-newspaper-o"></i> Blog</a></li>
                <li class="active">New Post</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?= $_SERVER['REQUEST_URI']; ?>#tab_0" data-toggle="tab" aria-expanded="true">مطلب</a></li>
                            <li><a href="<?= $_SERVER['REQUEST_URI']; ?>#tab_1" data-toggle="tab" aria-expanded="false">سئو</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_0">
                                <div class="box-body">
                                    <div class="box-body">
                                        <div class='row'>
                                            <div data-intro="در این بخش می توانید عنوان مطلب را وارد نمایید" class='col-md-6'>
                                                <div class="form-group" style="text-align:right">
                                                    <label style="width: 100%;" align="right" for="title">:عنوان مطلب</label>
                                                    <input style="border-radius: 3px;text-align:right" type="text"
                                                           class="form-control" id="title" name="title" required>
                                                </div>
                                            </div>

                                            <div data-intro="از بین دسته بندی های موجود می بایست یک دسته بندی را انتخاب نمایید. برای افزودن یا ویرایش دسته بندی ها می توانید از بخش دسته بندی اقدام نمایید." class='col-md-3'>
                                                <div class="form-group" style="text-align:right">
                                                    <label for="category">:دسته بندی</label>
                                                    <select id="category" name="category" class="form-control"
                                                            style="border-radius: 3px;width: 100%;direction: rtl"
                                                            required>
                                                        <?php
                                                        $categories = $data['category'];
                                                        foreach ($categories as $category) {
                                                            ?>
                                                            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div data-intro="از بین منابع موجود می بایست یک منبع را انتخاب نمایید. برای افزودن یا ویرایش منابع می توانید از بخش منابع اقدام نمایید." class='col-md-3'>
                                                <div class="form-group" style="text-align:right">
                                                    <label for="source">:منبع</label>
                                                    <select id="source" name="source" class="form-control"
                                                            style="border-radius: 3px;width: 100%;direction: rtl"
                                                            required>
                                                        <?php
                                                        $sources = $data['sources'];
                                                        foreach ($sources as $source) {
                                                            ?>
                                                            <option value="<?= $source['so_id']; ?>"><?= $source['title']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class='col-md-12'>
                                                <div class="form-group" style="text-align:right">
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" name="edit-url" id="edit-url">
                                                        <label class="mt-1 mr-3" for="edit-url">مایل به اصلاح دستی لینک مطلب هستید؟</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='col-md-12'>
                                                <div class="form-group" style="display: none;" id="edit-url-manual">
                                                    <label>پیوند مطلب (لینک)</label>
                                                    <input type="text" class="form-control" id="url" name="url" placeholder="لینک را بنویسید...">
                                                </div>
                                            </div>

                                            <div data-intro="در این بخش محتوای مطلب را می توانید اضافه نمایید که با استفاده از ابزاری که در نظر گرفته شده می توانید اندازه متن، رنگ و... را تغییر دهید." class='col-md-12'>
                                                <div class="form-group" style="text-align:right">
                                                    <label align="right" for="desc">:متن مطلب</label>
                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:right"
                                                              class="form-control" rows="8" id="desc"
                                                              name="desc" required></textarea>
                                                </div>
                                            </div>

                                            <div data-intro="خلاصه ای از مطلب در حد یک پاراگراف می توانید در این بخش بنویسید، که این خلاصه به عنوان متا تگ توضیحات نیز استفاده می شود." class='col-md-6'>
                                                <div class="form-group" style="text-align:right">
                                                    <label style="width: 100%" align="right" for="subtitle">:خلاصه
                                                        مطلب</label>
                                                    <textarea style="border-radius: 3px;resize: vertical;text-align:right"
                                                              class="form-control" rows="8" id="subtitle"
                                                              name="subtitle"></textarea>
                                                </div>
                                            </div>

                                            <div class='col-md-6'>

                                                <div data-intro="چنانچه مطبی که منتشر می کنید از جای دیگری استفاده کرده اید می توانید لینک آن را در این بخش بنویسید." class='col-md-12'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="linkSource">:لینک منبع مطلب</label>
                                                        <input style="border-radius: 3px;text-align:left" type="text"
                                                               class="form-control" id="linkSource" name="linkSource">
                                                    </div>
                                                </div>

                                                <div data-intro="از بین دسته بندی های موجود می بایست یک دسته بندی را انتخاب نمایید. برای افزودن یا ویرایش دسته بندی ها می توانید از بخش دسته بندی اقدام نمایید." class='col-md-12'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="suggestion">:پیشنهاد سردبیر</label>
                                                        <select id="suggestion" name="suggestion" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" required>
                                                            <option value="1">بله</option>
                                                            <option value="0">خیر</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class='row'>
                                            <div data-intro="با تایپ بخشی از عنوان مطلب مورد نظر میتوانید آن را از لیست انتخاب نمایید و چنانچه مطلبی انتخاب نکنید مطالب مرتبط به صورت تصادفی براساس دسته بندی نمایش داده خواهد شد." class='col-md-12'>
                                                <div class="form-group" style="text-align:right">
                                                    <label style="direction: rtl;" for="related_post">
                                                        مطالب مرتبط:
                                                    </label>
                                                    <select id="related_post" name="related_post[]"
                                                            class="form-control select2Class"
                                                            style="width: 100%;direction: ltr;"
                                                            multiple="multiple">
                                                        <?php
                                                        $blog = $data['RelatedBlog'];
                                                        foreach ($blog as $new) {
                                                            ?>
                                                            <option value="<?= $new['n_id']; ?>"><?= $new['title']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_1">
                                <div class="box-body">
                                    <div class="section-content">
                                        <div class="card">
                                            <div class="font-weight-bold"style="margin-bottom: 25px;">
                                                توضیحات سئو صفحه مطلب
                                            </div>
                                            <div class="card-body">
                                                <div class='col-md-4'>
                                                    <div class="form-group" style="text-align:right">
                                                        <label for="mainKeyword">:کلمه کلیدی اصلی</label>
                                                        <input style="border-radius: 3px;text-align:right" type="text" class="form-control" id="mainKeyword" name="mainKeyword">
                                                    </div>
                                                </div>

                                                <div data-step="3" data-intro="می توانید کلمه کلیدی را از لیست پیشنهادی انتخاب و یا تایپ کنید<br/>با انتخاب از لیست پیشنهادی کلمه های کلیدی نیز به شما پیشنهاد داده می شود." class="col-md-8">
                                                    <div class="form-group" style="text-align:right">
                                                        <label style="direction: rtl;" for="tags">
                                                            <a style="color: #3d3d3d" title="با تایپ کلمه مورد نظر میتوانید آن را از لیست انتخاب و یا به لیست اضافه نمایید.">
                                                                <i style="margin-left: 5px" class="fa fa-question-circle"></i>
                                                            </a>
                                                            کلمات کلیدی فرعی:
                                                        </label>

                                                        <select id="tags" multiple="multiple" name="tags" class="form-control select2" style="width: 100%;direction: ltr;text-align: start;unicode-bidi: plaintext;">
                                                            <?php foreach($data['tag'] as $tag){ ?>
                                                                <option data-id="<?= $tag['t_id'] ?>" value="<?= $tag['tag'] ?>">
                                                                    <?= $tag['tag'] ?>
                                                                </option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class='col-md-12'>
                                                    <div class="form-group">
                                                        <label>عنوان</label>
                                                        <input type="text" id="seo_title" name="seo_title" class="form-control">
                                                    </div>
                                                </div>

                                                <div class='col-md-12'>
                                                    <div class="form-group">
                                                        <label>توضیحات (حداکثر 150 کاراکتر)</label>
                                                        <textarea maxlength="150" class="form-control" id="seo_desc" name="seo_desc" rows="3" placeholder="توضیحی درج نمایید..."></textarea>
                                                    </div>
                                                </div>

                                                <hr/>

                                                <div class="col-md-12 seo-box">
                                                    <a href="#" target="_blank" class="seo-title" id="preview_seo_title"></a>
                                                    <a href="#" target="_blank" class="link" id="preview_seo_link"><?= URL ?>blog/article/...</a>
                                                    <div style="direction: rtl;">
                                                        <span class="date"><?= jdate("j F Y"); ?> -</span>
                                                        <span class="seo-description" id="preview_seo_desc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-md-3">

                    <div class="box box-info">
                        <!-- /.box-header -->
                        <div class="box-body text-center">
                            <div class="box-header with-border">
                                <h3 class="box-title">انتشار</h3>
                            </div>
                            <a data-intro="بعد از تکمیل موارد می توانید برای ذخیره مطلب از این دکمه استفاده نمایید." id="btnsubmit" name="btnsubmit" class="btn btn-app mt-5">
                                <i class="fa fa-save"></i> ذخیره
                            </a>
                            <div data-intro="وضعیت مطلب را می توانید از این بخش انتخاب نمایید. با انتخاب گزینه فعال مطلب در سایت نمایش داده خواهد شد و گزینه غیرفعال مطلب به صورت پیش نویس ذخیره می شود." class="form-group text-right">
                                <label>وضعیت</label>
                                <select class="form-control" id="status" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="1">فعال</option>
                                    <option value="0">غیرفعال</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div data-intro="در این بخش عکس کاور مطلب را می توانید انتخاب نمایید. تا حد امکان سعی کنید که حجم تصویر زیاد نباشد تا باعث کند شدن لود صفحه نگردد." class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">تصویر بند انگشتی</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="file-upload">
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type="file" id="cover" name="cover" onchange="readURL(this);" accept="image/*">
                                <div class="drag-text">
                                    <h5 class=" text-center">عکس مورد نظر را انتخاب کنید</h5>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" alt="your image">
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
<script src="public/panel/plugins/ckeditor4-major/ckeditor.js"></script>
<script src="http://editor.highcharts.com/integrations/ckeditor.js" type="text/javascript" charset="utf-8"></script>

<script>
    CKEDITOR.replace('desc',
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#subtitle").keypress(function(event) {
            if (event.which == 13) {
                var s = $(this).val();
                $(this).val(s+"<br/>");  //\t for tab
            }
        });
    });
</script>

<script>
    function toggle(className, obj) {
        var $input = $(obj);
        if ($input.prop('checked')) $(className).show();
        else $(className).hide();
    }

    $(function () {
        $("#tags").select2({
            placeholder: "انتخاب نمایید...",
            allowClear: true,
            tags: true
        });
    });
</script>

<script>
    $("#edit-url").change(function () {
        if (this.checked) {
            $("#edit-url-manual").show();
        } else {
            $("#edit-url-manual").hide();
        }
    });
</script>

<script>
    $(function(){
        //  For title
        $("#seo_title").keyup( function(){
            var seo_title = $(this).val();
            $("#preview_seo_title").html(seo_title);
        });
        $("#title").keyup( function(){
            var article_title = $(this).val();
            $("#seo_title").val(article_title);
            $("#preview_seo_title").html(article_title);
            $("#url").val(article_title.replace(/ /g,"-"));
            $("#preview_seo_link").html("<?= URL ?>blog/article/"+article_title.replace(/ /g,"-"));
            $("#preview_seo_link").attr("href", "<?= URL ?>blog/article/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_title").attr("href", "<?= URL ?>blog/article/"+$(this).val().replace(/ /g,"-"));
        });

        $("#url").keyup( function(){
            $("#preview_seo_link").html("<?= URL ?>blog/article/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_link").attr("href", "<?= URL ?>blog/article/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_title").attr("href", "<?= URL ?>blog/article/"+$(this).val().replace(/ /g,"-"));
        });

        //  For Decriptions
        $("#seo_desc").keyup( function(){
            var seo_desc = $(this).val();
            $("#preview_seo_desc").html(seo_desc);
        });
    })
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var url = document.getElementById("url").value;
        var category = document.getElementById("category").value;
        var suggestion = document.getElementById("suggestion").value;
        var source = document.getElementById("source").value;
        var desc = CKEDITOR.instances['desc'].getData();
        var subtitle = document.getElementById("subtitle").value;
        var linkSource = document.getElementById("linkSource").value;
        var mainKeyword = document.getElementById("mainKeyword").value;
        var seo_title = document.getElementById("seo_title").value;
        var seo_desc = document.getElementById("seo_desc").value;
        var status = document.getElementById("status").value;
        var tags = $('#tags').val();
        var related_post = $('#related_post').val();
        var coverPost = document.getElementById("cover");
        var cover = coverPost.files[0];

        if (title == "") {
            $.wnoty({type: 'error', message: 'عنوان مطلب را وارد کنید.'});
        } else if (url == "") {
            $.wnoty({type: 'error', message: 'پیوند مطلب را وارد کنید.'});
        } else if (mainKeyword == "") {
            $.wnoty({type: 'error', message: 'کلمه کلیدی اصلی را وارد کنید.'});
        } else if (seo_title == "") {
            $.wnoty({type: 'error', message: 'عنوان سئو را وارد کنید.'});
        } else if (seo_desc == "") {
            $.wnoty({type: 'error', message: 'توضیحات سئو را وارد کنید.'});
        } else {
            var formData = new FormData();
            formData.append("title", title);
            formData.append("url", url);
            formData.append("category", category);
            formData.append("suggestion", suggestion);
            formData.append("source", source);
            formData.append("desc", desc);
            formData.append("subtitle", subtitle);
            formData.append("linkSource", linkSource);
            formData.append("mainKeyword", mainKeyword);
            formData.append("tags", tags);
            formData.append("related_post", related_post);
            formData.append("status", status);
            formData.append("seo_title", seo_title);
            formData.append("seo_desc", seo_desc);
            formData.append("cover", cover);

            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addBlog",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});

                        if (data.status == "ok") {
                            window.location.href = '<?= ADMIN_PATH; ?>/blog';
                        }
                    }
                });
            } else {
                $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان افزودن وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>