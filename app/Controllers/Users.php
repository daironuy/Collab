<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Users extends BaseController
{
    public function __construct()
    {
        $action = str_replace('/users/', '', current_url(true)->getPath());

        if(in_array($action, ['login', 'register'])){
            $session = session();
            $this->pr($session->get('id'));
            if($session->get('id')!=''){
                echo 'pasok';
                return redirect()->to('/');
            }
        }
    }

    public function index()
    {

    }

    public function login()
    {
        helper(['form']);

        if (count($_POST) == 0) {
            echo view('users/login');
            return 0;
        }

        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $data['logged_in'] = TRUE;
                $session->set($data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/users/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/users/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/users/login');
    }

    public function register()
    {
        helper(['form']);

        if (count($_POST) == 0) {
            $data = [];
            echo view('users/register', $data);
            return 0;
        }

        $rules = [
            'email' => 'required|min_length[3]|max_length[50]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[200]',
            'confpassword' => 'matches[password]',
            'first_name' => 'required|min_length[3]|max_length[20]',
            'middle_name' => 'required|min_length[3]|max_length[20]',
            'last_name' => 'required|min_length[3]|max_length[20]',
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'first_name' => $this->request->getVar('first_name'),
                'middle_name' => $this->request->getVar('middle_name'),
                'last_name' => $this->request->getVar('last_name'),
                'is_admin' => false,
                'is_active' => false,
            ];
            $model->save($data);
            return redirect()->to('/users/login');
        } else {
            $data['validation'] = $this->validator;
            echo view('/users/register', $data);
        }
    }
}
