@extends('layouts.client')

@section('title', 'Toutes les annonces')

@section('content')

<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>

<section class="container py-5">
  <h2 class="section-title text-center">Toutes les annonces</h2>

  <div class="annonces-grid">
    @foreach($annonces as $annonce)
      <article class="annonce-card">
        <img src="{{ asset('images/'.$annonce->image) }}" alt="Image de {{ $annonce->titre }}" class="annonce-img" />

        <div class="annonce-body">
          <h3 class="annonce-title">{{ $annonce->titre }}</h3>
          <p class="price">{{ number_format($annonce->prix, 0, ',', ' ') }} F CFA</p>

          {{-- Étoiles de notation (exemple avec 5 étoiles - ici statique, à adapter selon ta donnée) --}}
          <div class="stars">
            @for ($i = 0; $i < 5; $i++)
              <i class="bi bi-star-fill"></i>
            @endfor
          </div>

          {{-- Cœur favori (exemple statique) --}}
          <div class="favorite-icon" style="position: absolute; top: 15px; right: 15px; cursor: pointer;">
            <i class="bi bi-heart"></i>
          </div>

          <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('client.annonces.show', $annonce->id) }}" class="btn btn-outline-primary flex-grow-1 me-2">Voir</a>
            <a href="{{ route('locataire.demande.create', $annonce->id) }}" class="btn btn-primary flex-grow-1">Louer</a>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  {{-- Pagination --}}
  <div class="d-flex justify-content-center mt-4">
    {{ $annonces->links() }}
  </div>
</section>

@endsection
