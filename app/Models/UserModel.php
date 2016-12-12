<?php

class UserModel
{

    static function getAll() {
        $entityManager = ORM::getEntityManager();

        $userRepo = $entityManager->getRepository('User');
        $users = $userRepo->findAll();

        return $users;
    }

    static function getUserByName($name) {
        $entityManager = ORM::getEntityManager();

        $user = $entityManager->getRepository('User')->findOneBy(array("name" => $name));

        return $user;
    }

    static function updateToken(User $user) {
        $token = Auth::generateToken();

        $user->setToken($token);

        ORM::getEntityManager()->flush();

        return $token;
    }


}