<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;

class Messages extends BaseController
{
    public function index()
    {
        return view('Messages/index');
    }

    public function getOtherDepartments()
    {
        $otherDepartments =
            (new DepartmentModel())
                ->where('id!=' . session()->get('auth')['department_id'])
                ->findAll();

        echo json_encode($otherDepartments);
        exit();
    }
}
