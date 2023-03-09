<?php if($data['getPublicInfo']['notification'] == "1"){ ?>
    <section class="mt-4">
        <div class="container ">
            <?php
            if ($data['getPublicInfo']['notification_text_position'] == "center") {
                $notification_text_position = "column";
            } else if ($data['getPublicInfo']['notification_text_position'] == "left") {
                $notification_text_position = "row-reverse";
            } else {
                $notification_text_position = "unset";
            }
            ?>
            <div style="background: <?= $data['getPublicInfo']['notification_background_color']!="" ? $data['getPublicInfo']['notification_background_color']:"#FCD34D"; ?>;flex-direction: <?= $notification_text_position ?>;" class="flex items-center justify-between md:flex-row flex-col rounded-lg py-4 relative pl-5 lg:pr-7 pr-5 lg:mx-9 dark:bg-dark-930 dark:shadow-whiteShadow bg-yellow-300 text-yellow-700  ">
                <div class="flex items-center md:flex-row flex-col">
                    <div class="flex items-center sm:flex-row flex-col">
                        <p class="font-medium sm:text-right text-center lg:text-lg text-15 lg:ml-4 ml-2 sm:mb-0 sm:mt-0 mt-2 mb-2" style="color: <?= $data['getPublicInfo']['notification_text_color']!="" ? $data['getPublicInfo']['notification_text_color']:"#B45309"; ?>">
                            <?= $data['getPublicInfo']['notification_message']; ?>
                        </p>
                    </div>
                </div>
            </div>                               
        </div>
    </section>
<?php } ?>

