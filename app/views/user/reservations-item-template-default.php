<div class="group h-full bg-white dark:bg-dark-920 flex flex-col flex-grow rounded-xl px-4 pt-4 pb-5">
    <a href="user/reservations/details/<?= $booking['order_service_vids_id'] ?>" class="inline-block w-full xl:h-36 sm:h-40 h-52 rounded-lg overflow-hidden relative mb-4">
        <img class="w-full h-full object-cover group-hover:scale-110 transform transition duration-200 z-0" onerror="this.src='public/images/default_cover.jpg'" src="public/images/services/<?= $booking['s_cover'] ?>" alt="تصویر <?= $booking['s_title'] ?>" />
    </a>
    <div class="flex flex-col flex-grow">
        <div class="flex space-x-3 space-x-reverse">
            <span class="flex items-center text-blue-700 font-semibold text-xs mb-2">
                <svg class="ml-1" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="3.57789" cy="3.28785" r="2.74867" fill="currentColor"></circle>
                </svg>
                <?= $booking['order_service_vids_id'] ?>
            </span>
            <span class="flex items-center text-blue-700 font-semibold text-xs mb-2">
                <svg class="ml-1" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="3.57789" cy="3.28785" r="2.74867" fill="currentColor"></circle>
                </svg>
                <?= $booking['b_name'] ?>
            </span>
        </div>
        <h5 class="text-biscay-700 font-semibold text-lg dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200">
            <a href="services/<?= $booking['s_slug'] ?>">
                <?= $booking['s_title'] ?>
            </a>
        </h5>
    </div>
    <hr class="border-gray-350 dark:border-white dark:border-opacity-10 border-opacity-10 my-4" />
    <div class="flex items-center mb-5">
        <a href="user/reservations/details/<?= $booking['order_service_vids_id'] ?>">
            <div class="overflow-hidden w-4 h-8 rounded-md">
                <svg class="mb-3" width="15" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1792 23.9333C2.54046 23.9333 0.474609 21.8674 0.474609 12.2287C0.474609 2.59002 2.54046 0.52417 12.1792 0.52417C21.8178 0.52417 23.8837 2.59002 23.8837 12.2287C23.8837 21.8674 21.8178 23.9333 12.1792 23.9333ZM11.2038 6.37644C11.2038 5.83773 11.6405 5.40106 12.1792 5.40106C12.7178 5.40106 13.1545 5.83773 13.1545 6.37644V11.2533H18.0314C18.5701 11.2533 19.0068 11.69 19.0068 12.2287C19.0068 12.7674 18.5701 13.2041 18.0314 13.2041H12.1792C11.6405 13.2041 11.2038 12.7674 11.2038 12.2287V6.37644Z" fill="#60422b"></path>
                </svg>
            </div>
        </a>
        <div class="mr-3">
            <h6 class="text-biscay-700 font-semibold text-md dark:text-white dark:hover:text-blue-450 hover:text-blue-700 transition duration-200">
                <a>
                    <?= $booking['sre_day']." ".$booking['sre_date']." ساعت ".$booking['sre_time'] ?>
                </a>
            </h6>
        </div>
    </div>
    <div class="text-left">
        <span class="text-<?= $booking['background_color'] ?>-500 text-xs font-medium mb-1">
            <?= $booking['statusTitle'] ?>
        </span>
        <div>
            <div class="w-full h-1 rounded-3xl overflow-hidden bg-blue-60">
                <div class="bg-<?= $booking['background_color'] ?>-500 h-full " style="width:<?= $booking['percent'] ?>%"></div>
            </div>
        </div>
    </div>
    <ul class="mt-4 bg-green-700 bg-opacity-10 rounded-lg">
        <li class="flex items-center justify-center py-4 text-green-700 border-b border-green-700 border-opacity-20 last:border-0 ">
            <a class="flex items-center text-sm font-medium group transition duration-200 hover:text-biscay-700 dark:hover:text-white" href="user/reservations/details/<?= $booking['order_service_vids_id'] ?>">
                مشاهده جزئیات خدمت
                <svg class="mr-1" width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" opacity="0.4" d="M13.037 4.97372L16.7923 4.6416C17.6351 4.6416 18.3184 5.33155 18.3184 6.18252C18.3184 7.0335 17.6351 7.72345 16.7923 7.72345L13.037 7.39133C12.3758 7.39133 11.8398 6.85011 11.8398 6.18252C11.8398 5.51382 12.3758 4.97372 13.037 4.97372"></path>
                    <path fill="currentColor" d="M0.42607 5.03477C0.484764 4.9755 0.704038 4.72502 0.910022 4.51702C2.1116 3.21429 5.24898 1.08405 6.89021 0.432125C7.13939 0.32813 7.76952 0.10672 8.10729 0.0910645C8.42956 0.0910645 8.73742 0.165986 9.0309 0.313593C9.39746 0.520465 9.68983 0.846989 9.85151 1.23166C9.9545 1.4978 10.1162 2.29734 10.1162 2.31187C10.2768 3.18521 10.3643 4.60537 10.3643 6.17536C10.3643 7.66932 10.2768 9.03133 10.145 9.9192C10.1306 9.93486 9.9689 10.9267 9.79282 11.2667C9.47055 11.8884 8.84042 12.2731 8.16598 12.2731H8.10729C7.66764 12.2585 6.74403 11.8728 6.74403 11.8593C5.19029 11.2074 2.1271 9.18005 0.895625 7.83258C0.895625 7.83258 0.547888 7.48593 0.397276 7.27011C0.162499 6.95924 0.0451098 6.57457 0.0451098 6.1899C0.0451098 5.7605 0.176895 5.36129 0.42607 5.03477"></path>
                </svg>
            </a>
        </li>
    </ul>
</div>