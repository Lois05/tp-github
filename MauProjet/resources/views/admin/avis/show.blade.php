@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Détail de l'avis signalé</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Annonce :</strong> {{ $avis->annonce->localisation ?? 'Annonce supprimée' }}</p>
            <p><strong>Utilisateur :</strong> {{ $avis->user->nom ?? 'Utilisateur inconnu' }}</p>
            <p><strong>Note :</strong> {{ $avis->note }}/5</p>
            <p><strong>Commentaire :</strong> {{ $avis->commentaire }}</p>
            <p><strong>Raison du signalement :</strong> {{ $avis->raison_signalement ?? 'Non spécifiée' }}</p>
            <p><strong>Date :</strong> {{ $avis->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <form action="{{ route('admin.avis.destroy', $avis) }}" method="POST" onsubmit="return confirm('Supprimer cet avis ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Supprimer</button>
            <a href="{{ route('admin.avis.index') }}" class="btn btn-secondary ms-2">Retour</a>
        </form>
    </div>
</div>
@endsection
