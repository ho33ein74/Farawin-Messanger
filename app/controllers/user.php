<?php

class User extends Controller
{
    public $checkLogin = '';

    function __construct()
    {
        parent::__construct();
        if ($this->checkLogin == FALSE) {
            header("Location:" . URL);
        }
    }

    public function getCityByProvince()
    {
        $this->model->getCityByProvince($_POST);
    }

    function index()
    {
        $getLastBookingUser = $this->model->getLastBookingUser($this->checkLogin);
        $publicData = $this->model->publicData($this->checkLogin);

        $data = array(
            'bookingUser' => $getLastBookingUser,
            'publicData' => $publicData
        );
        $this->view('user/index', $data);
    }

    function profile()
    {
        $provinces = $this->model->getProvinces();
        $getUserInfo = $this->model->getinfoUser($this->checkLogin);
        $city = $this->model->getCity($getUserInfo['province_id']);

        $data = array(
            'provinces' => $provinces,
            'city' => $city
        );
        $this->view('user/profile', $data);
    }

    function orders()
    {
        $getOrder = $this->model->getOrder($this->checkLogin);
        $getOrderStatus = $this->model->getOrderStatus();

        $data = array(
            'getOrder' => $getOrder,
            'getOrderStatus' => $getOrderStatus
        );
        $this->view('user/orders', $data);
    }

    function financial()
    {
        $getPaymentLog = $this->model->getPaymentLog($this->checkLogin);

        $data = array(
            'paymentLog' => $getPaymentLog
        );
        $this->view('user/financial', $data);
    }

    function favorites()
    {
        $getFavoriteMag = $this->model->getFavoriteMag($this->checkLogin);
        $getFavoriteShop = $this->model->getFavoriteShop($this->checkLogin);

        $data = array(
            'getFavoriteShop' => $getFavoriteShop,
            'getFavoriteMag' => $getFavoriteMag
        );
        $this->view('user/favorites', $data);
    }

    function comments()
    {
        $getComment = $this->model->getComment($this->checkLogin);

        $data = array(
            'comments' => $getComment
        );
        $this->view('user/comments', $data);
    }

    function reservations($func = '', $attrId = 0)
    {
        if ($func != '' && is_numeric($attrId) && $func == "details") {
            $id_isset = $this->model->getIssetBooking($this->checkLogin, $attrId);
            if (sizeof($id_isset) > 0) {
                $getBookingUserDetails = $this->model->getBookingUserDetails($this->checkLogin, $attrId);
                $getBookingPaymentUser = $this->model->getBookingPaymentUser($attrId);
                $getBookingLatestActivity = $this->model->getBookingLatestActivity($attrId);

                $data = array(
                    'bookingUserDetails' => $getBookingUserDetails,
                    'bookingPaymentUser' => $getBookingPaymentUser,
                    'bookingLatestActivity' => $getBookingLatestActivity
                );
                $this->view('user/reservations-details', $data);
            } else {
                $this->view('notfound/index');
            }
        } else if ($func == '') {
            $getBookingUser = $this->model->getBookingUser($this->checkLogin);
            $data = array('bookingUser' => $getBookingUser);
            $this->view('user/reservations', $data);
        } else {
            $this->view('notfound/index');
        }
    }

    function userLike()
    {
        $this->model->userLike($this->checkLogin, $_POST);
    }

    function addOrDeleteBookmark()
    {
        $this->model->addOrDeleteBookmark($this->checkLogin, $_POST);
    }

    function addRating()
    {
        $this->model->addRating($this->checkLogin, $_POST);
    }

    function upload()
    {
        $this->model->upload($this->checkLogin, $_POST);
    }

    function deleteFavorite()
    {
        $this->model->deleteFavorite($this->checkLogin, $_POST);
    }

    function deleteImg()
    {
        $this->model->deleteImg($this->checkLogin);
    }

    function logout()
    {
        $this->model->logout();
        echo "<script>history.back();</script>";
    }

    function editUserInfo()
    {
        $this->model->editUserInfo($_POST, $this->checkLogin);
    }

    function changePass()
    {
        $this->model->changePass($_POST, $this->checkLogin);
    }

    function sendComment()
    {
        if ($this->checkLogin == FALSE) {
            echo "error";
        } else {
            $this->model->sendComment($_POST, $this->checkLogin);
        }
    }

    function replyComment()
    {
        if ($this->checkLogin == FALSE) {
            echo "error";
        } else {
            $this->model->replyCommentSave($_POST, $this->checkLogin);
        }
    }
}

?>