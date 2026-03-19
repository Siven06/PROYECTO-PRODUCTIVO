@extends('plantilla.app')

@push('estilos')
<style>
  .jw-welcome-banner {
    background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-surface) 100%);
    border: 1px solid var(--gold-border);
    border-radius: 14px;
    padding: 28px 32px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
  }
  .jw-welcome-title {
    font-family: var(--font-display);
    font-size: 26px;
    font-weight: 500;
    color: var(--cream);
    margin-bottom: 4px;
  }
  .jw-welcome-sub { font-size: 13px; color: var(--dark-muted); }
  .jw-welcome-gem {
    font-size: 48px;
    opacity: 0.6;
    flex-shrink: 0;
  }

  /* KPIs cliente */
  .jw-kpi-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 24px; }
  .jw-kpi { background: #fff; border: 0.5px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 16px 18px; position: relative; overflow: hidden; }
  .jw-kpi::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--kpi-color, var(--gold)); }
  .jw-kpi-icon { width: 36px; height: 36px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-bottom: 10px; background: var(--kpi-bg, var(--gold-dim)); color: var(--kpi-color, var(--gold)); }
  .jw-kpi-label { font-size: 10px; text-transform: uppercase; letter-spacing: 0.8px; color: #8a8a8a; margin-bottom: 3px; }
  .jw-kpi-value { font-family: var(--font-display); font-size: 24px; font-weight: 500; color: #1a1a1a; line-height: 1; }

  /* Sección título */
  .jw-section-title { font-family: var(--font-display); font-size: 17px; font-weight: 500; color: #1a1a1a; margin-bottom: 14px; display: flex; align-items: center; justify-content: space-between; }
  .jw-section-title a { font-family: var(--font-body); font-size: 12px; color: var(--gold); text-decoration: none; }

  /* Card */
  .jw-card { background: #fff; border: 0.5px solid rgba(0,0,0,0.07); border-radius: 12px; padding: 20px; height: 100%; }

  /* Tabla de pedidos del cliente */
  .jw-orders-table { width: 100%; border-collapse: collapse; }
  .jw-orders-table th { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #9ca3af; font-weight: 500; padding: 8px 12px; border-bottom: 1px solid #f0f0f0; text-align: left; }
  .jw-orders-table td { padding: 10px 12px; border-bottom: 0.5px solid #f5f5f5; font-size: 13px; color: #374151; vertical-align: middle; }
  .jw-orders-table tr:last-child td { border-bottom: none; }
  .jw-orders-table tr:hover td { background: #fafaf8; }
  .jw-badge-status { font-size: 10px; padding: 3px 10px; border-radius: 20px; font-weight: 500; white-space: nowrap; }
  .badge-pending  { background:#fff7ed; color:#c2410c; }
  .badge-process  { background:#eff6ff; color:#1d4ed8; }
  .badge-done     { background:#f0fdf4; color:#15803d; }
  .badge-canceled { background:#fef2f2; color:#b91c1c; }
  .jw-empty { text-align: center; padding: 32px 16px; color: #9ca3af; }
  .jw-empty i { font-size: 36px; display: block; margin-bottom: 8px; color: var(--gold); opacity: 0.5; }

  /* Catálogo */
  .jw-catalog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }
  .jw-product-card { background: #fff; border: 0.5px solid rgba(0,0,0,0.08); border-radius: 10px; overflow: hidden; transition: transform 0.15s, box-shadow 0.15s; text-decoration: none; display: block; }
  .jw-product-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(212,175,55,0.15); }
  .jw-product-img { width: 100%; height: 100px; background: linear-gradient(135deg, #f5e8c0, #D4AF37); display: flex; align-items: center; justify-content: center; font-size: 36px; }
  .jw-product-info { padding: 10px 12px; }
  .jw-product-title { font-size: 12px; color: #1a1a1a; font-weight: 500; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .jw-product-price { font-family: var(--font-display); font-size: 14px; color: var(--gold); }

  /* Perfil resumen */
  .jw-perfil-row { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 0.5px solid #f0f0f0; font-size: 13px; }
  .jw-perfil-row:last-child { border-bottom: none; }
  .jw-perfil-label { color: #9ca3af; width: 90px; flex-shrink: 0; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
  .jw-perfil-val { color: #1a1a1a; }
</style>
@endpush

@section('contenido')
<div class="app-content">
  <div class="container-fluid py-3">

    @if(Session::has('mensaje'))
    <div class="alert alert-info alert-dismissible fade show mb-3">
      {{ Session::get('mensaje') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Banner de bienvenida --}}
    <div class="jw-welcome-banner">
      <div>
        <div class="jw-welcome-title">Bienvenida, {{ Auth::user()->name }} ✨</div>
        <div class="jw-welcome-sub">Aquí puedes revisar tus pedidos, explorar nuestro catálogo y gestionar tu perfil.</div>
      </div>
      <div class="jw-welcome-gem">💎</div>
    </div>

    {{-- KPIs del cliente --}}
    <div class="jw-kpi-grid">
      <div class="jw-kpi" style="--kpi-color:#D4AF37;--kpi-bg:rgba(212,175,55,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-bag-heart"></i></div>
        <div class="jw-kpi-label">Mis pedidos</div>
        <div class="jw-kpi-value">{{ $pedidos->count() }}</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#3b82f6;--kpi-bg:rgba(59,130,246,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-hourglass-split"></i></div>
        <div class="jw-kpi-label">En proceso</div>
        <div class="jw-kpi-value">{{ $pedidos->where('estado', 'proceso')->count() }}</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#10b981;--kpi-bg:rgba(16,185,129,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-check-circle"></i></div>
        <div class="jw-kpi-label">Entregados</div>
        <div class="jw-kpi-value">{{ $pedidos->where('estado', 'entregado')->count() }}</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#8b5cf6;--kpi-bg:rgba(139,92,246,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-clock-history"></i></div>
        <div class="jw-kpi-label">Pendientes</div>
        <div class="jw-kpi-value">{{ $pedidos->where('estado', 'pendiente')->count() }}</div>
      </div>
    </div>

    <div class="row g-3 mb-3">

      {{-- Mis pedidos recientes --}}
      <div class="col-lg-7">
        <div class="jw-card">
          <div class="jw-section-title">
            Mis pedidos recientes
            <a href="{{ route('perfil.pedidos') }}">Ver todos →</a>
          </div>

          @if($pedidos->isEmpty())
            <div class="jw-empty">
              <i class="bi bi-bag-x"></i>
              Aún no tienes pedidos. ¡Explora nuestro catálogo!
            </div>
          @else
            <table class="jw-orders-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Total</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                  <td style="font-weight:500;">#{{ $pedido->id }}</td>
                  <td>{{ $pedido->created_at->format('d/m/Y') }}</td>
                  <td style="font-family:var(--font-display);font-size:14px;">
                    ${{ number_format($pedido->total, 2) }}
                  </td>
                  <td>
                    @php
                      $estadoClass = match($pedido->estado) {
                        'pendiente'  => 'badge-pending',
                        'proceso'    => 'badge-process',
                        'entregado'  => 'badge-done',
                        'cancelado'  => 'badge-canceled',
                        default      => 'badge-pending',
                      };
                      $estadoLabel = match($pedido->estado) {
                        'pendiente'  => 'Pendiente',
                        'proceso'    => 'En proceso',
                        'entregado'  => 'Entregado',
                        'cancelado'  => 'Cancelado',
                        default      => ucfirst($pedido->estado),
                      };
                    @endphp
                    <span class="jw-badge-status {{ $estadoClass }}">{{ $estadoLabel }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>

      {{-- Mi perfil --}}
      <div class="col-lg-5">
        <div class="jw-card">
          <div class="jw-section-title" style="font-size:15px;">
            Mi perfil
            <a href="{{ route('perfil.edit') }}">Editar →</a>
          </div>

          {{-- Avatar --}}
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:18px;padding-bottom:16px;border-bottom:0.5px solid #f0f0f0;">
            <div style="width:52px;height:52px;border-radius:50%;background:var(--gold-dim);border:1.5px solid var(--gold-border);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:22px;color:var(--gold);flex-shrink:0;">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
              <div style="font-family:var(--font-display);font-size:16px;color:#1a1a1a;">{{ Auth::user()->name }}</div>
              <div style="font-size:12px;color:#9ca3af;">Cliente Aurelia</div>
            </div>
          </div>

          <div class="jw-perfil-row">
            <span class="jw-perfil-label">Email</span>
            <span class="jw-perfil-val">{{ Auth::user()->email }}</span>
          </div>
          <div class="jw-perfil-row">
            <span class="jw-perfil-label">Miembro desde</span>
            <span class="jw-perfil-val">{{ Auth::user()->created_at->format('M Y') }}</span>
          </div>
          <div class="jw-perfil-row">
            <span class="jw-perfil-label">Total pedidos</span>
            <span class="jw-perfil-val">{{ $pedidos->count() }}</span>
          </div>

          <a href="{{ route('perfil.edit') }}"
             style="display:block;margin-top:16px;text-align:center;padding:8px;border:1px solid var(--gold-border);border-radius:8px;color:var(--gold);font-size:13px;text-decoration:none;transition:background 0.15s;"
             onmouseover="this.style.background='rgba(212,175,55,0.1)'"
             onmouseout="this.style.background='transparent'">
            <i class="bi bi-pencil me-1"></i> Editar perfil
          </a>
        </div>
      </div>
    </div>

    {{-- Catálogo de productos --}}
    <div class="jw-card" style="height:auto;">
      <div class="jw-section-title">
        Catálogo de productos
        <a href="{{ route('web.index') }}">Ver tienda →</a>
      </div>

      @if($productos->isEmpty())
        <div class="jw-empty">
          <i class="bi bi-gem"></i>
          No hay productos disponibles en este momento.
        </div>
      @else
        <div class="jw-catalog-grid">
          @foreach($productos as $producto)
          <a href="{{ route('web.show', $producto->id) }}" class="jw-product-card">
            <div class="jw-product-img">
              @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}"
                     alt="{{ $producto->nombre }}"
                     style="width:100%;height:100%;object-fit:cover;">
              @else
                💍
              @endif
            </div>
            <div class="jw-product-info">
              <div class="jw-product-title">{{ $producto->nombre }}</div>
              <div class="jw-product-price">${{ number_format($producto->precio, 2) }}</div>
            </div>
          </a>
          @endforeach
        </div>
      @endif
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuDashboard').classList.add('active');
</script>
@endpush