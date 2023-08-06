<?php if (sizeof($contents) > 0) { ?>
    <section>
        <div class="px-6 ">
            <div class="grid lg:grid-cols-<?= sizeof($contents) ?> md:grid-cols-<?= sizeof($contents) ?> sm:grid-cols-<?= sizeof($contents) ?> gap-10">
                <?php foreach ($contents as $item) { ?>
                    <div class="about_us_mey_team flex flex-col items-center rounded-xl pt-8 pb-9">
                        <div wire:id="0j4cgteIpUUcup9UOyU1" class="relative " style="" x-data="{ hover : false}"
                             @mouseenter="hover = true" @mouseleave="hover = false">
                            <a href="<?= $item['bi_link'] ?>" target="_blank">
                                <img class="transition duration-200 transform group-hover:scale-110 w-full h-full"
                                     src="public/images/banner/<?= $item['bi_image'] ?>"
                                     alt="<?= $item['bi_description'] ?>"
                                     loading="lazy"
                                     srcset="public/images/banner/<?= $item['bi_image'] ?>">
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>