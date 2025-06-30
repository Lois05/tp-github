{{-- HEADER.BLADE.PHP --}}
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <!-- Logo et menu burger -->
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                    <em class="icon ni ni-menu"></em>
                </a>
            </div>

            <div class="nk-header-brand d-xl-none">
                <a href="{{ route('admin.index') }}" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/logo-small.png') }}" alt="logo">
                </a>
            </div>

            <!-- Recherche -->
            <div class="nk-header-news d-none d-md-block">
                <div class="form-control-wrap">
                    <form action="#" method="GET">
                        <div class="form-icon form-icon-left">
                            <em class="icon ni ni-search"></em>
                        </div>
                        <input type="text" class="form-control form-control-sm" placeholder="Rechercher...">
                    </form>
                </div>
            </div>

            <!-- Actions utilisateur -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">Administrateur</div>
                                    <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>AD</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ Auth::user()->name ?? 'Admin' }}</span>
                                        <span class="sub-text">{{ Auth::user()->email ?? 'admin@email.com' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="#"><em class="icon ni ni-user-alt"></em><span>Profil</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Paramètres</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-signout"></em><span>Déconnexion</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
