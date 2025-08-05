@extends('layouts.client')

@section('title', 'Mon Espace Personnel')

@section('content')
<div class="container py-5">

    <h1 class="mb-4 fw-bold">👤 Mon Espace Personnel</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row g-4">
        <!-- Section Profil -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <!-- Avatar avec upload possible (placeholder avec initiales si pas d’image) -->
                    <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle img-fluid" style="width: 140px; height: 140px; object-fit: cover;">
                        @else
                            <div class="avatar-placeholder rounded-circle bg-primary text-white d-flex justify-content-center align-items-center fs-1 fw-bold" style="width: 140px; height: 140px;">
                                {{ strtoupper(substr($user->prenom,0,1).substr($user->nom,0,1)) }}
                            </div>
                        @endif
                    </div>

                    <h3 class="fw-bold mb-0">{{ $user->prenom }} {{ $user->nom }}</h3>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    <!-- Badges vérifications -->
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @if($user->email_verified_at)
                            <span class="badge bg-success" data-bs-toggle="tooltip" title="Email vérifié">
                                <i class="bi bi-envelope-check-fill"></i> Email vérifié
                            </span>
                        @else
                            <span class="badge bg-warning text-dark" data-bs-toggle="tooltip" title="Email non vérifié">
                                <i class="bi bi-envelope-exclamation-fill"></i> Email non vérifié
                            </span>
                        @endif

                        @if($user->profile_certified ?? false)
                            <span class="badge bg-info text-white" data-bs-toggle="tooltip" title="Profil certifié">
                                <i class="bi bi-patch-check-fill"></i> Certifié
                            </span>
                        @endif

                        {{-- Exemple d’autres badges possibles --}}
                        {{-- <span class="badge bg-primary" title="Téléphone vérifié"><i class="bi bi-phone-fill"></i> Téléphone</span> --}}
                    </div>

                    <div class="mt-4 d-flex justify-content-center gap-3">
                        <a href="{{ route('monprofil.edit') }}" class="btn btn-outline-primary btn-sm">Modifier profil</a>
                        <a href="{{ route('password.change') }}" class="btn btn-outline-secondary btn-sm">Changer mot de passe</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section détails et édition rapide -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('monprofil.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom', $user->nom) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>

            <!-- Certifications / Vérifications détaillées -->
            <div class="card shadow-sm mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Certifications & Vérifications</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-envelope-check-fill text-success fs-4 me-3"></i>
                            Email vérifié
                            <span class="ms-auto badge rounded-pill bg-success">{{ $user->email_verified_at ? 'Oui' : 'Non' }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-patch-check-fill text-info fs-4 me-3"></i>
                            Profil certifié
                            <span class="ms-auto badge rounded-pill bg-info text-white">{{ ($user->profile_certified ?? false) ? 'Oui' : 'Non' }}</span>
                        </li>
                        {{-- Ajouter d'autres vérifications si besoin --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Init Bootstrap Tooltip -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

<style>
    .avatar-placeholder {
        user-select: none;
        font-weight: 700;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection
