@extends('layouts.client')

@section('title', $annonce->titre)

@section('content')

<header class="py-5 bg-light text-center">
    <div class="container">
        <h1 class="display-5 fw-bold">{{ $annonce->titre }}</h1>
        <p class="lead">Découvrez tous les détails avant de louer en toute confiance.</p>
        <a href="{{ route('client.annonces.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Retour aux annonces
        </a>
    </div>
</header>

<section class="container py-5">
    <div class="row g-5 align-items-start">
        <div class="col-lg-6">
            @if (Str::startsWith($annonce->image, 'http'))
                <img src="{{ $annonce->image }}" alt="{{ $annonce->titre }}" class="img-fluid rounded shadow" style="max-height: 450px; object-fit: cover; width: 100%;">
            @else
                <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="img-fluid rounded shadow" style="max-height: 450px; object-fit: cover; width: 100%;">
            @endif
        </div>

        <div class="col-lg-6">
            <h2 class="mb-3">{{ $annonce->titre }}</h2>
            <p class="h4 text-success fw-bold">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>

            <div class="mb-3 text-warning fs-5">
                <i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-fill me-1"></i><i class="bi bi-star-half"></i>
            </div>

            <ul class="list-unstyled fs-6 mb-4">
                <li><strong>Catégorie :</strong> {{ $annonce->bien->categorie->nom ?? 'Non spécifiée' }}</li>
                <li><strong>Localisation :</strong> {{ $annonce->localisation ?? 'Non spécifiée' }}</li>
                <li><strong>État :</strong> {{ ucfirst($annonce->bien->etat ?? 'Inconnu') }}</li>
                <li><strong>Propriétaire :</strong>
                    {{ $annonce->bien->proprietaire->user->prenom ?? '' }}
                    {{ $annonce->bien->proprietaire->user->nom ?? 'Inconnu' }}
                </li>
            </ul>

            <p class="mb-4 text-muted">{{ $annonce->description }}</p>

            <a href="{{ route('locataire.demande.create', $annonce->id) }}" class="btn btn-success me-2">
                <i class="bi bi-send-fill"></i> Louer maintenant
            </a>

            @if (auth()->check() && isset($avisLaissé) && !$avisLaissé)
                <button id="btn-avis" class="btn btn-outline-primary">
                    <i class="bi bi-chat-dots"></i> Laisser un avis
                </button>

                <div id="form-avis" class="mt-4 card p-4 shadow-sm" style="display:none;">
                    <form action="{{ route('avis.store', $annonce->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <select id="note" name="note" class="form-select" required>
                                <option value="">Choisir une note</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire</label>
                            <textarea id="commentaire" name="commentaire" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
  document.getElementById('btn-avis')?.addEventListener('click', function () {
    const form = document.getElementById('form-avis');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    this.classList.toggle('btn-outline-primary');
    this.classList.toggle('btn-danger');
    this.innerHTML = form.style.display === 'block' ? 'Annuler' : '<i class="bi bi-chat-dots"></i> Laisser un avis';
  });
</script>

@endsection
