@extends('layouts.admin')

@section('title', 'Modifier utilisateur')

@section('content')
<div class="container py-4">

    <h1 class="mb-4">Modifier utilisateur : {{ $user->prenom }} {{ $user->nom }}</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Des erreurs ont été détectées :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de modification --}}
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $user->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $user->telephone) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
