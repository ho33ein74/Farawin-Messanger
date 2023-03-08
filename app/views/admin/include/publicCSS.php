<meta name="<?= $data['getPublicInfo']['csrf_token_name'] ?>" content="<?= $data['csrf_token_hash'] ?>">
<meta name="admin_route" content="<?= ADMIN_PATH; ?>">

<link href="public/css/pace-theme-flash.css" rel="stylesheet"/>
<link rel="stylesheet" href="public/panel/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="public/css/font-awesome.min.css">
<link rel="stylesheet" href="public/panel/plugins/select2/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="public/panel/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="public/panel/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="public/panel/plugins/iCheck/flat/blue.css">

<link rel="stylesheet" href="public/panel/plugins/datatables/media/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="public/panel/plugins/datatables/media/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="public/panel/plugins/datatables/media/css/fixedHeader.dataTables.css">
<link rel="stylesheet" href="public/panel/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="public/css/animate.min.css">
<link href="public/css/emoji.css" rel="stylesheet">
<link rel="stylesheet" href="public/library/offlinealert/themes/offline-theme-default-indicator.css"/>
<link rel="stylesheet" href="public/library/offlinealert/themes/offline-language-persian.css"/>

<link rel="stylesheet" href="public/panel/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<link rel="stylesheet" href="public/panel/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link rel="stylesheet" href="public/panel/plugins/pwt.datepicker-master/dist/css/persian-datepicker.css"/>
<link href="public/library/intro.js-2.9.3/introjs.css" rel="stylesheet">
<link href="public/library/intro.js-2.9.3/introjs-rtl.css" rel="stylesheet">
<link href="public/css/wnoty.css" rel="stylesheet">

<style>
    .dataTables_paginate{
        text-align: center !important;
        display: list-item;
    }
    @media screen and (max-width: 767px){
        .dataTables_paginate {
            padding-top: 15%;
            padding-bottom: 7%;
        }
        .pagination {
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: stretch;
            align-content: space-around;
            flex-wrap: wrap;
            flex-direction: row;
            position: absolute;
            margin-bottom: 40px !important;
        }
        div.dt-buttons {
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-evenly;
            align-items: flex-start;
            flex-wrap: nowrap;
            flex-direction: row-reverse;
            position: absolute;
            margin-top: 55px;
        }
    }

    .dataTables_info{
        position: absolute;
        float: left;
        text-align: left;
        left: 13px;
    }

    .dataTables_length{
        position: absolute;
    }

    thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
        border-radius: 3px;
        height: 34px;
        border: 1px solid #ccc;
        font-size: 12px;
    }

    thead select {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
        border-radius: 3px;
        border: 1px solid #ccc;
        font-size: 12px;
    }

    @media (max-width: 767px) {
        div.dataTables_wrapper div.dataTables_info {
            padding-bottom: 8px;
            margin-left: 15px;
        }
        .dataTables_length {
            margin-right: 10px;
        }
    }

    .txt-right{
        text-align: right !important;
    }

    .colorpicker{
        z-index: 99999999999999 !important;
    }
</style>