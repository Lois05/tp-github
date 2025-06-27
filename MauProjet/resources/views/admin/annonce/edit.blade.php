@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1>Statut de l'annonce</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Localisation :</strong> {{ $annonce->localisation }}</p>
            <p><strong>Prix :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut actuel :</strong>
                @if($annonce->statut === 'validee')
                    <span class="badge bg-success">Validée</span>
                @elseif($annonce->statut === 'rejetee')
                    <span class="badge bg-danger">Rejetée</span>
                @else
                    <span class="badge bg-secondary">En attente</span>
                @endif
            </p>
        </div>
    </div>

    <form action="{{ route('admin.annonces.update', $annonce) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="statut">Mettre à jour le statut :</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="">-- Choisir --</option>
                <option value="validee" {{ old('statut', $annonce->statut) == 'validee' ? 'selected' : '' }}>Valider</option>
                <option value="rejetee" {{ old('statut', $annonce->statut) == 'rejetee' ? 'selected' : '' }}>Rejeter</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Confirmer</button>
        <a href="{{ route('admin.annonces.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection
