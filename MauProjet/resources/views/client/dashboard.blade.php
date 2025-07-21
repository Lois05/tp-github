@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Bonjour {{ $user->prenom ?? $user->name }} 👋</h2>

    {{-- Alertes --}}
    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Mes Annonces --}}
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('proprietaire.annonces.index') }}" class="text-decoration-none" aria-label="Mes annonces">
                <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
                    <i class="bi bi-megaphone-fill fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold mb-2">Mes annonces</h5>
                    <span class="badge bg-primary mb-2">{{ $annonces->count() }} publiées</span>
                    <p class="text-muted small mb-0">Gérez vos annonces</p>
                </div>
            </a>
        </div>

        {{-- Nouvelle annonce --}}
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('client.annonce.create') }}" class="text-decoration-none" aria-label="Publier une nouvelle annonce">
                <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
                    <i class="bi bi-plus-circle-fill fs-1 text-success mb-3"></i>
                    <h5 class="fw-bold mb-2">Nouvelle annonce</h5>
                    <p class="text-muted small mb-0">Publiez un bien</p>
                </div>
            </a>
        </div>

        {{-- Mes demandes envoyées --}}
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('locataire.demandes.envoyees') }}" class="text-decoration-none" aria-label="Mes demandes envoyées">
                <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
                    <i class="bi bi-inbox-fill fs-1 text-info mb-3"></i>
                    <h5 class="fw-bold mb-2">Mes demandes envoyées</h5>
                    <span class="badge bg-primary mb-2">{{ $demandes->count() }} envoyées</span>
                    <p class="text-muted small mb-0">Suivez vos demandes</p>
                </div>
            </a>
        </div>

       {{-- Mes demandes reçues --}}
<div class="col-md-6 col-lg-4">
    <a href="{{ route('proprietaire.demandes.recues') }}" class="text-decoration-none" aria-label="Mes demandes reçues">
        <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
            <i class="bi bi-envelope-open-fill fs-1 text-secondary mb-3"></i>
            <h5 class="fw-bold mb-2">Mes demandes reçues</h5>
            <span class="badge bg-primary mb-2">{{ $demandesRecues->count() }} reçues</span>
            <p class="text-muted small mb-0">Voir les réservations</p>
        </div>
    </a>
</div>


        {{-- Avis reçus --}}
        <div class="col-md-6 col-lg-4">
            <a href="#" class="text-decoration-none" aria-label="Avis reçus">
                <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
                    <i class="bi bi-star-fill fs-1 text-warning mb-3"></i>
                    <h5 class="fw-bold mb-2">Avis reçus</h5>
                    <span class="badge bg-warning text-dark mb-2">{{ $avis->count() }} avis</span>
                    <p class="text-muted small mb-0">Consultez vos notes</p>
                </div>
            </a>
        </div>

        {{-- Mon portefeuille --}}
      <div class="col-md-6 col-lg-4">
    <a href="{{ route('portefeuille.index') }}" class="text-decoration-none" aria-label="Mon portefeuille">
        <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
            <i class="bi bi-wallet-fill fs-1 text-success mb-3"></i>
            <h5 class="fw-bold mb-2">Mon portefeuille</h5>
            <span class="badge bg-success mb-2">
                {{ number_format($portefeuille->solde ?? 48750, 0, ',', ' ') }} FCFA
            </span>
            <p class="text-muted small mb-0">Gérez votre solde</p>
        </div>
    </a>
</div>

        {{-- Profil --}}
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('monprofil.index') }}" class="text-decoration-none" aria-label="Modifier mon profil">
                <div class="card shadow-sm border-0 h-100 p-4 text-center hover-scale">
                    <i class="bi bi-person-circle fs-1 text-dark mb-3"></i>
                    <h5 class="fw-bold mb-2">Profil</h5>
                    <p class="text-muted small mb-0">Mettez à jour vos infos</p>
                </div>
            </a>
        </div>

        {{-- Déconnexion --}}
        <div class="col-md-6 col-lg-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="card shadow-sm border-0 h-100 p-4 text-center btn btn-link w-100 text-decoration-none" aria-label="Se déconnecter">
                    <i class="bi bi-box-arrow-right fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold mb-2 text-danger">Se déconnecter</h5>
                    <p class="text-muted small mb-0">Fermer la session</p>
                </button>
            </form>
        </div>

    </div>
</div>

{{-- Optionnel : Ajout d’un petit effet hover --}}
<style>
.hover-scale:hover {
    transform: scale(1.03);
    transition: transform 0.2s ease-in-out;
    cursor: pointer;
}
</style>
@endsection

