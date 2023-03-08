<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>افزودن خدمت جدید | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/panel/plugins/colorpicker/bootstrap-colorpicker.min.css">
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
                <small>افزودن خدمت جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/services"><i class="fa fa-hand-scissors-o"></i> Services</a></li>
                <li class="active">Add new service</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->

                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_0" data-toggle="tab" aria-expanded="true">خدمت</a></li>
                            <li><a href="#tab_1" data-toggle="tab" aria-expanded="false">سئو</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="box-body">
                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="fa_title">:عنوان خدمت</label>
                                            <input type="text" class="form-control" id="fa_title" name="fa_title" placeholder="عنوان خدمت را بنویسید...">
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label for="en_title">:عنوان خدمت (انگلیسی)</label>
                                            <input type="text" class="form-control text-left" id="en_title" name="en_title" placeholder="Write the product title..." style="direction: ltr;">
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <label for="recovery_times">:دفعات مورد نیاز برای ترمیم</label>
                                            <div class="input-group" id="extra_amount_percentID">
                                                <input style="border-radius: 0 3px 3px 0;text-align: start;unicode-bidi: plaintext;direction: ltr" placeholder="دفعات ترمیم را بنویسید" type="text" class="form-control" id="recovery_times" name="recovery_times" min="0" max="100" required="">
                                                <span style="border-radius: 3px 0 0 3px;" class="input-group-addon">جلسه</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <label for="avg_time_to_do">:میانگین زمان انجام</label>
                                            <input type="text" class="form-control text-right" id="avg_time_to_do" name="avg_time_to_do"  placeholder="میانگین زمان انجام را بنویسید به طور مثال 30 دقیقه" style="direction: rtl;">
                                        </div>
                                    </div>

                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <label for="durability">:مدت زمان ماندگاری</label>
                                            <input type="text" class="form-control text-right" id="durability" name="durability"  placeholder="مدت زمان ماندگاری را بنویسید به طور مثال بیش از 3 سال" style="direction: rtl;">
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" name="edit-url" id="edit-url">
                                                <label class="mt-1 mr-3" for="edit-url">مایل به اصلاح دستی لینک خدمت هستید؟</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group" style="display: none;" id="edit-url-manual">
                                            <label>پیوند خدمت (لینک)</label>
                                            <input type="text" class="form-control" id="url" name="url" placeholder="لینک را بنویسید...">
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>:توضیحات خدمت</label>
                                            <textarea id="description" name="description" placeholder="شرح خدمت خود را بنویسید..."></textarea>
                                        </div>
                                    </div>

                                    <div class='col-md-12'>
                                        <div class="form-group">
                                            <label>:توضیحات در مورد جلسات ترمیم</label>
                                            <textarea id="recovery_times_desc" name="recovery_times_desc" placeholder="شرح جلسات ترمیم خود را بنویسید..."></textarea>
                                        </div>
                                    </div>

                                    <div data-intro="با تایپ بخشی از عنوان مطلب مورد نظر میتوانید آن را از لیست انتخاب نمایید." class='col-md-12'>
                                        <div class="form-group" style="text-align:right">
                                            <label style="direction: rtl;" for="related_post">
                                                مطالب مرتبط وبلاگ:
                                            </label>
                                            <select id="related_post" name="related_post[]" class="form-control select2Class" style="width: 100%;direction: ltr;" multiple="multiple">
                                                <?php foreach ($data['RelatedBlog'] as $item) { ?>
                                                    <option value="<?= $item['n_id']; ?>"><?= $item['title']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>

                            <div class="tab-pane" id="tab_1">
                                <div class="box-body">
                                    <div class="section-content">
                                        <div class="card">
                                            <div class="font-weight-bold"style="margin-bottom: 25px;">
                                                توضیحات سئو صفحه خدمت
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
                                                    <a href="#" target="_blank" class="link" id="preview_seo_link"><?= URL ?>services/...</a>
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
                                <h3 class="box-title">مدیریت</h3>
                            </div>
                            <a data-intro="بعد از تکمیل موارد می توانید برای ذخیره خدمت از این دکمه استفاده نمایید." id="btnsubmit" name="btnsubmit" class="btn btn-app mt-5">
                                <i class="fa fa-save"></i> ذخیره
                            </a>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">وضعیت خدمت</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control select2Class" style="width: 100%;">
                                    <option value="0">غیرفعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">رنگ پس زمینه خدمت در تقویم کاری</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input style="direction: ltr;border-radius: 0 3px 3px 0;text-align:left" type="text" value="#ff0000" class="form-control my-colorpicker1" id="calendar_background_color" name="calendar_background_color" required>
                                    <span style="border-radius: 3px 0 0 3px" class="input-group-addon"><i class="fa fa-tint"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-intro="در این بخش عکس کاور خدمت را می توانید انتخاب نمایید. تا حد امکان سعی کنید که حجم تصویر زیاد نباشد تا باعث کند شدن لود صفحه نگردد." class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">تصویر بند انگشتی</h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="file-upload">
                            <p class="text-center">سایز مناسب 315*600</p>
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
<script src="public/panel/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<script>
    $('.my-colorpicker1').colorpicker();
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
    $("#en_title").keypress(function(event){
        var ew = event.which;
        if(ew == 32) return true;
        if(ew == 45) return true;
        if(48 <= ew && ew <= 57) return true;
        if(65 <= ew && ew <= 90) return true;
        if(97 <= ew && ew <= 122) return true;
        return false;
    });
</script>

<script>
    $(function(){
        //  For title
        $("#seo_title").keyup( function(){
            var seo_title = $(this).val();
            $("#preview_seo_title").html(seo_title);
        });
        $("#fa_title").keyup( function(){
            var product_title = $(this).val();
            $("#seo_title").val(product_title);
            $("#preview_seo_title").html(product_title);
            $("#url").val(product_title.replace(/ /g,"-"));
            $("#preview_seo_link").html("<?= URL ?>services/"+product_title.replace(/ /g,"-"));
            $("#preview_seo_link").attr("href", "<?= URL ?>services/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_title").attr("href", "<?= URL ?>services/"+$(this).val().replace(/ /g,"-"));
        });

        $("#url").keyup( function(){
            $("#preview_seo_link").html("<?= URL ?>services/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_link").attr("href", "<?= URL ?>services/"+$(this).val().replace(/ /g,"-"));
            $("#preview_seo_title").attr("href", "<?= URL ?>services/"+$(this).val().replace(/ /g,"-"));
        });

        //  For Decriptions
        $("#seo_desc").keyup( function(){
            var seo_desc = $(this).val();
            $("#preview_seo_desc").html(seo_desc);
        });
    })
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
    CKEDITOR.replace('description',
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
    CKEDITOR.replace('recovery_times_desc',
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
        var fa_title = document.getElementById("fa_title").value;
        var en_title = document.getElementById("en_title").value;
        var recovery_times = document.getElementById("recovery_times").value;
        var avg_time_to_do = document.getElementById("avg_time_to_do").value;
        var durability = document.getElementById("durability").value;
        var url = document.getElementById("url").value;
        var description = CKEDITOR.instances['description'].getData();
        var related_post = $('#related_post').val();
        var recovery_times_desc = CKEDITOR.instances['recovery_times_desc'].getData();
        var mainKeyword = document.getElementById("mainKeyword").value;
        var tags = $('#tags').val();
        var seo_title = document.getElementById("seo_title").value;
        var seo_desc = document.getElementById("seo_desc").value;
        var status = document.getElementById("status").value;
        var calendar_background_color = document.getElementById("calendar_background_color").value;
        var coverPost = document.getElementById("cover");
        var cover = coverPost.files[0];

        if (fa_title == "") {
            $.wnoty({type: 'error', message: 'عنوان خدمت را وارد کنید.'});
        } else if (en_title == "") {
            $.wnoty({type: 'error', message: 'عنوان انگلیسی خدمت را وارد کنید.'});
        } else if (recovery_times == "") {
            $.wnoty({type: 'error', message: 'تعداد دفعات مورد نیاز برای ترمیم خدمت را وارد کنید.'});
        } else if (avg_time_to_do == "") {
            $.wnoty({type: 'error', message: 'میانگین زمان برای انجام خدمت را وارد کنید.'});
        } else if (durability == "") {
            $.wnoty({type: 'error', message: 'مدت زمان ماندگاری برای انجام خدمت را وارد کنید.'});
        } else if (url == "") {
            $.wnoty({type: 'error', message: 'پیوند خدمت را وارد کنید.'});
        } else if (mainKeyword == "") {
            $.wnoty({type: 'error', message: 'کلمه کلیدی اصلی را وارد کنید.'});
        } else if (seo_title == "") {
            $.wnoty({type: 'error', message: 'عنوان سئو را وارد کنید.'});
        } else if (seo_desc == "") {
            $.wnoty({type: 'error', message: 'توضیحات سئو را وارد کنید.'});
        } else {
            var formData = new FormData();
            formData.append("fa_title", fa_title);
            formData.append("en_title", en_title);
            formData.append("recovery_times", recovery_times);
            formData.append("avg_time_to_do", avg_time_to_do);
            formData.append("durability", durability);
            formData.append("url", url);
            formData.append("description", description);
            formData.append("related_post", related_post);
            formData.append("recovery_times_desc", recovery_times_desc);
            formData.append("mainKeyword", mainKeyword);
            formData.append("tags", tags);
            formData.append("seo_title", seo_title);
            formData.append("seo_desc", seo_desc);
            formData.append("status", status);
            formData.append("calendar_background_color", calendar_background_color);
            formData.append("cover", cover);
            if (navigator.onLine) {
                $.ajax({
                    url: "<?= ADMIN_PATH; ?>/addServices",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);
                        $.wnoty({type: data.noty_type, message: data.msg});
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
