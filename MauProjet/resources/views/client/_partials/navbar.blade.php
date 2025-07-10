<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a href="{{ route('client.home') }}" class="navbar-brand">LocaPlus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a href="{{ route('client.home') }}" class="nav-link {{ request()->routeIs('client.home') ? 'active' : '' }}">Accueil</a></li>
        <li class="nav-item"><a href="{{ route('client.annonces.index') }}" class="nav-link {{ request()->routeIs('client.annonces.*') ? 'active' : '' }}">Annonces</a></li>
        <li class="nav-item"><a href="{{ route('client.about') }}#about-section" class="nav-link">À propos</a></li>
        <li class="nav-item"><a href="{{ route('client.contact') }}" class="nav-link {{ request()->routeIs('client.contact') ? 'active' : '' }}">Contact</a></li>
@auth
  <li class="nav-item ms-lg-3">
    <a href="{{ route('client.dashboard') }}" class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">Profil</a>


    </a>
  </li>
@else
  <li class="nav-item ms-lg-3">
    <a href="{{ route('auth.page') }}" class="btn btn-outline-primary px-4 py-2">Connexion/Inscription</a>
  </li>
@endauth


      </ul>
    </div>
  </div>
</nav>
