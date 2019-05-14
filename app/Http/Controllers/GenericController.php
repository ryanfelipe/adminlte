<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericController extends Controller
{

    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function delete($id)
    {
        if($id == null || $id == ''){
            return redirect()->back();
        }
        $this->model->find($id)->delete();
    }

    public function update($id, $data)
    {
        if($id == null || $id == ''){
            return redirect()->back();
        }
        $model = $this->model->find($id);
        return $model->update($data);
                    
    }

    public function find($id=null)
    {
           if($id == null || $id == ''){
                return redirect()->back();
           } 
           return $this->model->find($id);
    }

    public function read()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return  $this->model->create($data);
    }
}
