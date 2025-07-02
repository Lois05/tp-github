@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Tous les avis par annonce</h1>

        @foreach ($annonces as $annonce)
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Annonce : {{ $annonce->localisation }}</strong>
                    <span class="badge bg-primary ms-2">{{ $annonce->avis_count }} avis</span>
                </div>
                <div class="card-body p-0">
                    @if ($annonce->avis->count())
                        <table class="table mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Note</th>
                                    <th>Commentaire</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($annonce->avis as $avis)
                                    <tr>
                                        <td>{{ $avis->user->nom ?? 'Utilisateur inconnu' }}</td>
                                        <td>{{ $avis->note }}/5</td>
                                        <td>{{ Str::limit($avis->commentaire, 60) }}</td>
                                        <td>
                                            @if ($avis->masque)
                                                <span class="badge bg-danger">Masqué</span>
                                            @else
                                                <span class="badge bg-success">Visible</span>
                                            @endif
                                        </td>
                                        <td>{{ $avis->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.avis.toggle', $avis) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="btn btn-sm {{ $avis->masque ? 'btn-success' : 'btn-warning' }}">
                                                    {{ $avis->masque ? 'Afficher' : 'Masquer' }}
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="p-3">Aucun avis pour cette annonce.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
