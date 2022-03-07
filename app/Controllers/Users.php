<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\LoginSecurityKeyModel;
use App\Models\PositionModel;
use App\Models\UserModel;

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
        $userModel = new UserModel();

        return view('Users/index', [
            'users' => $userModel->findAll()
        ]);
    }

    public function activate($newValue, $userId){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/users');
        }

        $userModel = new UserModel();
        $userData = $userModel->where('id', $userId)->first();

        if(!$userData){
            session()->setFlashdata('error', 'Unknown user!');
            return redirect()->to('/users');
        }

        $userModel = new UserModel();
        $userModel
            ->set('is_active', $newValue)
            ->where('id', $userId)
            ->update()
        ;

        session()->setFlashdata('success', 'Successfully '.($newValue?'activated': 'deactivated').' '.$userData['email'].'!');

        return redirect()->to('/users');
    }

    public function delete($userId){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/users');
        }

        $userModel = new UserModel();
        $userData = $userModel->where('id', $userId)->first();

        if(!$userData){
            session()->setFlashdata('error', 'Unknown user!');
            return redirect()->to('/users');
        }

        $userModel = new UserModel();
        $userModel
            ->where('id', $userId)
            ->delete()
        ;

        session()->setFlashdata('success', 'Successfully deleted '.$userData['email'].'!');

        return redirect()->to('/users');
    }

    public function login()
    {
        if(session()->get('auth')){
            return redirect()->to('/');
        }

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
            ->where('created_at <= date_add(NOW(), INTERVAL -30 MINUTE)')
            ->delete()
        ;

        $loginSecurityKeyData = $loginSecurityKeyModel
            ->where('user_id', $userData['id'])
            ->where('ip', getIP())
            ->first()
        ;

        if(!$loginSecurityKeyData){
            $loginSecurityKeyString = getRandomString();
            $loginSecurityKeyData = [
                'user_id'=>$userData['id'],
                'ip'=>getIP(),
                'key'=>$loginSecurityKeyString,
                'is_verified'=>false,
            ];

            $loginSecurityKeyModel->save($loginSecurityKeyData);
            $loginSecurityKeyData['id'] = $loginSecurityKeyModel->getInsertID();
            sendMail(
                $userData['email'],
                'Verify your login',
                'Your verification key is '.$loginSecurityKeyString
            );
        }

        $userData['department'] = (new DepartmentModel())
            ->where('id', $userData['department_id'])
            ->first()
        ;

        $session->set([
            'auth'=>$userData,
            'loginSecurityKey'=>$loginSecurityKeyData
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
        if(session()->get('auth')){
            return redirect()->to('/');
        }

        if (count($_POST) == 0) {
            echo view('users/register', [
                'departments' => (New DepartmentModel())->findAll(),
                'positions'=>(new PositionModel())->findAll()
            ]);
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
        if($this->request->getVar('confirm_password')!=$this->request->getVar('password')){
            array_push($errors, 'Password and Confirm Password do not match!');
        }

        if(count($errors)==0){
            $userModel = new UserModel();
            $userData = $userModel->where('email', $this->request->getVar('email'))->findAll();
            if(count($userData)!=0){
                array_push($errors, 'Email already exsist!');
            }
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
            'department_id' => $this->request->getVar('department_id'),
            'position_id' => $this->request->getVar('position_id'),
            'is_admin' => false,
            'is_active' => false,
        ];
        $model->save($data);
        return redirect()->to('/users/login');
    }

    public function verify(){
        if (!session()->get('auth')) {
            return redirect()->to('/users/login');
        }



        if(session()->get('loginSecurityKey')['is_verified']) {
            return redirect()->to('/');
        }

        if (count($_POST) == 0) {
            echo view('users/verify');
            return 0;
        }

        $errors = [];

        if($this->request->getVar('security_key')==''){
            array_push($errors, 'Security key should not be empty!');
        }

        $loginSecurityKey = session()->get('loginSecurityKey');
        if($this->request->getVar('security_key')!=$loginSecurityKey['key']){
            array_push($errors, 'Wrong security key! Please check your email.');
        }

        if(count($errors)!=0){
            session()->setFlashdata('form', $_REQUEST);
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');

            return redirect()->to('/users/verify');
        }

        $loginSecurityKey['is_verified'] = true;

        $loginSecurityKeyModel = new LoginSecurityKeyModel();
        $loginSecurityKeyModel
            ->update($loginSecurityKey['id'], $loginSecurityKey)
        ;

        session()->set('loginSecurityKey', $loginSecurityKey);

        return redirect()->to('/');
    }

    public function test(){
        return view('Users/index');
    }
}
