@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h1>Détails de l'annonce</h1>

        <div class="card mt-4">
            <div class="card-body">
                <p><strong>Titre :</strong> {{ $annonce->titre }}</p>
                <p><strong>Localisation :</strong> {{ $annonce->localisation }}</p>
                <p><strong>Prix :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>
                <p><strong>Statut actuel :</strong>
                    @if ($annonce->statut === 'validee')
                        <span class="badge bg-success">Validée</span>
                    @elseif($annonce->statut === 'rejetee')
                        <span class="badge bg-danger">Rejetée</span>
                    @else
                        <span class="badge bg-secondary">En attente</span>
                    @endif
                </p>
                <p><strong>Créée le :</strong> {{ $annonce->created_at->format('d/m/Y à H:i') }}</p>

                <!-- Valider -->
                <form id="form-valider" action="{{ route('admin.annonces.valider', $annonce->id) }}" method="POST"
                    class="d-none">
                    @csrf
                    @method('PUT')
                </form>
                <a href="#" class="btn btn-success"
                    onclick="event.preventDefault(); document.getElementById('form-valider').submit();">
                    <i class></i> Valider
                </a>

                <!-- Rejeter -->
                <form id="form-rejeter" action="{{ route('admin.annonces.rejeter', $annonce->id) }}" method="POST"
                    class="d-none">
                    @csrf
                    @method('PUT')
                </form>
                <a href="#" class="btn btn-danger"
                    onclick="event.preventDefault(); document.getElementById('form-rejeter').submit();">
                    <i class></i> Rejeter
                </a>
                <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary">Retour à la liste</a>

            </div>
        </div>
    </div>
@endsection
