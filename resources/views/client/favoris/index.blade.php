@extends('layouts.client')

@section('title', 'Mes favoris')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Mes annonces favorites</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($favoris->isEmpty())
        <p>Vous n'avez aucune annonce en favoris.</p>
    @else
        <div class="row g-4">
            @foreach($favoris as $favori)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $favori->annonce->image) }}" class="card-img-top" alt="{{ $favori->annonce->titre }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $favori->annonce->titre }}</h5>
                            <p class="card-text">{{ number_format($favori->annonce->prix, 0, ',', ' ') }} FCFA / jour</p>
                            <a href="{{ route('client.annonces.show', $favori->annonce->id) }}" class="btn btn-primary">Voir l'annonce</a>

                            <form action="{{ route('favoris.destroy', $favori->id) }}" method="POST" class="d-inline-block ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
