<?php

namespace App\Model;

class User
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $password;
    private string $email;
    private int $isAdmin;
    private string $secret;
    private string $createAt;
    private int $isBlocked;


    public function __construct($id, $firstname, $lastname,$email, $password,  $isAdmin, $secret , $createAt, $isBlocked)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->secret = $secret;
        $this->createAt = $createAt;
        $this->isBlocked = $isBlocked;
    }

    public function getId(): int
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

    public function getSecret()
    {
        return $this->secret;
    }

    public function setSecret($secret): void
    {
        $this->secret = $secret;
    }

    public function getCreateAt()
    {
        return $this->createAt;
    }

    public function setCreateAt($createAt): void
    {
        $this->createAt = $createAt;
    }

    public function getIsBlocked()
    {
        return $this->isBlocked;
    }

    public function setIsBlocked($isBlocked): void
    {
        $this->isBlocked = $isBlocked;
    }

}