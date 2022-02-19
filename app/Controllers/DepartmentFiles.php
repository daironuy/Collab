<?php

namespace App\Controllers;

use App\Models\DepartmentFilesModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class DepartmentFiles extends BaseController
{
    public function index(){
        return view('DepartmentFiles/index', [
            'department' =>
                (New DepartmentModel())
                    ->where('id', session()->get('auth')['department_id'])
                    ->first()
        ]);
    }

    public function upload(){
        if(count($_FILES)==0){
            return redirect()->to('/departmentFiles');
        }

        $errors = [];

        if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
            array_push($errors, 'File is not from POST!');
        }

        if(count($errors)!=0){
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        $insertData = [
            'upload_by_user_id'=>session()->get('auth')['id'],
            'file_name'=>$_FILES['file']['name'],
            'file_type'=>$_FILES['file']['type'],
            'file_data'=>addslashes(file_get_contents($_FILES['file']['tmp_name'])),
        ];

        $departmentFilesModel = new DepartmentFilesModel();
        $departmentFilesModel->save($insertData);

        return redirect()->to('/departmentFiles');
    }
}