@extends('layout.layout')
@include('layout.top_bar')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card">
                <div class="text-center">
                    <div class="card-body">
                        <h2 class="text-info">{{ $note->title }}</h2>
                        <p>Você deseja deletar está nota?</p>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 w-100">
                    <!-- form -->
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">

                            <div class="d-flex gap-2">
                                <a href="{{ route('deletaNotaConfirm', Crypt::encrypt($note->id)) }}"
                                    class="btn btn-danger w-100">Deleta</a>
                                <a href="{{ route('home') }}" class="btn btn-secondary w-100">Volta</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
