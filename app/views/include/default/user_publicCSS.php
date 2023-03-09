<meta name="<?= $data['getPublicInfo']['csrf_token_name'] ?>" content="<?= $data['csrf_token_hash'] ?>">
<link rel="stylesheet" href="public/css/default/user.css"/>
<?php if($data['getPublicInfo']['float_contact'] == 1){ ?>
    <link rel="stylesheet" href="public/css/contactus.min.js.css"/>
<?php } ?>
<script src="public/js/default/darkMode.js"></script>
<script async src='public/js/default/api.js'></script>
