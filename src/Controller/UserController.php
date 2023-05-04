<?php

namespace App\Controller;
use App\Model\UserModel;

require_once 'vendor/autoload.php';

use Faker;

class UserController
{

    public function list()
    {
        $model = new UserModel();
        $allUsers = $model->selectAll('user');

        return json_encode($allUsers, JSON_PRETTY_PRINT);
    }

    public function create()
    {
        $faker = Faker\Factory::create("fr_FR");

        for ($i=0; $i < 10; $i++) {
    
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();

            $params = [':email' => strtolower($first_name) . "." . strtolower($last_name) . "@" . $faker->freeEmailDomain(),
                       ':first_name' => $first_name,
                       ':last_name' => $last_name,
                       ':password' => password_hash("azerty", PASSWORD_DEFAULT)
            ];

            $model = new UserModel();
            $model->insert('user', $params);
        }
    }

    public function dataById($id)
    {
        $model = new UserModel();
        $data = $model->selectWhere('user', ['id' => $id], []);
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}

?>