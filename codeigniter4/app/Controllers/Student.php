<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\careerModel;

class Student extends BaseController
{
    // show students list
    public function index(){
        // $studentModel = new StudentModel();
        $data['pageTitle'] = 'Students Page';
        $data['showLogo'] = true;
        $studentModel = model(StudentModel::class);
        $data['students'] = $studentModel->findAll();

        $careerModel = model(CareerModel::class);
        $data['careers'] = $careerModel->findAll();

        $content = view('students/index', $data);
        return parent::renderTemplate($content, $data);
    }
    // add student form
    public function create(){
        $data['pageTitle'] = 'New Student';
        $data['actionTitle'] = 'Create Student';

        $careerModel = model(CareerModel::class);
        $data['careers'] = $careerModel->findAll();

        $content = view('students/form', $data);
        return parent::renderTemplate($content, $data);
    }

    public function edit($id){

        $careerModel = model(CareerModel::class);
        $data['careers'] = $careerModel->findAll();

        $studentModel = model(StudentModel::class);
        $data['student'] = $studentModel->where('id', $id)->first();
        $data['pageTitle'] = 'Students Page';
        $data['actionTitle'] = 'Edit Student';
        $content = view('students/form',$data);
        return parent::renderTemplate($content, $data);
    }

    // insert/update data
    public function save() {
        $studentModel = model(StudentModel::class);
        $id = $this->request->getVar('id');

        

        $data = [
            'name' => $this->request->getVar('name'),
            'last_name'  => $this->request->getVar('last_name'),
            'address'  => $this->request->getVar('address'),
            'id_career'  => $this->request->getVar('id_career'),
        ];
        if ($id) {
            $studentModel->update($id, $data);
        } else {
            $studentModel->insert($data);
        }
        return $this->response->redirect(site_url('/students'));

    }

    // // delete student
    public function delete($id = null){
        $studentModel = model(StudentModel::class);
        $studentModel->where('id', $id)->delete();

        return $this->response->redirect(site_url('/students'));
    }
}
