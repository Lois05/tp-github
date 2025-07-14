@extends('layouts.client')

@section('title', 'Accueil')

@section('content')
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>

<section id="services">
  <h2 class="section-title">Nos services</h2>
  <div class="services-row">
    <div class="service-card"><h5>Location simple</h5><p>Réservez facilement en quelques clics, sans tracas.</p></div>
    <div class="service-card"><h5>Propriétaires sécurisés</h5><p>Publiez vos annonces et gérez vos locations en toute sécurité.</p></div>
    <div class="service-card"><h5>Paiement fiable</h5><p>Paiements sécurisés avec reçus et suivi automatisé.</p></div>
  </div>
</section>

<section id="about-section">
  <h2 class="section-title">À propos de LocaPlus</h2>
  <div style="max-width: 900px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 2rem; align-items: center; justify-content: center;">
    <img src="{{ asset('images/about-banner.jpg') }}" alt="À propos" style="width: 100%; max-width: 400px; border-radius: 20px;" />
    <div style="max-width: 450px; color: #555; font-weight: 500;">
      <p>LocaPlus est la plateforme béninoise dédiée à la location de tous types de biens, hors immobilier.</p>
      <a href="{{ route('client.contact') }}" class="btn btn-primary mt-3">Contactez-nous</a>
    </div>
  </div>
</section>
@endsection

