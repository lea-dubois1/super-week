<?php

namespace App\Controller;
use App\Model\BookModel;

require_once 'vendor/autoload.php';

class BookController
{
    public function addBook($titre, $contenu, $userId)
    {
        $model = new BookModel;
        $model->insert(['titre' => $titre, 'content' => $contenu, 'id_user' => $userId]);
        return "Le livre a bien été ajouté";
    }

    public function dataAll()
    {
        $model = new BookModel;
        return json_encode($model->select([], []), JSON_PRETTY_PRINT);
    }

    public function dataOne($id)
    {
        $model = new BookModel;
        return json_encode($model->select([], ['id' => $id]), JSON_PRETTY_PRINT);
    }
}


?>