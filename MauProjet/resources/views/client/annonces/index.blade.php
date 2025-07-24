@extends('layouts.client')

@section('title', 'Toutes les annonces')

@section('content')

<header class="hero">
  <div>
    <h1>Trouvez ce qu’il vous faut en quelques clics</h1>
    <p>Explorez nos annonces et découvrez des biens de qualité à louer partout au Bénin. Simplicité et confiance garanties.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Toutes les annonces</a>
  </div>
</header>

<section class="container py-5">
  <h2 class="section-title text-center mb-5">Toutes les annonces disponibles</h2>

  <div class="row g-4">
    @forelse ($annonces as $annonce)
      <div class="col-md-4">
        <div class="annonce-card">
          <!-- Cœur favori -->
          <span class="favorite-icon">
            <i class="bi bi-heart-fill"></i>
          </span>

          <!-- Image -->
          <img src="{{ Str::startsWith($annonce->image, 'http') ? $annonce->image : asset('storage/' . $annonce->image) }}"
               alt="{{ $annonce->titre }}"
               class="annonce-img"
               style="height: 200px; object-fit: cover; width: 100%;">

          <!-- Corps -->
          <div class="annonce-body">
            <h5 class="annonce-title">{{ $annonce->titre }}</h5>
            <p class="price">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA / jour</p>

            <div class="stars">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-half"></i>
              <i class="bi bi-star"></i>
            </div>

            <a href="{{ route('client.annonces.show', $annonce->id) }}" class="btn-louer">Voir</a>
          </div>
        </div>
      </div>
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
