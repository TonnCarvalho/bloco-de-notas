<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        echo "logout";
    }
    public function submit(Request $request)
    {
        //form validação
        $request->validate(
            //regras
            [
                'text_username' => 'required|string|min:3',
                'text_password' => 'required'
            ],
           //error messagem personalidade
            [
                'required' => 'Campo requerido.',
                'min' => 'Campo deve ter no minimo :min caracteres'
            ]
        );
    }
}
