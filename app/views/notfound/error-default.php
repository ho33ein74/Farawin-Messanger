
<!DOCTYPE html>
<html dir="rtl" lang="fa" ng-app="siteBuilder.public" path="public">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>خطا دسترسی | <?= $data['getPublicInfo']['site']; ?></title>
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
                            <h2 class="text-blue-700 text-shadow-blueShadow sm:text-100 text-33 font-medium sm:mb-3 mb-1 dark:text-blue-950">خطا در دسترسی</h2>
                            <p class="sm:text-22 text-sm text-gray-880 font-medium dark:text-white mt-2 mb-4">متاسفانه این اسکریپت روی لوکال هاست قابل نصب نمی باشد</p>
                        </div>
                        <div class="mb-6">
                            <a class="text-blue-700 font-bold sm:text-lg dark:text-blue-950 text-xs" href="<?= SITE; ?>">ارتباط با تیم <?= DEVELOPER ?>
                                <svg class="inline text-lg md:w-7 md:h-7 w-4 h-4" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M17.9752 13.1044L22.1843 12.7322C23.1289 12.7322 23.8948 13.5055 23.8948 14.4593C23.8948 15.4131 23.1289 16.1864 22.1843 16.1864L17.9752 15.8142C17.2341 15.8142 16.6333 15.2076 16.6333 14.4593C16.6333 13.7098 17.2341 13.1044 17.9752 13.1044" fill="currentColor"></path>
                                    <path d="M3.84057 13.173C3.90636 13.1065 4.15213 12.8258 4.383 12.5927C5.72978 11.1325 9.2463 8.74482 11.0859 8.01411C11.3652 7.89755 12.0714 7.64938 12.45 7.63184C12.8112 7.63184 13.1563 7.71581 13.4852 7.88126C13.8961 8.11313 14.2238 8.47911 14.405 8.91027C14.5205 9.20857 14.7017 10.1047 14.7017 10.121C14.8817 11.0999 14.9797 12.6917 14.9797 14.4514C14.9797 16.1259 14.8817 17.6525 14.734 18.6477C14.7178 18.6652 14.5366 19.7769 14.3392 20.158C13.978 20.8548 13.2717 21.286 12.5158 21.286H12.45C11.9572 21.2697 10.922 20.8373 10.922 20.8222C9.18052 20.0915 5.74716 17.8192 4.36687 16.3089C4.36687 16.3089 3.97711 15.9203 3.8083 15.6784C3.54515 15.33 3.41357 14.8988 3.41357 14.4677C3.41357 13.9864 3.56128 13.5389 3.84057 13.173" fill="currentColor"></path>
                                </svg>
                            </a>
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