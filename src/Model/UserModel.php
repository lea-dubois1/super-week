<?php

namespace App\Model;

class UserModel extends AbstractModel
{
    protected string $table = 'user';
    
    public function checkUserExist($email): bool
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $this->conn->prepare($sql);
        $req->execute([':email' => $email]);
        var_dump($req->rowCount());
        return $req->rowCount();
    }
}

?>