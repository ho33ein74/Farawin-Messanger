<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="og:image:width" content="697">
    <meta property="og:image:height" content="299">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@BluPanel">
    <meta property="twitter:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="twitter:description" content="<?= $data['getPublicInfo']['site']; ?>، <?= $data['getPublicInfo']['meta_description']; ?>">
    <meta property="twitter:title" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:description" content="<?= $data['getPublicInfo']['site']; ?>، <?= $data['getPublicInfo']['meta_description']; ?>">
    <meta property="og:title" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta name="description" content="<?= $data['getPublicInfo']['meta_description']; ?>">
    <meta name="article:publisher" content="<?= $data['getPublicInfo']['site']; ?>"/>

    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>

    <script type="application/ld+json">
        {
            "@context": "https:\/\/schema.org",
            "@type": "WebPage",
            "name": "<?= $data['getPublicInfo']['site']; ?>",
            "description": "<?= $data['getPublicInfo']['meta_description']; ?>"
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
    <div wire:id="52m91JKCESgkf3m5UsDO">

        <?php foreach($data['widget'] as $key => $value){ ?>
            <?php
            try {
                $file = array_keys($value)[0];

                $contents = $value[$file]['content'];
                $name = $file;
                if ($value[$file]['view_type'] == "slider" || $value[$file]['view_type'] == "slider2" || $value[$file]['view_type'] == "item" || $value[$file]['view_type'] == "item2") {
                    $name = $file . "-" . $value[$file]['view_type'];
                }

                require('app/views/template/default/' . $name . '.php');
            } catch (Exception $e) {
                echo 'خطا: ',  $e->getMessage();
            }
            ?>
        <?php } ?>

    </div>
    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/index.js"></script>

<script>
    new Swiper(".mainSlider", {
        slidesPerView: "auto",
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        keyboard: true,
    });
</script>

<script>
    window.Alpine.start();
</script>

</body>
</html>