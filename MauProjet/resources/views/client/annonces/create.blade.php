@extends('layouts.client')

@section('title', 'Publier une nouvelle annonce')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Publier une nouvelle annonce</h2>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.annonce.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control @error('titre') is-invalid @enderror"
                   id="titre"
                   name="titre"
                   value="{{ old('titre') }}"
                   required
                   placeholder="Entrez le titre de votre annonce">
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
            <select name="categorie_id"
                    id="categorie_id"
                    class="form-select @error('categorie_id') is-invalid @enderror"
                    required>
                <option value="" disabled selected>-- Choisissez une catégorie --</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="localisation" class="form-label">Localisation <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control @error('localisation') is-invalid @enderror"
                   id="localisation"
                   name="localisation"
                   value="{{ old('localisation') }}"
                   required
                   placeholder="Exemple : Cotonou, Porto-Novo">
            @error('localisation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Optionnel : état du bien --}}
        <div class="mb-3">
            <label for="etat" class="form-label">État du bien</label>
            <select name="etat" id="etat" class="form-select @error('etat') is-invalid @enderror">
                <option value="" disabled selected>-- Choisissez un état (optionnel) --</option>
                <option value="disponible" {{ old('etat') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="loué" {{ old('etat') == 'loué' ? 'selected' : '' }}>Loué</option>
                <option value="en maintenance" {{ old('etat') == 'en maintenance' ? 'selected' : '' }}>En maintenance</option>
                <option value="indisponible" {{ old('etat') == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
            </select>
            @error('etat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (FCFA) <span class="text-danger">*</span></label>
            <input type="number"
                   class="form-control @error('prix') is-invalid @enderror"
                   id="prix"
                   name="prix"
                   value="{{ old('prix') }}"
                   min="0"
                   required
                   placeholder="Exemple : 50000">
            @error('prix')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror"
                      id="description"
                      name="description"
                      rows="5"
                      required
                      placeholder="Décrivez votre bien en quelques mots...">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image de l'annonce (optionnel)</label>
            <input type="file"
                   class="form-control @error('image') is-invalid @enderror"
                   name="image"
                   id="image"
                   accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Publier</button>
    </form>
</div>
@endsection
