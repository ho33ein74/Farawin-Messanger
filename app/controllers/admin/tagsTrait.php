<?php

trait tagsTrait
{
    function tags($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("blog_tag_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/tags/tags');
        } else {
            $this->noaccess();
        }
    }

    function getTagsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_tag_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getTagsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addTag()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_tag_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addTag($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editTag()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_tag_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editTag($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusTag()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_tag_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusTag($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delTag()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("blog_tag_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delTag($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
