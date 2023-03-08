<?php
$activeMenu = 'financial';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>مالی و تراکنش ها  | <?= $data['getPublicInfo']['site']; ?></title>
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
                <div>
                    <div class="flex justify-between items-center mb-8 mt-8">
                        <h3 class="flex items-center md:text-26 text-xl dark:text-white text-biscay-700 font-semibold">
                            <i class="md:flex hidden w-2 h-2 dark:bg-white rounded-full bg-blue-700 ml-2"></i>
                            تاریخچه تراکنش ها
                        </h3>
                    </div>

                    <div class="rounded-2xl dark:bg-dark-920 bg-white">
                        <div class=" overflow-auto">
                            <?php if (sizeof($data['paymentLog']) > 0) { ?>
                                <table class="block dark:bg-dark-920 rounded-2xl min-w-900 pt-7 pb-9 px-10">
                                    <thead class="block pb-2 border-b border-biscay-400 border-opacity-10 mb-8">
                                    <tr class="grid grid-cols-12 ">
                                        <th class=" dark:text-white text-biscay-400  font-normal col-span-2">
                                                <span class="col-span-3 text-15 text-center">
                                                    شماره پیگیری
                                                </span>
                                        </th>
                                        <th class=" dark:text-white text-biscay-400 text-15 px-10 font-normal text-right col-span-5">
                                            شرح تراکنش
                                        </th>
                                        <th class=" dark:text-white text-biscay-400 text-15 font-normal col-span-2">
                                            مبلغ
                                        </th>
                                        <th class=" dark:text-white text-biscay-400 text-15 font-normal col-span-1">
                                            ساعت
                                        </th>
                                        <th class=" dark:text-white text-biscay-400 text-15 font-normal col-span-2 text-center">
                                            تاریخ
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="block">
                                    <?php foreach ($data['paymentLog'] as $item) { ?>
                                        <tr class="grid grid-cols-12 font-medium dark:bg-opacity-40 bg-opacity-10 rounded-lg  py-4 mb-4 last:mb-0 bg-green-700">
                                            <td class="col-span-2 flex items-center justify-center text-center border-l dark:border-gray-70 border-gray-800 border-opacity-30 dark:text-white text-gray-800 text-md">
                                                <?= $item['afterpay']; ?>
                                            </td>
                                            <td class="col-span-5 flex items-center dark:text-white text-gray-800 text-md px-5 border-l border-r dark:border-gray-70 border-gray-800 border-opacity-30">
                                                <p>
                                                    <?php
                                                    if ($item['type'] == "cash") {
                                                        $bank = "پرداخت به صندوق (نقدی)  برای درخواست ". $item['order_vids_id'];
                                                    } elseif ($item['type'] == "bank") {
                                                        $bank = "پرداخت از طریق درگاه پرداخت/کارتخوان برای درخواست ". $item['order_vids_id'];
                                                    } else {
                                                        $bank = "-";
                                                    }
                                                    ?>
                                                    <?= $bank; ?>
                                                </p>
                                            </td>
                                            <td class="col-span-2 flex items-center justify-center text-center border-l dark:border-gray-70 border-gray-800 border-opacity-30 dark:text-white text-gray-800 text-md">
                                                <?= number_format($item['price']); ?>
                                                <svg class="mr-1" width="14" height="20" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.39223 9.60081C2.01809 9.60081 2.46646 9.45602 2.73736 9.16644C3.00825 8.88621 3.16705 8.54059 3.21376 8.12958H2.55521C2.06947 8.12958 1.67247 8.0782 1.36421 7.97545C1.05595 7.8727 0.813083 7.71857 0.635601 7.51306C0.45812 7.30756 0.332014 7.06002 0.257285 6.77044C0.191897 6.47153 0.159203 6.13057 0.159203 5.74759C0.159203 5.38328 0.21058 5.03766 0.313332 4.71072C0.416085 4.37444 0.565543 4.08486 0.761707 3.84199C0.967212 3.59912 1.21942 3.40763 1.51834 3.26751C1.8266 3.11806 2.18156 3.04333 2.58323 3.04333C2.90083 3.04333 3.19974 3.0947 3.47998 3.19746C3.76955 3.30021 4.02176 3.46368 4.23661 3.68787C4.45146 3.91205 4.6196 4.2063 4.74103 4.5706C4.87181 4.93491 4.9372 5.37861 4.9372 5.90172V6.20997H5.94604C6.15154 6.20997 6.2543 6.51823 6.2543 7.13475C6.2543 7.79797 6.15154 8.12958 5.94604 8.12958H4.92318C4.89516 8.58729 4.79708 9.02166 4.62894 9.43267C4.4608 9.84368 4.22727 10.2033 3.92835 10.5116C3.63878 10.8198 3.28381 11.0627 2.86346 11.2402C2.44311 11.427 1.97606 11.5204 1.46229 11.5204H0.0891448L0.0050746 9.60081H1.39223ZM1.85462 5.60747C1.85462 5.83166 1.90133 5.99046 1.99474 6.08387C2.09749 6.16794 2.28431 6.20997 2.55521 6.20997H3.24178V5.81765C3.24178 5.46268 3.18106 5.21981 3.05963 5.08904C2.94753 4.95826 2.77005 4.89287 2.52718 4.89287C2.07881 4.89287 1.85462 5.13107 1.85462 5.60747ZM8.2548 6.20997C8.37623 6.20997 8.45563 6.2847 8.493 6.43416C8.5397 6.58362 8.56305 6.81715 8.56305 7.13475C8.56305 7.48037 8.5397 7.73258 8.493 7.89138C8.45563 8.05018 8.37623 8.12958 8.2548 8.12958H5.94286C5.82143 8.12958 5.74203 8.05485 5.70467 7.90539C5.65796 7.74659 5.63461 7.51306 5.63461 7.2048C5.63461 6.84984 5.65796 6.59763 5.70467 6.44817C5.74203 6.28937 5.82143 6.20997 5.94286 6.20997H8.2548ZM10.5673 6.20997C10.6887 6.20997 10.7681 6.2847 10.8055 6.43416C10.8522 6.58362 10.8755 6.81715 10.8755 7.13475C10.8755 7.48037 10.8522 7.73258 10.8055 7.89138C10.7681 8.05018 10.6887 8.12958 10.5673 8.12958H8.25534C8.13391 8.12958 8.05451 8.05485 8.01715 7.90539C7.97044 7.74659 7.94709 7.51306 7.94709 7.2048C7.94709 6.84984 7.97044 6.59763 8.01715 6.44817C8.05451 6.28937 8.13391 6.20997 8.25534 6.20997H10.5673ZM12.8798 6.20997C13.0012 6.20997 13.0806 6.2847 13.118 6.43416C13.1647 6.58362 13.188 6.81715 13.188 7.13475C13.188 7.48037 13.1647 7.73258 13.118 7.89138C13.0806 8.05018 13.0012 8.12958 12.8798 8.12958H10.5678C10.4464 8.12958 10.367 8.05485 10.3296 7.90539C10.2829 7.74659 10.2596 7.51306 10.2596 7.2048C10.2596 6.84984 10.2829 6.59763 10.3296 6.44817C10.367 6.28937 10.4464 6.20997 10.5678 6.20997H12.8798ZM15.1922 6.20997C15.3137 6.20997 15.3931 6.2847 15.4304 6.43416C15.4771 6.58362 15.5005 6.81715 15.5005 7.13475C15.5005 7.48037 15.4771 7.73258 15.4304 7.89138C15.3931 8.05018 15.3137 8.12958 15.1922 8.12958H12.8803C12.7589 8.12958 12.6795 8.05485 12.6421 7.90539C12.5954 7.74659 12.572 7.51306 12.572 7.2048C12.572 6.84984 12.5954 6.59763 12.6421 6.44817C12.6795 6.28937 12.7589 6.20997 12.8803 6.20997H15.1922ZM16.5099 6.20997C16.7808 6.20997 16.9723 6.14926 17.0844 6.02782C17.2058 5.89705 17.2665 5.69621 17.2665 5.42532V3.9681H19.046V5.57945C19.046 6.42949 18.8405 7.06936 18.4295 7.49905C18.0278 7.9194 17.4393 8.12958 16.664 8.12958H15.1928C15.0713 8.12958 14.9919 8.05485 14.9546 7.90539C14.9079 7.74659 14.8845 7.51306 14.8845 7.2048C14.8845 6.84984 14.9079 6.59763 14.9546 6.44817C14.9919 6.28937 15.0713 6.20997 15.1928 6.20997H16.5099ZM19.032 2.42681H17.3366V0.801454H19.032V2.42681ZM16.8742 2.42681H15.1788V0.801454H16.8742V2.42681ZM8.94465 19.7372C8.94465 20.279 8.86058 20.7788 8.69244 21.2365C8.53364 21.7036 8.30011 22.1052 7.99186 22.4415C7.6836 22.7778 7.30995 23.0393 6.87092 23.2262C6.43189 23.4223 5.94148 23.5204 5.39969 23.5204H4.47492C3.42871 23.5204 2.61603 23.1981 2.03688 22.5536C1.45773 21.9091 1.16815 21.0263 1.16815 19.9054V17.3553H2.93363V19.8213C2.93363 20.0922 2.96165 20.3351 3.0177 20.5499C3.07375 20.7741 3.16716 20.9609 3.29793 21.1104C3.43805 21.2692 3.6202 21.3906 3.84439 21.4747C4.07792 21.5588 4.36749 21.6008 4.71312 21.6008H5.32963C5.69394 21.6008 5.99285 21.5494 6.22638 21.4467C6.46925 21.3533 6.66074 21.2178 6.80086 21.0403C6.94098 20.8722 7.03906 20.676 7.09511 20.4518C7.15115 20.2277 7.17918 19.9895 7.17918 19.7372V15.9681H8.94465V19.7372ZM5.70795 15.814H3.8584V14.1186H5.70795V15.814ZM12.4954 20.1296C12.2245 20.1296 11.9676 20.0969 11.7248 20.0315C11.4819 19.9568 11.2671 19.8353 11.0802 19.6672C10.9028 19.4991 10.758 19.2795 10.6459 19.0086C10.5431 18.7284 10.4917 18.3828 10.4917 17.9718V11.4423H12.2712V17.5094C12.2712 17.9764 12.4767 18.21 12.8877 18.21H13.2661C13.4716 18.21 13.5743 18.5182 13.5743 19.1347C13.5743 19.798 13.4716 20.1296 13.2661 20.1296H12.4954ZM13.3335 18.21C13.6137 18.21 13.8379 18.1633 14.0061 18.0699C14.1742 17.9671 14.2583 17.7803 14.2583 17.5094V17.3553C14.2583 16.991 14.3143 16.6547 14.4264 16.3464C14.5385 16.0288 14.6973 15.7579 14.9028 15.5337C15.1083 15.3095 15.3605 15.1321 15.6594 15.0013C15.9584 14.8705 16.29 14.8051 16.6543 14.8051C17.0373 14.8051 17.3782 14.8705 17.6771 15.0013C17.976 15.1321 18.2236 15.3142 18.4197 15.5477C18.6252 15.7719 18.7794 16.0475 18.8821 16.3744C18.9942 16.692 19.0503 17.0423 19.0503 17.4253C19.0503 18.2847 18.8308 18.9526 18.3917 19.429C17.962 19.896 17.3829 20.1296 16.6543 20.1296C16.29 20.1296 15.935 20.0548 15.5894 19.9054C15.2531 19.7559 15.0056 19.5458 14.8468 19.2749C14.6693 19.5925 14.4404 19.8166 14.1602 19.9474C13.8799 20.0689 13.6044 20.1296 13.3335 20.1296H13.2634C13.142 20.1296 13.0626 20.0548 13.0252 19.9054C12.9785 19.7466 12.9552 19.5131 12.9552 19.2048C12.9552 18.8498 12.9785 18.5976 13.0252 18.4482C13.0626 18.2894 13.142 18.21 13.2634 18.21H13.3335ZM17.3408 17.5094C17.3408 17.3132 17.2941 17.1357 17.2007 16.9769C17.1073 16.8181 16.9252 16.7387 16.6543 16.7387C16.3834 16.7387 16.2012 16.8181 16.1078 16.9769C16.0144 17.1357 15.9677 17.3132 15.9677 17.5094C15.9677 17.9764 16.1966 18.21 16.6543 18.21C17.112 18.21 17.3408 17.9764 17.3408 17.5094Z" fill="currentColor"></path>
                                                </svg>
                                            </td>
                                            <td class="col-span-1 flex items-center justify-center text-center dark:text-white text-gray-800 text-md">
                                                <?= date("H:m:s", $item['time_payment']); ?>
                                            </td>
                                            <td class="col-span-2 flex items-center justify-center dark:text-white text-gray-800 text-md">
                                                <?= $item['date_payment']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div class=" overflow-auto">
                                    <div class="col-span-12 flex flex-col items-center mt-9">
                                        <span class="dark:text-gray-70 text-gray-350 font-bold text-28 mb-6 text-center">هیچ نتیجه ای یافت نشد!</span>
                                        <div class="mb-8">
                                            <?php require('app/views/template/default/items/empty-svg.php'); ?>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
<?php require('app/views/include/default/publicJS.php'); ?>
<script>
    window.Alpine.start();
</script>

</body>
</html>
