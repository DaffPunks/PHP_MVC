<?php

class FeedbacksController extends Controller
{
    function create()
    {

        $entityManager = ORM::getEntityManager();

        $feedback = new Feedback();
        $feedback->setName($_POST['name']);
        $feedback->setEmail($_POST['email']);
        $feedback->setText(nl2br($_POST['text']));

        $entityManager->persist($feedback);
        $entityManager->flush();

        $this->redirect('/');
    }

    function accept()
    {
        if(Auth::isAdmin()) {
            $this->setStatus(1);
            $this->redirect('/');
        } else {
            echo "Forbidden";
        }
    }

    function reject()
    {
        if(Auth::isAdmin()) {
            $this->setStatus(2);
            $this->redirect('/');
        } else {
            echo "Forbidden";
        }
    }

    private function setStatus($status)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "Didn't set ID";
            die();
        }

        $feedbackModel = new FeedbackModel();
        $feedbackModel->updateStatus($id, $status);
    }

}