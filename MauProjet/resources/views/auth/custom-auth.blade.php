@extends('layouts.client')

@section('content')
<style>
    .auth-container {
        max-width: 450px;
        margin: 50px auto;
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .auth-container h2 {
        text-align: center;
        margin-bottom: 1rem;
    }

    .toggle-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
    }

    .auth-form {
        display: none;
    }

    .auth-form.active {
        display: block;
        animation: fade 0.4s ease-in-out;
    }

    @keyframes fade {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<header class="hero text-center py-4">
    <div class="container">
        <h1 class="mb-2">Louez tout ce dont vous avez besoin</h1>
        <p class="mb-3">LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens, hors immobilier.</p>
        <a href="{{ route('client.annonces.index') }}" class="btn btn-primary">Voir les annonces</a>
    </div>
</header>

<div class="container">
    <div class="auth-container">

        {{-- Connexion --}}
        <form method="POST" action="{{ route('auth.login') }}" id="loginForm" class="auth-form active">
            @csrf
            <h2>Connexion</h2>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>

            <span class="toggle-link" onclick="toggleForm()">Pas encore de compte ? S'inscrire</span>
        </form>

        {{-- Inscription --}}
        <form method="POST" action="{{ route('auth.register') }}" id="registerForm" class="auth-form">
            @csrf
            <h2>Inscription</h2>

            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Type de compte -->
            <div class="mb-3">
                <label>Type de compte</label>
                <select name="type_compte" id="typeCompte" class="form-select" required>
                    <option value="particulier" selected>Particulier</option>
                    <option value="entreprise">Entreprise</option>
                </select>
            </div>

            <!-- Champ entreprise -->
            <div class="mb-3 d-none" id="entrepriseField">
                <label>Nom de l’entreprise</label>
                <input type="text" name="nom_entreprise" class="form-control">
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirmer mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">S'inscrire</button>

            <span class="toggle-link" onclick="toggleForm()">Déjà inscrit ? Se connecter</span>
        </form>
    </div>
</div>

<script>
    function toggleForm() {
        document.getElementById('loginForm').classList.toggle('active');
        document.getElementById('registerForm').classList.toggle('active');
    }

    const typeCompte = document.getElementById('typeCompte');
    const entrepriseField = document.getElementById('entrepriseField');

    typeCompte.addEventListener('change', function() {
        if (this.value === 'entreprise') {
            entrepriseField.classList.remove('d-none');
        } else {
            entrepriseField.classList.add('d-none');
        }
    });
</script>
@endsection
