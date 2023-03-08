<div class="shadow-smswiper-slide-active rounded-lg bg-white dark:bg-dark-930 relative pt-32 flex justify-center h-full">
    <div class="absolute -top-12 w-full  px-4 ">
        <a href="services/<?= $service['s_slug'] ?>" class=" inline-block h-40 overflow-hidden w-full rounded-lg">
            <img class="w-full h-full object-cover transform transition duration-200 hover:scale-110"
                 onerror="this.src='public/images/default_cover.jpg'"
                 src="public/images/services/<?= $service['s_cover'] ?>" alt="<?= $service['s_title'] ?>">
        </a>
    </div>
    <div class="flex flex-col flex-1 w-full space-y-2">
        <div class=" px-4 flex flex-col flex-grow" style="min-height: 120px;">
            <a href="services/<?= $service['s_slug'] ?>" class="mb-2 inline-block">
                <span class="text-xl font-bold text-gray-800 dark:hover:text-blue-450 dark:text-white hover:text-blue-700 duration-200 transition"><?= $service['s_title'] ?></span>
            </a>
            <p class="mb-2 text-gray-360 dark:text-gray-940 text-sm font-normal  overflow-hidden leading-6"><?= $service['seo_desc'] ?></p>
        </div>
        <div>
            <div class="flex justify-center border-t border-gray-300 border-opacity-10">
                <a href="services/<?= $service['s_slug'] ?>" class="flex items-center my-4 transform group 0 font-bold text-base transition duration-200 dark:hover:text-gray-20 hover:text-dark-700 text-blue-700 dark:text-blue-950">
                    <span>مشاهده جزئیات و رزرو نوبت</span>
                    <svg class="mr-1 -mt-0.5" width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" opacity="0.4" d="M16.7544 11.5347L20.5098 11.2026C21.3525 11.2026 22.0358 11.8925 22.0358 12.7435C22.0358 13.5945 21.3525 14.2844 20.5098 14.2844L16.7544 13.9523C16.0933 13.9523 15.5573 13.4111 15.5573 12.7435C15.5573 12.0748 16.0933 11.5347 16.7544 11.5347Z"></path>
                        <path fill="currentColor" d="M4.14372 11.5957C4.20242 11.5365 4.42169 11.286 4.62767 11.078C5.82925 9.77526 8.96663 7.64503 10.6079 6.9931C10.857 6.8891 11.4872 6.66769 11.8249 6.65204C12.1472 6.65204 12.4551 6.72696 12.7485 6.87457C13.1151 7.08144 13.4075 7.40796 13.5692 7.79263C13.6722 8.05877 13.8338 8.85831 13.8338 8.87285C13.9944 9.74619 14.0819 11.1663 14.0819 12.7363C14.0819 14.2303 13.9944 15.5923 13.8626 16.4802C13.8482 16.4958 13.6866 17.4877 13.5105 17.8276C13.1882 18.4494 12.5581 18.8341 11.8836 18.8341H11.8249C11.3853 18.8195 10.4617 18.4337 10.4617 18.4203C8.90794 17.7684 5.84475 15.741 4.61328 14.3936C4.61328 14.3936 4.26554 14.0469 4.11493 13.8311C3.88015 13.5202 3.76276 13.1355 3.76276 12.7509C3.76276 12.3215 3.89455 11.9223 4.14372 11.5957Z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>