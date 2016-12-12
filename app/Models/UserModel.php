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

    static function createAdmin($login, $password){
        $salt = Auth::generateSalt();

        $saltedPassword = Auth::generatePassword($password, $salt);

        $token = Auth::generateToken();

        $user = new User();
        $user->setName($login);
        $user->setPassword($saltedPassword);
        $user->setPasswordSalt($salt);
        $user->setToken($token);
        $user->setIsAdmin(true);

        $em = ORM::getEntityManager();
        $em->persist($user);
        $em->flush();
    }


}