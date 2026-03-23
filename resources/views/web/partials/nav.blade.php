<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Poppins:wght@300;400;500&display=swap');

  /* ── Variables ── */
  :root {
    --gold:       #D4AF37;
    --gold-glow:  rgba(212,175,55,0.25);
    --gold-dim:   rgba(212,175,55,0.12);
    --gold-border:rgba(212,175,55,0.3);
    --dark:       #0a0804;
    --dark-2:     #141008;
    --cream:      #f5e8c0;
    --muted:      rgba(245,232,192,0.5);
  }

  /* ── Navbar base ── */
  .jn-nav {
    background: rgba(10,8,4,0.97);
    border-bottom: 1px solid var(--gold-border);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 1030;
    font-family: 'Poppins', sans-serif;
  }

  .jn-nav .container-fluid { padding: 0 32px; }

  /* ── Brand ── */
  .jn-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    padding: 14px 0;
  }
  .jn-brand-gem {
    width: 36px; height: 36px;
    border: 1.5px solid var(--gold);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 16px;
    flex-shrink: 0;
  }
  .jn-brand-texts { display: flex; flex-direction: column; line-height: 1.15; }
  .jn-brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 600;
    color: var(--cream); letter-spacing: 1px;
  }
  .jn-brand-sub {
    font-size: 8px; letter-spacing: 3px;
    text-transform: uppercase; color: var(--gold);
  }

  /* ── Toggler ── */
  .jn-toggler {
    background: none;
    border: 1px solid var(--gold-border);
    border-radius: 7px;
    padding: 6px 10px;
    color: var(--gold);
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    transition: background 0.15s;
  }
  .jn-toggler:hover { background: var(--gold-dim); }

  /* ── Nav links ── */
  .jn-nav .navbar-nav { gap: 2px; }
  .jn-nav .nav-link {
    font-size: 11px !important;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted) !important;
    padding: 8px 14px !important;
    border-radius: 6px;
    transition: color 0.15s, background 0.15s;
    font-weight: 400;
  }
  .jn-nav .nav-link:hover,
  .jn-nav .nav-link.active {
    color: var(--gold) !important;
    background: var(--gold-dim);
  }

  /* ── Botón CTA "Ver colección" ── */
  .jn-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--gold);
    color: #0a0804 !important;
    font-size: 11px !important;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-weight: 600 !important;
    padding: 8px 18px !important;
    border-radius: 6px;
    border: none;
    text-decoration: none;
    transition: box-shadow 0.2s, transform 0.15s, background 0.15s;
    white-space: nowrap;
  }
  .jn-cta:hover {
    background: #f0d875;
    box-shadow: 0 0 18px rgba(212,175,55,0.5);
    transform: translateY(-1px);
    color: #0a0804 !important;
  }
  .jn-cta i { font-size: 13px; }

  /* ── Separador vertical ── */
  .jn-divider {
    width: 1px; height: 28px;
    background: var(--gold-border);
    flex-shrink: 0;
  }

  /* ── Carrito ── */
  .jn-cart {
    position: relative;
    display: flex; align-items: center; justify-content: center;
    width: 38px; height: 38px;
    border: 1px solid var(--gold-border);
    border-radius: 8px;
    color: var(--muted);
    text-decoration: none;
    transition: color 0.15s, background 0.15s, border-color 0.15s;
    font-size: 17px;
    flex-shrink: 0;
  }
  .jn-cart:hover {
    color: var(--gold);
    background: var(--gold-dim);
    border-color: var(--gold);
  }
  .jn-cart-badge {
    position: absolute;
    top: -6px; right: -6px;
    min-width: 18px; height: 18px;
    background: var(--gold);
    color: #0a0804;
    font-size: 9px; font-weight: 700;
    border-radius: 20px;
    display: flex; align-items: center; justify-content: center;
    padding: 0 4px;
    border: 1.5px solid var(--dark);
    line-height: 1;
  }
  .jn-cart-badge.empty { display: none; }

  /* ── Dropdown usuario ── */
  .jn-user-toggle {
    display: flex; align-items: center; gap: 8px;
    background: none; border: 1px solid var(--gold-border);
    border-radius: 8px; padding: 6px 12px;
    color: var(--muted) !important;
    font-size: 12px !important;
    cursor: pointer;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
    text-decoration: none;
    letter-spacing: 0;
    text-transform: none !important;
  }
  .jn-user-toggle:hover,
  .jn-user-toggle.show {
    background: var(--gold-dim);
    border-color: var(--gold);
    color: var(--cream) !important;
  }
  .jn-avatar {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--gold-dim);
    border: 1px solid var(--gold-border);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Cormorant Garamond', serif;
    font-size: 13px; color: var(--gold); font-weight: 600;
    flex-shrink: 0;
  }

  /* Dropdown menú */
  .jn-dropdown {
    background: #141008;
    border: 1px solid var(--gold-border);
    border-radius: 10px;
    padding: 6px;
    min-width: 190px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.6);
    margin-top: 6px !important;
  }
  .jn-dropdown .dropdown-item {
    font-size: 12px;
    color: var(--muted);
    padding: 8px 12px;
    border-radius: 6px;
    display: flex; align-items: center; gap: 8px;
    transition: background 0.15s, color 0.15s;
    font-family: 'Poppins', sans-serif;
  }
  .jn-dropdown .dropdown-item:hover {
    background: var(--gold-dim);
    color: var(--gold);
  }
  .jn-dropdown .dropdown-item i { font-size: 13px; width: 16px; }
  .jn-dropdown-divider {
    border-top: 1px solid var(--gold-border);
    margin: 4px 6px;
  }

  /* ── Link login ── */
  .jn-login {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 11px; letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--muted) !important;
    text-decoration: none;
    padding: 7px 14px;
    border: 1px solid var(--gold-border);
    border-radius: 8px;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
  }
  .jn-login:hover {
    background: var(--gold-dim);
    border-color: var(--gold);
    color: var(--gold) !important;
  }

  /* ── Mobile collapse ── */
  @media (max-width: 991px) {
    .jn-nav .container-fluid { padding: 0 16px; }
    .navbar-collapse {
      background: #0f0b06;
      border-top: 1px solid var(--gold-border);
      padding: 16px;
      margin-top: 0;
      border-radius: 0 0 12px 12px;
    }
    .jn-nav .navbar-nav { gap: 4px; margin-bottom: 16px; }
    .jn-nav .nav-link { padding: 10px 14px !important; }
    .jn-right { flex-direction: column; align-items: stretch !important; gap: 10px !important; }
    .jn-divider { display: none; }
    .jn-cta { justify-content: center; }
    .jn-cart { width: 100%; border-radius: 8px; height: 40px; }
    .jn-cart-badge { top: 4px; right: 10px; }
    .jn-user-toggle { width: 100%; justify-content: center; }
    .jn-login { justify-content: center; }
  }
