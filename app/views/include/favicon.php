<meta name="fontiran.com:license" content="EW8T7W"/>
<?php if($data['getPublicInfo']['site_public']=="index"){ ?>
    <meta name="robots" content="index, follow"/>
<?php } else { ?>
    <meta name='robots' content='noindex, nofollow' />
<?php } ?>
<link rel="apple-touch-icon" sizes="57x57" href="public/images/favicon/apple-icon-57x57.ico">
<link rel="apple-touch-icon" sizes="60x60" href="public/images/favicon/apple-icon-60x60.ico">
<link rel="apple-touch-icon" sizes="72x72" href="public/images/favicon/apple-icon-72x72.ico">
<link rel="apple-touch-icon" sizes="76x76" href="public/images/favicon/apple-icon-76x76.ico">
<link rel="apple-touch-icon" sizes="114x114" href="public/images/favicon/apple-icon-114x114.ico">
<link rel="apple-touch-icon" sizes="120x120" href="public/images/favicon/apple-icon-120x120.ico">
<link rel="apple-touch-icon" sizes="144x144" href="public/images/favicon/apple-icon-144x144.ico">
<link rel="apple-touch-icon" sizes="152x152" href="public/images/favicon/apple-icon-152x152.ico">
<link rel="apple-touch-icon" sizes="180x180" href="public/images/favicon/apple-icon-180x180.ico">
<link rel="icon" type="image/png" sizes="192x192" href="public/images/favicon/android-icon-192x192.ico">
<link rel="icon" type="image/png" sizes="32x32" href="public/images/favicon/favicon-32x32.ico">
<link rel="icon" type="image/png" sizes="96x96" href="public/images/favicon/favicon-96x96.ico">
<link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon/favicon-16x16.ico">
<link rel="manifest" href="public/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="public/images/favicon/ms-icon-144x144.ico">
<meta name="theme-color" content="<?= $data['getPublicInfo']['theme_color']; ?>">
<meta name="msapplication-navbutton-color" content="<?= $data['getPublicInfo']['theme_color']; ?>">
<meta name="apple-mobile-web-app-status-bar-style" content="<?= $data['getPublicInfo']['theme_color']; ?>">
<meta name="generator" content="PHP 7.2.2"/>
<link rel='shortlink' href="<?= URL; ?>"/>

<?php if($data['getPublicInfo']['customJS_position'] == "top"){ ?>
    <!-- start custom js-->
    <?= htmlspecialchars_decode($data['getPublicInfo']['customJS']); ?>
    <!-- end custom js-->
<?php } ?>
