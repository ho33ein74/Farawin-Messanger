<?php

trait storeroomTrait
{
    function storeroom($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "products") {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_products_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $id_isset = $this->model->getIssetStoreroom($attrId);
                if (sizeof($id_isset) > 0) {
                    $getStoreroomInfo = $this->model->getStoreroomList($attrId);
                    $data = array('attrId' => $attrId, 'storeroomInfo' => $getStoreroomInfo);
                    $this->view('admin/storeroom/storeroom-products', $data);
                } else {
                    $this->index();
                }
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && $func == "list") {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $getBranchesInfo = $this->model->getBranchesInfo();
                $data = array('branchesInfo' => $getBranchesInfo);
                $this->view('admin/storeroom/storeroom-list', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $this->index();
        }
    }

    function getStoreroomListAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStoreroomListAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusStoreroomList()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusStoreroomList($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editStoreroom()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editStoreroom($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delStoreroomList()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delStoreroomList($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getStoreroomAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_products_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStoreroomAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getStoreroomForSaleAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_products_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStoreroomForSaleAjax($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addPieces()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_product_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addPieces($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addStoreroom()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addStoreroom($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editPieces()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_storeroom_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editPieces($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editPiecesInventory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_inventory_product_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editPiecesInventory($_POST);
            } else {
                $this->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delPieces()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("service_product_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delPieces($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
