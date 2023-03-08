<?php

trait supportTrait
{
    function contactSubject($func = '', $attrId = 0)
    {
        $admin_permission = $this->model->admin_permission_check("contact_subject_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/support/contactSubject');
        } else {
            $this->noaccess();
        }
    }

    function getContactSubjectAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("contact_subject_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getContactSubjectAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusContactSubject()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("contact_subject_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusContactSubject($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addContactSubject()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("contact_subject_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addContactSubject($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editContactSubject()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("contact_subject_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editContactSubject($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delContactSubject()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("contact_subject_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delContactSubject($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function support()
    {
        $admin_permission = $this->model->admin_permission_check("support_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $getContactSubject = $this->model->getContactSubject(FALSE);

            $data = array('contactSubject' => $getContactSubject);
            $this->view('admin/support/support', $data);
        } else {
            $this->noaccess();
        }
    }

    function getSupportAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("support_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getSupportAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function submitSupport()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("support_confirm", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->submitSupport($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delSupport()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("support_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delSupport($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function comments()
    {
        $admin_permission = $this->model->admin_permission_check("comment_list_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $this->view('admin/support/comments');
        } else {
            $this->noaccess();
        }
    }

    function getCommentsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCommentsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getCommentsDetailsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_reply", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getCommentsDetailsAjax($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function submitComment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_confirm", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->submitComments($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusComment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_status_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusComment($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function commentReply()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_reply", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->commentReply($_POST, $this->checkLoginAdmin);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delComment()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("comment_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delComments($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }
}
