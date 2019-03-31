<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    function validar(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
    
    }

    public function salvar(SettingsRequest $request)
    {     
        
        try{
            $user = User::find(auth()->user()->id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect('admin/settings')
                        ->withSuccess('Perfil atualizado com sucesso');
        }catch(\Exception $e){
                return redirect('admin/settings')->withErrors([
                    'Exception'=>$e->getMessage(),
                    'File'=>$e->getFile(),
                    'Line'=>$e->getLine()
                ]);
        }

    }
}
