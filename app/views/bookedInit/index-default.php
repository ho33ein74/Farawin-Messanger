<!DOCTYPE html>
<html dir="rtl" lang="fa" ng-app="siteBuilder.public" path="public">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>رزرو نوبت برای  <?= $data['services']['s_title'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <link rel="canonical" href="<?= URL; ?>">

    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
</head>

<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890" :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="zovjBxCeDYHwecdqJYJO" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;zovjBxCeDYHwecdqJYJO&quot;,&quot;name&quot;:&quot;layouts.header.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;terms&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;VEYNVE1&quot;:{&quot;id&quot;:&quot;ItXljfGpIrZuJas6Xz1x&quot;,&quot;tag&quot;:&quot;section&quot;},&quot;fVc5WAG&quot;:{&quot;id&quot;:&quot;TOKMuieOz4M1nQuksMzi&quot;,&quot;tag&quot;:&quot;form&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;e46ec6c7&quot;,&quot;data&quot;:{&quot;discount&quot;:{&quot;status&quot;:false,&quot;message&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;c86b2f2eef022f3777972ca4a7498d3624642a1291afb50d45d5f2f675c86cf9&quot;}}">
        <section wire:id="ItXljfGpIrZuJas6Xz1x" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;ItXljfGpIrZuJas6Xz1x&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;terms&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;5be47514&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:null,&quot;message&quot;:null,&quot;moreLink_title&quot;:null,&quot;moreLink_link&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;f03db82a6857f7f16646c87642460bcb59d645c12b9532b52202407164a6349a&quot;}}" class="mt-4">
            <div class="container">
            </div>
        </section>
        <!-- Livewire Component wire-end:ItXljfGpIrZuJas6Xz1x -->
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <section wire:id="JInOPNLr9N52s66WedR1" class="mt-10 mb-20">
        <div class="container">
            <div class="grid grid-cols-24  xl:px-10 sm:gap-5">
                <div class="lg:col-span-17 col-span-24">

                    <?php if(sizeof($data['checkTurnBookingUser'])>0){ ?>
                        <div class="flex items-center justify-between md:flex-row flex-col rounded-lg py-4 relative pl-5 lg:pr-7 pr-5 dark:bg-dark-930 dark:shadow-whiteShadow bg-yellow-300 text-yellow-700 mb-5 ">
                            <div class="flex items-center md:flex-row flex-col ">
                                <div>
                                    <svg class="w-10 ml-2 text-yellow-700 flex-shrink-0" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.216 14.7457C14.5198 14.623 14.7893 14.4275 15 14.177C15.2107 14.4275 15.4802 14.623 15.784 14.7457C15.6104 15.0232 15.5075 15.3395 15.4845 15.6658C15.1666 15.5868 14.8334 15.5868 14.5155 15.6658C14.4925 15.3395 14.3896 15.0232 14.216 14.7457Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.05257 14.1818C8.19103 14.2114 8.35338 14.2114 8.67809 14.2114C9.11559 14.2114 9.47025 14.6459 9.47025 15.182C9.47025 15.718 9.11559 16.1525 8.67809 16.1525C8.35991 16.1525 8.20082 16.1525 8.06305 16.1818C7.54076 16.2931 7.11139 16.742 7.02417 17.268C7.00116 17.4068 7.00782 17.5509 7.02115 17.8392C7.06347 18.7548 7.15793 19.4091 7.36869 19.9744C7.79087 21.1068 8.40002 21.8161 9.32428 22.3333C10.1604 22.8012 11.3671 23 13.5164 23H16.4836C18.6329 23 19.8396 22.8012 20.6757 22.3333C21.6 21.8161 22.2091 21.1068 22.6313 19.9744C22.8421 19.4091 22.9365 18.7548 22.9789 17.8392C22.9922 17.551 22.9988 17.4068 22.9758 17.268C22.8886 16.742 22.4592 16.2931 21.937 16.1818C21.7992 16.1525 21.6401 16.1525 21.3219 16.1525C20.8844 16.1525 20.5297 15.718 20.5297 15.182C20.5297 14.6459 20.8844 14.2114 21.3219 14.2114C21.6466 14.2114 21.809 14.2114 21.9474 14.1818C22.4658 14.0708 22.8858 13.6385 22.9811 13.1178C23.0065 12.9787 23.0019 12.8268 22.9926 12.523C22.9587 11.4131 22.8689 10.6628 22.6313 10.0256C22.2091 8.89319 21.6 8.18391 20.6757 7.66667C19.8396 7.19875 18.6329 7 16.4836 7H13.5164C11.3671 7 10.1604 7.19875 9.32428 7.66667C8.40002 8.18391 7.79087 8.89319 7.36869 10.0256C7.13113 10.6628 7.04134 11.4131 7.0074 12.523C6.99811 12.8268 6.99347 12.9787 7.01892 13.1178C7.11424 13.6385 7.53416 14.0708 8.05257 14.1818ZM14.365 12.2847C14.5648 11.6705 15.4352 11.6705 15.6351 12.2847L15.8995 13.0973C15.9889 13.3719 16.2453 13.5579 16.5345 13.5579H17.3903C18.0371 13.5579 18.3061 14.3843 17.7828 14.7639L17.0905 15.2661C16.8564 15.4359 16.7585 15.7368 16.8479 16.0115L17.1123 16.824C17.3122 17.4383 16.6081 17.949 16.0848 17.5694L15.3925 17.0672C15.1585 16.8974 14.8415 16.8974 14.6075 17.0672L13.9152 17.5694C13.3919 17.949 12.6878 17.4383 12.8877 16.824L13.1521 16.0115C13.2415 15.7368 13.1436 15.4359 12.9095 15.2661L12.2172 14.7639C11.6939 14.3843 11.9629 13.5579 12.6097 13.5579H13.4655C13.7547 13.5579 14.0111 13.3719 14.1005 13.0973L14.365 12.2847Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center sm:flex-row flex-col">
                                    <p class="font-medium sm:text-right text-center lg:text-lg text-15 lg:ml-4 ml-2 sm:mb-0 sm:mt-0 mt-2 mb-2">
                                        شما خدمت <?= $data['services']['s_title'] ?> را در این تاریخ و ساعت قبلا رزرو کرده اید.
                                    </p>
                                </div>
                            </div>
                            <div class="cursor-pointer md:relative absolute md:left-0 left-5 md:top-0 top-5  group hover:opacity-75" wire:loading.remove="" wire:target="closeHeaderMessage" wire:click="closeHeaderMessage">
                                <a href="user/reservations/details/<?= $data['checkTurnBookingUser'][0]['order_service_vids_id'] ?>" class="flex items-center transform transition duration-200 ">
                                    <span class="ml-1 font-semibold lg:text-xl text-base underline hover:no-underline">مشاهده</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" opacity="0.4" d="M15.7975 10.8097L19.4967 10.4825C20.3269 10.4825 21 11.1622 21 12.0004C21 12.8387 20.3269 13.5183 19.4967 13.5183L15.7975 13.1912C15.1463 13.1912 14.6183 12.6581 14.6183 12.0004C14.6183 11.3417 15.1463 10.8097 15.7975 10.8097Z"></path>
                                        <path fill="currentColor" d="M3.37522 10.8698C3.43303 10.8115 3.64903 10.5647 3.85194 10.3598C5.03556 9.07656 8.12607 6.97815 9.74278 6.33596C9.98823 6.23352 10.6089 6.01542 10.9417 6C11.2591 6 11.5624 6.0738 11.8515 6.2192C12.2126 6.42299 12.5006 6.74463 12.6598 7.12355C12.7613 7.38572 12.9206 8.17331 12.9206 8.18763C13.0787 9.04792 13.1649 10.4469 13.1649 11.9934C13.1649 13.465 13.0787 14.8067 12.9489 15.6813C12.9347 15.6967 12.7755 16.6738 12.602 17.0086C12.2846 17.6211 11.6638 18 10.9995 18H10.9417C10.5086 17.9857 9.59878 17.6057 9.59878 17.5924C8.06825 16.9502 5.05083 14.9532 3.83776 13.6258C3.83776 13.6258 3.49522 13.2844 3.34685 13.0718C3.11558 12.7656 2.99995 12.3866 2.99995 12.0077C2.99995 11.5847 3.12977 11.1915 3.37522 10.8698Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                    <div wire:id="46ODwDKrvB8elovCFFAP" x-data="{ deleteProgress : 0 }">
                        <div class="grid lg:gap-7 gap-1 lg:grid-cols-1sm:grid-cols-1 mb-3">
                            <div class="flex items-center justify-between sm:flex-row flex-col bg-white dark:bg-dark-890 lg:px-4 px-2 py-5 shadow-sm rounded-lg">
                                <div class="flex items-center sm:flex-row flex-col sm:mb-0 mb-5 sm:w-8/12">
                                    <h6 class="xl:text-xl lg:text-base sm:text-right text-center font-bold dark:hover:text-blue-450 text-gray-800 dark:text-white hover:text-blue-700 duration-200 transition">
                                        زمان باقیمانده برای تکمیل رزرو
                                    </h6>
                                </div>
                                <div class="text-10 flex items-center text-gray-450 h-8 dark:text-white rounded px-1.5">
                                    <div dir="ltr" id="timer" data-end="<?= $data['dateInfo']['expireDate'] ?>"></div>
                                </div>
                            </div>
                        </div>

                        <div wire:id="AaPU05YCFd9Nk0bvBbo5" class="bg-white dark:bg-dark-930 shadow-sm mb-10 pt-4 rounded-md flex flex-col h-full">
                            <div class="flex flex-col md:pl-34px pl-4 flex-1">
                                <div class="flex flex-col flex-grow">
                                    <h3 class="pr-5 mt-2 mb-5">
                                        <span class="text-xl font-bold transition duration-200 leading-7 inline-flex dark:hover:text-gray-20 dark:text-white text-biscay-700  hover:text-blue-700">
                                            <span class="ml-3 -mt-1">
                                                <svg class=" w-7 h-8 text-green-700" viewBox="0 0 33 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M33 0H6V9C6 23.9117 18.0883 36 33 36V36V0Z" fill="currentColor" fill-opacity="0.2"></path>
                                                    <path d="M27 6H-7.00355e-07V15C-7.00355e-07 29.9117 12.0883 42 27 42V42V6Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            شما خدمت <?= $data['services']['s_title'] ?><?= $data['is_vip'] ? " ویژه":"" ?> را برای روز <?= $data['dateInfo']['title'] ?> <?= $data['dateInfo']['date'] ?> ساعت <?= $data['dateInfo']['time'] ?> انتخاب کرده&zwnj;اید.
                                        </span>
                                    </h3>
                                    <?php if($data['bookedInfo']['description']!="" AND $data['turn_type']!="custom_date"){ ?>
                                        <p class="md:text-17 text-base text-gray-360 md:leading-10 dark:text-gray-920 leading-7 p-5 text-justify">
                                            <?= $data['bookedInfo']['description'] ?>
                                        </p>
                                    <?php } ?>
                                </div>

                                <div class="relative w-full border-t py-1.5 pr-5 dark:border-dark-910 border-gray-300  border-opacity-10">
                                    <a href="services/<?= $data['services']['s_slug'] ?>" class="click_for_play inline-flex items-center text-13 font-semibold dark:hover:text-blue-200 dark:text-blue-950 text-blue-700 group transform transition duration-200 hover:text-dark-700 ">
                                        برای تغییر روز یا ساعت کلیک کنید
                                        <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                                            <path fill="currentColor" opacity="0.4" d="M11.1898 4.38459L14.3778 4.10265C15.0932 4.10265 15.6733 4.68836 15.6733 5.41077C15.6733 6.13318 15.0932 6.71889 14.3778 6.71889L11.1898 6.43695C10.6285 6.43695 10.1735 5.97749 10.1735 5.41077C10.1735 4.84309 10.6285 4.38459 11.1898 4.38459"></path>
                                            <path fill="currentColor" d="M0.484342 4.43642C0.534169 4.38611 0.720315 4.17347 0.895179 3.9969C1.91522 2.89098 4.57861 1.08258 5.97189 0.529142C6.18342 0.440858 6.71835 0.252899 7.00509 0.239609C7.27867 0.239609 7.54003 0.303211 7.78916 0.428517C8.10034 0.604136 8.34854 0.881329 8.4858 1.20788C8.57323 1.43382 8.71049 2.11256 8.71049 2.1249C8.84681 2.86629 8.92108 4.07189 8.92108 5.4047C8.92108 6.67295 8.84681 7.82918 8.73493 8.58292C8.72271 8.59621 8.58545 9.43823 8.43597 9.72681C8.16239 10.2546 7.62746 10.5812 7.05492 10.5812H7.00509C6.63186 10.5688 5.84779 10.2413 5.84779 10.2299C4.52879 9.6765 1.92838 7.95544 0.882957 6.81154C0.882957 6.81154 0.587756 6.51726 0.459899 6.33405C0.260591 6.07015 0.160937 5.74359 0.160937 5.41704C0.160937 5.05251 0.272812 4.71361 0.484342 4.43642"></path>
                                        </svg>
                                    </a>
                                    <a class="absolute -top-4 left-0 overflow-hidden shadow-sm rounded w-74 h-74" href="services/<?= $data['services']['s_slug'] ?>">
                                        <img class="w-full h-full object-cover transform transition duration-200 hover:scale-110" onerror="this.src='public/images/default_cover.jpg'" src="public/images/services/<?= $data['services']['s_cover'] ?>" alt="تصویر <?= $data['services']['s_title'] ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div wire:id="TK7lvRrEFgKzYtLgmZPP">
                        <div class="flex justify-between xl:flex-row flex-col items-center sm:mb-5 mb-5">
                            <div x-data="{ plan : '' }" class="w-full xl:mb-0 mb-7">
                                <div class="flex flex-col border border-blue-700 dark:border-dark-920 rounded-xl">
                                    <div class="flex items-center justify-between bg-blue-700 dark:bg-dark-920 py-4 px-8 rounded-t-xl">
                                        <div class="text-white">
                                            <span class="text-white text-lg dark:text-white md:text-26 text-sm font-bold">لیست پرسنل</span>
                                        </div>
                                    </div>
                                    <div class="p-5 pb-0">
                                        <div>
                                            <p class="md:text-17 text-base text-gray-360 md:leading-10 dark:text-gray-920 leading-7 mb-8">
                                                <?php if (sizeof($data['servicesTariff'])>0){ ?>
                                                    از بین پرسنل زیر شخص مورد نظر خود را انتخاب نمایید:
                                                <?php } else { ?>
                                                    در حال حاضر پرسنلی ثبت نشده است.
                                                <?php } ?>
                                            </p>
                                            <?php $count = 1; ?>
                                            <?php foreach ($data['servicesTariff'] as $tariff){ ?>
                                            <div class="mb-4">
                                                <?php
                                                $classSelect='';
                                                if($count==1){
                                                    $classSelect="bg-blue-700 text-white dark:text-black border-transparent dark:bg-gray-900 dark:border-opacity-0 selected img-grayscale-0";
                                                } else {
                                                    $classSelect="img-grayscale-100 text-gray-450";
                                                }
                                                ?>
                                                <div onclick="calculatePayment(this)" data-operator="<?= Model::encrypt($tariff['operator_id'], KEY) ?>" data-tariff="<?= Model::encrypt($tariff['st_id'], KEY) ?>" class="itemTariff flex items-center justify-between border hover:opacity-75 border-gray-300 border-opacity-30 rounded-xl py-4 sm:pl-7 sm:pr-8 px-4 img-grayscale-100 text-gray-450 cursor-pointer">
                                                    <div class="sm:col-span-6 col-span-8 flex items-center justify-start">
                                                        <div class="h-full flex items-center">
                                                            <div class="relative">
                                                                <div class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                    <div class="inline-block border-2 w-14 h-14 rounded-full overflow-hidden bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-gray-100">
                                                                        <a>
                                                                            <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                                                                 onerror="this.src='public/images/default-profile.png'"
                                                                                 src="public/images/staffs/<?= $tariff['image'] ?>" alt="user-avatar">
                                                                            <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="flex absolute bottom-1 right-2/4 transform translate-x-1/2 bg-white dark:bg-dark-890 dark:text-gray-920 dark:shadow-whiteShadow   shadow-md rounded-full text-blue-700 text-xs font-bold px-1 h-4 dark:group-hover:bg-blue-450 group-hover:bg-blue-700 group-hover:text-white">
                                                                    <?= $tariff['score'] ?>
                                                                    <svg class="mt-0.5 mr-0.5" width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <circle class="fill-current text-customOrange-700 group-hover:text-white" opacity="0.15" cx="5.60522" cy="6.82555" r="3.49807" transform="rotate(0.0363971 5.60522 6.82555)"></circle>
                                                                        <path class="fill-current text-customOrange-700 group-hover:text-white" fill-rule="evenodd" clip-rule="evenodd" d="M3.12565 0.97245C3.00905 0.97245 2.92201 1.03597 2.87262 1.08073C2.8183 1.12997 2.77044 1.19228 2.72912 1.25458C2.64568 1.38035 2.56385 1.54468 2.48968 1.71198C2.34021 2.04913 2.20526 2.43678 2.13472 2.64841C2.13368 2.65151 2.13064 2.65395 2.12695 2.65408C1.90595 2.66155 1.50093 2.68137 1.14792 2.73314C0.973519 2.75872 0.797879 2.79398 0.660747 2.84504C0.593224 2.87019 0.519586 2.90468 0.458847 2.95471C0.397373 3.00536 0.324219 3.09411 0.324219 3.2221C0.324219 3.31061 0.357709 3.38897 0.388024 3.44489C0.420518 3.50483 0.463461 3.56423 0.509395 3.62032C0.601462 3.73274 0.723198 3.85309 0.849063 3.96755C1.10199 4.19756 1.3949 4.42469 1.56155 4.55027C1.56418 4.55225 1.5654 4.55555 1.56431 4.55912C1.50031 4.76924 1.38916 5.15369 1.31845 5.51026C1.28333 5.68738 1.25621 5.86717 1.25214 6.01901C1.25011 6.09454 1.25344 6.17273 1.26854 6.24443C1.28261 6.3112 1.31352 6.40493 1.39263 6.47484C1.48141 6.55331 1.58827 6.56371 1.66226 6.55914C1.73792 6.55446 1.8137 6.53256 1.88122 6.50707C2.01759 6.45561 2.17153 6.36948 2.31912 6.2765C2.6173 6.08865 2.93303 5.84483 3.11258 5.70147C3.11583 5.69887 3.12061 5.6988 3.12402 5.70153C3.30353 5.84501 3.61952 6.08898 3.91992 6.27696C4.06871 6.37006 4.22423 6.45618 4.36295 6.50758C4.43182 6.5331 4.50837 6.5546 4.58471 6.55917C4.65966 6.56365 4.76356 6.55313 4.85223 6.48034C4.93531 6.41214 4.96983 6.31846 4.98584 6.24897C5.00271 6.17579 5.00662 6.09634 5.00475 6.02022C5.001 5.86727 4.97248 5.68679 4.93551 5.50973C4.86106 5.15309 4.74326 4.76853 4.67511 4.55754C4.67391 4.5538 4.67518 4.55031 4.67791 4.54826C4.8454 4.42198 5.13766 4.19516 5.38974 3.96572C5.51518 3.85154 5.63644 3.73153 5.72814 3.61941C5.77389 3.56347 5.81666 3.50421 5.84903 3.4444C5.87924 3.38858 5.91257 3.31041 5.91257 3.2221C5.91257 3.09425 5.83957 3.00553 5.77814 2.95488C5.71747 2.90484 5.64392 2.87035 5.57648 2.84521C5.43954 2.79415 5.26415 2.75888 5.08997 2.7333C4.73741 2.68151 4.33272 2.66164 4.11122 2.65412C4.10749 2.654 4.10449 2.65157 4.10348 2.64843C4.03454 2.43618 3.90296 2.04886 3.75652 1.71217C3.68386 1.54513 3.60347 1.38096 3.52109 1.25524C3.48029 1.19297 3.43285 1.13054 3.37872 1.08114C3.32937 1.03611 3.24243 0.97245 3.12565 0.97245Z"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>

                                                            <div class="relative">
                                                                <div class="font-semibold sm:text-xl text-xl mr-3 text-current space-y-1"><?= $tariff['name'] ?></div>
                                                                <a target="_blank" href="services/staffs/<?= $tariff['operator_id'] ?>/<?= str_replace(" ", "-", $tariff['name']); ?>" class="flex items-center text-current m:text-xs text-10 font-semibold">
                                                                    <svg class="text-current ml-1" width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M16.6936 9.39221C16.6936 9.97583 16.5534 10.5171 16.273 11.0127C15.9926 11.5083 15.6176 11.8962 15.1448 12.1669C15.1579 12.2549 15.1644 12.3918 15.1644 12.5777C15.1644 13.4613 14.8677 14.2112 14.2808 14.8307C13.6907 15.4534 12.9799 15.7632 12.1485 15.7632C11.7768 15.7632 11.4214 15.6947 11.0856 15.5577C10.8247 16.0925 10.4498 16.5228 9.95745 16.8521C9.46838 17.1847 8.9304 17.3477 8.34678 17.3477C7.75012 17.3477 7.20888 17.188 6.72633 16.8619C6.24052 16.5391 5.86883 16.1055 5.60799 15.5577C5.27217 15.6947 4.92004 15.7632 4.54508 15.7632C3.71367 15.7632 2.99962 15.4534 2.40296 14.8307C1.8063 14.2112 1.50959 13.458 1.50959 12.5777C1.50959 12.4799 1.52264 12.3429 1.54546 12.1669C1.07269 11.893 0.697739 11.5083 0.417339 11.0127C0.1402 10.5171 0 9.97583 0 9.39221C0 8.77272 0.156502 8.20214 0.466246 7.68699C0.77599 7.17184 1.19333 6.79036 1.715 6.54257C1.57806 6.17088 1.50959 5.79592 1.50959 5.42423C1.50959 4.5439 1.8063 3.79074 2.40296 3.17125C2.99962 2.55176 3.71367 2.23876 4.54508 2.23876C4.91678 2.23876 5.27217 2.30723 5.60799 2.44417C5.86883 1.90945 6.24378 1.47907 6.73611 1.14976C7.22518 0.820458 7.76316 0.654175 8.34678 0.654175C8.9304 0.654175 9.46838 0.820458 9.95745 1.1465C10.4465 1.47581 10.8247 1.90619 11.0856 2.44091C11.4214 2.30397 11.7735 2.2355 12.1485 2.2355C12.9799 2.2355 13.6907 2.54524 14.2808 3.16799C14.871 3.79074 15.1644 4.54064 15.1644 5.42097C15.1644 5.83179 15.1025 6.20348 14.9786 6.53931C15.5002 6.7871 15.9176 7.16858 16.2273 7.68373C16.5371 8.20214 16.6936 8.77272 16.6936 9.39221ZM7.99139 11.906L11.4377 6.74472C11.5257 6.60778 11.5518 6.4578 11.5225 6.29803C11.4899 6.13827 11.4084 6.01111 11.2714 5.92634C11.1345 5.83831 10.9845 5.80896 10.8247 5.83179C10.6617 5.85787 10.5313 5.93612 10.4335 6.07306L7.39799 10.6377L5.99925 9.24223C5.87535 9.11833 5.73189 9.05964 5.57213 9.06616C5.4091 9.07269 5.26891 9.13137 5.14501 9.24223C5.03415 9.35308 4.97872 9.49328 4.97872 9.66283C4.97872 9.82911 5.03415 9.96931 5.14501 10.0834L7.06542 12.0038L7.15997 12.0788C7.27083 12.1538 7.38494 12.1897 7.4958 12.1897C7.71425 12.1864 7.88053 12.0951 7.99139 11.906Z" fill="currentColor"></path>
                                                                    </svg>
                                                                    مشاهده رزومه
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-8 col-span-6">
                                                        <div class="h-full flex items-center justify-end">
                                                            <span class="sm:text-2xl text-xl font-bold">
                                                                <?= number_format($tariff['st_price']) ?>
                                                            </span>
                                                            <svg class="mr-5px" width="19" height="20" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.89875 6.65059C2.34542 6.65059 2.66542 6.54725 2.85875 6.34059C3.05208 6.14059 3.16542 5.89392 3.19875 5.60059H2.72875C2.38208 5.60059 2.09875 5.56392 1.87875 5.49059C1.65875 5.41725 1.48542 5.30725 1.35875 5.16059C1.23208 5.01392 1.14208 4.83725 1.08875 4.63059C1.04208 4.41725 1.01875 4.17392 1.01875 3.90059C1.01875 3.64059 1.05542 3.39392 1.12875 3.16059C1.20208 2.92059 1.30875 2.71392 1.44875 2.54059C1.59542 2.36725 1.77542 2.23059 1.98875 2.13059C2.20875 2.02392 2.46208 1.97059 2.74875 1.97059C2.97542 1.97059 3.18875 2.00725 3.38875 2.08059C3.59542 2.15392 3.77542 2.27059 3.92875 2.43059C4.08208 2.59059 4.20208 2.80059 4.28875 3.06059C4.38208 3.32059 4.42875 3.63725 4.42875 4.01059V4.23059H5.14875C5.29542 4.23059 5.36875 4.45059 5.36875 4.89059C5.36875 5.36392 5.29542 5.60059 5.14875 5.60059H4.41875C4.39875 5.92725 4.32875 6.23725 4.20875 6.53059C4.08875 6.82392 3.92208 7.08059 3.70875 7.30059C3.50208 7.52059 3.24875 7.69392 2.94875 7.82059C2.64875 7.95392 2.31542 8.02059 1.94875 8.02059H0.96875L0.90875 6.65059H1.89875ZM2.22875 3.80059C2.22875 3.96059 2.26208 4.07392 2.32875 4.14059C2.40208 4.20059 2.53542 4.23059 2.72875 4.23059H3.21875V3.95059C3.21875 3.69725 3.17542 3.52392 3.08875 3.43059C3.00875 3.33725 2.88208 3.29059 2.70875 3.29059C2.38875 3.29059 2.22875 3.46059 2.22875 3.80059ZM6.79648 4.23059C6.88315 4.23059 6.93982 4.28392 6.96648 4.39059C6.99982 4.49725 7.01648 4.66392 7.01648 4.89059C7.01648 5.13725 6.99982 5.31725 6.96648 5.43059C6.93982 5.54392 6.88315 5.60059 6.79648 5.60059H5.14648C5.05982 5.60059 5.00315 5.54725 4.97648 5.44059C4.94315 5.32725 4.92648 5.16059 4.92648 4.94059C4.92648 4.68725 4.94315 4.50725 4.97648 4.40059C5.00315 4.28725 5.05982 4.23059 5.14648 4.23059H6.79648ZM8.44688 4.23059C8.53354 4.23059 8.59021 4.28392 8.61688 4.39059C8.65021 4.49725 8.66688 4.66392 8.66688 4.89059C8.66688 5.13725 8.65021 5.31725 8.61688 5.43059C8.59021 5.54392 8.53354 5.60059 8.44688 5.60059H6.79688C6.71021 5.60059 6.65354 5.54725 6.62687 5.44059C6.59354 5.32725 6.57687 5.16059 6.57687 4.94059C6.57687 4.68725 6.59354 4.50725 6.62687 4.40059C6.65354 4.28725 6.71021 4.23059 6.79688 4.23059H8.44688ZM10.0973 4.23059C10.1839 4.23059 10.2406 4.28392 10.2673 4.39059C10.3006 4.49725 10.3173 4.66392 10.3173 4.89059C10.3173 5.13725 10.3006 5.31725 10.2673 5.43059C10.2406 5.54392 10.1839 5.60059 10.0973 5.60059H8.44727C8.3606 5.60059 8.30393 5.54725 8.27727 5.44059C8.24393 5.32725 8.22727 5.16059 8.22727 4.94059C8.22727 4.68725 8.24393 4.50725 8.27727 4.40059C8.30393 4.28725 8.3606 4.23059 8.44727 4.23059H10.0973ZM11.7477 4.23059C11.8343 4.23059 11.891 4.28392 11.9177 4.39059C11.951 4.49725 11.9677 4.66392 11.9677 4.89059C11.9677 5.13725 11.951 5.31725 11.9177 5.43059C11.891 5.54392 11.8343 5.60059 11.7477 5.60059H10.0977C10.011 5.60059 9.95432 5.54725 9.92766 5.44059C9.89432 5.32725 9.87766 5.16059 9.87766 4.94059C9.87766 4.68725 9.89432 4.50725 9.92766 4.40059C9.95432 4.28725 10.011 4.23059 10.0977 4.23059H11.7477ZM12.688 4.23059C12.8814 4.23059 13.018 4.18725 13.098 4.10059C13.1847 4.00725 13.228 3.86392 13.228 3.67059V2.63059H14.498V3.78059C14.498 4.38725 14.3514 4.84392 14.058 5.15059C13.7714 5.45059 13.3514 5.60059 12.798 5.60059H11.748C11.6614 5.60059 11.6047 5.54725 11.578 5.44059C11.5447 5.32725 11.528 5.16059 11.528 4.94059C11.528 4.68725 11.5447 4.50725 11.578 4.40059C11.6047 4.28725 11.6614 4.23059 11.748 4.23059H12.688ZM14.488 1.53059H13.278V0.370586H14.488V1.53059ZM12.948 1.53059H11.738V0.370586H12.948V1.53059ZM7.28883 13.3206C7.28883 13.7073 7.22883 14.0639 7.10883 14.3906C6.99549 14.7239 6.82883 15.0106 6.60883 15.2506C6.38883 15.4906 6.12216 15.6773 5.80883 15.8106C5.4955 15.9506 5.14549 16.0206 4.75883 16.0206H4.09883C3.35216 16.0206 2.77216 15.7906 2.35883 15.3306C1.94549 14.8706 1.73883 14.2406 1.73883 13.4406V11.6206H2.99883V13.3806C2.99883 13.5739 3.01883 13.7473 3.05883 13.9006C3.09883 14.0606 3.16549 14.1939 3.25883 14.3006C3.35883 14.4139 3.48883 14.5006 3.64883 14.5606C3.81549 14.6206 4.02216 14.6506 4.26883 14.6506H4.70883C4.96883 14.6506 5.18216 14.6139 5.34883 14.5406C5.52216 14.4739 5.65883 14.3773 5.75883 14.2506C5.85883 14.1306 5.92883 13.9906 5.96883 13.8306C6.00883 13.6706 6.02883 13.5006 6.02883 13.3206V10.6306H7.28883V13.3206ZM4.97883 10.5206H3.65883V9.31059H4.97883V10.5206ZM9.82297 13.6006C9.62964 13.6006 9.4463 13.5773 9.27297 13.5306C9.09964 13.4773 8.9463 13.3906 8.81297 13.2706C8.6863 13.1506 8.58297 12.9939 8.50297 12.8006C8.42964 12.6006 8.39297 12.3539 8.39297 12.0606V7.40059H9.66297V11.7306C9.66297 12.0639 9.80964 12.2306 10.103 12.2306H10.373C10.5196 12.2306 10.593 12.4506 10.593 12.8906C10.593 13.3639 10.5196 13.6006 10.373 13.6006H9.82297ZM10.4211 12.2306C10.6211 12.2306 10.7811 12.1973 10.9011 12.1306C11.0211 12.0573 11.0811 11.9239 11.0811 11.7306V11.6206C11.0811 11.3606 11.1211 11.1206 11.2011 10.9006C11.2811 10.6739 11.3944 10.4806 11.5411 10.3206C11.6878 10.1606 11.8678 10.0339 12.0811 9.94059C12.2944 9.84725 12.5311 9.80059 12.7911 9.80059C13.0644 9.80059 13.3078 9.84725 13.5211 9.94059C13.7344 10.0339 13.9111 10.1639 14.0511 10.3306C14.1978 10.4906 14.3078 10.6873 14.3811 10.9206C14.4611 11.1473 14.5011 11.3973 14.5011 11.6706C14.5011 12.2839 14.3444 12.7606 14.0311 13.1006C13.7244 13.4339 13.3111 13.6006 12.7911 13.6006C12.5311 13.6006 12.2778 13.5473 12.0311 13.4406C11.7911 13.3339 11.6144 13.1839 11.5011 12.9906C11.3744 13.2173 11.2111 13.3773 11.0111 13.4706C10.8111 13.5573 10.6144 13.6006 10.4211 13.6006H10.3711C10.2844 13.6006 10.2278 13.5473 10.2011 13.4406C10.1678 13.3273 10.1511 13.1606 10.1511 12.9406C10.1511 12.6873 10.1678 12.5073 10.2011 12.4006C10.2278 12.2873 10.2844 12.2306 10.3711 12.2306H10.4211ZM13.2811 11.7306C13.2811 11.5906 13.2478 11.4639 13.1811 11.3506C13.1144 11.2373 12.9844 11.1806 12.7911 11.1806C12.5978 11.1806 12.4678 11.2373 12.4011 11.3506C12.3344 11.4639 12.3011 11.5906 12.3011 11.7306C12.3011 12.0639 12.4644 12.2306 12.7911 12.2306C13.1178 12.2306 13.2811 12.0639 13.2811 11.7306Z" fill="currentColor"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $count++; ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between xl:flex-row flex-col items-center">
                            <div x-data="{ plan : '' }" class="w-full xl:mb-0 mb-7">
                                <div class="flex flex-col border border-blue-700 dark:border-dark-920 rounded-xl">
                                    <div class="flex items-center justify-between bg-blue-700 dark:bg-dark-920 py-4 px-8 rounded-t-xl">
                                        <div class="text-white">
                                            <span class="text-white text-lg dark:text-white md:text-26 text-sm font-bold">روش های پرداخت</span>
                                        </div>
                                    </div>
                                    <div class="p-5 pb-0">
                                        <div>
                                            <p class="md:text-17 text-base text-gray-360 md:leading-10 dark:text-gray-920 leading-7 mb-8">
                                                <?php if (sizeof($data['payType'])>0){ ?>
                                                    نحوه پرداخت مورد نظر خود را انتخاب نمایید:
                                                <?php } else { ?>
                                                    در حال حاضر درگاه پرداخت فعالی وجود ندارد.
                                                <?php } ?>
                                            </p>
                                            <?php foreach ($data['payType'] as $payType){ ?>
                                                <div class="mb-4">
                                                    <?php
                                                    $classSelect='';
                                                    if($payType['pay_default']==1){
                                                        $classSelect="bg-blue-700 text-white dark:text-black border-transparent dark:bg-gray-900 dark:border-opacity-0 selectedPayType img-grayscale-0";
                                                    } else {
                                                        $classSelect="img-grayscale-100 text-gray-450";
                                                    }
                                                    ?>
                                                    <div onclick="selectPayType(<?= $payType['pay_id'] ?>)" id="payType_<?= $payType['pay_id'] ?>" data-descStatus="<?= ($payType['pay_desc']!=NULL or $payType['pay_desc']!="") ? 1:0; ?>" data-id="<?= Model::encrypt($payType['pay_id'], KEY) ?>" data-desc="<?= $payType['pay_desc'] ?>" class="itemPayType flex hover:opacity-75 items-center justify-between border border-gray-300 border-opacity-30 rounded-xl py-4 sm:pl-7 sm:pr-8 px-4 <?= $classSelect ?> cursor-pointer">
                                                        <div class="sm:col-span-<?= ($payType['pay_icon']!=NULL or $payType['pay_icon']!="") ? 9:12 ?> col-span-<?= ($payType['pay_icon']!=NULL or $payType['pay_icon']!="") ? 9:12 ?> flex items-center justify-start">
                                                            <div class="h-full flex items-center">
                                                                <div class="font-semibold sm:text-xl text-xl"><?= $payType['pay_title'] ?></div>
                                                            </div>
                                                        </div>
                                                        <?php if($payType['pay_icon']!=NULL or $payType['pay_icon']!=""){ ?>
                                                            <div class="sm:col-span-3 col-span-3">
                                                                <div class="h-full flex items-center justify-end">
                                                                    <img class="w-24 h-full mr-5px" src="public/images/<?= $payType['pay_icon'] ?>" alt="تصویر <?= $payType['pay_title'] ?>">
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if($payType['pay_desc']!=NULL or $payType['pay_desc']!=""){ ?>
                                                        <div style="display: none" id="payTypeDesc_<?= $payType['pay_id'] ?>"  x-transition.duration.250ms="" class="descPayment transition mb-5 flex duration-200 mt-5  items-center justify-between bg-dark-550 dark:bg-dark-930 dark:shadow-whiteShadow dark:bg-opacity-100 bg-opacity-10 sm:px-6 px-4 py-5 rounded-lg">
                                                            <p class="text-dark-550 dark:text-gray-920 text-13 sm:text-base"><?= $payType['pay_desc'] ?></p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 col-span-24">
                    <?php if($data['is_vip']) { ?>
                        <div class="flex items-center border-2 border-customOrange-700 px-4 rounded-xl py-2 bg-customOrange-700 bg-opacity-10 mb-3">
                            <svg width="52" height="50" viewBox="0 0 82 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M37.0183 1.30894L28.9189 8.36141H40.5344V2.79688e-05C39.2808 -0.0040244 38.026 0.43228 37.0183 1.30894Z" fill="#FDF0BC"></path>
                                <path d="M44.0058 1.30081C43.0089 0.437656 41.773 0.00405237 40.5356 0V8.36138H52.1511L44.0058 1.30081Z" fill="url(#paint0_linear_3240_36296)"></path>
                                <path d="M12.2798 12.8717L10.6089 23.4807L19.5065 16.0149L14.1317 9.6095C13.1686 10.4119 12.4878 11.5533 12.2798 12.8717Z" fill="#FDF0BC"></path>
                                <path d="M17.6278 8.37493C16.3094 8.35332 15.0829 8.81664 14.1333 9.60955L19.5081 16.015L28.4057 8.54918L17.6278 8.37493Z" fill="url(#paint1_linear_3240_36296)"></path>
                                <path d="M0.763061 37.6316L6.3013 46.8332L8.31802 35.3947L0.084965 33.9413C-0.137915 35.1759 0.0741587 36.4875 0.763061 37.6316Z" fill="#FDF0BC"></path>
                                <path d="M1.96796 30.7494C0.945413 31.5815 0.303789 32.7243 0.0849609 33.9413L8.31937 35.3934L10.3361 23.955L1.96796 30.7494Z" fill="url(#paint2_linear_3240_36296)"></path>
                                <path d="M7.85456 64.0018L18.0125 67.4896L12.2054 57.4302L4.96387 61.6109C5.58658 62.6997 6.59157 63.5682 7.85456 64.0018Z" fill="url(#paint3_linear_3240_36296)"></path>
                                <path d="M4.35488 57.9556C4.10499 59.2497 4.34813 60.5383 4.96274 61.6122L12.2043 57.4315L6.39728 47.3722L4.35488 57.9556Z" fill="url(#paint4_linear_3240_36296)"></path>
                                <path d="M30.2375 79.6439L40.2603 75.7874L29.3459 71.8147L26.4863 79.6723C27.6629 80.1045 28.992 80.1234 30.2375 79.6439Z" fill="url(#paint5_linear_3240_36296)"></path>
                                <path d="M23.6695 77.2611C24.3098 78.4133 25.3242 79.2441 26.4859 79.6709L29.3455 71.8134L18.4312 67.8407L23.6695 77.2611Z" fill="url(#paint6_linear_3240_36296)"></path>
                                <path d="M57.4393 77.2395L62.6385 67.842L51.7241 71.8147L54.5837 79.6723C55.7616 79.2468 56.7923 78.4079 57.4393 77.2395Z" fill="url(#paint7_linear_3240_36296)"></path>
                                <path d="M50.876 79.6358C52.1079 80.1072 53.4182 80.091 54.5826 79.6709L51.723 71.8134L40.8086 75.786L50.876 79.6358Z" fill="url(#paint8_linear_3240_36296)"></path>
                                <path d="M76.73 57.9124L74.6728 47.3722L68.8657 57.4315L76.1073 61.6122C76.7368 60.5275 76.9867 59.2227 76.73 57.9124Z" fill="url(#paint9_linear_3240_36296)"></path>
                                <path d="M73.2439 63.9667C74.4893 63.5358 75.4835 62.6808 76.1062 61.6109L68.8647 57.4302L63.0576 67.4896L73.2439 63.9667Z" fill="url(#paint10_linear_3240_36296)"></path>
                                <path d="M79.0843 30.7062L70.7324 23.955L72.7491 35.3934L80.9836 33.9413C80.7715 32.7067 80.1231 31.5464 79.0843 30.7062Z" fill="url(#paint11_linear_3240_36296)"></path>
                                <path d="M80.3058 37.5857C80.9839 36.4551 81.196 35.161 80.9839 33.9413L72.7495 35.3934L74.7662 46.8319L80.3058 37.5857Z" fill="url(#paint12_linear_3240_36296)"></path>
                                <path d="M63.402 8.35197L52.6646 8.54783L61.5622 16.0136L66.937 9.6082C65.9793 8.80043 64.7379 8.32765 63.402 8.35197Z" fill="url(#paint13_linear_3240_36296)"></path>
                                <path d="M68.759 12.8379C68.551 11.5358 67.8824 10.4092 66.9368 9.6109L61.562 16.0163L70.4597 23.4822L68.759 12.8379Z" fill="url(#paint14_linear_3240_36296)"></path>
                                <path d="M40.534 69.4414C56.2005 69.4414 68.9006 56.7412 68.9006 41.0748C68.9006 25.4084 56.2005 12.7083 40.534 12.7083C24.8676 12.7083 12.1675 25.4084 12.1675 41.0748C12.1675 56.7412 24.8676 69.4414 40.534 69.4414Z" fill="url(#paint15_radial_3240_36296)"></path>
                                <path d="M40.5339 10.1742C23.4681 10.1742 9.6333 24.0076 9.6333 41.0735C9.6333 58.1394 23.4681 71.9741 40.5339 71.9741C57.5998 71.9741 71.4346 58.1394 71.4346 41.0735C71.4346 24.0076 57.5998 10.1742 40.5339 10.1742ZM40.5339 69.4374C24.8688 69.4374 12.1701 56.7386 12.1701 41.0735C12.1701 25.4084 24.8688 12.7096 40.5339 12.7096C56.199 12.7096 68.8978 25.4084 68.8978 41.0735C68.8978 56.7386 56.199 69.4374 40.5339 69.4374Z" fill="url(#paint16_linear_3240_36296)"></path>
                                <path d="M40.5341 6.2312C21.2908 6.2312 5.69189 21.8301 5.69189 41.0735C5.69189 60.3168 21.2908 75.9157 40.5341 75.9157C59.7775 75.9157 75.3764 60.3168 75.3764 41.0735C75.3764 21.8301 59.7775 6.2312 40.5341 6.2312ZM40.5341 71.9592C23.4764 71.9592 9.64836 58.1312 9.64836 41.0735C9.64836 24.0157 23.4764 10.189 40.5341 10.189C57.5919 10.189 71.4199 24.017 71.4199 41.0748C71.4199 58.1326 57.5919 71.9592 40.5341 71.9592Z" fill="url(#paint17_linear_3240_36296)"></path>
                                <path d="M32.7133 55.2892C32.2405 55.2892 31.8015 55.1379 31.4138 54.8677C31.3638 54.834 31.3301 54.8002 31.2963 54.7664C31.2625 54.7502 31.245 54.7165 31.2288 54.6989C31.1612 54.6476 31.1275 54.5976 31.0775 54.5476C31.0437 54.5138 31.0261 54.4801 30.9937 54.4463L30.9775 54.4301C30.9437 54.3963 30.9262 54.3625 30.91 54.3288L30.8762 54.2774C30.8087 54.1761 30.7587 54.0748 30.7074 53.9735C30.6912 53.9235 30.6736 53.8722 30.656 53.8222C30.6398 53.7709 30.6223 53.7047 30.6061 53.6534C30.5885 53.5858 30.5723 53.5021 30.5547 53.417C30.5547 53.3832 30.5385 53.3332 30.5385 53.2995C30.5385 53.2319 30.5223 53.1644 30.5223 53.0969C30.5223 52.9793 30.5385 52.8605 30.5561 52.7254L31.8555 45.1664L26.3713 39.8172C26.27 39.7159 26.1687 39.5984 26.085 39.4796C25.9837 39.3283 25.9161 39.2094 25.8661 39.0743C25.8499 39.0243 25.8162 38.9568 25.7986 38.8717C25.7473 38.6691 25.7148 38.4665 25.7148 38.2476C25.7148 38.1801 25.7148 38.1301 25.7148 38.0626C25.7148 37.9613 25.7311 37.86 25.7648 37.7586C25.7648 37.7424 25.781 37.7087 25.781 37.6911C25.7986 37.6398 25.7986 37.5898 25.8148 37.5398C25.8148 37.5236 25.831 37.4885 25.8486 37.4385C25.8648 37.3872 25.8823 37.3372 25.9161 37.2872C25.9661 37.1859 26.0174 37.0846 26.1012 36.9671C26.1349 36.8995 26.1849 36.8496 26.2362 36.7982C26.2362 36.7982 26.2362 36.782 26.2525 36.782L26.5226 36.343H26.759C26.7928 36.3255 26.809 36.3093 26.8428 36.2917C26.8765 36.2755 26.9441 36.2417 26.994 36.2079C27.0616 36.1742 27.1453 36.1404 27.2466 36.1066C27.2804 36.0904 27.3304 36.0729 27.3817 36.0729C27.4493 36.0567 27.5168 36.0391 27.6005 36.0215L35.1933 34.9247L38.5338 28.0911C38.9053 27.3319 39.6644 26.8591 40.5073 26.8591C41.1152 26.8591 41.7055 27.1117 42.1269 27.5507C42.1945 27.6345 42.262 27.702 42.312 27.7871C42.3795 27.8884 42.4471 27.9897 42.497 28.0911L45.8889 34.9409L53.4641 36.0377C54.3083 36.1553 55 36.7469 55.2526 37.556C55.2701 37.6074 55.2863 37.6398 55.2863 37.6911C55.2863 37.7073 55.2863 37.7073 55.3025 37.7249C55.3187 37.7762 55.3363 37.8262 55.3363 37.8937C55.3363 37.9099 55.3363 37.9099 55.3363 37.9275C55.3525 37.995 55.3525 38.045 55.3525 38.1126C55.3701 38.4327 55.3187 38.7704 55.1837 39.0743C55.1323 39.2094 55.0661 39.3269 54.981 39.4458L54.9635 39.462C54.8797 39.5795 54.7784 39.6984 54.6771 39.7997L49.1929 45.1488L50.4924 52.6903C50.6274 53.517 50.3073 54.3436 49.6144 54.8502C49.4455 54.9677 49.2429 55.0866 49.0403 55.1541C49.0227 55.1541 49.0065 55.1717 48.9727 55.1717C48.7539 55.2392 48.5337 55.273 48.3149 55.273C47.961 55.273 47.6057 55.1892 47.2856 55.0204L40.5033 51.4597L33.721 55.0204C33.4211 55.2054 33.0672 55.2892 32.7133 55.2892Z" fill="#DF771E"></path>
                                <path d="M40.5071 27.9384V41.8921L35.8496 35.9364L39.494 28.5638C39.7142 28.1586 40.1195 27.9384 40.5071 27.9384Z" fill="#FFFAF6"></path>
                                <path d="M54.2245 37.9112L40.5234 41.8934L45.1796 35.9377L53.3127 37.1183C53.7693 37.2021 54.0894 37.5222 54.2245 37.9112Z" fill="#FEE0AC"></path>
                                <path d="M48.9782 53.9898L40.5088 41.8921L48.034 44.7774L49.4172 52.8767C49.5172 53.3495 49.3146 53.7534 48.9782 53.9898Z" fill="#ECB76B"></path>
                                <path d="M40.5074 41.8921V50.244L33.2348 54.0735C32.8133 54.2923 32.3743 54.2248 32.0366 53.9898L40.5074 41.8921Z" fill="#F1A341"></path>
                                <path d="M45.1648 35.9364L40.5073 41.8921V27.9384C40.8113 27.9384 41.1152 28.0559 41.334 28.2923C41.3678 28.3261 41.4015 28.3761 41.4353 28.4274C41.4691 28.4787 41.5029 28.5287 41.5191 28.5787L45.1648 35.9364Z" fill="#FFE9BA"></path>
                                <path d="M54.1908 38.6704C54.1571 38.738 54.1233 38.8055 54.0895 38.873C54.0382 38.9406 53.9882 38.9906 53.9382 39.0581L48.0501 44.7949L40.5249 41.9096L54.226 37.9275C54.226 37.9437 54.2422 37.9613 54.2422 37.9788C54.2422 37.9964 54.2597 38.0126 54.2597 38.0464C54.2597 38.0639 54.2597 38.0639 54.2597 38.0639C54.2597 38.0801 54.2597 38.0977 54.2597 38.1139C54.2597 38.1477 54.2597 38.1652 54.2597 38.1976C54.2759 38.3489 54.2584 38.5178 54.1908 38.6704Z" fill="#E49632"></path>
                                <path d="M48.9781 53.9898C48.8944 54.0573 48.7931 54.1073 48.6742 54.141C48.658 54.141 48.658 54.141 48.6404 54.1573C48.3703 54.241 48.0663 54.2248 47.78 54.0735L40.5073 50.244V41.8921L48.9781 53.9898Z" fill="#E29136"></path>
                                <path d="M40.5072 41.8921L32.0378 53.9898C32.0215 53.9722 32.004 53.956 31.9878 53.9384C31.9716 53.9222 31.954 53.9047 31.9364 53.8871C31.9202 53.8709 31.9027 53.8533 31.8689 53.8196C31.8513 53.8033 31.8351 53.7858 31.8176 53.7682C31.8 53.7507 31.8014 53.752 31.8014 53.7345C31.7852 53.7182 31.7676 53.7007 31.7676 53.6831C31.7338 53.6331 31.7001 53.5818 31.6838 53.5318C31.6676 53.5156 31.6676 53.4805 31.6501 53.4481C31.6339 53.4143 31.6339 53.3968 31.6163 53.3643C31.6001 53.3306 31.6001 53.2806 31.6001 53.2468C31.6001 53.2306 31.6001 53.1955 31.6001 53.1793C31.6001 53.1455 31.6001 53.1117 31.6001 53.078C31.6001 53.0104 31.6001 52.9429 31.6163 52.8754L32.9995 44.776L40.5072 41.8921Z" fill="#FED891"></path>
                                <path d="M40.5072 41.8921L26.8062 37.9099C26.8062 37.8937 26.8224 37.8762 26.8224 37.8586C26.8386 37.8248 26.8386 37.7911 26.8561 37.7748C26.8899 37.7073 26.9237 37.6573 26.9574 37.606C26.9737 37.5722 26.9912 37.5547 27.025 37.5223C27.0425 37.506 27.0588 37.4709 27.0925 37.4547C27.1087 37.4385 27.1439 37.4047 27.1601 37.3872C27.1763 37.3696 27.21 37.3534 27.2276 37.3358C27.2614 37.3196 27.2951 37.2845 27.3289 37.2683C27.3451 37.2521 27.3789 37.2345 27.4127 37.2345C27.464 37.2183 27.4964 37.2008 27.5477 37.1832C27.5639 37.1832 27.5815 37.167 27.6153 37.167C27.649 37.1508 27.699 37.1508 27.7504 37.1332L35.8835 35.9526L40.5072 41.8921Z" fill="#FFF3D9"></path>
                                <path d="M40.5074 41.8921L32.9997 44.7936L27.1116 39.0568C27.0441 39.0054 27.0103 38.9392 26.9603 38.8717C26.9266 38.8042 26.8766 38.7366 26.859 38.6691C26.8428 38.6353 26.8253 38.6015 26.8253 38.5678C26.7915 38.4665 26.7739 38.349 26.7739 38.2476C26.7739 38.2139 26.7739 38.1801 26.7739 38.1463C26.7739 38.0964 26.7739 38.0626 26.7915 38.0113C26.7915 37.995 26.8077 37.9775 26.8077 37.9437C26.8077 37.9275 26.8239 37.9099 26.8239 37.8937L40.5074 41.8921Z" fill="#ECB76B"></path>
                                <defs>
                                    <linearGradient id="paint0_linear_3240_36296" x1="41.1036" y1="4.18069" x2="51.7699" y2="4.18069" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FEE998"></stop>
                                        <stop offset="1" stop-color="#FCC15B"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_3240_36296" x1="17.3811" y1="12.3392" x2="28.0262" y2="3.40617" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FEE998"></stop>
                                        <stop offset="1" stop-color="#FCC15B"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint2_linear_3240_36296" x1="10.5266" y1="23.931" x2="4.51958" y2="33.7997" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCC15B"></stop>
                                        <stop offset="1" stop-color="#FEE998"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint3_linear_3240_36296" x1="7.70257" y1="59.2865" x2="18.1434" y2="66.1517" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFC05F"></stop>
                                        <stop offset="1" stop-color="#ED892B"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint4_linear_3240_36296" x1="6.51635" y1="47.5911" x2="8.37567" y2="59.3192" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCC15B"></stop>
                                        <stop offset="1" stop-color="#FEE998"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint5_linear_3240_36296" x1="28.4389" y1="75.8835" x2="38.7366" y2="78.1719" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FEAC3E"></stop>
                                        <stop offset="1" stop-color="#F08223"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint6_linear_3240_36296" x1="17.9161" y1="67.7511" x2="27.3557" y2="75.4744" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFA135"></stop>
                                        <stop offset="1" stop-color="#FEB431"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint7_linear_3240_36296" x1="62.6794" y1="67.7748" x2="53.2637" y2="75.8796" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFAA3D"></stop>
                                        <stop offset="1" stop-color="#ED8B1C"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint8_linear_3240_36296" x1="40.8499" y1="76.5382" x2="52.864" y2="75.8708" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF962D"></stop>
                                        <stop offset="1" stop-color="#E56005"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint9_linear_3240_36296" x1="75.1143" y1="47.4145" x2="72.6987" y2="59.1743" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FDBD41"></stop>
                                        <stop offset="1" stop-color="#FEB334"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint10_linear_3240_36296" x1="78.2796" y1="49.4848" x2="66.6643" y2="69.6026" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#F6942F"></stop>
                                        <stop offset="1" stop-color="#EA6F11"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint11_linear_3240_36296" x1="70.1494" y1="24.2932" x2="77.1417" y2="34.6546" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FDBD41"></stop>
                                        <stop offset="1" stop-color="#FEB334"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint12_linear_3240_36296" x1="74.3309" y1="46.8026" x2="77.0643" y2="34.725" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FD9D24"></stop>
                                        <stop offset="1" stop-color="#FF9515"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint13_linear_3240_36296" x1="64.1149" y1="12.6534" x2="53.3085" y2="7.441" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCC15B"></stop>
                                        <stop offset="1" stop-color="#FEE998"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint14_linear_3240_36296" x1="64.1667" y1="11.9916" x2="69.3156" y2="23.4335" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FF9515"></stop>
                                        <stop offset="1" stop-color="#FFBE41"></stop>
                                    </linearGradient>
                                    <radialGradient id="paint15_radial_3240_36296" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(40.5342 41.0743) scale(28.3666)">
                                        <stop offset="0.8428" stop-color="#FAAA31"></stop>
                                        <stop offset="1" stop-color="#F57E16"></stop>
                                    </radialGradient>
                                    <linearGradient id="paint16_linear_3240_36296" x1="40.5342" y1="10.1737" x2="40.5342" y2="71.9749" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.0226" stop-color="#FD9A18"></stop>
                                        <stop offset="0.3764" stop-color="#FEC752"></stop>
                                        <stop offset="1" stop-color="#FFA422"></stop>
                                    </linearGradient>
                                    <linearGradient id="paint17_linear_3240_36296" x1="40.5344" y1="6.12908" x2="40.5344" y2="75.8139" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FFDB69"></stop>
                                        <stop offset="0.1799" stop-color="#FEE7B0"></stop>
                                        <stop offset="0.24" stop-color="#FEE9BA"></stop>
                                        <stop offset="0.2592" stop-color="#FDECD0"></stop>
                                        <stop offset="0.2953" stop-color="#FEDA92"></stop>
                                        <stop offset="0.3254" stop-color="#FFCD64"></stop>
                                        <stop offset="0.3405" stop-color="#FFC853"></stop>
                                        <stop offset="0.7613" stop-color="#FF9114"></stop>
                                        <stop offset="1" stop-color="#F57E16"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                            <div class="mr-2 mt-2 space-y-2">
                                <h4 class="text-customOrange-700 dark:text-white text-2xl font-semibold mb-1">خدمت ویژه</h4>
                            </div>
                        </div>
                    <?php } ?>

                    <div wire:id="q5GAMzQvS00Sn0N2ubzi" class="relative bg-white dark:bg-dark-930 dark:shadow-whiteShadow shadow-sm overflow-hidden rounded-xl xl:px-7 px-5 py-6">
                        <i class="w-24 h-24 bg-blue-700 rounded-full bg-opacity-5 absolute -top-5 -left-14">
                            <i class="w-14 h-14 bg-blue-700 rounded-full bg-opacity-5 absolute top-1/2 transform -translate-y-1/2 right-1/2 translate-x-1/2">
                                <i class="w-8 h-8 bg-blue-700 rounded-full bg-opacity-5 absolute top-1/2 transform -translate-y-1/2 right-1/2 translate-x-1/2"></i>
                            </i>
                        </i>
                        <h3 class="text-blue-700 dark:text-white xl:text-33 text-28 font-bold pb-3 border-b border-gray-300 border-opacity-10 mb-6">
                            اطلاعات پرداخت
                        </h3>
                        <div>
                            <div class="pb-6 border-b border-gray-300 border-opacity-10 mb-8">
                                <label class="text-biscay-700 dark:text-white font-semibold text-base">
                                    کد تخفیف
                                </label>
                                <div class="relative">
                                    <div class="relative">
                                        <input value="<?= $data['offCodeUsed'][0]['dc_code'] ?? ""; ?>" class="bg-biscay-700 dark:bg-dark-890 text-sm font-medium bg-opacity-5 dark:text-white outline-none border-0 text-dark-550 rounded w-full h-11 placeholder-gray-300 " type="text" id="discountCode" placeholder="کد تخفیف را وارد کنید">

                                        <div class="absolute top-1/2 transform -translate-y-1/2  left-3 flex items-center">
                                            <button id="submitGiftCode" class="text-xs bg-blue-700 dark:bg-dark-930 text-white p-1 px-2 rounded-lg hover:bg-opacity-80"  data-status="<?= $data['offCodeUsed'][0]['dc_code']!="" ? "delete":"confirm" ?>" name="apply_coupon"><?= $data['offCodeUsed'][0]['dc_code']!="" ? "حذف کد":"اعمال کد" ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between ">
                                        <span class="text-biscay-700 dark:text-white text-17 font-semibold">
                                            هزینه خدمت
                                        </span>
                                        <span class="flex items-center font-semibold text-2xl text-gray-500 dark:text-gray-920">
                                            <span id="price">0</span>
                                            <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="#98A3B8"></path>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between ">
                                        <span class="text-biscay-700 dark:text-white text-17 font-semibold">
                                            بیعانه
                                        </span>
                                        <span class="flex items-center font-semibold text-2xl text-gray-500 dark:text-gray-920">
                                            <span id="deposit">0</span>
                                            <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="#98A3B8"></path>
                                            </svg>
                                        </span>
                                    </div>

                                    <?php if($data['getPublicInfo']['active_wallet'] == "1") { ?>
                                        <div class="flex items-center justify-between ">
                                            <span class="text-biscay-700 dark:text-white text-17 font-semibold">
                                            موجودی کیف پول
                                            </span>
                                            <span class="flex items-center font-semibold text-2xl text-gray-500 dark:text-gray-920">
                                                <span id="wallet">0</span>
                                                <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="currentColor" fill-opacity=".7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    <?php } ?>

                                    <div class="flex items-center justify-between">
                                        <span class="text-biscay-700 dark:text-white text-17 font-semibold">
                                            تخفیف
                                        </span>
                                        <span class="flex items-center font-semibold text-2xl text-gray-500 dark:text-gray-920">
                                            <span data-price="0" id="offer">0</span>
                                            <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="currentColor" fill-opacity=".7"></path>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <span class="text-biscay-700 dark:text-white text-17 font-semibold">
                                            هزینه کل خدمت
                                        </span>
                                        <span class="flex items-center font-semibold text-2xl text-gray-500 dark:text-gray-920">
                                            <span data-price="0" id="total_pay">0</span>
                                            <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="#98A3B8"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-500 border-solid border-opacity-20 pt-4 mt-4 ">
                                    <span class="text-biscay-700 text-17 dark:text-white font-semibold">
                                        مبلغ قابل پرداخت
                                    </span>
                                    <span class="flex items-center font-semibold text-33 dark:text-white text-blue-700">
                                        <span data-price="0" id="total">
                                            0
                                        </span>
                                        <svg class="mr-1" width="19" height="20" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.30583 6.0764C1.56819 6.0764 1.79775 6.03467 1.99452 5.95119C2.19725 5.86771 2.36719 5.75442 2.50433 5.61131C2.64147 5.46821 2.74582 5.30125 2.81737 5.11045C2.88892 4.9256 2.93066 4.72884 2.94259 4.52014H2.04818C1.74409 4.52014 1.49365 4.48735 1.29689 4.42176C1.10012 4.35617 0.945087 4.26076 0.831796 4.13555C0.718504 4.01033 0.638008 3.86126 0.590307 3.68835C0.548568 3.50947 0.527698 3.30972 0.527698 3.0891C0.527698 2.86251 0.560493 2.64786 0.626083 2.44512C0.691672 2.24239 0.787075 2.06351 0.912292 1.90848C1.03751 1.75345 1.19254 1.63122 1.37738 1.54178C1.56819 1.44637 1.78583 1.39867 2.0303 1.39867C2.22707 1.39867 2.41489 1.43147 2.59377 1.49706C2.77265 1.56265 2.93066 1.66699 3.06781 1.8101C3.20495 1.94724 3.31228 2.1291 3.38979 2.35568C3.47327 2.5763 3.51501 2.84462 3.51501 3.16065V3.903H4.37363C4.44519 3.903 4.49289 3.92984 4.51674 3.9835C4.54655 4.0312 4.56146 4.10573 4.56146 4.2071C4.56146 4.31443 4.54655 4.39493 4.51674 4.44859C4.49289 4.49629 4.44519 4.52014 4.37363 4.52014H3.49712C3.48519 4.81231 3.42557 5.08958 3.31824 5.35194C3.21687 5.6143 3.07377 5.84386 2.88892 6.04063C2.70408 6.2374 2.48346 6.39243 2.22707 6.50572C1.97067 6.62497 1.68148 6.6846 1.35949 6.6846H0.411426L0.357762 6.0764H1.30583ZM1.08223 3.05332C1.08223 3.20239 1.09714 3.33058 1.12695 3.43791C1.16272 3.54524 1.21937 3.63468 1.29689 3.70623C1.38036 3.77182 1.49067 3.82251 1.62782 3.85828C1.76496 3.8881 1.93788 3.903 2.14657 3.903H2.95153V3.2322C2.95153 2.79096 2.86507 2.47494 2.69216 2.28413C2.51924 2.09333 2.28073 1.99792 1.97663 1.99792C1.69042 1.99792 1.4698 2.09333 1.31477 2.28413C1.15974 2.47494 1.08223 2.73133 1.08223 3.05332ZM5.85171 3.903C5.92922 3.903 5.97991 3.92984 6.00376 3.9835C6.03357 4.0312 6.04848 4.10573 6.04848 4.2071C6.04848 4.31443 6.03357 4.39493 6.00376 4.44859C5.97991 4.49629 5.92922 4.52014 5.85171 4.52014H4.37594C4.29843 4.52014 4.24774 4.49629 4.22389 4.44859C4.19408 4.40089 4.17917 4.32635 4.17917 4.22499C4.17917 4.11766 4.19408 4.03716 4.22389 3.9835C4.24774 3.92984 4.29843 3.903 4.37594 3.903H5.85171ZM7.32782 3.903C7.40534 3.903 7.45602 3.92984 7.47987 3.9835C7.50969 4.0312 7.52459 4.10573 7.52459 4.2071C7.52459 4.31443 7.50969 4.39493 7.47987 4.44859C7.45602 4.49629 7.40534 4.52014 7.32782 4.52014H5.85206C5.77454 4.52014 5.72386 4.49629 5.70001 4.44859C5.67019 4.40089 5.65529 4.32635 5.65529 4.22499C5.65529 4.11766 5.67019 4.03716 5.70001 3.9835C5.72386 3.92984 5.77454 3.903 5.85206 3.903H7.32782ZM8.80394 3.903C8.88145 3.903 8.93214 3.92984 8.95599 3.9835C8.9858 4.0312 9.00071 4.10573 9.00071 4.2071C9.00071 4.31443 8.9858 4.39493 8.95599 4.44859C8.93214 4.49629 8.88145 4.52014 8.80394 4.52014H7.32817C7.25066 4.52014 7.19997 4.49629 7.17612 4.44859C7.14631 4.40089 7.1314 4.32635 7.1314 4.22499C7.1314 4.11766 7.14631 4.03716 7.17612 3.9835C7.19997 3.92984 7.25066 3.903 7.32817 3.903H8.80394ZM10.2801 3.903C10.3576 3.903 10.4083 3.92984 10.4321 3.9835C10.4619 4.0312 10.4768 4.10573 10.4768 4.2071C10.4768 4.31443 10.4619 4.39493 10.4321 4.44859C10.4083 4.49629 10.3576 4.52014 10.2801 4.52014H8.80429C8.72677 4.52014 8.67609 4.49629 8.65224 4.44859C8.62243 4.40089 8.60752 4.32635 8.60752 4.22499C8.60752 4.11766 8.62243 4.03716 8.65224 3.9835C8.67609 3.92984 8.72677 3.903 8.80429 3.903H10.2801ZM11.0854 3.903C11.3179 3.903 11.5028 3.84039 11.6399 3.71518C11.783 3.58996 11.8546 3.41704 11.8546 3.19642V1.96215H12.4359V3.19642C12.4359 3.61978 12.3167 3.94772 12.0782 4.18027C11.8456 4.40685 11.5266 4.52014 11.1211 4.52014H10.2804C10.2029 4.52014 10.1522 4.49629 10.1284 4.44859C10.0985 4.40089 10.0836 4.32635 10.0836 4.22499C10.0836 4.11766 10.0985 4.03716 10.1284 3.9835C10.1522 3.92984 10.2029 3.903 10.2804 3.903H11.0854ZM12.5254 0.817309H11.8098V0.182283H12.5254V0.817309ZM11.3895 0.817309H10.6739V0.182283H11.3895V0.817309ZM5.29487 11.3413C5.29487 11.6632 5.24419 11.9644 5.14282 12.2446C5.04146 12.5308 4.89537 12.7783 4.70456 12.987C4.51376 13.2016 4.28121 13.3716 4.00693 13.4968C3.73861 13.622 3.43451 13.6846 3.09464 13.6846H2.56694C1.89912 13.6846 1.38036 13.4789 1.01068 13.0675C0.640989 12.656 0.456146 12.0926 0.456146 11.377V9.81183H1.02856V11.3591C1.02856 11.6155 1.05838 11.8481 1.118 12.0568C1.18359 12.2655 1.28198 12.4444 1.41316 12.5934C1.5503 12.7485 1.72024 12.8677 1.92297 12.9512C2.1257 13.0347 2.37017 13.0764 2.65638 13.0764H3.04992C3.33016 13.0764 3.57463 13.0287 3.78333 12.9333C3.99202 12.8439 4.16494 12.7216 4.30208 12.5666C4.44519 12.4116 4.54953 12.2297 4.61512 12.021C4.68668 11.8123 4.72245 11.5947 4.72245 11.3681V8.96215H5.29487V11.3413ZM3.13936 8.76538H2.38806V8.11246H3.13936V8.76538ZM7.60635 11.5201C7.45132 11.5201 7.30225 11.4993 7.15914 11.4575C7.01604 11.4098 6.88784 11.3323 6.77455 11.225C6.66722 11.1177 6.58076 10.9775 6.51517 10.8046C6.44958 10.6257 6.41679 10.4051 6.41679 10.1428V5.97484H6.99815V10.0354C6.99815 10.2859 7.05182 10.4946 7.15914 10.6615C7.27243 10.8225 7.4543 10.903 7.70473 10.903H7.85678C7.98796 10.903 8.05355 11.0044 8.05355 11.2071C8.05355 11.4158 7.98796 11.5201 7.85678 11.5201H7.60635ZM8.00408 10.903C8.23662 10.903 8.41252 10.8464 8.53177 10.7331C8.65103 10.6198 8.71065 10.4677 8.71065 10.2769V9.93705C8.71065 9.41829 8.84183 9.01283 9.10419 8.72066C9.37251 8.42849 9.7422 8.2824 10.2133 8.2824C10.4577 8.2824 10.6724 8.32116 10.8572 8.39867C11.0421 8.47619 11.1941 8.5865 11.3134 8.7296C11.4386 8.87271 11.531 9.04264 11.5906 9.23941C11.6503 9.43618 11.6801 9.65382 11.6801 9.89233C11.6801 10.4051 11.5459 10.8046 11.2776 11.0908C11.0093 11.377 10.6426 11.5201 10.1775 11.5201C9.93897 11.5201 9.70941 11.4754 9.48879 11.386C9.26817 11.2906 9.09525 11.1236 8.97003 10.8851C8.91637 11.0223 8.85078 11.1326 8.77326 11.216C8.69575 11.2995 8.61525 11.3651 8.53177 11.4128C8.4483 11.4546 8.35886 11.4844 8.26345 11.5023C8.17401 11.5142 8.08755 11.5201 8.00408 11.5201H7.86097C7.78346 11.5201 7.73277 11.4963 7.70892 11.4486C7.67911 11.4009 7.6642 11.3264 7.6642 11.225C7.6642 11.1177 7.67911 11.0372 7.70892 10.9835C7.73277 10.9298 7.78346 10.903 7.86097 10.903H8.00408ZM11.1077 9.94599C11.1077 9.63593 11.0391 9.3855 10.9019 9.19469C10.7648 8.99792 10.5293 8.89954 10.1954 8.89954C9.57525 8.89954 9.26519 9.26028 9.26519 9.98177C9.26519 10.2859 9.34866 10.5154 9.51562 10.6705C9.68854 10.8255 9.90916 10.903 10.1775 10.903C10.4816 10.903 10.7111 10.8195 10.8662 10.6526C11.0272 10.4856 11.1077 10.2501 11.1077 9.94599Z" fill="#98A3B8"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button id="pay" class="noTariff group bg-blue-700 dark:bg-blue-450 dark:border-blue-450 dark:hover:text-blue-450 text-white dark:hover:bg-transparent rounded-lg xl:h-18 h-16 border-2 border-blue-700 w-full flex justify-center items-center mt-5 font-semibold xl:text-22 text-lg transition duration-200 hover:bg-white hover:text-blue-700">
                            تکمیل فرایند رزرو نوبت
                            <svg class="mr-4" width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="currentColor" d="M8.5 15L1.5 8L8.5 1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/showTimer.min.js"></script>

<script>
    window.Alpine.start();
</script>

<script>
    function calculatePayment(item){
        $( ".itemTariff").removeClass( 'bg-blue-700')
            .removeClass( 'border-transparent')
            .removeClass( 'selected')
            .removeClass( 'img-grayscale-0')
            .removeClass( 'text-white')
            .removeClass( 'dark:text-black')
            .removeClass( 'dark:bg-gray-900')
            .removeClass( 'dark:border-opacity-0')
            .addClass( 'text-gray-450')
            .addClass( 'img-grayscale-100');

        $("#pay").addClass( 'noTariff');

        if (!$(item).hasClass('selected')) {
            $(item).addClass( 'bg-blue-700')
                .addClass( 'border-transparent')
                .addClass( 'selected')
                .addClass( 'img-grayscale-0')
                .addClass( 'text-white')
                .addClass( 'dark:text-black')
                .removeClass( 'text-gray-450')
                .addClass( 'dark:bg-gray-900')
                .addClass( 'dark:border-opacity-0');

            var formData = new FormData();
            formData.append("operator_id", $(item).attr("data-operator"));
            formData.append("service_id", "<?= Model::encrypt($data['services']['s_id'], KEY) ?>");
            formData.append("is_vip", "<?= Model::encrypt($data['is_vip'], KEY) ?>");
            $.ajax({
                url: "bookedInit/calculatePayment",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "ok") {
                        $("#price").text(data.data.price);
                        $("#deposit").text(data.data.deposit);
                        $('#offer').text(data.data.offer);
                        $("#total_pay").text(data.data.total_pay);
                        $("#total").text(data.data.total);

                        $("#pay").removeClass('noTariff');

                        if(data.data.offer == 0) {
                            $('#discountCode').val("");
                            $("#submitGiftCode").data('status', "confirm");
                            $("#submitGiftCode").text("اعمال کد");
                        } else {
                            $('#discountCode').val(data.data.code);
                            $("#submitGiftCode").data('status', "delete");
                            $("#submitGiftCode").text("حذف کد");
                        }
                        $('#offer').val(0);
                    } else {
                        errortoast.fire({title: data.msg});
                    }
                },
            });
        }
    }

    function selectPayType(id){
        $( ".itemPayType").removeClass( 'bg-blue-700').removeClass( 'border-transparent').removeClass( 'selectedPayType').removeClass( 'img-grayscale-0').addClass( 'img-grayscale-100').removeClass( 'text-white').removeClass( 'dark:text-black').addClass( 'text-gray-450').removeClass( 'dark:bg-gray-900').removeClass( 'dark:border-opacity-0');

        $(".descPayment").hide();

        if (!$( "#payType_"+id ).hasClass('selectedPayType')) {
            if($("#payType_" + id).attr("data-descStatus")){
                $("#payTypeDesc_"+id).show();
            }
            $( "#payType_"+id ).addClass( 'bg-blue-700').addClass( 'border-transparent').addClass( 'selectedPayType').addClass( 'img-grayscale-0').addClass( 'text-white').addClass( 'dark:text-black').removeClass( 'text-gray-450').addClass( 'dark:bg-gray-900').addClass( 'dark:border-opacity-0');
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#pay").on("click", function () {
            if (!$("#pay").hasClass('noTariff') && $('.selectedPayType').length > 0 && $('.selected').length > 0) {
                var discountCode = document.getElementById("discountCode").value;

                var formData = new FormData();
                formData.append("serviceId", "<?= $data['bookedInfo']['serviceId'] ?>");
                formData.append("code", discountCode);
                formData.append("date", "<?= $data['bookedInfo']['date'] ?>");
                formData.append("time", "<?= $data['bookedInfo']['time'] ?>");
                formData.append("tariff", $(".selected").attr("data-tariff"));
                formData.append("gateway", $(".selectedPayType").attr("data-id"));
                formData.append("status", $("#submitGiftCode").data('status'));
                $.ajax({
                    url: "bookedInit/saveOrder",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);

                        if (data.status == "success") {
                            window.location = data.link;
                        } else {
                            errortoast.fire({title: data.msg});
                        }
                    },
                });
            } else {
                if($('.selectedPayType').length == 0) {
                    warningtoast.fire({title: "نحوه پرداخت هزینه خدمت را انتخاب نمایید."});
                } else {
                    warningtoast.fire({title: "ابتدا می بایست یکی از پرسنل را انتخاب نمایید."});
                }
            }
        });
    });
