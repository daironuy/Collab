<?php

namespace App\Controllers;

use App\Models\DepartmentFilesModel;
use App\Models\DepartmentModel;
use App\Models\UserModel;

class DepartmentFiles extends BaseController
{
    public function index(){
        $departmentData = (New DepartmentModel())
            ->where('id', session()->get('auth')['department_id'])
            ->first()
        ;

        return view('DepartmentFiles/index', [
            'department' => $departmentData,
            'files' =>
                (New DepartmentFilesModel())
                    ->select('department_files.*')
                    ->select('users.first_name')
                    ->select('users.last_name')
                    ->select('CONCAT(ROUND(LENGTH(department_files.file_data)/1024, 1), \' KB\') AS file_size')
                    ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
                    ->join('departments', 'users.department_id=departments.id', 'left')
                    ->where('departments.id', $departmentData['id'])
                    ->where('upload_to_department_id', $departmentData['id'])
                    ->findAll()
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

        if((filesize($_FILES['file']['tmp_name'])/1024) > 16000){
            array_push($errors, 'File size is more than 16MB!');
        }

        if(count($errors)!=0){
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        $insertData = [
            'upload_by_user_id'=>session()->get('auth')['id'],
            'upload_to_department_id'=>session()->get('auth')['department_id'],
            'file_name'=>$_FILES['file']['name'],
            'file_type'=>$_FILES['file']['type'],
            'file_data'=>file_get_contents($_FILES['file']['tmp_name']),
        ];

        $departmentFilesModel = new DepartmentFilesModel();
        $departmentFilesModel->save($insertData);

        return redirect()->to('/departmentFiles');
    }

    public function download($id=0){
        $departmentFileData = (New DepartmentFilesModel())
            ->select('department_files.*')
            ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
            ->join('departments', 'users.department_id=departments.id', 'left')
            ->where('departments.id', session()->get('auth')['department_id'])
            ->where('department_files.id', $id)
            ->first()
        ;

        $errors = [];

        if (!$departmentFileData) {
            array_push($errors, 'You do not have file permission!');
        }

        if(count($errors)!=0){
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        header("Content-type: ".$departmentFileData['file_type']);
        header("Content-Disposition: attachment; filename=".$departmentFileData['file_name']);
        ob_clean();
        flush();
        echo $departmentFileData['file_data'];
    }

    public function delete($id=0){
        $departmentFileData = (New DepartmentFilesModel())
            ->select('department_files.*')
            ->join('users', 'users.id=department_files.upload_by_user_id', 'left')
            ->join('departments', 'users.department_id=departments.id', 'left')
            ->where('departments.id', session()->get('auth')['department_id'])
            ->where('department_files.id', $id)
            ->first()
        ;

        $errors = [];

        if (!$departmentFileData) {
            array_push($errors, 'You do not have file permission!');
        }

        if(count($errors)!=0){
            session()->setFlashdata('error', '<ul class="list-disc pl-5"><li>'.implode('</li><li>', $errors).'</li></ul>');
            return redirect()->to('/departmentFiles');
        }

        (New DepartmentFilesModel())
            ->where('id', $id)
            ->delete()
        ;

        session()->setFlashdata('success', 'Successfully deleted '.$departmentFileData['file_name'].'!');
        return redirect()->to('/departmentFiles');
    }
}