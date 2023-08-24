<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $data['page']['title']; ?> | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>" rel="alternate"/>
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
    <link rel="canonical" href="<?= URL; ?>">
    <!-- Fav Icons -->
    <?php require('app/views/include/favicon.php'); ?>

    <?php require('app/views/include/default/publicCSS.php'); ?>
    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['page']['title']; ?> | <?= $data['getPublicInfo']['site']; ?>",
            "description":"<?= $data['page']['metaDescription']; ?>"
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@graph" : [
                {
                    "@type":"Organization",
                    "@id":"<?= URL ?><?= $data['page']['link']; ?>#organization",
                    "name":"<?= $data['getPublicInfo']['site']; ?>",
                    "url":"<?= URL; ?><?= $data['page']['link']; ?>",
                    "sameAs":[
                        "<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>",
                        "<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>",
                        "<?= $data['getMethodsContacting']['twitter']['mc_link']; ?>"
                    ],
                    "logo":{
                        "@type":"ImageObject",
                        "@id":"<?= URL ?><?= $data['page']['link']; ?>#logo",
                        "url":"<?= URL; ?>public/images/logos/<?= $data['getPublicInfo']['logo_square']; ?>",
                        "width":512,
                        "height":512,
                        "caption":"<?= $data['getPublicInfo']['site']; ?>"
                    },
                    "image":{
                        "@id":"<?= URL ?><?= $data['page']['link']; ?>#logo"
                    }
                },
                {
                    "@type": "WebSite",
                    "@id" : "<?= URL ?>#website",
                    "url" : "<?= URL ?>",
                    "name" : "<?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['page']['metaDescription']; ?>",
                    "publisher":{
                        "@id":"<?= URL ?><?= $data['page']['link']; ?>#organization"
                    },
                    "potentialAction" : {
                        "@type": "SearchAction",
                        "target": "<?= URL ?>search?s={search_term_string}",
                        "query-input": "required name=search_term_string"
                    }
                }
            ,{
                    "@type" : "BreadcrumbList",
                    "@id" : "<?= URL ?>blog#breadcrumb",
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
                                "@id" : "<?= URL ?><?= $data['page']['link']; ?>",
                                "url" : "<?= URL ?><?= $data['page']['link']; ?>",
                                "name" : "<?= $data['page']['title']; ?>"
                            }
                        }
                    ]
                }
            ,{
                    "@type" : "CollectionPage",
                    "@id" : "<?= URL ?><?= $data['page']['title']; ?>#webpage",
                    "url" : "<?= URL ?><?= $data['page']['title']; ?>",
                    "name" : "<?= $data['page']['title']; ?> | <?= $data['getPublicInfo']['site']; ?>",
                    "description" : "<?= $data['page']['metaDescription']; ?>",
                    "inLanguage" : "fa-IR",
                    "isPartOf" : {
                        "@id" : "<?= URL ?><?= $data['page']['link']; ?>#website"
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
        <section wire:id="SfB4ZUq638lqqybiU0m7" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;SfB4ZUq638lqqybiU0m7&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;articles\/linux-an-operating-system-for-developers&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;5be47514&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:null,&quot;message&quot;:null,&quot;moreLink_title&quot;:null,&quot;moreLink_link&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;f14f1b5304e10be1a95d1c23484ec70cbfdbdfd7aad313b4556d75590cd6504d&quot;}}" class="mt-4">
            <div class="container"></div>
        </section>

        <?php require('app/views/include/default/header.php'); ?>
    </div>

    <!-- Livewire Component wire-end:rR8CKmhfXYysyOboJmXx -->
    <section class="mt-14 mb-20">
        <div class="container">
            <div class="mb-8">
                <h3 class="dark:text-white text-biscay-700 text-3xl font-black mb-2" id="courses-page">وبلاگ</h3>
            </div>

            <div class="grid lg:grid-cols-24 grid-cols-12 lg:gap-6">
                <div class="xl:col-span-6 lg:col-span-8 col-span-12 lg:order-1 order-2">

                    <div x-data="{show: true}" class="rounded-lg dark:bg-dark-930 bg-white <?= $data['getMethodsContacting']['instagram']['mc_link']!=NULL ? " mb-7":" mb-5"; ?> dark:bg-dark-930 border dark:shadow-whiteShadow  dark:border-opacity-0 border-gray-80 border-opacity-60 p-5">
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
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-latest" type="radio" <?= (htmlspecialchars($_GET['orderby'] ?? "")=="" or htmlspecialchars($_GET['orderby'] ?? "")=="latest") ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'latest'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-latest">جدید&zwnj;ترین</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-view" type="radio" <?= htmlspecialchars($_GET['orderby'] ?? "")=="view" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'view'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-view">پربازدیدترین</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-rating" type="radio" <?= htmlspecialchars($_GET['orderby'] ?? "")=="controversial" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'controversial'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-rating">پربحث&zwnj;ترین</label>
                            </li>
                            <li class="flex items-center mb-4 last:mb-0">
                                <input class="dark:bg-gray-400 text-gray-800 w-6 h-6 ml-3 bg-gray-100 border-0 border-transparent cursor-pointer ring-0" id="order-oldest" type="radio" <?= htmlspecialchars($_GET['orderby'] ?? "")=="oldest" ? "checked":"" ?> name="order" value="<?= Model::add_parameters_to_url($_SERVER['REQUEST_URI'], array('orderby' => 'oldest'), "add") ?>">
                                <label class="dark:text-gray-920 text-gray-800 text-base font-medium cursor-pointer" for="order-oldest">قدیمی&zwnj;ترین</label>
                            </li>
                        </ul>
                    </div>

                    <?php if ($data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                        <div class="flex relative items-center justify-end py-4 mb-5 px-4 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 rounded-md">
                            <img class="absolute -right-3 bottom-0 w-32 h-20 object-contain" src="public/images/index_instagram_phone.png" alt="اینستاگرام" />
                            <a href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>" class="group flex items-center px-2 py-2 bg-white rounded text-purple-600 text-10 font-bold transition duration-200 hover:text-white hover:bg-purple-600 border hover:border-1 border-white">
                                مشاهده اینستاگرام
                            </a>
                        </div>
                    <?php } ?>

                    <?php if(sizeof($data['suggestBlog'])>0) { ?>
                        <div class="border border-gray-80 dark:border-opacity-0 bg-white dark:bg-dark-930 dark:shadow-whiteShadow border-opacity-60 rounded-lg py-7 px-5">
                            <div class="flex items-start mb-4">
                                <div class="text-biscay-700 dark:text-white">
                                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.7 10C3.7 12.0428 3.81037 13.6365 4.08778 14.8848C4.36343 16.1251 4.79459 16.9809 5.40685 17.5932C6.0191 18.2054 6.87493 18.6366 8.11522 18.9122C9.36346 19.1896 10.9572 19.3 13 19.3C15.0428 19.3 16.6365 19.1896 17.8848 18.9122C19.1251 18.6366 19.9809 18.2054 20.5931 17.5932C21.2054 16.9809 21.6366 16.1251 21.9122 14.8848C22.1896 13.6365 22.3 12.0428 22.3 10C22.3 7.95723 22.1896 6.36346 21.9122 5.11522C21.6366 3.87493 21.2054 3.01911 20.5931 2.40685C19.9809 1.7946 19.1251 1.36343 17.8848 1.08778C16.6365 0.810369 15.0428 0.700001 13 0.700001C10.9572 0.700001 9.36346 0.810369 8.11522 1.08778C6.87493 1.36343 6.0191 1.7946 5.40685 2.40685C4.79459 3.01911 4.36343 3.87493 4.08778 5.11522C3.81037 6.36346 3.7 7.95723 3.7 10Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.4" d="M11.3335 5.83331H14.6668" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8.8335 10H17.1668" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path opacity="0.4" d="M11.3335 14.1667L14.6668 14.1667" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.46011 13.7404L6.22153 15.2615C6.29615 15.4109 6.44019 15.5144 6.60723 15.5384L8.31056 15.7836C8.7314 15.8443 8.89887 16.3544 8.5943 16.6466L7.36258 17.8302C7.24153 17.9465 7.18643 18.1139 7.21506 18.2782L7.50575 19.9491C7.57734 20.3624 7.1374 20.6778 6.76125 20.4822L5.23884 19.6928C5.08959 19.6153 4.91084 19.6153 4.76116 19.6928L3.23875 20.4822C2.8626 20.6778 2.42266 20.3624 2.49468 19.9491L2.78494 18.2782C2.81357 18.1139 2.75847 17.9465 2.63742 17.8302L1.4057 16.6466C1.10113 16.3544 1.2686 15.8443 1.68944 15.7836L3.39277 15.5384C3.55981 15.5144 3.70428 15.4109 3.77891 15.2615L4.53989 13.7404C4.72819 13.3643 5.27181 13.3643 5.46011 13.7404Z" fill="white" stroke="#FFA826" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="mb-4 text-biscay-700 dark:text-white text-17 font-bold">پیشنهاد سردبیر</span>
                                    <p class="font-normal dark:text-gray-920 text-13 text-dark-550">مقالات برگزیده را از این قسمت میتوانید ببینید</p>
                                </div>
                            </div>
                            <div>
                                <div class="mb-11">
                                    <?php foreach($data['suggestBlog'] as $news){ ?>
                                        <div class="shadow-sm pt-2 rounded mb-9 bg-white dark:bg-dark-890">
                                            <div class="title md:pl-34px pl-4">
                                                <h3 class="pr-3 mb-2">
                                                    <a href="blog/article/<?= $news['slug'] ?>" class="text-15 transition duration-200 font-bold leading-6 inline-flex text-biscay-700 dark:text-white dark:hover:text-blue-450 h-12 overflow-y-hidden hover:text-dark-700"><?= $news['title'] ?></a>
                                                </h3>
    
                                                <div class="relative w-full border-t pr-3 pt-2 border-gray-300 pb-2 border-opacity-10">
                                                    <a href="blog/article/<?= $news['slug'] ?>" class="click_for_play inline-flex items-center text-sm font-bold text-blue-700 dark:text-blue-450 dark:hover:text-white transform transition group duration-200 hover:text-dark-700">
                                                        مشاهده
                                                        <svg class="mr-1" width="15" height="12" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill="currentColor" opacity="0.4" d="M6.72263 2.87852L8.66172 2.70703C9.09689 2.70703 9.44971 3.06329 9.44971 3.50269C9.44971 3.9421 9.09689 4.29836 8.66172 4.29836L6.72263 4.12687C6.38125 4.12687 6.10448 3.8474 6.10448 3.50269C6.10448 3.15741 6.38125 2.87852 6.72263 2.87852"  />
                                                            <path fill="currentColor" d="M0.211141 2.91007C0.241448 2.87946 0.354671 2.75012 0.461032 2.64273C1.08147 1.97005 2.70147 0.870096 3.54893 0.533469C3.67759 0.479771 4.00297 0.365445 4.17738 0.357361C4.34378 0.357361 4.50275 0.396047 4.65429 0.472264C4.84356 0.579084 4.99453 0.747686 5.07801 0.946313C5.1312 1.08374 5.21468 1.49658 5.21468 1.50409C5.2976 1.95504 5.34277 2.68834 5.34277 3.49902C5.34277 4.27043 5.2976 4.97371 5.22955 5.43217C5.22212 5.44025 5.13863 5.95241 5.04771 6.12794C4.8813 6.44898 4.55593 6.6476 4.20768 6.6476H4.17738C3.95036 6.6401 3.47345 6.44089 3.47345 6.43396C2.67117 6.09734 1.08948 5.0505 0.453598 4.35473C0.453598 4.35473 0.274042 4.17574 0.196273 4.0643C0.0750442 3.90378 0.0144299 3.70515 0.0144299 3.50652C0.0144299 3.2848 0.082478 3.07867 0.211141 2.91007"  />
                                                        </svg>
                                                    </a>
                                                    <a class="absolute -top-1 left-0 overflow-hidden shadow-sm rounded w-14 h-14" href="blog/article/<?= $news['slug'] ?>">
                                                        <img class="w-full h-full object-cover transform transition duration-200 hover:scale-110" src="public/images/blog/<?= $news['cover'] ?>" alt="تصویر <?= $news['title'] ?>" onerror="this.src='public/images/default_cover.jpg'" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="xl:col-span-18 lg:col-span-16 lg:order-2 col-span-12 order-1 mb-5">
                    <div class="flex items-center mb-4 ">
                        <img src="public/images/archive_image.png" alt="آرشیو مطالب"/>
                        <h1 class="text-biscay-700 dark:text-white sm:text-3xl text-2xl font-bold" id="articles-page">آرشیو مطالب <?= (isset($_GET['author']) and $_GET['author']!="" and is_numeric($_GET['author'])) ? $data['getNews']['0']['writer']:"" ?></h1>
                    </div>
                    <div class="grid xl:grid-cols-3 lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 lg:gap-8 md:gap-16 sm:gap-4 sm:gap-y-4 gap-y-8">
                        <?php if(sizeof($data['getNews'])>0){ ?>
                            <?php foreach($data['getNews'] as $news){ ?>
                                <?php require('app/views/template/default/items/blog-item.php'); ?>
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

                    <?php if(sizeof($data['getNews'])>0){ ?>
                        <div class="mt-12 mb-12">
                            <div class="w-full">
                                <?= $data['itemsPagination'] ?>
                            </div>
                        </div>
                    <?php } ?>
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