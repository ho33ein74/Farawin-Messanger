
<!DOCTYPE html>
<html dir="rtl" lang="fa" ng-app="siteBuilder.public" path="public">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>در حال توسعه | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <link rel="canonical" href="<?= URL; ?>">

    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
</head>

<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890  " :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="zovjBxCeDYHwecdqJYJO">
        <section wire:id="ItXljfGpIrZuJas6Xz1x"class="mt-4">
            <div class="container">
            </div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <section class="min-h-screen flex sm:items-center items-start overflow-hidden pt-13">
        <div class="container">
            <div class="flex justify-center relative">
                <div class="col-span-12 flex flex-col items-center mt-9">
                    <div class="mb-8">
                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                    </div>
                    <div class="text-center md:bottom-16 -bottom-28">
                        <div class="mb-5">
                            <h2 class="text-blue-700 dark:text-blue-950 text-shadow-blueShadow sm:text-100 text-33 font-medium sm:mb-3 mb-1">خطا در دسترسی</h2>
                            <p class="sm:text-22 dark:text-white text-sm text-gray-880 font-medium mt-2"><?= $data['getPublicInfo']['development_mode_text']; ?></p>
                        </div>
                    </div>
                </div>
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