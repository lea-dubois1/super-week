<?php

namespace App\Model;

class UserModel
{
    public function findAll(): array|false
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");

        $sql = "SELECT * FROM user";
        $req = $conn->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createUser(array $params): void
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");

        $sql = "INSERT INTO user (email, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)";
        $req = $conn->prepare($sql);
    
        $req->execute($params);
    }

    public function checkUserExist($email): bool
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");

        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $conn->prepare($sql);
        $req->execute([':email' => $email]);
        var_dump($req->rowCount());
        return $req->rowCount();
    }

    public function insertUser($email, $firstname, $lastname, $hash): void
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
        $sql = "INSERT INTO user (email, first_name, last_name, password) VALUES (:email, :first_name, :last_name, :password)";
        $req = $conn->prepare($sql);
        $req->execute([':email' => $email,
                       ':first_name' => $firstname,
                       ':last_name' => $lastname,
                       ':password' => $hash
        ]);
    }

    public function getPassDB($email)
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
        $sql = "SELECT password FROM user WHERE email = :email";
        $req = $conn->prepare($sql);
        $req->execute([':email' => $email]);
        return $req->fetch(\PDO::FETCH_ASSOC);
    }

    public function getData($id)
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
        $sql = "SELECT * FROM user WHERE id = :id";
        $req = $conn->prepare($sql);
        $req->execute([':id' => $id]);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

}

?>