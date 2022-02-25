<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\MessageModel;

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

    public function add()
    {
        (new MessageModel())
            ->save([
                'user_id' => session()->get('auth')['id'],
                'department_id' => $_POST['department_id'],
                'message' => $_POST['message'],
            ]);
    }

    public function getMessage($departmentId = 0)
    {
        $currentDepartmentId = session()->get('auth')['department_id'];

        echo json_encode([
            'success' => 0,
            'message' => '',
            'data' => (new MessageModel())
                ->select('messages.*,'.
                    'users.department_id as user_department_id,'.
                    'users.first_name,'.
                    'users.last_name'
                )
                ->join('users', 'messages.user_id=users.id')
                ->where('('.
                    '   users.department_id=' .$currentDepartmentId. ' AND messages.department_id='.$departmentId.''.
                    ') OR ('.
                    '   users.department_id=' .$departmentId. ' AND messages.department_id='.$currentDepartmentId.''.
                    ')'
                )
                ->findAll()
        ]);
        exit();
    }
}
