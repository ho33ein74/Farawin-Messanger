<?php

trait rtlThemeTrait
{
    function license($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("license_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/license/active');
        } else {
            $this->noaccess();
        }
    }

    function checkLicense()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("license_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->checkLicense($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function deactiveLicense()
    {
        $csrf_token = $this->model->check_csrf_token();
        if ($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("license_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->deactiveLicense($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}