<aside x-transition x-data="{showAside:0}" @aside-handler-show.window="showAside = true" @aside-handler-hide.window="showAside = false" :class="{'!right-0 w-276':showAside}"
       class="modal pt-11 min-h-screen h-full overflow-auto transition-all dark:bg-dark-920 duration-300 lg:z-0 z-under-overlay xl:col-span-4 lg:col-span-5 col-span-7 lg:relative fixed lg:right-0 top-0 -right-full flex flex-col items-center bg-white">
    <div class="flex justify-between relative items-center">
        <a href="<?= URL ?>" class="transform lg:scale-90 scale-75">
            <img class="flex dark:hidden" width="220" id="Layer_1" src="public/images/logos/<?= $data['getPublicInfo']['logo'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
            <img class="hidden dark:flex" width="220" id="Layer_1" src="public/images/logos/<?= $data['getPublicInfo']['logo_dark'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
        </a>

        <button @click="showAside=false,$dispatch('change-overlay-hide')" class="lg:hidden absolute bottom-full mb-1 -left-2">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 2L9 9M9 9L2 16M9 9L16 16M9 9L2 2" stroke="#353F53" stroke-width="2.88235" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    <div class="sm:hidden px-6 w-full  mt-5 mb-3">
        <div class=" font-bold text-gray-800 dark:text-white px-4 py-5 border-t border-b border-biscay-100 border-opacity-20">
            <div class="w-fit-content mb-5 lg:hidden">
                <div class=" hidden header__moon items-center">
                    <button onclick="toLightMode()" class="group lg:w-12 flex ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-900 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                        <svg width="20" height="21" class=" text-biscay-700 dark:text-white dark:group-hover:text-dark-920 group-hover:text-biscay-300" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9358 14.3652C20.0691 14.0415 19.9906 13.6679 19.7389 13.4276C19.4872 13.1873 19.115 13.1308 18.8051 13.2857C17.7584 13.8091 16.5801 14.1034 15.3317 14.1034C10.9835 14.1034 7.45846 10.5246 7.45846 6.1098C7.45846 4.32254 8.0352 2.67449 9.01033 1.34372C9.21644 1.06244 9.22917 0.680892 9.04229 0.386091C8.85541 0.0912907 8.50809 -0.054977 8.17055 0.0189828C3.50017 1.04235 2.17361e-07 5.25905 0 10.3077C-2.50276e-07 16.1208 4.64155 20.8333 10.3672 20.8333C14.6778 20.8333 18.372 18.1625 19.9358 14.3652Z" fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0928 3.67116L13.7596 1.84183C13.9751 1.25035 14.4797 0.939795 14.9987 0.910156C15.5177 0.939795 16.0222 1.25035 16.2378 1.84183L16.9045 3.67116L18.7063 4.34807C19.9329 4.8089 19.9329 6.57032 18.7063 7.03114L16.9045 7.70806L16.2378 9.53738C16.0222 10.1289 15.5177 10.4394 14.9987 10.4691C14.4797 10.4394 13.9751 10.1289 13.7596 9.53738L13.0928 7.70806L11.2911 7.03114C10.0644 6.57032 10.0644 4.8089 11.2911 4.34807L13.0928 3.67116Z" fill="currentColor" fill-opacity="0.4"></path>
                        </svg>
                    </button>
                    <span class="dark:text-white  text-dark-920 font-semibold  ">
                        تم تاریک

                    </span>
                </div>
                <div class=" hidden header__sun items-center">
                    <button onclick="toSystemMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-920 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                        <svg width="23" class=" text-biscay-700 dark:text-white dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <span class="dark:text-white text-dark-920 font-semibold  ">
                        تم روشن
                    </span>
                </div>
                <div class=" hidden header__indeterminate items-center">
                    <button onclick="toDarkMode()" class="group flex lg:w-12 ml-3 lg:h-12 group w-10 h-10  items-center relative dark:hover:bg-biscay-300 dark:bg-dark-900 justify-center rounded-full bg-gray-210 hover:bg-biscay-700 transition cursor-pointer">
                        <svg class=" text-biscay-700 dark:text-white dark:group-hover:text-dark-920 group-hover:text-biscay-300" height="23" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                        </svg>
                    </button>
                    <span class="dark:text-white text-dark-920 font-semibold  ">
                        دارک مود خودکار
                    </span>
                </div>
            </div>
            <div class="flex items-center">
                <a href="cart" class="group ml-2 w-10 h-10 flex items-center justify-center rounded-full dark:hover:bg-biscay-300 bg-gray-210 dark:bg-dark-900  hover:bg-biscay-700 transition relative cursor-pointer">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="fill-current text-biscay-700 dark:text-white dark:group-hover:text-biscay-700 group-hover:text-biscay-300" fill-rule="evenodd" clip-rule="evenodd" d="M19.1705 14.9551L18.4657 9.27669C18.0363 7.25046 16.8211 6.41663 15.6626 6.41663H6.35407C5.17937 6.41663 3.92365 7.1921 3.55909 9.27669L2.84616 14.9551C2.26286 19.1243 4.40973 20.1666 7.21282 20.1666H14.8119C17.6069 20.1666 19.689 18.6574 19.1705 14.9551ZM8.33901 11.1362C7.89158 11.1362 7.52887 10.7629 7.52887 10.3024C7.52887 9.84187 7.89158 9.46855 8.33901 9.46855C8.78644 9.46855 9.14915 9.84187 9.14915 10.3024C9.14915 10.7629 8.78644 11.1362 8.33901 11.1362ZM12.8353 10.3024C12.8353 10.7629 13.198 11.1362 13.6454 11.1362C14.0928 11.1362 14.4555 10.7629 14.4555 10.3024C14.4555 9.84187 14.0928 9.46855 13.6454 9.46855C13.198 9.46855 12.8353 9.84187 12.8353 10.3024Z"></path>
                        <path class="fill-current text-biscay-700 dark:text-white dark:group-hover:text-biscay-700 group-hover:text-biscay-300" opacity="0.4" d="M15.5594 6.20972C15.5623 6.28082 15.5486 6.35162 15.5195 6.41658H14.2021C14.1766 6.35053 14.1631 6.28049 14.1622 6.20972C14.1622 4.45201 12.7324 3.0271 10.9686 3.0271C9.20486 3.0271 7.77504 4.45201 7.77504 6.20972C7.78713 6.27815 7.78713 6.34815 7.77504 6.41658H6.42575C6.41367 6.34815 6.41367 6.27815 6.42575 6.20972C6.52827 3.76367 8.54793 1.83325 11.0046 1.83325C13.4612 1.83325 15.4808 3.76367 15.5834 6.20972H15.5594Z"></path>
                    </svg>
                </a>
                <a href="cart">
                    سبد خرید
                </a>
            </div>
        </div>
    </div>


    <div class="sm:overflow-visible overflow-auto sm:min-h-screen h-full w-full sm:mt-14 pb-20">
        <ul class="space-y-2">

            <li class="px-4 <?= $activeMenu == 'dashboard' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex py-3 px-4 items-center group text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450  transform transition hover:text-blue-700 " href="user">
                    <svg class="ml-4" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M7.14373 18.7821V15.7152C7.14372 14.9381 7.77567 14.3067 8.55844 14.3018H11.4326C12.2189 14.3018 12.8563 14.9346 12.8563 15.7152V15.7152V18.7732C12.8563 19.4473 13.404 19.9951 14.0829 20H16.0438C16.9596 20.0023 17.8388 19.6428 18.4872 19.0007C19.1356 18.3586 19.5 17.4868 19.5 16.5775V7.86585C19.5 7.13139 19.1721 6.43471 18.6046 5.9635L11.943 0.674268C10.7785 -0.250877 9.11537 -0.220992 7.98539 0.745384L1.46701 5.9635C0.872741 6.42082 0.517552 7.11956 0.5 7.86585V16.5686C0.5 18.4637 2.04738 20 3.95617 20H5.87229C6.19917 20.0023 6.51349 19.8751 6.74547 19.6464C6.97746 19.4178 7.10793 19.1067 7.10792 18.7821H7.14373Z"></path>
                    </svg>
                    صفحه اصلی پنل
                </a>
            </li>

            <li class="px-4 <?= $activeMenu == 'services' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex px-4 py-3 group items-center text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450  transform transition hover:text-blue-700" href="user/reservations">
                    <svg class="ml-4 mt-1" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M6.41684 0.015625C6.84015 0.015625 7.1833 0.358781 7.1833 0.782086V1.61389C7.88095 1.56838 8.64547 1.54855 9.48269 1.54855C10.3199 1.54855 11.0844 1.56838 11.7821 1.61389V0.782086C11.7821 0.358781 12.1252 0.015625 12.5485 0.015625C12.9718 0.015625 13.315 0.358781 13.315 0.782086V1.773C16.8142 2.30063 18.1645 3.87448 18.5516 7.68023C18.5766 7.92628 18.5976 8.18166 18.6149 8.44669C18.631 8.69341 18.6438 8.94849 18.6538 9.21218C18.6719 9.69416 18.6802 10.2049 18.6802 10.7461C18.6802 18.3202 17.0569 19.9436 9.48269 19.9436C1.90852 19.9436 0.285156 18.3202 0.285156 10.7461C0.285156 10.2049 0.293443 9.69416 0.311595 9.21218C0.321526 8.94849 0.33441 8.69341 0.350505 8.44669C0.367795 8.18166 0.388792 7.92628 0.413814 7.68023C0.800848 3.87448 2.15114 2.30063 5.65038 1.773V0.782086C5.65038 0.358781 5.99354 0.015625 6.41684 0.015625ZM5.65038 3.32568C4.62031 3.50064 3.92461 3.76899 3.43392 4.12872C2.70993 4.65949 2.18796 5.59163 1.95543 7.68023H17.0099C16.7774 5.59163 16.2554 4.65949 15.5315 4.12872C15.0408 3.76899 14.3451 3.50064 13.315 3.32568V3.84793C13.315 4.27123 12.9718 4.61439 12.5485 4.61439C12.1252 4.61439 11.7821 4.27123 11.7821 3.84793V3.15136C11.1166 3.10484 10.3554 3.08147 9.48269 3.08147C8.60995 3.08147 7.84874 3.10484 7.1833 3.15136V3.84793C7.1833 4.27123 6.84015 4.61439 6.41684 4.61439C5.99354 4.61439 5.65038 4.27123 5.65038 3.84793V3.32568ZM17.1473 10.7461C17.1473 10.1978 17.1385 9.68785 17.1198 9.21315H1.84562C1.82684 9.68785 1.81808 10.1978 1.81808 10.7461C1.81808 12.6046 1.91966 13.9935 2.15357 15.046C2.3836 16.081 2.72073 16.6944 3.12755 17.1012C3.53437 17.508 4.14773 17.8452 5.18279 18.0752C6.23525 18.3091 7.62413 18.4107 9.48269 18.4107C11.3412 18.4107 12.7301 18.3091 13.7826 18.0752C14.8176 17.8452 15.431 17.508 15.8378 17.1012C16.2446 16.6944 16.5818 16.081 16.8118 15.046C17.0457 13.9935 17.1473 12.6046 17.1473 10.7461Z" />
                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M4.11719 12.2782C4.11719 11.8549 4.46034 11.5117 4.88365 11.5117H7.18303C7.60634 11.5117 7.94949 11.8549 7.94949 12.2782C7.94949 12.7015 7.60634 13.0446 7.18303 13.0446H4.88365C4.46034 13.0446 4.11719 12.7015 4.11719 12.2782ZM4.11719 15.344C4.11719 14.9207 4.46034 14.5776 4.88365 14.5776H7.18303C7.60634 14.5776 7.94949 14.9207 7.94949 15.344C7.94949 15.7673 7.60634 16.1105 7.18303 16.1105H4.88365C4.46034 16.1105 4.11719 15.7673 4.11719 15.344ZM11.9405 15.886L15.0064 12.8202C15.3057 12.5208 15.3057 12.0355 15.0064 11.7362C14.7071 11.4369 14.2218 11.4369 13.9224 11.7362L11.3986 14.2601L10.7908 13.6524C10.4915 13.353 10.0062 13.353 9.7069 13.6524C9.40758 13.9517 9.40758 14.437 9.7069 14.7363L10.8566 15.886C11.1559 16.1853 11.6412 16.1853 11.9405 15.886Z"></path>
                    </svg>
                   نوبت های من
                </a>
            </li>

            <li class="px-4 <?= $activeMenu == 'financial' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex px-4 py-3 items-center group text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450  transform transition hover:text-blue-700" href="user/financial">
                    <svg class="ml-4 mt-1" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M19.9964 5.37513H15.7618C13.7911 5.37859 12.1947 6.93514 12.1911 8.85657C12.1884 10.7823 13.7867 12.3458 15.7618 12.3484H20V12.6543C20 16.0136 17.9636 18 14.5173 18H5.48356C2.03644 18 0 16.0136 0 12.6543V5.33786C0 1.97862 2.03644 0 5.48356 0H14.5138C17.96 0 19.9964 1.97862 19.9964 5.33786V5.37513ZM4.73956 5.36733H10.3796H10.3831H10.3902C10.8124 5.36559 11.1538 5.03019 11.152 4.61765C11.1502 4.20598 10.8053 3.87318 10.3831 3.87491H4.73956C4.32 3.87664 3.97956 4.20858 3.97778 4.61852C3.976 5.03019 4.31733 5.36559 4.73956 5.36733Z"></path>
                        <path fill="currentColor" opacity="0.4" d="M14.0374 9.29657C14.2465 10.2478 15.0805 10.917 16.0326 10.8996H19.2825C19.6787 10.8996 20 10.5715 20 10.166V7.63439C19.9991 7.22973 19.6787 6.90077 19.2825 6.8999H15.9561C14.8731 6.90338 13.9983 7.80235 14 8.91018C14 9.03985 14.0128 9.16951 14.0374 9.29657Z"></path>
                        <circle fill="currentColor" cx="16" cy="8.8999" r="1"></circle>
                    </svg>
                    مالی و تراکنش ها
                </a>
            </li>
            <li class="px-4 <?= $activeMenu == 'comments' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex py-3 group px-4 items-center text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450 transform transition hover:text-blue-700" href="user/comments">
                    <svg class="ml-4 mt-1" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd" d="M9.5 0C17.3233 0 19 1.40744 19 8.44445C19 13.0186 18.2085 15.8333 14.646 15.8333C12.7422 15.8333 12.1759 16.7377 11.6486 17.5798C11.1891 18.3136 10.7592 19 9.5002 19C8.24124 19 7.81137 18.3135 7.35192 17.5798C6.82455 16.7377 6.25821 15.8333 4.35436 15.8333C0.79186 15.8333 0 12.9285 0 8.44445C0 1.49045 1.67675 0 9.5 0ZM10.2917 6.33333C10.2917 5.89611 10.6461 5.54167 11.0833 5.54167H13.4583C13.8956 5.54167 14.25 5.89611 14.25 6.33333C14.25 6.77056 13.8956 7.125 13.4583 7.125H11.0833C10.6461 7.125 10.2917 6.77056 10.2917 6.33333ZM5.54167 8.70833C5.10444 8.70833 4.75 9.06277 4.75 9.5C4.75 9.93723 5.10444 10.2917 5.54167 10.2917H13.4583C13.8956 10.2917 14.25 9.93723 14.25 9.5C14.25 9.06277 13.8956 8.70833 13.4583 8.70833H5.54167Z" fill-opacity="0.4"></path>
                    </svg>
                    نظرات من
                </a>
            </li>
            <li class="px-4 <?= $activeMenu == 'notifications' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex py-3 px-4 group items-center text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450 transform transition hover:text-blue-700" href=" user/notifications">
                    <svg class="ml-4 mt-1" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M16.7695 9.64534C16.039 8.79229 15.7071 8.05305 15.7071 6.79716V6.37013C15.7071 4.73354 15.3304 3.67907 14.5115 2.62459C13.2493 0.986993 11.1244 0 9.04423 0H8.95577C6.91935 0 4.86106 0.941671 3.577 2.5128C2.71333 3.58842 2.29293 4.68822 2.29293 6.37013V6.79716C2.29293 8.05305 1.98284 8.79229 1.23049 9.64534C0.676907 10.2738 0.5 11.0815 0.5 11.9557C0.5 12.8309 0.787226 13.6598 1.36367 14.3336C2.11602 15.1413 3.17846 15.6569 4.26375 15.7466C5.83505 15.9258 7.40634 15.9933 9.0005 15.9933C10.5937 15.9933 12.165 15.8805 13.7372 15.7466C14.8215 15.6569 15.884 15.1413 16.6363 14.3336C17.2118 13.6598 17.5 12.8309 17.5 11.9557C17.5 11.0815 17.3231 10.2738 16.7695 9.64534Z"></path>
                        <path fill="currentColor" opacity="0.4" d="M11.0078 17.2285C10.5079 17.1217 7.46168 17.1217 6.96177 17.2285C6.53441 17.3272 6.07227 17.5568 6.07227 18.0604C6.09711 18.5408 6.37837 18.9648 6.76797 19.2337L6.76697 19.2347C7.27086 19.6275 7.86221 19.8773 8.48139 19.9669C8.81135 20.0122 9.14727 20.0102 9.48916 19.9669C10.1073 19.8773 10.6987 19.6275 11.2026 19.2347L11.2016 19.2337C11.5912 18.9648 11.8724 18.5408 11.8973 18.0604C11.8973 17.5568 11.4351 17.3272 11.0078 17.2285Z"></path>
                    </svg>
                    اعلانات
                </a>
            </li>
            <li class="px-4 <?= $activeMenu == 'certifications' ? 'active_dashboard_aside_menu' : '' ?>">
                <a class="flex py-3 px-4 group items-center text-17 font-medium dark:text-white dark:hover:text-blue-450 text-gray-800 transform transition hover:text-blue-700" href="user/certifications">
                    <svg class="ml-4 mt-1 fill-current text-gray-800 dark:text-white dark:hover:text-blue-450 transition duration-200 group-hover:text-blue-700" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5036 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0463C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.299 9.012 20.0475 9.013C19.6247 9.016 19.1177 9.021 18.8088 9.021" fill="currentColor"></path>
                        <path opacity="0.4" d="M16.0837 2.56737C15.7847 2.25637 15.2627 2.47037 15.2627 2.90137V5.53837C15.2627 6.64437 16.1737 7.55437 17.2797 7.55437C17.9767 7.56237 18.9447 7.56437 19.7667 7.56237C20.1877 7.56137 20.4017 7.05837 20.1097 6.75437C19.0547 5.65737 17.1657 3.69137 16.0837 2.56737" fill="currentColor"></path>
                        <path d="M10.9299 17C10.7278 17 10.5258 16.9215 10.3716 16.7636L8.23134 14.5719C7.92289 14.2561 7.92289 13.7444 8.23134 13.4295C8.5398 13.1136 9.03856 13.1127 9.34701 13.4285L10.9299 15.0494L14.653 11.2369C14.9614 10.921 15.4602 10.921 15.7687 11.2369C16.0771 11.5528 16.0771 12.0644 15.7687 12.3803L11.4882 16.7636C11.3339 16.9215 11.1319 17 10.9299 17" fill="currentColor"></path>
                    </svg>
                    گواهی و تاییدیه ها
                </a>
            </li>
            <li class="px-4 <?= $activeMenu == 'profile' ? 'active_dashboard_aside_menu' : '' ?>">
                <a href="user/profile" class="flex py-3 px-4 group items-center text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450 transform transition hover:text-blue-700">
                    <svg class="ml-4 mt-1" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M7.99682 13.1743C3.68382 13.1743 -0.000183105 13.8543 -0.000183105 16.5743C-0.000183105 19.2953 3.66082 19.9993 7.99682 19.9993C12.3098 19.9993 15.9938 19.3203 15.9938 16.5993C15.9938 13.8783 12.3338 13.1743 7.99682 13.1743Z"></path>
                        <path fill="currentColor" opacity="0.4" d="M7.99683 10.5835C10.9348 10.5835 13.2888 8.22851 13.2888 5.29151C13.2888 2.35451 10.9348 -0.000488281 7.99683 -0.000488281C5.05983 -0.000488281 2.70483 2.35451 2.70483 5.29151C2.70483 8.22851 5.05983 10.5835 7.99683 10.5835Z"></path>
                    </svg>
                    اطلاعات حساب کاربری
                </a>
            </li>
            <li class="px-4">
                <a href="user/logout" class="flex py-3 px-4 group items-center text-17 font-medium text-gray-800 dark:text-white dark:hover:text-blue-450 transform transition hover:text-blue-700">
                    <svg class="ml-4 mt-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" opacity="0.4" d="M0 4.447C0 1.996 2.03024 0 4.52453 0H9.48564C11.9748 0 14 1.99 14 4.437V15.553C14 18.005 11.9698 20 9.47445 20H4.51537C2.02515 20 0 18.01 0 15.563V14.623V4.447Z"></path>
                        <path fill="currentColor" d="M19.7789 9.45504L16.9331 6.54604C16.639 6.24604 16.1657 6.24604 15.8725 6.54804C15.5803 6.85004 15.5813 7.33704 15.8745 7.63704L17.4337 9.23004H15.9387H7.54844C7.13452 9.23004 6.79852 9.57504 6.79852 10C6.79852 10.426 7.13452 10.77 7.54844 10.77H17.4337L15.8745 12.363C15.5813 12.663 15.5803 13.15 15.8725 13.452C16.0196 13.603 16.2114 13.679 16.4043 13.679C16.5952 13.679 16.787 13.603 16.9331 13.454L19.7789 10.546C19.9201 10.401 20 10.205 20 10C20 9.79604 19.9201 9.60004 19.7789 9.45504Z"></path>
                    </svg>
                    خروج
                </a>
            </li>
        </ul>
    </div>

</aside>