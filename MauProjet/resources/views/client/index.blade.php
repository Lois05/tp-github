<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Accueil - LocaPlus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f9f9f9; }
    .hero {
      background: url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
      height: 80vh;
      color: white;
      position: relative;
    }
    .hero-overlay {
      background: rgba(0, 0, 0, 0.55);
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 1rem;
    }
    .nav-link.active {
      font-weight: 600;
      color: #0d6efd !important;
    }
    /* Card style Airbnb-like */
    .annonce-card {
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      background: #fff;
      position: relative;
    }
    .annonce-card:hover {
      transform: translateY(-8px);
    }
    .annonce-img {
      height: 200px;
      object-fit: cover;
      width: 100%;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }
    .card-body {
      padding: 1rem 1.25rem;
    }
    .price {
      font-weight: 700;
      color: #198754;
      font-size: 1.25rem;
    }
    .stars {
      color: #f5c518;
    }
    .favorite {
      position: absolute;
      top: 12px;
      right: 12px;
      font-size: 1.5rem;
      color: #e0245e;
      cursor: pointer;
      user-select: none;
      transition: color 0.3s ease;
    }
    .favorite:hover {
      color: #b81d48;
    }
    footer {
      background: #212529;
      color: #ccc;
      padding: 20px 0;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ route('client.home') }}">LocaPlus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link active" href="{{ route('client.home') }}">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('client.annonces') }}">Annonces</a></li>
        <li class="nav-item"><a class="nav-link" href="#about-section">À propos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('client.contact') }}">Contact</a></li>
        <li class="nav-item ms-lg-3">
          <a class="btn btn-outline-primary" href="{{ route('login') }}">Connexion / Inscription</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO -->
<header class="hero">
  <div class="hero-overlay">
    <h1 class="display-4 fw-bold mb-3">Louez vos appareils électroménagers en toute simplicité</h1>
    <p class="lead mb-4">LocaPlus facilite la mise en relation entre locataires et propriétaires au Bénin.</p>
    <a href="{{ route('client.annonces') }}" class="btn btn-primary btn-lg px-5">Voir les annonces</a>
  </div>
</header>

<!-- ANNONCES RÉCENTES -->
<section class="py-5 container">
  <h2 class="mb-4 text-center">Nos annonces populaires</h2>
  <div class="row g-4 justify-content-center">

    {{-- Simuler 6 annonces --}}
    @php
      $annonces = [
        ['image' => 'frigo.jpg', 'titre' => 'Réfrigérateur Samsung', 'prix' => '15 000 FCFA / semaine', 'etoiles' => 4.5],
        ['image' => 'lave-linge.jpg', 'titre' => 'Lave-linge LG', 'prix' => '20 000 FCFA / semaine', 'etoiles' => 4],
        ['image' => 'micro-onde.jpg', 'titre' => 'Micro-ondes Panasonic', 'prix' => '10 000 FCFA / semaine', 'etoiles' => 5],
        ['image' => 'clim.jpg', 'titre' => 'Climatiseur Daikin', 'prix' => '25 000 FCFA / semaine', 'etoiles' => 4.8],
        ['image' => 'tv.jpg', 'titre' => 'Téléviseur LED 40 pouces', 'prix' => '18 000 FCFA / semaine', 'etoiles' => 4.2],
        ['image' => 'aspirateur.jpg', 'titre' => 'Aspirateur Dyson', 'prix' => '12 000 FCFA / semaine', 'etoiles' => 4.6],
      ];

      function stars_html($note) {
        $fullStars = floor($note);
        $halfStar = ($note - $fullStars) >= 0.5;
        $html = '';
        for ($i=0; $i<$fullStars; $i++) $html .= '<i class="bi bi-star-fill"></i>';
        if ($halfStar) $html .= '<i class="bi bi-star-half"></i>';
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        for ($i=0; $i<$emptyStars; $i++) $html .= '<i class="bi bi-star"></i>';
        return $html;
      }
    @endphp

    @foreach($annonces as $annonce)
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="annonce-card position-relative">
          <img src="{{ asset('images/'.$annonce['image']) }}" alt="{{ $annonce['titre'] }}" class="annonce-img" />
          <span class="favorite"><i class="bi bi-heart"></i></span>
          <div class="card-body">
            <h5 class="card-title">{{ $annonce['titre'] }}</h5>
            <p class="price">{{ $annonce['prix'] }}</p>
            <div class="stars text-warning" style="font-size: 1.1rem;">
              {!! stars_html($annonce['etoiles']) !!}
            </div>
            <a href="#" class="btn btn-success mt-3 w-100">Louer</a>
          </div>
        </div>
      </div>
    @endforeach

  </div>
</section>

<!-- SERVICES -->
<section class="py-5 bg-white text-center">
  <div class="container">
    <h2 class="mb-4">Nos services</h2>
    <div class="row justify-content-center gy-4">
      <div class="col-md-4">
        <h5>Location simple</h5>
        <p>Réservez facilement en quelques clics sans tracas.</p>
      </div>
      <div class="col-md-4">
        <h5>Propriétaires sécurisés</h5>
        <p>Publiez vos annonces et gérez vos locations en toute sécurité.</p>
      </div>
      <div class="col-md-4">
        <h5>Paiement fiable</h5>
        <p>Paiements sécurisés avec reçus et suivi automatisé.</p>
      </div>
    </div>
  </div>
</section>

<!-- À PROPOS -->
<section id="about-section" class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ asset('images/about-banner.jpg') }}" alt="À propos de LocaPlus" class="img-fluid rounded shadow" />
      </div>
      <div class="col-md-6">
        <h2 class="mb-3">À propos de LocaPlus</h2>
        <p class="lead text-secondary mb-4">
          LocaPlus est la plateforme béninoise dédiée à la location d’appareils électroménagers.
          Nous facilitons la mise en relation entre locataires et propriétaires avec simplicité, sécurité et confiance.
        </p>
        <a href="{{ route('client.contact') }}" class="btn btn-primary btn-lg">Contactez-nous</a>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT BOUTON RAPIDE -->
<section class="py-4 text-center bg-primary text-white">
  <div class="container">
    <h4>Une question ? Besoin d’aide ?</h4>
    <a href="{{ route('client.contact') }}" class="btn btn-light btn-lg mt-3 px-5">Contactez notre équipe</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <p class="mb-0 py-3">&copy; {{ now()->year }} LocaPlus. Tous droits réservés.</p>
  </div>
</footer>

<!-- Bootstrap JS + icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
