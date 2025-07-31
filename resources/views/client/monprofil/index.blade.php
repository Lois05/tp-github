@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">👤 Mon Espace Personnel</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Informations actuelles</h5>
            <p><strong>Nom :</strong> {{ $user->nom }}</p>
            <p><strong>Prénom :</strong> {{ $user->prenom }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">✏️ Modifier mes infos</h5>

            <form method="POST" action="{{ route('monprofil.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ $user->nom }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection
