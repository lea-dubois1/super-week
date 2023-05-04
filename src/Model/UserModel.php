<?php

namespace App\Model;

class UserModel extends BaseModel
{
    public function findAll(): array|false
    {
        $sql = "SELECT * FROM user";
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function checkUserExist($email): bool
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $this->conn->prepare($sql);
        $req->execute([':email' => $email]);
        var_dump($req->rowCount());
        return $req->rowCount();
    }

    public function getPassDB($email)
    {
        $sql = "SELECT password FROM user WHERE email = :email";
        $req = $this->conn->prepare($sql);
        $req->execute([':email' => $email]);
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $req = $this->conn->prepare($sql);
        $req->execute([':id' => $id]);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDataByMail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $this->conn->prepare($sql);
        $req->execute([':email' => $email]);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

}

?>