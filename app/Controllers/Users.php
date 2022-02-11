<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginSecurityKeyModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Users extends BaseController
{
    public function __construct()
    {
//        $action = str_replace('/users/', '', current_url(true)->getPath());
//
//        if(in_array($action, ['login', 'register'])){
//            $session = session();
//            if($session->get('id')!=''){
//                echo 'pasok';
//                return redirect()->to('/');
//            }
//        }
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

        $errors = [];

        if($this->request->getVar('email')==''){
            array_push($errors, 'Email should not be empty!');
        }
        if($this->request->getVar('password')==''){
            array_push($errors, 'Password should not be empty!');
        }

        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userData = [];

        if(count($errors)==0){
            $userData = $userModel->where('email', $email)->first();

            if(!$userData){
                array_push($errors, 'Account does not exsist!');
            }
            else if(!password_verify($password, $userData['password'])){
                array_push($errors, 'Wrong Password!');
            } else if($userData['is_active']==0){
                array_push($errors, 'Please wait for admin to verify your account!');
            }
        }

        if(count($errors)!=0){
            $session->setFlashdata('form', $_REQUEST);
            $session->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');

            return redirect()->to('/users/login');
        }

        $loginSecurityKeyModel = new LoginSecurityKeyModel();

        $loginSecurityKeyModel
            ->where('user_id', $userData['id'])
            ->where('ip', getIP())
            ->delete()
        ;

        $loginSecurityKeyString = getRandomString();

        $loginSecurityKeyModel->save([
            'user_id'=>$userData['id'],
            'ip'=>getIP(),
            'key'=>$loginSecurityKeyString,
            'is_verified'=>false,
        ]);

        sendMail(
            $userData['email'],
            'Verify your login',
            'Your verification key is '.$loginSecurityKeyString
        );

        $session->set([
            'auth'=>$userData,
        ]);
        return redirect()->to('/');
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

        $errors = [];

        if($this->request->getVar('email')==''){
            array_push($errors, 'Email should not be empty!');
        }
        if($this->request->getVar('password')==''){
            array_push($errors, 'Password should not be empty!');
        }
        if($this->request->getVar('first_name')==''){
            array_push($errors, 'First name should not be empty!');
        }
        if($this->request->getVar('middle_name')==''){
            array_push($errors, 'Middle name should not be empty!');
        }
        if($this->request->getVar('last_name')==''){
            array_push($errors, 'Last name should not be empty!');
        }
        if($this->request->getVar('confirm_passowrd')!=$this->request->getVar('passowrd')){
            array_push($errors, 'Password do not match should not be empty!');
        }

        if(count($errors)!=0){
            $session = session();
            $session->setFlashdata('form', $_REQUEST);
            $session->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');

            return redirect()->to('/users/register');
        }


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
    }
}
