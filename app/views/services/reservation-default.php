<?php
/** @var TYPE_NAME $data */
/** @var TYPE_NAME $news */

$keyword = '';
foreach ($data['servicesTag'] as $tag) {
    if ($tag['tag'] != '') {
        $keyword .= $tag['tag'] . ',';
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['services']['s_title'] ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="keywords" content="<?= $data['services']['s_mainKeyword'] ?>,<?= $keyword; ?>"/>
    <meta name="description" content="<?= $news[0]['seo_desc']; ?>">
    <link rel="canonical" href="<?= URL ?>services/<?= $data['services']['s_slug'] ?>">
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?= URL ?>rss"/>
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $data['services']['seo_title'] ?>">
    <meta property="og:description" content="<?= $data['services']['seo_desc'] ?>">
    <meta property="og:url" content="<?= URL ?>services/<?= $data['services']['s_slug'] ?>">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="article:tag" content="<?= $keyword ?>">
    <meta property="article:section" content="<?= $data['services']['s_title'] ?>">
    <meta property="article:published_time" content="<?= $data['services']['s_date_created'] ?>">
    <meta property="article:modified_time" content="<?= $data['services']['s_date_created'] ?>">
    <meta property="og:updated_time" content="<?= $data['services']['s_date_created'] ?>">
    <meta property="og:image" content="<?= URL ?>public/images/services/<?= $data['services']['s_cover'] ?>">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:description" content="<?= $data['services']['seo_desc'] ?>">
    <meta name="twitter:title" content="<?= $data['services']['seo_title'] ?>">
    <meta name="twitter:image" content="<?= URL ?>public/images/services/<?= $data['services']['s_cover'] ?>">
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
    <link rel="stylesheet" href="public/css/default/reservation.css"/>
    <link rel="stylesheet" href="public/css/jquery.fancybox.min.css" />
    <script src="public/js/showdown.min.js"></script>

    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['services']['s_title'] ?>",
            "description":"<?= $data['services']['seo_desc'] ?>"
        }
    </script>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@graph" : [
                {
                    "@type":"Organization",
                    "@id":"<?= URL; ?>#organization",
                    "name":"<?= $data['getPublicInfo']['site']; ?>",
                    "url":"<?= URL; ?>",
                    "sameAs":[
                        <?php if ($data['getMethodsContacting']['telegram']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>",
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['youtube']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['youtube']['mc_link']; ?>",
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>",
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['twitter']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['twitter']['mc_link']; ?>",
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['linkedin']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['linkedin']['mc_link']; ?>",
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['aparat']['mc_link'] != NULL) { ?>
                            "<?= $data['getMethodsContacting']['aparat']['mc_link']; ?>"
                        <?php } ?>
                        ""
                    ],
                    "logo":{
                        "@type":"ImageObject",
                        "@id":"<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo'] ?>#logo",
                        "url":"<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo'] ?>",
                        "width":512,
                        "height":512,
                        "caption":"<?= $data['getPublicInfo']['site']; ?>"
                    },
                    "image":{
                        "@id":"<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo'] ?>#logo"
                    }
                },
                {
                    "@type": "WebSite",
                    "@id" : "<?= URL; ?>#website",
                    "url" : "<?= URL; ?>",
                    "name" : "<?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['services']['seo_desc'] ?>",
                    "publisher":{
                        "@id":"<?= URL; ?>#organization"
                    },
                    "potentialAction" : {
                        "@type": "SearchAction",
                        "target": "<?= URL; ?>/search?s={search_term_string}",
                        "query-input": "required name=search_term_string"
                    }
                },
                {
                    "@type" : "ImageObject",
                    "@id" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>#primaryimage",
                    "url" : "<?= URL ?>public/images/services/<?= $data['services']['s_cover'] ?>",
                    "width" : 600,
                    "height" : 315
                },
                {
                    "@type":"WebPage",
                    "@id":"<?= URL ?>services/<?= $data['services']['s_slug'] ?>#webpage",
                    "url":"<?= URL ?>services/<?= $data['services']['s_slug'] ?>",
                    "inLanguage":"fa-IR",
                    "name":"<?= $data['services']['seo_title'] ?>",
                    "isPartOf" : {
                        "@id" : "<?= URL ?>#website"
                    },
                    "primaryImageOfPage" : {
                        "@id" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>#primaryimage"
                    },
                    "datePublished": "<?= $data['services']['s_date_created'] ?>",
                    "dateModified": "<?= $data['services']['s_date_created'] ?>",
                    "description" : "<?= $news[0]['seo_desc']; ?>",
                    "breadcrumb" : {
                        "@id" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>#breadcrumb"
                    }
                },
                {
                    "@type" : "BreadcrumbList",
                    "@id" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>#breadcrumb",
                    "itemListElement" : [
                        {
                            "@type" : "ListItem",
                            "position" : 1,
                            "item" : {
                                "@type" : "WebPage",
                                "@id" : "<?= URL; ?>",
                                "url" : "<?= URL; ?>",
                                "name" : "صفحه‌اصلی"
                            }
                        },
                        {
                            "@type" : "ListItem",
                            "position" : 2,
                            "item" : {
                                "@type" : "WebPage",
                                "@id" : "<?= URL ?>services",
                                "url" : "<?= URL ?>services",
                                "name" : "خدمات <?= $data['getPublicInfo']['site']; ?>"
                            }
                        },
                         {
                            "@type" : "ListItem",
                            "position" : 3,
                            "item" : {
                                "@type" : "WebPage",
                                "@id" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>",
                                "url" : "<?= URL ?>services/<?= $data['services']['s_slug'] ?>",
                                "name" : "<?= $data['services']['seo_title'] ?>"
                            }
                        }
                    ]
                }
            ]
        }
    </script>

    <?php if(sizeof($data['relatedFaq'])>0){ ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": [
                    <?php foreach($data['relatedFaq'] as $faq){ ?>
                    {
                        "@type": "Question",
                        "name": "<?= $faq['question'] ?>",
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": "<?= $faq['answer'] ?>"
                        }
                    },
                    <?php } ?>
                ]
            }
        </script>
    <?php } ?>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "CreativeWorkSeries",
            "headline": "<?= $data['services']['seo_title'] ?>",
            "image": "<?= URL ?>public/images/services/<?= $data['services']['s_cover'] ?>",
            "provider": {
                "@type": "Organization",
                "name": "<?= $data['getPublicInfo']['site']; ?>",
                "sameAs": "<?= URL ?>"
            },
            "aggregateRating": {
                "@type": "AggregateRating",
                "itemReviewed": {
                    "@type": "Thing",
                    "name": "<?= $data['services']['seo_title'] ?>",
                    "url": "<?= URL ?>services/<?= $data['services']['s_slug'] ?>"
                },
                "ratingValue": "<?= $data['scoreItem']['sum']/$data['scoreItem']['count'] ?>",
                "bestRating": "5",
                "ratingCount": "<?= $data['scoreItem']['count'] ?>"
            }
        }
    </script>
</head>

