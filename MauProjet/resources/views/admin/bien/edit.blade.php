@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Modifier le Bien : {{ $bien->nom }}</h1>

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

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $bien->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $bien->description) }}</textarea>
        </div>


        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-control">
                <option value="">-- Sélectionnez une catégorie --</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id', $bien->categorie_id) == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
