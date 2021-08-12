<?php
require_once "Database.php";
require_once "User.php";

class UserManager  extends  Database
{
    private $users;

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function addUserDb($firstName, $lastName, $email, $pwd, $isAdmin, $secret, $createAt)
    {
        $req= "
                INSERT INTO users(firstName, lastName, email, pwd, isAdmin, secret, createAt)
                                    VALUES  (:firstName, :lastName, :email, :pwd, :isAdmin, :secret, :createAt)";
        $stmt = $this->getBdd()->prepare($req);
        try{

            $result = $stmt->execute([
                "firstName"=> $firstName,
                "lastName"=> $lastName,
                "email"=> $email,
                "pwd"=> $pwd,
                "isAdmin"=> $isAdmin,
                "secret"=> $secret,
                "createAt" => $createAt,

            ]);
            $stmt->closeCursor();

            if ($result > 0){
                $user = new User($this->getBdd()->lastInsertId(), $firstName, $lastName, $email, $pwd, $isAdmin, $secret, $createAt, 0);
                $this->addUser($user);
            }
        }
        catch (Exception $e)
        {
            if($e->getCode() == 23000)
            {
                echo '<small>Cette adresse mail existe deja</small> ';
            }
            else
            {
                throw $e ;
            }
        }
    }

    public function findAllUsers(){
        $req = $this->getBdd()->prepare("SELECT id, firstName,lastName,email,pwd,isAdmin,secret, DATE_FORMAT(createAt, '%d/%m/%Y')as createAt,  isBlocked  FROM users");
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($users as $user){
            $u = new User($user['id'], htmlspecialchars($user['firstName']),htmlspecialchars($user['lastName']),htmlspecialchars($user['email']),$user['pwd'],$user['isAdmin'],$user['secret'], $user['createAt'],  $user['isBlocked']);
            $this->addUser($u);
        }
    }

    public function getUsers(){
        return $this->users;
    }

    public function findByEmailAndCheckPassword($email, $pwd)
    {

        foreach ($this->users as $user){
            if ($user->getEmail() === $email){
                if (password_verify($pwd, $user->getPassword()))
                {
                    return $user;
                }
            }
        }
    }

    public function getUserById($id)
    {
        //Si je devais faire la requete "classique"
        //$req = $this->getBdd()->prepare("SELECT id, firstName, lastName, email, isAdmin,secret, createAt, isBlocked  FROM users WHERE id = :id");
        //$req->execute(["id" => $id]);
        //$user = $req->fetch(PDO::FETCH_ASSOC);
        //$req->closeCursor();

        foreach ($this->users as $user){
            if ($user->getId() === $id){
                return $user;
            }
        }
        throw new Exception("L'utilisateur n'existe pas");
    }

    public function updateUserBd($id, $firstName, $lastName, $email, $pwd, $isAdmin)
    {
        $req ="UPDATE users
               SET firstName = :firstName,
                   lastName = :lastName,
                   email = :email,
                   pwd = :pwd,
                   isAdmin = :isAdmin
               WHERE id = :id   ";
        $stmt= $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "firstName"=> $firstName,
            "lastName"=> $lastName,
            "email"=> $email,
            "pwd"=> $pwd,
            "isAdmin"=> $isAdmin,
            "id"=> $id
        ]);
        $stmt->closeCursor();

        if ($result > 0){
            $this->getUserById($id)->setFirstName($firstName);
            $this->getUserById($id)->setLastName($lastName);
            $this->getUserById($id)->setEmail($email);
            $this->getUserById($id)->setPassword($pwd);
            $this->getUserById($id)->setIsAdmin($isAdmin);
        }
    }

    public function deleteUserBd($id)
    {
        $req="DELETE FROM users WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);
        $result =$stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $user =$this->getUserById($id);
            unset($user);
        }
    }
}