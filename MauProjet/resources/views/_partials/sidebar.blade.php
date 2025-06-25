<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
  <div class="nk-sidebar-element nk-sidebar-head">
    <div class="nk-sidebar-brand">
      <a href="{{ url('admin') }}" class="logo-link nk-sidebar-logo">
        <img class="logo-light logo-img" src="./images/logo.png" alt="logo">
        <img class="logo-dark logo-img" src="./images/logo-dark.png" alt="logo-dark">
        <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" alt="logo-small">
      </a>
    </div>
    <div class="nk-menu-trigger me-n2">
      <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
      <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
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
            <a href="{{ url('admin') }}" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-speedometer"></em></span>
              <span class="nk-menu-text">Tableau de bord</span>
            </a>
          </li>

          <!-- Gestion des Utilisateurs -->
          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Utilisateurs</h6>
          </li>
          <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
              <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
              <span class="nk-menu-text">Gestion Utilisateurs</span>
            </a>
            <ul class="nk-menu-sub">
              <li class="nk-menu-item">
                <a href="{{ url('admin/users') }}" class="nk-menu-link">Liste des utilisateurs</a>
              </li>
              <li class="nk-menu-item">
                <a href="{{ url('admin/users/create') }}" class="nk-menu-link">Ajouter un utilisateur</a>
              </li>
              <li class="nk-menu-item">
                <a href="{{ url('admin/roles') }}" class="nk-menu-link">Gestion des rôles</a>
              </li>
            </ul>
          </li>

          <!-- Gestion des Annonces -->
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
                <a href="{{ url('admin/annonces') }}" class="nk-menu-link">Liste des annonces</a>
              </li>
              <li class="nk-menu-item">
                <a href="{{ url('admin/annonces/create') }}" class="nk-menu-link">Ajouter une annonce</a>
              </li>
              <li class="nk-menu-item">
                <a href="{{ url('admin/categories') }}" class="nk-menu-link">Catégories</a>
              </li>
            </ul>
          </li>

          <!-- Gestion des Litiges -->
          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Litiges</h6>
          </li>
          <li class="nk-menu-item">
            <a href="{{ url('admin/litiges') }}" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-alert-circle-fill"></em></span>
              <span class="nk-menu-text">Gestion des litiges</span>
            </a>
          </li>

          <!-- Quittances -->
          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Quittances</h6>
          </li>
          <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
              <span class="nk-menu-icon"><em class="icon ni ni-file-text-fill"></em></span>
              <span class="nk-menu-text">Gestion des quittances</span>
            </a>
            <ul class="nk-menu-sub">
              <li class="nk-menu-item">
                <a href="{{ url('admin/quittances') }}" class="nk-menu-link">Liste des quittances</a>
              </li>
              <li class="nk-menu-item">
                <a href="{{ url('admin/quittances/create') }}" class="nk-menu-link">Créer une quittance</a>
              </li>
            </ul>
          </li>

          <!-- Statistiques -->
          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Statistiques</h6>
          </li>
          <li class="nk-menu-item">
            <a href="{{ url('admin/statistiques') }}" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-chart-bar-fill"></em></span>
              <span class="nk-menu-text">Tableaux de bord statistiques</span>
            </a>
          </li>

          <!-- Paramètres -->
          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Paramètres</h6>
          </li>
          <li class="nk-menu-item">
            <a href="{{ url('admin/settings') }}" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
              <span class="nk-menu-text">Paramètres généraux</span>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </div>
</div>
