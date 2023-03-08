<?php

trait calendarTrait
{
    function calendar($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("calendar_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $getServicesTypes = $this->model->getServicesTypes();
            $data = array('getServicesTypes' => $getServicesTypes);
            $this->view('admin/calendar/calendar', $data);
        } else {
            $this->noaccess();
        }
    }

    function getAllEventsAjax()
    {
//        $csrf_token = $this->model->check_csrf_token();
//        if ($csrf_token['status']) {
        $admin_permission = $this->model->admin_permission_check("calendar_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->getAllEventsAjax($_POST);
        } else {
            $this->model->response_access_denied();
        }
//        } else {
//            $this->model->response_error($csrf_token['msg']);
//        }
    }

    function getDateTimingAndEventsAjax()
    {
        $admin_permission = $this->model->admin_permission_check("calendar_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->getDateTimingAndEventsAjax($_POST);
        } else {
            $this->model->response_access_denied();
        }
    }

    function getDateEventsAjax()
    {
        $admin_permission = $this->model->admin_permission_check("calendar_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->model->getDateEventsAjax($_POST);
        } else {
            $this->model->response_access_denied();
        }
    }

}