<header class="pt-4" x-data="{ menuSate : false }" @menu-active.window="menuSate = true" @menu-hide.window="menuSate = false">
    <div class="container">
        <div class="flex items-center justify-between bg-white dark:bg-dark-890 sm:px-11 sm:py-9 p-5 rounded-2xl shadow-headerSecOne relative">
            <div class="lg:hidden" @click="$dispatch('body-overflow-active') , $dispatch('overlay-show') , $dispatch('menu-active')">
                <svg width="24" class="text-biscay-700 dark:text-white" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 2.5H21.5M2 9H21.5M2 15.5H21.5" stroke="currentColor" stroke-width="3.65625" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <div>
                <a href="<?= URL; ?>">
                    <img class="hidden sm:dark:hidden dark:inline-block sm:ml-0 -ml-6" width="90" src="public/images/logos/<?= $data['getPublicInfo']['logo_square_dark'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                    <img class="hidden sm:dark:inline-block" width="220" src="public/images/logos/<?= $data['getPublicInfo']['logo_dark'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">

                    <img class="sm:hidden sm:inline-block dark:hidden sm:ml-0 -ml-6" width="90" src="public/images/logos/<?= $data['getPublicInfo']['logo_square'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                    <img class="hidden sm:inline-block dark:hidden" width="220" src="public/images/logos/<?= $data['getPublicInfo']['logo'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                </a>
            </div>
            <form wire:id="wt7Tzbfu4P8Yg9I4CPmf" action="search" x-data="{ searchBox : true , keyword : window.Livewire.find('wt7Tzbfu4P8Yg9I4CPmf').entangle('keyword') }" class="items-center relative w-6/12 mx-auto lg:flex hidden z-50" @click.away="keyword = '' , searchBox = false" :class="searchBox ? 'z-50' : ''">
                <input x-data="" @click="searchBox = true ,  $dispatch('overlay-show')" name="s" wire:keyup.debounce.800ms="setKeyword($event.target.value)" type="text" placeholder="دنبال چی میگردی ؟" class="w-full py-4 bg-gray-210 rounded-xl pr-12  dark:text-white dark:bg-dark-920 placeholder-dark-550 dark:placeholder-white text-xs border-none">
                <input name="type" type="hidden" value="blog">
                <button type="submit" class="absolute right-5">
                    <svg class="text-dark-550 dark:text-white" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7.82495" cy="7.82492" r="6.74142" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M12.5137 12.8638L15.1568 15.4999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <div class="absolute left-5" wire:loading="" wire:target="setKeyword">
                    <svg class="w-5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="25 25 50 50">
                        <circle class="stroke-current text-gray-300 text-opacity-30" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="200, 300"></circle>
                        <circle class="stroke-current text-gray-300" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-linecap="round" stroke-dashoffset="0" stroke-dasharray="100, 200">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 50 50" to="360 50 50" dur="2.5s" repeatCount="indefinite"></animateTransform>
                            <animate attributeName="stroke-dashoffset" values="0;-30;-124" dur="1.25s" repeatCount="indefinite"></animate>
                            <animate attributeName="stroke-dasharray" values="0,200;110,200;110,200" dur="1.25s" repeatCount="indefinite"></animate>
                        </circle>
                    </svg>
                </div>
            </form>

            <div class="hidden lg:flex">
                <button   onclick="toLightMode()" title="تم تاریک" class="group lg:w-12 hidden ml-4 lg:h-12 header__moon group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                    <svg  class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9358 14.3652C20.0691 14.0415 19.9906 13.6679 19.7389 13.4276C19.4872 13.1873 19.115 13.1308 18.8051 13.2857C17.7584 13.8091 16.5801 14.1034 15.3317 14.1034C10.9835 14.1034 7.45846 10.5246 7.45846 6.1098C7.45846 4.32254 8.0352 2.67449 9.01033 1.34372C9.21644 1.06244 9.22917 0.680892 9.04229 0.386091C8.85541 0.0912907 8.50809 -0.054977 8.17055 0.0189828C3.50017 1.04235 2.17361e-07 5.25905 0 10.3077C-2.50276e-07 16.1208 4.64155 20.8333 10.3672 20.8333C14.6778 20.8333 18.372 18.1625 19.9358 14.3652Z" fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0928 3.67116L13.7596 1.84183C13.9751 1.25035 14.4797 0.939795 14.9987 0.910156C15.5177 0.939795 16.0222 1.25035 16.2378 1.84183L16.9045 3.67116L18.7063 4.34807C19.9329 4.8089 19.9329 6.57032 18.7063 7.03114L16.9045 7.70806L16.2378 9.53738C16.0222 10.1289 15.5177 10.4394 14.9987 10.4691C14.4797 10.4394 13.9751 10.1289 13.7596 9.53738L13.0928 7.70806L11.2911 7.03114C10.0644 6.57032 10.0644 4.8089 11.2911 4.34807L13.0928 3.67116Z" fill="currentColor" fill-opacity="0.4" />
                    </svg>
                </button>
                <button  onclick="toSystemMode()" title="تم روشن" class="group lg:w-12 ml-4 lg:h-12 header__sun group w-10 h-10 hidden items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                    <svg width="23" class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8025 18.0871C7.03723 18.0871 5.4658 16.5156 5.51682 11.8013C5.56785 7.08705 7.03723 5.51562 11.8025 5.51562C16.5678 5.51562 18.0882 7.08705 18.0882 11.8013C18.0882 16.5156 16.5678 18.0871 11.8025 18.0871Z" fill="currentColor" />
                        <path d="M11.8008 0.800781C12.2347 0.800781 12.5865 1.15256 12.5865 1.5865V3.15792C12.5865 3.59186 12.2347 3.94364 11.8008 3.94364C11.3668 3.94364 11.0151 3.59186 11.0151 3.15792V1.5865C11.0151 1.15256 11.3668 0.800781 11.8008 0.800781Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M12.5865 20.4436C12.5865 20.0097 12.2347 19.6579 11.8008 19.6579C11.3668 19.6579 11.0151 20.0097 11.0151 20.4436V22.0151C11.0151 22.449 11.3668 22.8008 11.8008 22.8008C12.2347 22.8008 12.5865 22.449 12.5865 22.0151V20.4436Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M22.8008 11.8008C22.8008 12.2347 22.449 12.5865 22.0151 12.5865H20.4436C20.0097 12.5865 19.6579 12.2347 19.6579 11.8008C19.6579 11.3668 20.0097 11.0151 20.4436 11.0151H22.0151C22.449 11.0151 22.8008 11.3668 22.8008 11.8008Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M3.15792 12.5865C3.59186 12.5865 3.94364 12.2347 3.94364 11.8008C3.94364 11.3668 3.59186 11.0151 3.15792 11.0151H1.5865C1.15256 11.0151 0.800781 11.3668 0.800781 11.8008C0.800781 12.2347 1.15256 12.5865 1.5865 12.5865H3.15792Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M3.38805 3.38805C3.6949 3.08121 4.19238 3.08121 4.49922 3.38805L5.61039 4.49922C5.91723 4.80606 5.91723 5.30355 5.61039 5.61039C5.30355 5.91723 4.80606 5.91723 4.49922 5.61039L3.38805 4.49922C3.08121 4.19238 3.08121 3.6949 3.38805 3.38805Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M4.49922 20.5388C4.19238 20.8457 3.6949 20.8457 3.38805 20.5388C3.08121 20.232 3.08121 19.7345 3.38805 19.4277L4.49922 18.3165C4.80606 18.0097 5.30355 18.0097 5.61039 18.3165C5.91723 18.6233 5.91723 19.1208 5.61039 19.4277L4.49922 20.5388Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M20.5388 3.38805C20.232 3.08121 19.7345 3.08121 19.4277 3.38805L18.3165 4.49922C18.0097 4.80606 18.0097 5.30355 18.3165 5.61039C18.6233 5.91723 19.1208 5.91723 19.4277 5.61039L20.5388 4.49922C20.8457 4.19238 20.8457 3.6949 20.5388 3.38805Z" fill="currentColor" fill-opacity="0.4" />
                        <path d="M19.4277 20.5388C19.7345 20.8457 20.232 20.8457 20.5388 20.5388C20.8457 20.232 20.8457 19.7345 20.5388 19.4277L19.4277 18.3165C19.1208 18.0097 18.6233 18.0097 18.3165 18.3165C18.0097 18.6233 18.0097 19.1208 18.3165 19.4277L19.4277 20.5388Z" fill="currentColor" fill-opacity="0.4" />
                    </svg>
                </button>
                <button onclick="toDarkMode()" title="دارک مود بر اساس سیستم شما" class="group header__indeterminate lg:w-12 ml-4 lg:h-12 group w-10 h-10 hidden items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                    <svg class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                    </svg>
                </button>
            </div>

            <div>
                <div class="flex items-center">
                    <?php if ($data['userId'] != FALSE) { ?>
                        <div wire:id="CDkYpYesbjvNfezVWCCx" x-data="{ userDropDown : false }" class="relative" :class="userDropDown ? 'z-50' : ' '">
                            <div @click="userDropDown = true , $dispatch('overlay-show')" href="#" class="group w-12 h-12 flex items-center justify-center rounded-full bg-gray-210 dark:bg-dark-920 hover:bg-biscay-700 transition relative cursor-pointer">
                                <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden border-2 border-solid border-gray-80">
                                    <img src="<?= $data['infoUser']['c_image'] ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';" alt="user-avatar">
                                </div>

                                <?php if($data['profileNotification']['service'][0]['count']>0){ ?>
                                    <span class="absolute text-white bg-yellow-500 rounded-full w-6 h-6 flex items-center justify-center text-xs -top-2 -right-2">
                                        <?= $data['profileNotification']['service'][0]['count'] ?>
                                    </span>
                                <?php } ?>
                            </div>

                            <div @click.away="userDropDown = false,$dispatch('overlay-hide')" x-show="userDropDown" class="absolute sm:w-80 w-276 dark:!bg-dark-930 dark:shadow-whiteShadow bg-white rounded-lg overflow-hidden top-16 -left-4 z-10" style="display: none;">
                                <div>
                                    <div class="pt-7 px-5">
                                        <div class="relative">
                                            <span class="absolute bg-biscay-100 dark:bg-white dark:bg-opacity-10 w-px md:h-full right-22px z-negative"></span>
                                            <div class="flex items-start mb-2">
                                                <div wire:id="AUuHITkcrrZglgBQugYV" class="relative hvr-ripple-out" style="" x-data="{ hover : false}" @mouseenter="hover = true" @mouseleave="hover = false">
                                                    <div class="w-12 h-12 ml-4 bg-gray-300 group relative rounded-full overflow-hidden border-2 border-solid border-green-700">
                                                        <a>
                                                            <img class="transition duration-200 transform group-hover:scale-110 w-full h-full" src="<?= $data['infoUser']['c_image'] ?>" onerror="this.onerror=null;this.src='public/images/user-default-image.jpg';" alt="تصویر <?= $data['infoUser']['c_display_name'] ?>">
                                                            <div class="w-full h-full absolute top-0 right-0 bg-biscay-700 bg-opacity-20 z-0"></div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col">
                                                    <a class="mb-2 dark:text-white text-biscay-500 hover:text-biscay-650 duration-200 transition font-bold text-xl"><?= $data['infoUser']['c_display_name'] ?></a>
                                                    <a href="user" class="flex items-center font-medium text-base dark:text-blue-450 text-blue-700 hover:opacity-80">
                                                        مشاهده پنل کاربری
                                                        <svg class="mr-2" width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.99998 0.833344L0.833313 5.00001M0.833313 5.00001H14.1666M0.833313 5.00001L4.99998 9.16668" stroke="#3B82F6" stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="pr-12">
                                                <?php if($data['getPublicInfo']['active_wallet'] == "1") { ?>
                                                    <div class="relative flex items-center justify-between mb-3">
                                                        <span class="w-4 h-4 absolute rounded-full bg-blue-700 -right-34px"></span>
                                                        <div>
                                                            <span class="dark:text-gray-100 text-gray-300 font-bold text-sm">کیف پول</span>
                                                        </div>
                                                        <div>
                                                            <span class="flex items-center dark:text-gray-100 text-gray-300 font-bold text-sm">
                                                                0
                                                                <svg class="mr-1" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M0.874343 3.99165C1.02826 3.99165 1.1599 3.96938 1.26926 3.92482C1.38267 3.88432 1.47583 3.82761 1.54874 3.7547C1.62165 3.6818 1.67835 3.59471 1.71886 3.49345C1.75936 3.39624 1.78366 3.29296 1.79176 3.18359H1.37862C1.168 3.18359 0.995855 3.16132 0.862191 3.11676C0.728527 3.07221 0.623216 3.0074 0.546258 2.92234C0.4693 2.83323 0.414619 2.7259 0.382216 2.60033C0.353863 2.47477 0.339686 2.333 0.339686 2.17504C0.339686 2.01707 0.361964 1.86923 0.406518 1.73152C0.451073 1.58975 0.51588 1.46621 0.600939 1.3609C0.690048 1.25559 0.79941 1.17256 0.929023 1.1118C1.05864 1.04699 1.2085 1.01459 1.37862 1.01459C1.51634 1.01459 1.64595 1.03687 1.76746 1.08142C1.89302 1.12598 2.00239 1.19686 2.09555 1.29407C2.18871 1.39128 2.26161 1.51684 2.31427 1.67076C2.37097 1.82468 2.39933 2.01302 2.39933 2.23579V2.51527H2.89145C2.98056 2.51527 3.02512 2.62261 3.02512 2.83728C3.02512 3.06816 2.98056 3.18359 2.89145 3.18359H2.38718C2.37908 3.38206 2.33857 3.57041 2.26566 3.74863C2.19276 3.92685 2.0915 4.08279 1.96188 4.21645C1.83632 4.35012 1.68443 4.45543 1.50621 4.53239C1.32799 4.61339 1.12749 4.6539 0.904721 4.6539H0.291081L0.254628 3.99165H0.874343ZM0.935099 2.13251C0.935099 2.27427 0.965477 2.37351 1.02623 2.43021C1.09104 2.48692 1.2166 2.51527 1.40292 2.51527H1.80392V2.22972C1.80392 2.0191 1.76341 1.87126 1.6824 1.7862C1.60544 1.70114 1.49608 1.65861 1.35432 1.65861C1.22065 1.65861 1.11737 1.69911 1.04446 1.78012C0.971553 1.86113 0.935099 1.97859 0.935099 2.13251ZM3.89142 2.51527C3.94407 2.51527 3.9785 2.54363 3.99471 2.60033C4.01496 2.65299 4.02508 2.73197 4.02508 2.83728C4.02508 2.95474 4.01496 3.04183 3.99471 3.09853C3.9785 3.15524 3.94407 3.18359 3.89142 3.18359H2.88894C2.83628 3.18359 2.80185 3.15727 2.78565 3.10461C2.7654 3.0479 2.75527 2.9669 2.75527 2.86158C2.75527 2.74412 2.7654 2.65704 2.78565 2.60033C2.80185 2.54363 2.83628 2.51527 2.88894 2.51527H3.89142ZM4.89414 2.51527C4.94679 2.51527 4.98122 2.54363 4.99742 2.60033C5.01767 2.65299 5.0278 2.73197 5.0278 2.83728C5.0278 2.95474 5.01767 3.04183 4.99742 3.09853C4.98122 3.15524 4.94679 3.18359 4.89414 3.18359H3.89166C3.839 3.18359 3.80457 3.15727 3.78837 3.10461C3.76812 3.0479 3.75799 2.9669 3.75799 2.86158C3.75799 2.74412 3.76812 2.65704 3.78837 2.60033C3.80457 2.54363 3.839 2.51527 3.89166 2.51527H4.89414ZM5.89685 2.51527C5.94951 2.51527 5.98394 2.54363 6.00014 2.60033C6.02039 2.65299 6.03052 2.73197 6.03052 2.83728C6.03052 2.95474 6.02039 3.04183 6.00014 3.09853C5.98394 3.15524 5.94951 3.18359 5.89685 3.18359H4.89437C4.84172 3.18359 4.80729 3.15727 4.79109 3.10461C4.77084 3.0479 4.76071 2.9669 4.76071 2.86158C4.76071 2.74412 4.77084 2.65704 4.79109 2.60033C4.80729 2.54363 4.84172 2.51527 4.89437 2.51527H5.89685ZM6.89957 2.51527C6.95223 2.51527 6.98666 2.54363 7.00286 2.60033C7.02311 2.65299 7.03324 2.73197 7.03324 2.83728C7.03324 2.95474 7.02311 3.04183 7.00286 3.09853C6.98666 3.15524 6.95223 3.18359 6.89957 3.18359H5.89709C5.84444 3.18359 5.81001 3.15727 5.79381 3.10461C5.77355 3.0479 5.76343 2.9669 5.76343 2.86158C5.76343 2.74412 5.77355 2.65704 5.79381 2.60033C5.81001 2.54363 5.84444 2.51527 5.89709 2.51527H6.89957ZM7.45877 2.51527C7.73015 2.51527 7.86584 2.38363 7.86584 2.12036V1.40343H8.48555V2.16289C8.48555 2.49907 8.40049 2.75425 8.23037 2.92842C8.06026 3.09853 7.82128 3.18359 7.51345 3.18359H6.89981C6.84715 3.18359 6.81273 3.15727 6.79652 3.10461C6.77627 3.0479 6.76615 2.9669 6.76615 2.86158C6.76615 2.74412 6.77627 2.65704 6.79652 2.60033C6.81273 2.54363 6.84715 2.51527 6.89981 2.51527H7.45877ZM8.50378 0.692582H7.87191V0.0971694H8.50378V0.692582ZM7.63496 0.692582H7.0031V0.0971694H7.63496V0.692582ZM3.62053 8.0317C3.62053 8.26258 3.58408 8.47522 3.51117 8.66964C3.44231 8.86812 3.34105 9.04026 3.20739 9.18607C3.07777 9.33189 2.91778 9.4453 2.72741 9.52631C2.54109 9.61137 2.3325 9.6539 2.10162 9.6539H1.71886C1.26521 9.6539 0.912822 9.51416 0.661695 9.23468C0.410569 8.9552 0.285006 8.57243 0.285006 8.08638V6.99884H0.898645V8.06208C0.898645 8.20385 0.914847 8.33143 0.94725 8.44485C0.979654 8.55826 1.03028 8.65547 1.09914 8.73648C1.17205 8.81749 1.26521 8.88027 1.37862 8.92482C1.49608 8.96938 1.63785 8.99165 1.80392 8.99165H2.07124C2.24136 8.99165 2.38515 8.96533 2.50261 8.91267C2.62413 8.86407 2.72134 8.79521 2.79424 8.7061C2.8712 8.62104 2.92588 8.51978 2.95829 8.40232C2.99069 8.2889 3.00689 8.16739 3.00689 8.03778V6.40343H3.62053V8.0317ZM2.19276 6.3123H1.50621V5.69258H2.19276V6.3123ZM5.17841 8.18359C5.065 8.18359 4.95564 8.16942 4.85033 8.14106C4.74907 8.10866 4.65996 8.05601 4.583 7.9831C4.50604 7.91019 4.44528 7.81501 4.40073 7.69754C4.35617 7.57603 4.3339 7.42616 4.3339 7.24795V4.4167H4.95361V7.09605C4.95361 7.22567 4.98196 7.32895 5.03867 7.40591C5.09943 7.47882 5.18854 7.51527 5.306 7.51527H5.44574C5.53485 7.51527 5.5794 7.62261 5.5794 7.83728C5.5794 8.06816 5.53485 8.18359 5.44574 8.18359H5.17841ZM5.50085 7.51527C5.63856 7.51527 5.7459 7.48895 5.82286 7.43629C5.89981 7.37958 5.93829 7.28845 5.93829 7.16289V7.02922C5.93829 6.86721 5.96057 6.71734 6.00512 6.57963C6.05373 6.44191 6.12259 6.32445 6.2117 6.22724C6.30081 6.13003 6.40814 6.0551 6.5337 6.00244C6.66332 5.94573 6.80711 5.91738 6.96508 5.91738C7.13114 5.91738 7.27696 5.94573 7.40252 6.00244C7.53213 6.0551 7.63947 6.13205 7.72453 6.23331C7.80959 6.33052 7.8744 6.44799 7.91895 6.5857C7.96351 6.72342 7.98578 6.87328 7.98578 7.0353C7.98578 7.39984 7.89262 7.68337 7.7063 7.88589C7.52403 8.08436 7.27493 8.18359 6.959 8.18359C6.79698 8.18359 6.64104 8.15322 6.49118 8.09246C6.34536 8.02765 6.23397 7.92639 6.15702 7.78868C6.08006 7.94664 5.98082 8.05195 5.85931 8.10461C5.7378 8.15727 5.61831 8.18359 5.50085 8.18359H5.44617C5.39351 8.18359 5.35908 8.15727 5.34288 8.10461C5.32263 8.0479 5.3125 7.9669 5.3125 7.86158C5.3125 7.74412 5.32263 7.65704 5.34288 7.60033C5.35908 7.54363 5.39351 7.51527 5.44617 7.51527H5.50085ZM7.39037 7.07783C7.39037 6.94011 7.35797 6.82468 7.29316 6.73152C7.2324 6.63836 7.12102 6.59178 6.959 6.59178C6.80508 6.59178 6.6937 6.63836 6.62484 6.73152C6.56003 6.82063 6.52763 6.93809 6.52763 7.0839C6.52763 7.22567 6.56611 7.333 6.64307 7.40591C6.72002 7.47882 6.82534 7.51527 6.959 7.51527C7.24658 7.51527 7.39037 7.36946 7.39037 7.07783Z" fill="#98A3B8"></path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="dark:border-gray-360 dark:border-opacity-10 border-biscay-100 mt-5 mb-3">
                                    <ul class="pb-7 px-5">
                                        <li class="dark:hover:bg-dark-450 hover:bg-dark-550 hover:bg-opacity-10 rounded-lg">
                                            <a href="user/reservations" class="flex items-center justify-between py-3 px-4">
                                                <div class="flex items-center">
                                                    <svg class="dark:text-gray-920 text-gray-550 ml-4" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" fill="currentColor"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z" fill="currentColor"></path>
                                                    </svg>
                                                    <span class="dark:text-gray-920 text-gray-550 font-normal text-lg">نوبت های من</span>
                                                </div>

                                                <?php if($data['profileNotification']['service'][0]['count']>0){ ?>
                                                    <span class="rounded-full w-6 h-6  bg-yellow-500 flex justify-center text-white font-normal text-lg">
                                                        <?= $data['profileNotification']['service'][0]['count'] ?>
                                                    </span>
                                                <?php } ?>
                                            </a>
                                        </li>
                                        <li class="dark:hover:bg-dark-450 hover:bg-dark-550 hover:bg-opacity-10 rounded-lg">
                                            <a href="user/financial" class="flex items-center justify-between py-3 px-4">
                                                <div class="flex items-center">
                                                    <svg class="dark:text-gray-920 text-gray-550 ml-4" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M18.4382 12.2664H14.9887C13.7221 12.2656 12.6955 11.2398 12.6947 9.9732C12.6947 8.70663 13.7221 7.68079 14.9887 7.68001H18.4382" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.3789 9.92071H15.1133" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.60165 2.55625H13.9666C16.436 2.55625 18.438 4.55823 18.438 7.0277V13.1431C18.438 15.6126 16.436 17.6146 13.9666 17.6146H6.60165C4.13218 17.6146 2.1302 15.6126 2.1302 13.1431V7.0277C2.1302 4.55823 4.13218 2.55625 6.60165 2.55625Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M5.99492 6.42315H10.5953" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="dark:text-gray-920 text-gray-550 font-normal text-lg">مالی و تراکنش ها</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="hover:bg-dark-550 hover:bg-opacity-10 rounded-lg">
                                            <form action="user/logout" method="post" id="logout-action">
                                                <input type="hidden" name="_token" value="6P1a8eXzk3n8IE8gVfZtI3sNu4j24Rla0N2HdfhA">
                                            </form>
                                            <div onclick="event.preventDefault();document.getElementById('logout-action').submit()" class="flex items-center py-3 px-4 cursor-pointer">
                                                <div class="flex items-center">
                                                    <svg class="dark:text-gray-920 text-gray-550 ml-4" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.7949 6.70662V5.91163C12.7949 4.17764 11.3889 2.7717 9.65495 2.7717H5.50104C3.76791 2.7717 2.36197 4.17764 2.36197 5.91163V15.3953C2.36197 17.1293 3.76791 18.5352 5.50104 18.5352H9.66347C11.3923 18.5352 12.7949 17.1336 12.7949 15.4047V14.6012" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M18.5835 10.6534H8.32356" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M16.0883 8.16948L18.5833 10.6533L16.0883 13.138" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="dark:text-gray-920 text-gray-550 font-normal text-lg">خروج از حساب کاربری</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="flex bg-blue-700 bg-opacity-10 rounded-lg ">
                            <a href="<?= htmlspecialchars($_GET['url'])=="" ? "login":"login?backURL=".htmlspecialchars($_GET['url']); ?>" class="text-blue-700 bg-blue-700 bg-opacity-0 hover:bg-opacity-80 transition duration-200 hover:text-white font-medium sm:text-base text-xs inline-flex items-center rounded-lg h-10 pr-3 -ml-3 pl-6">
                                <span class="sm:inline-block hidden">
                                    ورود
                                </span>
                                <span class="mr-1">
                                    <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path opacity="0.4" d="M6.67065 6.4847C6.67065 4.27199 8.53019 2.47095 10.8157 2.47095H15.3587C17.6387 2.47095 19.4935 4.26748 19.4935 6.47567V16.5109C19.4935 18.7246 17.6349 20.5265 15.3494 20.5265H10.8064C8.52646 20.5265 6.67065 18.7291 6.67065 16.52V15.6714V6.4847Z" fill="currentColor"></path>
                                      <path d="M14.5621 11.0056L11.8827 8.37941C11.6058 8.10858 11.1602 8.10858 10.8841 8.38122C10.6091 8.65386 10.61 9.09351 10.886 9.36434L12.3531 10.8025H3.04688C2.65717 10.8025 2.34082 11.1139 2.34082 11.4985C2.34082 11.8822 2.65717 12.1927 3.04688 12.1927H12.3531L10.886 13.6318C10.61 13.9026 10.6091 14.3423 10.8841 14.6149C11.0226 14.7512 11.2033 14.8198 11.3848 14.8198C11.5645 14.8198 11.7452 14.7512 11.8827 14.6167L14.5621 11.9905C14.695 11.8596 14.7702 11.6827 14.7702 11.4985C14.7702 11.3134 14.695 11.1365 14.5621 11.0056Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>

                            <a href="<?= htmlspecialchars($_GET['url'])=="" ? "login":"login?backURL=".htmlspecialchars($_GET['url']); ?>" class="sm:inline-flex hidden bg-blue-700 text-white hover:opacity-80  duration-75 font-medium sm:text-base text-xs items-center rounded-lg h-10 px-3 ">
                                <span>
                                    عضویت
                                </span>
                                <span class="mr-1">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M19.3827 8.78099H18.2966V7.71911C18.2966 7.26576 17.933 6.89612 17.485 6.89612C17.0379 6.89612 16.6734 7.26576 16.6734 7.71911V8.78099H15.5892C15.1412 8.78099 14.7776 9.15063 14.7776 9.60398C14.7776 10.0573 15.1412 10.427 15.5892 10.427H16.6734V11.4898C16.6734 11.9431 17.0379 12.3128 17.485 12.3128C17.933 12.3128 18.2966 11.9431 18.2966 11.4898V10.427H19.3827C19.8297 10.427 20.1943 10.0573 20.1943 9.60398C20.1943 9.15063 19.8297 8.78099 19.3827 8.78099" fill="currentColor"></path>
                                        <path d="M8.90975 13.681C5.25731 13.681 2.13892 14.265 2.13892 16.598C2.13892 18.9301 5.23834 19.5351 8.90975 19.5351C12.5613 19.5351 15.6806 18.9511 15.6806 16.6181C15.6806 14.2851 12.5812 13.681 8.90975 13.681" fill="currentColor"></path>
                                        <path opacity="0.4" d="M8.90984 11.459C11.3966 11.459 13.39 9.43996 13.39 6.92114C13.39 4.40232 11.3966 2.38232 8.90984 2.38232C6.42308 2.38232 4.42969 4.40232 4.42969 6.92114C4.42969 9.43996 6.42308 11.459 8.90984 11.459" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div :class="{ '!right-0' : menuSate , '!-right-full' : !menuSate}" class="modal dark:shadow-whiteShadow -right-full lg:bg-gray-80 dark:bg-dark-910 lg:mx-9 lg:shadow-headerSecTwo lg:rounded-b-3xl lg:py-5 lg:static fixed flex flex-col items-center h-full z-under-overlay lg:w-auto w-276 transition-all duration-200 ease-in-out top-0 pt-10 bg-white !-right-full">
            <div class="justify-between relative items-center lg:hidden  flex">
                    <span class="transform lg:scale-90 scale-75">
                        <img class="w-56 sm:inline-block dark:hidden" style="enable-background: new 0 0 578 128" width="220" src="public/images/logos/<?= $data['getPublicInfo']['logo'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                        <img class="hidden w-56 dark:inline-block" style="enable-background: new 0 0 578 128" width="220" src="public/images/logos/<?= $data['getPublicInfo']['logo_dark'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                    </span>
                <button @click="$dispatch('overlay-hide') , $dispatch('menu-hide') , $dispatch('body-overflow-hide')" class="lg:hidden absolute bottom-full mb-1 -left-2">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 2L9 9M9 9L2 16M9 9L16 16M9 9L2 2" stroke="#353F53" stroke-width="2.88235" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <form action="search" class="lg:hidden inline-block w-full px-4 pt-5 pb-1">
                <div class="w-full h-full relative flex items-center">
                    <input type="text" name="s" class="w-full py-4 bg-gray-210 dark:bg-dark-890 rounded-xl pl-12 pr-8 dark:placeholder-gray-200 dark:text-white placeholder-dark-550 text-xs border-none" placeholder="دنبال چی میگردی ؟">
                    <input name="type" type="hidden" value="blog">
                    <button type="submit" class="absolute left-5">
                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7.82495" cy="7.82492" r="6.74142" stroke="#64748B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M12.5137 12.8638L15.1568 15.4999" stroke="#64748B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
            </form>
            <?php if($data['userId'] != false){ ?>
                <div class="px-6 w-full mt-5 mb-3 lg:hidden inline-block">
                    <div class="font-bold text-gray-800 py-5 border-t border-b dark:border-opacity-10 border-biscay-100">
                        <div class="w-fit-content mb-5 lg:hidden">
                            <div class=" hidden header__moon items-center">
                                <button onclick="toLightMode()" class="group lg:w-12 flex ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg width="20" height="21" class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9358 14.3652C20.0691 14.0415 19.9906 13.6679 19.7389 13.4276C19.4872 13.1873 19.115 13.1308 18.8051 13.2857C17.7584 13.8091 16.5801 14.1034 15.3317 14.1034C10.9835 14.1034 7.45846 10.5246 7.45846 6.1098C7.45846 4.32254 8.0352 2.67449 9.01033 1.34372C9.21644 1.06244 9.22917 0.680892 9.04229 0.386091C8.85541 0.0912907 8.50809 -0.054977 8.17055 0.0189828C3.50017 1.04235 2.17361e-07 5.25905 0 10.3077C-2.50276e-07 16.1208 4.64155 20.8333 10.3672 20.8333C14.6778 20.8333 18.372 18.1625 19.9358 14.3652Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0928 3.67116L13.7596 1.84183C13.9751 1.25035 14.4797 0.939795 14.9987 0.910156C15.5177 0.939795 16.0222 1.25035 16.2378 1.84183L16.9045 3.67116L18.7063 4.34807C19.9329 4.8089 19.9329 6.57032 18.7063 7.03114L16.9045 7.70806L16.2378 9.53738C16.0222 10.1289 15.5177 10.4394 14.9987 10.4691C14.4797 10.4394 13.9751 10.1289 13.7596 9.53738L13.0928 7.70806L11.2911 7.03114C10.0644 6.57032 10.0644 4.8089 11.2911 4.34807L13.0928 3.67116Z" fill="currentColor" fill-opacity="0.4"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200  text-dark-920 font-semibold  ">
                                    تم تاریک

                                </span>
                            </div>
                            <div class=" hidden header__sun items-center">
                                <button onclick="toSystemMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg width="23" class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8025 18.0871C7.03723 18.0871 5.4658 16.5156 5.51682 11.8013C5.56785 7.08705 7.03723 5.51562 11.8025 5.51562C16.5678 5.51562 18.0882 7.08705 18.0882 11.8013C18.0882 16.5156 16.5678 18.0871 11.8025 18.0871Z" fill="currentColor"></path>
                                        <path d="M11.8008 0.800781C12.2347 0.800781 12.5865 1.15256 12.5865 1.5865V3.15792C12.5865 3.59186 12.2347 3.94364 11.8008 3.94364C11.3668 3.94364 11.0151 3.59186 11.0151 3.15792V1.5865C11.0151 1.15256 11.3668 0.800781 11.8008 0.800781Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M12.5865 20.4436C12.5865 20.0097 12.2347 19.6579 11.8008 19.6579C11.3668 19.6579 11.0151 20.0097 11.0151 20.4436V22.0151C11.0151 22.449 11.3668 22.8008 11.8008 22.8008C12.2347 22.8008 12.5865 22.449 12.5865 22.0151V20.4436Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M22.8008 11.8008C22.8008 12.2347 22.449 12.5865 22.0151 12.5865H20.4436C20.0097 12.5865 19.6579 12.2347 19.6579 11.8008C19.6579 11.3668 20.0097 11.0151 20.4436 11.0151H22.0151C22.449 11.0151 22.8008 11.3668 22.8008 11.8008Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M3.15792 12.5865C3.59186 12.5865 3.94364 12.2347 3.94364 11.8008C3.94364 11.3668 3.59186 11.0151 3.15792 11.0151H1.5865C1.15256 11.0151 0.800781 11.3668 0.800781 11.8008C0.800781 12.2347 1.15256 12.5865 1.5865 12.5865H3.15792Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M3.38805 3.38805C3.6949 3.08121 4.19238 3.08121 4.49922 3.38805L5.61039 4.49922C5.91723 4.80606 5.91723 5.30355 5.61039 5.61039C5.30355 5.91723 4.80606 5.91723 4.49922 5.61039L3.38805 4.49922C3.08121 4.19238 3.08121 3.6949 3.38805 3.38805Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M4.49922 20.5388C4.19238 20.8457 3.6949 20.8457 3.38805 20.5388C3.08121 20.232 3.08121 19.7345 3.38805 19.4277L4.49922 18.3165C4.80606 18.0097 5.30355 18.0097 5.61039 18.3165C5.91723 18.6233 5.91723 19.1208 5.61039 19.4277L4.49922 20.5388Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M20.5388 3.38805C20.232 3.08121 19.7345 3.08121 19.4277 3.38805L18.3165 4.49922C18.0097 4.80606 18.0097 5.30355 18.3165 5.61039C18.6233 5.91723 19.1208 5.91723 19.4277 5.61039L20.5388 4.49922C20.8457 4.19238 20.8457 3.6949 20.5388 3.38805Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M19.4277 20.5388C19.7345 20.8457 20.232 20.8457 20.5388 20.5388C20.8457 20.232 20.8457 19.7345 20.5388 19.4277L19.4277 18.3165C19.1208 18.0097 18.6233 18.0097 18.3165 18.3165C18.0097 18.6233 18.0097 19.1208 18.3165 19.4277L19.4277 20.5388Z" fill="currentColor" fill-opacity="0.4"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200 text-dark-920 font-semibold  ">
                                    تم روشن

                                </span>
                            </div>
                            <div class=" hidden header__indeterminate items-center">
                                <button onclick="toDarkMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200 text-dark-920 font-semibold  ">
                                    دارک مود خودکار
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="px-6 w-full mt-5 mb-3 lg:hidden inline-block">
                    <div class="font-bold text-gray-800 py-5 border-t border-b dark:border-opacity-10 border-biscay-100">
                        <div class="w-fit-content mb-5 lg:hidden">
                            <div class=" hidden header__moon items-center">
                                <button onclick="toLightMode()" class="group lg:w-12 flex ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg width="20" height="21" class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9358 14.3652C20.0691 14.0415 19.9906 13.6679 19.7389 13.4276C19.4872 13.1873 19.115 13.1308 18.8051 13.2857C17.7584 13.8091 16.5801 14.1034 15.3317 14.1034C10.9835 14.1034 7.45846 10.5246 7.45846 6.1098C7.45846 4.32254 8.0352 2.67449 9.01033 1.34372C9.21644 1.06244 9.22917 0.680892 9.04229 0.386091C8.85541 0.0912907 8.50809 -0.054977 8.17055 0.0189828C3.50017 1.04235 2.17361e-07 5.25905 0 10.3077C-2.50276e-07 16.1208 4.64155 20.8333 10.3672 20.8333C14.6778 20.8333 18.372 18.1625 19.9358 14.3652Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0928 3.67116L13.7596 1.84183C13.9751 1.25035 14.4797 0.939795 14.9987 0.910156C15.5177 0.939795 16.0222 1.25035 16.2378 1.84183L16.9045 3.67116L18.7063 4.34807C19.9329 4.8089 19.9329 6.57032 18.7063 7.03114L16.9045 7.70806L16.2378 9.53738C16.0222 10.1289 15.5177 10.4394 14.9987 10.4691C14.4797 10.4394 13.9751 10.1289 13.7596 9.53738L13.0928 7.70806L11.2911 7.03114C10.0644 6.57032 10.0644 4.8089 11.2911 4.34807L13.0928 3.67116Z" fill="currentColor" fill-opacity="0.4"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200  text-dark-920 font-semibold  ">
                                    تم تاریک

                                </span>
                            </div>
                            <div class=" hidden header__sun items-center">
                                <button onclick="toSystemMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg width="23" class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8025 18.0871C7.03723 18.0871 5.4658 16.5156 5.51682 11.8013C5.56785 7.08705 7.03723 5.51562 11.8025 5.51562C16.5678 5.51562 18.0882 7.08705 18.0882 11.8013C18.0882 16.5156 16.5678 18.0871 11.8025 18.0871Z" fill="currentColor"></path>
                                        <path d="M11.8008 0.800781C12.2347 0.800781 12.5865 1.15256 12.5865 1.5865V3.15792C12.5865 3.59186 12.2347 3.94364 11.8008 3.94364C11.3668 3.94364 11.0151 3.59186 11.0151 3.15792V1.5865C11.0151 1.15256 11.3668 0.800781 11.8008 0.800781Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M12.5865 20.4436C12.5865 20.0097 12.2347 19.6579 11.8008 19.6579C11.3668 19.6579 11.0151 20.0097 11.0151 20.4436V22.0151C11.0151 22.449 11.3668 22.8008 11.8008 22.8008C12.2347 22.8008 12.5865 22.449 12.5865 22.0151V20.4436Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M22.8008 11.8008C22.8008 12.2347 22.449 12.5865 22.0151 12.5865H20.4436C20.0097 12.5865 19.6579 12.2347 19.6579 11.8008C19.6579 11.3668 20.0097 11.0151 20.4436 11.0151H22.0151C22.449 11.0151 22.8008 11.3668 22.8008 11.8008Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M3.15792 12.5865C3.59186 12.5865 3.94364 12.2347 3.94364 11.8008C3.94364 11.3668 3.59186 11.0151 3.15792 11.0151H1.5865C1.15256 11.0151 0.800781 11.3668 0.800781 11.8008C0.800781 12.2347 1.15256 12.5865 1.5865 12.5865H3.15792Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M3.38805 3.38805C3.6949 3.08121 4.19238 3.08121 4.49922 3.38805L5.61039 4.49922C5.91723 4.80606 5.91723 5.30355 5.61039 5.61039C5.30355 5.91723 4.80606 5.91723 4.49922 5.61039L3.38805 4.49922C3.08121 4.19238 3.08121 3.6949 3.38805 3.38805Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M4.49922 20.5388C4.19238 20.8457 3.6949 20.8457 3.38805 20.5388C3.08121 20.232 3.08121 19.7345 3.38805 19.4277L4.49922 18.3165C4.80606 18.0097 5.30355 18.0097 5.61039 18.3165C5.91723 18.6233 5.91723 19.1208 5.61039 19.4277L4.49922 20.5388Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M20.5388 3.38805C20.232 3.08121 19.7345 3.08121 19.4277 3.38805L18.3165 4.49922C18.0097 4.80606 18.0097 5.30355 18.3165 5.61039C18.6233 5.91723 19.1208 5.91723 19.4277 5.61039L20.5388 4.49922C20.8457 4.19238 20.8457 3.6949 20.5388 3.38805Z" fill="currentColor" fill-opacity="0.4"></path>
                                        <path d="M19.4277 20.5388C19.7345 20.8457 20.232 20.8457 20.5388 20.5388C20.8457 20.232 20.8457 19.7345 20.5388 19.4277L19.4277 18.3165C19.1208 18.0097 18.6233 18.0097 18.3165 18.3165C18.0097 18.6233 18.0097 19.1208 18.3165 19.4277L19.4277 20.5388Z" fill="currentColor" fill-opacity="0.4"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200 text-dark-920 font-semibold  ">
                                    تم روشن

                                </span>
                            </div>
                            <div class=" hidden header__indeterminate items-center">
                                <button onclick="toDarkMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                                    <svg class=" text-biscay-700 dark:text-gray-900 dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                                    </svg>
                                </button>
                                <span class="dark:text-gray-200 text-dark-920 font-semibold  ">
                                    دارک مود خودکار
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>

            <div class="lg:overflow-visible overflow-auto lg:h-auto h-full lg:w-auto w-full">
                <ul class="flex items-center justify-center lg:flex-row flex-col lg:w-auto w-full lg:pt-0 pt-6">
                    <?php if(sizeof($data['getHeaderMenu'])>0){ ?>
                        <?php foreach($data['getHeaderMenu'] as $item){ ?>
                            <?php if(@sizeof($item['children'])>0){ ?>
                                <?php if($item['menu_type'] == 2){ ?>
                                    <li class="lg:mr-6 lg:inline-block flex items-center lg:w-auto w-full lg:mb-0 mb-7">
                                        <div x-data="{ active : false }" @click="active = !active" @click.away="active = false" href="#" class="flex lg:items-center lg:flex-row flex-col items-start text-base font-medium text-biscay-700 group hover:text-biscay-500 relative">
                                            <span class="cursor-pointer flex items-center dark:text-white dark:group-hover:text-gray-20">
                                                <span class="lg:hidden ml-4 mr-5">
                                                    <svg class="" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 11C1 13.2418 1.12143 14.975 1.42108 16.3234C1.71821 17.6603 2.17712 18.5568 2.81017 19.1898C3.44322 19.8229 4.33967 20.2818 5.67664 20.5789C7.02497 20.8786 8.7582 21 11 21C13.2418 21 14.975 20.8786 16.3234 20.5789C17.6603 20.2818 18.5568 19.8229 19.1898 19.1898C19.8229 18.5568 20.2818 17.6603 20.5789 16.3234C20.8786 14.975 21 13.2418 21 11C21 8.7582 20.8786 7.02497 20.5789 5.67664C20.2818 4.33967 19.8229 3.44322 19.1898 2.81017C18.5568 2.17712 17.6603 1.71821 16.3234 1.42108C14.975 1.12143 13.2418 1 11 1C8.7582 1 7.02497 1.12143 5.67664 1.42108C4.33967 1.71821 3.44322 2.17712 2.81017 2.81017C2.17712 3.44322 1.71821 4.33967 1.42108 5.67664C1.12143 7.02497 1 8.7582 1 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.569 11C15.569 10.2578 15.1273 9.75506 14.7133 9.41219C14.3256 9.09111 13.7773 8.76091 13.1729 8.39688C13.1522 8.38443 13.1314 8.37194 13.1106 8.35941L11.6299 7.46743C11.6086 7.45463 11.5874 7.44186 11.5663 7.42914C10.9631 7.06568 10.4144 6.73503 9.95247 6.54465C9.46505 6.34375 8.78927 6.17827 8.12994 6.57544C7.48653 6.96301 7.29813 7.62513 7.22401 8.14598C7.1522 8.65068 7.15227 9.30526 7.15234 10.0371C7.15234 10.0607 7.15234 10.0843 7.15234 10.108L7.15234 11.892C7.15234 11.9157 7.15234 11.9393 7.15234 11.9628C7.15227 12.6947 7.1522 13.3493 7.22401 13.854C7.29813 14.3748 7.48653 15.0369 8.12994 15.4245C8.78927 15.8217 9.46505 15.6562 9.95247 15.4553C10.4144 15.2649 10.9631 14.9343 11.5663 14.5708C11.5874 14.5581 11.6086 14.5453 11.6299 14.5325L13.1106 13.6405C13.1315 13.628 13.1522 13.6155 13.1729 13.6031C13.7773 13.239 14.3256 12.9089 14.7133 12.5878C15.1273 12.2449 15.569 11.7422 15.569 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                 <?= $item['title'] ?>
                                                <span class="mr-2">
                                                    <svg class="text-biscay-700 dark:text-white dark:group-hover:text-gray-20" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.2466 1.81357C12.2466 2.09063 12.1407 2.36913 11.929 2.58091L6.89555 7.63898C6.69102 7.8435 6.41397 7.9581 6.12386 7.9581C5.8352 7.9581 5.55814 7.8435 5.35362 7.63898L0.317309 2.58091C-0.106252 2.1559 -0.106252 1.46834 0.32021 1.04333C0.746671 0.619768 1.43568 0.621218 1.85924 1.04623L6.12386 5.3297L10.3885 1.04623C10.812 0.621218 11.4996 0.619768 11.9261 1.04333C12.1407 1.25511 12.2466 1.53506 12.2466 1.81357Z" fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>
                                                </span>
                                            </span>
                                            <div x-show="active" class="lg:absolute top-14 -right-8 lg:w-400 w-full z-20" style="display: none;">
                                                <div class="bg-white dark:bg-dark-910 rounded-lg lg:shadow-nav-link lg:p-5">
                                                    <div class="grid grid-cols-12 gap-4 lg:px-0 px-5 lg:pt-0 pt-5">
                                                        <?php foreach($item['children'] as $children){ ?>
                                                            <div class="lg:col-span-6 col-span-12 flex items-start">
                                                                <a href="<?= $children['link'] ?>" class="inline-flex items-start w-full h-full hover:bg-biscay-700 dark:hover:bg-dark-900 dark:rounded-lg hover:bg-opacity-5 rounded-md px-2 pt-4 pb-2">
                                                                    <div class="ml-2">
                                                                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <circle opacity="0.15" cx="15.8062" cy="13.2944" r="9.19385" fill="#1DBE59"></circle>
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3214 2.11028C13.881 0.791546 12.2987 2.02656e-06 10.6634 0C9.02798 0 7.44568 0.791542 5.0053 2.11028L4.96149 2.13395L4.96148 2.13395C3.75491 2.78594 2.79516 3.30457 2.14113 3.74635C1.80989 3.97009 1.51103 4.20394 1.28922 4.45865C1.06485 4.7163 0.863281 5.06072 0.863281 5.48803V11.7601C0.863281 12.1931 1.21429 12.5441 1.64729 12.5441C2.08028 12.5441 2.43129 12.1931 2.43129 11.7601V7.41846C2.86981 7.69436 3.41342 8.00017 4.04977 8.34777C3.9992 8.97843 3.99926 9.79355 3.99934 10.8457L3.99935 10.9761C3.99935 14.8961 5.1708 15.6801 10.6364 15.6801C15.7594 15.6801 17.3274 14.8962 17.3274 10.9761C17.3274 9.86231 17.3274 9.00684 17.2715 8.35074C18.0591 7.92059 18.7049 7.5544 19.1856 7.22971C19.5168 7.00597 19.8156 6.77212 20.0375 6.51741C20.2618 6.25976 20.4634 5.91534 20.4634 5.48803C20.4634 5.06072 20.2618 4.7163 20.0375 4.45865C19.8156 4.20394 19.5168 3.97009 19.1856 3.74634C18.5315 3.30456 17.5718 2.78595 16.3652 2.13396L16.3214 2.11028ZM15.7452 9.17551C13.6245 10.3075 12.1664 10.9761 10.6634 10.9761C9.15979 10.9761 7.70108 10.307 5.5791 9.17422C5.56756 9.64289 5.56736 10.2286 5.56736 10.9761C5.56736 12.9088 5.89203 13.32 6.1699 13.5153C6.37815 13.6616 6.76763 13.8294 7.53133 13.9465C8.28954 14.0628 9.2921 14.1121 10.6364 14.1121C11.8908 14.1121 12.8546 14.0632 13.6025 13.947C14.3541 13.8302 14.7819 13.6605 15.0352 13.4922C15.3855 13.2595 15.7594 12.796 15.7594 10.9761C15.7594 10.2283 15.7582 9.643 15.7452 9.17551ZM3.01881 5.0457C2.72862 5.24172 2.56119 5.38576 2.47202 5.48803C2.56119 5.5903 2.72862 5.73434 3.01881 5.93036C3.60046 6.32325 4.49075 6.80543 5.75074 7.48631C8.28467 8.85559 9.50055 9.40805 10.6634 9.40805C11.8262 9.40805 13.042 8.85559 15.5759 7.48631C16.8359 6.80543 17.7262 6.32325 18.3079 5.93036C18.5981 5.73434 18.7655 5.5903 18.8547 5.48803C18.7655 5.38576 18.5981 5.24172 18.3079 5.0457C17.7262 4.65281 16.8359 4.17063 15.576 3.48976C13.042 2.12047 11.8262 1.56801 10.6634 1.56801C9.50055 1.56801 8.28467 2.12047 5.75074 3.48976C4.49075 4.17063 3.60046 4.65281 3.01881 5.0457ZM18.9077 5.55975L18.9067 5.55765C18.9074 5.55906 18.9077 5.55976 18.9077 5.55975ZM18.9077 5.4163L18.9067 5.41838C18.9071 5.41764 18.9073 5.4171 18.9075 5.41676C18.9076 5.41645 18.9077 5.4163 18.9077 5.4163ZM2.42001 5.41841C2.41927 5.417 2.41898 5.4163 2.41902 5.41631L2.42001 5.41841Z" fill="#1DBE59"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div>
                                                                        <div class="relative inline-block">
                                                                            <h4 class="text-dark-550 dark:text-white text-lg font-bold">
                                                                                <?= $children['title'] ?>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="lg:mr-6 lg:inline-block flex items-center lg:w-auto group w-full lg:mb-0 mb-7">
                                        <div x-data="{ active : false }" @click="active = !active" @click.away="active = false" href="#" class="flex lg:items-center lg:flex-row items-start flex-col text-base font-medium text-biscay-700 hover:text-biscay-500 cursor-pointer relative">
                                            <div class="cursor-pointer flex items-center dark:group-hover:text-gray-20 dark:text-white">
                                                <span class="lg:hidden ml-4 mr-5">
                                                    <svg class="text-dark-550 dark:text-white" width="18" height="18" viewBox="0 0 40 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="30" cy="13" r="7" fill="currentColor" fill-opacity="0.4"></circle>
                                                    </svg>
                                                </span>
                                                <?= $item['title'] ?>
                                                <span class="mr-2">
                                                    <svg class="text-biscay-700 dark:group-hover:text-gray-20 dark:text-white" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.2466 1.81357C12.2466 2.09063 12.1407 2.36913 11.929 2.58091L6.89555 7.63898C6.69102 7.8435 6.41397 7.9581 6.12386 7.9581C5.8352 7.9581 5.55814 7.8435 5.35362 7.63898L0.317309 2.58091C-0.106252 2.1559 -0.106252 1.46834 0.32021 1.04333C0.746671 0.619768 1.43568 0.621218 1.85924 1.04623L6.12386 5.3297L10.3885 1.04623C10.812 0.621218 11.4996 0.619768 11.9261 1.04333C12.1407 1.25511 12.2466 1.53506 12.2466 1.81357Z" fill="currentColor" fill-opacity="0.9"></path>
                                                    </svg>
                                                </span>
                                            </div>

                                            <div x-show="active" class="lg:absolute top-14 lg:w-52 w-full z-10" style="display: none;">
                                                <ul class="bg-white dark:bg-dark-910 dark:!shadow-whiteShadow rounded-lg lg:shadow-nav-link lg:p-3 px-11 pt-5 p w-full">
                                                    <?php foreach($item['children'] as $children){ ?>
                                                        <li class="h-full inline-block w-full">
                                                            <a href="<?= $children['link'] ?>" class="font-medium text-lg text-dark-550 dark:hover:bg-dark-900 dark:text-white rounded-md inline-block w-full pr-3 py-4 hover:bg-gray-200">
                                                                <?= $children['title'] ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li class="lg:mx-6 lg:inline-block flex items-center lg:w-auto w-full lg:mb-0 mb-7">
                                    <span class="lg:hidden ml-4 mr-5">
                                        <svg class="text-dark-550 dark:text-white" width="18" height="18" viewBox="0 0 40 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="30" cy="13" r="7" fill="currentColor" fill-opacity="0.4"></circle>
                                        </svg>
                                    </span>
                                    <a href="<?= $item['link'] ?>" class="text-base font-medium text-biscay-700 dark:hover:text-gray-20 dark:text-white hover:text-biscay-500">
                                        <?= $item['title'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>