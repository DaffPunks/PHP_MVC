<?php

/** Authentication Service Facade
 *  Contain all AA logic
 */
class Auth
{

    public static function logout()
    {
        session_destroy();
    }

    public static function isAuth()
    {
        if (isset($_SESSION['token'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserName()
    {
        return $_SESSION['name'];
    }

    public static function generateSalt()
    {
        return uniqid(mt_rand(), true);
    }

    public static function generateToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    public static function generatePassword($password, $salt)
    {
        return md5($salt . md5(trim($password)));
    }

    public static function isAdmin() {
        return $_SESSION['is_admin'];
    }

}