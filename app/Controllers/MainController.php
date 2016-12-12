<?php

class MainController extends Controller
{

    function index()
    {
        $feedModel = new FeedbackModel();

        $orderCol = "created";
        $sort = "desc";

        if (isset($_GET['order'])) {
            $orderCol = $_GET['order'];
        }
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        }

        $data = $feedModel->getAll($orderCol, $sort);


        //$this->view->generate('services_view.php', 'template_view.php', $data);
        $this->view('main_view', $data);
    }
}