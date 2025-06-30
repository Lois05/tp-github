@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Avis signalés par les propriétaires</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>User</th>
                <th>Annonce</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($avis as $avisItem)
                <tr>
                    <td>{{ $avisItem->id }}</td>
                    <td>{{ $avisItem->bien->nom ?? 'Bien supprimé' }}</td>
                    <td>{{ $avisItem->user->nom ?? 'Utilisateur inconnu' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $avisItem->note }}/5</span></td>
                    <td>{{ Str::limit($avisItem->commentaire, 60) }}</td>
                    <td>{{ $avisItem->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('admin.avis.destroy', $avisItem) }}" method="POST" onsubmit="return confirm('Supprimer cet avis signalé ?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Aucun avis signalé pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
