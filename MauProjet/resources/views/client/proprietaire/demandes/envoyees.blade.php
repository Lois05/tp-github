@extends('layouts.client')

@section('title', 'Mes demandes envoyées')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Mes demandes envoyées</h2>

        @forelse ($mesDemandes as $demande)
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Annonce ID :</strong> {{ $demande->annonce_id }}</p>
                    <p><strong>Date début :</strong> {{ $demande->date_debut }}</p>
                    <p><strong>Date fin :</strong> {{ $demande->date_fin }}</p>
                    <p><strong>Message :</strong> {{ $demande->message }}</p>
                </div>
            </div>
        @empty
            <p>Vous n'avez pas encore envoyé de demandes.</p>
        @endforelse
    </div>
@endsection
