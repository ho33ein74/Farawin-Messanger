<?php
    
    class notfound extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        function index()
        {
            $this->view('notfound/index');
        }
    }

?>