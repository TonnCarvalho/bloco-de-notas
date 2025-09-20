<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');

        $user = User::find($id)->get();
        $notes = User::find($id)->notes()->get();

        return view(
            'home.home',
            compact(
                'user',
                'notes'
            )
        );
    }

    public function novaNota()
    {
        echo 'novaNota';
    }
}
