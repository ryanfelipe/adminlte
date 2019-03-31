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

    public function alterarpermissao(User $user, Request $request)
    {
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
