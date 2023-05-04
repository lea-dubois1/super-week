<?php

namespace App\Controller;
use App\Model\BookModel;

class BookController
{
    public function addBook($titre, $contenu, $userId)
    {
        $model = new BookModel;
        $model->add($titre, $contenu, $userId);
        return "Le livre a bien été ajouté";
    }

    public function dataAll()
    {
        $model = new BookModel;
        return json_encode($model->getDataAll(), JSON_PRETTY_PRINT);
    }

    public function dataOne($id)
    {
        $model = new BookModel;
        return json_encode($model->getDataOne($id), JSON_PRETTY_PRINT);
    }
}


?>