@extends('layouts.client')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📄 Détails de votre annonce</h4>
            <span class="badge bg-light text-dark">{{ ucfirst($annonce->statut) }}</span>
        </div>
        <div class="card-body">
            <h2 class="text-primary mb-4">{{ $annonce->titre }}</h2>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <p><strong>💰 Prix :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>
                    <p>
                        <strong>🏷️ Catégorie :</strong> 
                        {{ $annonce->bien && $annonce->bien->categorie ? $annonce->bien->categorie->nom : 'Non précisé' }}
                    </p>
                    <p><strong>📍 Localisation :</strong> {{ $annonce->localisation ?? 'Non précisée' }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>🔖 État du bien :</strong> {{ $annonce->bien->etat ?? 'Non précisé' }}</p>
                    <p><strong>📝 Description :</strong><br> {{ $annonce->description }}</p>
                </div>
            </div>

            @if ($annonce->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image de l'annonce" class="img-fluid rounded">
    </div>
@endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('proprietaire.annonces.index') }}" class="btn btn-outline-primary">⬅️ Retour à mes annonces</a>
        </div>
    </div>
</div>
@endsection