</script>

<script>
    $(function () {
        $('#timer').showTimer({
            'returnType': 'box',
            'wrapper_id': 'wrapper2',
            'local_s_days': 'روز',
            'local_s_hrs': 'ساعت',
            'local_s_min': 'دقیقه',
            'local_s_sec': 'ثانیه',
            'local_l_days': 'روز',
            'local_l_hrs': 'ساعت',
            'local_l_min': 'دقیقه',
            'local_l_sec': 'ثانیه',
        });
    });
</script>

<script>
    $("#submitGiftCode").on('click', function () {
        var discountCode = document.getElementById("discountCode").value;

        if (discountCode != "") {
            var formData = new FormData();
            formData.append("serviceId", '<?= $data['bookedInfo']['serviceId'] ?>');
            formData.append("code", discountCode);
            formData.append("tariff", $(".selected").attr("data-tariff"));
            formData.append("status", $("#submitGiftCode").data('status'));
            $.ajax({
                url: "bookedInit/checkCode",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);
                    if(data.status=="success"){
                        successtoast.fire({title: data.text});
                    } else {
                        errortoast.fire({title: data.text});
                    }

                    if(data.status=="success") {
                        if ($("#submitGiftCode").data('status')=="confirm"){
                            $("#submitGiftCode").data('status', "delete");
                            $(".selected").data("data-offer", parseInt(data.offer));
                            $("#submitGiftCode").text("حذف کد");
                            $('#offer').attr('data-price', parseInt(data.offer));
                        } else {
                            $("#submitGiftCode").data('status', "confirm");
                            $("#submitGiftCode").text("اعمال کد");
                            $('#offer').attr('data-price', 0);
                            $(".selected").data("data-offer", 0);
                        }
                        $('#offer').text(numberWithCommas(parseInt(data.offer)));
                        $('#total_pay').text(numberWithCommas(parseInt(data.price_principal) - parseInt(data.offer)));
                        if(data.deposit_amount=="0") {
                            $('#total').text(numberWithCommas(parseInt(data.price_principal) - parseInt(data.offer)));
                        }
                    }
                },
            });
        } else {
            warningtoast.fire({title: "ابتدا کد تخفیف را وارد نمایید."});
        }
    });
</script>

</body>
</html>