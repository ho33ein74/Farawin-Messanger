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

<body x-data='{bodyOverflow:false, overlayShow : false}' @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890  " :class="{'overflow-hidden':bodyOverflow}" x-data x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>

<div class="absolute z-negative top-0 right-1/2 transform translate-x-1/2 md:w-120-percent w-full h-bg-height md:rounded-backgroundOval overflow-hidden ">
    <img class="w-full h-full object-cover" src="public/images/page/<?= $data['page']['cover']; ?>" alt="<?= $data['page']['title']; ?>">
    <div class="absolute top-0 right-0 w-full h-full bg-blue-700 dark:bg-dark-930 dark:bg-opacity-80 bg-opacity-80"></div>
</div>
<div class="z-0">
    <div wire:id="gnFzTGQ4T95hpmVfLvOg" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;gnFzTGQ4T95hpmVfLvOg&quot;,&quot;name&quot;:&quot;layouts.header.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;faq&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;l841445419-0&quot;:{&quot;id&quot;:&quot;6zNLxRzaDTNiSBLrBRi6&quot;,&quot;tag&quot;:&quot;section&quot;},&quot;l841445419-1&quot;:{&quot;id&quot;:&quot;FKIZhVBW1JV7iclyehYu&quot;,&quot;tag&quot;:&quot;form&quot;},&quot;l841445419-2&quot;:{&quot;id&quot;:&quot;dnf3AGbvCHL3yUURI17g&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-3&quot;:{&quot;id&quot;:&quot;YOrkqbvryCitf2qy2DT1&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-4&quot;:{&quot;id&quot;:&quot;zEUtibbPxdE1Si1rC7pA&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-5&quot;:{&quot;id&quot;:&quot;Z7wnOHiZSYToSdWpHTOC&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-6&quot;:{&quot;id&quot;:&quot;IZRi7mW3pMZcBnW6cqUJ&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;06ff3743&quot;,&quot;data&quot;:{&quot;discount&quot;:{&quot;status&quot;:false,&quot;message&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;b0d725c0588c573bec09e5545cba66ee30b4281f448a4708761cac23a7024f0b&quot;}}">
        <section wire:id="6zNLxRzaDTNiSBLrBRi6" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;6zNLxRzaDTNiSBLrBRi6&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;faq&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;4fbd5db6&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:&quot;bg-green-700 text-white&quot;,&quot;message&quot;:&quot;\u06f3\u06f5 \u062f\u0631\u0635\u062f \u062a\u062e\u0641\u06cc\u0641 \u0648\u06cc\u0698\u0647 \u062a\u0627\u0628\u0633\u062a\u0627\u0646 \u062f\u0648\u0631\u0647\u200c\u0647\u0627\u06cc \u0646\u0642\u062f\u06cc \u0648 \u0639\u0636\u0648\u06cc\u062a \u0648\u06cc\u0698\u0647 \u0631\u0627\u06a9\u062a&quot;,&quot;moreLink_title&quot;:&quot;\u0627\u0637\u0644\u0627\u0639\u0627\u062a \u0628\u06cc\u0634\u062a\u0631&quot;,&quot;moreLink_link&quot;:&quot;&quot;}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;74435bbe6da1cff5ac2e82f96210c8e59965d938e6a58c5325305af390d73101&quot;}}" class="mt-4">
            <div class="container "></div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <section class="pb-20 pt-10">
        <div wire:loading class="fixed top-0 left-0 h-screen w-screen flex bg-biscay-700 bg-opacity-10 backdrop-filter backdrop-blur-sm  items-center justify-center z-50">
            <div class="absolute top-0 right-0 w-full h-full flex items-center justify-center">

                <svg class="w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">
                    <circle class="stroke-current text-red-450 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8"  stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300"></circle>
                    <circle class="stroke-current text-red-450" cx="50" cy="50" r="20" fill="none" stroke-width="8"  stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200" >
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                        <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                        <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                    </circle>
                </svg>
            </div>
        </div>
        <div class="container md:px-14">
            <div class="mb-10 text-center">
                <h1 class="text-white font-bold sm:text-82 text-28 mb-4"><?= $data['page']['title']; ?></h1>
                <h3 class="text-white font-medium sm:text-22 text-base">در اینجا سعی می‌کنیم به سوالات متداولی که ممکن است، برای شما پیش بیاید، پاسخ دهیم.</h3>
            </div>
            <div class="bg-white dark:bg-dark-930 dark:shadow-whiteShadow pt-12 md:px-14 px-3 pb-16 rounded-xl shadow-terms-md" x-data="{ question : window.Livewire.find('zj2aZclfAZjK2j6bwnWH').entangle('question') }">

                <?php if($data['page']['description']!=""){ ?>
                    <div class="content-area rounded-xl text-gray-360 dark:text-gray-200 font-normal md:text-lg text-sm leading-9">
                        <?= htmlspecialchars_decode($data['page']['description']); ?>
                    </div>
                <?php } ?>

                <div wire:id="owwS736gNsIgu1p8Cri5" x-data="{ activeState : 'public-part' }">

                    <div x-data="{state:'خدمات'}" class="relative lg:hidden group mb-6 lg:w-1/3 sm:w-2/5">
                        <div class=" bg-white cursor-pointer  py-2 flex items-center justify-between px-3 h-12 rounded">
                            <span class="flex font-medium text-lg text-blue-700 items-center">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 11C0.75 13.2475 0.871405 15.0024 1.17704 16.3776C1.48077 17.7443 1.9564 18.6896 2.63339 19.3666C3.31039 20.0436 4.25571 20.5192 5.62241 20.823C6.99762 21.1286 8.75249 21.25 11 21.25C13.2475 21.25 15.0024 21.1286 16.3776 20.823C17.7443 20.5192 18.6896 20.0436 19.3666 19.3666C20.0436 18.6896 20.5192 17.7443 20.823 16.3776C21.1286 15.0024 21.25 13.2475 21.25 11C21.25 8.75249 21.1286 6.99762 20.823 5.62241C20.5192 4.25571 20.0436 3.31039 19.3666 2.63339C18.6896 1.9564 17.7443 1.48077 16.3776 1.17704C15.0024 0.871405 13.2475 0.75 11 0.75C8.75249 0.75 6.99762 0.871405 5.62241 1.17704C4.25571 1.48077 3.31039 1.9564 2.63339 2.63339C1.9564 3.31039 1.48077 4.25571 1.17704 5.62241C0.871405 6.99762 0.75 8.75249 0.75 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path opacity="0.4" d="M11.0001 6.41663V15.5833M15.5834 10.0833V15.5833M6.41675 11.9166V15.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span x-text="state" class="mr-2">خدمات</span>
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
                                    <button @click="activeState = 'public-part'" wire:click.prevent="$set('activeState','public-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1 h-12 px-5 rounded-lg">
                                        <svg class="ml-2" width="23" height="20" viewBox="0 0 23 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1C14.4525 1 16.3618 1.11137 17.855 1.39866C19.3432 1.68498 20.3438 2.13251 21.0445 2.75018C22.4367 3.97734 23 6.19513 23 10.6667C23 13.5482 22.7413 15.6685 22.0447 17.0498C21.7104 17.7127 21.2871 18.1797 20.7543 18.4903C20.2159 18.8042 19.494 19 18.5002 19C17.2191 19 16.2575 19.2877 15.5056 19.7971C14.7717 20.2944 14.329 20.9455 13.9997 21.4637C13.9499 21.542 13.9032 21.6161 13.8591 21.6862C13.583 22.1245 13.4043 22.4082 13.1562 22.6307C12.9352 22.8291 12.6262 23 12.0003 23C11.3744 23 11.0654 22.8291 10.8443 22.6307C10.5963 22.4081 10.4176 22.1245 10.1415 21.6862C10.0974 21.6161 10.0507 21.542 10.0009 21.4636C9.67154 20.9454 9.22884 20.2944 8.4949 19.7971C7.74298 19.2877 6.7814 19 5.50024 19C4.51174 19 3.79218 18.7993 3.25388 18.4789C2.71963 18.1609 2.29353 17.6832 1.95707 17.0102C1.25807 15.612 1 13.488 1 10.6667C1 6.25195 1.56175 4.02841 2.95861 2.78674C3.66142 2.16203 4.66352 1.70608 6.14984 1.41246C7.64154 1.11777 9.54955 1 12 1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        عمومی
                                    </button>
                                </li>
                                <li>
                                    <button @click="activeState = 'service-part'" wire:click.prevent="$set('type','service-part')" class="flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1 h-12 px-5 rounded-lg">
                                        <svg class="ml-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                        </svg>
                                        خدمات
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:flex hidden bg-white dark:bg-dark-900 rounded-lg px-8 py-3 mb-4">
                        <div class="flex items-center md:flex-row space-x-2 space-x-reverse flex-col">
                            <button @click="activeState = 'public-part'" :class="activeState === 'public-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center xl:text-lg text-15 dark:hover:bg-transparent group py-2 px-4 rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2" width="23" height="20" viewBox="0 0 23 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1C14.4525 1 16.3618 1.11137 17.855 1.39866C19.3432 1.68498 20.3438 2.13251 21.0445 2.75018C22.4367 3.97734 23 6.19513 23 10.6667C23 13.5482 22.7413 15.6685 22.0447 17.0498C21.7104 17.7127 21.2871 18.1797 20.7543 18.4903C20.2159 18.8042 19.494 19 18.5002 19C17.2191 19 16.2575 19.2877 15.5056 19.7971C14.7717 20.2944 14.329 20.9455 13.9997 21.4637C13.9499 21.542 13.9032 21.6161 13.8591 21.6862C13.583 22.1245 13.4043 22.4082 13.1562 22.6307C12.9352 22.8291 12.6262 23 12.0003 23C11.3744 23 11.0654 22.8291 10.8443 22.6307C10.5963 22.4081 10.4176 22.1245 10.1415 21.6862C10.0974 21.6161 10.0507 21.542 10.0009 21.4636C9.67154 20.9454 9.22884 20.2944 8.4949 19.7971C7.74298 19.2877 6.7814 19 5.50024 19C4.51174 19 3.79218 18.7993 3.25388 18.4789C2.71963 18.1609 2.29353 17.6832 1.95707 17.0102C1.25807 15.612 1 13.488 1 10.6667C1 6.25195 1.56175 4.02841 2.95861 2.78674C3.66142 2.16203 4.66352 1.70608 6.14984 1.41246C7.64154 1.11777 9.54955 1 12 1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                عمومی
                            </button>
                            <button @click="activeState = 'service-part'" :class="activeState === 'service-part' ? 'bg-blue-700 dark:bg-dark-920 text-white' : 'text-chambray-400'" class="md:mb-0 mb-3 dark:hover:border-white dark:hover:text-white self-start justify-start flex items-center group py-2 px-4 xl:text-lg text-15 dark:hover:bg-transparent rounded-lg border border-transparent hover:border-blue-700 hover:bg-white hover:text-blue-700 transition duration-200 text-white">
                                <svg class="ml-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                </svg>
                                خدمات
                            </button>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'service-part'" style="display: none;">
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-5">
                            <?php if(sizeof($data['faq']['services'])>0) { ?>
                                <div x-data="collapseController()" class="space-y-5 mt-8">
                                    <?php $i = 0; ?>
                                    <?php foreach ($data['faq']['services'] as $faq) { ?>
                                        <div x-init="Livewire.hook('message.processed', (message, component) => { collapse = false })">
                                            <div @click="collapseHandler('service-<?= $i; ?>')" class="bg-white dark:bg-dark-890 dark:border-opacity-0 rounded-lg border border-gray-210 flex items-center justify-between py-3 md:px-5 px-2 cursor-pointer">
                                                <div class="flex items-center">
                                                    <div class="font-extrabold pt-2 sm:text-28 dark:text-gray-920 dark:bg-dark-930 text-2xl md:ml-5 ml-2 sm:w-11 w-8 sm:h-11 h-8 rounded-lg bg-biscay-700 bg-opacity-20 flex items-center justify-center text-cello-500" :class="{'!bg-blue-700 !text-white' : isActive('service-<?= $i; ?>')}">
                                                        ؟
                                                    </div>
                                                    <h3 :class="{'!text-blue-700':isActive('service-<?= $i; ?>')}" class="sm:text-lg text-base dark:text-white text-gray-800 font-semibold w-44 sm:w-auto"><?= $faq['question']; ?></h3>
                                                </div>
                                                <span class="transition duration-200 transform flex-shrink-0 rotate-90 dark:text-white text-gray-800" :class="{' !rotate-0 !text-blue-700' : isActive('service-<?= $i; ?>')}">
                                                    <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1.5L8 8.5L15 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div x-show="isActive('service-<?= $i; ?>')" x-transition="" class="dark:text-gray-200 sm:mr-16 mr-2 bg-white dark:bg-dark-890 dark:border-opacity-0 rounded-lg border border-gray-210 mt-3 sm:p-8 p-4">
                                                <div class="content-area font-normal text-xl leading-8">
                                                    <?= $faq['answer']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="dark:text-white text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="w-full" x-show="activeState === 'public-part'" style="">
                        <div class="grid md:grid-cols-4 grid-cols-1 md:gap-8 gap-y-7 mb-5">
                            <?php if(sizeof($data['faq']['public'])>0) { ?>
                                <div x-data="collapseController()" class="space-y-5 mt-8">
                                    <?php $i = 0; ?>
                                    <?php foreach ($data['faq']['public'] as $faq) { ?>
                                        <div x-init="Livewire.hook('message.processed', (message, component) => { collapse = false })">
                                            <div @click="collapseHandler('public-<?= $i; ?>')" class="bg-white dark:bg-dark-890 dark:border-opacity-0 rounded-lg border border-gray-210 flex items-center justify-between py-3 md:px-5 px-2 cursor-pointer">
                                                <div class="flex items-center">
                                                    <div class="font-extrabold pt-2 sm:text-28 dark:text-gray-920 dark:bg-dark-930 text-2xl md:ml-5 ml-2 sm:w-11 w-8 sm:h-11 h-8 rounded-lg bg-biscay-700 bg-opacity-20 flex items-center justify-center text-cello-500" :class="{'!bg-blue-700 !text-white' : isActive('public-<?= $i; ?>')}">
                                                        ؟
                                                    </div>
                                                    <h3 :class="{'!text-blue-700':isActive('public-<?= $i; ?>')}" class="sm:text-lg text-base dark:text-white text-gray-800 font-semibold w-44 sm:w-auto"><?= $faq['question']; ?></h3>
                                                </div>
                                                <span class="transition duration-200 transform flex-shrink-0 rotate-90 dark:text-white text-gray-800" :class="{' !rotate-0 !text-blue-700' : isActive('public-<?= $i; ?>')}">
                                                    <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1.5L8 8.5L15 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div x-show="isActive('public-<?= $i; ?>')" x-transition="" class="dark:text-gray-200 sm:mr-16 mr-2 bg-white dark:bg-dark-890 dark:border-opacity-0 rounded-lg border border-gray-210 mt-3 sm:p-8 p-4">
                                                <div class="content-area font-normal text-xl leading-8">
                                                    <?= $faq['answer']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="dark:text-white text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Livewire Component wire-end:zj2aZclfAZjK2j6bwnWH -->
    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/faq.js"></script>
<script>
    window.Alpine.start();
</script>

</body>
</html>
