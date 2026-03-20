<!doctype html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>JOYEROS DEL NORTE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="JOYEROS DEL NORTE" />

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">

  {{-- OverlayScrollbars --}}
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />

  {{-- Bootstrap Icons --}}
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />

  {{-- AdminLTE --}}
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />

<style>
  /* ── Variables de marca ── */
  :root {
    --gold:        #D4AF37;
    --gold-light:  #f0d875;
    --gold-dim:    rgba(212,175,55,0.15);
    --gold-border: rgba(212,175,55,0.25);
    --dark-bg:     #0f0c08;
    --dark-surface:#1a1510;
    --dark-muted:  rgba(245,232,192,0.45);
    --cream:       #f5e8c0;
    --font-display:'Cormorant Garamond', Georgia, serif;
    --font-body:   'DM Sans', system-ui, sans-serif;
  }

  /* ── Tamaño base ── */
  html { font-size: 15px; }
  body { font-family: var(--font-body); }

  /* ── Escala de componentes ── */
  .jw-table td           { font-size: 14px; }
  .jw-table th           { font-size: 11px; }
  .jw-label              { font-size: 13px; }
  .jw-input,
  .jw-select             { font-size: 14px; }
  .jw-btn                { font-size: 13px; }
  .jw-kpi-label          { font-size: 12px; }
  .jw-kpi-value          { font-size: 30px; }
  .jw-section-title      { font-size: 22px; }
  .jw-card-title         { font-size: 22px; }
  .jw-search-form input  { font-size: 14px; }
  .jw-search-form button { font-size: 14px; }
  .jw-nav-section-label  { font-size: 10px; }
  .sidebar-menu .nav-link{ font-size: 14px !important; }
  .jw-brand-name         { font-size: 19px; }
  .jw-order-name         { font-size: 14px; }
  .jw-order-client       { font-size: 12px; }
  .jw-badge-status       { font-size: 11px; }
  .jw-role-badge,
  .jw-perm-badge         { font-size: 11px; }
  .jw-email              { font-size: 13px; }
  .jw-user-name          { font-size: 14px; }
  .jw-product-name       { font-size: 14px; }
  .jw-precio             { font-size: 16px; }
  .jw-welcome-title      { font-size: 28px; }
  .jw-welcome-sub        { font-size: 14px; }

  /* ── Footer ── */
  .app-footer {
    background: var(--dark-bg) !important;
    border-top: 1px solid var(--gold-border);
    color: var(--dark-muted);
    font-size: 13px;
  }
  .app-footer a {
    color: var(--gold) !important;
    text-decoration: none;
  }
  .app-footer a:hover { color: var(--gold-light) !important; }

  /* ── Scrollbar ── */
  .sidebar-wrapper { scrollbar-color: var(--gold-border) transparent; }
</style>

  @stack('estilos')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

  @include('plantilla.header')
  @include('plantilla.menu')

  <main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid"></div>
    </div>
    @yield('contenido')
  </main>

  <footer class="app-footer">
    <div class="float-end d-none d-sm-inline" style="color:var(--dark-muted);">
      JOYEROS DEL NORTE &mdash; Sistema de Gestión
    </div>
    <strong>
      Copyright &copy; {{ date('Y') }}&nbsp;
      <a href="#">JOYEROSNTE</a>.
    </strong>
    Todos los derechos reservados.
  </footer>

</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
  integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'unde