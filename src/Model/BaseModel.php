<?php

namespace App\Model;

class BaseModel
{
    protected \PDO $conn;

    public function __construct()
    {
        $this->conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
    }

    public function insert(string $table, array $params): void
    {
        $sql = "INSERT INTO " . $table . " (";

        foreach ($params as $key => $value) {
            $sql .= $key . ", ";
        }

        $sql = substr($sql, 0, -2) . ") VALUES (";

        foreach ($params as $key => $value) {
            $sql .= ":" . $key . ", ";
        }

        $sql = substr($sql, 0, -2) . ")";

        $req = $this->conn->prepare($sql);
        $req->execute($params);
    }
}

?>