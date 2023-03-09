<?php

    class Controller
    {
        function __construct()
        {
            Model::sessionInit();
            Model::cookieInit();
            $this->checkLogin = Model::Decrypt(Model::cookieGet('userId'), KEY);
            date_default_timezone_set("Asia/Tehran");
        }
        
        function view($viewUrl, $data = array())
        {
            $checkView = explode("/",$viewUrl);
            if($this->model->getPublicInfo("admin_ip_lock") == "1" or $checkView[0] != "admin"){
                $userId = Model::Decrypt(Model::cookieGet('userId'), KEY);
                if($userId != False) {
                    $data['profileNotification'] = $this->model->getProfileNotification($userId);
                    $data['infoUser'] = $this->model->getinfoUser($userId);
                    $data['userId'] = $userId;
                }
                $data['getHeaderMenu'] = $this->model->getMenuDisplay("header");
                $data['getFooterMenu'] = $this->model->getMenuDisplay("footer");
                $data['getMethodsContacting'] = $this->model->getMethodsContacting("", true);

                $detect = new Mobile_Detect;
                $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
                $data['device'] = $deviceType;
            } else {
                $admin = Model::Decrypt(Model::cookieGet('adminId'), KEY);
                if($admin != False) {
                    $data['infoAdmin'] = $this->model->getInfoAdmin($admin);
                    $data['sidebarMenu'] = $this->model->getMenuSidebar($admin);
                }
                $data['publicData'] = $this->model->publicData();
                $data['getMethodsContacting'] = $this->model->getMethodsContacting("", false);
            }

            $data['user_ip'] = $this->model->getClientIP();
            $data['getPublicInfo'] = $this->model->getPublicInfo();
            $data['getDomainsInfo'] = $this->model->getDomainsInfo();

            if (!isset($_SESSION["token"]) or !isset($_SESSION["token-expire"]) or time() >= $_SESSION["token-expire"]) {
                $this->model->set_csrf_token();
            }
            $data['csrf_token_hash'] = $_SESSION["token"];

            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $checkRedirectLink = $this->model->checkRedirectLink($actual_link);
            if(count($checkRedirectLink)==0) {
                $url_access = array(
                    'localhost',
                    '127.0.0.1',
                    'reservation.test',
                    'reservation.unixscript.ir',
                );

                if (in_array($_SERVER['HTTP_HOST'], $url_access)) {
                    if ($checkView[0] != "admin") { // صفحات سایت
                        if ($this->model->getPublicInfo("development_mode") == "1") {
                            require_once 'app/views/notfound/development-' . $data['getPublicInfo']['theme'] . '.php';
                        } else {
                            require_once 'app/views/' . $viewUrl . '-' . $data['getPublicInfo']['theme'] . '.php';
                        }
                    } else { //صفحات پنل مدیریت
                        if ($this->model->getPublicInfo("admin_ip_lock") == "1") {
                            $ip_list = explode(",", $this->model->getPublicInfo("admin_ip"));
                            if (in_array($data['user_ip'], $ip_list)) {
                                require_once 'app/views/' . $viewUrl . '.php';
                            } else {
                                require_once 'app/views/notfound/error-ip-' . $data['getPublicInfo']['theme'] . '.php';
                            }
                        } else {
                            require_once 'app/views/' . $viewUrl . '.php';
                        }
                    }
                } else {
                    $data['url_access'] = $url_access;
                    require_once 'app/views/notfound/error-' . $data['getPublicInfo']['theme'] . '.php';
                }
            } else {
                $this->model->RedirectLink($checkRedirectLink[0]['new_url'], $checkRedirectLink[0]['type']);
            }
        }
        
        function model($modelUrl)
        {
            require_once 'app/models/model_' . $modelUrl . '.php';
            $classname = 'model_' . $modelUrl;
            $this->model = new $classname;
        }
    }

?>