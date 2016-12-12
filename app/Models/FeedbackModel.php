<?php

class FeedbackModel
{

    function getAll($orderCol = "created", $sorting = "DESC")
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

    function getById($id)
    {
        $entityManager = ORM::getEntityManager();
        $feedback = $entityManager->getRepository('Feedback')->findOneBy(array("id" => $id));;

        return $feedback;
    }

    function updateStatus($id, $status)
    {
        $entityManager = ORM::getEntityManager();

        $feed = $this->getById($id);
        $feed->setStatus($status);

        $entityManager->flush();
    }


}