<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>وضعیت رزرو نوبت | <?= $data['getPublicInfo']['site']; ?></title>
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

    <style>
        .screen a {
            text-decoration: none !important;
            background: #5ae9ba;
            border: 1px solid #34e2a9;
            box-shadow: 0 3px 20px 0 rgba(90, 233, 186, 0.6);
            border-radius: 100px;
            font-weight: 500;
            color: #fff;
            padding: 10px 25px;
            margin-top: 20px;
            opacity: 0;
            font-size: 13px;
            cursor: pointer;
        }

        .screen .red-button {
            background: #F86969;
            border: 1px solid #e75959;
            box-shadow: 0 3px 13px 0 rgba(248,105,105,0.60);
        }

        .day{padding-bottom: 10px;padding-top: 10px;font-size: 48px;font-weight: bold;}
        .time{font-size: 28px;font-weight: bold;margin-top: 10px;}
        .stack-media-on-mobile {display: block !important;}
        .stack-media-on-mobile .media-left{display: block;}
        .calendar-date{box-shadow: 0 -2px 8px 0 rgb(0 0 0 / 5%), 0 4px 11px 0 rgb(0 0 0 / 15%);border-radius:25px;overflow:hidden;min-width:150px;text-align:center;margin:auto}
        .calendar-date .calendar-date-title{font-weight: bold;padding:10px;position:relative}
        .calendar-date .calendar-date-title:before,.calendar-date .calendar-date-title:after{content:'';position:absolute;width:16px;height:16px;left:30px;top:-9px;background:#f8f8f8;border-radius:50%}
        .calendar-date .calendar-date-title:after{left:auto;right:30px}
        .calendar-date .calendar-date-body{padding:10px;color:#92278f;border-radius:0 0 25px 25px;border:1px solid rgba(146,39,143,0.3);border-top:0}
        .calendar-date .calendar-date-body .day{font-size:50px}
    </style>

    <script type="application/ld+json">
        {
            "@context":"https:\/\/schema.org",
            "@type":"WebPage",
            "name":"<?= $data['page']['title']; ?>",
            "description":"<?= $data['page']['metaDescription']; ?>"
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
    <section>
        <div class="container">
            <div class="bg-white pt-12 md:px-14 mt-8 px-4 pb-16 dark:bg-dark-930 rounded-lg dark:shadow-whiteShadow shadow-terms-md text-gray-360 font-normal md:text-lg text-sm leading-9 mb-8">
                <?php if (!is_array($data['orderInfo'])) { ?>
                    <div id="messageForm" class="screen un" style="display: block;text-align: center">
                        <svg style="margin: auto" width="166" height="150" id="topIcon">
                            <g id="Shot" fill="none" fill-rule="evenodd">
                                <g id="shot2" transform="translate(-135 -157)">
                                    <g id="success-card" transform="translate(48 120)">
                                        <g id="Top-Icon" transform="translate(99.9 47.7)">
                                            <g id="Bubbles" fill="#F86969" style="visibility: visible;">
                                                <g id="bottom-bubbles" transform="matrix(1,0,0,1,0,76)" data-svg-origin="0 0.4172964096069336" style="opacity: 1;">
                                                    <ellipse id="Oval-Copy-3" cx="12.8571429" cy="13.2605405" rx="12.8571429" ry="12.8432432"></ellipse>
                                                    <ellipse id="Oval-Copy-4" cx="25.0714286" cy="34.4518919" rx="8.35714286" ry="8.34810811"></ellipse>
                                                    <ellipse id="Oval-Copy-6" cx="42.4285714" cy="31.2410811" rx="7.71428571" ry="7.70594595"></ellipse>
                                                </g>
                                                <g id="top-bubbles" transform="matrix(1,0,0,1,92,0)" data-svg-origin="0.5714282989501953 0" style="opacity: 1;">
                                                    <ellipse id="Oval" cx="13.4285714" cy="23.76" rx="12.8571429" ry="12.8432432"></ellipse>
                                                    <ellipse id="Oval-Copy" cx="37.8571429" cy="25.0443243" rx="5.14285714" ry="5.1372973"></ellipse>
                                                    <ellipse id="Oval-Copy-2" cx="30.1428571" cy="7.70594595" rx="7.71428571" ry="7.70594595"></ellipse>
                                                </g>
                                            </g>
                                            <g id="Circle" transform="translate(18.9 11.7)">
                                                <ellipse id="blue-color" cx="56.341267" cy="54.0791109" fill="#F86969" rx="51.2193336" ry="51.5039151"></ellipse>
                                                <ellipse id="border" cx="51.2283287" cy="51.5039151" stroke="#3C474D" stroke-width="5" rx="51.2193336" ry="51.5039151"></ellipse>
                                                <path stroke="#fff" id="svg_3" d="m36,68l32,-32m-32,0l32,32" stroke-width="6" stroke-miterlimit="10" stroke-linecap="round" fill="none"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <h3 style="margin-bottom: 25px; color: #F86969"><?= str_replace("error-","",$data['orderInfo']); ?></h3>
                        <a href="services" id="btnClick" class="red-button" style="opacity: 1;transform: matrix(1, 0, 0, 1, 70.9091, -96);">بازگشت به لیست خدمات</a>
                    </div>
                <?php } else { ?>
                    <div id="messageForm" class="screen un" style="display: block;text-align: center">
                        <svg style="margin: auto" width="166" height="150" id="topIcon"><g id="Shot" fill="none" fill-rule="evenodd"><g id="shot2" transform="translate(-135 -157)"><g id="success-card" transform="translate(48 120)"><g id="Top-Icon" transform="translate(99.9 47.7)"><g id="Bubbles" fill="#5AE9BA" style="visibility: visible;"><g id="bottom-bubbles" transform="matrix(1,0,0,1,0,76)" data-svg-origin="0 0.4172964096069336" style="opacity: 1;"><ellipse id="Oval-Copy-3" cx="12.8571429" cy="13.2605405" rx="12.8571429" ry="12.8432432"></ellipse><ellipse id="Oval-Copy-4" cx="25.0714286" cy="34.4518919" rx="8.35714286" ry="8.34810811"></ellipse><ellipse id="Oval-Copy-6" cx="42.4285714" cy="31.2410811" rx="7.71428571" ry="7.70594595"></ellipse></g><g id="top-bubbles" transform="matrix(1,0,0,1,92,0)" data-svg-origin="0.5714282989501953 0" style="opacity: 1;"><ellipse id="Oval" cx="13.4285714" cy="23.76" rx="12.8571429" ry="12.8432432"></ellipse><ellipse id="Oval-Copy" cx="37.8571429" cy="25.0443243" rx="5.14285714" ry="5.1372973"></ellipse><ellipse id="Oval-Copy-2" cx="30.1428571" cy="7.70594595" rx="7.71428571" ry="7.70594595"></ellipse></g></g><g id="Circle" transform="translate(18.9 11.7)"><ellipse id="blue-color" cx="56.341267" cy="54.0791109" fill="#5AE9BA" rx="51.2193336" ry="51.5039151"></ellipse><ellipse id="border" cx="51.2283287" cy="51.5039151" stroke="#3C474D" stroke-width="5" rx="51.2193336" ry="51.5039151"></ellipse><path id="bluetooth" fill="#FFF" fill-rule="nonzero" d="m47,69c0,0 0,0 0,0c-0.8,0 -1.6,-0.4 -2.2,-1l-13.1,-14c-1.1,-1.2 -1.1,-3.1 0.2,-4.2c1.2,-1.1 3.1,-1.1 4.2,0.2l10.9,11.6l20.9,-21.8c1.1,-1.2 3,-1.2 4.2,-0.1c1.2,1.1 1.2,3 0.1,4.2l-23,24.2c-0.6,0.6 -1.4,0.9 -2.2,0.9z"></path></g></g></g></g></g></svg>
                        <h3 class="mb-5" style="color: #17921b">متشکریم ، نوبت شما باموفقیت ثبت شد و پس از تایید مدیر سایت از طریق پیامک نتیجه اطلاع رسانی خواهد شد.</h3>

                        <p class="nb-sb-detail mb-5">شماره پیگیری نوبت : <?= $data['orderInfo']['order_service_vids_id']; ?></p>

                        <div class="media mb-5 stack-media-on-mobile " style="width: 210px;max-width: 760px;margin: 10px auto 40px;">
                            <div class="media-left">
                                <div class="calendar-date">
                                    <?php
                                    $date = explode("/", $data['orderInfo']['sre_date']);
                                    $time = jmktime(0, 0, 0, $date[1], $date[2], $date[0]);
                                    $dateInfo = jgetdate($time, "", '', 'en');
                                    ?>
                                    <div class="calendar-date-title bg-blue-700 text-white dark:bg-dark-900 text-xl"><?= $dateInfo['month'] ?></div>
                                    <div class="calendar-date-body">
                                        <div class="day text-blue-700"><?= $date[2] ?></div>
                                        <div class="day-name" style="color: #999"><?= $data['orderInfo']['sre_day']; ?></div>
                                        <div class="time text-blue-700"><?= $data['orderInfo']['sre_time']; ?></div>
                                        <div style="color: #999">ساعت</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex md:flex-row flex-col items-center xl:justify-center justify-center">
                        <a href="user/reservations/details/<?= $data['orderInfo']['order_service_vids_id']; ?>" class="md:w-auto w-full md:ml-8 md:mb-0 mb-6 group flex items-center justify-center rounded-lg border border-blue-700 h-16 px-7 font-semibold text-xl dark:hover:bg-transparent dark:hover:border-blue-950 dark:hover:text-blue-950 dark:bg-blue-950 bg-blue-700 text-white transition duration-200 hover:bg-transparent hover:text-blue-700 hover:shadow-lg">
                            <svg class="ml-2.5 text-white group-hover:text-blue-700" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-current" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="white"></path>
                                <path class="fill-current" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="white"></path>
                            </svg>
                            مشاهده جزئیات
                        </a>

                        <a href="services/getCalendarFile/<?= $data['orderInfo']['order_service_vids_id']; ?>" style="cursor: pointer" class="md:w-auto w-full md:ml-8 md:mb-0 mb-6 group flex items-center justify-center rounded-lg border dark:hover:border-opacity-0 dark:hover:bg-blue-950 dark:hover:text-white dark:border-blue-950 dark:text-blue-950 border-blue-700 h-16 px-7 font-semibold text-xl text-blue-700 transition duration-200 hover:bg-blue-700 hover:text-white hover:shadow-lg">
                            <svg class="mb-3 ml-2.5 " width="25" height="25" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1792 23.9333C2.54046 23.9333 0.474609 21.8674 0.474609 12.2287C0.474609 2.59002 2.54046 0.52417 12.1792 0.52417C21.8178 0.52417 23.8837 2.59002 23.8837 12.2287C23.8837 21.8674 21.8178 23.9333 12.1792 23.9333ZM11.2038 6.37644C11.2038 5.83773 11.6405 5.40106 12.1792 5.40106C12.7178 5.40106 13.1545 5.83773 13.1545 6.37644V11.2533H18.0314C18.5701 11.2533 19.0068 11.69 19.0068 12.2287C19.0068 12.7674 18.5701 13.2041 18.0314 13.2041H12.1792C11.6405 13.2041 11.2038 12.7674 11.2038 12.2287V6.37644Z" fill="currentColor"></path>
                            </svg>
                            فایل استاندارد تقویم (.ics)
                        </a>

                        <a target="_blank" href="https://www.google.com/calendar/render?action=TEMPLATE&text=رزرو خدمت <?= $data['orderInfo']['s_title']; ?>&dates=<?= Model::jaliliToMiladi($data['orderInfo']['sre_date'], "/", "") ; ?>%2B0430<?= str_replace(":","",$data['orderInfo']['sre_time']); ?>00%2F<?= Model::jaliliToMiladi($data['orderInfo']['sre_date'], "/", "") ; ?>%2B0430<?= str_replace(":","",$data['orderInfo']['sre_time']); ?>00&details=رزرو خدمت <?= $data['orderInfo']['s_title']; ?> برای روز <?= $data['orderInfo']['sre_day']; ?> <?= $data['orderInfo']['sre_date']; ?> ساعت <?= $data['orderInfo']['sre_time']; ?>" style="cursor: pointer" class="md:w-auto w-full md:ml-8 md:mb-0 mb-6 group flex items-center justify-center rounded-lg border dark:hover:border-opacity-0 dark:hover:bg-blue-950 dark:hover:text-white dark:border-blue-950 dark:text-blue-950 border-blue-700 h-16 px-7 font-semibold text-xl text-blue-700 transition duration-200 hover:bg-blue-700 hover:text-white hover:shadow-lg">
                            <svg class="mb-3 ml-2.5 " width="25" height="25" viewBox="0 0 32 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1792 23.9333C2.54046 23.9333 0.474609 21.8674 0.474609 12.2287C0.474609 2.59002 2.54046 0.52417 12.1792 0.52417C21.8178 0.52417 23.8837 2.59002 23.8837 12.2287C23.8837 21.8674 21.8178 23.9333 12.1792 23.9333ZM11.2038 6.37644C11.2038 5.83773 11.6405 5.40106 12.1792 5.40106C12.7178 5.40106 13.1545 5.83773 13.1545 6.37644V11.2533H18.0314C18.5701 11.2533 19.0068 11.69 19.0068 12.2287C19.0068 12.7674 18.5701 13.2041 18.0314 13.2041H12.1792C11.6405 13.2041 11.2038 12.7674 11.2038 12.2287V6.37644Z" fill="currentColor"></path>
                            </svg>
                            ثبت رخداد در تقویم گوگل
                        </a>
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
