@extends('layouts.app')

@section('content')
    <h1>Publier une annonce</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaire.annonces.store') }}" method="POST">
        @csrf
        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" value="{{ old('titre') }}">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="bien_id">Bien</label>
            <select name="bien_id">
                {{-- Remplace ça par tes vrais biens --}}
                <option value="1">Bien 1</option>
                <option value="2">Bien 2</option>
            </select>
        </div>

        <button type="submit">Publier</button>
    </form>
@endsection
