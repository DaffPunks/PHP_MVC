<?php

class FeedbacksController extends Controller
{
    /** Create Feedback */
    function create()
    {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['text'])) {
            echo "Поля не заполнены";
            die();
        }

        FeedbackModel::createFeedback($_POST['name'], $_POST['email'], $_POST['text'], $_FILES["image"]);

        $this->redirect('/');
    }

    /** Edit Feedback */
    function edit()
    {
        FeedbackModel::editFeedback($_GET['id'], $_POST['name'], $_POST['email'], $_POST['text']);

        $this->redirect('/');
    }

    /** Accept Feedback by Admin */
    function accept()
    {
        if (Auth::isAdmin()) {
            $this->setStatus(1);
            $this->redirect('/');
        } else {
            echo "Forbidden";
        }
    }

    /** Reject Feedback by Admin */
    function reject()
    {
        if (Auth::isAdmin()) {
            $this->setStatus(2);
            $this->redirect('/');
        } else {
            echo "Forbidden";
        }
    }

    /** Set feedback status */
    private function setStatus($status)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "Didn't set ID";
            die();
        }

        FeedbackModel::updateStatus($id, $status);
    }


}