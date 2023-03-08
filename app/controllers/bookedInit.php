<?php

class bookedInit extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        if ($this->checkLogin == FALSE) {
            header("Location:" . URL);
        }
    }

    function index()
    {
        if($this->model->Check_Param($_GET['date'])!='' AND $this->model->Check_Param($_GET['time'])!='' AND $this->model->Check_Param($_GET['ugid'])!='') {
            $service_isset = $this->model->getIssetService($_GET['ugid']);
            if(sizeof($service_isset)>0) {
                $check_time = str_replace("_","",$_GET['date']).str_replace("_","",$_GET['time']);
                if($check_time>=jdate("YmdHi", '', '', '', 'en')) {
                    $checkServiceTiming = $this->model->checkServiceTiming($_GET['ugid'], $_GET['date'], $_GET['time'], $this->checkLogin);
                    if ($checkServiceTiming['status']) {
                        $reservaationId = $this->model->savePreReservation($_GET['ugid'], $_GET['date'], $_GET['time'], $checkServiceTiming['day'], $checkServiceTiming['is_vip'], $this->checkLogin);
                        $checkTurnBookingUser = $this->model->checkTurnBookingUser($_GET['ugid'], $_GET['date'], $_GET['time'], $this->checkLogin);

                        $_where = "WHERE s.s_id=? AND s.s_status=1";
                        $_input = array($service_isset['0']['s_id']);
                        $_order = "";
                        $_limit = "";
                        $_join = "";
                        $getServices = $this->model->getServiceData(False, $this->checkLogin, $_where, $_order, $_limit, $_input, $_join, True);

                        $getServicesTariff = $this->model->getServicesTariff($service_isset['0']['s_id'], $checkServiceTiming['is_vip']);
                        $getDateInfo = $this->model->getDateInfo($_GET['ugid'], $_GET['date'], $_GET['time'], $reservaationId);
                        $getPayType = $this->model->getPayType();
                        $getOffCodeUsed = $this->model->getOffCodeUsed($this->checkLogin);

                        $bookedInfo = array(
                            'serviceId' =>  Model::Encrypt($_GET['ugid'], KEY),
                            'date' =>  Model::Encrypt($_GET['date'], KEY),
                            'time' =>  Model::Encrypt($_GET['time'], KEY),
                            'description' =>  $checkServiceTiming['description']
                        );

                        $data = array(
                            'services' => $getServices,
                            'servicesTariff' => $getServicesTariff,
                            'is_vip' => $checkServiceTiming['is_vip'],
                            'turn_type' => $checkServiceTiming['turn_type'],
                            'offCodeUsed' => $getOffCodeUsed,
                            'dateInfo' => $getDateInfo,
                            'payType' => $getPayType,
                            'bookedInfo' => $bookedInfo,
                            'checkTurnBookingUser' => $checkTurnBookingUser
                        );
                        $this->view('bookedInit/index', $data);
                    } else {
                        $data = array('url' => $service_isset['0']['s_slug']);
                        $this->view('bookedInit/noTime', $data);
                    }
                } else {
                    $data = array('url' => $service_isset['0']['s_slug']);
                    $this->view('bookedInit/noTime', $data);
                }
            } else {
                $this->view('notfound/index');
            }
        } else {
            $this->view('bookedInit/error');
        }
    }

    function saveOrder()
    {
        try {
            $csrf_token = $this->model->check_csrf_token();
            if ($csrf_token['status']) {
                $this->model->saveOrder($this->checkLogin, $_POST);
            } else {
                $this->model->response_error($csrf_token['msg']);
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function calculatePayment()
    {
        try {
            $csrf_token = $this->model->check_csrf_token();
            if ($csrf_token['status']) {
                $this->model->calculatePayment($this->checkLogin, $_POST);
            } else {
                $this->model->response_error($csrf_token['msg']);
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }

    function checkCode()
    {
        try {
            $csrf_token = $this->model->check_csrf_token();
            if ($csrf_token['status']) {
                $this->model->checkCode($this->checkLogin, $_POST['serviceId'], $_POST['tariff'], $_POST['status'], $_POST['code'], 1);
            } else {
                $this->model->response_error($csrf_token['msg']);
            }
        } catch (Exception $e) {
            $this->response_error($e->getMessage());
        }
    }
}

?>