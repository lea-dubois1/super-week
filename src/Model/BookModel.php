<?php

namespace App\Model;

class BookModel extends BaseModel
{
    public function getDataAll(): array
    {
        $sql = "SELECT * FROM book";
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDataOne($id)
    {
        $sql = "SELECT * FROM book WHERE id = :id";
        $req = $this->conn->prepare($sql);
        $req->execute([':id' => $id]);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>