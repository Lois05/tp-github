@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifier l'annonce</h1>

    <form action="#" method="POST">
        @csrf
        {{-- Si tu gères PUT dans controller plus tard --}}
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre', 'Titre actuel') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', 'Description actuelle') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" id="prix" name="prix" class="form-control" value="{{ old('prix', '10000') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection
