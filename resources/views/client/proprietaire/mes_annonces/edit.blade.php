@extends('layouts.app')

@section('content')
    <h1>Modifier l'annonce</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaire.annonces.update', $annonce) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Titre</label><br>
        <input type="text" name="titre" value="{{ old('titre', $annonce->titre) }}"><br><br>

        <label>Description</label><br>
        <textarea name="description">{{ old('description', $annonce->description) }}</textarea><br><br>

        <label>Bien</label><br>
        <input type="text" name="bien_id" value="{{ old('bien_id', $annonce->bien_id) }}"><br><br>

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('proprietaire.annonces.index') }}">Retour</a>
@endsection
