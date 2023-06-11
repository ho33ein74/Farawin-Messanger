<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نصب سیستم مدیریت رزرواسیون ونسا</title>
    <link href="../public/css/install/reset.css" rel="stylesheet">
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href='../public/css/install/bootstrap-select.min.css' rel='stylesheet' type='text/css'>
    <link href='../public/css/install/install.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../public/css/install/inter.css">
    <style>
        @font-face {
            font-family: "IRANSans";
            font-style: normal;
            font-weight: bold;
            src: url(../public/css/fonts/iransansweb_bold.eot);
            src: url(../public/css/fonts/iransansweb_bold.eot?#iefix)
               format("embedded-opentype"),
               url(../public/css/fonts/iransansweb_bold.woff2) format("woff2"),
               url(../public/css/fonts/iransansweb_bold.woff) format("woff"),
               url(../public/css/fonts/iransansweb_bold.ttf) format("truetype");
         }
         @font-face {
            font-family: "IRANSans";
            font-style: normal;
            font-weight: normal;
            src: url(../public/css/fonts/iransansweb.eot);
            src: url(../public/css/fonts/iransansweb.eot?#iefix) format("embedded-opentype"),
               url(../public/css/fonts/iransansweb.woff2) format("woff2"),
               url(../public/css/fonts/iransansweb.woff) format("woff"),
               url(../public/css/fonts/iransansweb.ttf) format("truetype");
         }
    body,
    html {
        font-size: 16px;
    }

    body {
        font-family: "IRANSans", serif !important;
        background: #f8fafc;
    }

    body>* {
        font-size: 14px;
    }
    .tw-absolute svg {
        transform: rotate(180deg);
    }
    </style>
</head>

<body>
    <div class="tw-max-w-4xl tw-w-full tw-mx-auto tw-my-6">
        <div class="logo tw-mt-5 tw-mb-5 tw-p-3 tw-inline-block tw-w-full">
            <img src="../public/images/logo.svg" class="tw-block tw-mx-auto" style="width: 30%">
        </div>

        <?php include('steps.php'); ?>
        <div class="tw-bg-white tw-rounded tw-px-4 tw-py-6 tw-border tw-border-solid tw-border-neutral-200">
            <?php if ($debug != '') { ?>
            <div class="sql-debug-alert alert alert-success">
                <?php echo $debug; ?>
            </div>
            <?php } ?>
            <?php if (isset($error) && $error != '') { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
            <?php } ?>
            <?php
                        if ($current_step == 1) {
                            include_once('requirements.php');
                        } elseif ($current_step == 2) {
                            include_once('file_permissions.php');
                        } elseif ($current_step == 3) {
                            include_once('database.php');
                        } elseif ($current_step == 4) {
                            include_once('install.php');
                        } elseif ($current_step == 5) {
                            include_once('finish.php');
                        }
                    ?>
        </div>
    </div>

    <script src='../public/js/jquery.min.js'></script>
    <script src='../public/js/bootstrap.min.js'></script>
    <script src='../public/js/bootstrap-select.min.js'></script>
    <script>
    $(function() {
        $('select').selectpicker();

        $('#installForm').on('submit', function(e) {
            $('#installBtn').prop('disabled', true);
            $('#installBtn').text('لطفا منتظر بمانید ...');
        });

        setTimeout(function() {
            $('.sql-debug-alert').slideUp();
        }, 4000);
    });
    </script>
</body>

</html>