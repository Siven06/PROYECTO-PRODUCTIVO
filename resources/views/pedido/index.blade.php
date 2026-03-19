@extends('plantilla.app')

@push('estilos')
<style>
  .jw-section-title {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 500;
    color: #1a1a1a;
    margin-bottom: 0;
  }
  .jw-card {
    background: #fff;
    border: 0.5px solid rgba(0,0,0,0.07);
    border-radius: 14px;
    overflow: hidden;
  }
  .jw-card-header {
    padding: 18px 24px;
    border-bottom: 0.5px solid rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }
  .jw-card-body { padding: 20px 24px; }
  .jw-card-footer {
    padding: 14px 24px;
    border-top: 0.5px solid rgba(0,0,0,0.06);
    background: #fafaf8;
  }

  /* Buscador */
  .jw-search-form {
    display: flex;
    align-items: center;
    gap: 0;
    background: #f5f5f3;
    border: 0.5px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
    max-width: 340px;
    width: 100%;
  }
  .jw-search-form input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 8px 14px;
    font-size: 13px;
    color: #1a1a1a;
    outline: none;
    font-family: var(--font-body);
  }
  .jw-search-form input::placeholder { color: #aaa; }
  .jw-search-form button {
    background: var(--gold);
    border: none;
    padding: 8px 16px;
    color: #0f0c08;
    font-size: 13px;
    cursor: pointer;
    font-family: var(--font-body);
    font-weight: 500;
    transition: background 0.15s;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .jw-search-form button:hover { background: var(--gold-light); }

  /* Tabla */
  .jw-table { width: 100%; border-collapse: collapse; }
  .jw-table thead tr {
    border-bottom: 1px solid #f0f0f0;
  }
  .jw-table th {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #9ca3af;
    font-weight: 500;
    padding: 10px 14px;
    text-align: left;
    white-space: nowrap;
  }
  .jw-table td {
    padding: 12px 14px;
    font-size: 13px;
    color: #374151;
    border-bottom: 0.5px solid #f5f5f5;
    vertical-align: middle;
  }
  .jw-table tr:last-child td { border-bottom: none; }
  .jw-table tbody tr:hover td { background: #fafaf8; }
  .jw-table .empty-row td {
    text-align: center;
    padding: 40px;
    color: #9ca3af;
  }
  .jw-id-badge {
    font-family: var(--font-display);
    font-size: 15px;
    color: #1a1a1a;
    font-weight: 500;
  }

  /* Badges de estado */
  .jw-badge-status {
    font-size: 10px;
    padding: 4px 11px;
    border-radius: 20px;
    font-weight: 500;
    white-space: nowrap;
    display: inline-block;
  }
  .badge-pendiente { background:#fff7ed; color:#c2410c; }
  .badge-enviado   { background:#f0fdf4; color:#15803d; }
  .badge-anulado   { background:#fef2f2; color:#b91c1c; }
  .badge-cancelado { background:#f1f5f9; color:#475569; }

  /* Botones de acción */
  .jw-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: opacity 0.15s, transform 0.1s;
    font-family: var(--font-body);
    white-space: nowrap;
  }
  .jw-btn:active { transform: scale(0.97); }
  .jw-btn-gold {
    background: var(--gold-dim);
    color: #92700a;
    border: 0.5px solid var(--gold-border);
  }
  .jw-btn-gold:hover { background: rgba(212,175,55,0.25); }
  .jw-btn-blue {
    background: rgba(59,130,246,0.1);
    color: #1d4ed8;
    border: 0.5px solid rgba(59,130,246,0.2);
  }
  .jw-btn-blue:hover { background: rgba(59,130,246,0.18); }

  /* Fila de detalles expandida */
  .jw-details-row td {
    background: #fafaf8 !important;
    padding: 0 !important;
    border-bottom: 0.5px solid #f0f0f0 !important;
  }
  .jw-details-inner {
    padding: 16px 24px;
    border-top: 2px solid var(--gold-border);
  }
  .jw-details-title {
    font-family: var(--font-display);
    font-size: 14px;
    color: #1a1a1a;
    margin-bottom: 12px;
    font-weight: 500;
  }
  .jw-details-table { width: 100%; border-collapse: collapse; }
  .jw-details-table th {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #9ca3af;
    font-weight: 500;
    padding: 6px 10px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
  }
  .jw-details-table td {
    padding: 8px 10px;
    font-size: 12px;
    color: #374151;
    border-bottom: 0.5px solid #f5f5f5;
    vertical-align: middle;
  }
  .jw-details-table tr:last-child td { border-bottom: none; }
  .jw-product-img {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 7px;
    border: 0.5px solid rgba(0,0,0,0.08);
  }
  .jw-product-img-placeholder {
    width: 48px;
    height: 48px;
    border-radius: 7px;
    background: linear-gradient(135deg, #f5e8c0, #D4AF37);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }
  .jw-subtotal {
    font-family: var(--font-display);
    font-size: 14px;
    color: #1a1a1a;
  }

  /* Modal de estado */
  .jw-modal .modal-content {
    border: 0.5px solid var(--gold-border);
    border-radius: 14px;
    overflow: hidden;
  }
  .jw-modal .modal-header {
    background: var(--dark-bg);
    border-bottom: 0.5px solid var(--gold-border);
    padding: 16px 20px;
  }
  .jw-modal .modal-title {
    font-family: var(--font-display);
    color: var(--cream);
    font-size: 17px;
  }
  .jw-modal .btn-close { filter: invert(1) brightness(0.6); }
  .jw-modal .modal-body { padding: 20px; }
  .jw-modal .modal-footer {
    border-top: 0.5px solid rgba(0,0,0,0.06);
    padding: 12px 20px;
    gap: 8px;
  }
  .jw-select {
    width: 100%;
    padding: 9px 14px;
    border: 0.5px solid rgba(0,0,0,0.12);
    border-radius: 8px;
    font-size: 13px;
    font-family: var(--font-body);
    color: #374151;
    background: #fff;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    outline: none;
    transition: border-color 0.15s;
  }
  .jw-select:focus { border-color: var(--gold); }
  .jw-modal-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #9ca3af;
    margin-bottom: 6px;
    display: block;
  }

  /* Paginación */
  .jw-card-footer .pagination { margin: 0; }
  .jw-card-footer .page-link {
    border-color: rgba(0,0,0,0.08);
    color: #374151;
    font-size: 13px;
    border-radius: 6px !important;
    margin: 0 2px;
  }
  .jw-card-footer .page-item.active .page-link {
    background: var(--gold);
    border-color: var(--gold);
    color: #0f0c08;
  }
  .jw-card-footer .page-link:hover { background: var(--gold-dim); color: #1a1a1a; }
</style>
@endpush

@section('contenido')
<div class="app-content">
  <div class="container-fluid py-3">

    <div class="jw-card">

      {{-- Header --}}
      <div class="jw-card-header">
        <h3 class="jw-section-title">
          <i class="bi bi-bag-heart me-2" style="color:var(--gold);font-size:18px;"></i>
          Pedidos
        </h3>
        <form action="{{ route('perfil.pedidos') }}" method="get" class="jw-search-form">
          <input name="texto" type="text" value="{{ $texto }}" placeholder="Buscar pedido...">
          <button type="submit">
            <i class="bi bi-search"></i> Buscar
          </button>
        </form>
      </div>

      {{-- Body --}}
      <div class="jw-card-body">

        @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show mb-3" style="border-radius:8px;font-size:13px;">
          {{ Session::get('mensaje') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="table-responsive">
          <table class="jw-table">
            <thead>
              <tr>
                <th>Acciones</th>
                <th>#</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Detalles</th>
              </tr>
            </thead>
            <tbody>
              @if(count($registros) <= 0)
                <tr class="empty-row">
                  <td colspan="7">
                    <i class="bi bi-inbox" style="font-size:32px;display:block;margin-bottom:8px;color:var(--gold);opacity:0.4;"></i>
                    No hay pedidos que coincidan con la búsqueda
                  </td>
                </tr>
              @else
                @foreach($registros as $reg)

                {{-- Fila principal --}}
                <tr>
                  <td>
                    <button class="jw-btn jw-btn-gold"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-estado-{{ $reg->id }}">
                      <i class="bi bi-arrow-repeat"></i> Estado
                    </button>
                  </td>
                  <td><span class="jw-id-badge">#{{ $reg->id }}</span></td>
                  <td>{{ $reg->created_at->format('d/m/Y') }}</td>
                  <td>
                    <div style="display:flex;align-items:center;gap:8px;">
                      <div style="width:28px;height:28px;border-radius:50%;background:var(--gold-dim);border:1px solid var(--gold-border);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:12px;color:var(--gold);flex-shrink:0;">
                        {{ strtoupper(substr($reg->user->name, 0, 1)) }}
                      </div>
                      {{ $reg->user->name }}
                    </div>
                  </td>
                  <td style="font-family:var(--font-display);font-size:15px;color:#1a1a1a;">
                    ${{ number_format($reg->total, 2) }}
                  </td>
                  <td>
                    @php
                      $estadoClass = match($reg->estado) {
                        'pendiente' => 'badge-pendiente',
                        'enviado'   => 'badge-enviado',
                        'anulado'   => 'badge-anulado',
                        'cancelado' => 'badge-cancelado',
                        default     => 'badge-pendiente',
                      };
                    @endphp
                    <span class="jw-badge-status {{ $estadoClass }}">
                      {{ ucfirst($reg->estado) }}
                    </span>
                  </td>
                  <td>
                    <button class="jw-btn jw-btn-blue"
                            data-bs-toggle="collapse"
                            data-bs-target="#detalles-{{ $reg->id }}">
                      <i class="bi bi-chevron-down"></i> Ver
                    </button>
                  </td>
                </tr>

                {{-- Fila de detalles colapsable --}}
                <tr class="jw-details-row collapse" id="detalles-{{ $reg->id }}">
                  <td colspan="7">
                    <div class="jw-details-inner">
                      <div class="jw-details-title">
                        <i class="bi bi-list-ul me-1" style="color:var(--gold);"></i>
                        Detalle del pedido #{{ $reg->id }}
                      </div>
                      <table class="jw-details-table">
                        <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($reg->detalles as $detalle)
                          <tr>
                            <td style="font-weight:500;color:#1a1a1a;">
                              {{ $detalle->producto->nombre }}
                            </td>
                            <td>
                              @if($detalle->producto->imagen)
                                <img src="{{ asset('uploads/productos/' . $detalle->producto->imagen) }}"
                                     class="jw-product-img"
                                     alt="{{ $detalle->producto->nombre }}">
                              @else
                                <div class="jw-product-img-placeholder">💍</div>
                              @endif
                            </td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio, 2) }}</td>
                            <td class="jw-subtotal">
                              ${{ number_format($detalle->cantidad * $detalle->precio, 2) }}
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </td>
                </tr>

                {{-- Modal cambiar estado --}}
                @include('pedido.state')

                @endforeach
              @endif
            </tbody>
          </table>
        </div>

      </div>

      {{-- Footer con paginación --}}
      <div class="jw-card-footer">
        {{ $registros->appends(['texto' => $texto])->links() }}
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuPedidos').classList.add('active');

  // Al colapsar detalles, cambia el icono del botón
  document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
    const target = document.querySelector(btn.getAttribute('data-bs-target'));
    if (!target) return;
    target.addEventListener('show.bs.collapse', () => {
      btn.innerHTML = '<i class="bi bi-chevron-up"></i> Ocultar';
    });
    target.addEventListener('hide.bs.collapse', () => {
      btn.innerHTML = '<i class="bi bi-chevron-down"></i> Ver';
    });
  });
</script>
@endpush