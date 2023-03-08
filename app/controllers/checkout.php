<?php
    
    class Checkout extends Controller
    {
        public $checkLogin = '';

        function __construct()
        {
            parent::__construct();
        }

        function index()
        {
            if (isset($_GET['Authority']) OR isset($_GET['reservation_tracking'])) {
                $orderInfo = $this->model->paymentChekout($this->checkLogin,$_GET);
                $data = array('orderInfo' => $orderInfo);

                $this->view('checkout/index', $data);
            } else {
                $this->view('notfound/index');
            }
        }
    }

?>