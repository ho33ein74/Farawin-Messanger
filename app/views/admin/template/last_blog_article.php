<div data-intro="<?= $help['t_help_txt'] ?>" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">آخرین مطالب وبلاگ</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->

    <?php if (sizeof($latestNews) > 0) { ?>
        <div class="box-body direction">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr>
                        <th style="text-align: center;">عنوان مطلب</th>
                        <th style="text-align: center;">دسته بندی</th>
                        <th style="text-align: center;">تاریخ ثبت</th>
                        <th style="text-align: center;">وضعیت</th>
                        <th style="text-align: center;">عملیات</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($latestNews as $order_data) { ?>
                            <tr>
                                <td>
                                    <?php if ($check_admin_permission) { ?>
                                        <p title="<?= $order_data['title']; ?>"><?= Model::summary($order_data['title'], 80); ?></p>
                                    <?php } else { ?>
                                        ---
                                    <?php } ?>
                                </td>
                                <td style="text-align: center;vertical-align: middle">
                                    <?php if ($check_admin_permission) { ?>
                                        <a target="_blank" title="<?= $order_data['name']; ?>" href="<?= URL; ?>blog/category/<?= $order_data['link']; ?>"><?= $order_data['name']; ?></a>
                                    <?php } else { ?>
                                        ---
                                    <?php } ?>
                                </td>
                                <td style="text-align: center;vertical-align: middle">
                                    <?php if ($check_admin_permission) { ?>
                                        <?= $order_data['date_created']; ?>
                                    <?php } else { ?>
                                        ---
                                    <?php } ?>
                                </td>
                                <td style="text-align:center;vertical-align: middle">
                                    <?php if ($check_admin_permission) { ?>
                                        <?php if ($order_data['b_status'] == 1) { ?>
                                            <button data-toggle="modal"
                                                    data-target="#status-Modal"
                                                    id="btn-status-blog-<?= $order_data['n_id']; ?>"
                                                    data-id="<?= $order_data['n_id']; ?>"
                                                    class="btn btn-success btn-xs">فعال</i>
                                            </button>
                                        <?php } else { ?>
                                            <button data-toggle="modal"
                                                    data-target="#status-Modal"
                                                    id="btn-status-blog-<?= $order_data['n_id']; ?>"
                                                    data-id="<?= $order_data['n_id']; ?>"
                                                    class="btn btn-danger btn-xs">غیرفعال</i>
                                            </button>
                                        <?php } ?>
                                    <?php } else { ?>
                                        ---
                                    <?php } ?>
                                </td>
                                <td style="text-align:center;vertical-align: middle">
                                    <?php if ($check_admin_permission) { ?>
                                        <?php if ($order_data['b_status'] == 1) { ?>
                                            <a class="btn btn-success btn-xs" target="_blank"
                                               href="<?= URL; ?>blog/article/<?= $order_data['slug']; ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a class="btn btn-success btn-xs" target="_blank"
                                               href="<?= URL; ?>blog/demo/<?= $order_data['slug']; ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        <?php } ?>
                                        <a class="btn btn-warning btn-xs"
                                           href="<?= ADMIN_PATH; ?>/blog/edit/<?= $order_data['n_id']; ?>">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <button data-toggle="modal"
                                                data-target="#telegram-Modal"
                                                id="btn-send-telegram-<?= $order_data['n_id']; ?>"
                                                data-id="<?= $order_data['n_id']; ?>"
                                                class="btn btn-info btn-xs"><i class="fa fa-paper-plane"></i>
                                        </button>
                                    <?php } else { ?>
                                        ---
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <a href="<?= ADMIN_PATH; ?>/blog" class="btn btn-sm btn-default btn-flat pull-left">مشاهده همه</a>
        </div>
    <?php } else { ?>
        <div class="text-center" style="padding-bottom: 10px !important;padding-top: 10px !important;direction: rtl">
            متاسفانه در حال حاضر مطلبی ثبت نشده است!
        </div>
    <?php } ?>
    <!-- /.box-footer -->


    <?php if (!$check_admin_permission) { ?>
        <div class="overlay" style="background: rgba(255,255,255,.8);">
            <p style="display: flex;justify-content: center;align-items: center;height: 100%;">متاسفانه به اطلاعات این بخش دسترسی ندارید</p>
        </div>
    <?php } ?>
</div>

<div dir="rtl" class="modal fade" id="telegram-Modal" role="dialog">
    <div class="modal-dialog" style="width: 300px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="color: #fff;background: #2484c6;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">ارسال پست در تلگرام</h4>
            </div>
            <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                    <p class="email-wrap">
                        <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                            از ارسال این پست در کانال تلگرام اطمینان دارید؟</label>
                        <input id="telegram-val" type="hidden" value="#"/>
                    </p>
                    <div class="row" style="margin-right: 0;margin-left: 15px;">
                        <div class="sign-up-inside-login">
                            <button id="send-telegram-submit" class="btn btn-success">ارسال</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"
                 style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                <span>با ارسال خبر تصویر، عنوان و خلاصه خبر در کانال تلگرام ارسال میشود.</span>
            </div>
        </div>
    </div>
</div>

<div dir="rtl" class="modal fade" id="status-Modal" role="dialog">
    <div class="modal-dialog" style="width: 300px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="color: #fff;background: #2484c6;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">تغییر وضعیت خبر</h4>
            </div>
            <div class="modal-body" style="padding: 0 15px;text-align: right;text-align: right;">
                <div id="form-regular-delete" class="login-fold" style="display: inline;block">
                    <p class="email-wrap">
                        <label style="font-size: .9em;color: #777;display: inline-block;margin-top: 10px;font-weight: 700;">آیا
                            از تغییر وضعیت این خبر اطمینان دارید؟</label>
                        <input id="status-val" type="hidden" value="#"/>
                    </p>
                    <div class="row" style="margin-right: 0;margin-left: 15px;">
                        <div class="sign-up-inside-login">
                            <button id="status-submit" class="btn btn-danger">ویرایش</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"
                 style="margin-top: 10px !important;font-size: .8em;background: #f8f8f8;padding: 15px;text-align: right;border-bottom: 1px solid #e5e5e5;">
                <span>در صورت فعال بودن، خبر در سایت نمایش داده خواهد شد.</span>
            </div>
        </div>
    </div>
</div>