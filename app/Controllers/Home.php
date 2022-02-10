<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $session = session();

        $this->pr($session->get());

        echo "Welcome back, ".$session->get('name');
    }

    public function showAllUser()
    {
        $userModel = new \App\Models\UserModel();

        $users = $userModel->findAll();

        foreach ($users as &$user){
            $user['test'] = password_verify('12345s6', $user['password']);
        }

        $this->pr($users);

        return view('Home/index');
    }

    public function insertUser(){
        $userModel = new \App\Models\UserModel();

        $data = [
            'email' => 'toledana.ian@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT ),
            'fname' => 'Christian',
            'mname' => 'Barola',
            'lname' => 'Toledana',
            'status' => 0,
        ];

        $userModel->insert($data);

        echo 'pasok';
    }
}
