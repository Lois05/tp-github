@extends('layouts.client')

@section('title', "Modifier l'annonce")

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Modifier l'annonce</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur :</strong> Veuillez corriger les champs ci-dessous.
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaire.annonces.update', $annonce) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
            <input 
                type="text" 
                name="titre" 
                id="titre" 
                class="form-control @error('titre') is-invalid @enderror" 
                value="{{ old('titre', $annonce->titre) }}" 
                required
                placeholder="Entrez le titre de l'annonce"
            >
            @error('titre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea 
                name="description" 
                id="description" 
                class="form-control @error('description') is-invalid @enderror" 
                rows="5" 
                required
                placeholder="Décrivez votre annonce"
            >{{ old('description', $annonce->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categorie_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
            <select 
    name="categorie_id" 
    id="categorie_id" 
    class="form-select @error('categorie_id') is-invalid @enderror" 
    required
>
    <option value="" disabled>-- Choisir une catégorie --</option>
    @foreach ($categories as $categorie)
        <option value="{{ $categorie->id }}" 
            {{ old('categorie_id', $annonce->bien->categorie_id) == $categorie->id ? 'selected' : '' }}>
            {{ $categorie->nom }}
        </option>
    @endforeach
</select>

            @error('categorie_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                💾 Enregistrer
            </button>
            <a href="{{ route('proprietaire.annonces.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
