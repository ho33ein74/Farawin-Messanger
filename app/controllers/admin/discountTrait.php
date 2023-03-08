<?php

trait discountTrait
{
    function discounts($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "users") {
            $admin_permission = $this->model->admin_permission_check("discount_users_use_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetDiscounts($attrId);
                if (sizeof($id_isset) > 0) {
                    $getDiscounts = $this->model->getDiscounts($attrId);

                    $data = array('discountsInfo' => $getDiscounts, 'attrId' => $attrId);
                    $this->view('admin/discount/discounts-user', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("discount_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $_where = "";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $getStaffs = $this->model->getStaffs();

                $data = array(
                    'services' => $serviceInfo,
                    'Staffs' => $getStaffs,
                );
                $this->view('admin/discount/discounts', $data);
            } else {
                $this->noaccess();
            }
        }
    }

    function getDiscountsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getDiscountsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addDiscounts()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addDiscounts($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editDiscounts()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editDiscounts($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delDiscounts()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delDiscounts($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getDiscountsUsersAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_users_use_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getDiscountsUsersAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delDiscountsUser()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("discount_users_use_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delDiscountsUser($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function giftCart($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("gift_cart_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/discount/giftCart');
        } else {
            $this->noaccess();
        }
    }

    function getGiftCartAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("gift_cart_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getGiftCartAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addGiftCart()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("gift_cart_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addGiftCart($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editGiftCart()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("gift_cart_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editGiftCart($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delGiftCart()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("gift_cart_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delGiftCart($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}
