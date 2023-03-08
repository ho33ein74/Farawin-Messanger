<!DOCTYPE html>
<html>
<head>
    <base href="<?= URL; ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>تقویم کاری | <?= $data['getPublicInfo']['site']; ?></title>
    <!-- Favicon -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/admin/include/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/panel/plugins/fullcalendar/fullcalendar.css">
    <style>
        @media (max-width: 768px){
            .fc-header-toolbar {
                display: inline-block !important;
                float: none !important;
                text-align: center;
            }

            .fc .fc-toolbar-title {
                text-align: center;
                margin: 10px;
            }

            .fc .fc-col-header-cell-cushion {
                font-size: 10px;
            }
        }
    </style>
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
                <small>تقویم کاری</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= URL; ?><?= ADMIN_PATH; ?>/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Calendar</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
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
<script src='public/panel/plugins/fullcalendar/fullcalendar.js'></script>
<script src='public/panel/plugins/fullcalendar/locales-all.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var meta_name = "<?= $data['getPublicInfo']['csrf_token_name'] ?>";
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'today prevYear,prev,next,nextYear',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            footerToolbar: {
                left: '',
                center: '',
                right: ''
            },
            eventColor: 'green',
            dayPopoverFormat: { month: 'long', day: 'numeric', year: 'numeric' },
            locale: 'fa',
            buttonIcons: false, // show the prev/next text
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            drappable: false,
            displayEventTime: true,
            dayMaxEvents: true, // allow "more" link when too many events
            eventClick: function(arg) {
                // opens events in a popup window
                window.open(arg.event.url, '_blank', 'width=700,height=600');
                // prevents current tab from navigating
                arg.jsEvent.preventDefault();
            },
            eventSources: [
                {
                    url: '<?= ADMIN_PATH ?>/getAllEventsAjax',
                    method: 'POST',
                    failure: function() {
                        $.wnoty({type: 'error', message: 'وضعیت شما آفلاین می باشد و امکان دریافت نوبت ها وجود ندارد.'});
                    },
                }
            ]
        });

        calendar.render();
    });
</script>

</body>
</html>
