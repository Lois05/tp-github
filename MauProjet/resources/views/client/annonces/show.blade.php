@extends('layouts.client')

@section('content')
<!-- Hero Section (optionnel, tu peux l'ajouter ici aussi) -->
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>

<div class="container py-5">
    <div class="row g-4">
        <!-- Image principale -->
        <div class="col-md-6">
            <img src="{{ asset('images/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="img-fluid rounded shadow">
        </div>

        <!-- Infos annonce -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $annonce->titre }}</h1>
            <p class="text-muted">Catégorie : <strong>{{ $annonce->categorie->libelle ?? 'Non spécifiée' }}</strong></p>
            <p class="h4 text-success fw-bold">{{ $annonce->prix }} FCFA</p>

            <!-- Étoiles -->
            <div class="my-3">
                @php
                    $note = $annonce->etoiles ?? 4.5;
                    $fullStars = floor($note);
                    $halfStar = ($note - $fullStars) >= 0.5;
                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                @endphp
                @for($i = 0; $i < $fullStars; $i++)
                    <i class="bi bi-star-fill text-warning"></i>
                @endfor
                @if($halfStar)
                    <i class="bi bi-star-half text-warning"></i>
                @endif
                @for($i = 0; $i < $emptyStars; $i++)
                    <i class="bi bi-star text-muted"></i>
                @endfor
                <span class="ms-2 text-muted">{{ number_format($note, 1) }} / 5</span>
            </div>

            <p class="lead mt-4">{{ $annonce->description }}</p>

            <a href="#" class="btn btn-primary btn-lg mt-3 rounded-pill px-4 py-2">Louer maintenant</a>
        </div>
    </div>
</div>
@endsection
