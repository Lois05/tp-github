@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Créer une nouvelle annonce</h1>

    <form action="#" method="POST">
        {{-- csrf token si tu ajoutes un controller plus tard --}}
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" placeholder="Titre de l'annonce" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Description détaillée" required></textarea>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" id="prix" name="prix" class="form-control" placeholder="Prix en FCFA" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection
