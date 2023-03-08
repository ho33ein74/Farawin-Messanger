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
                }
                ,{
                    "@type" : "BreadcrumbList",
                    "@id" : "<?= URL; ?><?= $data['page']['link']; ?>#breadcrumb",
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
                                "@id" : "<?= URL; ?><?= $data['page']['link']; ?>",
                                "url" : "<?= URL; ?><?= $data['page']['link']; ?>",
                                "name" : "<?= $data['page']['title']; ?>"
                            }
                        }
                    ]
                }
            ,{
                    "@type" : "CollectionPage",
                    "@id" : "<?= URL; ?><?= $data['page']['link']; ?>#webpage",
                    "url" : "<?= URL; ?><?= $data['page']['link']; ?>",
                    "name" : "<?= $data['page']['title']; ?>",
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
    <div wire:id="1LO3TH2lJHsgaLcbSkBd" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;1LO3TH2lJHsgaLcbSkBd&quot;,&quot;name&quot;:&quot;layouts.header.index&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;contact-us&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:{&quot;l841445419-0&quot;:{&quot;id&quot;:&quot;b6hZeB3kt4JMRPwGmTto&quot;,&quot;tag&quot;:&quot;section&quot;},&quot;l841445419-1&quot;:{&quot;id&quot;:&quot;Bwd81o4OjuGBuFWzhOiW&quot;,&quot;tag&quot;:&quot;form&quot;},&quot;l841445419-2&quot;:{&quot;id&quot;:&quot;gJjoPOjIO2HBr7P4f8M7&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-3&quot;:{&quot;id&quot;:&quot;Orxwzn2uQxWIDpcuxRlG&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-4&quot;:{&quot;id&quot;:&quot;WMMFUxw9GZxbjZ1AHmb3&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-5&quot;:{&quot;id&quot;:&quot;ewh46t7MTWxSHeEyHIt5&quot;,&quot;tag&quot;:&quot;div&quot;},&quot;l841445419-6&quot;:{&quot;id&quot;:&quot;m4KmkTHQWl7jQ8VnTm6e&quot;,&quot;tag&quot;:&quot;div&quot;}},&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;f673680d&quot;,&quot;data&quot;:{&quot;discount&quot;:{&quot;status&quot;:false,&quot;message&quot;:null}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;c819484d342aed8e25e38f86882fa78963e75d5370b33fb682df74e5a1f4868a&quot;}}">
        <section wire:id="b6hZeB3kt4JMRPwGmTto" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;b6hZeB3kt4JMRPwGmTto&quot;,&quot;name&quot;:&quot;layouts.header.message-box&quot;,&quot;locale&quot;:&quot;fa&quot;,&quot;path&quot;:&quot;contact-us&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;4fbd5db6&quot;,&quot;data&quot;:{&quot;message&quot;:{&quot;status&quot;:false,&quot;style&quot;:&quot;bg-green-700 text-white&quot;,&quot;message&quot;:&quot;\u06f3\u06f5 \u062f\u0631\u0635\u062f \u062a\u062e\u0641\u06cc\u0641 \u0648\u06cc\u0698\u0647 \u062a\u0627\u0628\u0633\u062a\u0627\u0646 \u062f\u0648\u0631\u0647\u200c\u0647\u0627\u06cc \u0646\u0642\u062f\u06cc \u0648 \u0639\u0636\u0648\u06cc\u062a \u0648\u06cc\u0698\u0647 \u0631\u0627\u06a9\u062a&quot;,&quot;moreLink_title&quot;:&quot;\u0627\u0637\u0644\u0627\u0639\u0627\u062a \u0628\u06cc\u0634\u062a\u0631&quot;,&quot;moreLink_link&quot;:&quot;&quot;}},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;aeb62755fb44a959f1f8e3eb513013815690f24ec100c159ce809cab035f8415&quot;}}" class="mt-4">
            <div class="container"></div>
        </section>
        <?php require('app/views/include/default/header.php'); ?>
    </div>
    <main class="pt-20 ">
        <section class="">
            <div class="container">
                <div class="flex flex-col items-center">
                    <div class="mb-16 flex flex-col items-center">
                        <h2 class="text-gray-800 dark:text-white sm:text-5xl text-3xl font-bold mb-2">
                            ارتباط با ما
                        </h2>
                        <h6 class="text-gray-300 dark:text-gray-200 text-center sm:text-2xl text-base ">
                            در این صفحه میتوانید اطلاعات ارتباطی ما را مشاهده کنید.
                        </h6>
                    </div>
                </div>
            </div>
        </section>



        <section class="mt-10 mb-10">
            <div class="container">
                <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-2 gap-10">
                    <div class="about_us_mey_team flex flex-col items-center border-2 transition duration-200 hover:shadow-sm border-blue-700 border-opacity-10 rounded-xl">
                        <div wire:id="l78NsajUR3phwbGY3Oxg" class="relative " style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                            <div class="bg-white dark:bg-dark-930 dark:shadow-whiteShadow rounded-xl shadow-sm lg:px-9 px-4 pt-9 pb-6">
                                <h3 class="flex items-center sm:text-3xl text-xl font-bold dark:text-white text-gray-800 mb-3">
                                    <svg class="ml-2 sm:w-8 sm:h-7 w-5 h-6" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.17756 2.63068C5.29428 4.24542 4.23977 6.52208 4.00501 9.31384C0.759826 9.66531 0 11.1943 0 15.8181C0 20.4194 0.752432 21.956 3.9577 22.3172C3.95562 22.3476 3.95456 22.3782 3.95456 22.4091C3.95456 26.0492 6.90559 29 10.5456 29H11.8637C12.5917 29 13.1818 28.4098 13.1818 27.6818C13.1818 26.9538 12.5917 26.3636 11.8637 26.3636H10.5456C8.36153 26.3636 6.59092 24.5931 6.59092 22.4091L6.5909 22.4012C10.9121 22.2912 11.8637 20.9925 11.8637 15.8181C11.8637 10.6718 10.9224 9.35923 6.66063 9.23703C6.89267 7.15658 7.69283 5.66164 8.89359 4.63209C10.3665 3.36921 12.6395 2.6364 15.7745 2.63637C18.9125 2.63634 21.2108 3.36213 22.7064 4.62554C23.9243 5.6543 24.7391 7.1493 24.9749 9.23705C20.7139 9.35941 19.7728 10.6721 19.7728 15.8181C19.7728 21.2458 20.8197 22.4091 25.7046 22.4091C30.5895 22.4091 31.6364 21.2458 31.6364 15.8181C31.6364 11.1941 30.8765 9.66515 27.6309 9.31379C27.392 6.50179 26.3141 4.22196 24.4077 2.61158C22.2674 0.803509 19.2711 -3.70837e-05 15.7744 1.2837e-09C12.2747 3.70863e-05 9.29683 0.813592 7.17756 2.63068Z" fill="currentColor"></path>
                                    </svg>
                                    فرم تماس باما
                                </h3>
                                <p class="mb-5 text-gray-20 dark:text-gray-920 sm:text-lg text-sm font-normal leading-7">
                                    در کنار روش&zwnj;هایی که برای ارتباط با ما در نظر گرفته&zwnj;ایم، شما همچنین می&zwnj;توانید از طریق فرم زیر پیام خود را برای ما ارسال کنید.
                                </p>
                                <form onsubmit="return false;" class="flex flex-col " wire:submit.prevent="contact/sendMessage" >
                                    <div class="flex flex-col mb-6 last:mb-0">
                                        <label class="text-gray-300 dark:text-gray-200 mr-4 text-sm mb-1" for="name">
                                            موضوع
                                        </label>
                                        <select id="title" class="dark:bg-dark-910 dark:text-gray-920 dark:border-opacity-0 bg-gray-210 px-4 bg-select-arrow bg-left-20 bg-2  sm:h-14 h-12 rounded-md text-sm font-medium text-gray-450  border border-gray-100  ">
                                            <?php foreach($data['contactSubject'] as $item){ ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="flex flex-col mb-6 last:mb-0">
                                        <label class="text-gray-300 dark:text-gray-200 mr-4 text-sm mb-1" for="name">
                                            نام و نام خانوادگی
                                        </label>
                                        <input placeholder="نام خود را وارد کنید"  wire:model.defer="name" class="bg-gray-300 d sm:h-12 h-10 text-sm text-dark-550 dark:border-opacity-0 dark:text-white dark:bg-dark-890 focus:font-bold  placeholder-gray-300 bg-opacity-10 rounded-md border border-gray-200 px-4 " type="text" id="name">
                                    </div>

                                    <div class="flex flex-col mb-6 last:mb-0">
                                        <label class="text-gray-300 dark:text-gray-200 mr-4 text-sm mb-1" for="email">
                                            ایمیل
                                        </label>
                                        <input placeholder="ایمیل خود را وارد کنید" wire:model.defer="email" class="bg-gray-300 sm:h-12 h-10 text-sm text-dark-550 focus:font-bold dark:border-opacity-0 dark:text-white dark:bg-dark-890  placeholder-gray-300 bg-opacity-10 rounded-md border  border-gray-200 px-4 " type="text" id="email">
                                    </div>

                                    <div class="flex flex-col mb-6 last:mb-0">
                                        <label class="text-gray-300 dark:text-gray-200 mr-4 text-sm mb-1" for="phone">
                                            شماره تماس
                                        </label>
                                        <input placeholder="شماره تماس خود را وارد کنید" wire:model.defer="phone" class="bg-gray-300 sm:h-12 h-10 text-sm text-dark-550 focus:font-bold dark:border-opacity-0 dark:text-white dark:bg-dark-890  placeholder-gray-300 bg-opacity-10 rounded-md border  border-gray-200 px-4 " type="tel" id="phone">
                                    </div>

                                    <div class="flex flex-col mb-6">
                                        <label class="text-gray-300 dark:text-gray-200 mr-4 text-sm mb-1" for="message">
                                            متن پیام
                                        </label>
                                        <textarea id="message" wire:model.defer="message" class="bg-gray-300 h-28 -28 max-h-28 text-sm text-dark-550 focus:font-bold dark:border-opacity-0 dark:text-white dark:bg-dark-890  placeholder-gray-300 bg-opacity-10 rounded-md border border-gray-200 px-4 " placeholder="متن خودتون رو برای ما ارسال کنید." cols="30" rows="10"></textarea>
                                    </div>

                                    <button id="formSubmit" type="submit" class="mt-6 bg-blue-700 dark:hover:bg-transparent h-12 dark:hover:text-blue-450 dark:hover:border-blue-450 sm:w-fit-content w-full px-12 flex self-end justify-center items-center text-white border border-blue-700 rounded font-medium transition duration-200 hover:text-blue-700 hover:bg-white">
                                        ارسال پیام
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="about_us_mey_team flex flex-col items-center border-2 transition duration-200 hover:shadow-sm border-blue-700 border-opacity-10 rounded-xl">
                        <div class="relative w-full h-full">
                            <?php if (
                                $data['getMethodsContacting']['phone']['mc_link'] != NULL OR
                                $data['getPublicInfo']['address'] != NULL OR
                                $data['getMethodsContacting']['youtube']['mc_link'] != NULL OR
                                $data['getMethodsContacting']['facebook']['mc_link'] != NULL OR
                                $data['getMethodsContacting']['twitter']['mc_link'] != NULL OR
                                $data['getMethodsContacting']['instagram']['mc_link'] != NULL OR
                                $data['getMethodsContacting']['telegram']['mc_link'] != NULL OR
                                $data['getMethodsContacting']['email']['mc_link'] != NULL
                            ) { ?>

                                <?php if (
                                    $data['getMethodsContacting']['phone']['mc_link'] != NULL OR
                                    $data['getPublicInfo']['address'] != NULL OR
                                    $data['getMethodsContacting']['youtube']['mc_link'] != NULL OR
                                    $data['getMethodsContacting']['facebook']['mc_link'] != NULL OR
                                    $data['getMethodsContacting']['twitter']['mc_link'] != NULL OR
                                    $data['getMethodsContacting']['instagram']['mc_link'] != NULL OR
                                    $data['getMethodsContacting']['telegram']['mc_link'] != NULL OR
                                    $data['getMethodsContacting']['email']['mc_link'] != NULL
                                ) { ?>
                                            <div class="lg:flex pt-8 pb-11 lg:space-y-0 space-y-6 bg-white dark:bg-dark-930 dark:shadow-whiteShadow rounded-2xl relative z-10 shadow-sm h-full">
                                                <div class="lg:px-11 w-full px-5 space-y-6 lg:border-l dark:border-opacity-10 dark:border-gray-920 border-gray-300 dark:border-gray-920 border-opacity-25 lg:text-right text-center">

                                                    <?php if ($data['getMethodsContacting']['phone']['mc_link'] != NULL) { ?>
                                                        <div class=" flex transition duration-200 opacity-20 send_suggest_contact_us">
                                                            <i class="lg:flex hidden bg-gray-800 dark:bg-white rounded-full w-2 h-2 ml-2 mt-3"></i>
                                                            <div class="lg:w-11/12 w-full">
                                                                <h5 class="text-gray-800  dark:text-white font-semibold mb-1 sm:text-26 text-22">
                                                                    شماره تماس
                                                                </h5>
                                                                <p class="text-gray-300 dark:text-gray-920  sm:text-22 text-base leading-8">
                                                                    <?= $data['getMethodsContacting']['phone']['mc_link']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($data['getPublicInfo']['address'] != NULL) { ?>
                                                        <div class=" flex transition duration-200 opacity-20 send_suggest_contact_us">
                                                            <i class="lg:flex hidden bg-gray-800 dark:bg-white rounded-full w-2 h-2 ml-2 mt-3"></i>
                                                            <div class="lg:w-11/12 w-full">
                                                                <h5 class="text-gray-800  dark:text-white font-semibold mb-1 sm:text-26 text-22">
                                                                    آدرس
                                                                </h5>
                                                                <p class="text-gray-300 dark:text-gray-920  sm:text-22 text-base leading-8">
                                                                    <?= $data['getPublicInfo']['address']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($data['getMethodsContacting']['email']['mc_link'] != NULL) { ?>
                                                        <div class=" flex transition duration-200 opacity-20 send_suggest_contact_us">
                                                            <i class="lg:flex hidden bg-gray-800 dark:bg-white rounded-full w-2 h-2 ml-2 mt-3"></i>
                                                            <div class="lg:w-11/12 w-full">
                                                                <h5 class="text-gray-800  dark:text-white font-semibold mb-1 sm:text-26 text-22">
                                                                    پل های ارتباطی
                                                                </h5>
                                                                <ul class="flex ">
                                                                    <?php if ($data['getMethodsContacting']['email']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['email']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="32" height="29" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M15.979 28.4996C3.17737 28.4996 0.433594 25.9845 0.433594 14.2496C0.433594 11.0245 0.640843 8.49572 1.20718 6.5242C2.65728 7.978 4.48714 9.72621 6.47465 11.2834C9.29349 13.4919 12.7074 15.5451 15.979 15.5451C19.2507 15.5451 22.6646 13.4919 25.4835 11.2834C27.471 9.72621 29.3008 7.978 30.7509 6.5242C31.3173 8.49572 31.5245 11.0245 31.5245 14.2496C31.5245 25.9845 28.7807 28.4996 15.979 28.4996Z"></path>
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M29.6219 3.98071C28.104 5.52774 26.0906 7.51629 23.8856 9.24387C21.108 11.42 18.3038 12.9542 15.979 12.9542C13.6543 12.9542 10.8501 11.42 8.07254 9.24387C5.86751 7.51629 3.85413 5.52774 2.33618 3.98071C4.39367 0.870955 8.44417 -0.000366211 15.979 -0.000366211C23.5139 -0.000366211 27.5644 0.870955 29.6219 3.98071Z"></path>
                                                                                </svg>
                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if (
                                                        $data['getMethodsContacting']['youtube']['mc_link'] != NULL OR
                                                        $data['getMethodsContacting']['facebook']['mc_link'] != NULL OR
                                                        $data['getMethodsContacting']['twitter']['mc_link'] != NULL OR
                                                        $data['getMethodsContacting']['instagram']['mc_link'] != NULL OR
                                                        $data['getMethodsContacting']['telegram']['mc_link'] != NULL
                                                    ) { ?>
                                                        <div class=" flex transition duration-200 opacity-20 send_suggest_contact_us">
                                                            <i class="lg:flex hidden bg-gray-800 dark:bg-white rounded-full w-2 h-2 ml-2 mt-3"></i>
                                                            <div class="lg:w-11/12 w-full">
                                                                <h5 class="text-gray-800  dark:text-white font-semibold mb-1 sm:text-26 text-22">
                                                                    شبکه های اجتماعی
                                                                </h5>
                                                                <ul class="flex ">
                                                                    <?php if ($data['getMethodsContacting']['youtube']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['youtube']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="35" height="25" viewBox="0 0 35 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M34.1845 5.59278C34.1845 5.59278 33.8547 3.26471 32.8391 2.24247C31.553 0.897065 30.1153 0.89047 29.4558 0.811329C24.7337 0.468384 17.644 0.468384 17.644 0.468384H17.6308C17.6308 0.468384 10.541 0.468384 5.81894 0.811329C5.15943 0.89047 3.7217 0.897065 2.43566 2.24247C1.42001 3.26471 1.09685 5.59278 1.09685 5.59278C1.09685 5.59278 0.753906 8.32974 0.753906 11.0601V13.619C0.753906 16.3494 1.09026 19.0864 1.09026 19.0864C1.09026 19.0864 1.42001 21.4144 2.42906 22.4367C3.71511 23.7821 5.40345 23.7359 6.15529 23.881C8.85928 24.1382 17.6374 24.2173 17.6374 24.2173C17.6374 24.2173 24.7337 24.2042 29.4558 23.8678C30.1153 23.7887 31.553 23.7821 32.8391 22.4367C33.8547 21.4144 34.1845 19.0864 34.1845 19.0864C34.1845 19.0864 34.5208 16.356 34.5208 13.619V11.0601C34.5208 8.32974 34.1845 5.59278 34.1845 5.59278ZM14.1486 16.7253V7.23496L23.2696 11.9966L14.1486 16.7253Z"></path>
                                                                                </svg>
                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <?php if ($data['getMethodsContacting']['facebook']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['facebook']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M29.6143 14.4298C29.6143 6.51203 23.1957 0.0933838 15.2779 0.0933838C7.36005 0.0933838 0.941406 6.51203 0.941406 14.4298C0.941406 21.5855 6.18401 27.5166 13.0378 28.5921V18.574H9.39767V14.4298H13.0378V11.2713C13.0378 7.67827 15.1782 5.69356 18.4529 5.69356C20.0209 5.69356 21.6621 5.97357 21.6621 5.97357V9.50168H19.8543C18.0735 9.50168 17.5179 10.6069 17.5179 11.7418V14.4298H21.4941L20.8584 18.574H17.5179V28.5921C24.3717 27.5166 29.6143 21.5855 29.6143 14.4298Z"></path>
                                                                                </svg>
                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <?php if ($data['getMethodsContacting']['twitter']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['twitter']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="fill-current text-blue-700  dark:text-blue-450 transition duration-200 group-hover:text-white" d="M10.4895 26.5915C22.619 26.5915 29.2552 16.5398 29.2552 7.82572C29.2552 7.54314 29.249 7.25428 29.2364 6.97171C30.5273 6.03811 31.6414 4.88173 32.5262 3.55689C31.324 4.09181 30.0474 4.44116 28.7403 4.59302C30.1166 3.76803 31.1471 2.47202 31.6408 0.94523C30.3461 1.71256 28.9301 2.25385 27.4536 2.54589C26.4588 1.48885 25.1435 0.788961 23.711 0.554438C22.2786 0.319914 20.8087 0.563814 19.5288 1.24843C18.2488 1.93304 17.23 3.02024 16.6299 4.34194C16.0298 5.66363 15.8819 7.1462 16.2089 8.56043C13.5871 8.42887 11.0223 7.74781 8.68071 6.56143C6.33909 5.37504 4.27293 3.7098 2.61617 1.67366C1.77411 3.12546 1.51645 4.84341 1.89553 6.47836C2.27461 8.11331 3.262 9.54258 4.65702 10.4757C3.60972 10.4424 2.58537 10.1605 1.66859 9.65307V9.7347C1.66765 11.2583 2.19436 12.7351 3.15918 13.9142C4.124 15.0934 5.46739 15.902 6.96098 16.2026C5.99082 16.4681 4.9726 16.5067 3.98511 16.3157C4.40657 17.6259 5.22659 18.7719 6.33071 19.5937C7.43484 20.4155 8.76798 20.8721 10.1441 20.8997C7.80786 22.7349 4.92196 23.7302 1.95116 23.7255C1.42432 23.7247 0.897992 23.6924 0.375 23.6288C3.39301 25.565 6.90375 26.5934 10.4895 26.5915Z"></path>
                                                                                </svg>

                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <?php if ($data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="30" height="29" viewBox="0 0 30 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M14.8147 2.65989C18.6227 2.65989 19.0736 2.67659 20.5712 2.74339C21.963 2.80463 22.7146 3.03846 23.2156 3.23331C23.8781 3.48941 24.3569 3.80117 24.8524 4.29666C25.3535 4.79771 25.6597 5.27093 25.9158 5.93343C26.1106 6.43448 26.3444 7.19163 26.4057 8.57787C26.4725 10.081 26.4892 10.532 26.4892 14.3344C26.4892 18.1424 26.4725 18.5934 26.4057 20.0909C26.3444 21.4828 26.1106 22.2343 25.9158 22.7354C25.6597 23.3979 25.3479 23.8767 24.8524 24.3722C24.3514 24.8732 23.8781 25.1794 23.2156 25.4355C22.7146 25.6304 21.9574 25.8642 20.5712 25.9254C19.068 25.9922 18.6171 26.0089 14.8147 26.0089C11.0067 26.0089 10.5557 25.9922 9.05812 25.9254C7.66631 25.8642 6.91473 25.6304 6.41368 25.4355C5.75118 25.1794 5.27239 24.8676 4.77691 24.3722C4.27586 23.8711 3.96966 23.3979 3.71356 22.7354C3.51871 22.2343 3.28489 21.4772 3.22365 20.0909C3.15684 18.5878 3.14014 18.1368 3.14014 14.3344C3.14014 10.5264 3.15684 10.0755 3.22365 8.57787C3.28489 7.18606 3.51871 6.43448 3.71356 5.93343C3.96966 5.27093 4.28142 4.79214 4.77691 4.29666C5.27796 3.7956 5.75118 3.48941 6.41368 3.23331C6.91473 3.03846 7.67188 2.80463 9.05812 2.74339C10.5557 2.67659 11.0067 2.65989 14.8147 2.65989ZM14.8147 0.0933838C10.9454 0.0933838 10.4611 0.110086 8.94121 0.176893C7.42692 0.2437 6.38584 0.488658 5.48395 0.839395C4.54308 1.20683 3.74697 1.69118 2.95642 2.4873C2.1603 3.27785 1.67595 4.07397 1.30851 5.00927C0.957775 5.91673 0.712816 6.95223 0.646009 8.46653C0.579202 9.99195 0.5625 10.4763 0.5625 14.3455C0.5625 18.2148 0.579202 18.6991 0.646009 20.219C0.712816 21.7333 0.957775 22.7744 1.30851 23.6763C1.67595 24.6171 2.1603 25.4132 2.95642 26.2038C3.74697 26.9943 4.54308 27.4842 5.47838 27.8461C6.38584 28.1969 7.42135 28.4418 8.93564 28.5086C10.4555 28.5754 10.9399 28.5921 14.8091 28.5921C18.6783 28.5921 19.1627 28.5754 20.6825 28.5086C22.1968 28.4418 23.2379 28.1969 24.1398 27.8461C25.0751 27.4842 25.8712 26.9943 26.6618 26.2038C27.4523 25.4132 27.9422 24.6171 28.3041 23.6818C28.6548 22.7744 28.8998 21.7388 28.9666 20.2246C29.0334 18.7047 29.0501 18.2203 29.0501 14.3511C29.0501 10.4819 29.0334 9.99752 28.9666 8.47766C28.8998 6.96337 28.6548 5.92229 28.3041 5.0204C27.9534 4.07397 27.469 3.27785 26.6729 2.4873C25.8824 1.69675 25.0862 1.20683 24.1509 0.844962C23.2435 0.494226 22.208 0.249267 20.6937 0.18246C19.1682 0.110086 18.6839 0.0933838 14.8147 0.0933838Z"></path>
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M14.8147 7.02461C10.7728 7.02461 7.49373 10.3037 7.49373 14.3455C7.49373 18.3874 10.7728 21.6665 14.8147 21.6665C18.8565 21.6665 22.1356 18.3874 22.1356 14.3455C22.1356 10.3037 18.8565 7.02461 14.8147 7.02461ZM14.8147 19.0944C12.1925 19.0944 10.0658 16.9677 10.0658 14.3455C10.0658 11.7234 12.1925 9.59668 14.8147 9.59668C17.4368 9.59668 19.5635 11.7234 19.5635 14.3455C19.5635 16.9677 17.4368 19.0944 14.8147 19.0944Z"></path>
                                                                                    <path class="fill-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M24.1342 6.73496C24.1342 7.68139 23.366 8.44411 22.4251 8.44411C21.4787 8.44411 20.7159 7.67583 20.7159 6.73496C20.7159 5.78853 21.4842 5.02581 22.4251 5.02581C23.366 5.02581 24.1342 5.79409 24.1342 6.73496Z"></path>
                                                                                </svg>

                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                    <?php if ($data['getMethodsContacting']['telegram']['mc_link'] != NULL) { ?>
                                                                        <li class="sm:ml-6 ml-3 last:ml-0 ">
                                                                            <a class="sm:w-16 sm:h-16 w-12 h-12  bg-blue-700 bg-opacity-10 rounded-lg flex items-center justify-center group transition duration-200 hover:bg-opacity-100" href="<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>">
                                                                                <svg class="transform scale-75" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path class="stroke-current text-blue-700 dark:text-blue-450 transition duration-200 group-hover:text-white" d="M12.0502 17.9195L15.2016 14.772M12.0502 17.9195C9.74004 20.2311 0.0218845 16.1675 1.76708 11.0284C3.51228 5.88928 22.624 -0.386194 26.4872 3.47943C30.3505 7.34506 24.0504 26.5287 18.9371 28.209C13.8239 29.8893 9.74004 20.2311 12.0502 17.9195Z" stroke-width="2.84987" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </a>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-16 mt-10">
            <div class="container">
                <div class="content relative">
                    <a class="relative w-full sm:h-600 h-64 inline-block overflow-hidden rounded-2xl">
                        <iframe src="<?= $data['getPublicInfo']['location']; ?>" class="w-full h-full object-cover" width="305" height="236" frameborder="0" style="border:0;position: relative;border-radius: 4px;" allowfullscreen></iframe>
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php require('app/views/include/default/footer.php'); ?>
</div>
<?php require('app/views/include/default/publicJS.php'); ?>
<script>
    window.Alpine.start();
</script>

<script type="text/javascript">
    function validateEmail(val)
    {
        var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(val))
        {
            return false;
        }
        return true;
    }

    $("#formSubmit").on('click', function () {
        var title = document.getElementById("title").value;
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var message = document.getElementById("message").value;
        if (name == "") {
            warningtoast.fire({title: "لطفا نام و نام خانوادگی خود را وارد کنید"});
        } else if (email == "") {
            warningtoast.fire({title: "لطفا ایمیل خود را وارد کنید"});
        } else if (!validateEmail(email)) {
            warningtoast.fire({title: "لطفا یک ایمیل معتبر وارد کنید"});
        } else if (phone == "") {
            warningtoast.fire({title: "لطفا شماره تماس خود را وارد کنید"});
        } else if (message == "") {
            warningtoast.fire({title: "لطفا متن پیام را وارد کنید"});
        } else {
            var formData = new FormData();
            formData.append("title", title);
            formData.append("name", name);
            formData.append("email", email);
            formData.append("phone", phone);
            formData.append("message", message);
            $.ajax({
                url: "contact/sendMessage",
                data: formData,
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = JSON.parse(data);

                    if (data.status == "ok") {
                        successtoast.fire({title: data.msg});
                        document.getElementById('message').value = '';
                    } else {
                        errortoast.fire({title: data.msg})
                    }
                },
            });
        }
    });
</script>

</body>
</html>