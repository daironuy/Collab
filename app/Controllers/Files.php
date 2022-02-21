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
}