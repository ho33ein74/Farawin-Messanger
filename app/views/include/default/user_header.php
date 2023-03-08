<header class="bg-white dark:bg-dark-920">
    <div class="flex items-center justify-between pt-9 pb-5 xl:pl-8 xl:pr-14  px-4">
        <div class="flex items-center">
            <button @click="$dispatch('aside-handler-show'),$dispatch('change-overlay-show')" class="lg:hidden ml-2 w-9 h-9 rounded-lg bg-gray-800 flex items-center justify-center">
                <svg width="19" height="19" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.01554 14.0316C1.23804 14.0316 -0.000244141 12.7933 -0.000244141 7.01579C-0.000244141 1.23829 1.23804 0 7.01554 0C12.793 0 14.0313 1.23829 14.0313 7.01579C14.0313 12.7933 12.793 14.0316 7.01554 14.0316ZM4.0923 3.50789C3.76941 3.50789 3.50765 3.76965 3.50765 4.09254C3.50765 4.41543 3.76941 4.67719 4.0923 4.67719H5.84624C6.16914 4.67719 6.43089 4.41543 6.43089 4.09254C6.43089 3.76965 6.16914 3.50789 5.84624 3.50789H4.0923ZM3.50765 7.01579C3.50765 6.69289 3.76941 6.43114 4.0923 6.43114H9.93879C10.2617 6.43114 10.5234 6.69289 10.5234 7.01579C10.5234 7.33868 10.2617 7.60044 9.93879 7.60044H4.0923C3.7694 7.60044 3.50765 7.33868 3.50765 7.01579ZM8.18484 9.35438C7.86195 9.35438 7.60019 9.61614 7.60019 9.93903C7.60019 10.2619 7.86195 10.5237 8.18484 10.5237H9.93879C10.2617 10.5237 10.5234 10.2619 10.5234 9.93903C10.5234 9.61614 10.2617 9.35438 9.93879 9.35438H8.18484Z" fill="white" />
                </svg>
            </button>
            <div class="flex sm:flex-row flex-col sm:items-center">
                <h6 class="font-bold sm:text-2xl dark:text-white text-sm text-gray-800"><?= $data['infoUser']['c_name'] ?> عزیز ؛خوش اومدی. 👋</h6>
                <i class="sm:flex hidden mx-5 h-6 border-l border-gray-350 border-opacity-30"></i>
                <span class="text-gray-350 dark:text-gray-810 sm:text-base text-xs "><?= jdate("l, j F Y") ?></span>
            </div>
        </div>
        <div class="flex items-center">
            <div class="hidden md:flex">
                <button onclick="toLightMode()" title="تم تاریک" class="group mb-1 hidden ml-7  header__moon group w-22  items-center relative  dark:bg-dark-920 justify-center rounded-full  transition cursor-pointer">
                    <svg class=" text-biscay-700 dark:text-white dark:group-hover:text-blue-450 group-hover:text-white transition duration-200" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9358 14.3652C20.0691 14.0415 19.9906 13.6679 19.7389 13.4276C19.4872 13.1873 19.115 13.1308 18.8051 13.2857C17.7584 13.8091 16.5801 14.1034 15.3317 14.1034C10.9835 14.1034 7.45846 10.5246 7.45846 6.1098C7.45846 4.32254 8.0352 2.67449 9.01033 1.34372C9.21644 1.06244 9.22917 0.680892 9.04229 0.386091C8.85541 0.0912907 8.50809 -0.054977 8.17055 0.0189828C3.50017 1.04235 2.17361e-07 5.25905 0 10.3077C-2.50276e-07 16.1208 4.64155 20.8333 10.3672 20.8333C14.6778 20.8333 18.372 18.1625 19.9358 14.3652Z" fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0928 3.67116L13.7596 1.84183C13.9751 1.25035 14.4797 0.939795 14.9987 0.910156C15.5177 0.939795 16.0222 1.25035 16.2378 1.84183L16.9045 3.67116L18.7063 4.34807C19.9329 4.8089 19.9329 6.57032 18.7063 7.03114L16.9045 7.70806L16.2378 9.53738C16.0222 10.1289 15.5177 10.4394 14.9987 10.4691C14.4797 10.4394 13.9751 10.1289 13.7596 9.53738L13.0928 7.70806L11.2911 7.03114C10.0644 6.57032 10.0644 4.8089 11.2911 4.34807L13.0928 3.67116Z" fill="currentColor" fill-opacity="0.4"></path>
                    </svg>
                </button>
                <button onclick="toSystemMode()" title="تم روشن" class="group mb-1 ml-7  header__sun group w-7 hidden items-center relative  dark:bg-dark-920 justify-center rounded-full  transition cursor-pointer">
                    <svg class=" text-biscay-700 dark:text-white dark:group-hover:text-dark-920 group-hover:text-black transition duration-200" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <button onclick="toDarkMode()" title="دارک مود بر اساس سیستم شما" class="group mb-1 header__indeterminate  ml-7  group w-7 hidden items-center relative  dark:bg-dark-920 justify-center rounded-full  transition cursor-pointer">
                    <svg class=" text-biscay-700 dark:text-white dark:group-hover:text-blue-450 group-hover:text-blue-450 transition duration-200" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12A10 10 0 0 0 12 22A10 10 0 0 0 22 12A10 10 0 0 0 12 2M12 4A8 8 0 0 1 20 12A8 8 0 0 1 12 20V4Z"></path>
                    </svg>
                </button>
            </div>
            <a href="cart" class="mb-2 ml-6 md:flex hidden">
                <svg width="25" class=" text-biscay-700 dark:text-white  dark:hover:text-blue-450 transition duration-200" height="27" viewBox="0 0 25 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6422 25.8754H7.20742C3.37447 25.8754 0.43397 24.4909 1.26921 18.9188L2.24175 11.3673C2.75662 8.58702 4.53008 7.52295 6.08614 7.52295H18.8093C20.3882 7.52295 22.0587 8.66711 22.6536 11.3673L23.6262 18.9188C24.3356 23.8616 21.4752 25.8754 17.6422 25.8754Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M17.8138 7.24816C17.8138 4.26557 15.3959 1.8477 12.4133 1.8477V1.8477C10.9771 1.84162 9.59757 2.40791 8.57983 3.42135C7.56209 4.43479 6.98998 5.8119 6.98999 7.24816H6.98999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M16.1205 12.8773H16.0633" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M8.83213 12.8773H8.77492" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
            <a href="user/notifications" class="-mt-1.5 py-1 px-2 bg-white dark:bg-transparent rounded-lg relative">
                <svg width="24" class="text-biscay-700 dark:text-white dark:hover:text-blue-450 dark:hover:text-blue-450 transition duration-200" height="28" viewBox="0 0 24 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 21.3096C19.049 21.3096 22.3101 20.4053 22.625 16.7756C22.625 13.1485 20.3514 13.3817 20.3514 8.93139C20.3514 5.45518 17.0565 1.5 12 1.5C6.94346 1.5 3.64856 5.45518 3.64856 8.93139C3.64856 13.3817 1.375 13.1485 1.375 16.7756C1.69119 20.419 4.95222 21.3096 12 21.3096Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.9861 25.0713C13.2809 26.9647 10.6209 26.9871 8.89941 25.0713" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </a>
        </div>
    </div>
</header>