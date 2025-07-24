@extends('layouts.client')

@section('title', $annonce->titre)

@section('content')

<header class="hero">
  <div>
    <h1>{{ $annonce->titre }}</h1>
    <p>Découvrez tous les détails avant de louer en toute confiance.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Retour aux annonces</a>
  </div>
</header>

<section class="container py-5">
  <div class="row g-5 align-items-center">
    <div class="col-md-6">
      @if (Str::startsWith($annonce->image, 'http'))
        <img src="{{ $annonce->image }}" alt="{{ $annonce->titre }}" class="img-fluid rounded shadow w-100" style="max-height: 450px; object-fit: cover;">
      @else
        <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="img-fluid rounded shadow w-100" style="max-height: 450px; object-fit: cover;">
      @endif
    </div>

    <div class="col-md-6">
      <h2>{{ $annonce->titre }}</h2>
      <p class="h4 fw-bold">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>

      <div class="stars mb-3">
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-fill text-warning"></i>
        <i class="bi bi-star-half text-warning"></i>
      </div>

      <ul class="list-unstyled mb-4">
        <li><strong>Catégorie :</strong> {{ $annonce->bien->categorie->nom ?? 'Non spécifiée' }}</li>
        <li><strong>Localisation :</strong> {{ $annonce->localisation ?? 'Non spécifiée' }}</li>
        <li><strong>État :</strong> {{ ucfirst($annonce->bien->etat ?? 'Inconnu') }}</li>
        <li><strong>Propriétaire :</strong>
          {{ $annonce->bien && $annonce->bien->proprietaire && $annonce->bien->proprietaire->user
              ? $annonce->bien->proprietaire->user->prenom . ' ' . $annonce->bien->proprietaire->user->nom
              : 'Inconnu' }}
        </li>
      </ul>

      <p>{{ $annonce->description }}</p>

      <a href="{{ route('locataire.demande.create', $annonce->id) }}" class="btn btn-success">Louer maintenant</a>

      @if (auth()->check() && isset($avisLaissé) && !$avisLaissé)
        <button id="btn-avis" class="btn btn-outline-primary mt-3">Laisser un avis</button>
      @endif

      <div id="form-avis" style="display:none; margin-top:1rem;">
        <form action="{{ route('avis.store', $annonce->id) }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="note">Note</label>
            <select id="note" name="note" class="form-select" required>
              <option value="">Choisir une note</option>
              @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
              @endfor
            </select>
          </div>
          <div class="mb-3">
            <label for="commentaire">Commentaire</label>
            <textarea id="commentaire" name="commentaire" rows="3" class="form-control" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
      </div>

      <script>
        document.getElementById('btn-avis')?.addEventListener('click', () => {
          const form = document.getElementById('form-avis');
          form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
      </script>
    </div>
  </div>
</section>

@endsection
