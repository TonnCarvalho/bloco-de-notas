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
        $notes = User::find($id)
            ->notes()
            ->whereNull('deleted_at')
            ->get();

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

        $note = Note::find($id);
        return view('note.editaNota', compact(
            [
                'id',
                'note'
            ]
        ));
    }
    public function editaNotaSubmit(Request $request)
    {
        $request->validate(
            [
                'text_title' => 'required|string|max:200',
                'text_note' => 'required|string|max:3000'
            ],
            [
                'required' => 'Campo obrigatório'
            ]
        );
        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        $id = OperationsServices::descryptId($request->note_id);
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }
    public function deletaNota(string $id)
    {
        $id = OperationsServices::descryptId($id);

        $note = Note::find($id);
        return view('note.deletaNota', compact(
            'note'
        ));
    }

    public function deletaNotaConfirm(string $id)
    {
        $id = OperationsServices::descryptId($id);

        $note = Note::find($id);

        //1. hard delete
        // $note->delete(); 

        //2. soft delete
        // $note->deleted_at = date('Y:m:d H:i:s');
        // $note->save();

        //3. soft delete (propriedade SofetDeleteles no Model)
        // $note->delete();

        //4. hard delete (propriedade SofetDeleteles no Model)
        $note->forceDelete();
        
        return redirect()->route('home');
    }
}
