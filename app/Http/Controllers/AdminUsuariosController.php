<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminUsuariosController extends Controller
{
    public function index(User $user)
    {
            return view('admin.usuarios',[
                'users'=>$user->paginate(10)
            ]);
    }
    function validarPermissao($permission)
    {
           if(!in_array($permission,config('permissions'))){
                return [
                    'Perfil'=>'Perfil não pertence à lista'
                ];
            }

            return [];

    }

    public function alterarpermissao(User $user, Request $request)
    {
        $p = $this->validarPermissao($request->input('permission'));
        if(!empty($p)){
               return redirect()->back()->withErrors($p); 
        }
        try{

            $user = $user->find($request->input('id'));
            $user->permission = $request->input('permission');
            $user->save();
            return redirect('admin/usuarios')
                    ->withSuccess('Permissão alterada com sucesso!');


        }catch(\Exception $e){
            return redirect('admin/usuarios')->withErrors([
                "Exception"=>$e->getMessage(),
                "File"=>$e->getFile(),
                "Line"=>$e->getLine()
                ]);    
        }
    }
}
