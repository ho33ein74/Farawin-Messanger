<?php

trait faqTrait
{
    function faq($func = '', $attrId = 0)
    {
        if ($func != '' && $func == "add") {
            $admin_permission = $this->model->admin_permission_check("faq_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $_where = "WHERE s.s_status=1";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $data = array('services' => $serviceInfo);
                $this->view('admin/faq/faq-add', $data);
            } else {
                $this->noaccess();
            }
        } else if ($func != '' && is_numeric($attrId) && $func == "edit") {
            $admin_permission = $this->model->admin_permission_check("faq_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $QuestinInfoEdit = $this->model->getQuestinInfoEdit($attrId);
                $questionRelated = $this->model->getQuestionRelated($attrId, $QuestinInfoEdit[0]['type']);

                $_where = "WHERE s.s_status=1";
                $_input = array();
                $_order = "ORDER BY s.s_id DESC";
                $_limit = "";
                $_join = "";
                $serviceInfo = $this->model->getServiceData(False, False, $_where, $_order, $_limit, $_input, $_join, False);

                $data = array(
                    'question' => $QuestinInfoEdit,
                    'questionRelated' => $questionRelated,
                    'services' => $serviceInfo,
                    'attrId' => $attrId
                );
                $this->view('admin/faq/faq-edit', $data);
            } else {
                $this->noaccess();
            }
        } else {
            $admin_permission = $this->model->admin_permission_check("faq_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->view('admin/faq/faq');
            } else {
                $this->noaccess();
            }
        }
    }

    function getQuestionsAjax()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("faq_list_view", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->getQuestionsAjax($_GET);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function addFaq()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("faq_add", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->addFaq($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function statusFaq()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("faq_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->statusFaq($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function editQuestion()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("faq_status_info_edit", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->editQuestion($_POST);
            } else {
                $this->noaccess();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function delQuestion()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $admin_permission = $this->model->admin_permission_check("faq_delete", $this->checkLoginAdmin);
            if ($admin_permission) {
                $this->model->delQuestion($_POST);
            } else {
                $this->model->response_access_denied();
            }
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

}
