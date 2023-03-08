<?php
$activeMenu = 'comments';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>نظرات من | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>user/comments" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>user">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="<?= $data['getPublicInfo']['meta_description']; ?>">
    <link rel="canonical" href="<?= URL; ?>user"/>
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/user_publicCSS.php'); ?>

    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"پنل کاربری <?= $data['getPublicInfo']['site']; ?>",
            "description":"<?= $data['getPublicInfo']['meta_description']; ?>"
        }
    </script>

</head>

<body x-cloak x-data="{ showOverlay : false }" :class="{' overflow-hidden':showOverlay}" class="bg-none dark:bg-dark-920 font-iranyekanBakh">
<div x-cloak @change-overlay-show.window="showOverlay = true" @change-overlay-hide.window="showOverlay = false" @click="$dispatch('aside-handler-hide'),showOverlay=false" :class="{ 'hidden': ! showOverlay }" id="overlay" class="z-50 w-full h-full fixed backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<main class="grid lg:grid-cols-24 min-h-screen grid-cols-1">
    <?php require('app/views/include/default/user_side_bar.php'); ?>

    <section class="xl:col-span-20 h-height-panel lg:col-span-19">
        <?php require('app/views/include/default/user_header.php'); ?>

        <div class="w-full h-full bg-gray-200 dark:bg-dark-900 rounded-tr-3xl xl:px-9 pt-10 pb-14 ">
            <div class="container">

                <div wire:id="owwS736gNsIgu1p8Cri5" x-data="{ activeState : 'blog-part' }">

                    <div x-data="{state:'مقالات'}" class="relative lg:hidden group mb-6 lg:w-1/3 sm:w-2/5">
                        <div class=" bg-white cursor-pointer  py-2 flex items-center justify-between px-3 h-12 rounded">
                            <span class="flex font-medium text-lg text-blue-700 items-center">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 11C0.75 13.2475 0.871405 15.0024 1.17704 16.3776C1.48077 17.7443 1.9564 18.6896 2.63339 19.3666C3.31039 20.0436 4.25571 20.5192 5.62241 20.823C6.99762 21.1286 8.75249 21.25 11 21.25C13.2475 21.25 15.0024 21.1286 16.3776 20.823C17.7443 20.5192 18.6896 20.0436 19.3666 19.3666C20.0436 18.6896 20.5192 17.7443 20.823 16.3776C21.1286 15.0024 21.25 13.2475 21.25 11C21.25 8.75249 21.1286 6.99762 20.823 5.62241C20.5192 4.25571 20.0436 3.31039 19.3666 2.63339C18.6896 1.9564 17.7443 1.48077 16.3776 1.17704C15.0024 0.871405 13.2475 0.75 11 0.75C8.75249 0.75 6.99762 0.871405 5.62241 1.17704C4.25571 1.48077 3.31039 1.9564 2.63339 2.63339C1.9564 3.31039 1.48077 4.25571 1.17704 5.62241C0.871405 6.99762 0.75 8.75249 0.75 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path opacity="0.4" d="M11.0001 6.41663V15.5833M15.5834 10.0833V15.5833M6.41675 11.9166V15.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span x-text="state" class="mr-2">مقالات</span>
                            </span>
                            <span class="border-r h-full flex items-center pr-3 border-blue-700 border-opacity-60 ">
                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.06597 0.94873L3.95486 4.05984L0.84375 0.94873" stroke="#3B82F6" stroke-width="1.23077" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        <div x-data="{controleState(e){state=e.target.textContent.trim()}}" class="absolute z-50 hidden group-hover:inline-block top-full pt-3 w-full">
                            <ul class="bg-white px-2 space-y-2 py-3 rounded">
                                <li class="ml-3 last:ml-0">
                                    <button @click="activeState = 'blog-part'" wire:click.prevent="$set('type','blog-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 -mt-1" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.92574 14.39H11.3119C11.7178 14.39 12.0545 14.05 12.0545 13.64C12.0545 13.23 11.7178 12.9 11.3119 12.9H5.92574C5.5198 12.9 5.18317 13.23 5.18317 13.64C5.18317 14.05 5.5198 14.39 5.92574 14.39ZM9.27228 7.9H5.92574C5.5198 7.9 5.18317 8.24 5.18317 8.65C5.18317 9.06 5.5198 9.39 5.92574 9.39H9.27228C9.67822 9.39 10.0149 9.06 10.0149 8.65C10.0149 8.24 9.67822 7.9 9.27228 7.9ZM16.3381 7.02561C16.5708 7.02292 16.8242 7.02 17.0545 7.02C17.302 7.02 17.5 7.22 17.5 7.47V15.51C17.5 17.99 15.5099 20 13.0545 20H5.17327C2.59901 20 0.5 17.89 0.5 15.29V4.51C0.5 2.03 2.5 0 4.96535 0H10.2525C10.5099 0 10.7079 0.21 10.7079 0.46V3.68C10.7079 5.51 12.203 7.01 14.0149 7.02C14.4381 7.02 14.8112 7.02316 15.1377 7.02593C15.3917 7.02809 15.6175 7.03 15.8168 7.03C15.9578 7.03 16.1405 7.02789 16.3381 7.02561ZM16.6111 5.566C15.7972 5.569 14.8378 5.566 14.1477 5.559C13.0527 5.559 12.1507 4.648 12.1507 3.542V0.906C12.1507 0.475 12.6685 0.261 12.9646 0.572C13.5004 1.13476 14.2368 1.90834 14.9699 2.67837C15.7009 3.44632 16.4286 4.21074 16.9507 4.759C17.2398 5.062 17.0279 5.565 16.6111 5.566Z" fill="currentColor"></path>
                                        </svg>
                                        مقالات
                                    </button>
                                </li>
                                <li>
                                    <button @click="activeState = 'service-part'" wire:click.prevent="$set('type','service-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 mt-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z"></path>
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z"></path>
                                        </svg>
                                        خدمات
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:flex hidden bg-white dark:bg-dark-900 rounded-lg px-8 py-3 mb-4">
                        <div class="flex items-center md:flex-row space-x-2 space-x-reverse flex-col">
                            <button @click="activeState = 'blog-part'" :class="activeState === 'blog-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center group py-2 px-4 xl:text-lg text-15 dark:hover:bg-transparent rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.92574 14.39H11.3119C11.7178 14.39 12.0545 14.05 12.0545 13.64C12.0545 13.23 11.7178 12.9 11.3119 12.9H5.92574C5.5198 12.9 5.18317 13.23 5.18317 13.64C5.18317 14.05 5.5198 14.39 5.92574 14.39ZM9.27228 7.9H5.92574C5.5198 7.9 5.18317 8.24 5.18317 8.65C5.18317 9.06 5.5198 9.39 5.92574 9.39H9.27228C9.67822 9.39 10.0149 9.06 10.0149 8.65C10.0149 8.24 9.67822 7.9 9.27228 7.9ZM16.3381 7.02561C16.5708 7.02292 16.8242 7.02 17.0545 7.02C17.302 7.02 17.5 7.22 17.5 7.47V15.51C17.5 17.99 15.5099 20 13.0545 20H5.17327C2.59901 20 0.5 17.89 0.5 15.29V4.51C0.5 2.03 2.5 0 4.96535 0H10.2525C10.5099 0 10.7079 0.21 10.7079 0.46V3.68C10.7079 5.51 12.203 7.01 14.0149 7.02C14.4381 7.02 14.8112 7.02316 15.1377 7.02593C15.3917 7.02809 15.6175 7.03 15.8168 7.03C15.9578 7.03 16.1405 7.02789 16.3381 7.02561ZM16.6111 5.566C15.7972 5.569 14.8378 5.566 14.1477 5.559C13.0527 5.559 12.1507 4.648 12.1507 3.542V0.906C12.1507 0.475 12.6685 0.261 12.9646 0.572C13.5004 1.13476 14.2368 1.90834 14.9699 2.67837C15.7009 3.44632 16.4286 4.21074 16.9507 4.759C17.2398 5.062 17.0279 5.565 16.6111 5.566Z" fill="currentColor"></path>
                                </svg>
                                مقالات
                            </button>
                            <button @click="activeState = 'service-part'" :class="activeState === 'service-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 dark:hover:border-white dark:hover:text-white mb-3 self-start justify-start flex items-center xl:text-lg text-15 group dark:hover:bg-transparent py-2 px-4 rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z"></path>
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z"></path>
                                </svg>
                                خدمات
                            </button>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'blog-part'" style="">
                        <div class="grid md:grid-cols-3 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['comments']['blog'])>0) { ?>
                                <?php foreach($data['comments']['blog'] as $comment) { ?>
                                    <div class="bg-white dark:bg-dark-920 flex-grow rounded-xl shadow-sm py-6 h-full pr-4 md:pl-6 pl-4">
                                        <div class="flex sm:flex-row flex-col items-center mb-4">
                                            <a class="sm:w-24  sm:h-18 w-full h-40 sm:mb-0 mb-4 flex-shrink-0 overflow-hidden rounded-lg" href="<?= $comment['slug'] ?>">
                                                <img class="w-full h-full object-cover transition duration-200 hover:scale-110 transform" src="public/images/blog/<?= $comment['cover'] ?>" alt="<?= $comment['title'] ?>">
                                            </a>
                                            <div class="flex flex-col mr-3 w-full">
                                                <h4 class=" flex-grow">
                                                    <a class="text-biscay-700 dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200 block sm:text-right font-bold text-lg" href="<?= $comment['slug'] ?>">
                                                        <?= $comment['title'] ?>
                                                    </a>
                                                </h4>
                                                <span class="flex items-center <?= $comment['cm_status'] == 1 ? "text-blue-700":"text-red-450" ?> font-semibold text-xs mb-2">
                                                    <svg class="ml-1" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="3.57789" cy="3.28785" r="2.74867" fill="currentColor"></circle>
                                                    </svg>
                                                    <?= $comment['cm_status'] == 1 ? "تایید شده":"در انتظار تایید" ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex px-5 flex-col py-4  flex-grow-1  justify-between dark:bg-dark-900 bg-gray-210 bg-opacity-40 rounded-xl  md:w-full   sm:text-right ">
                                            <div class="text-gray-360 dark:text-gray-810 content-area text-15 font-normal leading-6 ">
                                                <p><?= $comment['cm_text'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="dark:text-gray-70 text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'service-part'" style="display: none;">
                        <div class="grid md:grid-cols-3 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['comments']['service'])>0) { ?>
                                <?php foreach($data['comments']['service'] as $comment) { ?>
                                    <div class="bg-white dark:bg-dark-920 flex-grow rounded-xl shadow-sm py-6 h-full pr-4 md:pl-6 pl-4">
                                        <div class="flex sm:flex-row flex-col items-center mb-4">
                                            <a class="sm:w-24  sm:h-18 w-full h-40 sm:mb-0 mb-4 flex-shrink-0 overflow-hidden rounded-lg" href="<?= $comment['s_slug'] ?>">
                                                <img class="w-full h-full object-cover transition duration-200 hover:scale-110 transform" src="public/images/services/<?= $comment['s_cover'] ?>" alt="<?= $comment['s_title'] ?>">
                                            </a>
                                            <div class="flex flex-col mr-3 w-full">
                                                <h4 class=" flex-grow">
                                                    <a class="text-biscay-700 dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200 block sm:text-right font-bold text-lg" href="<?= $comment['s_slug'] ?>">
                                                        <?= $comment['s_title'] ?>
                                                    </a>
                                                </h4>
                                                <span class="flex items-center <?= $comment['cm_status'] == 1 ? "text-blue-700":"text-red-450" ?> font-semibold text-xs mb-2">
                                                    <svg class="ml-1" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="3.57789" cy="3.28785" r="2.74867" fill="currentColor"></circle>
                                                    </svg>
                                                    <?= $comment['cm_status'] == 1 ? "تایید شده":"در انتظار تایید" ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex px-5 flex-col py-4  flex-grow-1  justify-between dark:bg-dark-900 bg-gray-210 bg-opacity-40 rounded-xl  md:w-full   sm:text-right ">
                                            <div class="text-gray-360 dark:text-gray-810 content-area text-15 font-normal leading-6 ">
                                                <p><?= $comment['cm_text'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="dark:text-gray-70 text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'episode-part'" style="display: none;">
                        <div class="grid md:grid-cols-2 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <div class="col-span-12 flex flex-col items-center mt-9">
                                <span class="dark:text-gray-70 text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                <div class="mb-8">
                                    <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Livewire Component wire-end:7lE7LaUUtGKlsXloVj9Z -->
            </div>
        </div>
    </section>
</main>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/showdown.min.js"></script>
<script>
    window.Alpine.start();
</script>

<script>
    var converter = new showdown.Converter();
    var text = document.getElementsByClassName("commentText").innerHTML;
    var html = converter.makeHtml(text);
    document.getElementsByClassName("commentText").innerHTML = html;
</script>

</body>
</html>
