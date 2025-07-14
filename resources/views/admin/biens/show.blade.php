@extends('layouts.admin')

@section('title', 'Détail du Bien')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Détail du Bien</h1>

    <div class="card">
        <div class="card-header">
            <strong>{{ $bien->nom }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Description :</strong></p>
            <p>{{ $bien->description }}</p>

            <p><strong>Catégorie :</strong> {{ $bien->categorie->nom ?? 'Non défini' }}</p>

            <p><strong>État :</strong>
                <span class="badge bg-{{ $bien->etat === 'loué' ? 'danger' : 'success' }}">
                    {{ ucfirst($bien->etat) }}
                </span>
            </p>

            <p><strong>Date de création :</strong> {{ $bien->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Dernière mise à jour :</strong> {{ $bien->updated_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.biens.edit', $bien) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit"></i> Modifier
            </a>
            <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection
