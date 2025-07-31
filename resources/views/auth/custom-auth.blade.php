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
        <p class="mb-3">LocaPlus connecte locataires et propriétaires au Bénin pour tout type de biens.</p>
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

            <!-- USERS -->
            <div class="mb-3">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Type de compte physique/moral -->
            <div class="mb-3">
                <label>Type de personne</label>
                <select name="type_personne" id="type_personne" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <option value="physique">Personne physique</option>
                    <option value="moral">Personne morale</option>
                </select>
            </div>

            <!-- Champs spécifique physique -->
            <div id="physiqueFields" style="display: none;">
                <div class="mb-3">
                    <label>Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control">
                </div>
                <div class="mb-3">
                    <label>NPI</label>
                    <input type="text" name="npi" class="form-control">
                </div>
            </div>

            <!-- Champs spécifique moral -->
            <div id="moralFields" style="display: none;">
                <div class="mb-3">
                    <label>Raison sociale</label>
                    <input type="text" name="raison_sociale" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Registre de commerce</label>
                    <input type="text" name="registre_commerce" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Représentant légal</label>
                    <input type="text" name="representant_legal" class="form-control">
                </div>
            </div>

            <!-- Mot de passe -->
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

    const typePersonne = document.getElementById('type_personne');
    const physiqueFields = document.getElementById('physiqueFields');
    const moralFields = document.getElementById('moralFields');

    typePersonne.addEventListener('change', function() {
        if (this.value === 'physique') {
            physiqueFields.style.display = 'block';
            moralFields.style.display = 'none';
        } else if (this.value === 'moral') {
            physiqueFields.style.display = 'none';
            moralFields.style.display = 'block';
        } else {
            physiqueFields.style.display = 'none';
            moralFields.style.display = 'none';
        }
    });
</script>
@endsection
