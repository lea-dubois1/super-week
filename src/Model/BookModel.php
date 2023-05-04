<?php

namespace App\Model;

class BookModel
{

    public function add($titre, $contenu, $idUser): void
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
        $sql = "INSERT INTO book (titre, content, id_user) VALUES (:titre, :content, :id_user)";
        $req = $conn->prepare($sql);
        $req->execute([':titre' => $titre,
                       ':content' => $contenu,
                       ':id_user' => $idUser
        ]);
    } 

    public function getDataAll(): array
    {
        $conn = new \PDO('mysql:host=localhost;dbname=revisions', "root", "");
        $sql = "SELECT * FROM book";
        $req = $conn->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>