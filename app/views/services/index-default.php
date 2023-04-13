<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>خدمات <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="<?= $data['getPublicInfo']['meta_keyword']; ?>"/>
    <meta name="author" content="<?= $data['getPublicInfo']['site']; ?>"/>
    <meta property="og:url" content="<?= URL; ?>services">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="<?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="og:image:width" content="697">
    <meta property="og:image:height" content="299">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:image" content="<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>">
    <meta property="twitter:description" content="<?= $data['page']['metaDescription']; ?>">
    <meta property="twitter:title" content="خدمات <?= $data['getPublicInfo']['site']; ?>">
    <meta property="og:description" content="<?= $data['page']['metaDescription']; ?>">
    <meta property="og:title" content="خدمات <?= $data['getPublicInfo']['site']; ?>">
    <meta name="description" content="<?= $data['page']['metaDescription']; ?>">
    <meta name="article:publisher" content="<?= $data['page']['a_name']; ?>"/>
    <link rel="canonical" href="<?= Model::str_left_replace("//", "/", URL. $_SERVER['REQUEST_URI']) ?>"/>
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"خدمات <?= $data['getPublicInfo']['site']; ?>",
            "description":"<?= $data['getPublicInfo']['meta_description']; ?>"
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
                            "<?= $data['getMethodsContacting']['aparat']['mc_link']; ?>",
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
                    "description" : "<?= $data['page']['metaDescription']; ?>",
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
                    "@type" : "BreadcrumbList",
                    "@id" : "<?= URL; ?>services#breadcrumb",
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
                                "@id" : "<?= URL; ?>services",
                                "url" : "<?= URL; ?>services",
                                "name" : "خدمات <?= $data['getPublicInfo']['site']; ?>"
                            }
                        }
                    ]
                },
                {
                    "@type" : "CollectionPage",
                    "@id" : "<?= URL; ?>services#webpage",
                    "url" : "<?= URL; ?>services",
                    "name" : "خدمات <?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['page']['metaDescription']; ?>",
                    "inLanguage" : "fa-IR",
                    "isPartOf" : {
                        "@id" : "<?= URL; ?>#website"
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
    <div wire:id="vkaLGJmSC6g9DxBoPFi3" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;vkaLGJmSC6g9DxBoPFi3&quot;,&quot;name&quot;:&quot;layouts.header.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;courses&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;VEYNVE1&quot;:{&quot;id&quot;:&quot;Kesga5oqbHh4Bd9hcZYr&quot;,&quot;tag&quot;:&quot;section&quot;},&quot;fVc5WAG&quot;:{&quot;id&quot;:&quot;6yHVSDwNFR2gFiTSMq2B&quot;,&quot;tag&quot;:&quot;form&quot;},&quot;7qzxygW&quot;:{&quot;id&quot;:&quot;2A5KDFxQvYJf2Vgzc4ns&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;15VKB3b&quot;:{&quot;id&quot;:&quot;5UdyzEuLMar9cci8iiVZ&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;3ZreJ09&quot;:{&quot;id&quot;:&quot;tTaR63PVcUCtQxJ2MXFi&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;050rzPh&quot;:{&quot;id&quot;:&quot;94HEyb8vLvlolJ8KteXr&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;5fCHkkv&quot;:{&quot;id&quot;:&quot;dg9ybG5XZ92Kgahj56CO&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;ffdd1a9a&quot;,&quot;data&quot;:{&quot;discount&quot;:{&quot;status&quot;:false,&quot;message&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;4b0f4c2c145cdb8e9a1d33b886facb0be6b256ebd25a10f032407b3b1c660408&quot;}}">
        <section wire:id="Kesga5oqbHh4Bd9hcZYr" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;Kesga5oqbHh4Bd9hcZYr&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;courses&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;a6408e38&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:null,&quot;message&quot;:null,&quot;moreLink_title&quot;:null,&quot;moreLink_link&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;cfd1b2d1447dadfe728f58e3ce7e47ee109fa5f79cafdca69243c4da4cef4931&quot;}}" class="mt-4">
            <div class="container"></div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>

    <section class="mt-14 mb-20">
        <div class="container">
            <div class="mb-8">
                <h3 class="dark:text-white text-biscay-700 text-3xl font-black mb-2" id="courses-page">خدمات <?= $data['getPublicInfo']['site']; ?></h3>
            </div>

            <div class="grid lg:grid-cols-24 grid-cols-12 lg:gap-6">
                <div class="xl:col-span-6 lg:col-span-8 col-span-12 lg:order-1 order-2">
                    <div x-data="{show: true}" class="rounded-lg dark:bg-dark-930 bg-white mb-5 dark:bg-dark-930 border dark:shadow-whiteShadow  dark:border-opacity-0 border-gray-80 border-opacity-60 p-5">
                        <div @click="show = !show" class="flex items-center text-biscay-700 dark:text-white justify-between cursor-pointer">
                            <div class="flex items-center">
                                <h5 class="text-21  font-bold">مرتب سازی براساس</h5>
                            </div>

                            <svg :class="{'!rotate-0':show}" class="transition transform duration-200 rotate-90 !rotate-0" width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.3992 1.4729L8.99744 8.87464L1.5957 1.4729" stroke="currentColor" stroke-width="2.11478" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <ul x-transition="" x-show="show" class="pt-5 border-t border-gray-80 dark:border-white dark:border-opacity-10 border-opacity-60 mt-5 ">
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-latest" type="radio" <?= (htmlspecialchars($_GET['orderby'])=="" or htmlspecialchars($_GET['orderby'])=="latest") ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'latest'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-latest">جدید&zwnj;ترین</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-view" type="radio" <?= htmlspecialchars($_GET['orderby'])=="view" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'view'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-view">پربازدیدترین</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-rating" type="radio" <?= htmlspecialchars($_GET['orderby'])=="rating" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'rating'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-rating">میانگین رتبه</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-oldest" type="radio" <?= htmlspecialchars($_GET['orderby'])=="oldest" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'oldest'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-oldest">قدیمی&zwnj;ترین</label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="xl:col-span-18 lg:col-span-16 lg:order-2 col-span-12 order-1">
                    <div class="mt-12 grid grid-cols-12 lg:gap-6 gap-3">
                        <?php if(sizeof($data['services'])>0){ ?>
                            <?php foreach($data['services'] as $service){ ?>
                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-4 sm:col-span-6 col-span-12 mb-14">
                                    <?php require('app/views/template/default/items/service-item.php'); ?>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-span-12 flex flex-col items-center mt-9">
                                <span class="dark:text-white text-gray-300 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                <div class="mb-8">
                                    <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if(sizeof($data['services'])>0){ ?>
                        <div class="mb-12">
                            <div class="w-full">
                                <?= $data['itemsPagination'] ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/courses.js"></script>
<script>
    window.Alpine.start();
</script>
<script>
    $('input[type="radio"][name="order"]').click(function() {
        window.location = $(this).val();
    });

    $('input[type="checkbox"]').click(function() {
        window.location = $(this).val();
    });
</script>

</body>
</html>