</style>

<nav class="navbar navbar-expand-lg jn-nav">
  <div class="container-fluid">

    {{-- Brand --}}
    <a class="jn-brand" href="{{ route('web.index') }}">
      <div class="jn-brand-gem">
        <i class="bi bi-gem"></i>
      </div>
      <div class="jn-brand-texts">
        <span class="jn-brand-name">Joyeros del Norte</span>
        <span class="jn-brand-sub">Alta joyería</span>
      </div>
    </a>

    {{-- Toggler móvil --}}
    <button class="jn-toggler navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#jnNav"
            aria-controls="jnNav"
            aria-expanded="false">
      <i class="bi bi-list"></i>
    </button>

    {{-- Contenido colapsable --}}
    <div class="collapse navbar-collapse" id="jnNav">

      {{-- Links izquierda --}}
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('web.index') ? 'active' : '' }}"
             href="{{ route('web.index') }}">
            Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('web.nosotros') ? 'active' : '' }}"
             href="{{ route('web.nosotros') }}">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('web.contacto') ? 'active' : '' }}"
             href="{{ route('web.contacto') }}">Contacto</a>
        </li>

        @auth
          @if(auth()->user()->hasRole('admin'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="bi bi-speedometer2" style="font-size:11px;"></i>
              Panel admin
            </a>
          </li>
          @endif
        @endauth
      </ul>

      {{-- Derecha --}}
      <div class="d-flex align-items-center gap-3 jn-right">

        {{-- ★ Botón CTA hacia la tienda ── --}}
        <a href="{{ route('web.index') }}" class="jn-cta">
          <i class="bi bi-gem"></i>
          Ver colección
        </a>

        <div class="jn-divider"></div>

        {{-- Carrito --}}
        @php
          $totalCarrito = session('carrito')
            ? array_sum(array_column(session('carrito'), 'cantidad'))
            : 0;
        @endphp
        <a href="{{ route('carrito.mostrar') }}" class="jn-cart" title="Carrito">
          <i class="bi bi-bag"></i>
          <span class="jn-cart-badge {{ $totalCarrito == 0 ? 'empty' : '' }}">
            {{ $totalCarrito > 0 ? $totalCarrito : '' }}
          </span>
        </a>

        {{-- Usuario --}}
        @auth
        <div class="nav-item dropdown">
          <a class="jn-user-toggle dropdown-toggle"
             href="#"
             id="userDrop"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            <div class="jn-avatar">
              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu jn-dropdown dropdown-menu-end" aria-labelledby="userDrop">
            <li>
              <a class="dropdown-item" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i> Mi dashboard
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('perfil.pedidos') }}">
                <i class="bi bi-bag-heart"></i> Mis pedidos
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('perfil.edit') }}">
                <i class="bi bi-person"></i> Mi perfil
              </a>
            </li>
            <li><div class="jn-dropdown-divider"></div></li>
            <li>
              <a class="dropdown-item"
                 href="#"
                 onclick="document.getElementById('logout-nav').submit();"
                 style="color:#f87171 !important;">
                <i class="bi bi-box-arrow-right" style="color:#f87171;"></i>
                Cerrar sesión
              </a>
            </li>
          </ul>
          <form id="logout-nav" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>

        @else
        <a href="{{ route('login') }}" class="jn-login">
          <i class="bi bi-person"></i> Ingresar
        </a>
        @endauth

      </div>
    </div>
  </div>
</nav>