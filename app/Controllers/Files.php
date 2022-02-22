<?php

namespace App\Controllers;

use App\Models\DepartmentFilesModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class Files extends BaseController
{
    public function index()
    {
        return view('Files/index', [

        ]);
    }

    public function getOtherDepartments()
    {
        $otherDepartments = (new DepartmentModel())
            ->where('id=' . session()->get('auth')['department_id'])
            ->findAll();

        $otherDepartments =
            array_merge(
                $otherDepartments,
                (new DepartmentModel())
                    ->where('id!=' . session()->get('auth')['department_id'])
                    ->findAll()
            );

        echo json_encode($otherDepartments);
        exit();
    }

    public function upload()
    {
        if (count($_FILES) == 0) {
            return redirect()->to('/departmentFiles');
        }

        $errors = [];

        if (!isset($_POST['upload_to_department_id'])) {
            array_push($errors, 'Unknown department!');
        }

        if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
            array_push($errors, 'File is not from POST!');
        }

        if ((filesize($_FILES['file']['tmp_name']) / 1024) > 16000) {
            array_push($errors, 'File size is more than 16MB!');
        }

        if (count($errors) != 0) {
            echo json_encode([
                'success' => -1,
                'message' => '<ul class="list-disc pl-5"><li>' . implode('</li><li>', $errors) . '</li></ul>',
                'data' => []
            ]);

            exit();
        }

        $insertData = [
            'upload_by_user_id' => session()->get('auth')['id'],
            'upload_to_department_id' => $_POST['upload_to_department_id'],
            'file_name' => $_FILES['file']['name'],
            'file_type' => $_FILES['file']['type'],
            'file_data' => file_get_contents($_FILES['file']['tmp_name']),
        ];

        $departmentFilesModel = new DepartmentFilesModel();
        $departmentFilesModel->save($insertData);

        echo json_encode([
            'success' => 0,
            'message' => '',
            'data' => []
        ]);
        exit();
    }

    public function getFiles($departmentId)
    {
        $output = (new DepartmentFilesModel())
            ->select('department_files.id, department_files.file_name, department_files.file_type, department_files.created_at')
            ->select('uploader.first_name, uploader.last_name')
            ->select('uploader_department.name as uploader_department_name')
            ->select('CONCAT(ROUND(LENGTH(department_files.file_data)/1024, 1), \' KB\') AS file_size')
            ->join('users as uploader', 'uploader.id=department_files.upload_by_user_id', 'left')
            ->join('departments as uploader_department ', 'uploader_department.id=uploader.department_id', 'left')
            ->where('uploader_department.id!=department_files.upload_to_department_id')
            ->where('department_files.upload_to_department_id', $departmentId)
        ;

        if($departmentId==session()->get('auth')['department_id']){
            $output = $output
                ->where('uploader_department.id!='. session()->get('auth')['department_id'])
                ->findAll();
        }
        else {
            $output = $output
                ->where('uploader_department.id', session()->get('auth')['department_id'])
                ->findAll();
        }

        echo json_encode($output);
        exit();
    }

    public function test()
    {
        pr($_REQUEST);
        pr($_FILES);
        exit();
    }
}