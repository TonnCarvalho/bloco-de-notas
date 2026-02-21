@extends('layout.layout')
@include('layout.top_bar')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <!-- form -->
                <div class="row justify-content-center">
                    <div class="col-md-10 col-12">
                        <form action="{{ route('novaNotaSubmit') }}" method="post" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="text_title" class="form-label">
                                    Note Title
                                    @error('text_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" id="text_title" class="form-control bg-secondary text-white"
                                    name="text_title" value="{{old('text_title')}}" required>
                                {{-- show error --}}
                            </div>
                            <div class="mb-3">
                                <label for="text_note" class="form-label">
                                    Note Text
                                    @error('text_note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <textarea name="text_note" id="text_note" cols="20" rows="5" required
                                    class="form-control bg-secondary text-white">{{old('text_note')}}</textarea>
                                {{-- show error --}}
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-secondary w-100">Save</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary w-100">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
