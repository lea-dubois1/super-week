<?php

namespace App\Model;

abstract class AbstractModel
{
    protected ?\PDO $conn = null;
    protected string $table;

    public function __construct()
    {
        $this->conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
    }

    public function insert(array $params): void
    {
        $sql = "INSERT INTO " . $this->table . " (";

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

    public function select(array $values, array $criteria): ?array
    {
        $sql = "SELECT ";

        if ($values === []) {

            $sql .= "* FROM " . $this->table . " WHERE ";

        }else{

            foreach ($values as $value) {
                $sql .= $value . ", ";
            }

            $sql = substr($sql, 0, -2) . " FROM " . $this->table . " WHERE ";
        }

        if ($criteria === []) {

            $sql = substr($sql, 0, -7);

        }else{

            foreach ($criteria as $key => $value) {
                $sql .= $key . " = :" . $key . " AND ";
            }

            $sql = substr($sql, 0, -5);

        }

        $req = $this->conn->prepare($sql);
        $req->execute($criteria);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>