<body x-data="{bodyOverflow:false, overlayShow : false}" @body-overflow-active.window="bodyOverflow = true" @body-overflow-hide.window="bodyOverflow = false" class="font-iranyekanBakh dark:!bg-dark-890" :class="{'overflow-hidden':bodyOverflow}" x-ref="body">
<div class="w-full h-screen absolute top-0 right-0 bg-gradient-to-t from-opacity-color-200 to-opacity-color-1 z-negative"></div>
<div x-cloak x-show="overlayShow" @overlay-show.window="overlayShow = true" @overlay-hide.window="overlayShow = false" @click="overlayShow = false,bodyOverflow = false , $dispatch('menu-hide')" id="overlay" class="z-40 w-full  h-full fixed top-0 right-0 backdrop-filter blur-sm bg-opacity-60 bg-biscay-700"></div>
<div class="z-0">
    <div wire:id="r7jwYbegfASC0wv45VnH">
        <section wire:id="YbtAnwELDqMGGpyAcY1z" class="mt-4">
            <div class="container"></div>
        </section>
        <!-- Livewire Component wire-end:YbtAnwELDqMGGpyAcY1z -->
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <!-- Livewire Component wire-end:r7jwYbegfASC0wv45VnH -->
    <div wire:id="5KEwHoWvbAL9MKG4ewmW">
        <section class="mt-10 mb-9">
            <div class="container">

                <?php if(sizeof($data['checkTurnBookingUser'])>0 AND $data['checkTurnBookingUser'][0]['sre_timestamp_expire']>time()){ ?>
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
                                    شما خدمت <?= $data['services']['s_title'] ?> را برای روز <?= $data['checkTurnBookingUser'][0]['sre_day']." ".$data['checkTurnBookingUser'][0]['sre_date']." ساعت ".$data['checkTurnBookingUser'][0]['sre_time'] ?> انتخاب کرده اید.
                                </p>
                                <a href="bookedInit?date=<?= str_replace("/","_", $data['checkTurnBookingUser'][0]['sre_date']) ?>&time=<?= str_replace(":","_", $data['checkTurnBookingUser'][0]['sre_time']) ?>&ugid=<?= $data['checkTurnBookingUser'][0]['service_id'] ?>" class="flex items-center transform transition duration-200 ">
                                    <span class="ml-1 font-semibold lg:text-xl text-base underline hover:no-underline">رزرو نهایی</span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="currentColor" opacity="0.4" d="M15.7975 10.8097L19.4967 10.4825C20.3269 10.4825 21 11.1622 21 12.0004C21 12.8387 20.3269 13.5183 19.4967 13.5183L15.7975 13.1912C15.1463 13.1912 14.6183 12.6581 14.6183 12.0004C14.6183 11.3417 15.1463 10.8097 15.7975 10.8097Z"></path>
                                        <path fill="currentColor" d="M3.37522 10.8698C3.43303 10.8115 3.64903 10.5647 3.85194 10.3598C5.03556 9.07656 8.12607 6.97815 9.74278 6.33596C9.98823 6.23352 10.6089 6.01542 10.9417 6C11.2591 6 11.5624 6.0738 11.8515 6.2192C12.2126 6.42299 12.5006 6.74463 12.6598 7.12355C12.7613 7.38572 12.9206 8.17331 12.9206 8.18763C13.0787 9.04792 13.1649 10.4469 13.1649 11.9934C13.1649 13.465 13.0787 14.8067 12.9489 15.6813C12.9347 15.6967 12.7755 16.6738 12.602 17.0086C12.2846 17.6211 11.6638 18 10.9995 18H10.9417C10.5086 17.9857 9.59878 17.6057 9.59878 17.5924C8.06825 16.9502 5.05083 14.9532 3.83776 13.6258C3.83776 13.6258 3.49522 13.2844 3.34685 13.0718C3.11558 12.7656 2.99995 12.3866 2.99995 12.0077C2.99995 11.5847 3.12977 11.1915 3.37522 10.8698Z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="cursor-pointer md:relative absolute md:left-0 md:top-0 top-5  group hover:opacity-75" wire:loading.remove="" wire:target="closeHeaderMessage" wire:click="closeHeaderMessage">
                            <div class="text-10 flex items-center text-gray-450 h-8  dark:text-white rounded px-1.5">
                                <div dir="ltr" id="timer" data-end="<?= gmdate('Y-m-d\TH:i:s', $data['checkTurnBookingUser'][0]['sre_timestamp_expire']) ?>"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="bg-white dark:bg-dark-930 rounded-lg dark:shadow-whiteShadow sm:pt-6 pt-3 sm:pb-4 pb-3 shadow-sm">
                    <div>
                        <div class="flex lg:flex-row flex-col items-center xl:px-10 sm:px-5 px-3">
                            <div class="lg:w-8/12 w-full flex flex-col lg:text-right text-center">
                                <div class="flex  items-center md:mb-5 mb-3 ">
                                    <h2 class="text-biscay-700 dark:text-white md:text-5xl text-2xl font-bold inline-block"><?= $data['services']['s_title'] ?></h2>
                                </div>
                                <p class="text-gray-300 md:text-xl dark:text-gray-910 text-base font-normal md:leading-8 leading-7 mb-5"><?= $data['services']['seo_desc'] ?></p>
                            </div>

                            <div class="lg:w-2/6 w-full lg:order-last order-first lg:mr-14 lg:h-64 sm:h-80 h-48 lg:mb-0 mb-5 overflow-hidden rounded">
                                <img class="w-full h-full object-cover transform transition duration-200 hover:scale-110"
                                     onerror="this.src='public/images/default_cover.jpg'"
                                     src="public/images/services/<?= $data['services']['s_cover'] ?>" alt="تصویر <?= $data['services']['s_title'] ?>"/>
                            </div>
                        </div>
                        <hr class="mt-7 mb-5 border-gray-100 mx-4"/>
                        <div class="flex items-center sm:flex-row flex-col justify-between md:px-10 px-5">
                            <ul class="flex items-center">
                                <li class="ml-7 flex items-center cursor-pointer group">
                                    <div class="flex items-center add-like <?= $data['userId']!=FALSE ? "":" login_req";  ?>" data-id="<?= $data['attrId']; ?>" data-type="service" data-part="service" data-view="icon">
                                        <svg class="ml-1" width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="likeIcon fill-current <?= $data['services']['liked'] == "1" ? "text-red-450":"text-dark-350";  ?> text-gray-300 group-hover:text-red-450" fill-rule="evenodd" clip-rule="evenodd" d="M7.60977 0C3.74605 0 0.511719 2.89525 0.511719 6.5867C0.511719 10.1217 2.52013 12.8603 4.7213 14.8002C6.92648 16.7437 9.42643 17.9791 10.6576 18.5217C11.3636 18.8328 12.1658 18.8328 12.8719 18.5217C14.103 17.9792 16.603 16.7437 18.8081 14.8003C21.0093 12.8604 23.0177 10.1218 23.0177 6.58685C23.0177 2.89543 19.7834 0 15.9197 0C14.3158 0 12.8825 0.676635 11.7647 1.47662C10.647 0.676635 9.21366 0 7.60977 0Z" />
                                        </svg>
                                        <span class="likeCounter <?= $data['services']['liked'] == "1" ? "text-red-450":"text-dark-550";  ?> font-medium text-17 mt-1 group-hover:text-red-450"><?= $data['services']['likeCount'] ?></span>
                                    </div>
                                </li>
                                <li class="ml-7 flex items-center cursor-pointer group">
                                    <a href="services/<?= $data['services']['s_slug'] ?>#comments-list" class="flex items-center">
                                        <svg class="ml-1" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current text-gray-300 group-hover:text-green-700" fill-rule="evenodd" clip-rule="evenodd" d="M11.6397 0C20.9066 0 22.8927 1.66715 22.8927 10.0027C22.8927 15.4208 21.9552 18.755 17.7353 18.755C15.4802 18.755 14.8094 19.8263 14.1847 20.8238C13.6405 21.6929 13.1313 22.506 11.6399 22.506C10.1487 22.506 9.63949 21.6929 9.09526 20.8238C8.47058 19.8263 7.79973 18.755 5.54457 18.755C1.3247 18.755 0.386719 15.3142 0.386719 10.0027C0.386719 1.76547 2.37287 0 11.6397 0ZM12.5775 7.502C12.5775 6.9841 12.9973 6.56425 13.5152 6.56425H16.3285C16.8464 6.56425 17.2662 6.9841 17.2662 7.502C17.2662 8.01991 16.8464 8.43975 16.3285 8.43975H13.5152C12.9973 8.43975 12.5775 8.01991 12.5775 7.502ZM6.95097 10.3153C6.43306 10.3153 6.01322 10.7351 6.01322 11.253C6.01322 11.7709 6.43306 12.1908 6.95097 12.1908H16.3285C16.8464 12.1908 17.2662 11.7709 17.2662 11.253C17.2662 10.7351 16.8464 10.3153 16.3285 10.3153H6.95097Z"/>
                                        </svg>
                                        <span class="text-dark-550 font-medium text-17 mt-1 dark:text-dark-200 group-hover:text-green-700"><?= $data['comment']['count'] ?></span>
                                    </a>
                                </li>
                                <li class="ml-7 last:ml-0 flex items-center cursor-pointer group">
                                    <div class="flex items-center add-bookmark <?= $data['userId']!=FALSE ? "":" login_req";  ?>" wire:click="bookmark" data-id="<?= $data['attrId']; ?>" data-type="service">
                                        <span class="transform md:scale-100 scale-75">
                                            <svg class="bookmarkIcon ml-1 <?= $data['services']['bookmarked'] == "1" ? "text-blue-700":"text-gray-300";  ?> group-hover:text-blue-700" width="20" height="20" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="fill-current" d="M4.23184 22.6504L4.2318 22.6503L4.22199 22.6572C3.04557 23.4827 1.42138 22.7355 1.30875 21.2832C1.17635 19.576 0.999972 16.4481 1 11.8995V11.8175V11.8174C0.999969 10.0118 1.00095 8.43863 1.12977 7.12592C1.26037 5.79506 1.53145 4.60334 2.16086 3.63263C3.47704 1.60273 6.01221 1.01675 9.99537 1.00034C13.9832 0.983922 16.5219 1.56713 17.8395 3.6099C18.468 4.58436 18.7388 5.78163 18.8693 7.11699C18.9981 8.43473 18.9991 10.012 18.999 11.8183V11.8995C18.999 16.4481 18.8226 19.576 18.6902 21.2832C18.5776 22.7355 16.9534 23.4827 15.777 22.6572L15.7771 22.6571L15.7672 22.6504C14.7352 21.9445 13.7802 21.1846 13.036 20.5921L13.0227 20.5815C12.6844 20.3122 12.3775 20.0678 12.1367 19.8893C11.6849 19.5545 11.3077 19.3258 10.9582 19.185C10.5777 19.0318 10.2705 18.999 9.99952 18.999C9.72852 18.999 9.4213 19.0318 9.04088 19.185C8.69134 19.3258 8.31411 19.5545 7.86233 19.8893C7.62156 20.0678 7.3145 20.3123 6.97629 20.5815L6.96307 20.5921C6.21886 21.1846 5.26383 21.9445 4.23184 22.6504Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path class="stroke-current" d="M11.999 5.00391C12.999 5.00391 13.499 5.00011 14.2489 5.74813C14.9989 6.49615 14.9989 8.99982 14.9989 9.99976" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                        <span class="bookmarkCounter <?= $data['services']['bookmarked'] == "1" ? "text-blue-700":"text-dark-550";  ?> font-medium text-17 mt-1 dark:group-hover:text-blue-450 group-hover:text-blue-700"><?= $data['services']['bookmark_count'] ?></span>
                                    </div>
                                </li>
                            </ul>
                            <div class="flex sm:mt-0 mt-5 items-center">
                                <span class="text-gray-300 dark:text-dark-200 font-normal text-15 ml-3"> اشتراک گذاری: </span>
                                <div class="flex items-center">
                                    <a href="https://t.me/share/url?url=<?= URL ?>services/<?= $data['services']['s_slug'] ?>&text=<?= $data['services']['s_title'] ?>" class="ml-3 cursor-pointer group">
                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current text-gray-300 group-hover:text-blue-700" fill-rule="evenodd" clip-rule="evenodd" d="M18.3844 19.779C18.7064 20.007 19.1214 20.064 19.4914 19.924C19.8614 19.783 20.1334 19.467 20.2154 19.084C21.0844 15 23.1924 4.66303 23.9834 0.948026C24.0434 0.668026 23.9434 0.377026 23.7234 0.190026C23.5034 0.00302622 23.1984 -0.0509739 22.9264 0.0500261C18.7334 1.60203 5.8204 6.44703 0.542398 8.40003C0.207398 8.52402 -0.0106021 8.84603 0.000397854 9.19903C0.0123979 9.55303 0.250398 9.86003 0.593398 9.96303C2.9604 10.671 6.0674 11.656 6.0674 11.656C6.0674 11.656 7.5194 16.041 8.2764 18.271C8.3714 18.551 8.5904 18.771 8.8794 18.847C9.1674 18.922 9.4754 18.843 9.6904 18.64C10.9064 17.492 12.7864 15.717 12.7864 15.717C12.7864 15.717 16.3584 18.336 18.3844 19.779ZM7.3744 11.102L9.0534 16.64L9.4264 13.133C9.4264 13.133 15.9134 7.28203 19.6114 3.94703C19.7194 3.84903 19.7344 3.68503 19.6444 3.57003C19.5554 3.45503 19.3914 3.42803 19.2684 3.50603C14.9824 6.24303 7.3744 11.102 7.3744 11.102Z" fill="#98A3B8"/>
                                        </svg>
                                    </a>
                                    <a href="https://twitter.com/share?text=<?= $data['services']['s_title'] ?>&url=<?= URL ?>services/<?= $data['services']['s_slug'] ?>" class="cursor-pointer group">
                                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current text-gray-300 group-hover:text-blue-700" d="M24 2.309C23.117 2.701 22.168 2.965 21.172 3.084C22.189 2.475 22.97 1.51 23.337 0.36C22.386 0.924 21.332 1.334 20.21 1.555C19.313 0.598 18.032 0 16.616 0C13.437 0 11.101 2.966 11.819 6.045C7.728 5.84 4.1 3.88 1.671 0.901C0.381 3.114 1.002 6.009 3.194 7.475C2.388 7.449 1.628 7.228 0.965 6.859C0.911 9.14 2.546 11.274 4.914 11.749C4.221 11.937 3.462 11.981 2.69 11.833C3.316 13.789 5.134 15.212 7.29 15.252C5.22 16.875 2.612 17.6 0 17.292C2.179 18.689 4.768 19.504 7.548 19.504C16.69 19.504 21.855 11.783 21.543 4.858C22.505 4.163 23.34 3.296 24 2.309Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="md:grid lg:grid-cols-24 gap-3 mb-20">
                    <div x-data="serviceQuickHeader()" @scroll.window="scrollingController()" class="xl:col-span-18 lg:col-span-17">
                        <div class="py-4 shadow-sm overflow-x-auto bg-white dark:bg-dark-930 rounded-lg mb-8 sticky top-1 z-30">
                            <ul class="flex items-center px-6  quick_acsess_header">

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.reservation_box.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition flex items-center" :class="{'dark:!text-white quick_access_active_style':quickAccessCondition === 'reservation'}">
                                        <i class="ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'reservation'}"></i>
                                        رزرو نوبت
                                    </button>
                                </li>

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.descriptionBox.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition flex items-center" :class="{'dark:!text-white quick_access_active_style ':quickAccessCondition === 'description'}">
                                        <i class="ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'description'}"></i>
                                        توضیحات
                                    </button>
                                </li>

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.sessionsBoxTop.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition  flex items-center " :class="{' dark:!text-white quick_access_active_style':quickAccessCondition === 'sessions'}">
                                        <i class=" ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'sessions'}"></i>
                                        جلسات ترمیم
                                    </button>
                                </li>

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.staffsBoxTop.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition  flex items-center " :class="{' dark:!text-white quick_access_active_style':quickAccessCondition === 'staffs'}">
                                        <i class=" ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'staffs'}"></i>
                                        پرسنل سالن
                                    </button>
                                </li>

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.portfolioBoxTop.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition  flex items-center " :class="{' dark:!text-white quick_access_active_style':quickAccessCondition === 'portfolio'}">
                                        <i class=" ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'portfolio'}"></i>
                                        نمونه کار انجام شده
                                    </button>
                                </li>

                                <li class="ml-8 sm:w-fit-content ">
                                    <button @click="scrollContoroller($refs.commentBox.offsetTop)" class="text-15 whitespace-nowrap text-gray-300 dark:hover:text-white hover:text-gray-700 duration-200 transition flex items-center" :class="{'dark:!text-white quick_access_active_style':quickAccessCondition === 'comment'}">
                                        <i class="ml-1 w-1 h-1 rounded-full flex" :class="{'dark:!bg-white quick_access_active_style ':quickAccessCondition === 'comment'}"></i>
                                        دیدگاه و پرسش
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div id="reservation_box" x-ref="reservation_box" @scroll.window="reservationBoxTop = $refs.reservation_box.offsetTop - 150" class="bg-white dark:bg-dark-930 shadow-sm rounded-lg md:px-10 sm:px-5 px-3 py-9 mb-8">
                            <div id="reservation_box">
                                <h4 class="text-blue-700 dark:text-white text-28 font-bold sm:text-right text-center  flex  sm:justify-start justify-center items-center mb-4">
                                    <i class="bg-blue-700 dark:bg-white ml-1 w-2 h-2 rounded-full sm:flex hidden"></i>
                                    رزرو نوبت
                                </h4>

                                <span class="content-area sm:text-right text-right">
                                    <ul>
                                        <li>
                                            در جدول زیر شما می توانید لیستی از زمان های در دسترس را برای خدمت <?= $data['services']['s_title'] ?>  ببینید.
                                        </li>
                                        <li>
                                            برای رزرو، روی زمان مورد نظر کلیک کنید.
                                        </li>
                                        <li>
                                            با انتخاب زمان، به مدت <?= $data['servicesTiming']['st_complete_time_reservation'] ?> دقیقه وقت دارید که رزرو خود را تکمیل نمایید در غیر اینصورت زمان انتخابی برای شما لغو می شود.
                                        </li>
                                        <li>
                                            برای مشاهده زمان های بیشتر، در ستون هر روز می توانید اسکرول کنید
                                        </li>
                                    </ul>
                                </span>

                                <div class="relative items-center overflow-hidden">
                                    <div id="boxBookingContainer" class="box boxTakingTurnsOnline">
                                        <div class="ContentCenter01 ContentCenterTakingTurnsOnline">
                                            <div class="select-date bg-blue-700 dark:text-white dark:bg-dark-900">
                                                <ul class="select-MonthYear">
                                                    <li>
                                                        <a id="btnPrevMonthMatabSetTime" title="ماه قبل">></a>
                                                    </li>
                                                    <li>
                                                        <span class="text-white ml-1" id="lblMonthMatabSetTime"><?= jdate("F", '', '', '', 'en') ?></span>
                                                        <span class="text-white" id="lblYearMatabSetTime"><?= jdate("Y", '', '', '', 'en') ?></span>
                                                        <span class="text-white" id="lblYearMatabSetTimeCu" style="display: none; visibility: hidden"><?= jdate("m", '', '', '', 'en') ?></span>
                                                    </li>
                                                    <li>
                                                        <a id="btnNextMonthMatabSetTime" title="ماه بعد"><</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="btn-options bg-white dark:bg-dark-930">
                                                <input id="btnGetFirstVisit" class="k-button" type="button" value="اولین وقت خالی" onclick="getFirstVisit()">
                                                <input  id="btnToday" class="k-button" type="button" value="امروز" onclick="getTodayDate()">
                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="ContentFooter01 ContentFooterTakingTurnsOnline">
                                            <div id="TimeSpans" class="show-less"></div>
                                            <div id="LoaderTimes" class="loader">
                                                <div class="loaders">
                                                    <div class="loader">
                                                        <div class="ball-spin-fade-loader">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex mt-4 mb-4 relative items-center overflow-hidden justify-between border rounded-lg  border-gray-210 py-4 pr-6 pl-8">
                                    <div class="flex items-center">
                                    <span class="text-gray-300 dark:text-gray-910 text-base sm:text-xl text-sm font-semibold pl-7 ml-5 border-l border-gray-210">
                                        لطفا توجه کنید:
                                    </span>
                                        <span class="text-gray-300 dark:text-gray-910 text-base font-medium text-lg">
                                        وقت هایی که با برچسب VIP مشخص شده اند وقت های VIP هستند که هزینه های آن بیشتر است
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="description_box" x-ref="descriptionBox" @scroll.window="descriptionBoxTop = $refs.descriptionBox.offsetTop - 150" class="bg-white dark:bg-dark-930 shadow-sm rounded-lg md:px-10 sm:px-5 px-3 py-9 mb-8">
                            <h4 class="text-blue-700 dark:text-white text-28 font-bold sm:text-right text-center  flex  sm:justify-start justify-center items-center mb-4">
                                <i class="bg-blue-700 dark:bg-white ml-1 w-2 h-2 rounded-full sm:flex hidden"></i>
                                توضیحات
                            </h4>
                            <div class="content-area loadmore sm:text-right text-center" :class="{ 'loadmore' : expander }" x-data="{ expander : true }" x-init="() => {
                                        if(document.querySelector('.content-area').offsetHeight >= 700) {
                                            expander = true;
                                        }
                                    }">
                                <?= htmlspecialchars_decode($data['services']['s_description']) ?>

                                <div id="expander" class="flex items-center" x-show="expander">
                                    <button @click="expander = false" class="text-gray-300 flex items-center md:text-22 text-sm font-medium px-4 py-2 border border-gray-210 rounded-lg absolute right-1/2 bottom-0 transform bg-white translate-x-1/2 hover:bg-gray-300 hover:text-white transition duration-200">
                                        ادامه مطلب
                                        <span class="mr-2">
                                            <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.441643 5.89359C-0.147214 6.53437 -0.147214 7.46563 0.441643 8.10641C2.25469 10.0793 6.54403 14 12 14C17.456 14 21.7453 10.0793 23.5584 8.10641C24.1472 7.46563 24.1472 6.53437 23.5584 5.89359C21.7453 3.92067 17.456 0 12 0C6.54403 0 2.25469 3.92067 0.441643 5.89359ZM12 2C7.68339 2 4.04578 5.05757 2.20582 7C4.04578 8.94243 7.68339 12 12 12C16.3166 12 19.9542 8.94243 21.7942 7C19.9542 5.05757 16.3166 2 12 2Z" fill="currentColor" fill-opacity="0.4"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 7C9 8.65685 10.3431 10 12 10C13.6569 10 15 8.65685 15 7C15 5.34315 13.6569 4 12 4C10.3431 4 9 5.34315 9 7ZM11 7C11 7.55228 11.4477 8 12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <?php if(sizeof($data['relatedFaq'])>0){ ?>
                                <div class="mt-7">
                                    <h3 class=" md:text-3xl text-2xl sm:text-right  text-center font-bold text-chambray-700 dark:text-white mb-5">
                                        سوالات متداول
                                    </h3>

                                    <div class="space-y-3">
                                        <?php foreach($data['relatedFaq'] as $faq){ ?>
                                            <div x-data="{ collapse : false }">
                                                <div @click="collapse = !collapse" class="bg-white dark:bg-dark-900 group rounded-lg border dark:border-dark-900 border-gray-210 flex items-center justify-between py-3 md:px-5 px-3 cursor-pointer">
                                                    <div class="flex items-center">
                                                        <div class="font-extrabold flex-shrink-0 pt-2 md:text-35 transition duration-200 text-base  md:ml-5 ml-2 md:w-11 w-8 md:h-11 h-8 rounded-lg  bg-biscay-700 bg-opacity-20 flex items-center justify-center text-cello-500 group-hover:text-white group-hover:bg-blue-700" :class="{'!bg-blue-700 !text-white' : collapse}">
                                                            ?
                                                        </div>
                                                        <h3 :class="{'!text-blue-700 dark:text-blue-450':collapse}" class=" md:text-xl text-15 transition duration-200 group-hover:text-blue-700 dark:text-gray-200 text-gray-800 font-semibold"><?= $faq['question'] ?></h3>
                                                    </div>
                                                    <span class="transition duration-200 transform rotate-90 dark:text-gray-200 text-gray-800 group-hover:text-blue-700  md:scale-100 scale-75" :class="{' !rotate-0 !text-blue-700' : collapse}">
                                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1.5L8 8.5L15 1.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div x-cloak x-show="collapse" x-transition="" class="md:mr-16 sm:mr-5 bg-white dark:bg-dark-900 dark:border-dark-900 rounded-lg border border-gray-210 mt-3 px-8">
                                                    <div class="content-area dark:text-white font-normal text-xl leading-8"><?= $faq['answer'] ?></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div id="sessions-list" x-ref="sessionsBoxTop" @scroll.window="sessionsBoxTop = $refs.sessionsBoxTop.offsetTop - 150" class="bg-white dark:bg-dark-930 shadow-sm rounded-lg md:px-10 sm:px-5 px-3 py-9 mb-8">
                            <h4 class="text-blue-700 dark:text-white text-28 font-bold sm:text-right text-center  flex  sm:justify-start justify-center items-center mb-4">
                                <i class="bg-blue-700 dark:bg-white ml-1 w-2 h-2 rounded-full sm:flex hidden"></i>
                                جلسات ترمیم
                            </h4>

                            <div class="flex mb-4 relative items-center overflow-hidden justify-between border rounded-lg  border-gray-210 py-4 pr-6 pl-8">
                                <div class="flex items-center  ">
                                    <span class="text-gray-300 dark:text-gray-910 text-base font-medium text-lg">
                                        <?php if($data['services']['s_recovery_times_desc']!="" OR $data['services']['s_recovery_times_desc']!=NULL){ ?>
                                            <?= $data['services']['s_recovery_times_desc'] ?>
                                        <?php } else { ?>
                                            توضیحی در مورد جلسات ترمیم این خدمت ارائه نشده است.
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div id="staffs-list" x-ref="staffsBoxTop" @scroll.window="staffsBoxTop = $refs.staffsBoxTop.offsetTop - 150" class="bg-white dark:bg-dark-930 shadow-sm rounded-lg md:px-10 sm:px-5 px-3 py-9 mb-8">
                            <h4 class="text-blue-700 dark:text-white text-28 font-bold sm:text-right text-center  flex  sm:justify-start justify-center items-center mb-4">
                                <i class="bg-blue-700 dark:bg-white ml-1 w-2 h-2 rounded-full sm:flex hidden"></i>
                                پرسنل سالن
                            </h4>

                            <?php if(count($data['servicesTariff'])>0){ ?>
                                <div class="container">
                                    <div class="px-6 ">
                                        <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-10">
                                            <?php foreach ($data['servicesTariff'] as $staff) { ?>
                                                <div class="about_us_mey_team flex flex-col items-center border-2 transition duration-200 hover:shadow-sm border-blue-700 border-opacity-10 rounded-xl pt-8 pb-9 ">
                                                    <div class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                        <div class="bdr-ripple-ani-btn pink two w-24  h-24 mb-5  transform transition duration-200  rounded-full border-4 ring-4 ring-blue-700 ring-opacity-10 border-blue-700 border-opacity-30 overflow-hidden bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-gray-100">
                                                            <a href="services/staffs/<?= $staff['staff_vids_id'] ?>/<?= str_replace(" ", "-", $staff['name']) ?>">
                                                                <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                                                     onerror="this.src='public/images/default_staff.png'"
                                                                     src="public/images/staffs/<?= $staff['image'] ?>"
                                                                     alt="تصویر <?= $staff['name'] ?>">
                                                                <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <h4 class="leading-4">
                                                        <a href="services/staffs/<?= $staff['staff_vids_id'] ?>/<?= str_replace(" ", "-", $staff['name']) ?>" class="text-blue-700 text-19 font-bold dark:text-blue-450 dark:hover:text-white hover:text-gray-900 transition duration-200 text-lg leading-3">
                                                            <?= $staff['name'] ?>
                                                        </a>
                                                    </h4>
                                                    <h6 class="text-gray-300 dark:text-gray-200 text-13 mt-1">
                                                        <?= $staff['expertise']!="" ? $staff['expertise']:"-" ?>
                                                    </h6>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="flex mb-4 relative items-center overflow-hidden justify-between border rounded-lg  border-gray-210 py-4 pr-6 pl-8">
                                    <div class="flex items-center  ">
                                        <span class="text-gray-300 dark:text-gray-910 text-base font-medium text-lg">
                                            در حال حاضر پرسنلی برای این خدمت وجود ندارد.
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div id="portfolio-list" x-ref="portfolioBoxTop" @scroll.window="portfolioBoxTop = $refs.portfolioBoxTop.offsetTop - 150" class="bg-white dark:bg-dark-930 shadow-sm rounded-lg md:px-10 sm:px-5 px-3 py-9 mb-8">
                            <h4 class="text-blue-700 dark:text-white text-28 font-bold sm:text-right text-center  flex  sm:justify-start justify-center items-center mb-4">
                                <i class="bg-blue-700 dark:bg-white ml-1 w-2 h-2 rounded-full sm:flex hidden"></i>
                                نمونه کار انجام شده
                            </h4>

                            <?php if (sizeof($data['portfolio'])>0) { ?>
                                <div class="overflow-hidden justify-between rounded-lg border-gray-210 py-4 pr-6 pl-8">
                                    <div class="carousel-gallery">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                <?php foreach($data['portfolio'] as $portfolio){ ?>
                                                    <div class="swiper-slide">
                                                        <a href="public/images/services/portfolio/<?= $portfolio['i_image'] ?>" title="<?= $portfolio['i_alt'] ?>" data-caption="<?= $portfolio['i_alt'] ?>" data-fancybox="gallery">
                                                            <div class="image" style="background-image: url(public/images/services/portfolio/<?= $portfolio['i_image'] ?>)">
                                                                <div class="overlay">
                                                                    <em class="mdi mdi-magnify-plus"></em>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="flex mb-4 relative items-center overflow-hidden justify-between border rounded-lg border-gray-210 py-4 pr-6 pl-8">
                                    <div class="flex items-center  ">
                                        <span class="text-gray-300 dark:text-gray-910 text-base font-medium text-lg">
                                            نمونه کاری برای خدمت <?= $data['services']['s_title'] ?> ارائه نشده است.
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <section>
                            <div class="container">
                                <div>
                                    <div class="flex items-center justify-between sm:flex-row flex-col mb-20">
                                        <div class="flex items-center self-start sm:mb-0 mb-3">
                                            <svg class="text-dark-550 dark:text-white" width="37" height="34" viewBox="0 0 37 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="10" cy="24" r="10" fill="currentColor"></circle>
                                                <circle cx="30" cy="13" r="7" fill="currentColor" fill-opacity="0.4"></circle>
                                                <circle cx="15" cy="4" r="4" fill="currentColor" fill-opacity="0.7"></circle>
                                            </svg>
                                            <h3 class="text-biscay-700 font-extrabold sm:text-4xl text-2xl mr-2 dark:text-white">خدمات مشابه</h3>
                                        </div>
                                        <div class="self-end">
                                            <a href="services" class="group mt-2 md:mt-0 flex items-center text-dark-550 dark:text-white -mb-1 sm:text-22 text-base transform transition duration-200  hover:text-dark-700">
                                                مشاهده همه خدمات
                                                <svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-3">
                                                    <path fill="currentColor" opacity="0.4" d="M16.5073 5.95326L21.0753 5.54929C22.1004 5.54929 22.9315 6.38853 22.9315 7.42364C22.9315 8.45875 22.1004 9.29799 21.0753 9.29799L16.5073 8.89401C15.7031 8.89401 15.0511 8.23568 15.0511 7.42364C15.0511 6.61024 15.7031 5.95326 16.5073 5.95326"></path>
                                                    <path fill="currentColor" d="M1.16789 6.02753C1.23929 5.95544 1.50601 5.65076 1.75657 5.39776C3.21814 3.81313 7.0344 1.22195 9.03076 0.428959C9.33385 0.302461 10.1003 0.0331419 10.5112 0.0140991C10.9032 0.0140991 11.2777 0.105232 11.6347 0.284778C12.0805 0.536415 12.4362 0.933592 12.6328 1.4015C12.7581 1.72523 12.9548 2.69777 12.9548 2.71545C13.1501 3.77776 13.2565 5.50521 13.2565 7.41493C13.2565 9.23215 13.1501 10.8889 12.9898 11.9689C12.9723 11.9879 12.7756 13.1944 12.5614 13.6079C12.1694 14.3642 11.403 14.8321 10.5826 14.8321H10.5112C9.97641 14.8144 8.85295 14.3451 8.85295 14.3288C6.963 13.5358 3.237 11.0698 1.73905 9.43074C1.73905 9.43074 1.31607 9.00908 1.13287 8.74656C0.84729 8.36843 0.704501 7.90052 0.704501 7.43261C0.704501 6.9103 0.864802 6.42471 1.16789 6.02753"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-12 gap-6">
                                        <?php foreach($data['servicesRandom'] as $service){ ?>
                                            <div class="xl:col-span-4 md:col-span-4 sm:col-span-6 col-span-12 mb-15">
                                                <?php require('app/views/template/default/items/service-item.php'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="mb-4" x-ref="commentBox" @scroll.window="commentBoxTop = $refs.commentBox.offsetTop - 150">
                            <div wire:id="STK7guQF429azWp2OAaY" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;STK7guQF429azWp2OAaY&quot;,&quot;name&quot;:&quot;comments.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[],&quot;path&quot;:&quot;<?= URL ?>services\/<?= $data['services']['s_slug'] ?>&quot;},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;1462081834&quot;:{&quot;id&quot;:&quot;item-<?= $data['attrId']; ?>&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l1387761536-0&quot;:{&quot;id&quot;:&quot;Qj1QejDm7qrpBuQeSEF4&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;a4153779&quot;,&quot;data&quot;:{&quot;readyToLoad&quot;:false,&quot;subject&quot;:[],&quot;pagination&quot;:12,&quot;class&quot;:null,&quot;page&quot;:1,&quot;paginators&quot;:{&quot;page&quot;:1}},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;subject&quot;:{&quot;class&quot;:&quot;App\\Article&quot;,&quot;id&quot;:5950,&quot;relations&quot;:[&quot;rates&quot;,&quot;categories&quot;,&quot;tags&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;7a399f0494295236a1ab61521f4f0aeaee28c4b268fe9e0d902999aec8b244fb&quot;}}" x-data wire:init="loadComments" id="comments-list" class="lg:px-10 px-4 pt-9 pb-6 bg-white dark:bg-dark-930 shadow-sm rounded-lg">
                                <div class="flex items-center sm:flex-row flex-col justify-between mb-6">
                                    <h4 class="text-blue-700 dark:text-white text-27 font-bold sm:mb-0 mb-3 flex items-center ">
                                        <i class="w-2 h-2 bg-blue-700 dark:bg-white rounded-full ml-1 md:flex hidden"></i>
                                        دیدگاه و پرسش
                                    </h4>

                                    <div class="flex flex-wrap  justify-center sm:w-fit-content w-full relative">
                                        <?php if ($data['userId'] != FALSE) { ?>
                                            <button @click="$dispatch('show-send-comment' , { id :  0 })" class="group border justify-center sm:mt-0 mt-4 sm:w-fit-content w-full border-blue-700 bg-blue-700 text-sm dark:hover:bg-transparent dark:hover:text-white dark:hover:border-white text-white px-3 h-12 rounded flex items-center font-semibold transition duration-200 hover:bg-white hover:text-blue-700 hover:shadow-sm">
                                                افزودن دیدگاه و پرسش جدید
                                                <svg class="mr-1" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke="currentColor" opacity="0.5" d="M4.75 12.5C4.75 14.2328 4.84383 15.5741 5.07592 16.6184C5.30612 17.6543 5.66226 18.3514 6.15542 18.8446C6.64859 19.3377 7.34575 19.6939 8.38157 19.9241C9.4259 20.1562 10.7672 20.25 12.5 20.25C14.2328 20.25 15.5741 20.1562 16.6184 19.9241C17.6543 19.6939 18.3514 19.3377 18.8446 18.8446C19.3377 18.3514 19.6939 17.6543 19.9241 16.6184C20.1562 15.5741 20.25 14.2328 20.25 12.5C20.25 10.7672 20.1562 9.4259 19.9241 8.38157C19.6939 7.34575 19.3377 6.64859 18.8446 6.15542C18.3514 5.66226 17.6543 5.30613 16.6184 5.07592C15.5741 4.84383 14.2328 4.75 12.5 4.75C10.7672 4.75 9.4259 4.84383 8.38157 5.07592C7.34575 5.30613 6.64859 5.66226 6.15542 6.15542C5.66226 6.64859 5.30612 7.34575 5.07592 8.38157C4.84383 9.4259 4.75 10.7672 4.75 12.5Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path stroke="currentColor" opacity="0.5" d="M7.01992 17.9803C8.24521 19.2055 9.25998 20.0876 10.1626 20.662C11.0578 21.2316 11.8026 21.4728 12.5 21.4728C13.1974 21.4728 13.9422 21.2316 14.8374 20.662C15.74 20.0876 16.7548 19.2055 17.9801 17.9803C19.2054 16.755 20.0874 15.7402 20.6618 14.8376C21.2314 13.9424 21.4726 13.1976 21.4726 12.5002C21.4726 11.8027 21.2314 11.058 20.6618 10.1627C20.0874 9.26017 19.2054 8.24539 17.9801 7.0201C16.7548 5.79482 15.74 4.91274 14.8374 4.33839C13.9422 3.76874 13.1974 3.5276 12.5 3.5276C11.8026 3.5276 11.0578 3.76874 10.1626 4.33839C9.25998 4.91274 8.24521 5.79482 7.01992 7.0201C5.79463 8.24539 4.91255 9.26017 4.33821 10.1627C3.76856 11.058 3.52741 11.8027 3.52741 12.5002C3.52741 13.1976 3.76856 13.9424 4.33821 14.8376C4.91255 15.7402 5.79463 16.755 7.01992 17.9803Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path stroke="currentColor" d="M9.66699 12.4997H12.5003M15.3337 12.4997H12.5003M12.5003 12.4997V9.66634V15.333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php if ($data['userId'] == FALSE) { ?>
                                    <div class="py-4 md:px-8 px-5 flex justify-between items-center md:flex-row flex-col bg-customOrange-550 rounded-lg mb-6">
                                        <h3 class="text-xl text-white font-medium flex items-center md:mb-0 mb-5">
                                            <span class="ml-4">
                                                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="currentColor" d="M0 17.4167C0 21.191 1.77971 22 10.0833 22C18.387 22 20.1667 21.191 20.1667 17.4167C20.1667 13.6423 18.387 12.8333 10.0833 12.8333C1.77971 12.8333 0 13.6423 0 17.4167Z"/>
                                                    <path fill="currentColor" d="M4.58333 5.5C4.58333 8.53757 7.04577 11 10.0833 11C13.1209 11 15.5833 8.53757 15.5833 5.5C15.5833 2.46243 13.1209 0 10.0833 0C7.04577 0 4.58333 2.46243 4.58333 5.5Z"/>
                                                </svg>
                                            </span>
                                            برای ارسال دیدگاه لازم است وارد شده یا ثبت‌نام کنید
                                        </h3>

                                        <a class="sm:text-xl text-lg text-white font-semibold flex items-center underline hover:text-gray-700 duration-200 transition " href="<?= htmlspecialchars($_GET['url'])=="" ? "login":"login?backURL=".htmlspecialchars($_GET['url']); ?>">
                                            ورود یا ثبت‌نام
                                            <span class="mr-4">
                                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="currentColor" opacity="0.4" d="M12.7975 4.80957L16.4967 4.48242C17.3269 4.48242 18 5.16206 18 6.00032C18 6.83858 17.3269 7.51822 16.4967 7.51822L12.7975 7.19107C12.1463 7.19107 11.6183 6.65793 11.6183 6.00032C11.6183 5.34161 12.1463 4.80957 12.7975 4.80957Z"/>
                                                    <path fill="currentColor" d="M0.37534 4.86984C0.433157 4.81146 0.649155 4.56471 0.852061 4.35983C2.03568 3.07656 5.12619 0.978153 6.7429 0.335965C6.98835 0.233523 7.60907 0.0154213 7.94179 0C8.25924 0 8.56251 0.0738021 8.8516 0.219203C9.21269 0.422985 9.50068 0.74463 9.65995 1.12355C9.76141 1.38572 9.92068 2.17331 9.92068 2.18763C10.0789 3.04792 10.165 4.44685 10.165 5.99339C10.165 7.46503 10.0789 8.80668 9.94904 9.68129C9.93486 9.69671 9.77559 10.6738 9.60214 11.0086C9.28469 11.6211 8.66397 12 7.99961 12H7.94179C7.50871 11.9857 6.5989 11.6057 6.5989 11.5924C5.06837 10.9502 2.05096 8.95319 0.837879 7.62585C0.837879 7.62585 0.495338 7.28438 0.346976 7.07178C0.115706 6.76556 7.15256e-05 6.38663 7.15256e-05 6.00771C7.15256e-05 5.58473 0.129888 5.19148 0.37534 4.86984Z"/>
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div wire:id="item-<?= $data['attrId']; ?>" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;item-<?= $data['attrId']; ?>&quot;,&quot;name&quot;:&quot;user\/sendComment&quot;,&quot;type&quot;:&quot;service&quot;,&quot;itemID&quot;:&quot;<?= $data['attrId']; ?>&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;201045181&quot;:{&quot;id&quot;:&quot;X5EAUqbyw6oZ4xvzwW9P&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;f5aee777&quot;,&quot;data&quot;:{&quot;formId&quot;:&quot;6290e73640e6b&quot;,&quot;subject&quot;:[],&quot;show&quot;:false,&quot;message&quot;:null,&quot;parentId&quot;:0,&quot;loading&quot;:null,&quot;user&quot;:[]},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;subject&quot;:{&quot;class&quot;:&quot;App\\Article&quot;,&quot;id&quot;:5950,&quot;relations&quot;:[&quot;rates&quot;,&quot;categories&quot;,&quot;tags&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;},&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:2,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;2456e05255b5c359932e11b203dd8fb935bbbd205142f6f87cee6eb59e7ce535&quot;}}" x-data="{ show : 0  , message : window.Livewire.find('item-<?= $data['attrId']; ?>').entangle('message').defer }" x-on:show-send-comment.window="if($event.detail.id === 0) show = 1" x-on:hide-send-comment.window="show = 0">
                                        <div class="border border-gray-210 dark:border-opacity-10  rounded-lg mb-8 pt-9 pb-8 md:px-7 px-4" x-show="show" style="display: none">

                                            <div class="border-b border-gray-210 dark:border-opacity-10">
                                                <div class="flex mb-4 space-x-2 space-x-reverse">
                                                    <div wire:id="X5EAUqbyw6oZ4xvzwW9P" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;X5EAUqbyw6oZ4xvzwW9P&quot;,&quot;name&quot;:&quot;layouts.avatar&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;articles\/web-design-commandments&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[],&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;02ca236f&quot;,&quot;data&quot;:{&quot;user&quot;:[],&quot;style&quot;:&quot;&quot;,&quot;size&quot;:&quot;w-14 h-14&quot;,&quot;borderSize&quot;:&quot;border-4&quot;,&quot;statusColor&quot;:&quot;text-gray-700&quot;,&quot;borderColor&quot;:&quot;border-green-700&quot;,&quot;page&quot;:1,&quot;paginators&quot;:{&quot;page&quot;:1}},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:8195,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;981c52c60a80803083eecbb393e0f55721aaf915764e0f120bd849e0300db16f&quot;}}" class="relative hvr-ripple-out" style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                        <div class="w-14 h-14 bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-green-700">
                                                            <a>
                                                                <img class="transition duration-200 transform group-hover:scale-110 w-full h-full" src="<?= $data['infoUser']['c_image'] ?>" alt="تصویر <?= $data['infoUser']['c_display_name'] ?>">
                                                                <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- Livewire Component wire-end:eI12Me5yrwTW3bSHtjke -->
                                                    <div class="flex relative justify-center flex-col space-y-1">
                                                        <h6 class="font-semibold text-xl text-chambray-700 dark:text-white leading-6">
                                                            <a>
                                                                <?= $data['infoUser']['c_display_name'] ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="mt-5" x-show="show" style="display: none">
                                                    <div class="space-y-3">
                                                        <form class="form" id="form-6290e73640e6b" wire:submit.prevent="onSubmit">
                                                            <div @editor-6290e73640e6b-content-update.window="message = $event.detail.content">
                                                                <div>
                                                                    <div class="" x-data="editorData()" x-init="$watch('content' , v => $dispatch(`editor-6290e73640e6b-content-update` , { content : v}) )">
                                                                        <div class="flex justify-end items-end">
                                                                            <span class="mute-text mb-1 font-bold text-gray-500 relative" x-show="window.wordsCount(content) > 0" x-text="window.wordsCount(content) + ' کلمه'" style="display: none;">0 کلمه</span>
                                                                        </div>
                                                                        <div class="unix-editor">
                                                                            <div class="flex justify-between sm:flex-row flex-col editor-section mb-4" id="editor_section_head" ref="buttons-section">
                                                                                <div class="group flex items-center rounded-md bg-opacity-5  py-2 w-fit-content sm:mb-0 mb-4  cursor-pointer relative justify-center bg-gray-500 dark:bg-dark-900 dark:hover:bg-blue-700 hover:bg-blue-550 transition duration-200 px-2" :class="{ 'active': help }" x-on:click="help = !help">
                                                                                    <div class="flex items-center" x-data="{ hover : false }">
                                                                                            <span class="ml-2" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                                                <svg class="w-6 text-biscay-700 dark:text-white group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                    <path opacity="0.4" d="M7.809 2H16.19C19.23 2 21 3.78 21 6.83V17.16C21 20.26 19.23 22 16.19 22H7.809C4.72 22 3 20.26 3 17.16V6.83C3 3.78 4.72 2 7.809 2Z" fill="currentColor"></path>
                                                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.92 6.6499V6.6599C16.351 6.6599 16.7 7.0099 16.7 7.4399C16.7 7.8699 16.351 8.2199 15.92 8.2199H12.931C12.5 8.2199 12.15 7.8699 12.15 7.4289C12.15 6.9999 12.5 6.6499 12.931 6.6499H15.92ZM8.08004 12.7399H15.92C16.351 12.7399 16.7 12.3899 16.7 11.9599C16.7 11.5299 16.351 11.1789 15.92 11.1789H8.08004C7.65004 11.1789 7.30004 11.5299 7.30004 11.9599C7.30004 12.3899 7.65004 12.7399 8.08004 12.7399ZM8.08004 17.3099H15.92C16.22 17.3499 16.51 17.1999 16.67 16.9499C16.83 16.6899 16.83 16.3599 16.67 16.1099C16.51 15.8499 16.22 15.7099 15.92 15.7399H8.08004C7.68104 15.7799 7.38004 16.1199 7.38004 16.5299C7.38004 16.9289 7.68104 17.2699 8.08004 17.3099Z" fill="currentColor"></path>
                                                                                                </svg>
                                                                                            </span>
                                                                                        <span class="font-semibold text-sm text-biscay-700 dark:text-white group-hover:text-white transition duration-200">راهنما</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="bg-blue-700 dark:bg-dark-900 bg-opacity-10 border-b border-solid border-blue-200 hidden" :class="{ 'hidden' : ! help }">
                                                                                <ul class="flex flex-wrap items-start w-full">
                                                                                    <li class="p-3 font-medium text-blue-700 dark:text-blue-450 dark:hover:text-white cursor-pointer hover:underline" id="link" x-on:click="helpsection = 'link'" :class="{ 'active' : helpsection === 'link' }">لینک</li>
                                                                                </ul>
                                                                                <template x-if="helpsection != ''">
                                                                                    <div class="content-area px-4 text-gray-400">
                                                                                        <template x-if="helpsection === 'link'">
                                                                                            <div>
                                                                                                <p>برای وارد کردن لینک می‌توانید  خیلی ساده فقط لینک‌تان را کپی کنید و نیاز به کار خاصی نیست، مابقی رو ما برای‌تان انجام میدهیم و یا از دکمه افزودن لینک در منوی بالا استفاده نمایید</p>
                                                                                            </div>
                                                                                        </template>
                                                                                    </div>
                                                                                </template>
                                                                            </div>
                                                                            <textarea @editor-6290e73640e6b-content-init.window="content = $event.detail.content"
                                                                                      @focus="$dispatch('guide' , { status : 'body' });content = $event.target.value"
                                                                                      @blur="content = $event.target.value" x-model="content"
                                                                                      class="leading-loose w-full p-4 text-base dark:placeholder-gray-920 dark:text-white placeholder-gray-400 dark:border-dark-900 border-gray-100 dark:bg-dark-900   "
                                                                                      x-ref="textarea" id="editor-textarea-6290e73640e6b" data-editor="240" type="text"
                                                                                      rows="10" placeholder="متن مورد نظر خود را وارد کنید ...">
                                                                                </textarea>

                                                                            <div id="markdown-preview" class="hidden bg-gray-210 bg-opacity-80 dark:bg-opacity-30 cursor-not-allowed overflow-y-auto px-4 mb-4 content-area scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 scrollbar-thumb-rounded" style="height: 240px; overflow-y: auto; display: none;"></div>
                                                                        </div>
                                                                        <span class="text-red-500 mt-1 block font-semibold text-sm"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="flex sm:flex-row flex-col justify-between items-center mt-7" x-data="editorPreview('6290e73640e6b')">
                                                                    <div class="flex items-center sm:mb-0 mb-5" x-bind="togglePreview">
                                                                        <span class="text-base text-biscay-700 dark:text-white ml-4 font-semibold">پیش نمایش متن</span>
                                                                        <button type="button" :class="{' !bg-blue-700':preview}" class="w-14 h-7 bg-gray-300 dark:bg-gray-200 bg-opacity-30 transition-all duration-300 rounded-full relative">
                                                                            <i class="w-5 h-5 bg-biscay-700 rounded-full absolute right-1 transition-all duration-300 top-1" :class="{'right-8 !bg-white':preview}"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="flex items-center">
                                                                        <button wire:loading.remove="" wire:target="onSubmit" class="w-24 h-10 bg-blue-700 border-blue-700 border text-white text-sm font-bold ml-4 rounded-md transition duration-200 dark:hover:bg-transparent hover:bg-white hover:text-blue-700">ثبت دیدگاه</button>
                                                                        <button wire:loading.flex="" wire:target="onSubmit" type="button" class="w-24 h-10 bg-flex justify-center items-center bg-blue-700 border-blue-700 border text-white text-sm font-bold ml-4 rounded-md transition duration-200">
                                                                            <svg class="w-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">

                                                                                <circle class="stroke-current text-white text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300">

                                                                                </circle>
                                                                                <circle class="stroke-current text-white" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                                                                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                                                                                    <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                                                                                    <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                                                                                </circle>
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button" @click="show = 0" class="w-24 h-10 border border-gray-300 text-gray-300 text-sm font-bold rounded-md transition duration-200 hover:bg-gray-300 hover:text-white">انصراف</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>

                                <div>
                                    <div class="-mb-6">
                                        <div class="space-y-10 space-y-reverse">
                                            <div wire:target="gotoPage,previousPage,nextPage" wire:loading.flex class="bg-lightBlue-100 text-lightBlue-600 border border-solid border-lightBlue-300 rounded p-4 text-tiny flex items-center space-x-2 space-x-reverse mb-3">
                                                <svg class="w-6 h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">

                                                    <circle class="stroke-current text-gray-500 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300"></circle>
                                                    <circle class="stroke-current text-gray-500" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                                                        <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                                                        <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                                                    </circle>
                                                </svg>
                                                <p>در حال دریافت نظرات از سرور، لطفا منتظر بمانید</p>
                                            </div>
                                            <?php if($data['comment']['count']>0){ ?>
                                                <?php foreach ($data['comment']['comments'] as $comment) { ?>
                                                    <div wire:target="gotoPage,previousPage,nextPage" wire:loading.remove>
                                                        <div wire:id="Jp5vmE0tFWJOgNJM1qkZ" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;Jp5vmE0tFWJOgNJM1qkZ&quot;,&quot;name&quot;:&quot;comments.single&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[&quot;hide-answer-box&quot;]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;94810&quot;:{&quot;id&quot;:&quot;IqB4kl1fr6DHD1vye4PL&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;352569411&quot;:{&quot;id&quot;:&quot;comment-<?= $data['attrId']; ?>&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;1280451358&quot;:{&quot;id&quot;:&quot;gIDz97WpH7VvfvYJs5fE&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l1956554873-1&quot;:{&quot;id&quot;:&quot;508efbPmuyf9Ojnqprkv&quot;,&quot;tag&quot;:&quot;button&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;8127ffc2&quot;,&quot;data&quot;:{&quot;comment&quot;:[],&quot;subject&quot;:[],&quot;answerBox&quot;:true,&quot;class&quot;:null,&quot;childComments&quot;:[],&quot;moreComments&quot;:false},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;comment&quot;:{&quot;class&quot;:&quot;App\\Comment&quot;,&quot;id&quot;:<?= $comment['comment']['cm_id'] ?>,&quot;relations&quot;:[&quot;comments&quot;,&quot;comments.user&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;},&quot;subject&quot;:{&quot;class&quot;:&quot;App\\Article&quot;,&quot;id&quot;:878,&quot;relations&quot;:[&quot;rates&quot;,&quot;categories&quot;,&quot;tags&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;}},&quot;modelCollections&quot;:{&quot;childComments&quot;:{&quot;class&quot;:&quot;App\\Comment&quot;,&quot;id&quot;:[9481],&quot;relations&quot;:[&quot;user&quot;,&quot;comment&quot;,&quot;comment.user&quot;],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;64dac198601663ef6dbf583900bcffe7cc3f4f912f11faab9fdb02e2fbd617b8&quot;}}">
                                                            <div class="sm:p-6 p-3 border border-gray-210 dark:border-opacity-0 rounded-lg mb-5 bg-white dark:bg-dark-900 ">
                                                                <div class="flex sm:flex-row flex-col justify-between border-b border-gray-210 dark:border-opacity-20">
                                                                    <div class="flex ">
                                                                        <i class="absolute"></i>

                                                                        <div class="ml-2 pb-5">
                                                                            <div wire:id="gIDz97WpH7VvfvYJs5fE" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;gIDz97WpH7VvfvYJs5fE&quot;,&quot;name&quot;:&quot;layouts.avatar&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;204b2df2&quot;,&quot;data&quot;:{&quot;user&quot;:[],&quot;style&quot;:&quot;&quot;,&quot;size&quot;:&quot;sm:w-14 sm:h-14 w-12 h-12&quot;,&quot;borderSize&quot;:&quot;border-4&quot;,&quot;statusColor&quot;:&quot;text-gray-700&quot;,&quot;borderColor&quot;:&quot;border-gray-80&quot;,&quot;page&quot;:1,&quot;paginators&quot;:{&quot;page&quot;:1}},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:2526,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;ee38dd717bfa201145d654cc02697159aa5e584de7febfe099075aba7560a7ff&quot;}}" class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                                <div class="sm:w-14 sm:h-14 w-12 h-12 bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-gray-80">
                                                                                    <a>
                                                                                        <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                                                                             onerror="this.src='public/images/user-default-image.jpg'" src="<?= $comment['comment']['c_image'] ?>"
                                                                                             alt="تصویر <?= $comment['comment']['cm_reply_admin_id'] ==1 ? "مدیر سایت": $comment['comment']['c_display_name'] ?>">
                                                                                        <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="flex relative justify-center flex-col pb-5 space-y-1">
                                                                            <h6 class="font-semibold sm:text-xl text-base text-chambray-700 dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200 ">
                                                                                <a>
                                                                                    <?= $comment['comment']['cm_reply_admin_id'] ==1 ? "مدیر سایت": $comment['comment']['c_display_name'] ?>
                                                                                </a>
                                                                            </h6>
                                                                            <span class="text-gray-360 dark:text-gray-200 text-sm"><?= Model::day_of_date($comment['comment']['cm_date'], '/', $comment['comment']['cm_time'], ':'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex sm:items-start sm:justify-start justify-end sm:mb-0 mb-2">
                                                                        <a x-data="" href="services/<?= $data['services']['s_slug'] ?>#answer-<?= $comment['comment']['cm_id'] ?>" @click="$dispatch('show-send-comment' , { id :  <?= $comment['comment']['cm_id'] ?>})" class="flex items-center ml-2 text-sm text-gray-450 font-medium bg-gray-500 dark:hover:bg-dark-400 dark:bg-dark-930 bg-opacity-10 h-6 px-2 dark:text-gray-920 rounded hover:bg-opacity-100 hover:text-white transition duration-200">
                                                                            <svg class="ml-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke="currentColor" d="M5.25065 8.23266L2.33398 5.29242L5.25065 2.35217" stroke-width="0.857886" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                <path stroke="currentColor" d="M11.6673 11.7609V7.64455C11.6673 7.02071 11.4215 6.42242 10.9839 5.9813C10.5463 5.54018 9.95282 5.29236 9.33398 5.29236H2.33398" stroke-width="0.857886" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            پاسخ
                                                                        </a>

                                                                        <button wire:id="508efbPmuyf9Ojnqprkv" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;508efbPmuyf9Ojnqprkv&quot;,&quot;name&quot;:&quot;comments.like&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[&quot;like-update&quot;]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;f6f8a56d&quot;,&quot;data&quot;:{&quot;comment&quot;:[]},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;comment&quot;:{&quot;class&quot;:&quot;App\\Comment&quot;,&quot;id&quot;:<?= $comment['comment']['cm_id'] ?>,&quot;relations&quot;:[&quot;comments&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;7de58d78620a8a01de60e3525fc663e81586111b919ff6f71086c0cbb8ee9c45&quot;}}" class="flex items-center text-sm text-red-450 dark:hover:bg-dark-930 dark:text-red-650 font-medium bg-red-700 dark:bg-opacity-20 bg-opacity-10 h-6 px-2 rounded hover:bg-opacity-100 hover:text-white transition duration-200 add-like <?= $data['userId']!=FALSE ? "":" login_req";  ?>" data-id="<?= $comment['comment']['cm_id'] ?>" data-type="service" data-part="comment" data-view="text" wire:click="like">
                                                                            <svg id="likeIcon-<?= $comment['comment']['cm_id'] ?>" class="ml-1 likeSvg" width="15" height="13"  fill="<?= $comment['comment']['liked']!=NULL ? "currentColor":" none";  ?>" viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke="currentColor" d="M4.75 0.624878C5.80649 0.624878 6.77021 1.15065 7.5 1.74964C8.22979 1.15065 9.19351 0.624878 10.25 0.624878C12.5282 0.624878 14.375 2.31858 14.375 4.40774C14.375 8.62007 9.57964 11.0733 7.99879 11.7676C7.68036 11.9075 7.31964 11.9075 7.00121 11.7676C5.42036 11.0733 0.625 8.61997 0.625 4.40764C0.625 2.31848 2.47183 0.624878 4.75 0.624878Z" stroke-width="0.771644" />
                                                                            </svg>
                                                                            <span class="likeCounter-<?= $comment['comment']['cm_id'] ?>"><?= $comment['comment']['likeCount'] ?></span>
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div id="commentText-<?= $comment['comment']['cm_id'] ?>" class="content-area comment-area"><?= $comment['comment']['cm_text'] ?></div>
                                                                <script>
                                                                    var converter = new showdown.Converter();
                                                                    var text = document.getElementById("commentText-<?= $comment['comment']['cm_id'] ?>").innerHTML;
                                                                    var html = converter.makeHtml(text);
                                                                    document.getElementById("commentText-<?= $comment['comment']['cm_id'] ?>").innerHTML = html;
                                                                </script>
                                                                <style>
                                                                    div#commentText > p > img{width: 100%;}
                                                                </style>
                                                            </div>

                                                            <?php if($comment['reply'] != NULL){ ?>
                                                                <div class="space-y-2 comment-answer-section">
                                                                    <?php $counter=1; ?>
                                                                    <?php $sizeReply = sizeof($comment['reply']); ?>
                                                                    <?php foreach($comment['reply'] as $reply){ ?>
                                                                        <div wire:id="IqB4kl1fr6DHD1vye4PL" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;IqB4kl1fr6DHD1vye4PL&quot;,&quot;name&quot;:&quot;comments.single&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[&quot;hide-answer-box&quot;]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;1984797359&quot;:{&quot;id&quot;:&quot;D23XWR0ch5bOBQJAkyd8&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l1956554873-1&quot;:{&quot;id&quot;:&quot;clkqFDNVtpSMujh2IpOZ&quot;,&quot;tag&quot;:&quot;button&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;0794948d&quot;,&quot;data&quot;:{&quot;comment&quot;:[],&quot;subject&quot;:null,&quot;answerBox&quot;:true,&quot;class&quot;:&quot;last-item&quot;,&quot;childComments&quot;:[],&quot;moreComments&quot;:false},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;comment&quot;:{&quot;class&quot;:&quot;App\\Comment&quot;,&quot;id&quot;:9481,&quot;relations&quot;:[&quot;user&quot;,&quot;comment&quot;,&quot;comment.user&quot;],&quot;connection&quot;:&quot;mysql&quot;}},&quot;modelCollections&quot;:{&quot;childComments&quot;:{&quot;class&quot;:null,&quot;id&quot;:[],&quot;relations&quot;:[],&quot;connection&quot;:null}}},&quot;checksum&quot;:&quot;79f8ab44ca6bcf5f42c570a640cf6a01cccd94e953cfcc74902f71775f1d1216&quot;}}">
                                                                            <div class="sm:p-6 p-3 border border-gray-210 dark:border-opacity-0 rounded-lg mb-5 sm:mr-14 bg-gray-210 bg-opacity-20 dark:bg-dark-950 dark:bg-opacity-50 sub-item <?= $counter==$sizeReply ? 'last-item':'' ?>">
                                                                                <div class="flex sm:flex-row flex-col justify-between border-b border-gray-210 dark:border-opacity-20">
                                                                                    <div class="flex ">
                                                                                        <i class="absolute"></i>
                                                                                        <div class="ml-2 pb-5">
                                                                                            <div wire:id="D23XWR0ch5bOBQJAkyd8" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;D23XWR0ch5bOBQJAkyd8&quot;,&quot;name&quot;:&quot;layouts.avatar&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;cc5f1e77&quot;,&quot;data&quot;:{&quot;user&quot;:[],&quot;style&quot;:&quot;&quot;,&quot;size&quot;:&quot;sm:w-14 sm:h-14 w-12 h-12&quot;,&quot;borderSize&quot;:&quot;border-4&quot;,&quot;statusColor&quot;:&quot;text-gray-700&quot;,&quot;borderColor&quot;:&quot;border-gray-80&quot;,&quot;page&quot;:1,&quot;paginators&quot;:{&quot;page&quot;:1}},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:2,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;af0f0cb99c29f5fe3ea5134f816182e08d656da7d58b669b016d2f6b7eb24cf6&quot;}}" class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                                                <div class="sm:w-14 sm:h-14 w-12 h-12 bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-gray-80">
                                                                                                    <a>
                                                                                                        <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                                                                                             onerror="this.src='public/images/user-default-image.jpg'" src="<?= $reply['c_image'] ?>"
                                                                                                             alt="تصویر <?= $reply['cm_reply_admin_id'] ==1 ? "مدیر سایت": $reply['c_display_name'] ?>">
                                                                                                        <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="flex relative justify-center flex-col pb-5 space-y-1">
                                                                                            <h6 class="font-semibold sm:text-xl text-base text-chambray-700 dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200 ">
                                                                                                <a>
                                                                                                    <?= $reply['cm_reply_admin_id'] ==1 ? "مدیر سایت": $reply['c_display_name'] ?>
                                                                                                </a>
                                                                                            </h6>
                                                                                            <span class="text-gray-360 dark:text-gray-200 text-sm"><?= Model::day_of_date($reply['cm_date'], '/', $reply['cm_time'], ':'); ?></span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="flex sm:items-start sm:justify-start justify-end sm:mb-0 mb-2">
                                                                                        <a x-data href="services/<?= $data['services']['s_slug'] ?>#answer- <?= $reply['cm_answer_id'] ?>" @click="$dispatch('show-send-comment' , { id :  <?= $reply['cm_answer_id'] ?>})" class="flex items-center ml-2 text-sm text-gray-450 font-medium bg-gray-500 dark:hover:bg-dark-400 dark:bg-dark-930 bg-opacity-10 h-6 px-2 dark:text-gray-920 rounded hover:bg-opacity-100 hover:text-white transition duration-200" href="#">
                                                                                            <svg class="ml-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path stroke="currentColor" d="M5.25065 8.23266L2.33398 5.29242L5.25065 2.35217" stroke-width="0.857886" stroke-linecap="round" stroke-linejoin="round" />
                                                                                                <path stroke="currentColor" d="M11.6673 11.7609V7.64455C11.6673 7.02071 11.4215 6.42242 10.9839 5.9813C10.5463 5.54018 9.95282 5.29236 9.33398 5.29236H2.33398" stroke-width="0.857886" stroke-linecap="round" stroke-linejoin="round" />
                                                                                            </svg>
                                                                                            پاسخ
                                                                                        </a>

                                                                                        <button wire:id="clkqFDNVtpSMujh2IpOZ" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;clkqFDNVtpSMujh2IpOZ&quot;,&quot;name&quot;:&quot;comments.like&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[&quot;like-update&quot;]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;e021f565&quot;,&quot;data&quot;:{&quot;comment&quot;:[]},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;comment&quot;:{&quot;class&quot;:&quot;App\\Comment&quot;,&quot;id&quot;:9481,&quot;relations&quot;:[&quot;user&quot;,&quot;comment&quot;],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;08f20be45131959c535db6445c7a09259f9cdfcef40396a9323e8f91d45f06c2&quot;}}" class="flex items-center text-sm text-red-450 dark:hover:bg-dark-930 dark:text-red-650 font-medium bg-red-700 dark:bg-opacity-20 bg-opacity-10 h-6 px-2 rounded hover:bg-opacity-100 hover:text-white transition duration-200 add-like <?= $data['userId']!=FALSE ? "":" login_req";  ?>" data-id="<?= $reply['cm_id'] ?>" data-type="service" data-part="comment" data-view="text" wire:click="like">
                                                                                            <svg id="likeIcon-<?= $reply['cm_id'] ?>" class="ml-1 likeSvg" width="15" height="13"  fill="<?= $reply['liked']!=NULL ? "currentColor":" none";  ?>" viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path stroke="currentColor" d="M4.75 0.624878C5.80649 0.624878 6.77021 1.15065 7.5 1.74964C8.22979 1.15065 9.19351 0.624878 10.25 0.624878C12.5282 0.624878 14.375 2.31858 14.375 4.40774C14.375 8.62007 9.57964 11.0733 7.99879 11.7676C7.68036 11.9075 7.31964 11.9075 7.00121 11.7676C5.42036 11.0733 0.625 8.61997 0.625 4.40764C0.625 2.31848 2.47183 0.624878 4.75 0.624878Z" stroke-width="0.771644" />
                                                                                            </svg>
                                                                                            <span class="likeCounter-<?= $reply['cm_id'] ?>"><?= $reply['likeCount'] ?></span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>

                                                                                <div id="commentText-<?= $reply['cm_id'] ?>" class="content-area comment-area"><?= $reply['cm_text'] ?></div>
                                                                                <script>
                                                                                    var converter = new showdown.Converter();
                                                                                    var text = document.getElementById("commentText-<?= $reply['cm_id'] ?>").innerHTML;
                                                                                    var html = converter.makeHtml(text);
                                                                                    document.getElementById("commentText-<?= $reply['cm_id'] ?>").innerHTML = html;
                                                                                </script>
                                                                                <style>
                                                                                    div#commentText > p > img{width: 100%;}
                                                                                </style>
                                                                            </div>
                                                                        </div>
                                                                        <?php $counter++; ?>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>

                                                            <div class="mr-8" id="answer-<?= $comment['comment']['cm_id'] ?>">
                                                                <div wire:id="comment-<?= $data['attrId']; ?>" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;comment-<?= $data['attrId']; ?>&quot;,&quot;name&quot;:&quot;user\/sendComment&quot;,&quot;type&quot;:&quot;service&quot;,&quot;itemID&quot;:&quot;<?= $data['attrId']; ?>&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;630157211&quot;:{&quot;id&quot;:&quot;w501jzyu4Bj7KOW283O9<?= $comment['comment']['cm_id'] ?>&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;6bcad290&quot;,&quot;data&quot;:{&quot;formId&quot;:&quot;6293dd217bc94<?= $comment['comment']['cm_id'] ?>&quot;,&quot;subject&quot;:[],&quot;show&quot;:false,&quot;message&quot;:null,&quot;parentId&quot;:<?= $comment['comment']['cm_id'] ?>,&quot;loading&quot;:null,&quot;user&quot;:[]},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;subject&quot;:{&quot;class&quot;:&quot;App\\Article&quot;,&quot;id&quot;:878,&quot;relations&quot;:[&quot;rates&quot;,&quot;categories&quot;,&quot;tags&quot;,&quot;user&quot;],&quot;connection&quot;:&quot;mysql&quot;},&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:2,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;aec71f7b3c828612dd18deb6838b63b9e3caa5ebbd50aedac4ed7be60f6b705d&quot;}}" x-data="{ show : 0  , message : window.Livewire.find('comment-<?= $data['attrId']; ?>').entangle('message').defer }" x-on:show-send-comment.window="if($event.detail.id === <?= $comment['comment']['cm_id'] ?>) show = 1" x-on:hide-send-comment.window="show = 0">
                                                                    <div class="border border-gray-210 dark:border-opacity-10 bg-gray-210 bg-opacity-20 dark:bg-dark-950 dark:bg-opacity-50 rounded-lg mb-8 pt-9 pb-8 md:px-7 px-4" x-show="show" x-cloak>
                                                                        <div class="border-b border-gray-210 dark:border-opacity-10">
                                                                            <div class="flex mb-4 space-x-2 space-x-reverse">
                                                                                <div wire:id="w501jzyu4Bj7KOW283O9<?= $comment['comment']['cm_id'] ?>" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;w501jzyu4Bj7KOW283O9<?= $comment['comment']['cm_id'] ?>&quot;,&quot;name&quot;:&quot;layouts.avatar&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;services\/<?= $data['services']['s_slug'] ?>&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;02ca236f&quot;,&quot;data&quot;:{&quot;user&quot;:[],&quot;style&quot;:&quot;&quot;,&quot;size&quot;:&quot;w-14 h-14&quot;,&quot;borderSize&quot;:&quot;border-4&quot;,&quot;statusColor&quot;:&quot;text-gray-700&quot;,&quot;borderColor&quot;:&quot;border-green-700&quot;,&quot;page&quot;:1,&quot;paginators&quot;:{&quot;page&quot;:1}},&quot;dataMeta&quot;:{&quot;models&quot;:{&quot;user&quot;:{&quot;class&quot;:&quot;App\\User&quot;,&quot;id&quot;:8195,&quot;relations&quot;:[],&quot;connection&quot;:&quot;mysql&quot;}}},&quot;checksum&quot;:&quot;90facc6eb6993b1f01a564f258a8f7818ce709a179761e16c93000544dfa2458&quot;}}" class="relative hvr-ripple-out" style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                                    <div class="w-14 h-14 bg-gray-300 group relative rounded-full overflow-hidden border-4 border-solid border-green-700">
                                                                                        <a>
                                                                                            <img class="transition duration-200 transform group-hover:scale-110 w-full h-full" src="<?= $data['infoUser']['c_image'] ?>" alt="تصویر <?= $data['infoUser']['c_display_name'] ?>">
                                                                                            <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="flex relative justify-center flex-col space-y-1">
                                                                                    <h6 class="font-semibold text-xl text-chambray-700 dark:text-white leading-6">
                                                                                        <a>
                                                                                            <?= $data['infoUser']['c_display_name'] ?>
                                                                                        </a>
                                                                                    </h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="mt-5" x-show="show" x-cloak>
                                                                                <div class="space-y-3">
                                                                                    <form class="form" id="form-6293dd217bc94<?= $comment['comment']['cm_id'] ?>" wire:submit.prevent="onSubmit">
                                                                                        <div @editor-6293dd217bc94<?= $comment['comment']['cm_id'] ?>-content-update.window="message = $event.detail.content">
                                                                                            <div>
                                                                                                <div class="" x-data="editorData()"
                                                                                                     x-init="$watch('content' , v => $dispatch(`editor-6293dd217bc94<?= $comment['comment']['cm_id'] ?>-content-update` , { content : v}) )">
                                                                                                    <div class="flex justify-end items-end">
                                                                                                        <span class="mute-text mb-1 font-bold text-gray-500 relative" x-show="window.wordsCount(content) > 0" x-text="window.wordsCount(content) + ' کلمه'">۰/۱۴۰‌</span>
                                                                                                    </div>
                                                                                                    <div class="unix-editor">
                                                                                                        <div class="flex justify-between sm:flex-row flex-col editor-section mb-4" id="editor_section_head"
                                                                                                             ref="buttons-section">
                                                                                                            <div class="group flex items-center rounded-md bg-opacity-5  py-2 w-fit-content sm:mb-0 mb-4  cursor-pointer relative justify-center bg-gray-500 dark:bg-dark-900 dark:hover:bg-blue-700 hover:bg-blue-550 transition duration-200 px-2"
                                                                                                                 :class="{ 'active': help }" x-on:click="help = !help" x-cloak>
                                                                                                                <div class="flex items-center" x-data="{ hover : false }">
                                                                                                                        <span class="ml-2" @mouseenter="hover = true" @mouseleave="hover = false">
                                                                                                                            <svg class="w-6 text-biscay-700 dark:text-white group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                <path opacity="0.4" d="M7.809 2H16.19C19.23 2 21 3.78 21 6.83V17.16C21 20.26 19.23 22 16.19 22H7.809C4.72 22 3 20.26 3 17.16V6.83C3 3.78 4.72 2 7.809 2Z" fill="currentColor" />
                                                                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.92 6.6499V6.6599C16.351 6.6599 16.7 7.0099 16.7 7.4399C16.7 7.8699 16.351 8.2199 15.92 8.2199H12.931C12.5 8.2199 12.15 7.8699 12.15 7.4289C12.15 6.9999 12.5 6.6499 12.931 6.6499H15.92ZM8.08004 12.7399H15.92C16.351 12.7399 16.7 12.3899 16.7 11.9599C16.7 11.5299 16.351 11.1789 15.92 11.1789H8.08004C7.65004 11.1789 7.30004 11.5299 7.30004 11.9599C7.30004 12.3899 7.65004 12.7399 8.08004 12.7399ZM8.08004 17.3099H15.92C16.22 17.3499 16.51 17.1999 16.67 16.9499C16.83 16.6899 16.83 16.3599 16.67 16.1099C16.51 15.8499 16.22 15.7099 15.92 15.7399H8.08004C7.68104 15.7799 7.38004 16.1199 7.38004 16.5299C7.38004 16.9289 7.68104 17.2699 8.08004 17.3099Z" fill="currentColor" />
                                                                                                                            </svg>
                                                                                                                        </span>
                                                                                                                    <span class="font-semibold text-sm text-biscay-700 dark:text-white group-hover:text-white transition duration-200">راهنما</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="bg-blue-700 dark:bg-dark-900 bg-opacity-10 border-b border-solid border-blue-200"
                                                                                                             :class="{ 'hidden' : ! help }" x-cloak>
                                                                                                            <ul class="flex flex-wrap items-start w-full">
                                                                                                                <li class="p-3 font-medium text-blue-700 dark:text-blue-450 dark:hover:text-white cursor-pointer hover:underline" id="link" x-on:click="helpsection = 'link'" :class="{ 'active' : helpsection === 'link' }">لینک</li>
                                                                                                            </ul>
                                                                                                            <template x-if="helpsection != ''">
                                                                                                                <div class="content-area px-4 text-gray-400">
                                                                                                                    <template x-if="helpsection === 'link'">
                                                                                                                        <div>
                                                                                                                            <p>برای وارد کردن لینک می‌توانید  خیلی ساده فقط لینک‌تان را کپی کنید و نیاز به کار خاصی نیست، مابقی رو ما برای‌تان انجام میدهیم و یا از دکمه افزودن لینک در منوی بالا استفاده نمایید</p>
                                                                                                                        </div>
                                                                                                                    </template>
                                                                                                                </div>
                                                                                                            </template>
                                                                                                        </div>
                                                                                                        <textarea @editor-6293dd217bc94<?= $comment['comment']['cm_id'] ?>-content-init.window="content = $event.detail.content"
                                                                                                                  @focus="$dispatch('guide' , { status : 'body' });content = $event.target.value"
                                                                                                                  @blur="content = $event.target.value" x-model="content"
                                                                                                                  class="leading-loose w-full p-4 text-base dark:placeholder-gray-920 dark:text-white placeholder-gray-400 dark:border-dark-900 border-gray-100 dark:bg-dark-900   "
                                                                                                                  x-ref="textarea" id="editor-textarea-6293dd217bc94<?= $comment['comment']['cm_id'] ?>" data-editor="240" type="text"
                                                                                                                  rows="10" placeholder="متن مورد نظر خود را وارد کنید ..."></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="flex sm:flex-row flex-col justify-between items-center mt-7" x-data="editorPreview('6293dd217bc94<?= $comment['comment']['cm_id'] ?>')">
                                                                                                <div class="flex items-center sm:mb-0 mb-5" x-bind="togglePreview">
                                                                                                    <span class="text-base text-biscay-700 dark:text-white ml-4 font-semibold">پیش نمایش متن</span>
                                                                                                    <button type="button" :class="{' !bg-blue-700':preview}" class="w-14 h-7 bg-gray-300 dark:bg-gray-200 bg-opacity-30 transition-all duration-300 rounded-full relative">
                                                                                                        <i class="w-5 h-5 bg-biscay-700 rounded-full absolute right-1 transition-all duration-300 top-1" :class="{'right-8 !bg-white':preview}"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="flex items-center">
                                                                                                    <button wire:loading.remove wire:target="onSubmit" class="w-24 h-10 bg-blue-700 border-blue-700 border text-white text-sm font-bold ml-4 rounded-md transition duration-200 dark:hover:bg-transparent hover:bg-white hover:text-blue-700">ثبت دیدگاه</button>
                                                                                                    <button wire:loading.flex wire:target="onSubmit" type="button" class="w-24 h-10 bg-flex justify-center items-center bg-blue-700 border-blue-700 border text-white text-sm font-bold ml-4 rounded-md transition duration-200">
                                                                                                        <svg class="w-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">

                                                                                                            <circle class="stroke-current text-white text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300">

                                                                                                            </circle>
                                                                                                            <circle class="stroke-current text-white" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                                                                                                                <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                                                                                                                <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                                                                                                                <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                                                                                                            </circle>
                                                                                                        </svg>                                            </button>
                                                                                                    <button type="button" @click="show = 0" class="w-24 h-10 border border-gray-300 text-gray-300 text-sm font-bold rounded-md transition duration-200 hover:bg-gray-300 hover:text-white">انصراف</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="flex items-center flex-col pt-12">
                                                    <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27 0C49.2345 0 54 4.00008 54 24C54 37.0001 51.7506 45 41.6256 45C36.2147 45 34.6052 47.5703 33.1064 49.9638C31.8006 52.0491 30.5789 54.0001 27.0006 54C23.4225 53.9999 22.2007 52.049 20.8949 49.9638C19.3961 47.5703 17.7865 45 12.3756 45C2.25055 45 0 36.7442 0 24C0 4.23601 4.7655 0 27 0ZM49.5 24C49.5 13.878 48.1565 9.89799 45.8623 7.87579C44.6944 6.84628 42.8722 5.95738 39.7488 5.35647C36.6026 4.75117 32.4778 4.5 27 4.5C21.5316 4.5 17.4124 4.76523 14.2732 5.38537C11.1583 6.00072 9.32897 6.90538 8.1517 7.95184C5.83648 10.0098 4.5 14.0158 4.5 24C4.5 30.3241 5.09867 34.632 6.41592 37.2668C7.01586 38.4668 7.70279 39.1862 8.47207 39.6441C9.25959 40.1128 10.4585 40.5 12.3756 40.5C15.6095 40.5 18.2372 41.232 20.3756 42.6808C22.433 44.0748 23.6339 45.8794 24.4009 47.0862L24.7092 47.5722C25.3722 48.6189 25.5918 48.9656 25.9024 49.2444L25.9146 49.256C25.9799 49.3197 26.1644 49.5 27.0007 49.5C27.8371 49.5 28.0216 49.3197 28.0867 49.2561L28.0989 49.2445C28.4096 48.9657 28.6291 48.6191 29.2923 47.572L29.6003 47.0864C30.3672 45.8797 31.5681 44.0749 33.6255 42.6809C35.7638 41.232 38.3916 40.5 41.6256 40.5C43.5662 40.5 44.7756 40.119 45.564 39.6594C46.3265 39.2148 47.0012 38.5197 47.5916 37.3489C48.8981 34.7581 49.5 30.4669 49.5 24Z" fill="#E0E3EA"></path>
                                                        <path d="M31.5 15.75C30.2573 15.75 29.25 16.7573 29.25 18C29.25 19.2427 30.2573 20.25 31.5 20.25H38.25C39.4927 20.25 40.5 19.2427 40.5 18C40.5 16.7573 39.4927 15.75 38.25 15.75H31.5Z" fill="#A2ACBF"></path>
                                                        <path d="M15.75 24.75C14.5073 24.75 13.5 25.7573 13.5 27C13.5 28.2427 14.5073 29.25 15.75 29.25H38.25C39.4927 29.25 40.5 28.2427 40.5 27C40.5 25.7573 39.4927 24.75 38.25 24.75H15.75Z" fill="#A2ACBF"></path>
                                                    </svg>
                                                    <h6 class="mt-2 text-xl font-semibold text-gray-300">
                                                        هنوز دیدگاهی ثبت&zwnj;نشده
                                                    </h6>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="mt-16 flex items-center justify-center"></div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="xl:col-span-6 lg:col-span-7 lg:order-last order-first">
                        <div class="bg-white dark:bg-dark-930 py-4 px-5 justify-between flex rounded-lg shadow-sm mb-4 overflow-hidden relative">
                            <div class="flex items-center">
                                <i class="w-24 h-24 bg-blue-700 rounded-full bg-opacity-5 absolute top-1/2 transform -translate-y-1/2 -right-6">
                                    <i class="w-14 h-14 bg-blue-700 rounded-full bg-opacity-5 absolute top-1/2 transform -translate-y-1/2 right-1/2 translate-x-1/2">
                                        <i class="w-8 h-8 bg-blue-700 rounded-full bg-opacity-5 absolute top-1/2 transform -translate-y-1/2 right-1/2 translate-x-1/2"></i>
                                    </i>
                                </i>

                                <i class="flex w-2 h-2 bg-blue-700 dark:bg-white ml-2 rounded-full"></i>
                                <span class="text-sm font-bold dark:text-white text-blue-700">
                                    امتیاز خدمت
                                </span>
                            </div>
                            <div class="space-y-2 flex flex-col items-center">
                                <div class="space-y-2 flex flex-col items-center">
                                    <div class="relative" x-data="{ title : 0 }" x-cloak>
                                        <span data-id="<?= $data['attrId']; ?>" data-type="service" id="ratingCount" class="text-yellow-400 absolute z-40 overflow-hidden whitespace-nowrap flex top-0" style="width: <?= $data['scoreItem']['avg']*20 ?>% ">
                                            <span data-rate="1" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer" :class="{ '!text-yellow-300' : title >= 1 }" wire:click="setRate(1)" @mouseenter="title = 1" @mouseleave="title = 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </span>
                                            <span data-rate="2" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer" :class="{ '!text-yellow-300' : title >= 2 }" wire:click="setRate(2)" @mouseenter="title = 2" @mouseleave="title = 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </span>
                                            <span data-rate="3" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer" :class="{ '!text-yellow-300' : title >= 3 }" wire:click="setRate(3)" @mouseenter="title = 3" @mouseleave="title = 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </span>
                                            <span data-rate="4" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer" :class="{ '!text-yellow-300' : title >= 4 }" wire:click="setRate(4)" @mouseenter="title = 4" @mouseleave="title = 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </span>
                                            <span data-rate="5" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer" :class="{ '!text-yellow-300' : title >= 5 }" wire:click="setRate(5)" @mouseenter="title = 5" @mouseleave="title = 0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </span>
                                       </span>

                                        <span data-id="<?= $data['attrId']; ?>" data-type="service" class="flex w-full whitespace-nowrap text-gray-300 relative z-10">
                                                <span data-rate="1" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer relative" :class="{ '!text-yellow-300' : title >= 1 }" wire:click="setRate(1)" @mouseenter="title = 1" @mouseleave="title = 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                    </svg>
                                                    <div class="absolute text-sm bg-yellow-300 text-gray-700 px-1 rounded mt-1 font-bold" x-show="title == 1">خیلی بد</div>
                                                </span>
                                                <span data-rate="2" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer relative" :class="{ '!text-yellow-300' : title >= 2 }" wire:click="setRate(2)" @mouseenter="title = 2" @mouseleave="title = 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                    </svg>
                                                    <div class="absolute text-sm bg-yellow-300 text-gray-700 px-1 rounded mt-1 font-bold" x-show="title == 2">بد</div>
                                                </span>
                                                <span data-rate="3" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer relative" :class="{ '!text-yellow-300' : title >= 3 }" wire:click="setRate(3)" @mouseenter="title = 3" @mouseleave="title = 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                    </svg>
                                                    <div class="absolute text-sm bg-yellow-300 text-gray-700 px-1 rounded mt-1 font-bold" x-show="title == 3">متوسط</div>
                                                </span>
                                                <span data-rate="4" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer relative" :class="{ '!text-yellow-300' : title >= 4 }" wire:click="setRate(4)" @mouseenter="title = 4" @mouseleave="title = 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                    </svg>
                                                    <div class="absolute text-sm bg-yellow-300 text-gray-700 px-1 rounded mt-1 font-bold" x-show="title == 4">خوب</div>
                                                </span>
                                                <span data-rate="5" class="add-rating <?= $data['userId']!=FALSE ? "":" login_req";  ?> cursor-pointer relative" :class="{ '!text-yellow-300' : title >= 5 }" wire:click="setRate(5)" @mouseenter="title = 5" @mouseleave="title = 0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill=currentColor viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                    </svg>
                                                    <div class="absolute text-sm bg-yellow-300 text-gray-700 px-1 rounded mt-1 font-bold" x-show="title == 5">عالی</div>
                                                </span>
                                           </span>
                                    </div>
                                    <div id="ratingInfo" class="font-bold text-gray-300 dark:text-gray-200">
                                        <?php if($data['scoreItem']['count']==0){ ?>
                                            در انتظار ثبت رای
                                        <?php } else { ?>
                                            <?= $data['scoreItem']['sum']/$data['scoreItem']['count'] ?> از <?= $data['scoreItem']['count'] ?> رای
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:flex hidden flex-col px-12 pt-3 pb-3 items-center border border-gray-80 border-opacity-60  dark:border-opacity-5 mb-4 rounded-lg">
                            <h6>
                                <a class="text-blue-700 dark:text-white font-bold text-lg flex items-center mb-2">
                                    فیچرهای <?= $data['services']['s_title'] ?>
                                </a>
                            </h6>
                        </div>

                        <div class="grid lg:grid-cols-2 sm:grid-cols-4 grid-cols-2 gap-3 mb-4 rounded-lg">
                            <div class="flex flex-col items-center justify-center shadow-sm bg-white dark:bg-dark-930 rounded-md pt-3 pb-2">
                                <span class="mt-1 inline-flex text-blue-700 dark:text-white">
                                    <svg class="mb-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1792 23.9333C2.54046 23.9333 0.474609 21.8674 0.474609 12.2287C0.474609 2.59002 2.54046 0.52417 12.1792 0.52417C21.8178 0.52417 23.8837 2.59002 23.8837 12.2287C23.8837 21.8674 21.8178 23.9333 12.1792 23.9333ZM11.2038 6.37644C11.2038 5.83773 11.6405 5.40106 12.1792 5.40106C12.7178 5.40106 13.1545 5.83773 13.1545 6.37644V11.2533H18.0314C18.5701 11.2533 19.0068 11.69 19.0068 12.2287C19.0068 12.7674 18.5701 13.2041 18.0314 13.2041H12.1792C11.6405 13.2041 11.2038 12.7674 11.2038 12.2287V6.37644Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-11 text-gray-300 dark:text-white"> میانگین زمان انجام: </span>
                                <span class="text-sm text-chambray-700 font-bold dark:text-gray-200">
                                    <?= $data['services']['s_avg_time_to_do']!="" ? $data['services']['s_avg_time_to_do']:"-" ?>
                                </span>
                            </div>

                            <div class="flex flex-col items-center justify-center shadow-sm bg-white dark:bg-dark-930 rounded-md pt-3 pb-2">
                                <span class="mt-1 inline-flex text-blue-700 dark:text-white">
                                    <svg class="mb-3" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.452148 5.7989C0.452148 10.1426 1.38314 11.0736 5.72688 11.0736C10.0706 11.0736 11.0016 10.1426 11.0016 5.7989C11.0016 1.45516 10.0706 0.52417 5.72688 0.52417C1.38314 0.52417 0.452148 1.45516 0.452148 5.7989Z" fill="currentColor"></path>
                                        <path d="M0.452148 18.2664C0.452148 22.6102 1.38314 23.5412 5.72688 23.5412C10.0706 23.5412 11.0016 22.6102 11.0016 18.2664C11.0016 13.9227 10.0706 12.9917 5.72688 12.9917C1.38314 12.9917 0.452148 13.9227 0.452148 18.2664Z" fill="currentColor"></path>
                                        <path d="M12.9197 5.7989C12.9197 10.1426 13.8507 11.0736 18.1944 11.0736C22.5382 11.0736 23.4691 10.1426 23.4691 5.7989C23.4691 1.45516 22.5382 0.52417 18.1944 0.52417C13.8507 0.52417 12.9197 1.45516 12.9197 5.7989Z" fill="currentColor"></path>
                                        <path d="M12.9197 18.2664C12.9197 22.6102 13.8507 23.5412 18.1944 23.5412C22.5382 23.5412 23.4691 22.6102 23.4691 18.2664C23.4691 13.9227 22.5382 12.9917 18.1944 12.9917C13.8507 12.9917 12.9197 13.9227 12.9197 18.2664Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-11 text-gray-300 dark:text-white">تعداد جلسات ترمیم:</span>
                                <span class="text-sm text-chambray-700 font-bold dark:text-gray-200">
                                    <?= $data['services']['s_recovery_times']!="" ? $data['services']['s_recovery_times']." جلسه":"-" ?>
                                </span>
                            </div>

                            <div class="flex flex-col items-center justify-center shadow-sm bg-white dark:bg-dark-930 rounded-md pt-3 pb-2">
                                <span class="mt-1 inline-flex text-blue-700 dark:text-gray-200">
                                    <svg class="mb-3" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.125 7.66667C17.4786 7.66667 15.3333 5.52136 15.3333 2.875C15.3333 1.90785 15.6199 1.00763 16.1127 0.254587C14.817 0.0726507 13.2917 0 11.5 0C2.02975 0 0 2.02975 0 11.5C0 20.9702 2.02975 23 11.5 23C20.9702 23 23 20.9702 23 11.5C23 9.70834 22.9273 8.183 22.7454 6.88733C21.9924 7.38013 21.0921 7.66667 20.125 7.66667ZM5.39746 14.3078C5.88929 14.5024 6.4457 14.2617 6.64075 13.7702C6.64075 13.7702 6.64113 13.7692 5.75 13.4167L6.64113 13.7692L6.64511 13.7594C6.64891 13.7501 6.65517 13.7349 6.6638 13.7144C6.68109 13.6733 6.70783 13.6111 6.74348 13.5322C6.81496 13.3739 6.92116 13.1506 7.05756 12.8963C7.33667 12.376 7.7155 11.7765 8.15035 11.3302C8.60321 10.8655 8.96617 10.7168 9.23262 10.7343C9.47541 10.7502 9.99147 10.9311 10.6951 12.0201C11.5395 13.327 12.5162 14.1044 13.6419 14.1783C14.7438 14.2506 15.6248 13.6207 16.2224 13.0073C16.8381 12.3755 17.3162 11.5974 17.6315 11.0096C17.7923 10.7099 17.9176 10.4465 18.0033 10.2567C18.0463 10.1615 18.0796 10.0842 18.1027 10.0294C18.1142 10.0019 18.1233 9.98002 18.1297 9.96426L18.1374 9.94528L18.1398 9.93935L18.1406 9.9373C18.1406 9.9373 18.1411 9.93587 17.25 9.58333L18.1411 9.93587C18.3358 9.44371 18.0947 8.8869 17.6025 8.6922C17.1107 8.49762 16.5542 8.73834 16.3592 9.2299L16.3589 9.2308L16.3549 9.2406L16.3454 9.26355L16.3362 9.28564C16.3189 9.3267 16.2922 9.38886 16.2565 9.46779C16.185 9.62607 16.0788 9.84937 15.9424 10.1037C15.6633 10.624 15.2845 11.2235 14.8497 11.6698C14.3968 12.1345 14.0339 12.2832 13.7674 12.2657C13.5246 12.2498 13.0086 12.0689 12.3049 10.9799C11.4605 9.67304 10.4838 8.89562 9.35819 8.82172C8.25625 8.74937 7.37521 9.37932 6.77758 9.99267C6.16194 10.6245 5.68379 11.4026 5.36854 11.9904C5.20775 12.2901 5.08243 12.5535 4.99669 12.7433C4.95372 12.8385 4.92042 12.9158 4.89732 12.9706C4.88576 12.9981 4.87674 13.02 4.87031 13.0357L4.86262 13.0547L4.86025 13.0606L4.85944 13.0627C4.85944 13.0627 4.85887 13.0641 5.75 13.4167L4.85887 13.0641C4.66416 13.5563 4.9053 14.1131 5.39746 14.3078Z" fill="currentColor"></path>
                                        <path d="M20.125 5.75C18.5372 5.75 17.25 4.46282 17.25 2.875C17.25 1.28718 18.5372 0 20.125 0C21.7128 0 23 1.28718 23 2.875C23 4.46282 21.7128 5.75 20.125 5.75Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-11 text-gray-300 dark:text-gray-200">ماندگاری:</span>
                                <span class="text-sm text-chambray-700 font-bold dark:text-gray-200">
                                    <?= $data['services']['s_durability']!="" ? $data['services']['s_durability']:"-" ?>
                                </span>
                            </div>

                            <div class="flex flex-col items-center justify-center shadow-sm bg-white dark:bg-dark-930 rounded-md pt-3 pb-2">
                                <span class="mt-1 inline-flex text-blue-700 dark:text-gray-200">
                                    <svg class="mb-3" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.57753 1.67007C9.81824 0.0338038 12.2781 0.0338038 13.5188 1.67007L14.5518 3.03246L16.2456 2.79957C18.28 2.51986 20.0193 4.25924 19.7396 6.29356L19.5067 7.98737L20.8691 9.0204C22.5054 10.2611 22.5054 12.721 20.8691 13.9617L19.5067 14.9947L19.7396 16.6885C20.0193 18.7228 18.28 20.4622 16.2456 20.1825L14.5518 19.9496L13.5188 21.312C12.2781 22.9483 9.81824 22.9483 8.57753 21.312L7.5445 19.9496L5.85069 20.1825C3.81636 20.4622 2.07699 18.7228 2.3567 16.6885L2.58958 14.9947L1.2272 13.9617C-0.409067 12.721 -0.409067 10.2611 1.2272 9.0204L2.58958 7.98737L2.3567 6.29356C2.07699 4.25923 3.81637 2.51986 5.85069 2.79957L7.5445 3.03246L8.57753 1.67007ZM15.3819 10.3007C15.7415 9.94114 15.7415 9.3582 15.3819 8.99865C15.0224 8.6391 14.4394 8.6391 14.0799 8.99865L10.1275 12.951L8.93717 11.7607C8.57762 11.4011 7.99468 11.4011 7.63513 11.7607C7.27558 12.1202 7.27558 12.7032 7.63513 13.0627L9.47649 14.9041C9.83604 15.2636 10.419 15.2636 10.7785 14.9041L15.3819 10.3007Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-11 text-gray-300 dark:text-gray-200">تعداد متخصص در مجموعه:</span>
                                <span class="text-sm text-chambray-700 font-bold dark:text-gray-200">
                                    <?= count($data['servicesTariff'])>0 ? count($data['servicesTariff'])." نفر":"-" ?>
                                </span>
                            </div>
                        </div>

                        <?php if(sizeof($data['relatedBlog'])>0){ ?>
                            <div class="border border-gray-80 dark:border-opacity-0 dark:shadow-whiteShadow dark:bg-dark-930 border-opacity-60 rounded-md py-7 px-5">
                                <div class="flex items-start mb-4">
                                    <div class="ml-2 text-biscay-700 dark:text-white">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.7 10C0.7 12.0428 0.81037 13.6365 1.08778 14.8848C1.36343 16.1251 1.79459 16.9809 2.40685 17.5932C3.0191 18.2054 3.87493 18.6366 5.11522 18.9122C6.36346 19.1896 7.95723 19.3 10 19.3C12.0428 19.3 13.6365 19.1896 14.8848 18.9122C16.1251 18.6366 16.9809 18.2054 17.5931 17.5932C18.2054 16.9809 18.6366 16.1251 18.9122 14.8848C19.1896 13.6365 19.3 12.0428 19.3 10C19.3 7.95723 19.1896 6.36346 18.9122 5.11522C18.6366 3.87493 18.2054 3.01911 17.5931 2.40685C16.9809 1.7946 16.1251 1.36343 14.8848 1.08778C13.6365 0.810369 12.0428 0.700001 10 0.700001C7.95723 0.700001 6.36346 0.810369 5.11522 1.08778C3.87493 1.36343 3.0191 1.7946 2.40685 2.40685C1.79459 3.01911 1.36343 3.87493 1.08778 5.11522C0.81037 6.36346 0.7 7.95723 0.7 10Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.4" d="M8.3335 5.83337H11.6668" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M5.8335 10H14.1668" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.4" d="M8.3335 14.1666L11.6668 14.1666" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <span class="mb-4 text-biscay-700 dark:text-white text-17 font-bold"> مقالات مرتبط </span>
                                        <p class="font-normal text-13 dark:text-gray-920 text-dark-550">مطالب مرتبط با <?= $data['services']['s_title'] ?></p>
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-11">
                                        <?php foreach($data['relatedBlog'] as $post){ ?>
                                            <div class="shadow-sm pt-2 rounded mb-9 bg-white dark:bg-dark-890">
                                                <div class="title md:pl-34px pl-4">
                                                    <h3 class="pr-3 mb-2">
                                                        <a href="blog/article/<?= $post['slug'] ?>" class="text-15 transition duration-200 font-bold leading-6 inline-flex text-biscay-700 dark:text-white dark:hover:text-blue-450 h-12 overflow-y-hidden hover:text-dark-700">
                                                            <?= $post['title'] ?>
                                                        </a>
                                                    </h3>
                                                    <div class="relative w-full border-t pr-3 pt-2 border-gray-300 pb-2 border-opacity-10">
                                                        <a href="blog/article/<?= $post['slug'] ?>" class="click_for_play inline-flex items-center text-sm font-bold text-blue-700 dark:text-blue-450 dark:hover:text-white transform transition group duration-200 hover:text-dark-700">
                                                            مشاهده مطلب
                                                            <svg class="mr-1" width="15" height="12" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill="currentColor" opacity="0.4" d="M6.72263 2.87852L8.66172 2.70703C9.09689 2.70703 9.44971 3.06329 9.44971 3.50269C9.44971 3.9421 9.09689 4.29836 8.66172 4.29836L6.72263 4.12687C6.38125 4.12687 6.10448 3.8474 6.10448 3.50269C6.10448 3.15741 6.38125 2.87852 6.72263 2.87852"></path>
                                                                <path fill="currentColor" d="M0.211141 2.91007C0.241448 2.87946 0.354671 2.75012 0.461032 2.64273C1.08147 1.97005 2.70147 0.870096 3.54893 0.533469C3.67759 0.479771 4.00297 0.365445 4.17738 0.357361C4.34378 0.357361 4.50275 0.396047 4.65429 0.472264C4.84356 0.579084 4.99453 0.747686 5.07801 0.946313C5.1312 1.08374 5.21468 1.49658 5.21468 1.50409C5.2976 1.95504 5.34277 2.68834 5.34277 3.49902C5.34277 4.27043 5.2976 4.97371 5.22955 5.43217C5.22212 5.44025 5.13863 5.95241 5.04771 6.12794C4.8813 6.44898 4.55593 6.6476 4.20768 6.6476H4.17738C3.95036 6.6401 3.47345 6.44089 3.47345 6.43396C2.67117 6.09734 1.08948 5.0505 0.453598 4.35473C0.453598 4.35473 0.274042 4.17574 0.196273 4.0643C0.0750442 3.90378 0.0144299 3.70515 0.0144299 3.50652C0.0144299 3.2848 0.082478 3.07867 0.211141 2.91007"></path>
                                                            </svg>
                                                        </a>
                                                        <a class="absolute -top-1 left-0 overflow-hidden shadow-sm rounded w-28 h-14" href="blog/article/<?= $post['slug'] ?>">
                                                            <img class="w-full h-full object-cover transform transition duration-200 hover:scale-110" src="public/images/blog/<?= $post['cover'] ?>" alt="<?= $post['title'] ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <a href="blog" class="group flex items-center justify-center h-11 dark:hover:text-white dark:hover:bg-blue-450 text-blue-700 dark:text-blue-450 dark:border-blue-450 text-sm border border-blue-700 rounded-md transition duration-200 hover:text-white hover:bg-blue-700">
                                        مشاهده همه مطالب
                                        <svg class="mr-1" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill="currentColor" opacity="0.4" d="M9.16421 4.34311L11.7785 4.11191C12.3652 4.11191 12.8408 4.59221 12.8408 5.18461C12.8408 5.77701 12.3652 6.25732 11.7785 6.25732L9.16421 6.02612C8.70396 6.02612 8.33082 5.64935 8.33082 5.18461C8.33082 4.7191 8.70396 4.34311 9.16421 4.34311"></path>
                                            <path fill="currentColor" d="M0.385293 4.38562C0.426152 4.34437 0.578799 4.16999 0.722194 4.0252C1.55866 3.11831 3.74274 1.63536 4.88527 1.18152C5.05873 1.10912 5.4974 0.95499 5.73253 0.944092C5.95688 0.944092 6.1712 0.996248 6.3755 1.099C6.63068 1.24302 6.83421 1.47032 6.94677 1.73811C7.01846 1.92338 7.13102 2.47998 7.13102 2.4901C7.24281 3.09807 7.30371 4.0867 7.30371 5.17964C7.30371 6.21965 7.24281 7.16781 7.15106 7.7859C7.14104 7.7968 7.02849 8.48728 6.90591 8.72393C6.68156 9.15675 6.2429 9.42454 5.77339 9.42454H5.73253C5.42647 9.41442 4.78351 9.14585 4.78351 9.13651C3.70188 8.68267 1.56946 7.27134 0.712171 6.33331C0.712171 6.33331 0.470096 6.09199 0.365248 5.94175C0.201809 5.72534 0.120089 5.45755 0.120089 5.18976C0.120089 4.89084 0.211831 4.61293 0.385293 4.38562"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <input type="hidden" id="hdfGuid" value="<?= $data['attrId'] ?>" />
    <input type="hidden" id="hdfToday" value="<?= jdate("Y_m_d", '', '', '', 'en') ?>" />
    <input type="hidden" id="hdfFirstVisit" value="<?= jdate("Y_m_d", '', '', '', 'en') ?>" />

    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/single-service.js"></script>
<script src="public/js/default/editor.js"></script>
<script src="public/js/default/slick.min.js"></script>
<script src="public/js/showTimer.min.js"></script>
<script src='public/js/jquery.fancybox.min.js'></script>

<script>
    window.Alpine.start();
</script>

<script type="text/x-kendo-template" id="weekColumnTemplate">
    <div class="week-col week_no_#:weekNumber#">
        <ul class="week-col-items">
        </ul>
    </div>
</script>
<script type="text/x-kendo-template" id="daysRowTemplate">
    <div class="day-col #:shortDate#">
        <div class="date-time-span">
            <span class="day-caption">#:dayCaption#</span>
        </div>
        <ul class="time-spans booking_row_#:shortDate#"></ul>
    </div>
</script>
<script type="text/javascript">
    var holderID = 'TimeSpans';
    var globalGuid, gMonth, slider;
    var year = parseInt($("#lblYearMatabSetTime").html());
    var month = parseInt($("#lblYearMatabSetTimeCu").html());
    gMonth = month;
    var today = $("#hdfFirstVisit").val().split("_");
    InitSelectedMonthDays(month, year, today[2]);
    $("#btnNextMonthMatabSetTime").attr("data-month", month);
    $("#btnPrevMonthMatabSetTime").attr("data-month", month);
    $("#btnPrevMonthMatabSetTime").click(function () {
        var year = parseInt($("#lblYearMatabSetTime").html());
        gMonth = parseInt(gMonth) - 1;
        if (gMonth < 1) {
            gMonth = 12;
            InitSelectedMonthDays(12, year - 1);
            $(this).attr("data-month", 12);
            $("#btnNextMonthMatabSetTime").attr("data-month", 12);
            $("#lblYearMatabSetTime").html(year - 1);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(12));
        } else {
            InitSelectedMonthDays(gMonth, year);
            $(this).attr("data-month", gMonth);
            $("#btnNextMonthMatabSetTime").attr("data-month", gMonth);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(gMonth));
        }
    });
    $("#btnNextMonthMatabSetTime").click(function () {
        var year = parseInt($("#lblYearMatabSetTime").html());
        gMonth = parseInt(gMonth) + 1;
        if (gMonth > 12) {
            gMonth = 1;
            InitSelectedMonthDays(1, year + 1);
            $(this).attr("data-month", 1);
            $("#btnPrevMonthMatabSetTime").attr("data-month", 1);
            $("#lblYearMatabSetTime").html(year + 1);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(1));
        } else {
            InitSelectedMonthDays(gMonth, year);
            $(this).attr("data-month", gMonth);
            $("#btnPrevMonthMatabSetTime").attr("data-month", gMonth);
            $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(gMonth));
        }
    });
    function getShamsiMonthNameMatabSetTime(month) {
        switch (month) {
            case 1:
                return "فروردین";
            case 2:
                return "اردیبهشت";
            case 3:
                return "خرداد";
            case 4:
                return "تیر";
            case 5:
                return "مرداد";
            case 6:
                return "شهریور";
            case 7:
                return "مهر";
            case 8:
                return "آبان";
            case 9:
                return "آذر";
            case 10:
                return "دی";
            case 11:
                return "بهمن";
            case 12:
                return "اسفند";
        }
        return "";
    }
    function loadDays(url, guid, y, m, whatToDoNext, isFirstVisit) {
        if (navigator.onLine) {
            $.ajax({
                url: 'services/InitDays',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                data: JSON.stringify({
                    url,
                    guid,
                    y,
                    m,
                    isFirstVisit
                }),
                type: 'post',
                success: function (res) {
                    if (whatToDoNext) {
                        whatToDoNext(res);
                    }
                }
            });
        } else {
            errortoast.fire({title: 'وضعیت شما آفلاین می باشد و امکان دریافت زمان ها وجود ندارد.'});
        }
    }
    function InitSelectedMonthDays(m, y, d) {
        gMonth = m;
        var guid = $("#hdfGuid").val();
        var url = "<?= htmlspecialchars($_GET['url']) ?>";

        $("#" + holderID).addClass('blury');
        $("#LoaderTimes").show();

        loadDays(url, guid, y, m, function (res) {
            if (res.status != "error") {
                if (res && res.constructor == Array) {
                    $('#' + holderID).html("").removeClass("slick-initialized slick-slider");
                    InitVisitTimes(res, res);
                    InitSlider();
                    var today = $("#hdfToday").val().split("_");
                    if (d != 0 && d != undefined) {
                        var elClass = d == today[2] ? ".today-col" : ".first-visit";
                        var index = $('#' + holderID).find(elClass).data().slickIndex;
                        $('#' + holderID).slick('slickGoTo', index);
                    }
                }
            } else {
                warningtoast.fire({title: res.msg});
            }
        });
    }
    function bindTemplate(template, obj) {
        var result = template;
        if (template && obj) {
            for (var prop in obj) {
                result = result.replace('#:' + prop + '#', obj[prop]).replace('#:' + prop + '#', obj[prop]).replace('#:' + prop + '#', obj[prop]);
            }
        }
        return result;
    }
    function bindDayTemplate(obj) {
        var result = '';
        if (obj) {
            if (obj.hasSetTimes && obj.setTimeItems && obj.setTimeItems.length > 0) {
                for (var i = 0; i < obj.setTimeItems.length; i++) {
                    if(obj.setTimeItems[i].isVip) {
                        result += '<li><a title="رزرو VIP" href="' + obj.setTimeItems[i].url + '" class="group items-center flex relative justify-center">' + obj.setTimeItems[i].caption + '<span class="absolute text-white bg-red-450 rounded w-8 h-4 flex items-center justify-center text-xs -top-1 -right-1 pt-1" style="font-size: 0.75rem">VIP</span></a></li>';
                    } else {
                        result += '<li><a href="' + obj.setTimeItems[i].url + '">' + obj.setTimeItems[i].caption + '</a></li>';
                    }
                }
            } else {
                result += '<li class="no-visit"><i></i></li>';
            }
        }

        return result;
    }
    function binddayItemTemplate(data) {
        var result = '';

        if (data) {
            result += '<span>' + data.dayCaption + '</span>';
            result += '<div class="sec_time sec_time_' + data.shortDate + '">';
            if (data.hasMultiTimeSections) {
                result += '<ul class="times_items"></ul>';
            }
            result += '</div>';
        }

        return result;
    }
    function bindtimeTemplate(data) {
        var result = '';
        if (data && data.setTimeItems && data.setTimeItems.length > 0) {
            for (var i = 0; i < data.setTimeItems.length; i++) {
                result += '<span class="sec_time">'+ data.setTimeItems[i].caption +'</span>';
            }
        }
        return result;
    }
    function InitVisitTimesDen(view, data) {
        var weekColumnTemplate = $("#weekColumnTemplate").html();
        var numberOfWeeks = view.length / 7;
        var i;
        var col;

        for (i = 1; i <= numberOfWeeks; i++) {
            var startOfWeek = 7 * (i - 1);
            var endOfWeek = (7 * i) - 1;
            var j = 0;
            data[startOfWeek].weekNumber = i;
            var weekCol = bindTemplate(weekColumnTemplate, data[startOfWeek]);

            $("#" + holderID).append(weekCol);

            for (j = startOfWeek; j <= endOfWeek; j++) {
                var liClasses = "";
                if (data[j].isHoliday) liClasses += "holiday ";
                if (data[j].isFirstVisit) liClasses += "first-visit ";
                if (data[j].today) liClasses += "today-col ";
                if (data[j].isNotInMonth || !data[j].hasSetTimes) liClasses += "not-in-month ";
                if (data[j].setTimeItems != null && data[j].setTimeItems.length > 1) liClasses += "multi-time ";
                liClasses = "class='" + liClasses + "'";

                if (data[j].hasSetTimes) {
                    if (data[j].setTimeItems.length > 1) {
                        data[j].hasMultiTimeSections = true;

                        var dayItems = binddayItemTemplate(data[j]);
                        $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");

                        var k = 0;
                        for (k = 0; k < data[j].setTimeItems.length; k++) {

                            data[j].cnt = k;
                            var tt = bindtimeTemplate(data[j]);
                            $(".week_no_" + i).find(".sec_time_" + data[j].shortDate).children(".times_items").append("<li>" + tt + "</li>");
                        }
                    } else {
                        data[j].hasMultiTimeSections = false;

                        data[j].cnt = 0;
                        var tt = bindtimeTemplate(data[j]);


                        var dayItems = binddayItemTemplate(data[j]);
                        $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");

                        $(".week_no_" + i).find(".sec_time_" + data[j].shortDate).append(tt);
                    }
                } else {
                    data[j].hasMultiTimeSections = false;

                    data[j].cnt = 0;

                    var dayItems = binddayItemTemplate(data[j]);
                    $("#" + holderID).children(".week_no_" + i).children(".week-col-items").append("<li " + liClasses + "'>" + dayItems + "</li>");
                }
            }
        }
    }
    function InitVisitTimes(view, data) {
        var i;
        var col;

        for (i = 0; i < view.length; ++i) {
            col = data[i].shortDate;
            if ($("#" + holderID).find('.' + col).length === 0) {
                var dayCol = bindTemplate($("#daysRowTemplate").html(), data[i]);
                $("#" + holderID).append(dayCol);

                if (data[i].hasSetTimes) {
                    var daySetTimes = bindDayTemplate(data[i]);
                    $("#" + holderID).find(".booking_row_" + col).append(daySetTimes);
                }
                if (data[i].isFirstVisit) {
                    $("#" + holderID).find("." + col).addClass("first-visit");
                }
                if (data[i].today) {
                    $("#" + holderID).find("." + col).addClass("today-col");
                }
                if (data[i].isHoliday) {
                    $("#" + holderID).find("." + col).addClass("holiday");
                }
            }
        }

        var maxChild = 7;
        $.each($("ul.time-spans"), function (index, val) {
            var thisLength = $(this).children().length;
            if (maxChild > thisLength) {
                for (var j = 0; j < maxChild - thisLength; j++) {
                    var mockData = {};
                    mockData.hasSetTimes = false;
                    var daySetTimes = bindDayTemplate(mockData);

                    $(this).append(daySetTimes);
                }
            }
        });


        for (i = 0; i < data.length; ++i) {
            col = data[i].shortDate;
            $(".booking_" + col).append(bindTemplate($("#daysRowTemplate").html(), data[i]));
        }

        $(".day-col:odd").addClass("odd-day");

        var hasVisit = $.makeArray($("ul.time-spans > li:not(.no-visit)").parent());
        var all = $.makeArray($("ul.time-spans"));

        var noVisits = all.filter(function (el) {
            return hasVisit.indexOf(el) < 0;
        });

        $.each(noVisits, function () { $(this).addClass("has-no-visit"); });
    }
    function InitSliderDen() {
        $("#" + holderID).removeClass('blury');
        $("#LoaderTimes").hide();

        $('#' + holderID).slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: true,
        });
    }
    function InitSlider() {
        $("#" + holderID).removeClass('blury');
        $("#LoaderTimes").hide();

        $('#' + holderID).slick({
            infinite: false,
            slidesToShow: 7,
            slidesToScroll: 7,
            rtl: true,
            responsive: [
                {
                    breakpoint: 760,
                    settings: {
                        infinite: false,
                        slidesToShow: 6,
                        slidesToScroll: 6,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        infinite: false,
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        infinite: false,
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        rtl: true,
                    }
                },
                {
                    breakpoint: 426,
                    settings: {
                        arrows: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1,
                        rtl: true,
                    }
                }
            ]
        });
    }
    function getFirstVisit() {
        if ($('#' + holderID).find(".first-visit").length > 0) {
            var index = $('#' + holderID).find('.first-visit').data().slickIndex;

            $('#' + holderID).slick('slickGoTo', index);
        } else {
            var guid = $("#hdfGuid").val();

            if (navigator.onLine) {
                $.ajax({
                    type: "POST",
                    url: 'services/getFirstFree',
                    data: JSON.stringify({
                        guid
                    }),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (msg) {
                        if (msg.status != "error") {
                            if (msg.d != "") {
                                if (msg.d.indexOf("-") == -1) {
                                } else {
                                    var date = msg.d.split("-");
                                    InitSelectedMonthDays(date[1], date[0], date[2]);
                                    $("#lblYearMatabSetTime").html(date[0]);
                                    $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(parseInt(date[1])));
                                }
                            } else {
                                warningtoast.fire({title: "در حال حاضر نوبتی برای رزرو خدمت " + "<?= $data['services']['s_title'] ?>" + " یافت نشد."});
                            }
                        } else {
                            warningtoast.fire({title: msg.msg});
                        }
                    },
                    beforeSend: function () {
                    }
                });
            } else {
                errortoast.fire({title: 'وضعیت شما آفلاین می باشد و امکان دریافت زمان ها وجود ندارد.'});
            }
        }
    }
    function getTodayDate() {
        var date = $("#hdfToday").val().split("_");

        if ($('#' + holderID).find(".today-col").length == 0) InitSelectedMonthDays(date[1], date[0], date[2]);
        else {
            var index = $('#' + holderID).find('.today-col').data().slickIndex;
            $('#' + holderID).slick('slickGoTo', index);
        }

        $("#lblYearMatabSetTime").html(date[0]);
        $("#lblMonthMatabSetTime").html(getShamsiMonthNameMatabSetTime(parseInt(date[1])));
    }
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
    $(function(){
        var swiper = new Swiper('.carousel-gallery .swiper-container', {
            loop: true,
            keyboard: true,
            effect: 'slide',
            speed: 900,
            slidesPerView: "auto",
            spaceBetween: 30,
            simulateTouch: true,
            autoplay: {
                delay: 3000,
                stopOnLastSlide: false,
                disableOnInteraction: false
            },
            pagination: {
                el: '.carousel-gallery .swiper-pagination',
                clickable: true
            },
            breakpoints: {
                // when window width is <= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                // when window width is <= 480px
                425: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                // when window width is <= 640px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                }
            }
        });
    });
</script>

</body>
</html>