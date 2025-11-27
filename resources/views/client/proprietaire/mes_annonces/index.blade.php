@extends('layouts.client')

@section('title', 'Mes annonces')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">Mes annonces</h2>

    @if($annonces->isEmpty())
        <div class="text-center py-5">
            <p class="fs-5">Vous n'avez encore publié aucune annonce.</p>
            <a href="{{ route('client.annonce.create') }}" class="btn btn-primary btn-lg">Publier une annonce</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($annonces as $annonce)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                    <img src="{{ Str::startsWith($annonce->image, 'http') ? $annonce->image : asset('storage/' . $annonce->image) }}"
                            alt="{{ $annonce->titre }}" class="annonce-img">
                       


                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($annonce->titre, 40) }}</h5>
                            <p class="card-text mb-2 text-muted">
                                Catégorie: <strong>{{ $annonce->bien && $annonce->bien->categorie ? $annonce->bien->categorie->nom : 'Non spécifiée' }}</strong>
                            </p>
                            <p>
                                @switch($annonce->statut)
                                    @case('en_attente')
                                        <span class="badge bg-warning text-dark">En attente</span>
                                        @break
                                    @case('valide')
                                        <span class="badge bg-success">Publiée</span>
                                        @break
                                    @case('refuse')
                                        <span class="badge bg-danger">Refusée</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ ucfirst($annonce->statut) }}</span>
                                @endswitch
                            </p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('proprietaire.annonces.show', $annonce->id) }}" class="btn btn-sm btn-info">Voir</a>
                                <a href="{{ route('proprietaire.annonces.edit', $annonce->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('proprietaire.annonces.destroy', $annonce->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')" class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
    {{ $annonces->links() }}
</div>


        <div class="d-flex justify-content-center mt-4">
            {{ $annonces->links() }}
        </div>
    @endif
</div>
@endsection
