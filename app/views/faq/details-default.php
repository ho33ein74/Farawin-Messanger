<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['page']['title']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?><?= $data['page']['link']; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['page']['main_tag']; ?>"/>
    <meta name="author" content="<?= $data['page']['a_name']; ?>"/>
    <meta property="og:url" content="<?= URL; ?><?= $data['page']['link']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <?php if($data['page']['cover']!=NULL){ ?>
        <meta property="og:image" content="<?= URL; ?>public/images/page/<?= $data['page']['cover']; ?>">
        <meta property="twitter:image" content="<?= URL; ?>public/images/page/<?= $data['page']['cover']; ?>">
        <meta property="og:image:width" content="697">
        <meta property="og:image:height" content="299">
        <meta property="twitter:card" content="summary_large_image">
    <?php } ?>
    <meta property="twitter:site" content="<?= URL; ?><?= $data['page']['link']; ?>">
    <meta property="twitter:creator" content="<?= $data['page']['a_name']; ?>">
    <meta property="twitter:description" content="<?= $data['page']['metaDescription']; ?>">
    <meta property="twitter:title" content="<?= $data['page']['title']; ?>">
    <meta property="og:description" content="<?= $data['page']['metaDescription']; ?>">
    <meta property="og:title" content="<?= $data['page']['title']; ?>">
    <meta name="description" content="<?= $data['page']['metaDescription']; ?>">
    <meta name="article:publisher" content="<?= $data['page']['metaDescription']; ?>"/>
    <link rel="canonical" href="<?= URL; ?>/faq/details/<?= $data['attrId'] ?>">
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['page']['title']; ?>",
            "description":"<?= $data['page']['metaDescription']; ?>"
        }
    </script>
</head>
<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890" :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="v9jSr02I09nfYNm2k35B">
        <section wire:id="HccjpGEe1Mn8eCvQdVfX" class="mt-4">
            <div class="container"></div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>

    <section wire:id="1BWFUI2LIhfcpHE4BDLC" class="mt-9 mb-20">

        <div class="container">
            <div>
                <div wire:id="zg707r05AnLSeIaFI7u8">
                    <div class="mb-6 dark:bg-dark-930 bg-white rounded-2xl shadow-sm pt-10 pb-8 md:px-16 px-5">
                        <div class="mb-6 sm:text-right text-center">
                            <h1 class="dark:text-white text-gray-800 font-bold md:text-4xl sm:text-3xl text-28 mb-5 md:leading-68">
                                <?= $data['faq']['question'] ?>
                            </h1>
                            <div class="content-area text-gray-800 dark:text-white dark:bg-dark-910 bg-gray-200 px-8 py-2 rounded-lg">
                                <?= $data['faq']['answer'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/faq.js"></script>
<script>
    window.Alpine.start();
</script>

</body>
</html>
