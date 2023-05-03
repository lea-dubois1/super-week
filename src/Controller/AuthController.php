<?php

namespace App\Controller;
use App\Model\UserModel;

class AuthController
{

    public function register($email, $firstname, $lastname, $password)
    {
        $model = new UserModel;
        $row = $model->checkUserExist($email);

        if($row < 1) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $model->insertUser($email, $firstname, $lastname, $hash);
            echo "Inscription terminée";
        }else{
            echo "Email déjà présent dans la base de donnée";
        }
    }

}

?>