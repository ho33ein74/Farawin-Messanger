<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['tag_info'][0]['tag']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['tag_info'][0]['tag']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:brand" content="<?= $data['getPublicInfo']['site']; ?>" />
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="twitter:site" content="<?= URL; ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>">
    <meta property="twitter:description" content="<?= $data['tag_info'][0]['tag']; ?>">
    <meta property="twitter:title" content="<?= $data['tag_info'][0]['tag']; ?>">
    <meta property="og:description" content="<?= $data['tag_info'][0]['tag']; ?>">
    <meta property="og:title" content="<?= $data['tag_info'][0]['tag']; ?>">
    <meta name="description" content="<?= $data['tag_info'][0]['tag']; ?>">
    <meta name="article:publisher" content="<?= $data['tag_info'][0]['tag']; ?>"/>
    <link rel="canonical" href="<?= URL; ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>">
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['tag_info'][0]['tag']; ?> | <?= $data['getPublicInfo']['site']; ?>",
            "description":"<?= $data['tag_info'][0]['tag']; ?>"
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@graph" : [
                {
                    "@type":"Organization",
                    "@id":"<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#organization",
                    "name":"<?= $data['getPublicInfo']['site']; ?>",
                    "url":"<?= URL; ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>",
                    "sameAs":[
                        "<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>",
                        "<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>",
                        "<?= $data['getMethodsContacting']['twitter']['mc_link']; ?>"
                    ],
                    "logo":{
                        "@type":"ImageObject",
                        "@id":"<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#logo",
                        "url":"<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>",
                        "width":512,
                        "height":512,
                        "caption":"<?= $data['getPublicInfo']['site']; ?>"
                    },
                    "image":{
                        "@id":"<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#logo"
                    }
                },
                {
                    "@type": "WebSite",
                    "@id" : "<?= URL ?>#website",
                    "url" : "<?= URL ?>",
                    "name" : "<?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['tag_info'][0]['tag']; ?>",
                    "publisher":{
                        "@id":"<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#organization"
                    },
                    "potentialAction" : {
                        "@type": "SearchAction",
                        "target": "<?= URL ?>search?s={search_term_string}",
                        "query-input": "required name=search_term_string"
                    }
                }
            ,{
                    "@type" : "BreadcrumbList",
                    "@id" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#breadcrumb",
                    "itemListElement" : [
                        {
                            "@type" : "ListItem",
                            "position" : 1,
                            "item" : {
                                "@type" : "WebPage",
                                "@id" : "<?= URL ?>",
                                "url" : "<?= URL ?>",
                                "name" : "صفحه‌  اصلی"
                            }
                        },
                         {
                            "@type" : "ListItem",
                            "position" : 2,
                            "item" : {
                                "@type" : "WebPage",
                                "@id" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>",
                                "url" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>",
                                "name" : "<?= $data['tag_info'][0]['tag']; ?>"
                            }
                        }
                    ]
                }
            ,{
                    "@type" : "CollectionPage",
                    "@id" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#webpage",
                    "url" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>",
                    "name" : "<?= $data['tag_info'][0]['tag']; ?> | <?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['tag_info'][0]['tag']; ?>",
                    "inLanguage" : "fa-IR",
                    "isPartOf" : {
                        "@id" : "<?= URL ?>tags/<?= $data['tag_type'] ?>/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>#website"
                    }
                }
            ]
        }
    </script>
</head>

