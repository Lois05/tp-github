@extends('layouts.admin')

@section('title', 'Modifier la catégorie')

@section('content')
<div class="container mt-4">
    <h1>Modifier la catégorie</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categorie.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.categorie_bien._partial.form')

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.categorie.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
