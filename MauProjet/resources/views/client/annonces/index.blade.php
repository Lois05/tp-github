@extends('layouts.client')

@section('title', 'Toutes les annonces')

@section('content')

<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir toutes les annonces</a>
  </div>
</header>

<section class="container py-5">
  <h2 class="section-title text-center mb-5">Toutes les annonces disponibles</h2>

  <div class="annonces-grid">
    @forelse ($annonces as $annonce)
      <article class="annonce-card">
        <!-- Image -->
        <img src="{{ $annonce->image ? asset('storage/'.$annonce->image) : asset('images/default.png') }}"
             alt="{{ $annonce->titre }}" class="annonce-img" />

        <!-- Favorite icon -->
        <span class="favorite-icon">
          <i class="bi bi-heart"></i>
        </span>

        <!-- Body -->
        <div class="annonce-body">
          <h5 class="annonce-title">{{ $annonce->titre }}</h5>
          <p class="price">{{ number_format($annonce->prix, 0, ',', ' ') }} F CFA</p>

          <!-- Stars -->
          <div class="stars">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
          </div>

          <a href="{{ route('client.annonces.show', $annonce->id) }}" class="btn btn-louer mt-2">
            Voir plus
          </a>
        </div>
      </article>
    @empty
      <p class="text-center">Aucune annonce disponible pour le moment.</p>
    @endforelse
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-5">
    {{ $annonces->links() }}
  </div>
</section>

@endsection
