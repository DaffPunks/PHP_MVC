<?php

class FeedbackModel
{

    public static function getAll($orderCol = "created", $sorting = "DESC")
    {

        $availableSorting = ["ASC", "DESC"];

        $sorting = strtoupper($sorting);
        if (!in_array($sorting, $availableSorting)) {
            $sorting = "ASC";
        }


        //Get all feedback's order by $orderCol
        $entityManager = ORM::getEntityManager();
        $feedRepo = $entityManager->getRepository('Feedback');
        $feeds = $feedRepo->findBy(array(), array($orderCol => $sorting));

        return $feeds;
    }

    public static function updateStatus($id, $status)
    {
        $entityManager = ORM::getEntityManager();

        $feed = FeedbackModel::getById($id);
        $feed->setStatus($status);

        $entityManager->flush();
    }

    public static function createFeedback($name, $email, $text, $image) {
        $entityManager = ORM::getEntityManager();


        $feedback = new Feedback();
        $feedback->setName($name);
        $feedback->setEmail($email);
        $feedback->setText(nl2br($text));

        if(!empty($image["size"])) {
            $feedback->setImage($image["name"]);

            $new_image = new ImageService($image["tmp_name"]);
            $new_image->autoimageresize(320, 240);
            $new_image->imagesave("storage/image/" . $image["name"]);
            $new_image->imageout();
        }

        $entityManager->persist($feedback);
        $entityManager->flush();
    }

    public static function editFeedback($id, $name, $email, $text) {
        $entityManager = ORM::getEntityManager();

        $feedbackModel = new FeedbackModel();
        $feedback = $feedbackModel->getById($id);

        $feedback->setName($name);
        $feedback->setEmail($email);
        $feedback->setText(nl2br($text));
        $feedback->setEdited(true);

        $entityManager->flush();
    }

    private static function getById($id)
    {
        $entityManager = ORM::getEntityManager();
        $feedback = $entityManager->getRepository('Feedback')->findOneBy(array("id" => $id));;

        return $feedback;
    }

}