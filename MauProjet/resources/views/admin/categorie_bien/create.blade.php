@extends('layouts.admin')

@section('title', 'Ajouter une catégorie')

@section('content')
<div class="container mt-4">
    <h1>Ajouter une nouvelle catégorie</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categorie.store') }}" method="POST">
        @csrf
        @include('admin.categorie_bien._partial.form')

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('admin.categorie.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
