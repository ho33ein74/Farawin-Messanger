<script src="public/js/contactus.min.js"></script>
<script src="public/js/contactus-script.js" id='contactus.scripts-js'></script>
<script type='text/javascript' id='contactus-js-extra'>
    /* <![CDATA[ */
    var arCUVars = {
        "_wpnonce": "<input type=\"hidden\" id=\"_wpnonce\" name=\"_wpnonce\" value=\"f41f90aa16\" \/><input type=\"hidden\" name=\"_wp_http_referer\" value=\"\/contact-us\/\" \/>"
    };
    /* ]]> */
</script>

<script type="text/javascript" id="arcu-main-js">
    var $arcuWidget;
    var zaloWidgetInterval;
    var tawkToInterval;
    var tawkToHideInterval;
    var skypeWidgetInterval;
    var lcpWidgetInterval;
    var closePopupTimeout;
    var lzWidgetInterval;
    var paldeskInterval;
    var arcuOptions;
    var hideCustomerChatInterval;
    var _arCuTimeOut = null;
    var arCuPromptClosed = false;
    var _arCuWelcomeTimeOut = null;
    var arCuMenuOpenedOnce = false;
    var arcuAppleItem = null;

    var arCuMessages = [];
    var arCuLoop = false;
    var arCuCloseLastMessage = true;
    var arCuDelayFirst = 2000;
    var arCuTypingTime = 2000;
    var arCuMessageTime = 4000;
    var arCuClosedCookie = 0;
    var arcItems = [];
    window.addEventListener('load', function () {
        $arcuWidget = document.createElement('div');
        var body = document.getElementsByTagName('body')[0];
        $arcuWidget.id = 'arcontactus';

        if (document.getElementById('arcontactus')) {
            document.getElementById('arcontactus').parentElement.removeChild(document.getElementById('arcontactus'));
        }

        body.appendChild($arcuWidget);
        $arcuWidget.addEventListener('arcontactus.init', function () {
            $arcuWidget.classList.add('arcuAnimated');
            $arcuWidget.classList.add('flipInY');

            setTimeout(function () {
                $arcuWidget.classList.remove('flipInY');
            }, 1000);

            if (document.querySelector('#arcu-form-callback form')) {
                document.querySelector('#arcu-form-callback form').append(contactUs.utils.DOMElementFromHTML(arCUVars._wpnonce));
            }

            if (document.querySelector('#arcu-form-email form')) {
                document.querySelector('#arcu-form-email form').append(contactUs.utils.DOMElementFromHTML(arCUVars._wpnonce));
            }

            $arcuWidget.addEventListener('arcontactus.successSendFormData', function (event) {});
            $arcuWidget.addEventListener('arcontactus.successSendFormData', function (event) {});
            $arcuWidget.addEventListener('arcontactus.errorSendFormData', function (event) {
                if (event.detail.data && event.detail.data.message) {
                    alert(event.detail.data.message);
                }
            });
            $arcuWidget.addEventListener('arcontactus.hideFrom', function () {
                clearTimeout(closePopupTimeout);
            });
            if (arCuClosedCookie) {
                return false;
            }
            arCuShowMessages();
        });
        $arcuWidget.addEventListener('arcontactus.closeMenu', function () {
            arCuCreateCookie('arcumenu-closed', 1, 1);
        });
        $arcuWidget.addEventListener('arcontactus.openMenu', function () {
            clearTimeout(_arCuTimeOut);
            if (!arCuPromptClosed) {
                arCuPromptClosed = true;
                contactUs.hidePrompt();
            }

        });
        $arcuWidget.addEventListener('arcontactus.showFrom', function () {
            clearTimeout(_arCuTimeOut);
            if (!arCuPromptClosed) {
                arCuPromptClosed = true;
                contactUs.hidePrompt();
            }

        });
        $arcuWidget.addEventListener('arcontactus.showForm', function () {
            clearTimeout(_arCuTimeOut);
            if (!arCuPromptClosed) {
                arCuPromptClosed = true;
                contactUs.hidePrompt();
            }
        });

        $arcuWidget.addEventListener('arcontactus.hidePrompt', function () {
            clearTimeout(_arCuTimeOut);
            if (arCuClosedCookie != "1") {
                arCuClosedCookie = "1";
            }
        });

        <?php foreach ($data['getMethodsContacting'] as $method_item) { ?>
        <?php if ($method_item['mc_show_in_float_button'] == 1) { ?>
        arcItem = {};
        arcItem.id = 'msg-item-<?= $method_item['mc_id']; ?>';

        <?php if ($method_item['mc_on_click'] != null) { ?>
        arcItem.onClick = function (e) {
            e.preventDefault();
            contactUs.closeMenu();
            contactUs.showForm('<?= $method_item['mc_on_click']; ?>');
            return false;
        }
        <?php } ?>

        <?php if ($method_item['mc_link'] == "_popup") { ?>
        arcItem.popupContent = document.getElementById('arcu-popup-content-0').innerHTML;
        document.getElementById('arcu-popup-content-0').remove();
        <?php } ?>

        arcItem.class = '<?= $method_item['mc_class']; ?>';
        arcItem.title = "<?= $method_item['mc_title']; ?>";
        arcItem.subTitle = "<?= $method_item['mc_description']; ?>";
        arcItem.icon = '<?= $method_item['mc_icon']; ?>';
        arcItem.includeIconToSlider = <?= $method_item['mc_show_in_float_button_slider']; ?>;
        arcItem.href = '<?= $method_item['mc_key'] == "phone" ? "tel:".$method_item['mc_link']:$method_item['mc_link']; ?>';
        arcItem.color = '<?= $method_item['mc_color']; ?>';
        arcItems.push(arcItem);
        <?php } ?>
        <?php } ?>

        arcuOptions = {
            rootElementId: 'arcontactus',
            visible: true,
            pluginVersion: '2.4.1',
            theme: '<?= $data['getPublicInfo']['float_contact_color'] ?>',
            buttonText: '<?= $data['getPublicInfo']['float_contact_text'] ?>',
            buttonSize: '<?= $data['getPublicInfo']['float_contact_size'] ?>',
            iconsAnimationSpeed: <?= $data['getPublicInfo']['float_contact_icons_animation_speed'] ?? 1000 ?>,
            iconsAnimationPause: <?= $data['getPublicInfo']['float_contact_icons_animation_pause'] ?? 2000 ?>,
            align: '<?= $data['getPublicInfo']['float_contact_position'] ?>',
            backdrop: <?= $data['getPublicInfo']['float_contact_menu_backdrop'] ?>,
            <?php if ($data['getPublicInfo']['float_contact_online_badge']) { ?>
            online: true,
            <?php } ?>
            showHeaderCloseBtn: <?= $data['getPublicInfo']['float_contact_menu_show_header_close_btn'] ?>,
            headerCloseBtnBgColor: '<?= $data['getPublicInfo']['float_contact_menu_header_close_btn_bg_color'] ?>',
            headerCloseBtnColor: '<?= $data['getPublicInfo']['float_contact_menu_header_close_btn_color'] ?>',
            showMenuHeader: <?= $data['getPublicInfo']['float_contact_menu_show_header'] ?>,
            clickAway: <?= $data['getPublicInfo']['float_contact_menu_click_away'] ?>,
            menuHeaderText: "<?= $data['getPublicInfo']['float_contact_menu_header_text'] ?>",
            menuSubheaderText: "<?= $data['getPublicInfo']['float_contact_menu_sub_header_text'] ?>",
            itemsIconType: "<?= $data['getPublicInfo']['float_contact_items_icon_type'] ?>",
            menuSize: '<?= $data['getPublicInfo']['float_contact_menu_size'] ?>',
            itemsAnimation: '<?= $data['getPublicInfo']['float_contact_menu_items_animation'] ?>',
            mode: '<?= $data['getPublicInfo']['float_contact_mode_select_options'] ?>',

            <?php if ($data['getPublicInfo']['float_contact_menu_popup_style'] == 'sidebar'){?>
            style: '<?= $data['getPublicInfo']['float_contact_sidebar_animation'] ?>',
            <?php } else { ?>
            popupAnimation: '<?= $data['getPublicInfo']['float_contact_popup_animation'] ?>',
            style: '',
            <?php } ?>

            credits: false,
            creditsUrl: '<?= SITE ?>',
            items: arcItems,
            buttonIcon: '<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-825 -308)"><g id="Vector"><use xlink:href="#path0_fill0123" transform="translate(825 308)" fill="currentColor"></use></g></g><defs><path fill="currentColor" id="path0_fill0123" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"></path></defs></svg>',
            layout: 'default', //default or personal
            drag: false,
            menuStyle: 'regular',
            buttonIconUrl: 'public/images/msg.svg',
            reCaptcha: false,
            reCaptchaKey: '',
            countdown: 0,
            buttonIconSize: 24,
            phonePlaceholder: '',
            callbackSubmitText: '',
            errorMessage: '',
            callProcessText: '',
            callSuccessText: '',
            callbackFormText: '',
            ajaxUrl: 'contactus/save',
            promptPosition: 'side',
            forms: {
                callback: {
                    id: 'callback',
                    header: {
                        content: "شماره تلفن خود را بگذارید. ما به زودی با شما تماس خواهیم گرفت!",
                        layout: "text",
                    },
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>',
                    success: "درخواست تماس ارسال شد! ما به زودی با شما تماس خواهیم گرفت.",
                    error: "خطا در ارسال درخواست پاسخگویی! لطفا دوباره تلاش کنید!",
                    action: 'https://wpshare.ir/zhaket/contact-us/wp-admin/admin-ajax.php',
                    buttons: [
                        {
                            name: "submit",
                            label: "ارسال",
                            type: "submit",
                        },
                    ],
                    fields: {
                        formId: {
                            name: 'formId',
                            value: 'callback',
                            type: 'hidden'
                        },
                        action: {
                            name: 'action',
                            value: 'arcontactus_request_callback',
                            type: 'hidden'
                        },
                        name: {
                            name: "name",
                            enabled: true,
                            required: false,
                            type: "text",
                            label: "نام شما",
                            placeholder: "نام را وارد کنید",
                            values: [],
                            value: "",
                        },
                        phone: {
                            name: "phone",
                            enabled: true,
                            required: true,
                            type: "tel",
                            label: "شماره تلفن شما",
                            placeholder: "شماره تلفن خود را وارد کنید",
                            values: [],
                            value: "",
                        },
                        gdpr: {
                            name: "gdpr",
                            enabled: true,
                            required: true,
                            type: "checkbox",
                            label: "من قوانین را می پذیرم",
                            placeholder: "",
                            values: [],
                            value: "1",
                        },
                    }
                },
                email: {
                    id: 'email',
                    header: {
                        content: "برای ما ایمیل بنویسید!",
                        layout: "text",
                    },
                    icon: '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path></svg>',
                    success: "ایمیل ارسال شد! ما به زودی با شما تماس خواهیم گرفت.",
                    error: "خطا در ارسال ایمیل! لطفا دوباره تلاش کنید!",
                    action: 'https://wpshare.ir/zhaket/contact-us/wp-admin/admin-ajax.php',
                    buttons: [
                        {
                            name: "submit",
                            label: "ارسال",
                            type: "submit",
                        },
                    ],
                    fields: {
                        formId: {
                            name: 'formId',
                            value: 'email',
                            type: 'hidden'
                        },
                        action: {
                            name: 'action',
                            value: 'arcontactus_request_email',
                            type: 'hidden'
                        },
                        name: {
                            name: "name",
                            enabled: true,
                            required: false,
                            type: "text",
                            label: "نام شما",
                            placeholder: "نام را وارد کنید",
                            values: [],
                            value: "",
                        },
                        email: {
                            name: "email",
                            enabled: true,
                            required: true,
                            type: "email",
                            label: "ایمیل شما",
                            placeholder: "ایمیل خود را وارد کنید",
                            values: [],
                            value: "",
                        },
                        message: {
                            name: "message",
                            enabled: true,
                            required: true,
                            type: "textarea",
                            label: "متن پیام",
                            placeholder: "پیام خود را وارد نمایید",
                            values: [],
                            value: "",
                        },
                        gdpr: {
                            name: "gdpr",
                            enabled: true,
                            required: true,
                            type: "checkbox",
                            label: "من قوانین را می پذیرم",
                            placeholder: "",
                            values: [],
                            value: "1",
                        },
                    }
                },
            }
        };
        contactUs.init(arcuOptions);
    });
</script>