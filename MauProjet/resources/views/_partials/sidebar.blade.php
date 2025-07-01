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
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
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
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Tableau de bord</span>
                        </a>
                    </li>

                    <!-- Annonces -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Annonces</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-megaphone-fill"></em></span>
                            <span class="nk-menu-text">Gestion des Annonces</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.annonce.index') }}" class="nk-menu-link">Toutes les
                                    annonces</a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.annonce.create') }}" class="nk-menu-link">Ajouter une
                                    annonce</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Catégories -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.categorie-bien.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-list-thumb"></em></span>
                            <span class="nk-menu-text">Catégories de biens</span>
                        </a>
                    </li>

                    <!-- Biens -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.bien.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                            <span class="nk-menu-text">Biens disponibles</span>
                        </a>
                    </li>

                    <!-- Modules à venir -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">À venir</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link disabled" title="En développement">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Gestion utilisateurs</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link disabled" title="En développement">
                            <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                            <span class="nk-menu-text">Paiements & commissions</span>
                        </a>
                    </li>

                    <!-- Signalements -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.avis.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-alert-circle"></em></span>
                            <span class="nk-menu-text">Signalements</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link disabled" title="En développement">
                            <span class="nk-menu-icon"><em class="icon ni ni-chart-bar"></em></span>
                            <span class="nk-menu-text">Statistiques</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
