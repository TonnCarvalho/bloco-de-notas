<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
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
        //dados input
        $username = $request->input('text_username');
        $password = $request->input('text_password');


        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        //chegar se os dados existe
        if (!$user OR !password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Usuário ou senha incorreto');
        }

        //update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login usuário
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->name
            ]
        ]);
        
        return redirect()->to('/');
    }
        public function logout()
    {
        session()->forget('user');

        return redirect()->to('/login');
    }
}
