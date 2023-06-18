<?php

trait servicesTrait
{
    function services($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("service_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getTag = $this->model->getTag();
                $getRelatedBlog = $this->model->getRelatedBlog();
                $data = array('tag' => $getTag, 'RelatedBlog' => $getRelatedBlog);
                $this->view('admin/services/services-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetServices($attrId);
                if (sizeof($id_isset) > 0) {
                    $getTag = $this->model->getTag();
                    $getServicesTag = $this->model->getServicesTag($attrId);
                    $getRelatedBlog = $this->model->getRelatedBlog();
                    $getRelatedBlogSelected = $this->model->getRelatedBlogSelected($attrId, "service");

                    $_where = "WHERE s.s_id=?";
                    $_input = array($attrId);
                    $_order = "";
                    $_limit = "";
                    $_join = "";
                    $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

                    $getImagesServicePortfolio = $this->model->getImagesServicePortfolio($attrId);
                    $data = array('serviceInfo' => $serviceInfo, 'attrId' => $attrId, 'imagesServicePortfolio' => $getImagesServicePortfolio,
                        'tag' => $getTag, 'servicesTag' => $getServicesTag, 'RelatedBlog' => $getRelatedBlog,
                        'relatedBlogSelected' => $getRelatedBlogSelected);
                    $this->view('admin/services/services-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "timing") {
            $admin_permission = $this->model->admin_permission_check("service_timing_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetServices($attrId);
                if (sizeof($id_isset) > 0) {
                    $_where = "WHERE s.s_id=?";
                    $_input = array($attrId);
                    $_order = "";
                    $_limit = "";
                    $_join = "";
                    $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

                    $getServicesTiming = $this->model->getServicesTiming($attrId);
                    $getServicesTimingManageDay = $this->model->getServicesTimingManageDay($attrId);

                    $data = array(
                        'serviceInfo' => $serviceInfo,
                        'attrId' => $attrId,
                        'servicesTiming' => $getServicesTiming,
                        'servicesTimingManageDay' => $getServicesTimingManageDay
                    );
                    $this->view('admin/services/services-timing', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "tariff") {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetServices($attrId);
                if (sizeof($id_isset) > 0) {
                    $_where = "WHERE s.s_id=?";
                    $_input = array($attrId);
                    $_order = "";
                    $_limit = "";
                    $_join = "";
                    $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, True);

                    $getStaffs = $this->model->getStaffs();
                    $getBranches = $this->model->getBranches();

                    $data = array('serviceInfo' => $serviceInfo, 'attrId' => $attrId, 'branches' => $getBranches, 'staffs' => $getStaffs);
                    $this->view('admin/services/services-tariff', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func == '') {
            $admin_permission = $this->model->admin_permission_check("service_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/services/services');
            } else {
                $this->noaccess();
            }
        } else {
            $this->index();
        }
    }

    function getServicesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getServicesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addServices()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addServices($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editServices()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editServices($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delServices()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delServices($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function imageServicePortfolio()
    {
        $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->imageServicePortfolio($_POST);
        } else {
            $this->model->response_access_denied();
        }
    }

    function imageServicePortfolioOrder()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->imageServicePortfolioOrder($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function reservations($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "new") {
            $admin_permission = $this->model->admin_permission_check("service_reservation_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $userGetLatest = $this->model->userGetlatest(0);
                $cashInfo = $this->model->getCashInfo();
                $getBranches = $this->model->getBranches();
                $getStatus = $this->model->getStatus("service");

                $_where = "WHERE s.s_status=1";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $getStoreroomList = $this->model->getStoreroomList();
                $data = array('cashInfo' => $cashInfo, 'userGetLatest' => $userGetLatest, 'services' => $serviceInfo,
                    'getBranches' => $getBranches, 'status' => $getStatus, 'getStoreroomList' => $getStoreroomList);
                $this->view('admin/services/reservations-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("service_reservation_details_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetReservation($attrId);
                if (sizeof($id_isset) > 0) {
                    $reservationInfo = $this->model->reservationInfo($attrId);
                    $userGetLatest = $this->model->userGetlatest(0);
                    $getBranches = $this->model->getBranches();
                    $getStatus = $this->model->getStatus("service");

                    $_where = "WHERE s.s_status=1";
                    $_input = array();
                    $_order = "ORDER BY s.s_id DESC";
                    $_limit = "";
                    $_join = "";
                    $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                    $data = array('reservationInfo' => $reservationInfo, 'attrId' => $attrId, 'status' => $getStatus,
                        'userGetLatest' => $userGetLatest, 'services' => $serviceInfo, 'getBranches' => $getBranches);
                    $this->view('admin/services/reservations-edit', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "details") {
            $admin_permission = $this->model->admin_permission_check("service_reservation_details_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetReservation($attrId);
                if (sizeof($id_isset) > 0) {
                    $getPaymentLog = $this->model->getPaymentLog($attrId, "service");
                    $getBookingLatestActivity = $this->model->getBookingLatestActivity($attrId);
                    $reservationInfo = $this->model->reservationInfo($attrId);
                    $getStatus = $this->model->getStatus("service");
                    $getStaffs = $this->model->getStaffs();
                    $getStaffsList = $this->model->getStaffsList($attrId, "service");
                    $getProducts = $this->model->getProducts();
                    $getProductsList = $this->model->getProductsList($attrId);

                    $data = array(
                        'reservationInfo' => $reservationInfo,
                        'attrId' => $attrId,
                        'id' => $this->checkLoginAdmin,
                        'paymentLog' => $getPaymentLog,
                        'bookingLatestActivity' => $getBookingLatestActivity,
                        'status' => $getStatus,
                        'Staffs' => $getStaffs, 'StaffsList' => $getStaffsList,
                        'products' => $getProducts,
                        'productsList' => $getProductsList
                    );
                    $this->view('admin/services/reservations-view', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("service_reservation_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getBranches = $this->model->getBranches();
                $getStatus = $this->model->getStatus("service");

                $_where = "WHERE s.s_status=1";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $data = array(
                    "date_search" => $_GET['date'],
                    'getBranches' => $getBranches,
                    'status' => $getStatus,
                    'services' => $serviceInfo
                );
                $this->view('admin/services/reservations', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function delReservation()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delReservation($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getReservationsListAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getReservationsListAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editReservationDetails()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_details_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editReservationDetails($_POST);
            } else {
                $this->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function sendReservationsSMS()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_status_info_send_sms", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->sendReservationsSMS($_POST, $this->checkLoginAdmin);
            } else {
                $this->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getFirstFreeBooking()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getFirstFreeBooking();
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function initDaysBooking()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->initDaysBooking();
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function newBooking()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->newBooking($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editBooking()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_details_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editBooking($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function timingServicesManageDay()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_timing_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->timingServicesManageDay($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getServicesTariffAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getServicesTariffAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addServicesTariff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addServicesTariff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editServicesTariff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editServicesTariff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delServicesTariff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delServicesTariff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusServicesTariff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_tariff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusServicesTariff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delImageServicePortfolio()
    {
        $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->delImageServicePortfolio($_POST);
        } else {
            $this->model->response_access_denied();
        }
    }

    function editImageAltServicePortfolio()
    {
        $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->editImageAltServicePortfolio($_POST);
        } else {
            $this->model->response_access_denied();
        }
    }

    function sendServices()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_info_telegram_send", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->sendServices($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusServices()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusServices($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function timingServicesSetting()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_timing_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->timingServicesSetting($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function holidays($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("service_holidays_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/services/holidays');
        } else {
            $this->noaccess();
        }
    }

    function getHolidaysAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_holidays_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getHolidaysAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusHolidays()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_holidays_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusHolidays($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addHolidays()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_holidays_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addHolidays($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editHolidays()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_holidays_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editHolidays($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delHolidays()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_holidays_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delHolidays($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function ratings($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("service_rating_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $_where = "";
            $_input = array();
            $_order = "ORDER BY s.s_id DESC";
            $_limit = "";
            $_join = "";
            $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

            $data = array('services' => $serviceInfo);
            $this->view('admin/services/ratings', $data);
        } else {
            $this->noaccess();
        }
    }

    function getRatingsItemAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_rating_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getRatingsItemAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusRatingsItem()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_rating_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusRatingsItem($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addRatingsItem()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_rating_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addRatingsItem($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editRatingsItem()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_rating_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editRatingsItem($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delRatingsItem()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_rating_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delRatingsItem($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function branches($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("service_branch_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $provinces = $this->model->getProvinces();
            $data = array('provinces' => $provinces);
            $this->view('admin/services/branches', $data);
        } else {
            $this->noaccess();
        }
    }

    function getBranchesAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_branch_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getBranchesAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusBranch()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_branch_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusBranch($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delBranch()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_branch_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delBranch($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addBranch()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_branch_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addBranch($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editBranch()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_branch_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editBranch($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editProductsList()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editProductsList($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getStaffService()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_service_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStaffService($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function staffs($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("service_staff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $staffInfoEdit = $this->model->getStaffInfoEdit($attrId);
                $data = array('staffInfo' => $staffInfoEdit, 'attrId' => $attrId);
                $this->view('admin/services/staff-edit', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && $func == "services") {
            $admin_permission = $this->model->admin_permission_check("service_staff_service_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $data = array('attrId' => $attrId);
                $this->view('admin/services/staff-services-list', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("service_staff_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/services/staff');
            } else {
                $this->noaccess();
            }
        }
    }

    function addStaff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addStaff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editStaffsList()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_reservation_details_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editStaffsList($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusStaff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusStaff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getStaffAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStaffAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delStaff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delStaff($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editStaff()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editStaff($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getOrderStaffAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_staff_service_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getOrderStaffAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}
