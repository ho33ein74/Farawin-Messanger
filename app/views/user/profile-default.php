<?php
$activeMenu = 'profile';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <base href="<?= URL; ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>اطلاعات حساب | <?= $data['getPublicInfo']['site']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta hreflang="fa-IR" href="<?= URL; ?>user" rel="alternate"/>
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
                <section wire:id="HHnOpJ41ST70pGcgivJt" x-data="{type:window.Livewire.find('HHnOpJ41ST70pGcgivJt').entangle('type')}" class="lg:grid lg:grid-cols-24 lg:gap-6 flex flex-col">
                    <div wire:loading class="fixed top-0 left-0 h-screen w-screen flex bg-biscay-700 bg-opacity-10 backdrop-filter backdrop-blur-sm  items-center justify-center z-50">
                        <div class="absolute top-0    right-0 w-full h-full flex items-center justify-center">

                            <svg class="w-16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">

                                <circle class="stroke-current text-red-450 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8"  stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300">

                                </circle>
                                <circle class="stroke-current text-red-450" cx="50" cy="50" r="20" fill="none" stroke-width="8"  stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200" >
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                                    <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                                    <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                                </circle>
                            </svg>
                        </div>
                    </div>
                    <div class="xl:col-span-24 col-span-24">
                        <div class="bg-white dark:bg-dark-920 rounded-2xl md:px-11 px-3 sm:py-8 py-2">
                            <form onsubmit="return false;">
                                <div class="flex flex-col">
                                    <div>
                                        <div class="mb-10  last:mb-0">
                                            <div>
                                                <h2 class="text-dark-550  dark:text-white font-bold flex items-center mb-3 text-2xl">
                                                    <i class="w-2 h-2 bg-gray-350 dark:bg-white ml-2 rounded-full "></i>
                                                    اطلاعات حساب
                                                </h2>
                                            </div>
                                            <div>

                                                <div class="grid md:grid-cols-2 grid-cols-1 md:gap-x-14 gap-y-6">
                                                    <div class="flex flex-col">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="fname">
                                                            نام (فارسی)
                                                        </label>
                                                        <input id="fname" name="fname" value="<?= $data['infoUser']['c_name'] ?>" class=" h-10 pl-36 placeholder-gray-320 w-full bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-350 px-3 font-medium dark:!bg-dark-900 dark:!text-white  focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100" placeholder="نام خود را وارد کنید" type="text">
                                                    </div>

                                                    <div class="flex flex-col">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="lname">
                                                            نام خانوادگی (فارسی)
                                                        </label>
                                                        <input id="lname" name="lname" value="<?= $data['infoUser']['c_family'] ?>" class=" h-10 pl-36 placeholder-gray-320 w-full bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-350 px-3 font-medium dark:!bg-dark-900 dark:!text-white  focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100" placeholder="نام خانوادگی خود را وارد کنید" type="text">
                                                    </div>

                                                    <div class="flex flex-col opacity-40">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="">
                                                            شماره موبایل
                                                        </label>
                                                        <input style="direction: ltr;" value="<?= $data['infoUser']['c_mobile_num'] ?>" disabled="disabled" class="cursor-not-allowed h-10 dark:!text-white placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-330 px-3 dark:!bg-dark-900 dark:!text-white  font-medium focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100" type="text">
                                                        <span class="text-dark-550 dark:text-gray-810 text-xs mt-2">در حال حاضر شماره موبایل قابل تغییر نمیباشد.</span>
                                                    </div>

                                                    <div class="flex flex-col">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="">
                                                            شماره تماس
                                                        </label>
                                                        <input id="phone_num"  name="phone_num" style="text-align: start;unicode-bidi: plaintext;" value="<?= $data['infoUser']['c_phone_num'] ?>" class="h-10 dark:!text-white placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-330 px-3 dark:!bg-dark-900 dark:!text-white  font-medium focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100" type="phone" placeholder="شماره تماس خود را وارد کنید" >
                                                    </div>

                                                    <div class="flex flex-col">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="email">
                                                            ایمیل
                                                        </label>
                                                        <input id="email" name="email" value="<?= $data['infoUser']['c_email'] ?>" style="text-align: start;unicode-bidi: plaintext;" class="h-10 dark:!text-white placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-330 px-3 dark:!bg-dark-900 dark:!text-white  font-medium focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100" placeholder="ایمیل خود را وارد کنید" type="email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-10  last:mb-0">
                                            <div>
                                                <h2 class="text-dark-550 dark:text-white font-bold flex items-center mb-3 text-2xl">
                                                    <i class="w-2 h-2 bg-gray-350 dark:bg-white ml-2 rounded-full "></i>
                                                    اطلاعات فردی
                                                </h2>
                                            </div>
                                            <div>
                                                <div class="grid md:grid-cols-2 grid-cols-1 md:gap-x-14 gap-y-6">

                                                    <div class="flex flex-col ">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="provinceId">
                                                            استان
                                                        </label>
                                                        <select id="provinceId" name="provinceId" class="h-10 placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-330 px-3 font-medium dark:!bg-dark-900 dark:!text-white focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100">
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['provinces'] as $province) { ?>
                                                                <option <?= $data['infoUser']['province_id'] == $province['pro_id'] ? "selected":"" ?> data-id="<?= $province['pro_id']; ?>" value="<?= $province['pro_id']; ?>"><?= $province['pro_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="flex flex-col ">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="provinceId">
                                                            شهر
                                                        </label>
                                                        <select id="cityId" name="cityId" class="h-10 placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg  transition duration-200 text-sm text-gray-330 px-3 font-medium dark:!bg-dark-900 dark:!text-white focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100">
                                                            <option value="" disabled="" selected="" hidden=""></option>
                                                            <?php foreach ($data['city'] as $city) { ?>
                                                                <option <?= $data['infoUser']['city_id'] == $city['id'] ? "selected":"" ?> data-id="<?= $city['pro_id']; ?>" value="<?= $city['id']; ?>"><?= $city['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class=" flex flex-col ">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="">
                                                            تاریخ تولد
                                                        </label>
                                                        <input type="hidden" name="" class="hidden_input">
                                                        <div class="  h-10 bg-gray-350 bg-opacity-10 ltr rounded-lg flex justify-around items-center dark:!bg-dark-900 dark:!text-white ">
                                                            <input id="birth_year" name="birth_year" max value="<?= json_decode($data['infoUser']['c_birthday'], true)['year'] ?>" class="next_inputs w-12 dark:text-white h-10 border-transparent bg-transparent px-1 border-none placeholder-gray-330 text-center" placeholder="سال" type="number" maxlength="4">
                                                            <span class="text-dark-550 dark:text-gray-810 text-xs">/</span>
                                                            <input id="birth_month" name="birth_month" value="<?= json_decode($data['infoUser']['c_birthday'], true)['month'] ?>" class="next_inputs w-12 h-10 dark:text-white border-transparent bg-transparent px-1 border-none placeholder-gray-330 text-center" placeholder="ماه" type="number" maxlength="2">
                                                            <span class="text-dark-550 dark:text-gray-810 text-xs">/</span>
                                                            <input id="birth_day" name="birth_day" value="<?= json_decode($data['infoUser']['c_birthday'], true)['day'] ?>" class="next_inputs w-12 h-10 dark:text-white border-transparent bg-transparent px-1 border-none placeholder-gray-330 text-center" placeholder="روز" type="number" maxlength="2">
                                                        </div>

                                                    </div>

                                                    <div class="flex flex-col ">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="">
                                                            شماره کارت
                                                        </label>
                                                        <div wire:ignore="">
                                                            <div class="iti iti--allow-dropdown iti--separate-dial-code">
                                                                <div class="iti__flag-container">
                                                                    <div class="iti__selected-flag" role="combobox"
                                                                         aria-controls="iti-0__country-listbox"
                                                                         aria-owns="iti-0__country-listbox"
                                                                         aria-expanded="false" tabindex="0"
                                                                         title="لوگوی بانک"
                                                                         aria-activedescendant="iti-0__item-ir">
                                                                        <div class="iti__flag iti__ir">
                                                                            <img id="bankLogo" style="width: 20px"  src="public/images/onlinePayment3.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input id="no_card" name="no_card" maxlength="19" onkeyup="setBankLogo();" value="<?= $data['infoUser']['c_cart_no'] ?>"
                                                                       class="h-10 pl-10 pt-3 text-left ltr dark:!bg-dark-900 dark:!text-white bg-gray-350 bg-opacity-10 w-full rounded-lg border border-transparent"
                                                                       type="tel" autocomplete="off"
                                                                       data-intl-tel-input-id="0"
                                                                       style="padding-left: 38px;">
                                                            </div>
                                                        </div>
                                                        <span class="text-dark-550 dark:text-gray-810 text-xs mt-2">در صورت نیاز به بازگشت وجه از طریق شماره کارت شما.</span>
                                                    </div>


                                                    <div class="flex flex-col md:col-span-2">
                                                        <label class="text-dark-550 dark:text-gray-810 text-sm mb-1 font-medium pr-3" for="">
                                                            درباره من
                                                        </label>
                                                        <textarea id="about" name="about" placeholder="توضیحی مختصر در مورد خودتان بنویسید." class="  h-36 placeholder-gray-320 bg-gray-350 bg-opacity-10 rounded-lg dark:!bg-dark-900 dark:!text-white  transition duration-200 text-sm text-gray-330 px-3 font-medium focus:bg-blue-700 focus:bg-opacity-10 border border-blue-700 border-opacity-0 focus:border-opacity-100 " cols="30" rows="10"><?= $data['infoUser']['c_about'] ?></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="btnsubmit" class="py-2 self-end px-4 text-white bg-blue-700 rounded border border-blue-700 dark:hover:bg-transparent transition duration-200 hover:bg-white hover:text-blue-700 hover:shadow-sm font-medium mt-10">ثبت تغییرات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
</main>
<?php require('app/views/include/default/publicJS.php'); ?>
<script src="public/js/default/intl-tel.js?id=c55ea6471246dd9edccb"></script>
<script src="public/js/default/nextInput.js?id=d1986e66d28cdf27954b"></script>
<script src="public/js/iban.js"></script>
<script>
    window.Alpine.start();
</script>

<script>
    function getCity(th, id) {
        var timeout_iter = 0;

        jQuery.ajax({
            url: "user/getCityByProvince",
            data: {
                states: $(th).find(':selected').attr('data-id')
            },
            type: 'POST',
            success: function (json) {
                $('#'+id).html('');
                $('#'+id).val(null).trigger("change");

                $.each(json, function (key, value) {
                    $.each(value, function (key, item) {
                        $('#'+id).append($('<option>', {
                            value: item.id,
                            text: item.name,
                            "data-name": item.name
                        }));
                    });
                });
            },
        });
    }

    $(document).on('change', '#provinceId', function (e) {
        getCity(this, "cityId");
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        setBankLogo();
    });
</script>

<script>
    $(document).ready(function() {
        $("#no_card").inputFilter(function(value) {
            return /^[0-9,-]*$/.test(value);    // Allow digits only, using a RegExp
        });
    });
</script>

<script>
    $("#btnsubmit").on('click', function () {
        var fname = document.getElementById("fname").value;
        var lname = document.getElementById("lname").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone_num").value;
        var provinceId = document.getElementById("provinceId").value;
        var cityId = document.getElementById("cityId").value;
        var birth_year = document.getElementById("birth_year").value;
        var birth_month = document.getElementById("birth_month").value;
        var birth_day = document.getElementById("birth_day").value;
        var no_card = document.getElementById("no_card").value;
        var about = document.getElementById("about").value;

        if (fname == "") {
            warningtoast.fire({title: 'نام خود را به فارسی وارد نمایید.'});
        } else if (lname == "") {
            warningtoast.fire({title: 'نام خانوادگی خود را به فارسی وارد نمایید.'});
        } else if (phone == "") {
            warningtoast.fire({title: 'شماره تماس خود را وارد نمایید.'});
        } else if (provinceId == "0" || provinceId == "") {
            warningtoast.fire({title: 'استان خود را انتخاب نمایید.'});
        } else if (cityId == "0" || cityId == "") {
            warningtoast.fire({title: 'شهر خود را انتخاب نمایید.'});
        } else if (birth_year == "") {
            warningtoast.fire({title: 'سال تولد خود را وارد نمایید.'});
        } else if (birth_year.length != 4) {
            warningtoast.fire({title: 'سال تولد خود را به صورت یک عدد 4 رقمی وارد نمایید.'});
        } else if (birth_month == "") {
            warningtoast.fire({title: 'ماه تولد خود را انتخاب نمایید.'});
        } else if (birth_month.length != 2) {
            warningtoast.fire({title: 'ماه تولد خود را به صورت یک عدد 2 رقمی وارد نمایید.'});
        } else if (birth_day == "") {
            warningtoast.fire({title: 'روز تولد خود را انتخاب نمایید.'});
        } else if (birth_day.length != 2) {
            warningtoast.fire({title: 'روز تولد خود را به صورت یک عدد 2 رقمی وارد نمایید.'});
        } else if (no_card!="-" && !checkCartDigit(no_card.replace(/-/g, ""))) {
            warningtoast.fire({title: 'شماره کارت صحیح نمی باشد.'});
        } else {
            var formData = new FormData();
            formData.append("fname", fname);
            formData.append("lname", lname);
            formData.append("phone", phone);
            formData.append("email", email);
            formData.append("provinceId", provinceId);
            formData.append("cityId", cityId);
            formData.append("birth_year", birth_year);
            formData.append("birth_month", birth_month);
            formData.append("birth_day", birth_day);
            formData.append("no_card", no_card);
            formData.append("about", about);

            if (navigator.onLine) {
                $.ajax({
                    url: "user/editUserInfo",
                    data: formData,
                    type: "POST",
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        data = JSON.parse(data);

                        if (data.status == "ok") {
                            successtoast.fire({title: data.msg});
                        } else {
                            errortoast.fire({title: data.msg});
                        }
                    },
                });
            } else {
                warningtoast.fire({title:  'وضعیت شما آفلاین می باشد و امکان ویرایش وجود ندارد.'});
            }
        }
    });
</script>

</body>
</html>
