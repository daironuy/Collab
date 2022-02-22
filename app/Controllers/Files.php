<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\UserModel;

class Files extends BaseController
{
    public function index(){
        return view('Files/index', [

        ]);
    }

    public function getOtherDepartments(){
        $otherDepartments = (New DepartmentModel())
            ->where('id!='.session()->get('auth')['department_id'])
            ->findAll()
        ;

        echo json_encode($otherDepartments);
        exit();
    }
}