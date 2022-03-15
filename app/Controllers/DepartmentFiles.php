<?php

namespace App\Controllers;

use App\Models\DepartmentFilesModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class DepartmentFiles extends BaseController
{
    public function index()
    {
        $departmentData = (new DepartmentModel())
            ->where('id', session()->get('auth')['department_id'])
            ->first();

        $files = (new DepartmentFilesModel())
            ->select('department_files.*')
            ->select('users.first_name')
            ->select('users.last_name')
            ->select('positions.name as position_name')
            ->select('CONCAT(ROUND(LENGTH(department_files.file_data)/1024, 1), \' KB\') AS file_size')
            ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
            ->join('departments', 'users.department_id=departments.id', 'left')
            ->join('positions', 'users.position_id=positions.id', 'left')
            ->where('departments.id', $departmentData['id'])
            ->where('upload_to_department_id', $departmentData['id'])
            ->findAll()
        ;

        foreach($files as &$file) {
            $file['file_name'] = decrypt($file['file_name']);
        }

        return view('DepartmentFiles/index', [
            'department' => $departmentData,
            'files' => $files
        ]);
    }

    public function upload()
    {
        if (count($_FILES) == 0) {
            return redirect()->to('/departmentFiles');
        }

        $errors = [];

        if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
            array_push($errors, 'File is not from POST!');
        }

        if ((filesize($_FILES['file']['tmp_name']) / 1024) > 16000) {
            array_push($errors, 'File size is more than 16MB!');
        }

        if (count($errors) != 0) {
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>' . implode('</li><li>', $errors) . '</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        $insertData = [
            'upload_by_user_id' => session()->get('auth')['id'],
            'upload_to_department_id' => session()->get('auth')['department_id'],
            'file_name' => encrypt($_FILES['file']['name']),
            'file_type' => encrypt($_FILES['file']['type']),
            'file_data' => encrypt(file_get_contents($_FILES['file']['tmp_name'])),
        ];

        $departmentFilesModel = new DepartmentFilesModel();
        $departmentFilesModel->save($insertData);

        return redirect()->to('/departmentFiles');
    }

    public function download($id = 0)
    {
        $departmentFileData = (new DepartmentFilesModel())
            ->select('department_files.*')
            ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
            ->join('departments', 'users.department_id=departments.id', 'left')
            ->where('departments.id', session()->get('auth')['department_id'])
            ->where('department_files.id', $id)
            ->first();

        $errors = [];

        if (!$departmentFileData) {
            array_push($errors, 'You do not have file permission!');
        }

        if (count($errors) != 0) {
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>' . implode('</li><li>', $errors) . '</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        header("Content-type: " . decrypt($departmentFileData['file_type']));
        header("Content-Disposition: attachment; filename=" . decrypt($departmentFileData['file_name']));
        ob_clean();
        flush();
        echo decrypt($departmentFileData['file_data']);
        exit();
    }

    public function delete($id = 0)
    {
        $departmentFileData = (new DepartmentFilesModel())
            ->select('department_files.*')
            ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
            ->join('departments', 'users.department_id=departments.id', 'left')
            ->where('departments.id', session()->get('auth')['department_id'])
            ->where('department_files.id', $id)
            ->first();

        $errors = [];

        if (!$departmentFileData) {
            array_push($errors, 'You do not have file permission!');
        }

        if (count($errors) != 0) {
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>' . implode('</li><li>', $errors) . '</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        (new DepartmentFilesModel())
            ->where('id', $id)
            ->delete();

        session()->setFlashdata('success', 'Successfully deleted ' . $departmentFileData['file_name'] . '!');
        return redirect()->to('/departmentFiles');
    }
}