@extends('web.app')

@section('contenido')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500&display=swap');

  body {
    background: #0a0804;
    font-family: 'Poppins', sans-serif;
    color: #f5e8c0;
  }

  /* ══════════════════════════════
     HERO
  ══════════════════════════════ */
  .jn-hero {
    position: relative;
    min-height: 88vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #0a0804;
  }

  /* Imagen de fondo con overlay */
  .jn-hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('{{ asset("assets/img/hero-jewelry.jpg") }}');
    background-size: cover;
    background-position: center 30%;
    opacity: 0.35;
    transition: opacity 0.5s;
  }

  /* Gradiente encima de la imagen */
  .jn-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      135deg,
      rgba(10,8,4,0.97) 0%,
      rgba(10,8,4,0.75) 50%,
      rgba(10,8,4,0.4) 100%
    );
  }

  /* Línea decorativa dorada izquierda */
  .jn-hero-line {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(
      to bottom,
      transparent,
      rgba(212,175,55,0.8) 30%,
      rgba(212,175,55,0.8) 70%,
      transparent
    );
  }

  .jn-hero-content {
    position: relative;
    z-index: 2;
    max-width: 680px;
    padding: 60px 0;
  }

  .jn-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 10px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.7);
    margin-bottom: 20px;
  }
  .jn-hero-eyebrow::before,
  .jn-hero-eyebrow::after {
    content: '';
    width: 30px; height: 1px;
    background: rgba(212,175,55,0.5);
  }

  .jn-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(42px, 6vw, 72px);
    font-weight: 500;
    line-height: 1.1;
    color: #f5e8c0;
    margin-bottom: 20px;
  }
  .jn-hero-title em {
    font-style: italic;
    color: #D4AF37;
  }

  .jn-hero-desc {
    font-size: 14px;
    color: rgba(245,232,192,0.55);
    line-height: 1.8;
    max-width: 480px;
    margin-bottom: 36px;
    font-weight: 300;
  }

  .jn-hero-actions {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
  }

  .jn-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    background: #D4AF37;
    color: #0a0804;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 600;
    padding: 14px 28px;
    border-radius: 4px;
    text-decoration: none;
    transition: box-shadow 0.2s, transform 0.15s, background 0.15s;
    border: none;
  }
  .jn-btn-primary:hover {
    background: #f0d875;
    box-shadow: 0 0 28px rgba(212,175,55,0.45);
    transform: translateY(-2px);
    color: #0a0804;
  }

  .jn-btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(245,232,192,0.6);
    text-decoration: none;
    padding: 14px 0;
    border-bottom: 1px solid rgba(212,175,55,0.3);
    transition: color 0.15s, border-color 0.15s;
  }
  .jn-btn-ghost:hover {
    color: #D4AF37;
    border-color: #D4AF37;
  }

  /* Stats debajo del hero */
  .jn-hero-stats {
    display: flex;
    gap: 40px;
    margin-top: 48px;
    padding-top: 32px;
    border-top: 1px solid rgba(212,175,55,0.15);
  }
  .jn-stat-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px;
    color: #D4AF37;
    font-weight: 500;
    line-height: 1;
    margin-bottom: 3px;
  }
  .jn-stat-lbl {
    font-size: 10px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(245,232,192,0.4);
  }

  /* Imagen derecha del hero */
  .jn-hero-img-wrap {
    position: relative;
    z-index: 2;
  }
  .jn-hero-img {
    width: 100%;
    max-width: 440px;
    border-radius: 2px;
    border: 1px solid rgba(212,175,55,0.25);
    box-shadow:
      0 0 60px rgba(0,0,0,0.6),
      0 0 30px rgba(212,175,55,0.1);
    aspect-ratio: 3/4;
    object-fit: cover;
  }

  /* Marco decorativo */
  .jn-hero-img-frame {
    position: absolute;
    top: -12px; right: -12px;
    width: 100%; height: 100%;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 2px;
    pointer-events: none;
  }

  /* Badge flotante */
  .jn-hero-badge {
    position: absolute;
    bottom: 24px;
    left: -20px;
    background: #0a0804;
    border: 1px solid rgba(212,175,55,0.4);
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
  }
  .jn-hero-badge-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    background: rgba(212,175,55,0.15);
    display: flex; align-items: center; justify-content: center;
    color: #D4AF37; font-size: 16px;
  }
  .jn-hero-badge-text { font-size: 11px; color: rgba(245,232,192,0.7); }
  .jn-hero-badge-text strong { color: #f5e8c0; display: block; font-size: 13px; }

  /* ══════════════════════════════
     SECCIÓN PRODUCTOS
  ══════════════════════════════ */
  .jn-products-section {
    padding: 80px 0 100px;
    border-top: 1px solid rgba(212,175,55,0.12);
  }

  /* Encabezado de sección */
  .jn-section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 48px;
    flex-wrap: wrap;
  }
  .jn-section-eyebrow {
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #D4AF37;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .jn-section-eyebrow::before {
    content: '';
    width: 24px; height: 1px;
    background: rgba(212,175,55,0.5);
  }
  .jn-section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 500;
    color: #f5e8c0;
    line-height: 1.15;
    margin: 0;
  }
  .jn-section-title em { font-style: italic; color: #D4AF37; }

  /* Barra de búsqueda */
  .jn-search-wrap {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
  }
  .jn-search-bar {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(212,175,55,0.25);
    border-radius: 6px;
    overflow: hidden;
    min-width: 260px;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .jn-search-bar:focus-within {
    border-color: rgba(212,175,55,0.6);
    box-shadow: 0 0 16px rgba(212,175,55,0.15);
  }
  .jn-search-bar input {
    flex: 1;
    background: transparent;
    border: none;
    outline: none;
    padding: 9px 14px;
    font-size: 13px;
    color: #f5e8c0;
    font-family: 'Poppins', sans-serif;
  }
  .jn-search-bar input::placeholder { color: rgba(245,232,192,0.3); }
  .jn-search-bar button {
    background: rgba(212,175,55,0.15);
    border: none;
    border-left: 1px solid rgba(212,175,55,0.25);
    padding: 9px 14px;
    color: #D4AF37;
    font-size: 13px;
    cursor: pointer;
    transition: background 0.15s;
  }
  .jn-search-bar button:hover { background: rgba(212,175,55,0.25); }

  .jn-sort-wrap {
    display: flex;
    align-items: center;
    gap: 0;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(212,175,55,0.25);
    border-radius: 6px;
    overflow: hidden;
  }
  .jn-sort-label {
    padding: 9px 12px;
    font-size: 10px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.6);
    border-right: 1px solid rgba(212,175,55,0.2);
    white-space: nowrap;
  }
  .jn-sort-select {
    background: transparent;
    border: none;
    outline: none;
    padding: 9px 12px;
    font-size: 12px;
    color: #f5e8c0;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    appearance: none;
    padding-right: 28px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23D4AF37' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 8px center;
  }
  .jn-sort-select option { background: #141008; color: #f5e8c0; }

  /* Grid de productos — 2 columnas */
  .jn-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }

  /* Tarjeta */
  .jn-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(212,175,55,0.18);
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.25s, border-color 0.25s, box-shadow 0.25s;
    text-decoration: none;
  }
  .jn-card:hover {
    transform: translateY(-4px);
    border-color: rgba(212,175,55,0.5);
    box-shadow: 0 12px 40px rgba(0,0,0,0.5), 0 0 20px rgba(212,175,55,0.1);
  }

  /* Imagen */
  .jn-card-img-wrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: #141008;
  }
  .jn-card-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .jn-card:hover .jn-card-img-wrap img {
    transform: scale(1.05);
  }

  /* Overlay en hover */
  .jn-card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10,8,4,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s;
  }
  .jn-card:hover .jn-card-overlay { opacity: 1; }
  .jn-overlay-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #D4AF37;
    color: #0a0804;
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-weight: 600;
    padding: 10px 22px;
    border-radius: 4px;
    text-decoration: none;
    transform: translateY(8px);
    transition: transform 0.25s;
  }
  .jn-card:hover .jn-overlay-btn { transform: translateY(0); }

  /* Body */
  .jn-card-body {
    padding: 18px 20px;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    border-top: 1px solid rgba(212,175,55,0.12);
  }
  .jn-card-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 500;
    color: #f5e8c0;
    margin-bottom: 2px;
  }
  .jn-card-sku {
    font-size: 10px;
    letter-spacing: 1px;
    color: rgba(212,175,55,0.5);
    text-transform: uppercase;
  }
  .jn-card-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px;
    color: #D4AF37;
    font-weight: 500;
    white-space: nowrap;
    flex-shrink: 0;
  }

  /* Estado vacío */
  .jn-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: rgba(245,232,192,0.3);
  }
  .jn-empty i {
    font-size: 48px;
    display: block;
    margin-bottom: 16px;
    color: rgba(212,175,55,0.3);
  }
  .jn-empty p { font-size: 14px; }

  /* Paginación */
  .jn-pagination {
    margin-top: 56px;
    display: flex;
    justify-content: center;
  }
  .jn-pagination .pagination { gap: 4px; }
  .jn-pagination .page-link {
    background: rgba(255,255,255,0.04);
    color: rgba(212,175,55,0.7);
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 6px !important;
    padding: 8px 14px;
    font-size: 13px;
    transition: background 0.15s, color 0.15s;
  }
  .jn-pagination .page-link:hover {
    background: rgba(212,175,55,0.15);
    color: #D4AF37;
    border-color: rgba(212,175,55,0.4);
  }
  .jn-pagination .active .page-link {
    background: #D4AF37 !important;
    color: #0a0804 !important;
    border-color: #D4AF37 !important;
    font-weight: 600;
  }

  /* Responsive */
  @media (max-width: 767px) {
    .jn-grid { grid-template-columns: 1fr; gap: 16px; }
    .jn-hero { min-height: 70vh; }
    .jn-hero-stats { gap: 24px; flex-wrap: wrap; }
    .jn-section-header { flex-direction: column; align-items: flex-start; }
    .jn-hero-img-wrap { display: none; }
    .jn-hero-badge { display: none; }
  }
