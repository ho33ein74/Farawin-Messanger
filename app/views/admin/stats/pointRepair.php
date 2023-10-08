<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>امتیازهای ثبت شده | <?= $data['getPublicInfo']['site']; ?></title>
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
                <small>امتیازهای ثبت شده</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/stats"><i class="fa fa-bar-chart"></i> Stats</a></li>
                <li class="active">Repair Point</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">امتیازهای ثبت شده</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table direction table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="priority-1" style="text-align:center;width: 40px">ردیف</th>
                                    <th class="priority-1" style="text-align:center">نام کاربر</th>
                                    <th class="priority-1" style="text-align:center;">شماره سفارش</th>
                                    <th class="priority-1" style="text-align:center;">پنل سفارش</th>
                                    <th class="priority-1" style="text-align:center;">سرعت پاسخگویی</th>
                                    <th class="priority-1" style="text-align:center;">اطلاع رسانی</th>
                                    <th class="priority-1" style="text-align:center;">کیفیت</th>
                                    <th class="priority-1" style="text-align:center;">قیمت</th>
                                    <th class="priority-1" style="text-align:center;">زمان</th>
                                    <th class="priority-1" style="text-align:center;">تحویل و دریافت</th>
                                    <th class="priority-1" style="text-align:center;">نحوه برخورد اعضا</th>
                                    <th class="priority-1" style="text-align:center;">میانگین امتیاز</th>
                                    <th class="priority-1" style="text-align:center;">تاریخ ثبت</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                $points = $data['getPoint'];
                                foreach ($points as $point) {
                                    ?>
                                    <tr id="co-row-<?= $point['pr_id']; ?>">
                                        <td class="priority-1" style="text-align:center;vertical-align: middle"><?= $i; ?></td>
                                        <td class="priority-1" style="text-align:center;vertical-align: middle"><a target="_blank" href="<?= ADMIN_PATH; ?>/users/view/<?= $point['customer_vids_id']; ?>"><?= $point['c_name']; ?></a></td>
                                        <td class="priority-1" style="text-align:center;vertical-align: middle"><a target="_blank" href="<?= ADMIN_PATH; ?>/orders/v/<?= $point['order_vids_id']; ?>"><?= $point['order_vids_id']; ?></a></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q1']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q2']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q3']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q4']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q5']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q6']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q7']; ?></td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_q8']; ?></td>
                                        <td class="priority-1" style="text-align:center;vertical-align: middle">
                                            <?= round(array_sum(array($point['pr_q1'], $point['pr_q2'], $point['pr_q3'], $point['pr_q4'], $point['pr_q5'], $point['pr_q6'], $point['pr_q7'], $point['pr_q8'])) / 8,2); ?>
                                        </td>
                                        <td class="priority-2" style="text-align:center;vertical-align: middle"><?= $point['pr_date_created']; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="priority-1" style="text-align:center;width: 40px">ردیف</th>
                                    <th class="priority-1" style="text-align:center">نام کاربر</th>
                                    <th class="priority-1" style="text-align:center;">شماره سفارش</th>
                                    <th class="priority-1" style="text-align:center;">پنل سفارش</th>
                                    <th class="priority-1" style="text-align:center;">سرعت پاسخگویی</th>
                                    <th class="priority-1" style="text-align:center;">اطلاع رسانی</th>
                                    <th class="priority-1" style="text-align:center;">کیفیت</th>
                                    <th class="priority-1" style="text-align:center;">قیمت</th>
                                    <th class="priority-1" style="text-align:center;">زمان</th>
                                    <th class="priority-1" style="text-align:center;">تحویل و دریافت</th>
                                    <th class="priority-1" style="text-align:center;">نحوه برخورد اعضا</th>
                                    <th class="priority-1" style="text-align:center;">میانگین امتیاز</th>
                                    <th class="priority-1" style="text-align:center;">تاریخ ثبت</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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

<script>
    $(function () {
        $('#example1 tfoot th').each(function () {
            var title = $(this).text();
            if (title == "ردیف") {
                $(this).html('-');
            } else {
                $(this).html('<input style="text-align: start;unicode-bidi: plaintext;" type="text" placeholder="' + title + '" />');
            }
        });

        var table = $('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "stateSave": true,
            "pageLength": 10,
            "autoWidth": true
        });

        table.columns().every(function () {
            var column = this;
            $('input', this.footer()).on('keyup change', function () {
                if (column.search() !== this.value) {
                    column.search(this.value).draw();
                }
            });
        });

        table.column(3).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(4).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(5).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(6).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(7).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(8).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(9).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        table.column(10).every( function () {
            var column = this;
            var select = $('<select><option value="0" disabled="" selected="" hidden="">انتخاب امتیاز</option><option value="">همه موارد</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>')
            });
        });

        $('#example1 tfoot tr').appendTo('#example1 thead');
    });
</script>

</body>
</html>
