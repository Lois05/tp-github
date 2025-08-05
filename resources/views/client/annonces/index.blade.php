@extends('layouts.client')

@section('title', 'Toutes les annonces')

@section('content')

    <!-- Hero Section -->
    <header class="hero text-white d-flex align-items-center"
        style="background: url('{{ asset('assets/images/hero.jpeg') }}') center/cover no-repeat; height: 400px;">
        <div class="container text-center">
            <h1>Trouvez ce qu’il vous faut en quelques clics</h1>
            <p>Explorez nos annonces et découvrez des biens de qualité à louer partout au Bénin. Simplicité et confiance garanties.</p>
            <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
        </div>
    </header>

    <section class="container py-5">
        <h2 class="section-title text-center mb-5">Toutes les annonces disponibles</h2>

        <div class="row g-4">
            @forelse ($annonces as $annonce)
                <div class="col-md-4">
                    <div class="annonce-card position-relative">

                        <!-- Cœur favori -->
                        <span class="favorite-icon position-absolute top-0 end-0 p-2" data-annonce-id="{{ $annonce->id }}" style="cursor: pointer;">
                            @php
                                $favorisIds = $favorisIds ?? [];
                                $isFavori = in_array($annonce->id, $favorisIds);
                            @endphp
                            <i class="bi {{ $isFavori ? 'bi-heart-fill text-danger' : 'bi-heart' }}" style="font-size: 1.5rem;"></i>
                        </span>

                        <!-- Image -->
                        <img src="{{ Str::startsWith($annonce->image, 'http') ? $annonce->image : asset('storage/' . $annonce->image) }}"
                            alt="{{ $annonce->titre }}" class="annonce-img"
                            style="height: 200px; object-fit: cover; width: 100%;">

                        <!-- Corps -->
                        <div class="annonce-body mt-3">
                            <h5 class="annonce-title">{{ $annonce->titre }}</h5>
                            <p class="price">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA / jour</p>

                            <div class="stars mb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="{{ route('client.annonces.show', $annonce->id) }}" class="btn btn-primary">Voir</a>
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

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const favorisIcons = document.querySelectorAll('.favorite-icon');

    favorisIcons.forEach(icon => {
        icon.addEventListener('click', async () => {
            const annonceId = icon.getAttribute('data-annonce-id');

            // Vérifier si utilisateur connecté (sinon rediriger)
            @if (!auth()->check())
                window.location.href = "{{ route('auth.page') }}";
                return;
            @endif

            try {
                const response = await fetch(`/favoris/${annonceId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }

                const data = await response.json();

                const heart = icon.querySelector('i');
                if (data.favoriAdded) {
                    heart.classList.remove('bi-heart');
                    heart.classList.add('bi-heart-fill', 'text-danger');
                } else {
                    heart.classList.remove('bi-heart-fill', 'text-danger');
                    heart.classList.add('bi-heart');
                }

                // Mettre à jour compteur favoris si tu en as un (exemple : dans le dashboard)
                const countSpan = document.querySelector('#favoris-count');
                if (countSpan && data.totalFavoris !== undefined) {
                    countSpan.textContent = data.totalFavoris;
                }

            } catch (error) {
                console.error('Erreur AJAX:', error);
                alert('Une erreur est survenue. Veuillez réessayer plus tard.');
            }
        });
    });
});
</script>
@endsection
