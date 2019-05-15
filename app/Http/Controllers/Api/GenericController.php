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

    public function __destruct()
    {
            unset($this->model);
    }

    public function delete($id)
    {
        if($id == null || $id == ''){
            return response()->json(['type'=>'erro','msg'=>'ID vazio ou nulo']);
        }
        $this->model->find($id)->delete();
    }

    public function update(Request $request)
    {
        $this->authorize('api-proprio-perfil',$request->input('id'));

        $model = $this->model->find($request->input('id'));
        $model->update($request->except('id'));

        return $this->model->find($request->input('id'));             
    }

    public function find($id=null)
    {
        if($id == null || $id == ''){
            return response()->json(['type'=>'erro','msg'=>'ID vazio ou nulo']);
        }
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
