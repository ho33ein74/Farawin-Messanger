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
    <meta property="og:brand" content="<?= $data['getPublicInfo']['site']; ?>" />
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
        <!-- Livewire Component wire-end:HccjpGEe1Mn8eCvQdVfX -->
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <!-- Livewire Component wire-end:zovjBxCeDYHwecdqJYJO -->
    <section wire:id="U9Cwv9UArhkYEFyh2izE" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;U9Cwv9UArhkYEFyh2izE&quot;,&quot;name&quot;:&quot;pages.terms&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;terms&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;a56a2842&quot;,&quot;data&quot;:[],&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;71181872f2217417243211298daef32b4e8f37cfd590f4968a969552cda8a284&quot;}}" class="py-10">
        <div class="container">
            <div class="mb-12 text-center">
                <h1 class="mb-12 relative text-gray-800 dark:text-white font-bold lg:text-5xl text-2xl">
                    <?= $data['page']['title']; ?>
                    <span class="absolute inline-block border-b w-32 border-customOrange-700 border-opacity-40 sm:-bottom-5 -bottom-3 right-1/2 transform translate-x-1/2">
                        <i class="absolute top-1/2 right-1/2 inline-block border-4 transform -translate-y-1/2  translate-x-1/2 border-white rounded-full bg-customOrange-700 w-4 h-4"></i>
                    </span>
                </h1>
            </div>
            <div class="bg-white content-area dark:bg-dark-930 dark:shadow-whiteShadow pt-12 md:px-14 px-4 pb-16 rounded-xl shadow-terms-md text-gray-360 dark:text-gray-200 font-normal md:text-lg text-sm leading-9">
                <?= htmlspecialchars_decode($data['page']['description']); ?>
            </div>
        </div>
    </section>
    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script>
    window.Alpine.start();
</script>

</body>
</html>
