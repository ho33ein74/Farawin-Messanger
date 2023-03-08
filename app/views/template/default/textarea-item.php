<section class="xl:mt-11 lg:mt-11 mt-14">
    <div class="container">
        <div>
            <svg class=" w-7 h-8 text-customOrange-700 mb-1" viewBox="0 0 33 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M33 0H6V9C6 23.9117 18.0883 36 33 36V36V0Z" fill="currentColor" fill-opacity="0.2"></path>
                <path d="M27 6H-7.00355e-07V15C-7.00355e-07 29.9117 12.0883 42 27 42V42V6Z" fill="currentColor"></path>
            </svg>
            <h3 class=" md:text-33 text-25 font-bold text-biscay-700 dark:text-white "><?= $value[$file]['title'] ?></h3>
            <p class="md:text-22 text-base  text-gray-360 md:leading-10 dark:text-gray-920 leading-7 mb-8"><?= htmlspecialchars_decode($value[$file]['description']) ?></p>
        </div>
    </div>
</section>
