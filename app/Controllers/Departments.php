<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\UserModel;

class Departments extends BaseController
{
    public function index(){

        return view('Departments/index', [
            'departments' => (New DepartmentModel())->findAll()
        ]);
    }

    public function new(){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/departments');
        }

        if($_REQUEST['name']==''){
            session()->setFlashdata('error', 'Department name is empty!');
            return redirect()->to('/departments');
        }

        $departmentModel = new DepartmentModel();
        $departmentData = $departmentModel
            ->where('name', $_REQUEST['name'])
            ->findAll()
        ;

        if(count($departmentData)!=0){
            session()->setFlashdata('error', 'Department already exist!');
            return redirect()->to('/departments');
        }

        $departmentModel = new DepartmentModel();
        $departmentModel->save($_REQUEST);

        return redirect()->to('/departments');
    }

    public function delete($departmentId){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/departments');
        }

        $departmentModel = new DepartmentModel();
        $departmentData = $departmentModel->where('id', $departmentId)->first();

        if(!$departmentData){
            session()->setFlashdata('error', 'Unknown department!');
            return redirect()->to('/departments');
        }

        $departmentModel = new DepartmentModel();
        $departmentModel
            ->where('id', $departmentId)
            ->delete()
        ;

        session()->setFlashdata('success', 'Successfully deleted '.$departmentData['name'].'!');

        return redirect()->to('/departments');
    }
}