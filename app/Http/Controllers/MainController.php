<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\OperationsServices;
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
        return view('note.novaNota');
    }
    public function novaNotaSubmit(Request $request)
    {
        //validação
        $request->validate(
            [
                'text_title' => 'required|string|max:200',
                'text_note' => 'required|string|max:3000'
            ],
            [
                'required' => 'Campo obrigatório'
            ]
        );
        //pogar use id
        $id = session('user.id');
        //criar nota
        Note::create([
            'user_id' => $id,
            'title' => $request->text_title,
            'text' => $request->text_note
        ]);

        return redirect()->route('home');
    }
    public function editaNota(string $id)
    {
        $id = OperationsServices::descryptId($id);
    }
    public function deletaNota(string $id)
    {
        $id = OperationsServices::descryptId($id);
    }
}
