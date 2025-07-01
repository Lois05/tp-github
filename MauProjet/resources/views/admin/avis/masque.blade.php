@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Avis masqués</h1>

    @if($avis->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Annonce</th>
                    <th>Utilisateur</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($avis as $avisItem)
                    <tr>
                        <td>{{ $avisItem->annonce->localisation ?? 'Annonce supprimée' }}</td>
                        <td>{{ $avisItem->user->nom ?? 'Utilisateur inconnu' }}</td>
                        <td>{{ $avisItem->note }}/5</td>
                        <td>{{ Str::limit($avisItem->commentaire, 50) }}</td>
                        <td>{{ $avisItem->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.avis.toggle', $avisItem) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Rendre visible</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun avis masqué.</p>
    @endif

    <a href="{{ route('admin.avis.index') }}" class="btn btn-secondary mt-3">← Retour aux avis par annonce</a>
</div>
@endsection
