<?php

trait categoryTrait
{
    function categories($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "blog") {
            $admin_permission = $this->model->admin_permission_check($func."_category_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $category = $this->model->getCategory($func);
                $getServicesTypes = $this->model->getServicesTypes();
                $getCategoryChild = $this->model->getCategoryChild($func);

                $data = array(
                    'attrId' => $func,
                    'category' => $category,
                    'getServicesTypes' => $getServicesTypes,
                    'categoryChild' => $getCategoryChild
                );
                $this->view('admin/category/categories', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $this->index();
        }
    }

    function getCategoryAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_GET['type']."_category_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCategoryAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_category_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusCategory($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_category_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addCategory($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_category_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editCategory($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delCategory()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_category_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delCategory($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}
