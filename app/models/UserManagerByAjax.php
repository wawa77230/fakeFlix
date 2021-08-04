<?php
require_once "Database.php";
require_once "User.php";

class UserManagerByAjax extends Database
{
    public function updateAdminStatusUserBd($id,$isAdmin)
    {
        $req = "UPDATE users
               SET isAdmin = :isAdmin
               WHERE id = :id   ";
        $stmt = $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "isAdmin" => $isAdmin,
            "id" => $id
        ]);
        $stmt->closeCursor();

    }
    public function updateBlockedStatusUserBd($id,$isBlocked)
    {
        $req = "UPDATE users
               SET isBlocked = :isBlocked
               WHERE id = :id   ";
        $stmt = $this->getBdd()->prepare($req);
        $result = $stmt->execute([
            "isBlocked" => $isBlocked,
            "id" => $id
        ]);
        $stmt->closeCursor();

    }

    public function deleteUserBd($id)
    {
        $req = "DELETE FROM users WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

    }
}