</style>

{{-- ══════════════════════════════
     HERO
══════════════════════════════ --}}
<section class="jn-hero">
  <div class="jn-hero-bg"></div>
  <div class="jn-hero-overlay"></div>
  <div class="jn-hero-line"></div>

  <div class="container">
    <div class="row align-items-center">

      {{-- Texto --}}
      <div class="col-lg-6">
        <div class="jn-hero-content">

          <div class="jn-hero-eyebrow">
            <i class="bi bi-gem" style="font-size:11px;"></i>
            Alta joyería colombiana
          </div>

          <h1 class="jn-hero-title">
            Piezas únicas que<br>
            <em>cuentan tu historia</em>
          </h1>

          <p class="jn-hero-desc">
            Descubre nuestra colección de joyas artesanales en oro, plata y piedras preciosas.
            Cada pieza es creada con la más alta tradición joyera del norte de Colombia.
          </p>

          <div class="jn-hero-actions">
            <a href="#productos" class="jn-btn-primary">
              <i class="bi bi-gem"></i>
              Ver colección
            </a>
            <a href="#" class="jn-btn-ghost">
              Conocer más
              <i class="bi bi-arrow-right" style="font-size:11px;"></i>
            </a>
          </div>

          <div class="jn-hero-stats">
            <div>
              <div class="jn-stat-val">+200</div>
              <div class="jn-stat-lbl">Piezas únicas</div>
            </div>
            <div>
              <div class="jn-stat-val">18k</div>
              <div class="jn-stat-lbl">Oro puro</div>
            </div>
            <div>
              <div class="jn-stat-val">+15</div>
              <div class="jn-stat-lbl">Años de tradición</div>
            </div>
          </div>

        </div>
      </div>

      {{-- Imagen decorativa derecha --}}
      <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
        <div class="jn-hero-img-wrap">
          {{-- Reemplaza con una imagen real de tus productos --}}
          <div style="width:100%;max-width:420px;aspect-ratio:3/4;background:linear-gradient(135deg,#1a1408,#2a1f08);border:1px solid rgba(212,175,55,0.25);border-radius:2px;display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-gem" style="font-size:80px;color:rgba(212,175,55,0.2);"></i>
          </div>
          <div class="jn-hero-img-frame"></div>
          <div class="jn-hero-badge">
            <div class="jn-hero-badge-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <div class="jn-hero-badge-text">
              <strong>Certificado</strong>
              Oro puro garantizado
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ══════════════════════════════
     PRODUCTOS
