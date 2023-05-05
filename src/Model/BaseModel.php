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

    public function selectAll($table): array
    {
        $sql = "SELECT * FROM " . $table;
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function selectWhere(string $table, array $params, ?array $values)
    {
        $sql = "SELECT ";

        if ($values === null || $values === []) {

            $sql .= "* FROM " . $table . " WHERE ";

        }else{

            foreach ($values as $value) {
                $sql .= $value . ", ";
            }

            $sql = substr($sql, 0, -2) . " FROM " . $table . " WHERE ";
        }

        if ($params === null || $params === []) {

            $sql = substr($sql, 0, -7);

        }else{

            foreach ($params as $key => $value) {
                $sql .= $key . " = :" . $key . " AND ";
            }

            $sql = substr($sql, 0, -5);

        }

        $req = $this->conn->prepare($sql);
        $req->execute($params);
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}

$test = new BaseModel;
$test->selectWhere('user', [], ["last_name"])

?>