<style>
  /* ── Sidebar ── */
  .app-sidebar {
    background: var(--dark-bg) !important;
    border-right: 1px solid var(--gold-border) !important;
  }

  /* Brand */
  .sidebar-brand {
    border-bottom: 1px solid var(--gold-border) !important;
    padding: 14px 20px !important;
  }
  .brand-link {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    text-decoration: none !important;
  }
  .jw-brand-gem {
    width: 34px;
    height: 34px;
    border: 1.5px solid var(--gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 16px;
    flex-shrink: 0;
  }
  .jw-brand-texts { display: flex; flex-direction: column; line-height: 1.2; }
  .jw-brand-name {
    font-family: var(--font-display);
    font-size: 17px;
    color: var(--cream);
    font-weight: 500;
    letter-spacing: 1px;
  }
  .jw-brand-sub {
    font-size: 9px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--dark-muted);
  }

  /* Nav items */
  .sidebar-menu .nav-link {
    color: rgba(245,232,192,0.55) !important;
    border-radius: 8px !important;
    margin: 1px 8px !important;
    padding: 8px 12px !important;
    transition: background 0.18s, color 0.18s !important;
    font-size: 13px !important;
  }
  .sidebar-menu .nav-link:hover {
    background: var(--gold-dim) !important;
    color: var(--cream) !important;
  }
  .sidebar-menu .nav-link.active {
    background: rgba(212,175,55,0.18) !important;
    color: var(--gold) !important;
  }
  .sidebar-menu .nav-icon {
    color: inherit !important;
    font-size: 15px !important;
    margin-right: 2px !important;
  }

  /* Submenú treeview */
  .nav-treeview .nav-link {
    padding-left: 28px !important;
    font-size: 12px !important;
    color: rgba(245,232,192,0.4) !important;
  }
  .nav-treeview .nav-link:hover { color: var(--cream) !important; }
  .nav-treeview .nav-link.active { color: var(--gold) !important; }
  .nav-treeview .nav-icon { font-size: 7px !important; }

  /* Separadores de sección */
  .jw-nav-section-label {
    font-size: 9px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.35);
    padding: 14px 20px 4px;
    display: block;
  }

  /* Badge de conteo */
  .jw-badge {
    margin-left: auto;
    background: var(--gold);
    color: var(--dark-bg);
    font-size: 10px;
    font-weight: 600;
    padding: 1px 7px;
    border-radius: 10px;
    line-height: 1.6;
  }

  /* Flecha submenu */
  .nav-arrow { transition: transform 0.2s; }
  .menu-open > .nav-link .nav-arrow { transform: rotate(90deg); }
</style>

<aside class="app-sidebar shadow" data-bs-theme="dark">

  {{-- Brand --}}
  <div class="sidebar-brand">
    <a href="{{ route('dashboard') }}" class="brand-link">
      <div class="jw-brand-gem">
        <i class="bi bi-gem"></i>
      </div>
      <div class="jw-brand-texts">
        <span class="jw-brand-name">JOYEROS</span>
        <span class="jw-brand-sub">DEL NORTE</span>
      </div>
    </a>
  </div>

  {{-- Sidebar wrapper --}}
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        {{-- Principal --}}
        <span class="jw-nav-section-label">Principal</span>

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link" id="mnuDashboard">
            <i class="nav-icon bi bi-grid-1x2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('perfil.pedidos') }}" class="nav-link" id="mnuPedidos">
            <i class="nav-icon bi bi-bag-heart"></i>
            <p>
              Pedidos
              {{-- Puedes reemplazar el 7 con un conteo dinámico desde el controlador --}}
              <span class="jw-badge ms-auto">7</span>
            </p>
          </a>
        </li>

        {{-- Almacén --}}
        @canany(['producto-list'])
        <span class="jw-nav-section-label">Almacén</span>

        <li class="nav-item" id="mnuAlmacen">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-boxes"></i>
            <p>
              Almacén
              <i class="nav-arrow bi bi-chevron-right ms-auto"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('producto-list')
            <li class="nav-item">
              <a href="{{ route('productos.index') }}" class="nav-link" id="itemProducto">
                <i class="nav-icon bi bi-circle" style="font-size:6px;"></i>
                <p>Productos</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcanany

        {{-- Seguridad --}}
        @canany(['user-list', 'rol-list'])
        <span class="jw-nav-section-label">Seguridad</span>

        <li class="nav-item" id="mnuSeguridad">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-shield-check"></i>
            <p>
              Seguridad
              <i class="nav-arrow bi bi-chevron-right ms-auto"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('user-list')
            <li class="nav-item">
              <a href="{{ route('usuarios.index') }}" class="nav-link" id="itemUsuario">
                <i class="nav-icon bi bi-circle" style="font-size:6px;"></i>
                <p>Usuarios</p>
              </a>
            </li>
            @endcan
            @can('rol-list')
            <li class="nav-item">
              <a href="{{ route('roles.index') }}" class="nav-link" id="itemRole">
                <i class="nav-icon bi bi-circle" style="font-size:6px;"></i>
                <p>Roles</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcanany

      </ul>
    </nav>
  </div>

</aside>