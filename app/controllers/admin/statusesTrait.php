<?php

trait statusesTrait
{
    function status($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "service") {
            $admin_permission = $this->model->admin_permission_check($func."_status_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $data = array('attrId' => $func);
                $this->view('admin/statuses/status', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $this->index();
        }
    }

    function statusPage()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("page_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusPage($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getStatusAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_GET['type']."_status_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getStatusAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusStatus()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusStatus($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addStatus()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_status_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addStatus($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editStatus()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['typeEdit']."_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editStatus($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delStatus()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check($_POST['type']."_status_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delStatus($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
