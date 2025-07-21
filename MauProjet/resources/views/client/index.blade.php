@extends('layouts.client')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')

<!-- Hero Section (optionnel, tu peux l'ajouter ici aussi) -->
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>


<!-- Services Section -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="section-title">Nos Services</h2>
    <div class="services-row">
      <div class="service-card">
        <i class="bi bi-house-door icon"></i>
        <h5>Location simple</h5>
        <p>Explorez une vaste gamme de biens à louer selon vos besoins : rapide, sécurisé et pratique.</p>
      </div>
      <div class="service-card">
        <i class="bi bi-shield-check icon"></i>
        <h5>Sécurité assurée</h5>
        <p>Chaque utilisateur est vérifié pour garantir la confiance et des transactions fiables.</p>
      </div>
      <div class="service-card">
        <i class="bi bi-headset icon"></i>
        <h5>Assistance 7j/7</h5>
        <p>Un support disponible à tout moment pour vous accompagner dans toutes vos démarches.</p>
      </div>
    </div>
  </div>
</section>


<!-- Annonces populaires -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title">Annonces Populaires</h2>

    <div class="annonces-grid">
      @forelse($annonces as $annonce)
      <div class="annonce-card">
        <!-- Cœur favori -->
        <span class="favorite-icon"><i class="bi bi-heart-fill"></i></span>

        <!-- Image -->
        <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="annonce-img">

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
      @empty
        <p>Aucune annonce trouvée.</p>
      @endforelse
    </div>
  </div>
</section>




<section class="publier annonce-section py-5 bg-light">
  <div class="container text-center">
    <p class="lead mb-4">
      Vous avez des objets ou des biens que vous n'utilisez plus ? Vous souhaitez rentabiliser ces derniers ?<br>
      Publiez une annonce et touchez un maximum de potentiels locataires intéressés par vos biens.
    </p>
    <a href="{{ route('client.annonce.create') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
      Publier une annonce maintenant !
    </a>
  </div>
</section>





<!-- À propos -->
<section class="about-section py-5 bg-light">
  <div class="container">
    <div class="row align-items-center gy-4">
      <div class="col-md-6">
        <img src="{{ asset('images/about-illustration.jpg') }}" alt="À propos de LocaPlus" class="img-fluid rounded shadow" />
      </div>
      <div class="col-md-6">
        <h2 class="section-title mb-4">Qui sommes-nous ?</h2>
        <p class="lead mb-3">
          LocaPlus est la plateforme innovante qui connecte locataires et propriétaires au Bénin, pour louer tout type de biens en toute simplicité.
        </p>
        <p>
          Notre mission est de rendre la location accessible, sûre et rapide, en offrant une expérience intuitive, transparente et conviviale. Que vous cherchiez un matériel, un véhicule ou autre, LocaPlus est là pour vous accompagner.
        </p>
        <a href="{{ route('client.contact') }}" class="btn btn-primary btn-lg mt-4 rounded-pill">
          Contactez-nous
        </a>
      </div>
    </div>
  </div>
</section>






<!-- Contact rapide -->
<section class="py-5 text-white text-center" style="background-color: #1a73e8;">
    <div class="container">
        <h4 class="fw-bold">Une question ? Besoin d’aide ?</h4>
        <a href="{{ route('client.contact') }}" class="btn btn-light mt-3 px-5 py-2 rounded-pill fw-semibold">Contactez notre équipe</a>
    </div>
</section>

@endsection

