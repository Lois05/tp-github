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
    <!-- Hero Section -->
    <header class="hero text-white d-flex align-items-center"
        style="background: url('{{ asset('assets/images/hero1.jpg') }}') center/cover no-repeat; height: 400px;">
        <div class="container text-center">
            <h1>Louez malin, vivez mieux.</h1>
            <p>Avec LocaPlus, accédez à tout ce dont vous avez besoin sans investissement lourd. Louer, c’est simple !</p>
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
                        <img src="{{ Str::startsWith($annonce->image, 'http') ? $annonce->image : asset('storage/' . $annonce->image) }}"
                            alt="{{ $annonce->titre }}" class="annonce-img">

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

    <!-- Section publication annonce -->
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
                    <img src="{{ asset('assets/images/about.jpg') }}" alt="À propos de LocaPlus"
                        class="img-fluid rounded shadow" />
                </div>
                <div class="col-md-6">
                    <h2 class="section-title mb-4">Qui sommes-nous ?</h2>
                    <p class="lead mb-3">
                        LocaPlus est la plateforme innovante qui connecte locataires et propriétaires au Bénin, pour louer
                        tout type de biens en toute simplicité.
                    </p>
                    <p>
                        Notre mission est de rendre la location accessible, sûre et rapide, en offrant une expérience
                        intuitive, transparente et conviviale. Que vous cherchiez un matériel, un véhicule ou autre,
                        LocaPlus est là pour vous accompagner.
                    </p>
                    <a href="{{ route('client.contact') }}" class="btn btn-primary btn-lg mt-4 rounded-pill">
                        Contactez-nous
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages animés -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="section-title mb-5">Ils nous font confiance</h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                <div class="carousel-inner">
                    @php
                        $testimonials = [
                            [
                                'text' =>
                                    'LocaPlus m’a permis de louer mes outils de jardinage inutilisés. Je gagne un revenu régulier chaque mois !',
                                'name' => 'Jean K.',
                                'city' => 'Cotonou',
                                'avatar' => 'https://i.pravatar.cc/80?img=15',
                            ],
                            [
                                'text' =>
                                    'J’avais besoin d’un générateur pour un week-end, tout s’est fait en 10 minutes. Service au top !',
                                'name' => 'Mireille A.',
                                'city' => 'Abomey-Calavi',
                                'avatar' => 'https://i.pravatar.cc/80?img=32',
                            ],
                            [
                                'text' =>
                                    'Simple, rapide, sécurisé. LocaPlus m’a vraiment aidé à rentabiliser mes biens sans effort.',
                                'name' => 'Sètondji B.',
                                'city' => 'Porto-Novo',
                                'avatar' => 'https://i.pravatar.cc/80?img=5',
                            ],
                            [
                                'text' =>
                                    'Je loue régulièrement du matériel pour mon atelier. LocaPlus me fait gagner du temps et de l’argent.',
                                'name' => 'Isabelle D.',
                                'city' => 'Bohicon',
                                'avatar' => 'https://i.pravatar.cc/80?img=45',
                            ],
                            [
                                'text' =>
                                    'Je recommande à tous ceux qui veulent faire louer ce qu’ils n’utilisent pas. LocaPlus c’est pratique !',
                                'name' => 'Rodrigue E.',
                                'city' => 'Parakou',
                                'avatar' => 'https://i.pravatar.cc/80?img=50',
                            ],
                            [
                                'text' =>
                                    'Très bon service client ! Toujours disponible pour m’aider quand j’ai des questions.',
                                'name' => 'Diane F.',
                                'city' => 'Natitingou',
                                'avatar' => 'https://i.pravatar.cc/80?img=12',
                            ],
                        ];
                    @endphp

                    @foreach ($testimonials as $index => $testi)
                        <div class="carousel-item @if ($index === 0) active @endif">
                            <div class="d-flex flex-column align-items-center px-4">
                                <img src="{{ $testi['avatar'] }}" alt="{{ $testi['name'] }}" class="rounded-circle mb-3"
                                    width="80" height="80" />
                                <p class="fst-italic mb-3" style="max-width: 600px;">“{{ $testi['text'] }}”</p>
                                <h6 class="fw-bold mb-0">{{ $testi['name'] }}, <small
                                        class="text-muted">{{ $testi['city'] }}</small></h6>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev" aria-label="Précédent">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next" aria-label="Suivant">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <script>
document.querySelectorAll('.favorite-icon').forEach(icon => {
    icon.addEventListener('click', e => {
        e.preventDefault();
        icon.classList.toggle('active');
        // Ajoute ici une requête AJAX pour sauvegarder le favori côté serveur si besoin
    });
});
</script>
@endsection
