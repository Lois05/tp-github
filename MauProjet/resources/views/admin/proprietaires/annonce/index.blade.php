@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h1>Liste des Annonces</h1>

    <a href="{{ route('admin.annonces.create') }}" class="btn btn-primary mb-3">Ajouter une annonce</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Exemple statique, à remplacer par une boucle dynamique --}}
                <tr>
                    <td>1</td>
                    <td>Appartement à louer</td>
                    <td>150000 FCFA</td>
                    <td>
                        <a href="{{ route('admin.annonces.show', ['id' => 1]) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.annonces.edit', ['id' => 1]) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
                {{-- Fin exemple --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
