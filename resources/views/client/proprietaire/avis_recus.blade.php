@extends('layouts.client')

@section('title', 'Mes avis reçus')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Mes avis reçus</h1>

        @if ($avisRecus->isEmpty())
            <p>Aucun avis reçu pour l'instant.</p>
        @else
            <ul class="list-group">
                @foreach ($avisRecus as $avis)
                    <li class="list-group-item">
                        <strong>Note :</strong> {{ $avis->note }} / 5<br>
                        <strong>Commentaire :</strong> {{ $avis->commentaire }}<br>
                        <strong>Annonce :</strong> {{ $avis->annonce->titre ?? 'Annonce supprimée' }}<br>
                        <strong>De :</strong> {{ $avis->user->prenom ?? 'Inconnu' }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
