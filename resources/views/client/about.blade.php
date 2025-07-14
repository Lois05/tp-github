@extends('layouts.client')

@section('title', 'Contactez-nous - LocaPlus')

@section('content')
<!-- Hero Section (optionnel, tu peux l'ajouter ici aussi) -->
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>


    <section class="about-section py-5">
  <div class="container d-flex flex-column flex-lg-row align-items-center gap-4">
    <!-- Image -->
    <div class="about-image flex-shrink-0" style="flex:1; max-width: 500px;">
      <img src="{{ asset('images/about-illustration.jpg') }}" alt="À propos de LocaPlus" class="img-fluid rounded shadow">
    </div>

    <!-- Texte -->
    <div class="about-text flex-grow-1" style="flex:2;">
      <h2 class="section-title mb-4">Découvrez LocaPlus</h2>
      <p class="lead mb-3">
        Chez <strong>LocaPlus</strong>, nous connectons locataires et propriétaires au Bénin avec simplicité, sécurité et confiance.
      </p>
      <p>
        Notre mission est de faciliter la location de biens divers, hors immobilier, en offrant une plateforme intuitive, fiable et performante. Que vous cherchiez à louer un véhicule, un matériel professionnel, ou tout autre bien, nous sommes là pour vous accompagner.
      </p>
      <ul class="list-unstyled mt-4" style="font-size: 1.05rem; line-height: 1.6;">
        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Interface simple et accessible</li>
        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Support client réactif</li>
        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Paiements sécurisés</li>
        <li><i class="bi bi-check-circle-fill text-success me-2"></i> Communauté grandissante</li>
      </ul>
      <a href="{{ route('client.contact') }}" class="btn btn-primary btn-lg mt-4">Contactez-nous</a>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-white">
  <div class="container">
    <h2 class="section-title mb-5 text-center">Foire aux questions (FAQ)</h2>
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeading1">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
            Comment puis-je créer une annonce sur LocaPlus ?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Après avoir créé un compte et vous être connecté, cliquez sur "Créer une annonce" dans votre tableau de bord. Remplissez les détails du bien, ajoutez des photos, puis soumettez pour publication.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeading2">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
            Comment se déroule le paiement sécurisé ?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Nous utilisons des partenaires de paiement sécurisés qui garantissent que vos transactions sont protégées. Vous ne payez qu’après avoir validé la location avec le propriétaire.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeading3">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
            Puis-je annuler une réservation ?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Oui, les annulations sont possibles selon les conditions fixées dans chaque annonce. Veuillez consulter les détails de la réservation et contacter le propriétaire en cas de problème.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="faqHeading4">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
            Comment contacter le support client ?
          </button>
        </h2>
        <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Vous pouvez nous contacter via la page <a href="{{ route('client.contact') }}">Contact</a>, ou envoyer un email directement à support@locaplus.bj.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .about-section {
    background: #f9fafb;
  }
  .section-title {
    color: #d35400;
    font-weight: 800;
    font-size: 2.5rem;
  }
  @media (max-width: 991px) {
    .about-section .container {
      flex-direction: column;
    }
  }
  .faq-section {
    background: white;
  }
  .accordion-button {
    font-weight: 600;
    font-size: 1.1rem;
    color: #2c3e50;
  }
  .accordion-button:not(.collapsed) {
    color: #d35400;
    background-color: #fef3e8;
  }
  .accordion-body {
    font-size: 1rem;
    color: #555;
  }
</style>
@endsection
