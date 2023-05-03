<?php

namespace App\Controller;
use App\Model\UserModel;

class UserController
{

    public function list()
    {
        $model = new UserModel();
        $allUsers = $model->findAll();

        return json_encode($allUsers, JSON_PRETTY_PRINT);
    }

}

?>