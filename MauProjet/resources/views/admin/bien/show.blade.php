@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Détails du Bien : {{ $bien->nom }}</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $bien->nom }}</h4>

            <p><strong>Description :</strong></p>
            <p>{{ $bien->description }}</p>

            <p><strong>Catégorie :</strong> {{ $bien->categorie->nom ?? 'Non défini' }}</p>


            <p><strong>Créé le :</strong> {{ $bien->created_at->format('d/m/Y à H:i') }}</p>
            <p><strong>Mis à jour le :</strong> {{ $bien->updated_at->format('d/m/Y à H:i') }}</p>

            <div class="mt-4">
                <a href="{{ route('admin.biens.edit', $bien) }}" class="btn btn-warning">Modifier</a>
                <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">Retour</a>
                <form action="{{ route('admins.bien.destroy', $bien) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce bien ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
