@extends('layouts.admin')

@section('title', 'Modifier le Bien')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modifier le Bien</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.biens.update', $bien) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Bien</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $bien->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $bien->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-select">
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ (old('categorie_id', $bien->categorie_id) == $categorie->id) ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Champ état si existant --}}
        <div class="mb-3">
            <label for="etat" class="form-label">État</label>
            <select name="etat" id="etat" class="form-select">
                <option value="disponible" {{ (old('etat', $bien->etat) == 'disponible') ? 'selected' : '' }}>Disponible</option>
                <option value="loué" {{ (old('etat', $bien->etat) == 'loué') ? 'selected' : '' }}>Loué</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection
