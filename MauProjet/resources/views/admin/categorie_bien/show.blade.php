@extends('layouts.admin')

@section('title', 'Détails de la catégorie')

@section('content')
<div class="container mt-4">
    <h1>Détails de la catégorie</h1>

    <div class="card mt-3">
        <div class="card-body">
            <h5>Nom :</h5>
            <p>{{ $categorie->nom }}</p>

            <h5>Description :</h5>
            <p>{{ $categorie->description }}</p>
        </div>
    </div>

    <a href="{{ route('admin.categorie.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    <a href="{{ route('admin.categorie.edit', $categorie) }}" class="btn btn-warning mt-3">Modifier</a>
</div>
@endsection

