@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Liste des annonces</h1>

    <a href="{{ route('admin.annonces.create') }}" class="btn btn-primary mb-3">Créer une nouvelle annonce</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Exemple statique pour tester --}}
            <tr>
                <td>1</td>
                <td>Appartement à louer</td>
                <td>Bel appartement 2 pièces proche centre-ville.</td>
                <td>2025-06-25</td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Voir</a>
                    <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maison familiale</td>
                <td>Grande maison avec jardin à louer.</td>
                <td>2025-06-24</td>
                <td>
                    <a href="#" class="btn btn-sm btn-info">Voir</a>
                    <a href="#" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
