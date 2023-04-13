<?php

class Services extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $url = $this->model->check_param($_GET['url']);
        $url_check = explode("/", $url);
        $slug = str_replace(["services", "/"], ["", ""], $url);
        if ($slug != '' and $url_check[1] != "page") {
            $service_isset = $this->model->getIssetServiceSlug($slug);
            if (sizeof($service_isset) > 0) {
                $this->model->calViewer($service_isset['0']['s_id'], $_SERVER['REMOTE_ADDR'], "service");

                $_where = "WHERE s.s_slug=? AND s.s_status=1";
                $_input = array($slug);
                $_order = "";
                $_limit = "";
                $_join = "";
                $getServices = $this->model->getServiceData(False, $this->checkLogin, $_where, $_order, $_limit, $_input, $_join, True);

                $comment = $this->model->getCommentData($service_isset['0']['s_id'], "service", $this->checkLogin);
                $getServicesTag = $this->model->getServicesTag($service_isset['0']['s_id']);
                $getServicesTiming = $this->model->getServicesTiming($service_isset['0']['s_id']);
                $getServicesRandom = $this->model->getServicesRandom($service_isset['0']['s_id'], 3);
                $getServicesTariff = $this->model->getServicesTariff($service_isset['0']['s_id']);
                $getRelatedBlog = $this->model->getRelatedBlog($service_isset['0']['s_id']);
                $getRelatedFaq = $this->model->getRelatedFaq($service_isset['0']['s_id'], 'service');
                $getServicePortfolio = $this->model->getServicePortfolio($service_isset['0']['s_id']);
                $checkTurnBookingUser = $this->model->checkTurnBookingUser($service_isset['0']['s_id'], $this->checkLogin);
                $getScoreItem = $this->model->getScoreItem($service_isset['0']['s_id'], "service");

                $data = array(
                    'services' => $getServices,
                    'comment' => $comment,
                    'servicesTiming' => $getServicesTiming,
                    'servicesTag' => $getServicesTag,
                    'attrId' => $service_isset['0']['s_id'],
                    'servicesRandom' => $getServicesRandom,
                    'servicesTariff' => $getServicesTariff,
                    'relatedBlog' => $getRelatedBlog,
                    'relatedFaq' => $getRelatedFaq,
                    'checkTurnBookingUser' => $checkTurnBookingUser,
                    'scoreItem' => $getScoreItem,
                    'portfolio' => $getServicePortfolio);

                $this->view('services/reservation', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $getServices = $this->model->getServices($this->checkLogin, $_GET);
            $getItemsPagination = $this->model->getItemsPagination($_GET);
            $page = $this->model->getPage($_GET['url']);

            $data = array(
                'itemsPagination' => $getItemsPagination,
                'page' => $page,
                'services' => $getServices
            );
            $this->view('services/index', $data);
        }
    }

    function staffs($id){
        if ($id != '' && is_numeric($id)) {
            $id_isset = $this->model->getIssetStaff($id);
            if (sizeof($id_isset) > 0) {
                $getStaff = $this->model->get_staff_info($id);

                $data = array(
                    'getStaff' => $getStaff,
                    'attrId'  => $id
                );

                $this->view('services/staff-info', $data);
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('notfound/index');
        }
    }

    function initDays()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->initDays($this->checkLogin);
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getFirstFree()
    {
        $csrf_token = $this->model->check_csrf_token();
        if($csrf_token['status']) {
            $this->model->getFirstFree();
        } else {
            $this->model->response_error($csrf_token['msg']);
        }
    }

    function getCalendarFile($func = '', $attrId = 0)
    {
        $this->model->getCalendarFile($func, $this->checkLogin);
    }
}

?>