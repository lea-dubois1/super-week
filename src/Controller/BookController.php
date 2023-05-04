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
}


?>