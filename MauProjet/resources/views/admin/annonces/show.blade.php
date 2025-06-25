@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1>Détails de l'annonce</h1>

    <div class="card mt-4">
        <div class="card-body">
            <h3 class="card-title">Titre : {{ 'Titre de l’annonce' }}</h3>
            <p class="card-text"><strong>Description :</strong> {{ 'Description complète de l’annonce ici' }}</p>
            <p class="card-text"><strong>Prix :</strong> {{ '10000' }} FCFA</p>

            <a href="{{ route('admin.annonces.edit', ['id' => 1]) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
