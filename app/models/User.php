<?php


class User
{
    public $id;
    public $firstname;
    public $lastname;
    public $password;
    public $email;
    public $isAdmin;


    public function __construct($id, $firstname, $lastname,$email, $password,  $isAdmin)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin): void
    {
        $this->role = $isAdmin;
    }


}