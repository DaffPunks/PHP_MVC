<?php

/**
 * @Entity @Table(name="users")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    protected $name;

    /** @Column (type="string") * */
    protected $password;

    /** @Column (type="string") * */
    protected $password_salt;

    /** @Column (type="string") * */
    protected $token;

    /** @Column (type="boolean") * */
    protected $isAdmin;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPasswordSalt()
    {
        return $this->password_salt;
    }

    public function setPasswordSalt($passwordSalt)
    {
        $this->password_salt = $passwordSalt;
    }

    public function getToken()
    {
        return $this->token;
    }


    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }


}