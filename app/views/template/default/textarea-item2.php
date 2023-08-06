<section class="xl:mt-11 lg:mt-11 mt-14">
    <div x-data="{showMore:false}" class="relative border-gray-5 dark:border-opacity-20 border-2 rounded-lg mb-32">
        <div class="p-5" x-transition :class="{'h-550 overflow-hidden' : !showMore}">
            <div class="absolute bottom-full lg:-mb-5 -mb-3 ">
                <svg class=" w-7 h-8 text-customOrange-700 mr-2 mb-4" viewBox="0 0 33 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33 0H6V9C6 23.9117 18.0883 36 33 36V36V0Z" fill="currentColor" fill-opacity="0.2"/>
                    <path d="M27 6H-7.00355e-07V15C-7.00355e-07 29.9117 12.0883 42 27 42V42V6Z" fill="currentColor"/>
                </svg>
                <h3 class=" lg:text-33 sm:text-2xl text-lg font-bold  px-3 text-biscay-700 dark:bg-dark-890 dark:text-white bg-gray-3"><?= $value[$file]['title'] ?></h3>
            </div>
            <div class="md:text-right text-center content-area text-gray-360 ">
                <p dir="RTL"><?= htmlspecialchars_decode($value[$file]['description']) ?></p>
                <p><!-- /wp:paragraph --></p>
            </div>
        </div>
        <template x-if="showMore === false">
            <div class="bg-gradient-to-t absolute bottom-0 right-0 w-full h-56 dark:from-dark-890 from-white rounded-lg to-transparent"></div>
        </template>
        <button x-show="showMore" @click="showMore = !showMore" class="text-gray-300 flex dark:bg-dark-890 dark:hover:border-blue-450 dark:hover:text-blue-450 dark:text-white items-center md:text-22 text-lg font-medium px-4 py-2 border border-gray-210 rounded-lg absolute right-1/2 top-full transform bg-white -mt-6 translate-x-1/2 hover:bg-gray-300 hover:text-white transition duration-200">
            بستن مطلب
            <span class="mr-2">
                <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.441643 5.89359C-0.147214 6.53437 -0.147214 7.46563 0.441643 8.10641C2.25469 10.0793 6.54403 14 12 14C17.456 14 21.7453 10.0793 23.5584 8.10641C24.1472 7.46563 24.1472 6.53437 23.5584 5.89359C21.7453 3.92067 17.456 0 12 0C6.54403 0 2.25469 3.92067 0.441643 5.89359ZM12 2C7.68339 2 4.04578 5.05757 2.20582 7C4.04578 8.94243 7.68339 12 12 12C16.3166 12 19.9542 8.94243 21.7942 7C19.9542 5.05757 16.3166 2 12 2Z" fill="currentColor" fill-opacity="0.4" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 7C9 8.65685 10.3431 10 12 10C13.6569 10 15 8.65685 15 7C15 5.34315 13.6569 4 12 4C10.3431 4 9 5.34315 9 7ZM11 7C11 7.55228 11.4477 8 12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7Z" fill="currentColor" />
                </svg>
            </span>
        </button>
        <button x-show="!showMore" @click="showMore = !showMore" class="text-gray-300 flex dark:bg-dark-890 dark:hover:border-blue-450 dark:hover:text-blue-450 dark:text-white items-center md:text-22 text-lg font-medium px-4 py-2 border border-gray-210 rounded-lg absolute right-1/2 top-full transform bg-white -mt-6 translate-x-1/2 hover:bg-gray-300 hover:text-white transition duration-200">
            ادامه مطلب
            <span class="mr-2">
                <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.441643 5.89359C-0.147214 6.53437 -0.147214 7.46563 0.441643 8.10641C2.25469 10.0793 6.54403 14 12 14C17.456 14 21.7453 10.0793 23.5584 8.10641C24.1472 7.46563 24.1472 6.53437 23.5584 5.89359C21.7453 3.92067 17.456 0 12 0C6.54403 0 2.25469 3.92067 0.441643 5.89359ZM12 2C7.68339 2 4.04578 5.05757 2.20582 7C4.04578 8.94243 7.68339 12 12 12C16.3166 12 19.9542 8.94243 21.7942 7C19.9542 5.05757 16.3166 2 12 2Z" fill="currentColor" fill-opacity="0.4" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 7C9 8.65685 10.3431 10 12 10C13.6569 10 15 8.65685 15 7C15 5.34315 13.6569 4 12 4C10.3431 4 9 5.34315 9 7ZM11 7C11 7.55228 11.4477 8 12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6C11.4477 6 11 6.44772 11 7Z" fill="currentColor" />
                </svg>
            </span>
        </button>
    </div>
</section>