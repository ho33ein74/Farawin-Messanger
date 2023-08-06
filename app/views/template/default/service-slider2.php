<?php if (sizeof($contents)>0) { ?>
    <section>
            <div class="flex items-center justify-between md:flex-row flex-col">
                <div class="flex items-center self-start">
                    <svg class="text-dark-550 dark:text-white ml-4" width="37" height="34" viewBox="0 0 37 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="24" r="10" fill="currentColor"></circle>
                        <circle cx="30" cy="13" r="7" fill="currentColor" fill-opacity="0.4"></circle>
                        <circle cx="15" cy="4" r="4" fill="currentColor" fill-opacity="0.7"></circle>
                    </svg>
                    <h3 class="text-biscay-700 dark:text-white font-extrabold sm:text-4xl text-2xl sm:mb-0 mb-3">
                        <?= $value[$file]['title'] ?>
                    </h3>
                </div>
                <div class="self-end">
                    <a href="<?= $value[$file]['link'] ?>" class="flex items-center text-dark-550 dark:hover:text-gray-20 dark:text-white font-normal md:text-22 text-base ml-2 transition duration-200  hover:text-dark-700">
                        <span><?= $value[$file]['link_title'] ?></span>
                        <svg class="mr-2" width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" opacity="0.4" d="M16.5073 5.95329L21.0752 5.54932C22.1003 5.54932 22.9315 6.38856 22.9315 7.42367C22.9315 8.45878 22.1003 9.29802 21.0752 9.29802L16.5073 8.89404C15.7031 8.89404 15.0511 8.23571 15.0511 7.42367C15.0511 6.61027 15.7031 5.95329 16.5073 5.95329"></path>
                            <path fill="currentColor" d="M1.16786 6.02753C1.23926 5.95544 1.50598 5.65076 1.75653 5.39776C3.21811 3.81313 7.03437 1.22195 9.03073 0.428959C9.33382 0.302461 10.1003 0.0331419 10.5112 0.0140991C10.9032 0.0140991 11.2776 0.105232 11.6346 0.284778C12.0805 0.536415 12.4361 0.933592 12.6328 1.4015C12.7581 1.72523 12.9548 2.69777 12.9548 2.71545C13.1501 3.77776 13.2565 5.50521 13.2565 7.41493C13.2565 9.23215 13.1501 10.8889 12.9898 11.9689C12.9723 11.9879 12.7756 13.1944 12.5614 13.6079C12.1694 14.3642 11.4029 14.8321 10.5826 14.8321H10.5112C9.97638 14.8144 8.85292 14.3451 8.85292 14.3288C6.96297 13.5358 3.23697 11.0698 1.73902 9.43074C1.73902 9.43074 1.31604 9.00908 1.13284 8.74656C0.84726 8.36843 0.70447 7.90052 0.70447 7.43261C0.70447 6.9103 0.864772 6.42471 1.16786 6.02753"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="swiper learning_path_slider with-bg-next py-7 swiper-initialized swiper-horizontal swiper-pointer-events swiper-rtl mt-10">
                <div class="swiper-wrapper pb-10" style="transition-duration: 0ms; transform: translate3d(856px, 0px, 0px);">
                    <?php foreach($contents as $service){ ?>
                        <div class="swiper-slide" style="width: 402px; margin-left: 26px;">
                            <div class="hover:bg-white dark:hover:bg-opacity-5 dark:hover:bg-white hover:shadow-cardShadow group duration-200 transition border-gray-80 dark:hover:border-dark-890 dark:border-dark-500 border-opacity-60 rounded-lg">
                                <?php require('app/views/template/default/items/service-item.php'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="arrow__circls flex items-center justify-center relative">
                    <div class="swiper-button-prev h-4 ml-5 mt-0 left-0 relative">
                        <svg class="text-dark-550 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M7.12872 6.34863L2.5608 5.94466C1.53567 5.94466 0.704529 6.7839 0.704529 7.81901C0.704529 8.85412 1.53567 9.69336 2.5608 9.69336L7.12872 9.28938C7.93292 9.28938 8.58491 8.63105 8.58491 7.81901C8.58491 7.00561 7.93292 6.34863 7.12872 6.34863" fill="currentColor"></path>
                            <path d="M22.4681 6.42292C22.3967 6.35083 22.13 6.04614 21.8795 5.79314C20.4179 4.20852 16.6016 1.61734 14.6053 0.824345C14.3022 0.697847 13.5357 0.428528 13.1248 0.409485C12.7328 0.409485 12.3583 0.500618 12.0014 0.680164C11.5555 0.931801 11.1999 1.32898 11.0032 1.79689C10.8779 2.12061 10.6812 3.09315 10.6812 3.11084C10.4859 4.17315 10.3795 5.9006 10.3795 7.81032C10.3795 9.62754 10.4859 11.2843 10.6462 12.3643C10.6637 12.3833 10.8604 13.5898 11.0746 14.0033C11.4666 14.7596 12.2331 15.2275 13.0534 15.2275H13.1248C13.6596 15.2098 14.7831 14.7405 14.7831 14.7242C16.673 13.9312 20.399 11.4652 21.897 9.82613C21.897 9.82613 22.3199 9.40447 22.5031 9.14195C22.7887 8.76381 22.9315 8.29591 22.9315 7.828C22.9315 7.30568 22.7712 6.82009 22.4681 6.42292" fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="swiper-pagination flex items-center relative swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>
                    <div class="swiper-button-next h-4 mr-5 right-0 mt-0 relative">
                        <svg class="text-dark-550 dark:text-white" width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M16.5073 6.34863L21.0752 5.94466C22.1003 5.94466 22.9315 6.7839 22.9315 7.81901C22.9315 8.85412 22.1003 9.69336 21.0752 9.69336L16.5073 9.28938C15.7031 9.28938 15.0511 8.63105 15.0511 7.81901C15.0511 7.00561 15.7031 6.34863 16.5073 6.34863" fill="currentColor"></path>
                            <path d="M1.16786 6.42292C1.23926 6.35083 1.50598 6.04614 1.75653 5.79314C3.21811 4.20852 7.03437 1.61734 9.03073 0.824345C9.33382 0.697847 10.1003 0.428528 10.5112 0.409485C10.9032 0.409485 11.2776 0.500618 11.6346 0.680164C12.0805 0.931801 12.4361 1.32898 12.6328 1.79689C12.7581 2.12061 12.9548 3.09315 12.9548 3.11084C13.1501 4.17315 13.2565 5.9006 13.2565 7.81032C13.2565 9.62754 13.1501 11.2843 12.9898 12.3643C12.9723 12.3833 12.7756 13.5898 12.5614 14.0033C12.1694 14.7596 11.4029 15.2275 10.5826 15.2275H10.5112C9.97638 15.2098 8.85292 14.7405 8.85292 14.7242C6.96297 13.9312 3.23697 11.4652 1.73902 9.82613C1.73902 9.82613 1.31604 9.40447 1.13284 9.14195C0.84726 8.76381 0.70447 8.29591 0.70447 7.828C0.70447 7.30568 0.864772 6.82009 1.16786 6.42292" fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
            </div>
    </section>
<?php } ?>