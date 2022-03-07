<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\PositionModel;
use App\Models\UserModel;

class Positions extends BaseController
{
    public function index(){

        return view('Positions/index', [
            'positions' => (New PositionModel())->findAll()
        ]);
    }

    public function new(){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/positions');
        }

        if($_REQUEST['name']==''){
            session()->setFlashdata('error', 'Position name is empty!');
            return redirect()->to('/positions');
        }

        $positionModel = new PositionModel();
        $positionData = $positionModel
            ->where('name', $_REQUEST['name'])
            ->findAll()
        ;

        if(count($positionData)!=0){
            session()->setFlashdata('error', 'Position already exist!');
            return redirect()->to('/positions');
        }

        $positionModel = new PositionModel();
        $positionModel->save($_REQUEST);

        return redirect()->to('/positions');
    }

    public function delete($positionId){
        if(!session()->get('auth')['is_admin']){
            session()->setFlashdata('error', 'You are not administrator!');
            return redirect()->to('/positions');
        }

        $positionModel = new PositionModel();
        $positionData = $positionModel->where('id', $positionId)->first();

        if(!$positionData){
            session()->setFlashdata('error', 'Unknown position!');
            return redirect()->to('/positions');
        }

        $positionModel = new PositionModel();
        $positionModel
            ->where('id', $positionId)
            ->delete()
        ;

        session()->setFlashdata('success', 'Successfully deleted '.$positionData['name'].'!');

        return redirect()->to('/positions');
    }
}