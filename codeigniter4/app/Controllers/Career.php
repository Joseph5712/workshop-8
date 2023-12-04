<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CareerModel;


class Career extends BaseController
{
    // show students list
    public function index(){
        // $studentModel = new StudentModel();
        $data['pageTitle'] = 'Careers Page';
        $data['showLogo'] = true;
        $careerModel= model(careerModel::class);
        $data['careers'] = $careerModel->findAll();

        $content = view('careers/index', $data);
        return parent::renderTemplate($content, $data);
    }
    // add student form
    public function create(){
        $data['pageTitle'] = 'New Career';
        $data['actionTitle'] = 'Create Career';
        $content = view('Careers/form', $data);
        return parent::renderTemplate($content, $data);
    }

    public function edit($id){
        $careerModel = model(CareerModel::class);
        $data['career'] = $careerModel->where('id', $id)->first();
        $data['pageTitle'] = 'Career Page';
        $data['actionTitle'] = 'Edit Career';
        $content = view('Careers/form',$data);
        return parent::renderTemplate($content, $data);
    }

    // insert/update data
    public function save() {
        $careerModel = model(CareerModel::class);
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
        ];
        if ($id) {
            $careerModel->update($id, $data);
        } else {
            $careerModel->insert($data);
        }
        return $this->response->redirect(site_url('/careers'));
    }

    // // delete student
    public function delete($id = null){
        $careerModel = model(CareerModel::class);
        $careerModel->where('id', $id)->delete();

        return $this->response->redirect(site_url('/careers'));
    }
}