══════════════════════════════ --}}
<section class="jn-products-section" id="productos">
  <div class="container">

    {{-- Encabezado + filtros --}}
    <div class="jn-section-header">
      <div>
        <div class="jn-section-eyebrow">Colección</div>
        <h2 class="jn-section-title">Nuestra <em>joyería</em></h2>
      </div>

      <form method="GET" action="{{ route('web.index') }}" class="jn-search-wrap">
        <div class="jn-search-bar">
          <input type="text"
                 name="search"
                 value="{{ request('search') }}"
                 placeholder="Buscar pieza...">
          <button type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>

        <div class="jn-sort-wrap">
          <span class="jn-sort-label">Ordenar</span>
          <select name="sort" class="jn-sort-select" onchange="this.form.submit()">
            <option value="priceAsc"  {{ request('sort') == 'priceAsc'  ? 'selected' : '' }}>
              Precio ↑
            </option>
            <option value="priceDesc" {{ request('sort') == 'priceDesc' ? 'selected' : '' }}>
              Precio ↓
            </option>
          </select>
        </div>
      </form>
    </div>

    {{-- Grid --}}
    <div class="jn-grid">
      @forelse($productos as $producto)
      <a href="{{ route('web.show', $producto->id) }}" class="jn-card">

        <div class="jn-card-img-wrap">
          <img src="{{ asset('uploads/productos/' . $producto->imagen) }}"
               alt="{{ $producto->nombre }}"
               loading="lazy">
          <div class="jn-card-overlay">
            <span class="jn-overlay-btn">
              <i class="bi bi-eye"></i> Ver pieza
            </span>
          </div>
        </div>

        <div class="jn-card-body">
          <div>
            <div class="jn-card-name">{{ $producto->nombre }}</div>
            <div class="jn-card-sku">{{ $producto->codigo }}</div>
          </div>
          <div class="jn-card-price">
            ${{ number_format($producto->precio, 2) }}
          </div>
        </div>

      </a>
      @empty
      <div class="jn-empty">
        <i class="bi bi-gem"></i>
        <p>No encontramos piezas que coincidan con tu búsqueda.</p>
        <a href="{{ route('web.index') }}" style="color:#D4AF37;font-size:13px;">
          Ver toda la colección →
        </a>
      </div>
      @endforelse
    </div>

    {{-- Paginación --}}
    <div class="jn-pagination">
      {{ $productos->appends([
        'search' => request('search'),
        'sort'   => request('sort')
      ])->links() }}
    </div>

  </div>
</section>

@endsection