@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1>Détails de l'annonce</h1>

    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Localisation :</strong> {{ $annonce->localisation }}</p>
            <p><strong>Prix :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut :</strong>
                @if($annonce->statut === 'disponible')
                    <span class="badge bg-success">Disponible</span>
                @else
                    <span class="badge bg-danger">Indisponible</span>
                @endif
            </p>
            <p><strong>Créée le :</strong> {{ $annonce->created_at->format('d/m/Y à H:i') }}</p>

            <a href="{{ route('admin.annonces.edit', $annonce) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary ms-2">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