<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890" :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="rR8CKmhfXYysyOboJmXx" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;rR8CKmhfXYysyOboJmXx&quot;,&quot;name&quot;:&quot;layouts.header.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;articles&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;l841445419-0&quot;:{&quot;id&quot;:&quot;tqVWXPBab8nvKWV6jJYN&quot;,&quot;tag&quot;:&quot;section&quot;},&quot;l841445419-1&quot;:{&quot;id&quot;:&quot;xob1MBgF9NREtEBw2U77&quot;,&quot;tag&quot;:&quot;form&quot;},&quot;l841445419-2&quot;:{&quot;id&quot;:&quot;RD7RCOKdeDnkqPUf4fj1&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-3&quot;:{&quot;id&quot;:&quot;TBIfWcfZ1GCCMmJ8mEHh&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-4&quot;:{&quot;id&quot;:&quot;Q3Aoqi1jL4tSRUZKotu4&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-5&quot;:{&quot;id&quot;:&quot;7voppBzzUkMaspdvSOCD&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-6&quot;:{&quot;id&quot;:&quot;8cOenZtwxGT9LfgmTeOm&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;65bebe47&quot;,&quot;data&quot;:{&quot;discount&quot;:{&quot;status&quot;:false,&quot;message&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;140f108f70c37cc500d7671bd593ca11e7be40b77f403c83c8156ef2ffaf6beb&quot;}}">
        <section wire:id="SfB4ZUq638lqqybiU0m7" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;SfB4ZUq638lqqybiU0m7&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;<?= $data['slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;5be47514&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:null,&quot;message&quot;:null,&quot;moreLink_title&quot;:null,&quot;moreLink_link&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;f14f1b5304e10be1a95d1c23484ec70cbfdbdfd7aad313b4556d75590cd6504d&quot;}}" class="mt-4">
            <div class="container"></div>
        </section>

        <?php require('app/views/include/default/header.php'); ?>
    </div>

    <section wire:id="IrTlwFNK9YEQzbMKJ0Wz" class="mt-10 mb-20">
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
            <div class="content ">
                <div class="grid lg:grid-cols-24 grid-cols-1 gap-6 mb-9">
                    <div wire:id="MJHgMwfhwt9RGhpW4mB1" class="xl:col-span-8  lg:col-span-7 flex justify-between items-center bg-white dark:bg-dark-930 dark:shadow-whiteShadow shadow-sm rounded-xl px-5 xl:py-7 py-5">
                        <h4 class="flex hashtag three-point-overflow w-6/12 items-center dark:text-white font-semibold xl:text-28 text-xl text-blue-700 ">
                            <?= $data['tag_info'][0]['tag']; ?>
                        </h4>
                    </div>
                    <!-- Livewire Component wire-end:MJHgMwfhwt9RGhpW4mB1 -->
                    <div class="xl:col-span-16 lg:col-span-17 grid md:grid-cols-3 sm:grid-cols-2  gap-4">
                        <div class="flex h-full sm:justify-start justify-center dark:bg-dark-930 dark:border-opacity-0 dark:shadow-whiteShadow  items-center border border-gray-210 rounded-lg xl:px-6 px-3 pt-5 pb-3">
                            <img class="-mr-4 xl:ml-1 -ml-2" src="public/images/archive_image.png" alt="تعداد مقالات">
                            <div class="flex flex-col md:items-start items-center">
                                <h6 class="font-bold  xl:text-22 text-xl text-dark-750 dark:text-white">
                                    <?= sizeof($data['blogs']) ?> مقاله
                                </h6>
                                <span class="font-normal xl:text-17 text-15  dark:text-gray-200 text-gray-300">
                                    منتشر شده
                                </span>
                            </div>
                        </div>

                        <div class="flex h-full sm:justify-start justify-center dark:bg-dark-930 dark:border-opacity-0 dark:shadow-whiteShadow items-center border border-gray-210 rounded-lg xl:px-6 px-3  pt-5 pb-3">
                            <img class="-mr-4 xl:ml-1 -ml-2" src="public/images/archive_service.png" alt="تعداد خدمات ارائه شده در سالن">
                            <div class="flex flex-col md:items-start items-center">
                                <h6 class="font-bold  xl:xl:text-22 text-xl text-xl2 dark:text-white text-dark-750">
                                    <?= sizeof($data['services']) ?>
                                    خدمت
                                </h6>
                                <span class="font-normal xl:text-17 text-15 dark:text-gray-200 text-gray-300">
                                    منتشر شده
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-210 dark:border-white dark:border-opacity-10" id="tag-page">
                    <div class="flex items-center lg:flex-row flex-col-reverse justify-between mb-9">
                        <div class="flex items-center space-x-8 lg:mt-0 mt-5 space-x-reverse">
                            <a href="<?= URL; ?>tags/blog/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>" class="rounded-md flex items-center md:text-2xl text-13 <?= $data['tag_type'] == "blog" ? "font-semibold sm:py-3 py-1 sm:px-4 px-2 shadow-sm bg-white dark:bg-transparent dark:shadow-whiteShadow dark:bg-dark-930 dark:text-white shadow-sm text-blue-700":"font-medium text-biscay-700 dark:text-gray-200" ?>">
                                <span class="transform sm:scale-100 scale-75">
                                    <svg class="ml-2 mb-1" width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.5743 8.22069C16.0991 8.22069 15.4696 8.21017 14.6859 8.21017C12.7745 8.21017 11.2029 6.62817 11.2029 4.69884V1.31381C11.2029 1.04752 10.9902 0.830688 10.7266 0.830688H5.15916C2.56096 0.830688 0.460938 2.96317 0.460938 5.57667V16.918C0.460938 19.6599 2.66101 21.8818 5.37594 21.8818H13.6666C16.2554 21.8818 18.3544 19.763 18.3544 17.1474V8.69434C18.3544 8.42699 18.1428 8.21122 17.8781 8.21227C17.4331 8.21543 16.8995 8.22069 16.5743 8.22069" fill="currentColor"></path>
                                        <path opacity="0.4" d="M13.7079 1.42778C13.3932 1.10044 12.8438 1.32568 12.8438 1.77933V4.55493C12.8438 5.71906 13.8026 6.67688 14.9668 6.67688C15.7004 6.6853 16.7193 6.68741 17.5845 6.6853C18.0276 6.68425 18.2528 6.15481 17.9455 5.83484C16.835 4.68018 14.8468 2.61085 13.7079 1.42778" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.22256 10.7117H9.78546C10.2181 10.7117 10.5696 10.3612 10.5696 9.92856C10.5696 9.49596 10.2181 9.14441 9.78546 9.14441H6.22256C5.78995 9.14441 5.43945 9.49596 5.43945 9.92856C5.43945 10.3612 5.78995 10.7117 6.22256 10.7117ZM6.22349 15.9683H11.9536C12.3862 15.9683 12.7378 15.6178 12.7378 15.1852C12.7378 14.7526 12.3862 14.401 11.9536 14.401H6.22349C5.79088 14.401 5.44038 14.7526 5.44038 15.1852C5.44038 15.6178 5.79088 15.9683 6.22349 15.9683Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                مقالات
                            </a>
                            <a href="<?= URL; ?>tags/service/<?= str_replace(" ","-", $data['tag_info'][0]['tag']); ?>" class="rounded-md flex items-center md:text-2xl text-13<?= $data['tag_type'] == "service" ? "font-semibold sm:py-3 py-1 sm:px-4 px-2 shadow-sm bg-white dark:bg-transparent dark:shadow-whiteShadow dark:bg-dark-930 dark:text-white shadow-sm text-blue-700":"font-medium text-biscay-700 dark:text-gray-200" ?>">
                                <span class="transform sm:scale-100 scale-75">
                                    <svg class="ml-2 mb-1" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                خدمات
                            </a>
                        </div>
                    </div>

                    <div>
                        <?php if ($data['tag_type'] == "blog") { ?>
                            <?php if (sizeof($data['blogs']) > 0) { ?>
                                <div class="grid xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
                                    <?php foreach ($data['blogs'] as $news) { ?>
                                        <?php require('app/views/template/default/items/blog-item.php'); ?>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="text-gray-300 font-bold text-28 mb-6">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8 ">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else if ($data['tag_type'] == "service") { ?>
                            <?php if (sizeof($data['services']) > 0) { ?>
                                <div class="grid grid-cols-12 gap-6 mt-24">
                                    <?php foreach($data['services'] as $service){ ?>
                                        <div class="xl:col-span-4 md:col-span-4 sm:col-span-6 col-span-12 mb-15">
                                            <?php require('app/views/template/default/items/service-item.php'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="col-span-12 flex flex-col items-center mt-9">
                                    <span class="text-gray-300 font-bold text-28 mb-6">هیچ نتیجه ای یافت نشد!</span>
                                    <div class="mb-8 ">
                                        <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require('app/views/include/default/footer.php'); ?>
</div>

<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/articles.js"></script>
<script>
    window.Alpine.start();
</script>
<script>
    $('input[type="radio"][name="order"]').click(function() {
        window.location = $(this).val();
    });
</script>

</body>
</html>