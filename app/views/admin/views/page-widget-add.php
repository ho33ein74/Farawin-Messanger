<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>افزودن ابزارک جدید | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link href="public/css/bootstrap-treeview.css" rel="stylesheet">
    <link href="public/css/select2totree.css" rel="stylesheet">
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
                <small>افزودن ابزارک جدید</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/pages"><i class="fa fa-clone"></i> Page</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/pages/edit/<?= $data['attrId'] ?>"><i class="fa fa-clone"></i> Edit Page</a></li>
                <li class="active">Add New Widget</li>
            </ol>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="margin" dir="ltr"></div>

            <div dir="rtl">
                <div class="row mx-0">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="box aside-create-user-page">
                            <div class="box-body pl-0">
                                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                    <?php $i=1; ?>
                                    <?php foreach($data['templates'] as $template){ ?>
                                        <li role="presentation" class="<?= $i==1 ? "active":""; ?>">
                                            <a href="#<?= $template['t_href'] ?>" role="tab" id="<?= $template['t_href'] ?>-tab" data-toggle="tab" aria-controls="<?= $template['t_href'] ?>" aria-expanded="<?= $i==1 ? "true":"false"; ?>">
                                                <?= $template['t_title'] ?>
                                            </a>
                                        </li>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="tab-content content-user-page mt-4" id="myTabContent">

                            <div class="tab-pane fade active in" role="tabpanel" id="<?= $data['templates']['0']['t_href'] ?>" aria-labelledby="<?= $data['templates']['0']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['0']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['0']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['0']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control valid" name="title" value="<?= $data['templates']['0']['t_title'] ?>" required="" aria-invalid="false">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control valid" aria-invalid="false">
                                                                                <option value="1" selected="">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-6">
                                                                            <div class="form-group">
                                                                                <label>اسلایدر نمایشی</label>
                                                                                <select class="form-control valid" name="options[number]" aria-invalid="false">
                                                                                    <?php foreach($data['slider'] as $slider){ ?>
                                                                                        <option value="<?= $slider['s_id'] ?>"><?= $slider['s_title'] ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>ترتیب نمایش</label>
                                                                                <select class="form-control valid" name="options[ordering]" aria-invalid="false">
                                                                                    <option value="asc">صعودی</option>
                                                                                    <option value="desc">نزولی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['1']['t_theme'] ?>/slider.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['0']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['1']['t_href'] ?>" aria-labelledby="<?= $data['templates']['1']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['1']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['1']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['1']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['1']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان</label>
                                                                                <input type="text" class="form-control" name="options[title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>وضعیت تخفیف</label>
                                                                                <select class="form-control" name="options[discount_type]" required="">
                                                                                    <option value="all">همه</option>
                                                                                    <option value="discount">تخفیف خورده</option>
                                                                                    <option value="nodiscount">بدون تخفیف</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نحوه نمایش</label>
                                                                                <select class="form-control" name="options[view_type]" required="">
                                                                                    <option value="slider" selected>اسلایدر</option>
                                                                                    <option value="item">ساده</option>
                                                                                    <option value="item2">ساده 2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نوع دوره</label>
                                                                                <select class="form-control" name="options[course_type]" required="">
                                                                                    <option value="all">همه</option>
                                                                                    <option value="1">حضوری</option>
                                                                                    <option value="2">غیرحضوری</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نوع مرتب سازی</label>
                                                                                <select class="form-control" name="options[sort_type]" required="">
                                                                                    <option value="latest">جدیدترین</option>
                                                                                    <option value="oldest">قدیمی ترین</option>
                                                                                    <option value="sell">پرفروش ترین</option>
                                                                                    <option value="view">پربازدید ترین</option>
                                                                                    <option value="cheapest">ارزانترین</option>
                                                                                    <option value="expensivest">گرانترین</option>
                                                                                    <option value="popularity">محبوب ترین</option>
                                                                                    <option value="rating">میانگین رتبه</option>
                                                                                    <option value="random">تصادفی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>لینک</label>
                                                                                <input type="text" class="form-control" name="options[link]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان لینک</label>
                                                                                <input type="text" class="form-control" name="options[link_title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>تعداد</label>
                                                                                <input type="number" class="form-control" name="options[number]" value="10" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class='col-md-7'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label>انتخاب دسته بندی ها (اختیاری)</label>
                                                                                <select style="width: 100%;" id="product-categories" name="options[categories][]" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" multiple>
                                                                                    <option value="0" disabled="" hidden="">انتخاب دسته بندی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>شامل دوره های زیر دسته ها</label>
                                                                                <select class="form-control" name="options[sub_category_products]">
                                                                                    <option value="1">بله</option>
                                                                                    <option value="0">خیر</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>نمایش به صورت ساده:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['1']['t_theme'] ?>/course-item.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p>نمایش به صورت ساده 2:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['1']['t_theme'] ?>/course-item2.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p class="mt-2">نمایش به صورت اسلایدر:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['1']['t_theme'] ?>/course-slider.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['1']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['2']['t_href'] ?>" aria-labelledby="<?= $data['templates']['2']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['2']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['2']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['2']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['2']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان</label>
                                                                                <input type="text" class="form-control" name="options[title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نوع مرتب سازی</label>
                                                                                <select class="form-control" name="options[sort_type]" required="">
                                                                                    <option value="latest">جدیدترین</option>
                                                                                    <option value="oldest">قدیمی ترین</option>
                                                                                    <option value="view">پربازدید ترین</option>
                                                                                    <option value="suggestion">پیشنهاد سردبیر</option>
                                                                                    <option value="mostComment">پر بحث ترین</option>
                                                                                    <option value="random">تصادفی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نحوه نمایش</label>
                                                                                <select class="form-control" name="options[view_type]" required="">
                                                                                    <option value="slider" selected>اسلایدر</option>
                                                                                    <option value="item2">ساده</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>لینک</label>
                                                                                <input type="text" class="form-control" name="options[link]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان لینک</label>
                                                                                <input type="text" class="form-control" name="options[link_title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>تعداد</label>
                                                                                <input type="number" class="form-control" name="options[number]" value="10" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>توضیحات</label>
                                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" name="options[description]"></textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class='col-md-7'>
                                                                            <div class="form-group" style="text-align:right">
                                                                                <label>انتخاب دسته بندی ها (اختیاری)</label>
                                                                                <select style="width: 100%;" id="blog-categories" name="options[categories][]" class="form-control" style="border-radius: 3px;width: 100%;direction: rtl" multiple>
                                                                                    <option value="0" disabled="" hidden="">انتخاب دسته بندی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>شامل مطالب زیر دسته ها</label>
                                                                                <select class="form-control" name="options[sub_category_products]">
                                                                                    <option value="1">بله</option>
                                                                                    <option value="0">خیر</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p style="display: none">نمایش به صورت ساده:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['2']['t_theme'] ?>/blog-item.jpg" alt="widget" class="w-100" style="display: none;width:100%">
                                                            <p>نمایش به صورت ساده 2:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['2']['t_theme'] ?>/blog-item2.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p class="mt-2">نمایش به صورت اسلایدر:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['2']['t_theme'] ?>/blog-slider.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['2']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['3']['t_href'] ?>" aria-labelledby="<?= $data['templates']['3']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['3']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['3']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['3']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['3']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان</label>
                                                                                <input type="text" class="form-control" name="options[title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نوع مرتب سازی</label>
                                                                                <select class="form-control" name="options[sort_type]" required="">
                                                                                    <option value="latest">جدیدترین</option>
                                                                                    <option value="oldest">قدیمی ترین</option>
                                                                                    <option value="view">پربازدید ترین</option>
                                                                                    <option value="random">تصادفی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>نحوه نمایش</label>
                                                                                <select class="form-control" name="options[view_type]" required="">
                                                                                    <option value="slider" selected>اسلایدر</option>
                                                                                    <option value="slider2">اسلایدر 2</option>
                                                                                    <option value="item">ساده</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>لینک</label>
                                                                                <input type="text" class="form-control" name="options[link]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان لینک</label>
                                                                                <input type="text" class="form-control" name="options[link_title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>تعداد</label>
                                                                                <input type="number" class="form-control" name="options[number]" value="10" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>توضیحات</label>
                                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" name="options[description]"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>نمایش به صورت ساده:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['3']['t_theme'] ?>/service-item.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p>نمایش به صورت اسلایدر:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['3']['t_theme'] ?>/service-slider.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p class="mt-2">نمایش به صورت اسلایدر 2:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['3']['t_theme'] ?>/service-slider2.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['3']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['4']['t_href'] ?>" aria-labelledby="<?= $data['templates']['4']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['4']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['4']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['4']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['4']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div><div id="template">
                                                                    <div class="row"><div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>بنر نمایشی</label>
                                                                                <select class="form-control valid" name="options[number]" aria-invalid="false">
                                                                                    <?php foreach($data['banners'] as $banner){ ?>
                                                                                        <?php
                                                                                        if($banner['b_type'] == 1){
                                                                                            $type = "تکی";
                                                                                        } else if($banner['b_type'] == 2){
                                                                                            $type = "2 تایی";
                                                                                        } else if($banner['b_type'] == 3){
                                                                                            $type = "3 تایی";
                                                                                        } else if($banner['b_type'] == 4){
                                                                                            $type = "4 تایی";
                                                                                        }
                                                                                        ?>
                                                                                        <option value="<?= $banner['b_id'] ?>"><?= $banner['b_title']." - ".$type ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>ترتیب نمایش</label>
                                                                                <select class="form-control valid" name="options[ordering]" aria-invalid="false">
                                                                                    <option value="asc">صعودی</option>
                                                                                    <option value="desc">نزولی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <p>نمایش بنر تک:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['4']['t_theme'] ?>/banner-1.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p>نمایش بنر 2 تایی:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['4']['t_theme'] ?>/banner-2.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p>نمایش بنر 3 تایی:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['4']['t_theme'] ?>/banner-3.jpg" alt="widget" class="w-100" style="width:100%">
                                                            <p>نمایش بنر 4 تایی:</p>
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['4']['t_theme'] ?>/banner-4.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['4']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['5']['t_href'] ?>" aria-labelledby="<?= $data['templates']['5']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['5']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['5']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['5']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['5']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>تعداد</label>
                                                                                <input type="number" class="form-control" name="options[number]" value="10" required="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>ترتیب نمایش</label>
                                                                                <select class="form-control valid" name="options[ordering]" aria-invalid="false">
                                                                                    <option value="asc">صعودی</option>
                                                                                    <option value="desc">نزولی</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان</label>
                                                                                <input type="text" class="form-control" name="options[title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>توضیحات</label>
                                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" name="options[description]"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['5']['t_theme'] ?>/comment.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['5']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['6']['t_href'] ?>" aria-labelledby="<?= $data['templates']['6']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['6']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['6']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['6']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['6']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-6">
                                                                            <div class="form-group">
                                                                                <label>لینک</label>
                                                                                <input type="text" class="form-control" name="options[link]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-6">
                                                                            <div class="form-group">
                                                                                <label>عنوان لینک</label>
                                                                                <input type="text" class="form-control" name="options[link_title]" value="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>توضیحات</label>
                                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" name="options[description]"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['6']['t_theme'] ?>/socialmedia.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['6']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" role="tabpanel" id="<?= $data['templates']['7']['t_href'] ?>" aria-labelledby="<?= $data['templates']['7']['t_href'] ?>-tab">
                                <form id="<?= $data['templates']['7']['t_href'] ?>Form" onsubmit="return false;">
                                    <input type="hidden" name="page_id" value="<?= $data['attrId'] ?>">
                                    <input type="hidden" name="template_id" value="<?= $data['templates']['7']['t_id'] ?>">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?= $data['templates']['7']['t_title'] ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <div id="main-card" class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان ابزارک</label>
                                                                            <input type="text" class="form-control" name="title" value="<?= $data['templates']['7']['t_title'] ?>" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>وضعیت</label>
                                                                            <select name="is_active" class="form-control">
                                                                                <option value="1">فعال</option>
                                                                                <option value="0">غیر فعال</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label>عنوان</label>
                                                                            <input type="text" class="form-control" name="options[title]" value="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>نحوه نمایش</label>
                                                                            <select class="form-control" name="options[view_type]" required="">
                                                                                <option value="item">ساده</option>
                                                                                <option value="item2">با دکمه ادامه مطلب</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="template">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>توضیحات</label>
                                                                                <textarea style="border-radius: 3px;resize: vertical;text-align:right" class="form-control" rows="4" name="options[description]"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img id="widget-image" src="public/images/template/<?= $data['templates']['7']['t_theme'] ?>/textarea-1.jpg" alt="widget" class="w-100" style="width:100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-step="2" data-intro="بعد از تکمیل فرم با استفاده از این دکمه می توانید اطلاعات را ثبت نمایید.<br/>فقط توجه داشته باشید که برای ثبت موفقیت آمیز اطلاعات حتما باید اینترنت شما وصل باشد." class="box-footer">
                                            <input onclick="widgetFormSubmit('<?= $data['templates']['7']['t_href'] ?>');" class="btn btn-dropbox" value="ثبت" type="submit">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
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
<script src="public/js/select2totree.js"></script>

<script>
    function formatState(state) {
        return state.text;
    };

    $("#product-categories").select2ToTree({
        matcher: function (params, data) {
            var original_matcher = $.fn.select2.defaults.defaults.matcher;
            var result = original_matcher(params, data);
            if (result && data.children && result.children && data.children.length != result.children.length) {
                result.children = data.children;
            }
            return result;
        }
    });

    $("#categories-list").select2ToTree({
        matcher: function (params, data) {
            var original_matcher = $.fn.select2.defaults.defaults.matcher;
            var result = original_matcher(params, data);
            if (result && data.children && result.children && data.children.length != result.children.length) {
                result.children = data.children;
            }
            return result;
        }
    });

    $("#blog-categories").select2ToTree({
        matcher: function (params, data) {
            var original_matcher = $.fn.select2.defaults.defaults.matcher;
            var result = original_matcher(params, data);
            if (result && data.children && result.children && data.children.length != result.children.length) {
                result.children = data.children;
            }
            return result;
        }
    });

    var myCategory = <?= json_encode($data['categoryChild']) ?>;
    $("#product-categories").select2ToTree({
        treeData: {
            dataArr: myCategory
        },
        // maximumSelectionLength: 1,
        templateResult: formatState,
        templateSelection: formatState
    });
    $("#categories-list").select2ToTree({
        treeData: {
            dataArr: myCategory
        },
        // maximumSelectionLength: 1,
        templateResult: formatState,
        templateSelection: formatState
    });

    var myCategoryBlog = <?= json_encode($data['categoryChildBlog']) ?>;
    $("#blog-categories").select2ToTree({
        treeData: {
            dataArr: myCategoryBlog
        },
        // maximumSelectionLength: 1,
        templateResult: formatState,
        templateSelection: formatState
    });
</script>

<script>
    widgetFormSubmit = function (template) {
        var data_form = $(document.getElementById(template + 'Form')).serialize();

        if (navigator.onLine) {
            $.ajax({
                url: "<?= ADMIN_PATH; ?>/addWidget",
                type: 'POST',
                data: data_form,
                success: function (data) {
                    data = JSON.parse(data);
                    $.wnoty({type: data.noty_type, message: data.msg});
                }
            });
        } else {
            $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
        }
    }
</script>

</body>
</html>