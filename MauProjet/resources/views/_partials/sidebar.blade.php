<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.index') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('images/logo-small.png') }}"
                    alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>

    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">

                    <!-- Dashboard -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboard</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-tachometer-alt"></i></span>
                            <span class="nk-menu-text">Tableau de bord</span>
                        </a>
                    </li>

                    <!-- Annonces -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Annonces</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.annonces.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-bullhorn"></i></span>
                            <span class="nk-menu-text">Gestion des annonces</span>
                        </a>
                    </li>

                    <!-- Catégories -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.categorie-bien.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-th-list"></i></span>
                            <span class="nk-menu-text">Catégories de biens</span>
                        </a>
                    </li>

                    <!-- Biens -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.biens.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-boxes"></i></span>
                            <span class="nk-menu-text">Biens disponibles</span>
                        </a>
                    </li>

                    <!-- Avis -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.avis.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-comments"></i></span>
                            <span class="nk-menu-text">Avis</span>
                        </a>
                    </li>

                    <!-- Signalements (désactivé pour l’instant) -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class="nk-menu-text">Signalements</span>
                        </a>
                    </li>

                    <!-- Statistiques (désactivé pour l’instant) -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-chart-bar"></i></span>
                            <span class="nk-menu-text">Statistiques</span>
                        </a>
                    </li>

                    <!-- Utilisateurs -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.users.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fas fa-users"></i></span>
                            <span class="nk-menu-text">Gestion utilisateurs</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
