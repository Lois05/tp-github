<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - LocaPlus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Toutes les annonces</h1>

    @if($annonces->count())
        <div class="row">
            @foreach($annonces as $annonce)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        @if($annonce->image) {{-- supposer champ image --}}
                            <img src="{{ asset('storage/'.$annonce->image) }}" class="card-img-top" alt="{{ $annonce->titre }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $annonce->titre }}</h5>
                            <p class="card-text">{{ Str::limit($annonce->description, 100) }}</p>
                            <p class="text-success fw-bold">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</p>
                            <a href="#" class="btn btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $annonces->links() }}
        </div>

    @else
        <p>Aucune annonce disponible pour le moment.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
