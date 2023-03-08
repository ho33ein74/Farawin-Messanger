
<!DOCTYPE html>
<html dir="rtl" lang="fa" ng-app="siteBuilder.public" path="public">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>گواهی پایان دوره آموزش بلبلبیبیبسی | <?= $data['getPublicInfo']['site']; ?></title>
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

    <section wire:id="08K8J8qpQ0I80uRyaJyJ" class="col-span-10">
        <div class="container">
            <div class="my-24">
                <div x-data="{bgWhite:false}" class="lg:px-16 md:px-9 px-7 pt-15 pb-9 relative bg-gradient-to-tl from-gray-550 to-gray-400 mb-24 rounded-2xl ">
                    <img class="absolute bottom-0 right-0 w-full h-full" src="public/images/certificate.png" alt="">
                    <div class="relative z-10">
                        <div class="flex items-center relative justify-between lg:mb-14 mb-6 lg:flex-row flex-col">
                            <h1 class="lg:text-36 text-base font-bold text-white lg:text-right text-center">
                                <i class="w-6 h-13 flex bg-customOrange-550 absolute -right-16 rounded-l"> </i>
                                گواهی مشاهده آنلاین دوره
                            </h1>

                            <a href="<?= URL ?>">
                                <img width="220" src="public/images/logos/<?= $data['getPublicInfo']['logo'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                            </a>
                        </div>
                        <div :class="{'bg-opacity-10 backdrop-filter backdrop-blur !text-white' : bgWhite === false}" class="lg:px-24 md:px-10 px-6 text-gray-300 bg-white lg:pt-24 pt-10 pb-15 rounded-2xl lg:text-25 text-lg leading-10 bg-opacity-10 backdrop-filter backdrop-blur !text-white">
                            <div class="lg:mb-20 mb-8">
                                <div class="lg:mb-11 text-justify leading-relaxed" :class="{ '!text-gray-400' : bgWhite }">
                                    گواهی می&zwnj;شود <span class="inline lg:text-4xl text-lg font-bold lg:pr-6 lg:pl-4">Hossein Beiki</span> دوره <span class="inline lg:text-4xl text-lg font-bold pr-4 pl-6">آموزش کامل Flexbox</span> را به شکل موفقیت آمیز و آنلاین مشاهده کرده&zwnj;است.
                                </div>
                                <p class="leading-loose text-justify">
                                    این دوره مجموعاً <span :class="{ '!text-gray-400' : bgWhite }" class="inline font-bold lg:text-3xl text-lg text-yellow-400 px-1">01:44:19</span> ساعت است، راکت تایید می&zwnj;کند که <span class="font-semibold inline">Hossein Beiki</span> این دوره را در تاریخ <span :class="{ '!text-gray-400' : bgWhite }" class="inline font-bold lg:text-3xl text-lg text-yellow-400 lg:px-2 whitespace-nowrap">02 بهمن 1400</span> به شکل کامل مشاهده کرده و این صفحه، گواهی برای بر این موضوع است.
                                </p>
                            </div>
                            <div class="flex items-center lg:justify-between justify-center lg:flex-row flex-col">
                                <div class="flex items-center lg:mb-0 mb-8 lg:flex-row flex-col">
                                    <div :class="{'!bg-white  !bg-opacity-20 ' : bgWhite === false}" class="w-11 h-11 lg:mb-0 mb-5 bg-gray-500 bg-opacity-20 rounded-md flex items-center justify-center ml-4 !bg-white !bg-opacity-20">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M7.07511 10.8905C6.69343 10.5088 6.06932 10.5182 5.70541 10.9168C1.89571 15.0903 1.28769 17.3006 4.36982 20.3828C7.45194 23.4649 9.66228 22.8569 13.8357 19.0472C14.2344 18.6833 14.2438 18.0591 13.8621 17.6775C13.4952 17.3105 12.9038 17.3033 12.5202 17.6529C12.1345 18.0045 11.7702 18.3239 11.4237 18.612C10.3395 19.5136 9.53591 20.0178 8.90648 20.2595C8.33795 20.4778 7.94804 20.4706 7.57696 20.3506C7.13988 20.2092 6.547 19.8494 5.72511 19.0275C4.90322 18.2056 4.54333 17.6127 4.40199 17.1756C4.28198 16.8045 4.27479 16.4146 4.49308 15.8461C4.73476 15.2167 5.239 14.4131 6.14059 13.3289C6.42868 12.9824 6.74806 12.6181 7.09969 12.2323C7.44929 11.8488 7.44206 11.2574 7.07511 10.8905ZM17.928 13.6116C17.561 13.2446 17.5538 12.6532 17.9034 12.2697C18.255 11.884 18.5744 11.5196 18.8625 11.1732C19.7641 10.089 20.2683 9.28539 20.51 8.65596C20.7283 8.08742 20.7211 7.69752 20.6011 7.32644C20.4598 6.88936 20.0999 6.29647 19.278 5.47459C18.4561 4.6527 17.8632 4.29281 17.4261 4.15146C17.0551 4.03146 16.6652 4.02426 16.0966 4.24256C15.4672 4.48423 14.6636 4.98848 13.5794 5.89007C13.2329 6.17816 12.8686 6.49754 12.4829 6.84917C12.0993 7.19877 11.5079 7.19154 11.141 6.82459C10.7593 6.44291 10.7687 5.8188 11.1674 5.45489C15.3408 1.64518 17.5512 1.03717 20.6333 4.1193C23.7154 7.20142 23.1074 9.41176 19.2977 13.5852C18.9338 13.9839 18.3097 13.9933 17.928 13.6116Z"></path>
                                            <path stroke="currentColor" d="M9.11328 15.6392L15.8897 8.86272" stroke-width="1.91667" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 :class="{'!text-white ' : bgWhite === false}" class="text-gray-300 text-lg font-semibold lg:text-right text-center !text-white">گواهی مشاهد آنلاین</h5>
                                        <p class="text-xs text-gray-300 lg:text-right text-center" num-en="" style="font-family: tahoma; font-style: normal;">
                                            f6caf134-6533-4275-aa3b-63b118dd8hhe
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-gray-300 text-21 leading-3 lg:text-left text-center">
                                        <?= $data['getPublicInfo']['managemen_name']; ?>
                                    </h5>
                                    <h6 class="text-gray-300 text-15">
                                        مدیرعامل مجموعه
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between lg:px-10 sm:flex-row flex-col">
                            <div class="flex items-center lg:mb-0 mb-9">
                                <div class="relative hvr-ripple-out" style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false"></div>
                                <h3 class="lg:text-28 text-xl font-bold text-white"></h3>
                            </div>
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