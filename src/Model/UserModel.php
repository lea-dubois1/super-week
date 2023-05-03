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
}

?>