<?php

namespace App\Controller;
use App\Model\UserModel;

class AuthController
{

    public function register($email, $firstname, $lastname, $password): string
    {
        $model = new UserModel;
        $row = $model->checkUserExist($email);

        var_dump($row);

        if($row < 1) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $model->insert('user', ['email' => $email, 'first_name' => $firstname, 'last_name' => $lastname, 'password' => $hash]);
            return "Inscription terminée";
        }else{
            return "Email déjà présent dans la base de donnée";
        }
    }

    public function login($email, $password)
    {
        $model = new UserModel;
        $row = $model->checkUserExist($email);

        if($row > 0) {

            $DBPass = $model->getPassDB($email)['password'];

            if(password_verify($password, $DBPass) === true) {

                $_SESSION['user'] = $model->getDataByMail($email)[0];

                return "Connexion réussie";
            }

        }else{

            return "Email inconnu dans la base de donnée";
        } 
    }

}

?>