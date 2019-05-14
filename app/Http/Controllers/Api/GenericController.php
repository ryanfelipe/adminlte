<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function update(Request $request)
    {
        
        $model = $this->model->find($request->input('id'));
        return $model->update($request->all());
                    
    }

    public function find($id=null)
    {
         return $this->model->find($id);
          
    }

    public function read()
    {
        return $this->model->all();
    }

    public function create(Request $request)
    {
        return  $this->model->create($request->all());
    }
}
