<?php

class AuthController extends Controller
{

    function registerView()
    {
        $this->view("registration_view");
    }

    function register()
    {

        $err = array();

        if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }

        if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 32) {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }

        if (strlen($_POST['password']) < 3 or strlen($_POST['password']) > 32) {
            $err[] = "Пароль должен быть не меньше 3 символов и не больше 30";
        }

        if ($_POST['password'] != $_POST['password_controll']) {
            $err[] = "Пароли не одинаковые";
        }

        if (!empty(UserModel::getUserByName($_POST['login']))) {
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

        if (count($err) == 0) {

            $login = $_POST['login'];

            $salt = Auth::generateSalt();

            $password = Auth::generatePassword($_POST['password'], $salt);

            $token = Auth::generateToken();

            $user = new User();
            $user->setName($login);
            $user->setPassword($password);
            $user->setPasswordSalt($salt);
            $user->setToken($token);
            $user->setIsAdmin(true);

            $em = ORM::getEntityManager();
            $em->persist($user);
            $em->flush();

            $this->redirect("/");

        } else {

            $this->view("registration_view", $err);

        }

    }

    function loginView()
    {
        $this->view("login_view");
    }

    function login()
    {

        $user = UserModel::getUserByName($_POST["login"]);

        if (empty($user)) {
            $this->view("login_view", ["Такого пользователя нет"]);
            die();
        }

        $inputPassword = $_POST['password'];
        $userPassword = $user->getPassword();
        $salt = $user->getPasswordSalt();

        $hashedPassword = Auth::generatePassword($inputPassword, $salt);

        if ($hashedPassword != $userPassword) {

            $this->view("login_view", ["Неверный пароль"]);
            die();

        } else {

            //$newToken = UserModel::updateToken($user);
            $name = $user->getName();
            $isAdmin = $user->getIsAdmin();
            $token = $user->getToken();

            $_SESSION['name'] = $name;
            $_SESSION['is_admin'] = $isAdmin;
            $_SESSION['token'] = $token;

            $this->redirect("/");

        }

    }

    function logout()
    {
        Auth::logout();

        $this->redirect('/');
    }
}