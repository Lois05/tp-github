@extends('layouts.client')

@section('title', $annonce->titre)

@section('content')
    <!-- HERO identique à la page d'accueil -->
    <header class="hero text-center py-5">
        <div class="container">
            <h1 class="display-5 fw-bold">{{ $annonce->titre }}</h1>
            <p class="lead">LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
            <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3 px-4 py-2">Retour aux annonces</a>
        </div>
    </header>

    <section class="container py-5">
        <div class="row g-5 align-items-center">
            <!-- Image -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('storage/' . ($annonce->image ?? 'default.jpg')) }}"
                    alt="{{ $annonce->titre }}"
                    class="img-fluid rounded shadow w-100"
                    style="max-height: 450px; object-fit: cover;">
            </div>

            <!-- Détails -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $annonce->titre }}</h2>

                <!-- Prix -->
                <p class="price h4 mb-2">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>

                <!-- Étoiles -->
                <div class="stars mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                </div>

                <ul class="list-unstyled text-muted mb-4">
                    <li><strong>Catégorie :</strong> {{ $annonce->bien->categorie->nom ?? 'Non spécifiée' }}</li>
                    <li><strong>Localisation :</strong> {{ $annonce->localisation ?? 'Non spécifiée' }}</li>
                    <li><strong>État du bien :</strong> {{ ucfirst($annonce->bien->etat ?? 'Inconnu') }}</li>

                    <!-- Retiré la vérification isAdmin -->
                    {{-- <li><strong>Statut :</strong> {{ ucfirst($annonce->statut ?? 'Non précisé') }}</li> --}}

                    <li><strong>Propriétaire :</strong>
                        {{ $annonce->bien->proprietaire && $annonce->bien->proprietaire->user
                            ? $annonce->bien->proprietaire->user->prenom . ' ' . $annonce->bien->proprietaire->user->nom
                            : 'Inconnu' }}
                    </li>
                </ul>

                <!-- Description -->
                <p>{{ $annonce->description }}</p>

                <!-- Louer -->
                <a href="{{ route('locataire.demande.create', $annonce->id) }}"
                    class="btn btn-louer mt-3">Louer maintenant</a>
            </div>
        </div>
    </section>
@endsection
