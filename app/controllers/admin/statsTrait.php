<?php

trait statsTrait
{
    function stats()
    {
        $admin_permission = $this->model->admin_permission_check("stats_view", $this->checkLoginAdmin);
        if ($admin_permission) {
            $statusOrderPie = $this->model->statusOrderPie($_GET['from'], $_GET['to']);
            $referral = $this->model->getReferral($_GET['from'], $_GET['to']);
//            $reservationStatOrder = $this->model->getStatOrder($_GET['from'], $_GET['to']);
            $orderStatPaymnet = $this->model->getStatPayment($_GET['from'], $_GET['to']);
            $bannerTop = $this->model->bannerTop($_GET['from'], $_GET['to']);
            $getStatsData = $this->model->getStatsData($_GET['from'], $_GET['to']);

            $data = array(
                'bannerTop' => $bannerTop, 'referral' => $referral, 'statusOrderPie' => $statusOrderPie,
                'orderStatPaymnet' => $orderStatPaymnet, 'getStatsData' => $getStatsData
            );
            $this->view('admin/stats/stats', $data);
        } else {
            $this->noaccess();
        }
    }
}
