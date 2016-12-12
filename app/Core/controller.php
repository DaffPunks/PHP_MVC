<?php

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function view($view, $data = null)
    {

        $view = $view . ".php";

        $this->view->generate($view, $data);

    }

    function redirect($url, $code = null)
    {
        header("Location: " . $url, true, $code);
    }

}
