@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Bonjour {{ $user->prenom ?? $user->name }} </h2>

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

    <div class="row g-4">
        {{-- Bloc réutilisable --}}
        @php
            $cards = [
                [
                    'route' => route('proprietaire.annonces.index'),
                    'icon' => 'bi-megaphone-fill',
                    'title' => 'Mes annonces',
                    'badge' => $annonces->count().' publiées',
                    'desc' => 'Gérez vos annonces',
                ],
                [
                    'route' => route('client.annonce.create'),
                    'icon' => 'bi-plus-circle-fill',
                    'title' => 'Nouvelle annonce',
                    'badge' => false,
                    'desc' => 'Publiez une annonce',
                ],
                [
                    'route' => route('locataire.demandes.envoyees'),
                    'icon' => 'bi-inbox-fill',
                    'title' => 'Mes demandes envoyées',
                    'badge' => $demandes->count().' envoyées',
                    'desc' => 'Suivez vos demandes',
                ],
                [
                    'route' => route('proprietaire.demandes.recues'),
                    'icon' => 'bi-envelope-open-fill',
                    'title' => 'Mes demandes reçues',
                    'badge' => $demandesRecues->count().' reçues',
                    'desc' => 'Voir les réservations',
                ],
                [
                    'route' => route('proprietaire.avis.recus'),
                    'icon' => 'bi-star-fill',
                    'title' => 'Avis reçus',
                    'badge' => $avis->count().' avis',
                    'desc' => 'Consultez vos notes',
                ],
                [
                    'route' => route('portefeuille.index'),
                    'icon' => 'bi-wallet-fill',
                    'title' => 'Mon portefeuille',
                    'badge' => number_format($portefeuille->solde ?? 48760, 0, ',', ' ').' FCFA',
                    'desc' => 'Gérez votre solde',
                ],
                [
                    'route' => route('monprofil.index'),
                    'icon' => 'bi-person-circle',
                    'title' => 'Profil',
                    'badge' => false,
                    'desc' => 'Mettez à jour vos infos',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ $card['route'] }}" class="text-decoration-none">
                    <div class="card dashboard-card text-center h-100 shadow-sm border-0 p-4">
                        <i class="bi {{ $card['icon'] }} fs-1"></i>
                        <h5 class="fw-bold mb-2">{{ $card['title'] }}</h5>
                        @if ($card['badge'])
                            <span class="badge mb-2">{{ $card['badge'] }}</span>
                        @endif
                        <p class="text-muted small mb-0">{{ $card['desc'] }}</p>
                    </div>
                </a>
            </div>
        @endforeach

        {{-- Déconnexion --}}
        <div class="col-12 col-md-6 col-lg-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="card dashboard-card text-center h-100 shadow-sm border-0 p-4 btn btn-link w-100">
                    <i class="bi bi-box-arrow-right fs-1"></i>
                    <h5 class="fw-bold mb-2 text-danger">Se déconnecter</h5>
                    <p class="text-muted small mb-0">Fermer la session</p>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Styles Dashboard --}}
<style>
    .dashboard-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 1rem;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }

    .dashboard-card i {
        color: #2c3e50; /* Bleu nuit */
    }

    .dashboard-card .badge {
        background: #e67e22; /* Orange LocaPlus */
        color: #fff;
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
        border-radius: 50rem;
    }

    @media (max-width: 768px) {
        .dashboard-card {
            padding: 2rem 1rem;
        }
    }
</style>
@endsection
