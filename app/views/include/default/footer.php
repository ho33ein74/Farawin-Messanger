<?php if($data['getPublicInfo']['float_contact'] == 1){ ?>
    <div id="arcontactus"></div>
    <div id="arcu-popup-content-0" class="arcu-popup-html">
        متن دلخواه جهت نمایش در پاپ آپ در این قسمت قرار می گیرد
    </div>
<?php } ?>

<footer class="relative z-0">
    <div class="container">
        <div class="content pb-10 pt-10">

            <?php if (
                    $data['getPublicInfo']['footer_logo'] == "1" OR
                    ($data['getMethodsContacting']['telegram']['mc_show_in_footer'] == "1" AND $data['getMethodsContacting']['telegram']['mc_link'] != NULL) OR
                    ($data['getMethodsContacting']['instagram']['mc_show_in_footer'] == "1" AND $data['getMethodsContacting']['instagram']['mc_link'] != NULL) OR
                    ($data['getMethodsContacting']['twitter']['mc_show_in_footer'] == "1" AND $data['getMethodsContacting']['twitter']['mc_link'] != NULL) OR
                    ($data['getMethodsContacting']['facebook']['mc_show_in_footer'] == "1" AND $data['getMethodsContacting']['facebook']['mc_link'] != NULL) OR
                    ($data['getMethodsContacting']['youtube']['mc_show_in_footer'] == "1" AND $data['getMethodsContacting']['youtube']['mc_link'] != NULL)
            ) { ?>
                <div class="mb-12 relative">
                    <span class="absolute border-t border-1 sm:top-2/4 top-5 trasform sm:translate-y-2/4 border-chambray-100 w-full z-0 right-0"></span>
                    <div class="flex items-center justify-between sm:flex-row flex-col relative z-10">

                        <?php if ($data['getPublicInfo']['footer_logo'] == "1") { ?>
                            <div class="logo w-fit-content sm:px-0 px-5 sm:mb-0 mb-6 flex items-center rounded justify-center bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                <img style="enable-background: new 0 0 578 128" width="220" id="Layer_1" src="public/images/logos/<?= $data['getPublicInfo']['logo'] ?>" alt="<?= $data['getPublicInfo']['site']; ?>">
                            </div>
                        <?php } ?>

                        <ul class="flex sm:pr-8 self-center ">
                            <?php if ($data['getMethodsContacting']['youtube']['mc_show_in_footer'] == "1" and $data['getMethodsContacting']['youtube']['mc_link'] != NULL) { ?>
                                <li>
                                    <a href="<?= $data['getMethodsContacting']['youtube']['mc_link']; ?>" class="group flex items-center rounded justify-center w-10 h-10 bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                        <svg width="19" height="14" viewBox="0 0 19 14" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M18.6728 2.84651C18.6728 2.84651 18.4918 1.56883 17.9344 1.00782C17.2286 0.269445 16.4396 0.265826 16.0776 0.222392C13.4861 0.0341796 9.59518 0.0341797 9.59518 0.0341797H9.58794C9.58794 0.0341797 5.69701 0.0341796 3.10547 0.222392C2.74352 0.265826 1.95448 0.269445 1.24868 1.00782C0.691281 1.56883 0.513926 2.84651 0.513926 2.84651C0.513926 2.84651 0.325714 4.34859 0.325714 5.84705V7.2514C0.325714 8.74986 0.510307 10.2519 0.510307 10.2519C0.510307 10.2519 0.69128 11.5296 1.24506 12.0906C1.95086 12.829 2.87744 12.8037 3.29006 12.8833C4.77404 13.0245 9.59155 13.0679 9.59155 13.0679C9.59155 13.0679 13.4861 13.0607 16.0776 12.8761C16.4396 12.8326 17.2286 12.829 17.9344 12.0906C18.4918 11.5296 18.6728 10.2519 18.6728 10.2519C18.6728 10.2519 18.8574 8.75348 18.8574 7.2514V5.84705C18.8574 4.34859 18.6728 2.84651 18.6728 2.84651ZM7.67686 8.95617V3.74776L12.6826 6.36101L7.67686 8.95617Z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['facebook']['mc_show_in_footer'] == "1" and $data['getMethodsContacting']['facebook']['mc_link'] != NULL) { ?>
                                <li class="mr-2">
                                    <a href="<?= $data['getMethodsContacting']['facebook']['mc_link']; ?>" class="group flex items-center rounded justify-center w-10 h-10 bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M16.1408 8.59849C16.1408 4.2531 12.6181 0.730469 8.27274 0.730469C3.92735 0.730469 0.404724 4.2531 0.404724 8.59849C0.404724 12.5256 3.28193 15.7807 7.04336 16.3709V10.8728H5.04563V8.59849H7.04336V6.86506C7.04336 4.89314 8.21804 3.80391 10.0152 3.80391C10.8758 3.80391 11.7765 3.95759 11.7765 3.95759V5.89386H10.7844C9.80701 5.89386 9.50212 6.5004 9.50212 7.12323V8.59849H11.6843L11.3354 10.8728H9.50212V16.3709C13.2636 15.7807 16.1408 12.5256 16.1408 8.59849Z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['twitter']['mc_show_in_footer'] == "1" and $data['getMethodsContacting']['twitter']['mc_link'] != NULL) { ?>
                                <li class="mr-2">
                                    <a href="<?= $data['getMethodsContacting']['twitter']['mc_link']; ?>" class="group flex items-center rounded justify-center w-10 h-10 bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                        <svg width="19" height="15" viewBox="0 0 19 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M6.42709 14.3713C13.0839 14.3713 16.726 8.85479 16.726 4.07238C16.726 3.91729 16.7225 3.75876 16.7156 3.60368C17.4241 3.09132 18.0355 2.45668 18.5211 1.72959C17.8613 2.02316 17.1607 2.21489 16.4434 2.29823C17.1987 1.84547 17.7643 1.1342 18.0352 0.296281C17.3246 0.717401 16.5475 1.01446 15.7372 1.17474C15.1913 0.594624 14.4694 0.210518 13.6832 0.081809C12.8971 -0.0469004 12.0904 0.086955 11.388 0.46268C10.6855 0.838405 10.1264 1.43507 9.79706 2.16043C9.46772 2.88579 9.38651 3.69945 9.56597 4.47559C8.12714 4.40339 6.71954 4.02962 5.43443 3.37852C4.14932 2.72741 3.01539 1.81351 2.10614 0.69605C1.64401 1.49281 1.5026 2.43565 1.71064 3.33293C1.91869 4.23021 2.46058 5.01461 3.22618 5.52671C2.65141 5.50846 2.08923 5.35371 1.58609 5.07525V5.12005C1.58558 5.95619 1.87464 6.76671 2.40415 7.41383C2.93365 8.06095 3.67092 8.50472 4.49062 8.66972C3.95819 8.8154 3.39938 8.83662 2.85743 8.73176C3.08873 9.45084 3.53877 10.0798 4.14473 10.5308C4.75068 10.9818 5.48233 11.2324 6.23755 11.2475C4.9554 12.2547 3.37158 12.801 1.74118 12.7984C1.45204 12.7979 1.16318 12.7802 0.87616 12.7453C2.53248 13.8079 4.45922 14.3723 6.42709 14.3713Z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['instagram']['mc_show_in_footer'] == "1" and $data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                                <li class="mr-2">
                                    <a href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>" class="group flex items-center rounded justify-center w-10 h-10 bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M8.77638 2.139C10.8663 2.139 11.1137 2.14816 11.9356 2.18483C12.6995 2.21844 13.1119 2.34676 13.3869 2.4537C13.7505 2.59425 14.0133 2.76535 14.2852 3.03728C14.5602 3.31226 14.7282 3.57197 14.8688 3.93555C14.9757 4.21054 15.1041 4.62607 15.1377 5.38686C15.1743 6.21181 15.1835 6.45929 15.1835 8.54611C15.1835 10.636 15.1743 10.8835 15.1377 11.7054C15.1041 12.4692 14.9757 12.8817 14.8688 13.1567C14.7282 13.5203 14.5571 13.783 14.2852 14.0549C14.0102 14.3299 13.7505 14.498 13.3869 14.6385C13.1119 14.7455 12.6964 14.8738 11.9356 14.9074C11.1107 14.9441 10.8632 14.9532 8.77638 14.9532C6.6865 14.9532 6.43902 14.9441 5.61712 14.9074C4.85328 14.8738 4.4408 14.7455 4.16582 14.6385C3.80223 14.498 3.53947 14.3269 3.26754 14.0549C2.99255 13.78 2.82451 13.5203 2.68396 13.1567C2.57702 12.8817 2.4487 12.4662 2.41509 11.7054C2.37842 10.8804 2.36926 10.6329 2.36926 8.54611C2.36926 6.45624 2.37842 6.20875 2.41509 5.38686C2.4487 4.62301 2.57702 4.21054 2.68396 3.93555C2.82451 3.57197 2.99561 3.3092 3.26754 3.03728C3.54252 2.76229 3.80223 2.59425 4.16582 2.4537C4.4408 2.34676 4.85633 2.21844 5.61712 2.18483C6.43902 2.14816 6.6865 2.139 8.77638 2.139ZM8.77638 0.730469C6.65289 0.730469 6.38707 0.739635 5.55296 0.776299C4.7219 0.812964 4.15054 0.9474 3.65557 1.13989C3.13921 1.34154 2.70229 1.60736 2.26843 2.04428C1.83151 2.47814 1.56569 2.91506 1.36404 3.42836C1.17155 3.92639 1.03712 4.49469 1.00045 5.32575C0.963786 6.16292 0.95462 6.42874 0.95462 8.55222C0.95462 10.6757 0.963786 10.9415 1.00045 11.7756C1.03712 12.6067 1.17155 13.1781 1.36404 13.673C1.56569 14.1894 1.83151 14.6263 2.26843 15.0602C2.70229 15.494 3.13921 15.7629 3.65252 15.9615C4.15054 16.154 4.71884 16.2884 5.5499 16.3251C6.38402 16.3618 6.64984 16.3709 8.77332 16.3709C10.8968 16.3709 11.1626 16.3618 11.9967 16.3251C12.8278 16.2884 13.3992 16.154 13.8941 15.9615C14.4074 15.7629 14.8443 15.494 15.2782 15.0602C15.7121 14.6263 15.9809 14.1894 16.1795 13.6761C16.372 13.1781 16.5065 12.6098 16.5431 11.7787C16.5798 10.9446 16.589 10.6788 16.589 8.55528C16.589 6.43179 16.5798 6.16598 16.5431 5.33186C16.5065 4.5008 16.372 3.92944 16.1795 3.43447C15.9871 2.91506 15.7212 2.47814 15.2843 2.04428C14.8505 1.61042 14.4135 1.34154 13.9002 1.14294C13.4022 0.950456 12.8339 0.816019 12.0028 0.779355C11.1657 0.739635 10.8999 0.730469 8.77638 0.730469Z"/>
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M8.77637 4.53441C6.55817 4.53441 4.75856 6.33402 4.75856 8.55222C4.75856 10.7704 6.55817 12.57 8.77637 12.57C10.9946 12.57 12.7942 10.7704 12.7942 8.55222C12.7942 6.33402 10.9946 4.53441 8.77637 4.53441ZM8.77637 11.1585C7.33729 11.1585 6.17014 9.9913 6.17014 8.55222C6.17014 7.11314 7.33729 5.94599 8.77637 5.94599C10.2155 5.94599 11.3826 7.11314 11.3826 8.55222C11.3826 9.9913 10.2155 11.1585 8.77637 11.1585Z"/>
                                            <path class="fill-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M13.8911 4.37544C13.8911 4.89486 13.4694 5.31345 12.9531 5.31345C12.4337 5.31345 12.0151 4.8918 12.0151 4.37544C12.0151 3.85603 12.4367 3.43744 12.9531 3.43744C13.4694 3.43744 13.8911 3.85909 13.8911 4.37544Z"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($data['getMethodsContacting']['telegram']['mc_show_in_footer'] == "1" and $data['getMethodsContacting']['telegram']['mc_link'] != NULL) { ?>
                                <li class="mr-2">
                                    <a href="<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>" class="group flex items-center rounded justify-center w-10 h-10 bg-blue-50 group hover:bg-blue-700 transition duration-300 ease-linear">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="stroke-current transition duration-300 ease-linear text-blue-700 group-hover:text-white"
                                                  d="M7.13998 9.96507L8.8695 8.23767M7.13998 9.96507C5.87212 11.2337 0.538685 9.00354 1.49647 6.18315C2.45426 3.36275 12.943 -0.0813092 15.0632 2.04019C17.1834 4.16169 13.7258 14.6899 10.9196 15.6121C8.11337 16.5342 5.87212 11.2337 7.13998 9.96507Z"
                                                  stroke="#fff" stroke-width="1.56405" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <div class="grid md:grid-cols-9 grid-cols-1 xl:gap-20 gap-7">
                <div class="md:col-span-4">
                    <div class="relative flex flex-col md:items-start md:mx-0  mx-auto w-fit-content items-center">
                        <h3 class="text-xl relative font-bold text-white mb-4 z-10">درباره <?= $data['getPublicInfo']['site_short_name']; ?></h3>
                        <span class="z-0 w-4 h-4 flex absolute bg-white opacity-20 top-0 rounded-full -right-2"></span>
                    </div>

                    <div class="flex relative ">
                        <span class="md:flex hidden absolute top-1 right-0 w-1 h-1 mt-2 bg-white opacity-30 rounded-full"></span>
                        <div class="md:mr-2 md:text-right text-center">
                            <p class="text-base mb-2 md:w-10/12 w-full md:text-justify text-justify leading-7 text-white">
                                <?= nl2br($data['getPublicInfo']['footer_about']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="relative flex md:items-start md:mx-0  mx-auto w-fit-content items-center">
                        <h3 class="text-xl relative font-bold text-white mb-4 z-10">دسترسی سریع</h3>
                        <span class="z-0 w-4 h-4 flex absolute bg-white opacity-20 top-0 rounded-full -right-2"></span>
                    </div>
                    <ul class="flex flex-col md:items-start items-center">
                        <?php foreach($data['getFooterMenu'] as $footer){ ?>
                            <li class="mb-3 last:mb-0 flex items-center">
                                <span class="md:flex hidden w-1 h-1 ml-2 mb-1 bg-white opacity-30 rounded-full"></span>
                                <a class="text-base text-biscay-650 dark:text-gray-920 transition transform dark:hover:text-blue-450 hover:text-blue-700 duration-200 ease-linear"
                                   href="<?= $footer['link'] ?>"><?= $footer['title'] ?> </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <div class="relative flex md:items-start md:mx-0  mx-auto w-fit-content items-center">
                        <h3 class="text-xl relative font-bold text-white mb-4 z-10">تماس با <?= $data['getPublicInfo']['site_short_name']; ?></h3>
                        <span class="z-0 w-4 h-4 flex absolute bg-white opacity-20 top-0 rounded-full -right-2"></span>
                    </div>

                    <ul>
                        <?php if ($data['getMethodsContacting']['email']['mc_show_in_footer'] == "1") { ?>
                            <li class="flex items-center justify-between mb-7 last:mb-0">
                                <span class="flex items-center">
                                     <span class="relative ml-3">
                                        <i class="flex w-5 h-5 bg-white opacity-20 rounded-full"></i>
                                        <svg class="dark:text-blue-950 text-blue-980 absolute -top-1 -left-2" width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-white group-hover:text-white" d="M15.5632 4.17184C15.4183 3.54105 15.2294 3.0782 15.0064 2.72729C14.2794 3.41662 13.3594 4.25301 12.3603 4.98727C10.9828 5.99965 9.61574 6.69415 8.50008 6.69415C7.38443 6.69415 6.01733 5.99965 4.63986 4.98727C3.64079 4.25301 2.72075 3.41662 1.99377 2.72729C1.77081 3.0782 1.58187 3.54105 1.437 4.17184C1.43013 4.20176 1.42338 4.23196 1.41675 4.26247C2.07618 4.86961 2.86033 5.55149 3.70121 6.1695C5.10702 7.2027 6.83246 8.18184 8.50008 8.18184C10.1677 8.18184 11.8931 7.2027 13.299 6.1695C14.1398 5.55149 14.924 4.86961 15.5834 4.26246C15.5768 4.23196 15.57 4.20176 15.5632 4.17184Z" fill="currentColor"></path>
                                            <path class="fill-current transition duration-300 ease-linear text-white group-hover:text-white" fill-rule="evenodd" clip-rule="evenodd" d="M0 7.5C0 13.6762 1.50025 15 8.5 15C15.4997 15 17 13.6762 17 7.5C17 1.32375 15.4997 0 8.5 0C1.50025 0 0 1.32375 0 7.5ZM8.5 13.75C6.7824 13.75 5.49884 13.6672 4.5262 13.4764C3.56964 13.2889 3.0028 13.0139 2.62683 12.6822C2.25086 12.3505 1.9393 11.8503 1.72671 11.0063C1.51055 10.1481 1.41667 9.01553 1.41667 7.5C1.41667 5.98447 1.51055 4.85192 1.72671 3.99371C1.9393 3.14968 2.25086 2.64953 2.62683 2.31779C3.0028 1.98605 3.56964 1.71115 4.5262 1.52357C5.49884 1.33284 6.7824 1.25 8.5 1.25C10.2176 1.25 11.5012 1.33284 12.4738 1.52357C13.4304 1.71115 13.9972 1.98605 14.3732 2.31779C14.7491 2.64953 15.0607 3.14968 15.2733 3.99371C15.4895 4.85192 15.5833 5.98447 15.5833 7.5C15.5833 9.01553 15.4895 10.1481 15.2733 11.0063C15.0607 11.8503 14.7491 12.3505 14.3732 12.6822C13.9972 13.0139 13.4304 13.2889 12.4738 13.4764C11.5012 13.6672 10.2176 13.75 8.5 13.75Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-white"> ایمیل: </span>
                                </span>
                                <a class="text-white font-medium text-sm transition transform  hover:text-blue-700 duration-200 ease-linear" mailto="<?= $data['getMethodsContacting']['email']['mc_link']; ?>">
                                    <span class="__cf_email__" data-cfemail="325b5c545d72405d5d515957461c5b40"><?= $data['getMethodsContacting']['email']['mc_link']; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['telegram']['mc_link'] != NULL) { ?>
                            <li class="flex items-center justify-between mb-7 last:mb-0">
                                <span class="flex items-center">
                                    <span class="relative ml-3">
                                        <i class="flex w-5 h-5 bg-white opacity-20 rounded-full"></i>
                                        <svg class="dark:text-blue-950 text-blue-980 absolute -top-1 -left-2" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="transition duration-300 ease-linear text-white group-hover:text-white" d="M7.14715 9.85653L8.80585 8.19987M7.14715 9.85653C5.93121 11.0732 0.81617 8.93438 1.73474 6.22947C2.6533 3.52456 12.7125 0.221534 14.7459 2.25616C16.7793 4.29079 13.4633 14.3879 10.772 15.2723C8.08068 16.1567 5.93121 11.0732 7.14715 9.85653Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>

                                    <span class="text-sm font-medium text-white"> تلگرام: </span>
                                </span>
                                <a class="text-white font-medium text-sm transition transform  hover:text-blue-700 duration-200 ease-linear"
                                   href="<?= $data['getMethodsContacting']['telegram']['mc_link']; ?>"><?= str_replace("https://t.me/", "", str_replace("https://telegram.me/", "", $data['getMethodsContacting']['telegram']['mc_link'])); ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['phone']['mc_link'] != NULL) { ?>
                            <li class="flex items-center justify-between mb-7 last:mb-0">
                                <span class="flex items-center">
                                    <span class="relative ml-3">
                                        <i class="flex w-5 h-5 bg-white opacity-20 rounded-full"></i>
                                       <svg class="dark:text-blue-950 text-blue-980 absolute -top-1 -left-2" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="transition duration-300 ease-linear text-white group-hover:text-white" d="M8.83538 10.3C9.27844 10.6121 9.74293 10.8745 10.2217 11.0731C10.519 11.1809 10.9855 10.8756 11.3285 10.6511L11.3286 10.6511C11.4143 10.595 11.4923 10.544 11.558 10.5057L11.5796 10.4936C11.9027 10.3121 12.2615 10.1106 12.7228 10.2078C13.1373 10.2929 14.5594 11.4136 14.9524 11.8108C15.2097 12.0661 15.3526 12.3357 15.374 12.6123C15.4169 13.6408 14.0377 14.7969 13.709 14.9955C13.0087 15.5062 12.0725 15.4991 10.9435 14.9884C9.73579 14.499 8.29228 13.4705 6.8988 12.2222C6.39998 11.7753 5.44205 10.8344 5.16944 10.5202C3.76167 8.99521 2.57543 7.35674 2.01803 6.03036C1.75363 5.47002 1.625 4.95224 1.625 4.4912C1.625 4.03725 1.75363 3.63295 2.00374 3.2854C2.15381 3.02296 3.36149 1.59018 4.42625 1.62565C4.69066 1.65402 4.96221 1.78878 5.22661 2.04413C5.62679 2.43424 6.7773 3.84574 6.86306 4.26422C6.96089 4.71509 6.75803 5.07099 6.57526 5.39163L6.57526 5.39163L6.56292 5.41328C6.52173 5.48445 6.46588 5.56888 6.40483 5.66117L6.40482 5.66118C6.1799 6.0012 5.8843 6.44805 5.99052 6.73257C6.25564 7.38512 6.63438 8.02348 7.09102 8.6122C7.59779 9.21811 8.39233 9.98789 8.83538 10.3Z" stroke="currentColor" stroke-width="1.5"></path>
                                        </svg>
                                    </span>
                                    <span class="text-sm font-medium text-white"> شماره تماس: </span>
                                </span>
                                <a class="text-white font-medium text-sm transition transform  hover:text-blue-700 duration-200 ease-linear" href="tel:<?= $data['getMethodsContacting']['phone']['mc_link']; ?>">
                                    <?= $data['getMethodsContacting']['phone']['mc_link']; ?>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($data['getMethodsContacting']['instagram']['mc_link'] != NULL) { ?>
                            <li class="flex items-center justify-between mb-7 last:mb-0">
                                <span class="flex items-center">
                                    <span class="relative ml-3">
                                        <i class="flex w-5 h-5 bg-white opacity-20 rounded-full"></i>
                                        <svg class="dark:text-blue-950 text-blue-980 absolute -top-1 -left-2" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="fill-current transition duration-300 ease-linear text-white group-hover:text-white" d="M8.77638 2.139C10.8663 2.139 11.1137 2.14816 11.9356 2.18483C12.6995 2.21844 13.1119 2.34676 13.3869 2.4537C13.7505 2.59425 14.0133 2.76535 14.2852 3.03728C14.5602 3.31226 14.7282 3.57197 14.8688 3.93555C14.9757 4.21054 15.1041 4.62607 15.1377 5.38686C15.1743 6.21181 15.1835 6.45929 15.1835 8.54611C15.1835 10.636 15.1743 10.8835 15.1377 11.7054C15.1041 12.4692 14.9757 12.8817 14.8688 13.1567C14.7282 13.5203 14.5571 13.783 14.2852 14.0549C14.0102 14.3299 13.7505 14.498 13.3869 14.6385C13.1119 14.7455 12.6964 14.8738 11.9356 14.9074C11.1107 14.9441 10.8632 14.9532 8.77638 14.9532C6.6865 14.9532 6.43902 14.9441 5.61712 14.9074C4.85328 14.8738 4.4408 14.7455 4.16582 14.6385C3.80223 14.498 3.53947 14.3269 3.26754 14.0549C2.99255 13.78 2.82451 13.5203 2.68396 13.1567C2.57702 12.8817 2.4487 12.4662 2.41509 11.7054C2.37842 10.8804 2.36926 10.6329 2.36926 8.54611C2.36926 6.45624 2.37842 6.20875 2.41509 5.38686C2.4487 4.62301 2.57702 4.21054 2.68396 3.93555C2.82451 3.57197 2.99561 3.3092 3.26754 3.03728C3.54252 2.76229 3.80223 2.59425 4.16582 2.4537C4.4408 2.34676 4.85633 2.21844 5.61712 2.18483C6.43902 2.14816 6.6865 2.139 8.77638 2.139ZM8.77638 0.730469C6.65289 0.730469 6.38707 0.739635 5.55296 0.776299C4.7219 0.812964 4.15054 0.9474 3.65557 1.13989C3.13921 1.34154 2.70229 1.60736 2.26843 2.04428C1.83151 2.47814 1.56569 2.91506 1.36404 3.42836C1.17155 3.92639 1.03712 4.49469 1.00045 5.32575C0.963786 6.16292 0.95462 6.42874 0.95462 8.55222C0.95462 10.6757 0.963786 10.9415 1.00045 11.7756C1.03712 12.6067 1.17155 13.1781 1.36404 13.673C1.56569 14.1894 1.83151 14.6263 2.26843 15.0602C2.70229 15.494 3.13921 15.7629 3.65252 15.9615C4.15054 16.154 4.71884 16.2884 5.5499 16.3251C6.38402 16.3618 6.64984 16.3709 8.77332 16.3709C10.8968 16.3709 11.1626 16.3618 11.9967 16.3251C12.8278 16.2884 13.3992 16.154 13.8941 15.9615C14.4074 15.7629 14.8443 15.494 15.2782 15.0602C15.7121 14.6263 15.9809 14.1894 16.1795 13.6761C16.372 13.1781 16.5065 12.6098 16.5431 11.7787C16.5798 10.9446 16.589 10.6788 16.589 8.55528C16.589 6.43179 16.5798 6.16598 16.5431 5.33186C16.5065 4.5008 16.372 3.92944 16.1795 3.43447C15.9871 2.91506 15.7212 2.47814 15.2843 2.04428C14.8505 1.61042 14.4135 1.34154 13.9002 1.14294C13.4022 0.950456 12.8339 0.816019 12.0028 0.779355C11.1657 0.739635 10.8999 0.730469 8.77638 0.730469Z"></path>
                                            <path class="fill-current transition duration-300 ease-linear text-white group-hover:text-white" d="M8.77637 4.53441C6.55817 4.53441 4.75856 6.33402 4.75856 8.55222C4.75856 10.7704 6.55817 12.57 8.77637 12.57C10.9946 12.57 12.7942 10.7704 12.7942 8.55222C12.7942 6.33402 10.9946 4.53441 8.77637 4.53441ZM8.77637 11.1585C7.33729 11.1585 6.17014 9.9913 6.17014 8.55222C6.17014 7.11314 7.33729 5.94599 8.77637 5.94599C10.2155 5.94599 11.3826 7.11314 11.3826 8.55222C11.3826 9.9913 10.2155 11.1585 8.77637 11.1585Z"></path>
                                            <path class="fill-current transition duration-300 ease-linear text-white group-hover:text-white" d="M13.8911 4.37544C13.8911 4.89486 13.4694 5.31345 12.9531 5.31345C12.4337 5.31345 12.0151 4.8918 12.0151 4.37544C12.0151 3.85603 12.4367 3.43744 12.9531 3.43744C13.4694 3.43744 13.8911 3.85909 13.8911 4.37544Z"></path>
                                        </svg>
                                    </span>

                                    <span class="text-sm font-medium text-white"> اینستاگرام: </span>
                                </span>
                                <a class="text-white font-medium text-sm transition transform  hover:text-blue-700 duration-200 ease-linear"
                                   href="<?= $data['getMethodsContacting']['instagram']['mc_link']; ?>"><?= str_replace("https://instagram.com/", "", $data['getMethodsContacting']['instagram']['mc_link']); ?></a>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="flex items-center justify-between mt-9">
                        <?php if($data['getPublicInfo']['samandehi_link']){ ?>
                            <div class="cursor-pointer">
                                <img data-toggle="tooltip" data-placement="top" title="" class="toggle-me footer-icon-style"
                                     data-original-title="ساماندهی" id='jxlznbqeoeukrgvjapfujxlz' style='cursor:pointer'
                                     onclick='window.open("<?= $data['getPublicInfo']['samandehi_link']; ?>", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")'
                                     alt='لوگو ساماندهی' src='<?= $data['getPublicInfo']['samandehi_image']; ?>'/>
                            </div>
                        <?php } ?>

                        <?php if($data['getPublicInfo']['enamad_link']){ ?>
                            <div class="cursor-pointer">
                                <img data-toggle="tooltip" data-placement="top" title="" class="toggle-me footer-icon-style"
                                     data-original-title="نماد اعتماد الكترونیكی" alt="لوگو نماد اعتماد الكترونیكی"
                                     src="<?= $data['getPublicInfo']['enamad_image']; ?>" style="cursor:pointer" id="bKTcIIKvn3PcwGAR"
                                     onclick='window.open("<?= $data['getPublicInfo']['enamad_link']; ?>", "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30")'>
                            </div>
                        <?php } ?>

                        <?php if($data['getPublicInfo']['zarinpal_link']){ ?>
                            <div class="cursor-pointer">
                                <img data-toggle="tooltip" data-placement="top" title="" class="toggle-me hidden-sm hidden-xs footer-icon-style"
                                     data-original-title="زرین پال" style='cursor:pointer'
                                     onclick='window.open("<?= $data['getPublicInfo']['zarinpal_link']; ?>", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")'
                                     alt='لوگو زرین پال' src='<?= $data['getPublicInfo']['zarinpal_image']; ?>'/>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="relative mt-2 flex md:justify-start justify-center">
                <p class="pl-3 text-center relative z-10 inline-block text-xs text-dark-500 items-center rounded justify-center bg-blue-50 p-2">
                    <?= $data['getPublicInfo']['copyright']; ?> | طراحی و توسعه <a href="<?= SITE; ?>" rel="nofollow" target="_blank" title="<?= DEVELOPER; ?>"><?= DEVELOPER; ?></a>
                </p>

                <span class="absolute border-t border-1 top-2/4 trasform translate-y-2/4 border-chambray-100 w-full z-0 right-0"></span>
            </div>
        </div>
    </div>
</footer>