<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>جستجوی عبارت <?= htmlspecialchars($_GET['s']); ?> | <?= $data['getPublicInfo']['site']; ?></title>
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

<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890  " :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="LGfDqh5fxixkPjTp4pa0">
        <section wire:id="0EzJf6lgc9apMKJgKQmv" class="mt-4">
            <div class="container "></div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>

    <section wire:id="Dmb2DA4nSq4dRhu04NDe" class="mt-10 mb-40">
        <div wire:loading="" class="fixed top-0 left-0 h-screen w-screen flex bg-biscay-700 bg-opacity-10 backdrop-filter backdrop-blur-sm  items-center justify-center z-50">
            <div class="absolute top-0 right-0 w-full h-full flex items-center justify-center">
                <svg class="w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">
                    <circle class="stroke-current text-red-450 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300"></circle>
                    <circle class="stroke-current text-red-450" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                        <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                        <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                    </circle>
                </svg>
            </div>
        </div>
        <div class="container">
            <div id="search-page">
                <div class="mb-8 flex items-center">
                <span class="text-gray-300 dark:text-gray-200 text-lg ml-2">
                    نتایج جستجو برای:
                </span>
                    <span class="text-gray-800 text-3xl dark:text-white font-bold"><?= htmlspecialchars($_GET['s']) ?></span>
                </div>

                <div x-data="{state:'<?= htmlspecialchars($_GET['type']) == "blog" ? "مقالات":(htmlspecialchars($_GET['type']) == "service" ? "خدمات":"") ?>'}" class="relative lg:hidden group mb-6 lg:w-1/3 sm:w-2/5">
                    <div class=" bg-white cursor-pointer  py-2 flex items-center justify-between px-3 h-12 rounded">
                    <span class="flex font-medium text-lg text-blue-700 items-center">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.75 11C0.75 13.2475 0.871405 15.0024 1.17704 16.3776C1.48077 17.7443 1.9564 18.6896 2.63339 19.3666C3.31039 20.0436 4.25571 20.5192 5.62241 20.823C6.99762 21.1286 8.75249 21.25 11 21.25C13.2475 21.25 15.0024 21.1286 16.3776 20.823C17.7443 20.5192 18.6896 20.0436 19.3666 19.3666C20.0436 18.6896 20.5192 17.7443 20.823 16.3776C21.1286 15.0024 21.25 13.2475 21.25 11C21.25 8.75249 21.1286 6.99762 20.823 5.62241C20.5192 4.25571 20.0436 3.31039 19.3666 2.63339C18.6896 1.9564 17.7443 1.48077 16.3776 1.17704C15.0024 0.871405 13.2475 0.75 11 0.75C8.75249 0.75 6.99762 0.871405 5.62241 1.17704C4.25571 1.48077 3.31039 1.9564 2.63339 2.63339C1.9564 3.31039 1.48077 4.25571 1.17704 5.62241C0.871405 6.99762 0.75 8.75249 0.75 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path opacity="0.4" d="M11.0001 6.41663V15.5833M15.5834 10.0833V15.5833M6.41675 11.9166V15.5833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span x-text="state" class="mr-2"><?= htmlspecialchars($_GET['type']) == "blog" ? "مقالات":(htmlspecialchars($_GET['type']) == "service" ? "خدمات":"") ?></span>
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
                                <button onclick="location.href='search?s=<?= htmlspecialchars($_GET['s']) ?>&type=blog'" wire:click.prevent="$set('type','article')" class="<?= htmlspecialchars($_GET['type']) == "blog" ? "!bg-blue-700 !text-white ":"" ?> flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                    <span class="ml-2 -mt-1">
                                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M5.42574 14.39H10.8119C11.2178 14.39 11.5545 14.05 11.5545 13.64C11.5545 13.23 11.2178 12.9 10.8119 12.9H5.42574C5.0198 12.9 4.68317 13.23 4.68317 13.64C4.68317 14.05 5.0198 14.39 5.42574 14.39ZM8.77228 7.9H5.42574C5.0198 7.9 4.68317 8.24 4.68317 8.65C4.68317 9.06 5.0198 9.39 5.42574 9.39H8.77228C9.17822 9.39 9.51485 9.06 9.51485 8.65C9.51485 8.24 9.17822 7.9 8.77228 7.9ZM15.8381 7.02561C16.0708 7.02292 16.3242 7.02 16.5545 7.02C16.802 7.02 17 7.22 17 7.47V15.51C17 17.99 15.0099 20 12.5545 20H4.67327C2.09901 20 0 17.89 0 15.29V4.51C0 2.03 2 0 4.46535 0H9.75247C10.0099 0 10.2079 0.21 10.2079 0.46V3.68C10.2079 5.51 11.703 7.01 13.5149 7.02C13.9381 7.02 14.3112 7.02316 14.6377 7.02593C14.8917 7.02809 15.1175 7.03 15.3168 7.03C15.4578 7.03 15.6405 7.02789 15.8381 7.02561ZM16.1111 5.566C15.2972 5.569 14.3378 5.566 13.6477 5.559C12.5527 5.559 11.6507 4.648 11.6507 3.542V0.906C11.6507 0.475 12.1685 0.261 12.4646 0.572C13.0004 1.13476 13.7368 1.90834 14.4699 2.67837C15.2009 3.44632 15.9286 4.21074 16.4507 4.759C16.7398 5.062 16.5279 5.565 16.1111 5.566Z"></path>
                                        </svg>
                                    </span>
                                    مقالات
                                    <span class="mr-2 text-lg text-chambray-300">
                                        <?= sizeof($data['getNews']) ?>
                                    </span>
                                </button>
                            </li>
                            <li>
                                <button onclick="location.href='search?s=<?= htmlspecialchars($_GET['s']) ?>&type=service'" wire:click.prevent="$set('type','services')" class="<?= htmlspecialchars($_GET['type']) == "service" ? "!bg-blue-700 !text-white ":"" ?> flex sm:w-fit-content w-full items-center font-medium text-lg text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                                    <span class="ml-2 -mt-1">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    خدمات
                                    <span class="mr-2 text-lg text-white">
                                        <?= sizeof($data['getServices']) ?>
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="mb-10 bg-white xl:text-lg text-base dark:bg-dark-930 shadow-sm lg:flex hidden  items-center w-fit-content rounded-xl py-2 px-4">
                    <li class="ml-3 last:ml-0">
                        <button onclick="location.href='search?s=<?= htmlspecialchars($_GET['s']) ?>&type=blog'" wire:click.prevent="$set('type','article')" class="<?= htmlspecialchars($_GET['type']) == "blog" ? "!bg-blue-700 dark:!bg-dark-890 !text-white":"" ?> flex items-center font-medium  text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                            <span class="ml-2 -mt-1">
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M5.42574 14.39H10.8119C11.2178 14.39 11.5545 14.05 11.5545 13.64C11.5545 13.23 11.2178 12.9 10.8119 12.9H5.42574C5.0198 12.9 4.68317 13.23 4.68317 13.64C4.68317 14.05 5.0198 14.39 5.42574 14.39ZM8.77228 7.9H5.42574C5.0198 7.9 4.68317 8.24 4.68317 8.65C4.68317 9.06 5.0198 9.39 5.42574 9.39H8.77228C9.17822 9.39 9.51485 9.06 9.51485 8.65C9.51485 8.24 9.17822 7.9 8.77228 7.9ZM15.8381 7.02561C16.0708 7.02292 16.3242 7.02 16.5545 7.02C16.802 7.02 17 7.22 17 7.47V15.51C17 17.99 15.0099 20 12.5545 20H4.67327C2.09901 20 0 17.89 0 15.29V4.51C0 2.03 2 0 4.46535 0H9.75247C10.0099 0 10.2079 0.21 10.2079 0.46V3.68C10.2079 5.51 11.703 7.01 13.5149 7.02C13.9381 7.02 14.3112 7.02316 14.6377 7.02593C14.8917 7.02809 15.1175 7.03 15.3168 7.03C15.4578 7.03 15.6405 7.02789 15.8381 7.02561ZM16.1111 5.566C15.2972 5.569 14.3378 5.566 13.6477 5.559C12.5527 5.559 11.6507 4.648 11.6507 3.542V0.906C11.6507 0.475 12.1685 0.261 12.4646 0.572C13.0004 1.13476 13.7368 1.90834 14.4699 2.67837C15.2009 3.44632 15.9286 4.21074 16.4507 4.759C16.7398 5.062 16.5279 5.565 16.1111 5.566Z"></path>
                                </svg>
                            </span>
                            مقالات
                            <span class="mr-2  text-white">
                                <?= sizeof($data['getNews']) ?>
                            </span>
                        </button>
                    </li>
                    <li class="ml-3 last:ml-0">
                        <button onclick="location.href='search?s=<?= htmlspecialchars($_GET['s']) ?>&type=service'" wire:click.prevent="$set('type','services')" class="<?= htmlspecialchars($_GET['type']) == "service" ? "!bg-blue-700 dark:!bg-dark-890 !text-white":"" ?> flex items-center font-medium  text-chambray-400 pt-1  h-12 px-5 rounded-lg">
                            <span class="ml-2 -mt-1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            خدمات
                            <span class="mr-2  text-white">
                                    <?= sizeof($data['getServices']) ?>
                            </span>
                        </button>
                    </li>
                </ul>

                <?php if(htmlspecialchars($_GET['type']) == "blog") { ?>
                    <div>
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
                            <?php if (sizeof($data['getNews']) > 0) { ?>
                                <?php
                                foreach ($data['getNews'] as $news) {
                                    if ($news['n_id'] != '') {
                                        ?>
                                            <?php require('app/views/template/default/items/blog-item.php'); ?>
                                        <?php
                                    }
                                }
                                ?>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="text-gray-300 font-bold text-28 mb-6">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8 ">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else if(htmlspecialchars($_GET['type']) == "service") { ?>
                    <div>
                        <div class="grid grid-cols-12 gap-6 gap-4 gap-y-20 pt-14">
                            <?php if (sizeof($data['getServices']) > 0) { ?>
                                <?php foreach ($data['getServices'] as $service){ ?>
                                    <div class="xl:col-span-4 md:col-span-4 sm:col-span-6 col-span-12 mb-15">
                                        <?php require('app/views/template/default/items/service-item.php'); ?>
                                    </div>
                                <?php  } ?>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="text-gray-300 font-bold text-28 mb-6">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8 ">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

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