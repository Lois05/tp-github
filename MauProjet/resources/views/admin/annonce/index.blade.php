@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Annonces en attente de validation</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Localisation</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Soumise le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($annonces as $annonce)
                <tr>
                    <td>{{ $annonce->id }}</td>
                    <td>{{ $annonce->localisation }}</td>
                    <td>{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @if($annonce->statut === 'validee')
                            <span class="badge bg-success">Validée</span>
                        @elseif($annonce->statut === 'rejetee')
                            <span class="badge bg-danger">Rejetée</span>
                        @else
                            <span class="badge bg-secondary">En attente</span>
                        @endif
                    </td>
                    <td>{{ $annonce->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.annonce.show', $annonce) }}" class="btn btn-sm btn-info">Voir</a>

                        @if($annonce->statut === 'en_attente')
                            <a href="{{ route('admin.annonce.edit', $annonce) }}" class="btn btn-sm btn-primary">Valider / Rejeter</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Aucune annonce trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
