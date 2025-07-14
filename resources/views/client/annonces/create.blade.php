@extends('layouts.client')

@section('content')
<header class="hero">
  <div>
    <h1>Louez tout ce dont vous avez besoin</h1>
    <p>LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
    <a href="{{ route('client.annonces.index') }}" class="btn btn-primary mt-3">Voir les annonces</a>
  </div>
</header>
<div class="container py-5">
    <h2 class="mb-4">Publier une nouvelle annonce</h2>

    <form method="POST" action="{{ route('client.annonce.store') }}" enctype="multipart/form-data">

        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>

      <div class="mb-3">
    <label for="localisation">Localisation</label>
    <input type="text" name="localisation" class="form-control" required>
</div>


        <div class="mb-3">
            <label for="prix" class="form-label">Prix (FCFA)</label>
            <input type="number" class="form-control" id="prix" name="prix" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
        <label for="image" class="form-label">Image de l'annonce</label>
        <input type="file" class="form-control" name="image" id="image" accept="image/*">
    </div>


        <button type="submit" class="btn btn-success">Publier</button>
    </form>
</div>
@endsection
