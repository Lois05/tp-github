@extends('layouts.client')

@section('title', $annonce->titre)

@section('content')
<header class="hero text-center py-5 bg-light">
    <div class="container">
        <h1 class="display-5 fw-bold">Louez tout ce dont vous avez besoin</h1>
        <p class="lead">LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
        <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3 px-4 py-2">Voir les annonces</a>
    </div>
</header>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <!-- Image de l'annonce -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/' . ($annonce->image ?? 'default.jpg')) }}"
                 alt="{{ $annonce->titre }}"
                 class="img-fluid rounded shadow w-100"
                 style="max-height: 400px; object-fit: cover;">
        </div>

        <!-- Détails de l'annonce -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $annonce->titre }}</h2>

            <ul class="list-unstyled text-muted mb-4">
                <li><strong>Catégorie :</strong> {{ optional($annonce->bien?->categorie)->libelle ?? 'Non spécifiée' }}</li>
                <li><strong>Localisation :</strong> {{ $annonce->bien->localisation ?? 'Non spécifiée' }}</li>
                <li><strong>État du bien :</strong> {{ ucfirst($annonce->bien->etat ?? 'Inconnu') }}</li>
                <li><strong>Statut de l’annonce :</strong> {{ ucfirst($annonce->statut ?? 'Non précisé') }}</li>
                <li><strong>Propriétaire :</strong> {{ $annonce->user->name ?? 'Inconnu' }}</li>
            </ul>

            <p class="h4 text-success fw-bold mb-4">
                {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
            </p>

            <p class="lead">{{ $annonce->description }}</p>

            <a href="{{ route('locataire.demande.create', $annonce->id) }}"
               class="btn btn-primary btn-lg mt-3 rounded-pill px-4 py-2 w-100 w-md-auto text-center">
               Louer maintenant
            </a>
        </div>
    </div>
</div>
@endsection
