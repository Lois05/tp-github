@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Bienvenue, {{ $user->prenom ?? $user->name }}</h2>

    <div class="row g-4">

        {{-- Bloc Annonces --}}
        <div class="col-md-4">
            <a href="{{ route('client.annonces.index') }}" class="card card-body text-center shadow-sm h-100">
                <h5 class="mb-2">📋 Mes annonces</h5>
                <p class="text-muted">Vous avez {{ $annonces->count() }} annonce(s) publiée(s)</p>
            </a>
        </div>

        {{-- Bloc Publier une annonce --}}
        <div class="col-md-4">
            <a href="{{ route('client.annonce.create') }}" class="card card-body text-center shadow-sm h-100">
                <h5 class="mb-2">➕ Publier une annonce</h5>
                <p class="text-muted">Ajoutez un nouveau bien à louer</p>
            </a>
        </div>

        {{-- Bloc Demandes --}}
        <div class="col-md-4">
            <a href="#" class="card card-body text-center shadow-sm h-100">
                <h5 class="mb-2">📨 Mes demandes</h5>
                <p class="text-muted">{{ $demandes->count() }} demande(s) en attente ou en cours</p>
            </a>
        </div>

        {{-- Bloc Avis --}}
        <div class="col-md-4">
            <a href="#" class="card card-body text-center shadow-sm h-100">
                <h5 class="mb-2">⭐ Mes avis reçus</h5>
                <p class="text-muted">{{ $avis->count() }} avis de la communauté</p>
            </a>
        </div>

        {{-- Bloc Profil --}}
        <div class="col-md-4">
            <a href="{{ route('profile.edit') }}" class="card card-body text-center shadow-sm h-100">
                <h5 class="mb-2">⚙️ Modifier mon profil</h5>
                <p class="text-muted">Mettez à jour vos informations personnelles</p>
            </a>
        </div>

        {{-- Bloc Déconnexion --}}
        <div class="col-md-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="card card-body text-center shadow-sm h-100 btn btn-link border-0">
                    <h5 class="mb-2 text-danger">🚪 Se déconnecter</h5>
                    <p class="text-muted">Terminer votre session</p>
                </button>
            </form>
        </div>

    </div>
</div>
@endsection

