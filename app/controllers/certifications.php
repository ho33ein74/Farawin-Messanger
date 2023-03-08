<?php

class Certifications extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view('certifications/index');
    }

}

?>