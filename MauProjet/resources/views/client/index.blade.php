<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Accueil - LocaPlus</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #FAFAFA;
      color: #333;
      margin: 0;
      padding: 0;
    }
    /* Navbar */
    nav.navbar {
      background-color: #fff;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      padding: 1rem 2rem;
      position: sticky;
      top: 0;
      z-index: 1030;
    }
    nav .navbar-brand {
      font-weight: 700;
      font-size: 1.6rem;
      color: #1a73e8;
    }
    nav .nav-link {
      color: #555;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    nav .nav-link:hover, nav .nav-link.active {
      color: #1a73e8;
    }
    nav .btn-outline-primary {
      border-radius: 25px;
      padding: 0.4rem 1.4rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    nav .btn-outline-primary:hover {
      background-color: #1a73e8;
      color: white;
    }
    /* Hero */
    .hero {
      background: linear-gradient(90deg, rgba(26,115,232,0.85) 0%, rgba(26,115,232,0.7) 100%), url('{{ asset("images/hero-bg.jpg") }}') center/cover no-repeat;
      height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: white;
      padding: 0 1rem;
    }
    .hero h1 {
      font-weight: 700;
      font-size: 3.2rem;
      max-width: 720px;
      margin-bottom: 1rem;
      line-height: 1.2;
      text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .hero p {
      font-weight: 500;
      font-size: 1.25rem;
      margin-bottom: 2rem;
      text-shadow: 0 1px 6px rgba(0,0,0,0.2);
    }
    .hero .btn-primary {
      background-color: #34a853;
      border: none;
      border-radius: 30px;
      padding: 0.75rem 2.5rem;
      font-weight: 600;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
    }
    .hero .btn-primary:hover {
      background-color: #2c8c44;
    }
    /* Sections */
    section {
      padding: 4rem 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    h2.section-title {
      font-weight: 700;
      font-size: 2.75rem;
      color: #1a73e8;
      text-align: center;
      margin-bottom: 3rem;
    }
    /* Services */
    .services-row {
      display: flex;
      justify-content: center;
      gap: 2rem;
      flex-wrap: wrap;
    }
    .service-card {
      flex: 1 1 280px;
      background: white;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 4px 14px rgb(26 115 232 / 0.15);
      transition: transform 0.3s ease;
      text-align: center;
    }
    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 24px rgb(26 115 232 / 0.3);
    }
    .service-card h5 {
      color: #1a73e8;
      font-weight: 700;
      margin-bottom: 1rem;
      font-size: 1.3rem;
    }
    .service-card p {
      color: #666;
      font-weight: 500;
      font-size: 1rem;
      line-height: 1.5;
    }
    /* Annonces */
    .annonces-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
      gap: 2rem;
    }
    .annonce-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 6px 16px rgb(0 0 0 / 0.1);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      height: 100%;
    }
    .annonce-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 32px rgb(0 0 0 / 0.15);
    }
    .annonce-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }
    .annonce-body {
      padding: 1.25rem 1.5rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .annonce-title {
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
      color: #222;
    }
    .price {
      font-weight: 700;
      color: #34a853;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }
    .stars {
      color: #fbbc04;
      font-size: 1.2rem;
      margin-bottom: 1rem;
    }
    .btn-louer {
      background-color: #1a73e8;
      border: none;
      border-radius: 30px;
      padding: 0.6rem 1.6rem;
      font-weight: 600;
      color: white;
      transition: background-color 0.3s ease;
      align-self: flex-start;
    }
    .btn-louer:hover {
      background-color: #155ab6;
    }
    /* Footer */
    footer {
      background-color: #1a73e8;
      color: white;
      text-align: center;
      padding: 1.8rem 1rem;
      font-weight: 500;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a href="{{ route('client.home') }}" class="navbar-brand">LocaPlus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a href="{{ route('client.home') }}" class="nav-link active">Accueil</a></li>
        <li class="nav-item"><a href="{{ route('client.annonces') }}" class="nav-link">Annonces</a></li>
        <li class="nav-item"><a href="#about-section" class="nav-link">À propos</a></li>
        <li class="nav-item"><a href="{{ route('client.contact') }}" class="nav-link">Contact</a></li>
        <li class="nav-item ms-lg-3"><a href="{{ route('login') }}" class="btn btn-outline-primary px-4 py-2">Connexion</a></li>
      </ul>
    </div>
  </div>
</nav>

<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>

<section id="services" class="services">
  <h2 class="section-title">Nos services</h2>
  <div class="services-row">
    <div class="service-card">
      <h5>Location simple</h5>
      <p>Réservez facilement en quelques clics, sans tracas.</p>
    </div>
    <div class="service-card">
      <h5>Propriétaires sécurisés</h5>
      <p>Publiez vos annonces et gérez vos locations en toute sécurité.</p>
    </div>
    <div class="service-card">
      <h5>Paiement fiable</h5>
      <p>Paiements sécurisés avec reçus et suivi automatisé.</p>
    </div>
  </div>
</section>

<section id="annonces" class="annonces">
  <h2 class="section-title">Annonces populaires</h2>
  <div class="annonces-grid">
    @php
      function stars_html($note) {
        $fullStars = floor($note);
        $halfStar = ($note - $fullStars) >= 0.5;
        $html = '';
        for ($i=0; $i<$fullStars; $i++) $html .= '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"><path fill="#fbbc04" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36-17.7 54.6l105.7 103L120.4 470c-4.5 26.3 23 46 46.4 33.7L288 405.3l121.2 63.4c23.4 12.3 50.9-7.4 46.4-33.7L439 329.1l105.7-103c19-18.6 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg>';
        if ($halfStar) $html .= '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star-half-alt" class="svg-inline--fa fa-star-half-alt fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 536 512" width="16" height="16"><path fill="#fbbc04" d="M288 0c-11.6 0-21.5 6.9-26.6 17.6l-58.7 119-131.8 19.2c-26.2 3.8-36.7 36-17.7 54.6l95.5 93.1-22.5 131.2c-4.5 26.3 23 46 46.4 33.7L288 405.3V0z"></path></svg>';
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        for ($i=0; $i<$emptyStars; $i++) $html .= '<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"><path fill="#ccc" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36-17.7 54.6l105.7 103L120.4 470c-4.5 26.3 23 46 46.4 33.7L288 405.3l121.2 63.4c23.4 12.3 50.9-7.4 46.4-33.7L439 329.1l105.7-103c19-18.6 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4-124.3-65.3-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"></path></svg>';
        return $html;
      }

      $annonces = [
        ['image' => 'frigo.jpg', 'titre' => 'Réfrigérateur Samsung', 'prix' => '15 000 FCFA / semaine', 'etoiles' => 4.5],
        ['image' => 'lave-linge.jpg', 'titre' => 'Lave-linge LG', 'prix' => '20 000 FCFA / semaine', 'etoiles' => 4],
        ['image' => 'micro-onde.jpg', 'titre' => 'Micro-ondes Panasonic', 'prix' => '10 000 FCFA / semaine', 'etoiles' => 5],
        ['image' => 'clim.jpg', 'titre' => 'Climatiseur Daikin', 'prix' => '25 000 FCFA / semaine', 'etoiles' => 4.8],
        ['image' => 'tv.jpg', 'titre' => 'Téléviseur LED 40 pouces', 'prix' => '18 000 FCFA / semaine', 'etoiles' => 4.2],
        ['image' => 'aspirateur.jpg', 'titre' => 'Aspirateur Dyson', 'prix' => '12 000 FCFA / semaine', 'etoiles' => 4.6],
      ];
    @endphp

    @foreach($annonces as $annonce)
      <article class="annonce-card" tabindex="0">
        <img src="{{ asset('images/'.$annonce['image']) }}" alt="{{ $annonce['titre'] }}" class="annonce-img" />
        <div class="annonce-body">
          <h3 class="annonce-title">{{ $annonce['titre'] }}</h3>
          <p class="price">{{ $annonce['prix'] }}</p>
          <div class="stars" aria-label="Note : {{ $annonce['etoiles'] }} sur 5">
            {!! stars_html($annonce['etoiles']) !!}
          </div>
          <a href="#" class="btn-louer" role="button" aria-label="Louer {{ $annonce['titre'] }}">Louer</a>
        </div>
      </article>
    @endforeach
  </div>
</section>

<section id="about-section" class="about">
  <h2 class="section-title">À propos de LocaPlus</h2>
  <div style="max-width: 900px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 2rem; align-items: center; justify-content: center;">
    <img src="{{ asset('images/about-banner.jpg') }}" alt="À propos de LocaPlus" style="width: 100%; max-width: 400px; border-radius: 20px; box-shadow: 0 6px 18px rgb(0 0 0 / 0.12);" />
    <div style="max-width: 450px; color: #555; font-weight: 500; font-size: 1.1rem;">
      <p>LocaPlus est la plateforme béninoise dédiée à la location de tous types de biens, hors immobilier. Nous facilitons la mise en relation entre locataires et propriétaires avec simplicité, sécurité et confiance.</p>
      <a href="{{ route('client.contact') }}" class="btn btn-primary mt-3" style="border-radius: 25px; padding: 0.6rem 1.8rem; font-weight: 600;">Contactez-nous</a>
    </div>
  </div>
</section>

<section class="contact-quick py-5" style="background-color: #1a73e8; color: white; text-align: center;">
  <h4>Une question ? Besoin d’aide ?</h4>
  <a href="{{ route('client.contact') }}" class="btn btn-light mt-3 px-5 py-2" style="border-radius: 25px; font-weight: 600;">Contactez notre équipe</a>
</section>

<footer>
  <p>&copy; {{ now()->year }} LocaPlus. Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
