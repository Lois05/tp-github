{{-- header.blade.php --}}

<div class="nk-header nk-header-fixed is-light">
    <style>
        /* Mode sombre */
        body.dark-mode {
            background-color: #121212;
            color: #eee;
        }
        body.dark-mode .nk-header,
        body.dark-mode .nk-header-wrap {
            background-color: #1e1e1e !important;
            color: #eee;
        }
        body.dark-mode .form-control {
            background-color: #333;
            color: #eee;
            border-color: #555;
        }
        body.dark-mode .form-control::placeholder {
            color: #bbb;
        }
        body.dark-mode .btn-outline-secondary {
            color: #ccc;
            border-color: #555;
        }
        body.dark-mode .btn-outline-secondary:hover {
            background-color: #555;
            color: white;
        }
        body.dark-mode .dropdown-menu {
            background-color: #222;
            color: #eee;
        }
        body.dark-mode .user-card {
            background-color: #333;
            color: #eee;
        }
    </style>

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

            <!-- Recherche fonctionnelle -->
            <div class="nk-header-news d-none d-md-block">
                <div class="form-control-wrap">
                    <form action="{{ route('admin.annonces.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="form-icon form-icon-left">
                            <em class="icon ni ni-search"></em>
                        </div>
                        <input
                            type="text"
                            name="search"
                            class="form-control form-control-sm"
                            placeholder="Rechercher..."
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="btn btn-sm btn-primary ms-2">OK</button>
                    </form>
                </div>
            </div>

            <!-- Actions utilisateur + Dark Mode Toggle -->
            <div class="nk-header-tools d-flex align-items-center">
                <ul class="nk-quick-nav d-flex align-items-center gap-2">
                    {{-- Bouton Toggle Dark Mode --}}
                    <li class="nav-item">
                        <button id="toggleDarkMode" class="btn btn-sm btn-outline-secondary" title="Passer en mode sombre">
                            <em class="icon ni ni-moon"></em>
                        </button>
                    </li>

                    {{-- Menu utilisateur --}}
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle d-flex align-items-center">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-md-block ms-2">
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

    {{-- Script toggle dark mode --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleDarkMode');
            const body = document.body;

            // Appliquer mode sombre si déjà activé
            if(localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark-mode');
            }

            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                body.classList.toggle('dark-mode');
                if(body.classList.contains('dark-mode')) {
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    localStorage.removeItem('darkMode');
                }
            });
        });
    </script>
</div>
