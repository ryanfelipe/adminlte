<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminUsuariosController extends Controller
{
    public function index(User $user)
    {
            return view('admin.usuarios',[
                'users'=>$user->paginate(1)
            ]);
    }

    public function alterarpermissao(User $user)
    {
        return view('admin.usuarios',[
            'users'=>$user->paginate(1)
        ])->withErrors([
            "Erro aqui"
        ]);
    }
}
