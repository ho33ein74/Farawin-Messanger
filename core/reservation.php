<?php

class reservation
{
    public $controller = 'index';
    public $method = 'index';
    public $params = array();

    function __construct()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = $this->parseUrl($url);

            if($url[0] == ADMIN_PATH){
                $this->controller = "admin";
            } else {
                if($url[0] != "admin"){
                    $this->controller = $url[0];
                } else {
                    $this->controller = "";
                }
            }
            unset($url[0]);
            if (isset($url[1])) {
                if(!is_numeric ($url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            $this->params = array_values($url);
        }

        $controllerUrl = 'app/controllers/' . $this->controller . '.php';
        if (!file_exists($controllerUrl)) {
            $this->controller = "page";
            $controllerUrl = 'app/controllers/' . $this->controller . '.php';
        }

        require_once $controllerUrl;

        $object = new $this->controller;
        $object->model($this->controller);

        if (method_exists($object, $this->method)) {
            $arr = array($object, $this->method);
        } else {
            $arr = array($object, $this->method = 'index');
        }
        call_user_func_array($arr, $this->params);
    }

    function parseUrl($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        return $url;
    }
}

?>