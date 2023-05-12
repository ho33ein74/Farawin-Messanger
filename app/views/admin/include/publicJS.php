<script src="public/panel/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/panel/plugins/select2/select2.full.min.js"></script>
<script src="public/panel/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="public/panel/plugins/fastclick/fastclick.js"></script>
<script src="public/panel/dist/js/app.min.js"></script>
<script src="public/panel/dist/js/skin.js"></script>
<script src="public/library/offlinealert/offline.min.js"></script>
<script src="public/js/pace.min.js"></script>
<script src="public/panel/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="public/panel/plugins/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script src="public/panel/plugins/datatables/media/js/dataTables.fixedHeader.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js"></script>
<script src="public/panel/plugins/datatables/extensions/Buttons/js/jszip.min.js"></script>
<script type="text/javascript" src="public/library/intro.js-2.9.3/intro.js"></script>
<script src="public/js/wnoty.js"></script>
<script src="public/panel/plugins/pwt.datepicker-master/dist/js/persian-date.js"></script>
<script src="public/panel/plugins/pwt.datepicker-master/dist/js/persian-datepicker.js"></script>
<script src="public/js/checkOnline.js"></script>
<?php if ($data['getPublicInfo']['offline_mode'] == 1) { ?>
    <script src="public/js/serviceWorker.js"></script>
<?php } else { ?>
    <script src="public/js/serviceWorkerRemove.js"></script>
<?php } ?>
<script src="public/js/public-js.js"></script>

<script>
    // ajax init method
    $(document).ajaxStart(function () {
        Pace.restart();
    });

    var timeout_iter = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="<?= $data['getPublicInfo']['csrf_token_name'] ?>"]').attr('content')
        },
        timeout: 25000,
        error: function (xhr, status, error) {
            if (status == 'timeout') {
                timeout_iter++;
                if (timeout_iter <= 2) {
                    return;
                } else {
                    $.wnoty({type: 'warning', message: 'پاسخی از سرور دریافت نشد.'});
                }
            } else if (xhr.status == 500) {
                $.wnoty({type: 'warning', message: 'لطفا دوباره تلاش کنید.'});
            } else if (xhr.readyState == 0) {
                $.wnoty({type: 'warning', message: 'خطا در ارتباط اینترنتی لطفا دوباره تلاش کنید.'});
            }
        }
    });
</script>

<script>
    var run = function () {
        var req = new XMLHttpRequest();
        req.timeout = 1500;
        req.open('GET', '<?= URL ?><?= ADMIN_PATH ?>/dashboard', true);
        req.send();
    };
    setInterval(run, 50000);
</script>

<script>
    //for search menu box
    $(".search-menu-box").on('input', function () {
        var filter = $(this).val();
        $(".sidebar-menu > li").each(function () {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    // for sidebar menu entirely but not cover treeview
    url_check_for_edit_page = window.location.pathname.split('/');
    var url = location.protocol + "//" + location.host + "/" + url_check_for_edit_page[1] + "/" + url_check_for_edit_page[2];
    if (url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("-details")) {
        url = url + "/" + (url_check_for_edit_page[3]).replace("-details", "") + "/" + "list";
    } else if (
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("details") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("products")
    ) {
        url = url + "/" + "list";
    } else if (
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("edit") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("view") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("tariff") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("timing") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("widget-add") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("users") ||
        url_check_for_edit_page[3] && url_check_for_edit_page[3].includes("images")
    ) {
        url = url;
    } else {
        url = location.protocol + "//" + location.host + window.location.pathname.split('/').slice(0, 10).join('/');
    }

    $('ul.sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function () {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
</script>

<script>
    // public function
    $(function () {
        $(".select2Class").select2();
    });
</script>