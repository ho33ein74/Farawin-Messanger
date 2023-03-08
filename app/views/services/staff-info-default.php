<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['getStaff']['name']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>services/staffs/<?= $data['getStaff']['staff_vids_id']; ?>/<?= str_replace(" ", "-", $data['getStaff']['name']); ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getStaff']['name']; ?>"/>
    <meta name="author" content="<?= $data['getStaff']['name']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>services/staffs/<?= $data['getStaff']['staff_vids_id']; ?>/<?= str_replace(" ", "-", $data['getStaff']['name']); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:brand" content="<?= $data['getPublicInfo']['site']; ?>" />
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <?php if($data['getStaff']['image']!=NULL){ ?>
        <meta property="og:image" content="<?= URL; ?>public/images/staffs/<?= $data['page']['image']; ?>">
        <meta property="twitter:image" content="<?= URL; ?>public/images/staffs/<?= $data['page']['image']; ?>">
        <meta property="og:image:width" content="512">
        <meta property="og:image:height" content="512">
        <meta property="twitter:card" content="summary_large_image">
    <?php } ?>
    <meta property="twitter:site" content="<?= URL; ?>services/staffs/<?= $data['getStaff']['staff_vids_id']; ?>/<?= str_replace(" ", "-", $data['getStaff']['name']); ?>">
    <meta property="twitter:creator" content="<?= $data['getStaff']['name']; ?>">
    <meta property="twitter:description" content="<?= $data['getStaff']['description']; ?>">
    <meta property="twitter:title" content="<?= $data['getStaff']['name']; ?>">
    <meta property="og:description" content="<?= $data['getStaff']['description']; ?>">
    <meta property="og:title" content="<?= $data['getStaff']['name']; ?>">
    <meta name="description" content="<?= $data['getStaff']['description']; ?>">
    <meta name="article:publisher" content="<?= $data['getStaff']['description']; ?>"/>
    <link rel="canonical" href="<?= URL; ?>services/staffs/<?= $data['getStaff']['staff_vids_id']; ?>/<?= str_replace(" ", "-", $data['getStaff']['name']); ?>"/>

    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>

    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['getStaff']['name']; ?>",
            "description":"<?= $data['getStaff']['description']; ?>"
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
    <section wire:id="XTM8NVNoPyyXc4wFH4Yh" class="mt-24 mb-20">
        <div wire:loading="" class="fixed top-0 left-0 h-screen w-screen flex bg-biscay-700 bg-opacity-10 backdrop-filter backdrop-blur-sm  items-center justify-center z-50">
            <div class="absolute top-0    right-0 w-full h-full flex items-center justify-center">

                <svg class="w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">

                    <circle class="stroke-current text-red-450 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300">

                    </circle>
                    <circle class="stroke-current text-red-450" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                        <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                        <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                    </circle>
                </svg>
            </div>
        </div>

        <div class="container">
            <div class="xl:px-10 ">
                <div class="bg-white dark:bg-dark-930 dark:shadow-whiteShadow p-5 shadow-sm rounded-2xl mb-8">

                    <div class="xl:px-11 lg:px-5">
                        <div class=" flex justify-between items-center sm:mb-10 mb-8 lg:flex-row flex-col">
                            <div class="flex lg:items-end items-center lg:text-right text-center lg:flex-row flex-col">
                                <div wire:id="bBmLvifJM7Ty08o6Ya22" class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                    <div class="md:w-52 md:h-52 w-24 h-24 rounded-full md:border-8 border-2 lg:ml-5 md:-mt-28 -mt-13 !border-white object-cover bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid  dark:border-dark-930 border-gray-80">
                                        <a href="services/staffs/<?= $data['getStaff']['staff_vids_id'] ?>/<?= str_replace(" ", "-", $data['getStaff']['name']) ?>">
                                            <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                                 onerror="this.src='public/images/default_staff.png'"
                                                 src="public/images/staffs/<?= $data['getStaff']['image'] ?>"
                                                 alt="تصویر <?= $data['getStaff']['name'] ?>">
                                            <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                        </a>
                                    </div>
                                </div>

                                <div class="mb-3 md:mt-5 mt-2">
                                    <h1 class="text-gray-800 dark:text-white lg:text-4xl sm:text-33 text-28 font-bold">
                                        <?= $data['getStaff']['name']; ?>
                                    </h1>
                                    <ul class="mt-2 flex items-center sm:flex-row flex-col ">
                                        <li class="relative group dark:text-gray-200 text-gray-300 text-base font-medium sm:pl-2 md:ml-2 md:mb-0 mb-1.5 sm:border-l border-gray-300 border-opacity-20 last:ml-0 last:pl-0 w-fit-content last:border-0 flex items-center">
                                            <span class="ml-1">تخصص :</span>
                                            <span>
                                                <?= $data['getStaff']['expertise']!="" ? $data['getStaff']['expertise']:"-"; ?>
                                            </span>
                                            <div class="hidden group-hover:visible bg-blue-700 absolute p-2 group-hover:flex items-center justify-center w-52 min-h-9 rounded-md bottom-10">
                                                <span class="text-white font-normal text-xs leading-7">
                                                    <?= $data['getStaff']['expertise']!="" ? $data['getStaff']['expertise']:"-"; ?>
                                                </span>
                                                <div class="absolute -bottom-2 right-1/2 transform border-blue-700 translate-x-2/4 c-triangle-down"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="bg-white dark:bg-dark-930 dark:shadow-whiteShadow relative shadow-sm rounded-2xl pt-8 sm:px-10 px-7 pb-10 ">
                        <i class="flex w-1 h-11 bg-blue-700 absolute right-0 rounded-tl-full rounded-bl-full top-1/2 transform -translate-y-1/2 "></i>
                        <div class="sm:text-right flex-col flex sm:items-start items-center text-center">
                            <h4 class="flex items-center dark:text-white text-blue-700 font-semibold text-25 mb-3">
                                <i class=" w-2 h-2 bg-blue-700 ml-2 dark:bg-white sm:flex hidden rounded-full"></i>
                                درباره <?= $data['getStaff']['name']; ?>
                            </h4>
                            <span class="text-19 font-normal dark:text-gray-200 leading-8 text-gray-60">
                                <?= $data['getStaff']['description']; ?>
                            </span>
                        </div>

                        <i class="flex w-1 h-11 bg-blue-700 absolute left-0 rounded-tr-full rounded-br-full top-1/2 transform -translate-y-1/2 "></i>
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
