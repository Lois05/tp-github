@extends('layouts.app')

@section('content')
    <h1>Mes annonces</h1>

    @if ($mesAnnonces->isEmpty())
        <p>Vous n'avez pas encore d'annonces publiées.</p>
        <a href="{{ route('proprietaire.annonces.create') }}">Publier une annonce</a>
    @else
        <ul>
            @foreach ($mesAnnonces as $annonce)
                <li>{{ $annonce->titre }} - {{ $annonce->statut }}</li>
            @endforeach
        </ul>
    @endif
@endsection
