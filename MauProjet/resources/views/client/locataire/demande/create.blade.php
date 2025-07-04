@extends('layouts.client')

@section('title', 'Faire une demande de location')

@section('content')
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>

<div class="container py-5">
    <h2 class="mb-4">Formulaire de demande de location</h2>

    {{-- Formulaire de demande --}}
    <form action="{{ route('locataire.demande.store', $annonce_id) }}" method="POST">

        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom complet</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
        </div>
        <div class="mb-3">
    <label for="date_debut" class="form-label">Date de début</label>
    <input type="date" class="form-control" id="date_debut" name="date_debut" required>
</div>
<div class="mb-3">
    <label for="date_fin" class="form-label">Date de fin</label>
    <input type="date" class="form-control" id="date_fin" name="date_fin" required>
</div>


        <button type="submit" class="btn btn-primary">Envoyer la demande</button>
    </form>
</div>
@endsection

