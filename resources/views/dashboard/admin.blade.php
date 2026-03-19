@extends('plantilla.app')

@push('estilos')
<style>
  .jw-kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }
  .jw-kpi {
    background: #fff;
    border: 0.5px solid rgba(0,0,0,0.08);
    border-radius: 12px;
    padding: 18px 20px;
    position: relative;
    overflow: hidden;
  }
  .jw-kpi::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    background: var(--kpi-color, var(--gold));
  }
  .jw-kpi-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    margin-bottom: 12px;
    background: var(--kpi-bg, var(--gold-dim));
    color: var(--kpi-color, var(--gold));
  }
  .jw-kpi-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #8a8a8a;
    margin-bottom: 4px;
  }
  .jw-kpi-value {
    font-family: var(--font-display);
    font-size: 28px;
    font-weight: 500;
    color: #1a1a1a;
    line-height: 1;
    margin-bottom: 6px;
  }
  .jw-kpi-change { font-size: 11px; display: flex; align-items: center; gap: 4px; }
  .jw-kpi-change.up   { color: #16a34a; }
  .jw-kpi-change.down { color: #dc2626; }
  .jw-kpi-change.neu  { color: #6b7280; }
  .jw-section-title {
    font-family: var(--font-display);
    font-size: 18px; font-weight: 500; color: #1a1a1a;
    margin-bottom: 14px;
    display: flex; align-items: center; justify-content: space-between;
  }
  .jw-section-title a { font-family: var(--font-body); font-size: 12px; color: var(--gold); text-decoration: none; }
  .jw-card { background: #fff; border: 0.5px solid rgba(0,0,0,0.07); border-radius: 12px; padding: 20px; height: 100%; }
  .jw-orders-table { width: 100%; border-collapse: collapse; }
  .jw-orders-table th { font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #9ca3af; font-weight: 500; padding: 8px 12px; border-bottom: 1px solid #f0f0f0; text-align: left; }
  .jw-orders-table td { padding: 10px 12px; border-bottom: 0.5px solid #f5f5f5; font-size: 13px; color: #374151; vertical-align: middle; }
  .jw-orders-table tr:last-child td { border-bottom: none; }
  .jw-orders-table tr:hover td { background: #fafaf8; }
  .jw-product-cell { display: flex; align-items: center; gap: 10px; }
  .jw-product-thumb { width: 38px; height: 38px; border-radius: 8px; background: linear-gradient(135deg, #f5e8c0, #D4AF37); display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
  .jw-product-name { font-size: 13px; color: #1a1a1a; }
  .jw-product-sku  { font-size: 11px; color: #9ca3af; }
  .jw-badge-status { font-size: 10px; padding: 3px 10px; border-radius: 20px; font-weight: 500; white-space: nowrap; }
  .badge-pending  { background:#fff7ed; color:#c2410c; }
  .badge-process  { background:#eff6ff; color:#1d4ed8; }
  .badge-done     { background:#f0fdf4; color:#15803d; }
  .badge-canceled { background:#fef2f2; color:#b91c1c; }
  .jw-stock-list { list-style: none; padding: 0; margin: 0; }
  .jw-stock-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 0.5px solid #f0f0f0; font-size: 13px; }
  .jw-stock-item:last-child { border-bottom: none; }
  .jw-stock-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .jw-stock-name { flex: 1; color: #374151; }
  .jw-stock-qty  { font-weight: 500; color: #1a1a1a; font-size: 13px; }
  .jw-stock-bar-wrap { width: 56px; height: 4px; background: #f0f0f0; border-radius: 2px; overflow: hidden; }
  .jw-stock-bar { height: 100%; border-radius: 2px; }
  .jw-chart-bars { display: flex; align-items: flex-end; gap: 8px; height: 90px; padding-top: 8px; }
  .jw-bar-col { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; }
  .jw-bar { width: 100%; border-radius: 4px 4px 0 0; background: rgba(212,175,55,0.25); cursor: pointer; transition: background 0.15s; }
  .jw-bar:hover, .jw-bar.today { background: var(--gold); }
  .jw-bar-day { font-size: 9px; color: #9ca3af; }
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

    {{-- KPIs admin --}}
    <div class="jw-kpi-grid">
      <div class="jw-kpi" style="--kpi-color:#D4AF37;--kpi-bg:rgba(212,175,55,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-cash-coin"></i></div>
        <div class="jw-kpi-label">Ventas hoy</div>
        <div class="jw-kpi-value">$4,280</div>
        <div class="jw-kpi-change up"><i class="bi bi-arrow-up-short"></i> 12% vs ayer</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#3b82f6;--kpi-bg:rgba(59,130,246,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-bag-heart"></i></div>
        <div class="jw-kpi-label">Pedidos activos</div>
        <div class="jw-kpi-value">23</div>
        <div class="jw-kpi-change neu"><i class="bi bi-dot"></i> 7 pendientes</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#ef4444;--kpi-bg:rgba(239,68,68,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-exclamation-triangle"></i></div>
        <div class="jw-kpi-label">Stock bajo</div>
        <div class="jw-kpi-value">5</div>
        <div class="jw-kpi-change down"><i class="bi bi-arrow-down-short"></i> requiere atención</div>
      </div>
      <div class="jw-kpi" style="--kpi-color:#10b981;--kpi-bg:rgba(16,185,129,0.1);">
        <div class="jw-kpi-icon"><i class="bi bi-gem"></i></div>
        <div class="jw-kpi-label">Val. inventario</div>
        <div class="jw-kpi-value">$186k</div>
        <div class="jw-kpi-change up"><i class="bi bi-arrow-up-short"></i> 3% este mes</div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-lg-8">
        <div class="jw-card">
          <div class="jw-section-title">
            Últimos pedidos
            <a href="{{ route('perfil.pedidos') }}">Ver todos →</a>
          </div>
          <table class="jw-orders-table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Precio</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              {{-- Reemplaza con @foreach($pedidos as $p) cuando conectes el modelo --}}
              <tr>
                <td><div class="jw-product-cell"><div class="jw-product-thumb">💍</div><div><div class="jw-product-name">Anillo Solitario Oro 18k</div><div class="jw-product-sku">SKU-0012</div></div></div></td>
                <td>María García</td><td>$1,250</td>
                <td><span class="jw-badge-status badge-process">En proceso</span></td>
              </tr>
              <tr>
                <td><div class="jw-product-cell"><div class="jw-product-thumb">📿</div><div><div class="jw-product-name">Collar Perlas Naturales</div><div class="jw-product-sku">SKU-0031</div></div></div></td>
                <td>Carlos López</td><td>$890</td>
                <td><span class="jw-badge-status badge-done">Entregado</span></td>
              </tr>
              <tr>
                <td><div class="jw-product-cell"><div class="jw-product-thumb">✨</div><div><div class="jw-product-name">Aretes Diamante Princesa</div><div class="jw-product-sku">SKU-0008</div></div></div></td>
                <td>Ana Martínez</td><td>$2,100</td>
                <td><span class="jw-badge-status badge-pending">Pendiente</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-4 d-flex flex-column gap-3">
        <div class="jw-card">
          <div class="jw-section-title" style="font-size:15px;">Ventas esta semana</div>
          <div class="jw-chart-bars">
            <div class="jw-bar-col"><div class="jw-bar" style="height:45px;"></div><span class="jw-bar-day">Lun</span></div>
            <div class="jw-bar-col"><div class="jw-bar" style="height:65px;"></div><span class="jw-bar-day">Mar</span></div>
            <div class="jw-bar-col"><div class="jw-bar" style="height:40px;"></div><span class="jw-bar-day">Mié</span></div>
            <div class="jw-bar-col"><div class="jw-bar" style="height:80px;"></div><span class="jw-bar-day">Jue</span></div>
            <div class="jw-bar-col"><div class="jw-bar" style="height:90px;"></div><span class="jw-bar-day">Vie</span></div>
            <div class="jw-bar-col"><div class="jw-bar today" style="height:70px;"></div><span class="jw-bar-day">Sáb</span></div>
            <div class="jw-bar-col"><div class="jw-bar" style="height:30px;"></div><span class="jw-bar-day">Dom</span></div>
          </div>
        </div>
        <div class="jw-card">
          <div class="jw-section-title" style="font-size:15px;">
            Stock crítico
            <a href="{{ route('productos.index') }}">Ver →</a>
          </div>
          <ul class="jw-stock-list">
            <li class="jw-stock-item">
              <div class="jw-stock-dot" style="background:#ef4444;"></div>
              <span class="jw-stock-name">Anillo Esmeralda 14k</span>
              <span class="jw-stock-qty">2</span>
              <div class="jw-stock-bar-wrap"><div class="jw-stock-bar" style="width:15%;background:#ef4444;"></div></div>
            </li>
            <li class="jw-stock-item">
              <div class="jw-stock-dot" style="background:#f59e0b;"></div>
              <span class="jw-stock-name">Pulsera Oro Macizo</span>
              <span class="jw-stock-qty">4</span>
              <div class="jw-stock-bar-wrap"><div class="jw-stock-bar" style="width:30%;background:#f59e0b;"></div></div>
            </li>
            <li class="jw-stock-item">
              <div class="jw-stock-dot" style="background:#f59e0b;"></div>
              <span class="jw-stock-name">Collar Rubí Colgante</span>
              <span class="jw-stock-qty">5</span>
              <div class="jw-stock-bar-wrap"><div class="jw-stock-bar" style="width:40%;background:#f59e0b;"></div></div>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuDashboard').classList.add('active');
</script>
@endpush