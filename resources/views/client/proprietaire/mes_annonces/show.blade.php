@extends('layouts.app')

@section('content')
    <h1>Détail de l'annonce</h1>

    <p><strong>Titre :</strong> {{ $annonce->titre }}</p>
    <p><strong>Description :</strong> {{ $annonce->description }}</p>
    <p><strong>Catégorie :</strong> {{ $annonce->categorie->nom ?? 'Non défini' }}</p>
    <p><strong>Statut :</strong> {{ ucfirst($annonce->statut) }}</p>

    <a href="{{ route('proprietaire.annonces.edit', $annonce) }}">Modifier</a> |
    <a href="{{ route('proprietaire.annonces.index') }}">Retour à mes annonces</a>
@endsection
