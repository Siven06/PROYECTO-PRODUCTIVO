@extends('web.app')
@section('contenido')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Poppins:wght@300;400;500&display=swap');

  body {
    background: #0a0804;
    font-family: 'Poppins', sans-serif;
    color: #f5e8c0;
  }

  /* ══ Layout ══ */
  .jn-cart-section { padding: 60px 0 100px; }

  /* ══ Encabezado ══ */
  .jn-page-eyebrow {
    font-size: 10px; letter-spacing: 3px;
    text-transform: uppercase; color: rgba(212,175,55,0.6);
    margin-bottom: 8px;
    display: flex; align-items: center; gap: 10px;
  }
  .jn-page-eyebrow::before {
    content: ''; width: 24px; height: 1px;
    background: rgba(212,175,55,0.4);
  }
  .jn-page-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 500; color: #f5e8c0;
    margin-bottom: 40px; line-height: 1.1;
  }
  .jn-page-title em { font-style: italic; color: #D4AF37; }

  /* ══ Card base ══ */
  .jn-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(212,175,55,0.18);
    border-radius: 12px;
    overflow: hidden;
  }
  .jn-card-header {
    background: rgba(212,175,55,0.07);
    border-bottom: 1px solid rgba(212,175,55,0.15);
    padding: 14px 20px;
  }
  .jn-card-header-row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap: 12px;
    align-items: center;
  }
  .jn-col-label {
    font-size: 9px; letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.55);
    font-weight: 500;
  }
  .jn-col-label.center { text-align: center; }
  .jn-col-label.right  { text-align: right; }

  /* ══ Item del carrito ══ */
  .jn-cart-body { padding: 8px 0; }
  .jn-cart-item {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap: 12px;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid rgba(212,175,55,0.08);
    transition: background 0.15s;
  }
  .jn-cart-item:last-child { border-bottom: none; }
  .jn-cart-item:hover { background: rgba(255,255,255,0.02); }

  /* Producto */
  .jn-item-product { display: flex; align-items: center; gap: 14px; }
  .jn-item-img {
    width: 64px; height: 64px;
    object-fit: cover; border-radius: 8px;
    border: 1px solid rgba(212,175,55,0.2);
    flex-shrink: 0;
  }
  .jn-item-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px; font-weight: 500;
    color: #f5e8c0; margin-bottom: 2px;
    line-height: 1.2;
  }
  .jn-item-sku {
    font-size: 10px; letter-spacing: 1px;
    color: rgba(212,175,55,0.45);
    text-transform: uppercase;
  }

  /* Precio */
  .jn-item-price {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px; color: rgba(245,232,192,0.7);
    text-align: center;
  }

  /* Cantidad */
  .jn-qty-wrap {
    display: flex; align-items: center;
    justify-content: center; gap: 0;
    border: 1px solid rgba(212,175,55,0.2);
    border-radius: 7px; overflow: hidden;
    width: fit-content; margin: 0 auto;
  }
  .jn-qty-btn {
    width: 30px; height: 30px;
    background: rgba(212,175,55,0.08);
    border: none; color: #D4AF37;
    font-size: 14px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
    transition: background 0.15s;
    line-height: 1;
  }
  .jn-qty-btn:hover { background: rgba(212,175,55,0.2); color: #FFD700; }
  .jn-qty-val {
    width: 36px; height: 30px;
    background: transparent;
    border: none; border-left: 1px solid rgba(212,175,55,0.15);
    border-right: 1px solid rgba(212,175,55,0.15);
    color: #f5e8c0; font-size: 13px;
    text-align: center; font-family: 'Poppins', sans-serif;
    display: flex; align-items: center; justify-content: center;
  }

  /* Subtotal */
  .jn-item-subtotal {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px; font-weight: 500;
    color: #D4AF37; text-align: right;
  }

  /* Eliminar */
  .jn-item-remove {
    background: none; border: none;
    color: rgba(248,113,113,0.4);
    font-size: 15px; cursor: pointer;
    padding: 6px; border-radius: 6px;
    transition: color 0.15s, background 0.15s;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
  }
  .jn-item-remove:hover {
    color: #f87171;
    background: rgba(248,113,113,0.1);
  }

  /* Estado vacío */
  .jn-empty {
    padding: 60px 20px;
    text-align: center;
  }
  .jn-empty i {
    font-size: 48px; display: block;
    margin-bottom: 14px;
    color: rgba(212,175,55,0.25);
  }
  .jn-empty p { font-size: 14px; color: rgba(245,232,192,0.3); margin-bottom: 20px; }
  .jn-empty-link {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 12px; letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #D4AF37; text-decoration: none;
    border: 1px solid rgba(212,175,55,0.3);
    padding: 9px 20px; border-radius: 6px;
    transition: background 0.15s;
  }
  .jn-empty-link:hover { background: rgba(212,175,55,0.1); color: #D4AF37; }

  /* Footer del carrito */
  .jn-cart-footer {
    padding: 14px 20px;
    border-top: 1px solid rgba(212,175,55,0.1);
    display: flex; justify-content: flex-end;
  }
  .jn-btn-danger {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 11px; letter-spacing: 1px;
    text-transform: uppercase; font-weight: 500;
    color: rgba(248,113,113,0.6);
    border: 1px solid rgba(248,113,113,0.2);
    background: transparent; border-radius: 6px;
    padding: 7px 16px; cursor: pointer;
    text-decoration: none;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
    font-family: 'Poppins', sans-serif;
  }
  .jn-btn-danger:hover {
    background: rgba(248,113,113,0.1);
    color: #f87171; border-color: rgba(248,113,113,0.4);
  }

  /* ══ Panel resumen ══ */
  .jn-summary {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(212,175,55,0.18);
    border-radius: 12px;
    overflow: hidden;
    position: sticky;
    top: 80px;
  }
  .jn-summary-header {
    background: rgba(212,175,55,0.07);
    border-bottom: 1px solid rgba(212,175,55,0.15);
    padding: 16px 22px;
    display: flex; align-items: center; gap: 10px;
  }
  .jn-summary-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px; font-weight: 500; color: #f5e8c0;
    margin: 0;
  }
  .jn-summary-body { padding: 22px; }

  .jn-summary-row {
    display: flex; justify-content: space-between;
    align-items: center; padding: 10px 0;
    border-bottom: 1px solid rgba(212,175,55,0.08);
    font-size: 13px;
  }
  .jn-summary-row:last-of-type { border-bottom: none; }
  .jn-summary-label { color: rgba(245,232,192,0.45); }
  .jn-summary-val   { color: rgba(245,232,192,0.7); }

  .jn-summary-total {
    display: flex; justify-content: space-between;
    align-items: center;
    padding: 16px 0 20px;
    border-top: 1px solid rgba(212,175,55,0.2);
    margin-top: 4px;
  }
  .jn-total-label {
    font-size: 11px; letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(212,175,55,0.6);
  }
  .jn-total-val {
    font-family: 'Cormorant Garamond', serif;
    font-size: 30px; color: #D4AF37; font-weight: 500;
  }

  /* Botones del resumen */
  .jn-btn-checkout {
    display: flex; align-items: center; justify-content: center;
    gap: 9px; width: 100%;
    background: linear-gradient(90deg, #D4AF37, #FFD700, #D4AF37);
    color: #0a0804;
    font-size: 11px; letter-spacing: 2px;
    text-transform: uppercase; font-weight: 700;
    border: none; border-radius: 8px;
    padding: 14px; cursor: pointer;
    transition: box-shadow 0.2s, transform 0.15s;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 10px;
  }
  .jn-btn-checkout:hover {
    box-shadow: 0 0 24px rgba(212,175,55,0.4);
    transform: translateY(-1px);
  }
  .jn-btn-continue {
    display: flex; align-items: center; justify-content: center;
    gap: 8px; width: 100%;
    background: transparent;
    color: rgba(245,232,192,0.45);
    font-size: 11px; letter-spacing: 1.5px;
    text-transform: uppercase; font-weight: 400;
    border: 1px solid rgba(245,232,192,0.1);
    border-radius: 8px; padding: 11px;
    cursor: pointer; text-decoration: none;
    transition: border-color 0.15s, color 0.15s, background 0.15s;
    font-family: 'Poppins', sans-serif;
  }
  .jn-btn-continue:hover {
    border-color: rgba(212,175,55,0.3);
    color: rgba(245,232,192,0.7);
    background: rgba(255,255,255,0.02);
  }

  /* Garantía */
  .jn-guarantee {
    display: flex; align-items: center; gap: 8px;
    margin-top: 16px; padding-top: 16px;
    border-top: 1px solid rgba(212,175,55,0.1);
    font-size: 11px; color: rgba(245,232,192,0.3);
  }
  .jn-guarantee i { color: rgba(212,175,55,0.4); font-size: 14px; }

  /* Alertas */
  .jn-alert-success {
    background: rgba(16,185,129,0.1);
    border: 1px solid rgba(16,185,129,0.25);
    border-radius: 8px; color: #6ee7b7;
    font-size: 12px; padding: 10px 14px;
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
  }
  .jn-alert-danger {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.25);
    border-radius: 8px; color: #fca5a5;
    font-size: 12px; padding: 10px 14px;
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
  }

  @media (max-width: 767px) {
    .jn-card-header { display: none; }
    .jn-cart-item {
      grid-template-columns: 1fr auto;
      grid-template-rows: auto auto auto;
      gap: 8px;
    }
    .jn-item-product { grid-column: 1 / -1; }
    .jn-item-price   { text-align: left; }
    .jn-item-subtotal{ text-align: left; }
    .jn-summary { position: static; margin-top: 24px; }
  }
</style>

<section class="jn-cart-section">
  <div class="container">

    {{-- Encabezado --}}
    <div class="jn-page-eyebrow">
      <i class="bi bi-bag" style="font-size:10px;"></i>
      Tu selección
    </div>
    <h1 class="jn-page-title">
      Detalle de <em>tu pedido</em>
    </h1>

    {{-- Alertas --}}
    @if(session('mensaje'))
    <div class="jn-alert-success">
      <i class="bi bi-check-circle"></i>
      {{ session('mensaje') }}
    </div>
    @endif
    @if(session('error'))
    <div class="jn-alert-danger">
      <i class="bi bi-exclamation-circle"></i>
      {{ session('error') }}
    </div>
    @endif

    <div class="row g-4">

      {{-- ══ Carrito ══ --}}
      <div class="col-lg-8">
        <div class="jn-card">

          {{-- Cabecera de columnas --}}
          <div class="jn-card-header">
            <div class="jn-card-header-row">
              <span class="jn-col-label">Producto</span>
              <span class="jn-col-label center">Precio</span>
              <span class="jn-col-label center">Cantidad</span>
              <span class="jn-col-label right">Subtotal</span>
              <span></span>
            </div>
          </div>

          {{-- Items --}}
          <div class="jn-cart-body">
            @forelse($carrito as $id => $item)
            <div class="jn-cart-item">

              {{-- Producto --}}
              <div class="jn-item-product">
                <img src="{{ asset('uploads/productos/' . $item['imagen']) }}"
                     class="jn-item-img"
                     alt="{{ $item['nombre'] }}">
                <div>
                  <div class="jn-item-name">{{ $item['nombre'] }}</div>
                  <div class="jn-item-sku">{{ $item['codigo'] }}</div>
                </div>
              </div>

              {{-- Precio --}}
              <div class="jn-item-price">
                ${{ number_format($item['precio'], 2) }}
              </div>

              {{-- Cantidad --}}
              <div class="jn-qty-wrap">
                <a href="{{ route('carrito.restar', ['producto_id' => $id]) }}"
                   class="jn-qty-btn">−</a>
                <div class="jn-qty-val">{{ $item['cantidad'] }}</div>
                <a href="{{ route('carrito.sumar', ['producto_id' => $id]) }}"
                   class="jn-qty-btn">+</a>
              </div>

              {{-- Subtotal --}}
              <div class="jn-item-subtotal">
                ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
              </div>

              {{-- Eliminar --}}
              <a href="{{ route('carrito.eliminar', $id) }}"
                 class="jn-item-remove"
                 title="Eliminar">
                <i class="bi bi-x-lg"></i>
              </a>

            </div>
            @empty
            <div class="jn-empty">
              <i class="bi bi-bag-x"></i>
              <p>Tu carrito está vacío</p>
              <a href="{{ route('web.index') }}" class="jn-empty-link">
                <i class="bi bi-gem"></i> Ver colección
              </a>
            </div>
            @endforelse
          </div>

          {{-- Footer vaciar --}}
          @if(!empty($carrito))
          <div class="jn-cart-footer">
            <a href="{{ route('carrito.vaciar') }}" class="jn-btn-danger">
              <i class="bi bi-trash"></i> Vaciar carrito
            </a>
          </div>
          @endif

        </div>
      </div>

      {{-- ══ Resumen ══ --}}
      <div class="col-lg-4">
        <div class="jn-summary">

          <div class="jn-summary-header">
            <i class="bi bi-receipt" style="color:#D4AF37;font-size:16px;"></i>
            <h3 class="jn-summary-title">Resumen</h3>
          </div>

          <div class="jn-summary-body">

            {{-- Desglose --}}
            @php
              $total = 0;
              $totalItems = 0;
              foreach($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
                $totalItems += $item['cantidad'];
              }
            @endphp

            <div class="jn-summary-row">
              <span class="jn-summary-label">Artículos</span>
              <span class="jn-summary-val">{{ $totalItems }}</span>
            </div>
            <div class="jn-summary-row">
              <span class="jn-summary-label">Subtotal</span>
              <span class="jn-summary-val">${{ number_format($total, 2) }}</span>
            </div>
            <div class="jn-summary-row">
              <span class="jn-summary-label">Envío</span>
              <span class="jn-summary-val" style="color:rgba(16,185,129,0.8);">A coordinar</span>
            </div>

            {{-- Total --}}
            <div class="jn-summary-total">
              <span class="jn-total-label">Total</span>
              <span class="jn-total-val">${{ number_format($total, 2) }}</span>
            </div>

            {{-- Botones --}}
            @auth
            <form action="{{ route('pedido.realizar') }}" method="POST">
              @csrf
              <button type="submit" class="jn-btn-checkout">
                <i class="bi bi-bag-check"></i>
                Realizar pedido
              </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="jn-btn-checkout"
               style="text-decoration:none;">
              <i class="bi bi-person"></i>
              Inicia sesión para comprar
            </a>
            @endauth

            <a href="{{ route('web.index') }}" class="jn-btn-continue">
              <i class="bi bi-arrow-left" style="font-size:11px;"></i>
              Seguir comprando
            </a>

            {{-- Garantía --}}
            <div class="jn-guarantee">
              <i class="bi bi-shield-check"></i>
              <span>Compra segura · Oro certificado · Envío a todo Colombia</span>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection