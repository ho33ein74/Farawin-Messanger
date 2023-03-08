<?php
$activeMenu = 'services';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>نوبت های من | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>user/reservations" rel="alternate"/>
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

                <div wire:id="owwS736gNsIgu1p8Cri5" x-data="{ activeState : 'awaiting-part' }">

                    <div x-data="{state:'نوبت های در انتظار تکمیل'}" class="relative lg:hidden group mb-6 lg:w-1/3 sm:w-2/5">
                        <div class=" bg-white cursor-pointer  py-2 flex items-center justify-between px-3 h-12 rounded">
                            <span class="flex font-medium text-lg text-blue-700 items-center">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 11C0.75 13.2475 0.871405 15.0024 1.17704 16.3776C1.48077 17.7443 1.9564 18.6896 2.63339 19.3666C3.31039 20.0436 4.25571 20.5192 5.62241 20.823C6.99762 21.1286 8.75249 21.25 11 21.25C13.2475 21.25 15.0024 21.1286 16.3776 20.823C17.7443 20.5192 18.6896 20.0436 19.3666 19.3666C20.0436 18.6896 20.5192 17.7443 20.823 16.3776C21.1286 15.0024 21.25 13.2475 21.25 11C21.25 8.75249 21.1286 6.99762 20.823 5.62241C20.5192 4.25571 20.0436 3.31039 19.3666 2.63339C18.6896 1.9564 17.7443 1.48077 16.3776 1.17704C15.0024 0.871405 13.2475 0.75 11 0.75C8.75249 0.75 6.99762 0.871405 5.62241 1.17704C4.25571 1.48077 3.31039 1.9564 2.63339 2.63339C1.9564 3.31039 1.48077 4.25571 1.17704 5.62241C0.871405 6.99762 0.75 8.75249 0.75 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path opacity="0.4" d="M11.0001 6.41663V15.5833M15.5834 10.0833V15.5833M6.41675 11.9166V15.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span x-text="state" class="mr-2">نوبت های در انتظار تکمیل</span>
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
                                    <button @click="activeState = 'awaiting-part'" wire:click.prevent="$set('type','awaiting-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 -mt-1" width="18" height="18" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.125 7.66667C17.4786 7.66667 15.3333 5.52136 15.3333 2.875C15.3333 1.90785 15.6199 1.00763 16.1127 0.254587C14.817 0.0726507 13.2917 0 11.5 0C2.02975 0 0 2.02975 0 11.5C0 20.9702 2.02975 23 11.5 23C20.9702 23 23 20.9702 23 11.5C23 9.70834 22.9273 8.183 22.7454 6.88733C21.9924 7.38013 21.0921 7.66667 20.125 7.66667ZM5.39746 14.3078C5.88929 14.5024 6.4457 14.2617 6.64075 13.7702C6.64075 13.7702 6.64113 13.7692 5.75 13.4167L6.64113 13.7692L6.64511 13.7594C6.64891 13.7501 6.65517 13.7349 6.6638 13.7144C6.68109 13.6733 6.70783 13.6111 6.74348 13.5322C6.81496 13.3739 6.92116 13.1506 7.05756 12.8963C7.33667 12.376 7.7155 11.7765 8.15035 11.3302C8.60321 10.8655 8.96617 10.7168 9.23262 10.7343C9.47541 10.7502 9.99147 10.9311 10.6951 12.0201C11.5395 13.327 12.5162 14.1044 13.6419 14.1783C14.7438 14.2506 15.6248 13.6207 16.2224 13.0073C16.8381 12.3755 17.3162 11.5974 17.6315 11.0096C17.7923 10.7099 17.9176 10.4465 18.0033 10.2567C18.0463 10.1615 18.0796 10.0842 18.1027 10.0294C18.1142 10.0019 18.1233 9.98002 18.1297 9.96426L18.1374 9.94528L18.1398 9.93935L18.1406 9.9373C18.1406 9.9373 18.1411 9.93587 17.25 9.58333L18.1411 9.93587C18.3358 9.44371 18.0947 8.8869 17.6025 8.6922C17.1107 8.49762 16.5542 8.73834 16.3592 9.2299L16.3589 9.2308L16.3549 9.2406L16.3454 9.26355L16.3362 9.28564C16.3189 9.3267 16.2922 9.38886 16.2565 9.46779C16.185 9.62607 16.0788 9.84937 15.9424 10.1037C15.6633 10.624 15.2845 11.2235 14.8497 11.6698C14.3968 12.1345 14.0339 12.2832 13.7674 12.2657C13.5246 12.2498 13.0086 12.0689 12.3049 10.9799C11.4605 9.67304 10.4838 8.89562 9.35819 8.82172C8.25625 8.74937 7.37521 9.37932 6.77758 9.99267C6.16194 10.6245 5.68379 11.4026 5.36854 11.9904C5.20775 12.2901 5.08243 12.5535 4.99669 12.7433C4.95372 12.8385 4.92042 12.9158 4.89732 12.9706C4.88576 12.9981 4.87674 13.02 4.87031 13.0357L4.86262 13.0547L4.86025 13.0606L4.85944 13.0627C4.85944 13.0627 4.85887 13.0641 5.75 13.4167L4.85887 13.0641C4.66416 13.5563 4.9053 14.1131 5.39746 14.3078Z" fill="currentColor"></path>
                                            <path d="M20.125 5.75C18.5372 5.75 17.25 4.46282 17.25 2.875C17.25 1.28718 18.5372 0 20.125 0C21.7128 0 23 1.28718 23 2.875C23 4.46282 21.7128 5.75 20.125 5.75Z" fill="currentColor"></path>
                                        </svg>
                                        نوبت های در انتظار تکمیل
                                    </button>
                                </li>
                                <li>
                                    <button @click="activeState = 'doing-part'" wire:click.prevent="$set('type','doing-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 mt-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z"></path>
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z"></path>
                                        </svg>
                                        نوبت های در انتظار انجام
                                    </button>
                                </li>
                                <li>
                                    <button @click="activeState = 'done-part'" wire:click.prevent="$set('activeState','done-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 -mt-1" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.57753 1.67007C9.81824 0.0338038 12.2781 0.0338038 13.5188 1.67007L14.5518 3.03246L16.2456 2.79957C18.28 2.51986 20.0193 4.25924 19.7396 6.29356L19.5067 7.98737L20.8691 9.0204C22.5054 10.2611 22.5054 12.721 20.8691 13.9617L19.5067 14.9947L19.7396 16.6885C20.0193 18.7228 18.28 20.4622 16.2456 20.1825L14.5518 19.9496L13.5188 21.312C12.2781 22.9483 9.81824 22.9483 8.57753 21.312L7.5445 19.9496L5.85069 20.1825C3.81636 20.4622 2.07699 18.7228 2.3567 16.6885L2.58958 14.9947L1.2272 13.9617C-0.409067 12.721 -0.409067 10.2611 1.2272 9.0204L2.58958 7.98737L2.3567 6.29356C2.07699 4.25923 3.81637 2.51986 5.85069 2.79957L7.5445 3.03246L8.57753 1.67007ZM15.3819 10.3007C15.7415 9.94114 15.7415 9.3582 15.3819 8.99865C15.0224 8.6391 14.4394 8.6391 14.0799 8.99865L10.1275 12.951L8.93717 11.7607C8.57762 11.4011 7.99468 11.4011 7.63513 11.7607C7.27558 12.1202 7.27558 12.7032 7.63513 13.0627L9.47649 14.9041C9.83604 15.2636 10.419 15.2636 10.7785 14.9041L15.3819 10.3007Z" fill="currentColor"></path>
                                        </svg>
                                        نوبت های انجام شده
                                    </button>
                                </li>
                                <li>
                                    <button @click="activeState = 'canceled-part'" wire:click.prevent="$set('activeState','canceled-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                        <svg class="ml-2 -mt-1" width="21" height="21" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.85797 0.980469C8.41026 0.980469 8.85797 1.42818 8.85797 1.98047V3.04538C9.74732 2.98786 10.7213 2.96278 11.7872 2.96278C12.8531 2.96278 13.8271 2.98786 14.7164 3.04538V1.98047C14.7164 1.42818 15.1641 0.980469 15.7164 0.980469C16.2687 0.980469 16.7164 1.42818 16.7164 1.98047V3.25311C21.1826 3.93115 22.9104 5.94526 23.4082 10.8035C23.4411 11.1243 23.4686 11.4575 23.4911 11.8035C23.5121 12.1253 23.5289 12.4581 23.5417 12.8023C23.5645 13.4148 23.5749 14.0635 23.5749 14.7505C23.5749 24.4576 21.4944 26.5382 11.7872 26.5382C2.08004 26.5382 -0.000488281 24.4576 -0.000488281 14.7505C-0.000488281 14.0635 0.00993049 13.4148 0.0327333 12.8023C0.0455488 12.4581 0.062276 12.1253 0.0832637 11.8035C0.105838 11.4575 0.133341 11.1243 0.166208 10.8035C0.663965 5.94526 2.39185 3.93115 6.85797 3.25311V1.98047C6.85797 1.42818 7.30569 0.980469 7.85797 0.980469ZM6.85797 5.2793C5.55485 5.50288 4.67569 5.84374 4.05594 6.2981C3.1423 6.9679 2.47651 8.14595 2.17775 10.8035H21.3967C21.0979 8.14595 20.4321 6.9679 19.5185 6.2981C18.8987 5.84374 18.0196 5.50288 16.7164 5.2793V5.9097C16.7164 6.46198 16.2687 6.9097 15.7164 6.9097C15.1641 6.9097 14.7164 6.46198 14.7164 5.9097V5.05122C13.8686 4.99241 12.8989 4.96278 11.7872 4.96278C10.6756 4.96278 9.70581 4.99241 8.85797 5.05122V5.9097C8.85797 6.46198 8.41026 6.9097 7.85797 6.9097C7.30569 6.9097 6.85797 6.46198 6.85797 5.9097V5.2793ZM21.5749 14.7505C21.5749 14.0544 21.5639 13.4067 21.5403 12.8035H2.03414C2.01054 13.4067 1.99951 14.0544 1.99951 14.7505C1.99951 17.1316 2.12971 18.9086 2.42863 20.2536C2.72251 21.5759 3.15221 22.3551 3.66738 22.8703C4.18256 23.3855 4.96173 23.8152 6.28406 24.109C7.62911 24.408 9.40606 24.5382 11.7872 24.5382C14.1683 24.5382 15.9453 24.408 17.2903 24.109C18.6127 23.8152 19.3919 23.3855 19.907 22.8703C20.4222 22.3551 20.8519 21.5759 21.1458 20.2536C21.4447 18.9086 21.5749 17.1316 21.5749 14.7505Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.89355 16.7188C4.89355 16.1665 5.34127 15.7188 5.89355 15.7188H8.84048C9.39276 15.7188 9.84048 16.1665 9.84048 16.7188C9.84048 17.271 9.39276 17.7188 8.84048 17.7188H5.89355C5.34127 17.7188 4.89355 17.271 4.89355 16.7188ZM14.7343 15.7188C14.182 15.7188 13.7343 16.1665 13.7343 16.7188C13.7343 17.271 14.182 17.7188 14.7343 17.7188H17.6812C18.2335 17.7188 18.6812 17.271 18.6812 16.7188C18.6812 16.1665 18.2335 15.7188 17.6812 15.7188H14.7343ZM14.7343 19.648C14.182 19.648 13.7343 20.0957 13.7343 20.648C13.7343 21.2003 14.182 21.648 14.7343 21.648H17.6812C18.2335 21.648 18.6812 21.2003 18.6812 20.648C18.6812 20.0957 18.2335 19.648 17.6812 19.648H14.7343ZM5.89355 19.648C5.34127 19.648 4.89355 20.0957 4.89355 20.648C4.89355 21.2003 5.34127 21.648 5.89355 21.648H8.84048C9.39276 21.648 9.84048 21.2003 9.84048 20.648C9.84048 20.0957 9.39276 19.648 8.84048 19.648H5.89355Z" fill="currentColor"></path>
                                        </svg>
                                        نوبت های لغو شده
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:flex hidden bg-white dark:bg-dark-900 rounded-lg px-8 py-3 mb-4">
                        <div class="flex items-center md:flex-row space-x-2 space-x-reverse flex-col">
                            <button @click="activeState = 'awaiting-part'" :class="activeState === 'awaiting-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center group py-2 px-4 xl:text-lg text-15 dark:hover:bg-transparent rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="18" height="18" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.125 7.66667C17.4786 7.66667 15.3333 5.52136 15.3333 2.875C15.3333 1.90785 15.6199 1.00763 16.1127 0.254587C14.817 0.0726507 13.2917 0 11.5 0C2.02975 0 0 2.02975 0 11.5C0 20.9702 2.02975 23 11.5 23C20.9702 23 23 20.9702 23 11.5C23 9.70834 22.9273 8.183 22.7454 6.88733C21.9924 7.38013 21.0921 7.66667 20.125 7.66667ZM5.39746 14.3078C5.88929 14.5024 6.4457 14.2617 6.64075 13.7702C6.64075 13.7702 6.64113 13.7692 5.75 13.4167L6.64113 13.7692L6.64511 13.7594C6.64891 13.7501 6.65517 13.7349 6.6638 13.7144C6.68109 13.6733 6.70783 13.6111 6.74348 13.5322C6.81496 13.3739 6.92116 13.1506 7.05756 12.8963C7.33667 12.376 7.7155 11.7765 8.15035 11.3302C8.60321 10.8655 8.96617 10.7168 9.23262 10.7343C9.47541 10.7502 9.99147 10.9311 10.6951 12.0201C11.5395 13.327 12.5162 14.1044 13.6419 14.1783C14.7438 14.2506 15.6248 13.6207 16.2224 13.0073C16.8381 12.3755 17.3162 11.5974 17.6315 11.0096C17.7923 10.7099 17.9176 10.4465 18.0033 10.2567C18.0463 10.1615 18.0796 10.0842 18.1027 10.0294C18.1142 10.0019 18.1233 9.98002 18.1297 9.96426L18.1374 9.94528L18.1398 9.93935L18.1406 9.9373C18.1406 9.9373 18.1411 9.93587 17.25 9.58333L18.1411 9.93587C18.3358 9.44371 18.0947 8.8869 17.6025 8.6922C17.1107 8.49762 16.5542 8.73834 16.3592 9.2299L16.3589 9.2308L16.3549 9.2406L16.3454 9.26355L16.3362 9.28564C16.3189 9.3267 16.2922 9.38886 16.2565 9.46779C16.185 9.62607 16.0788 9.84937 15.9424 10.1037C15.6633 10.624 15.2845 11.2235 14.8497 11.6698C14.3968 12.1345 14.0339 12.2832 13.7674 12.2657C13.5246 12.2498 13.0086 12.0689 12.3049 10.9799C11.4605 9.67304 10.4838 8.89562 9.35819 8.82172C8.25625 8.74937 7.37521 9.37932 6.77758 9.99267C6.16194 10.6245 5.68379 11.4026 5.36854 11.9904C5.20775 12.2901 5.08243 12.5535 4.99669 12.7433C4.95372 12.8385 4.92042 12.9158 4.89732 12.9706C4.88576 12.9981 4.87674 13.02 4.87031 13.0357L4.86262 13.0547L4.86025 13.0606L4.85944 13.0627C4.85944 13.0627 4.85887 13.0641 5.75 13.4167L4.85887 13.0641C4.66416 13.5563 4.9053 14.1131 5.39746 14.3078Z" fill="currentColor"></path>
                                    <path d="M20.125 5.75C18.5372 5.75 17.25 4.46282 17.25 2.875C17.25 1.28718 18.5372 0 20.125 0C21.7128 0 23 1.28718 23 2.875C23 4.46282 21.7128 5.75 20.125 5.75Z" fill="currentColor"></path>
                                </svg>
                                نوبت های در انتظار تکمیل
                            </button>
                            <button @click="activeState = 'doing-part'" :class="activeState === 'doing-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 dark:hover:border-white dark:hover:text-white mb-3 self-start justify-start flex items-center xl:text-lg text-15 group dark:hover:bg-transparent py-2 px-4 rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z"></path>
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z"></path>
                                </svg>
                                نوبت های در انتظار انجام
                            </button>
                            <button @click="activeState = 'done-part'" :class="activeState === 'done-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center xl:text-lg text-15 dark:hover:bg-transparent group py-2 px-4 rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.57753 1.67007C9.81824 0.0338038 12.2781 0.0338038 13.5188 1.67007L14.5518 3.03246L16.2456 2.79957C18.28 2.51986 20.0193 4.25924 19.7396 6.29356L19.5067 7.98737L20.8691 9.0204C22.5054 10.2611 22.5054 12.721 20.8691 13.9617L19.5067 14.9947L19.7396 16.6885C20.0193 18.7228 18.28 20.4622 16.2456 20.1825L14.5518 19.9496L13.5188 21.312C12.2781 22.9483 9.81824 22.9483 8.57753 21.312L7.5445 19.9496L5.85069 20.1825C3.81636 20.4622 2.07699 18.7228 2.3567 16.6885L2.58958 14.9947L1.2272 13.9617C-0.409067 12.721 -0.409067 10.2611 1.2272 9.0204L2.58958 7.98737L2.3567 6.29356C2.07699 4.25923 3.81637 2.51986 5.85069 2.79957L7.5445 3.03246L8.57753 1.67007ZM15.3819 10.3007C15.7415 9.94114 15.7415 9.3582 15.3819 8.99865C15.0224 8.6391 14.4394 8.6391 14.0799 8.99865L10.1275 12.951L8.93717 11.7607C8.57762 11.4011 7.99468 11.4011 7.63513 11.7607C7.27558 12.1202 7.27558 12.7032 7.63513 13.0627L9.47649 14.9041C9.83604 15.2636 10.419 15.2636 10.7785 14.9041L15.3819 10.3007Z" fill="currentColor"></path>
                                </svg>
                                نوبت های انجام شده
                            </button>
                            <button @click="activeState = 'canceled-part'" :class="activeState === 'canceled-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center xl:text-lg text-15 dark:hover:bg-transparent group py-2 px-4 rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2 -mt-1" width="21" height="21" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.85797 0.980469C8.41026 0.980469 8.85797 1.42818 8.85797 1.98047V3.04538C9.74732 2.98786 10.7213 2.96278 11.7872 2.96278C12.8531 2.96278 13.8271 2.98786 14.7164 3.04538V1.98047C14.7164 1.42818 15.1641 0.980469 15.7164 0.980469C16.2687 0.980469 16.7164 1.42818 16.7164 1.98047V3.25311C21.1826 3.93115 22.9104 5.94526 23.4082 10.8035C23.4411 11.1243 23.4686 11.4575 23.4911 11.8035C23.5121 12.1253 23.5289 12.4581 23.5417 12.8023C23.5645 13.4148 23.5749 14.0635 23.5749 14.7505C23.5749 24.4576 21.4944 26.5382 11.7872 26.5382C2.08004 26.5382 -0.000488281 24.4576 -0.000488281 14.7505C-0.000488281 14.0635 0.00993049 13.4148 0.0327333 12.8023C0.0455488 12.4581 0.062276 12.1253 0.0832637 11.8035C0.105838 11.4575 0.133341 11.1243 0.166208 10.8035C0.663965 5.94526 2.39185 3.93115 6.85797 3.25311V1.98047C6.85797 1.42818 7.30569 0.980469 7.85797 0.980469ZM6.85797 5.2793C5.55485 5.50288 4.67569 5.84374 4.05594 6.2981C3.1423 6.9679 2.47651 8.14595 2.17775 10.8035H21.3967C21.0979 8.14595 20.4321 6.9679 19.5185 6.2981C18.8987 5.84374 18.0196 5.50288 16.7164 5.2793V5.9097C16.7164 6.46198 16.2687 6.9097 15.7164 6.9097C15.1641 6.9097 14.7164 6.46198 14.7164 5.9097V5.05122C13.8686 4.99241 12.8989 4.96278 11.7872 4.96278C10.6756 4.96278 9.70581 4.99241 8.85797 5.05122V5.9097C8.85797 6.46198 8.41026 6.9097 7.85797 6.9097C7.30569 6.9097 6.85797 6.46198 6.85797 5.9097V5.2793ZM21.5749 14.7505C21.5749 14.0544 21.5639 13.4067 21.5403 12.8035H2.03414C2.01054 13.4067 1.99951 14.0544 1.99951 14.7505C1.99951 17.1316 2.12971 18.9086 2.42863 20.2536C2.72251 21.5759 3.15221 22.3551 3.66738 22.8703C4.18256 23.3855 4.96173 23.8152 6.28406 24.109C7.62911 24.408 9.40606 24.5382 11.7872 24.5382C14.1683 24.5382 15.9453 24.408 17.2903 24.109C18.6127 23.8152 19.3919 23.3855 19.907 22.8703C20.4222 22.3551 20.8519 21.5759 21.1458 20.2536C21.4447 18.9086 21.5749 17.1316 21.5749 14.7505Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.89355 16.7188C4.89355 16.1665 5.34127 15.7188 5.89355 15.7188H8.84048C9.39276 15.7188 9.84048 16.1665 9.84048 16.7188C9.84048 17.271 9.39276 17.7188 8.84048 17.7188H5.89355C5.34127 17.7188 4.89355 17.271 4.89355 16.7188ZM14.7343 15.7188C14.182 15.7188 13.7343 16.1665 13.7343 16.7188C13.7343 17.271 14.182 17.7188 14.7343 17.7188H17.6812C18.2335 17.7188 18.6812 17.271 18.6812 16.7188C18.6812 16.1665 18.2335 15.7188 17.6812 15.7188H14.7343ZM14.7343 19.648C14.182 19.648 13.7343 20.0957 13.7343 20.648C13.7343 21.2003 14.182 21.648 14.7343 21.648H17.6812C18.2335 21.648 18.6812 21.2003 18.6812 20.648C18.6812 20.0957 18.2335 19.648 17.6812 19.648H14.7343ZM5.89355 19.648C5.34127 19.648 4.89355 20.0957 4.89355 20.648C4.89355 21.2003 5.34127 21.648 5.89355 21.648H8.84048C9.39276 21.648 9.84048 21.2003 9.84048 20.648C9.84048 20.0957 9.39276 19.648 8.84048 19.648H5.89355Z" fill="currentColor"></path>
                                </svg>
                                نوبت های لغو شده
                            </button>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'awaiting-part'" style="">
                        <?php if(sizeof($data['bookingUser']['awaiting'])>0) { ?>
                            <div class="mb-6 space-y-2">
                                <div class="border dark:border-blue-450 border-blue-700 bg-blue-700 bg-opacity-5 rounded-md p-4 mb-2">
                                    <div>
                                        <h6 class="font-bold text-blue-700 dark:text-blue-450 text-base mb-1">
                                            توجه :&zwnj;
                                        </h6>
                                        <p class="font-semibold text-blue-700 dark:text-blue-450 text-13 leading-7">
                                            زمان انتخاب شده برای هر خدمت تنها تا پایان تایمر برای شما لحاظ خواهد شد و پس از پایان زمان تایمر امکان رزرو آن زمان توسط شخص دیگر وجود خواهد داشت.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['bookingUser']['awaiting'])>0) { ?>
                                <?php foreach($data['bookingUser']['awaiting'] as $booking) { ?>
                                    <div class="group h-full bg-white dark:bg-dark-920 flex flex-col flex-grow rounded-xl px-4 pt-4 pb-5">
                                        <a href="bookedInit?date=<?= str_replace("/","_", $booking['sre_date']) ?>&time=<?= str_replace(":","_", $booking['sre_time']) ?>&ugid=<?= $booking['service_id'] ?>" class="inline-block w-full xl:h-36 sm:h-40 h-52 rounded-lg overflow-hidden relative mb-4">
                                            <img class="w-full h-full object-cover group-hover:scale-110 transform transition duration-200 z-0" onerror="this.src='public/images/default_cover.jpg'" src="public/images/services/<?= $booking['s_cover'] ?>" alt="تصویر <?= $booking['s_title'] ?>" />
                                        </a>
                                        <div class="flex flex-col flex-grow">
                                            <h5 class="text-biscay-700 font-semibold text-lg dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200">
                                                <a href="services/<?= $booking['s_slug'] ?>">
                                                    <?= $booking['s_title'] ?>
                                                </a>
                                            </h5>
                                        </div>
                                        <hr class="border-gray-350 dark:border-white dark:border-opacity-10 border-opacity-10 my-4" />
                                        <div class="flex items-center">
                                            <a href="bookedInit?date=<?= str_replace("/","_", $booking['sre_date']) ?>&time=<?= str_replace(":","_", $booking['sre_time']) ?>&ugid=<?= $booking['service_id'] ?>">
                                                <div class="overflow-hidden w-4 h-8 rounded-md">
                                                    <svg class="mb-3" width="15" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1792 23.9333C2.54046 23.9333 0.474609 21.8674 0.474609 12.2287C0.474609 2.59002 2.54046 0.52417 12.1792 0.52417C21.8178 0.52417 23.8837 2.59002 23.8837 12.2287C23.8837 21.8674 21.8178 23.9333 12.1792 23.9333ZM11.2038 6.37644C11.2038 5.83773 11.6405 5.40106 12.1792 5.40106C12.7178 5.40106 13.1545 5.83773 13.1545 6.37644V11.2533H18.0314C18.5701 11.2533 19.0068 11.69 19.0068 12.2287C19.0068 12.7674 18.5701 13.2041 18.0314 13.2041H12.1792C11.6405 13.2041 11.2038 12.7674 11.2038 12.2287V6.37644Z" fill="#60422b"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="mr-3">
                                                <h6 class="text-biscay-700 font-semibold text-md dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200">
                                                    <a>
                                                        <?= $booking['sre_day']." ".$booking['sre_date']." ساعت ".$booking['sre_time'] ?>
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                        <ul class="mt-4 bg-green-700 bg-opacity-10 rounded-lg">
                                            <li class="flex items-center justify-center py-4 text-green-700 border-b border-green-700 border-opacity-20 last:border-0 ">
                                                <a class="flex items-center font-medium group text-sm transition duration-200 hover:text-biscay-700">
                                                    <div dir="ltr" id="timer-<?= $booking['service_id'] ?>"class="timer" data-end="<?= gmdate('Y-m-d\TH:i:s', $booking['sre_timestamp_expire']) ?>"></div>
                                                </a>
                                            </li>
                                            <li class="flex items-center justify-center py-4 text-green-700 border-b border-green-700 border-opacity-20 last:border-0 ">
                                                <a class="flex items-center text-sm font-medium group transition duration-200 hover:text-biscay-700 dark:hover:text-white" href="bookedInit?date=<?= str_replace("/","_", $booking['sre_date']) ?>&time=<?= str_replace(":","_", $booking['sre_time']) ?>&ugid=<?= $booking['service_id'] ?>">
                                                    تکمیل فرایند نوبت دهی
                                                    <svg class="mr-1" width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="currentColor" opacity="0.4" d="M13.037 4.97372L16.7923 4.6416C17.6351 4.6416 18.3184 5.33155 18.3184 6.18252C18.3184 7.0335 17.6351 7.72345 16.7923 7.72345L13.037 7.39133C12.3758 7.39133 11.8398 6.85011 11.8398 6.18252C11.8398 5.51382 12.3758 4.97372 13.037 4.97372"></path>
                                                        <path fill="currentColor" d="M0.42607 5.03477C0.484764 4.9755 0.704038 4.72502 0.910022 4.51702C2.1116 3.21429 5.24898 1.08405 6.89021 0.432125C7.13939 0.32813 7.76952 0.10672 8.10729 0.0910645C8.42956 0.0910645 8.73742 0.165986 9.0309 0.313593C9.39746 0.520465 9.68983 0.846989 9.85151 1.23166C9.9545 1.4978 10.1162 2.29734 10.1162 2.31187C10.2768 3.18521 10.3643 4.60537 10.3643 6.17536C10.3643 7.66932 10.2768 9.03133 10.145 9.9192C10.1306 9.93486 9.9689 10.9267 9.79282 11.2667C9.47055 11.8884 8.84042 12.2731 8.16598 12.2731H8.10729C7.66764 12.2585 6.74403 11.8728 6.74403 11.8593C5.19029 11.2074 2.1271 9.18005 0.895625 7.83258C0.895625 7.83258 0.547888 7.48593 0.397276 7.27011C0.162499 6.95924 0.0451098 6.57457 0.0451098 6.1899C0.0451098 5.7605 0.176895 5.36129 0.42607 5.03477"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
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

                    <div class="w-full" x-show="activeState === 'doing-part'" style="display: none;">
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['bookingUser']['doing'])>0) { ?>
                                <?php foreach($data['bookingUser']['doing'] as $booking) { ?>
                                    <?php require('app/views/user/reservations-item-template-default.php'); ?>
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

                    <div class="w-full" x-show="activeState === 'done-part'" style="display: none;">
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['bookingUser']['done'])>0) { ?>
                                <?php foreach($data['bookingUser']['done'] as $booking) { ?>
                                    <?php require('app/views/user/reservations-item-template-default.php'); ?>
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

                    <div class="w-full" x-show="activeState === 'canceled-part'" style="display: none;">
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-24">
                            <?php if(sizeof($data['bookingUser']['canceled'])>0) { ?>
                                <?php foreach($data['bookingUser']['canceled'] as $booking) { ?>
                                    <?php require('app/views/user/reservations-item-template-default.php'); ?>
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
                </div>
                <!-- Livewire Component wire-end:7lE7LaUUtGKlsXloVj9Z -->
            </div>
        </div>
    </section>
</main>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/showTimer.min.js"></script>
<script>
    window.Alpine.start();
</script>

<script>
    $(function () {
        $(".timer").showTimer({
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

</body>
</html>
