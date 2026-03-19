<style>
  .app-header {
    background: var(--dark-bg) !important;
    border-bottom: 1px solid var(--gold-border);
    box-shadow: 0 1px 12px rgba(0,0,0,0.4);
  }

  /* Logo / toggle */
  .app-header .nav-link {
    color: var(--dark-muted) !important;
    transition: color 0.2s;
  }
  .app-header .nav-link:hover { color: var(--gold) !important; }

  /* Barra de búsqueda */
  .jw-search-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--dark-surface);
    border: 0.5px solid var(--gold-border);
    border-radius: 6px;
    padding: 5px 14px;
    font-size: 12px;
    color: var(--dark-muted);
  }

  /* Dropdown usuario */
  .user-menu .dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--cream) !important;
    font-size: 13px;
  }
  .jw-avatar-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--gold-dim);
    border: 1.5px solid var(--gold-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-size: 14px;
    color: var(--gold);
    font-weight: 600;
    flex-shrink: 0;
  }
  .user-menu .dropdown-menu {
    background: var(--dark-surface);
    border: 0.5px solid var(--gold-border);
    border-radius: 10px;
    min-width: 200px;
    overflow: hidden;
    padding: 0;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
  }
  .jw-dropdown-header {
    background: linear-gradient(135deg, var(--dark-bg), var(--dark-surface));
    padding: 16px;
    border-bottom: 0.5px solid var(--gold-border);
    text-align: center;
  }
  .jw-dropdown-header .jw-avatar-circle {
    width: 48px;
    height: 48px;
    font-size: 20px;
    margin: 0 auto 8px;
  }
  .jw-dropdown-header .name {
    font-family: var(--font-display);
    font-size: 15px;
    color: var(--cream);
    font-weight: 500;
  }
  .jw-dropdown-footer {
    display: flex;
    gap: 8px;
    padding: 10px 14px;
    background: var(--dark-bg);
  }
  .jw-dropdown-footer a {
    flex: 1;
    text-align: center;
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
  }
  .jw-btn-perfil {
    border: 0.5px solid var(--gold-border);
    color: var(--gold) !important;
    background: transparent;
  }
  .jw-btn-perfil:hover { background: var(--gold-dim) !important; }
  .jw-btn-logout {
    background: rgba(220,53,69,0.15);
    border: 0.5px solid rgba(220,53,69,0.3);
    color: #f87171 !important;
  }
  .jw-btn-logout:hover { background: rgba(220,53,69,0.25) !important; }

  /* Notificación badge */
  .jw-notif-btn {
    position: relative;
    color: var(--dark-muted) !important;
  }
  .jw-notif-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 8px;
    height: 8px;
    background: var(--gold);
    border-radius: 50%;
    border: 1.5px solid var(--dark-bg);
  }
</style>

<nav class="app-header navbar navbar-expand bg-body">
  <div class="container-fluid">

    {{-- Toggle sidebar --}}
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list" style="font-size:20px;"></i>
        </a>
      </li>
      {{-- Nombre del sistema --}}
      <li class="nav-item d-none d-md-flex align-items-center ms-2">
        <span style="font-family:var(--font-display);font-size:18px;color:var(--gold);letter-spacing:1px;">
          JOYEROS
        </span>
        <span style="font-size:11px;color:var(--dark-muted);letter-spacing:2px;text-transform:uppercase;margin-left:8px;margin-top:2px;">
          DEL NORTE
        </span>
      </li>
    </ul>

    {{-- Derecha --}}
    <ul class="navbar-nav ms-auto align-items-center gap-1">

      {{-- Búsqueda --}}
      <li class="nav-item d-none d-md-block">
        <div class="jw-search-wrap">
          <i class="bi bi-search" style="font-size:12px;"></i>
          <span>Buscar producto, pedido...</span>
        </div>
      </li>

      {{-- Fullscreen --}}
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen" title="Pantalla completa">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none"></i>
        </a>
      </li>

      {{-- Notificaciones (placeholder) --}}
      <li class="nav-item">
        <a class="nav-link jw-notif-btn" href="#" title="Notificaciones">
          <i class="bi bi-bell" style="font-size:16px;"></i>
          <span class="jw-notif-badge"></span>
        </a>
      </li>

      {{-- Usuario --}}
      @if(Auth::check())
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <div class="jw-avatar-circle">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </div>
          <span class="d-none d-md-inline" style="font-size:13px;color:var(--cream);">
            {{ Auth::user()->name }}
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <div class="jw-dropdown-header">
              <div class="jw-avatar-circle">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </div>
              <div class="name">{{ Auth::user()->name }}</div>
              <div style="font-size:11px;color:var(--dark-muted);margin-top:2px;">
                {{ Auth::user()->email }}
              </div>
            </div>
          </li>
          <li>
            <div class="jw-dropdown-footer">
              <a href="{{ route('perfil.edit') }}" class="jw-btn-perfil">
                <i class="bi bi-person me-1"></i>Perfil
              </a>
              <a href="#" onclick="document.getElementById('logout-form').submit();" class="jw-btn-logout">
                <i class="bi bi-box-arrow-right me-1"></i>Salir
              </a>
            </div>
          </li>
        </ul>
        <form action="{{ route('logout') }}" id="logout-form" method="post" class="d-none">
          @csrf
        </form>
      </li>
      @endif

    </ul>
  </div>
</nav>