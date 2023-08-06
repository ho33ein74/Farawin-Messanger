<?php if(sizeof($contents)>0){ ?>
    <section class="xl:mt-11 lg:mt-11 mt-14 mb-11">
        <div class="main-slider">
            <div class="swiper mySwiper mainSlider">
                <div class="swiper-wrapper">
                    <?php foreach ($contents as $slider) { ?>
                        <div class="swiper-slide">
                            <a href="<?= $slider['si_link'] ?>" target="_blank">
                                <img loading="lazy" src="public/images/slider/<?= $slider['si_image'] ?>" data-src="public/images/slider/<?= $slider['si_image'] ?>"
                                     alt="<?= $slider['si_title'] ?>" class="img-fluid">
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
<?php } ?>
