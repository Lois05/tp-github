@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-5 fw-bold text-primary">Bienvenue, {{ $user->prenom ?? $user->name }} 👋</h2>

    {{-- Alertes --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $cards = [
            [
                'route' => route('proprietaire.annonces.index'),
                'icon' => 'bi-megaphone-fill text-warning',
                'title' => 'Mes annonces',
                'badge' => $annonces->count().' publiées',
                'desc' => 'Gérez toutes vos annonces ici',
            ],
            [
                'route' => route('client.annonce.create'),
                'icon' => 'bi-plus-circle-fill text-success',
                'title' => 'Nouvelle annonce',
                'badge' => false,
                'desc' => 'Ajoutez une nouvelle annonce',
            ],
            [
                'route' => route('locataire.demandes.envoyees'),
                'icon' => 'bi-send-check-fill text-info',
                'title' => 'Demandes envoyées',
                'badge' => $demandes->count().' envoyées',
                'desc' => 'Suivez vos demandes en cours',
            ],
            [
                'route' => route('proprietaire.demandes.recues'),
                'icon' => 'bi-inbox-fill text-danger',
                'title' => 'Demandes reçues',
                'badge' => $demandesRecues->count().' reçues',
                'desc' => 'Consultez les réservations reçues',
            ],
            [
                'route' => route('proprietaire.avis.recus'),
                'icon' => 'bi-star-fill text-warning',
                'title' => 'Avis reçus',
                'badge' => $avis->count().' avis',
                'desc' => 'Visualisez vos retours utilisateurs',
            ],
            [
                'route' => route('portefeuille.index'),
                'icon' => 'bi-wallet-fill text-primary',
                'title' => 'Mon portefeuille',
                'badge' => number_format($portefeuille->solde ?? 0, 0, ',', ' ').' FCFA',
                'desc' => 'Consultez vos finances',
            ],
            [
                'route' => route('monprofil.index'),
                'icon' => 'bi-person-circle text-secondary',
                'title' => 'Mon profil',
                'badge' => false,
                'desc' => 'Modifier vos informations personnelles',
            ],
            [
                'route' => '#', // futur ajout
                'icon' => 'bi-bell-fill text-danger',
                'title' => 'Notifications',
                'badge' => '3 nouvelles',
                'desc' => 'Restez informé des nouveautés',
            ],
            [
    'route' => route('favoris.index'),
    'icon' => 'bi-heart-fill text-pink',
    'title' => 'Mes favoris',
    'badge' => auth()->user()->favoris->count().' enregistrés',
    'desc' => 'Consultez vos annonces aimées',
    
],

        ];
    @endphp

    <div class="row g-4">
        @foreach ($cards as $card)
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="{{ $card['route'] }}" class="text-decoration-none">
                    <div class="card dashboard-card text-center h-100 shadow-sm border-0 p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi {{ $card['icon'] }} fs-2"></i>
                        </div>
                        <h5 class="fw-bold mb-2 text-dark">{{ $card['title'] }}</h5>
                        @if ($card['badge'])
                            <span class="badge custom-badge">{{ $card['badge'] }}</span>
                        @endif
                        <p class="text-muted small mt-2">{{ $card['desc'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach

        {{-- Déconnexion --}}
        <div class="col-12 col-sm-6 col-lg-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="card dashboard-card text-center h-100 shadow-sm border-0 p-4 btn btn-link w-100">
                    <i class="bi bi-box-arrow-right fs-2 text-danger"></i>
                    <h5 class="fw-bold mb-2 text-danger">Se déconnecter</h5>
                    <p class="text-muted small mb-0">Fermer votre session</p>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Styles améliorés --}}
<style>
    .dashboard-card {
        transition: all 0.3s ease-in-out;
        border-radius: 1.25rem;
        background: #ffffff;
        border: 1px solid #f0f0f0;
    }

    .dashboard-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
    }

    .dashboard-card .icon-wrapper i {
        background: #f5f5f5;
        border-radius: 50%;
        padding: 1rem;
        display: inline-block;
    }

    .custom-badge {
        background-color: #e67e22;
        color: #fff;
        font-size: 0.8rem;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
    }

    @media (max-width: 768px) {
        .dashboard-card {
            padding: 2rem 1rem;
        }
    }

    .text-pink {
        color: #e84393;
    }
</style>
@endsection
