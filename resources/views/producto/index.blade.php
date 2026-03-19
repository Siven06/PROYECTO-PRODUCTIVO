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

  /* Buscador + acciones */
  .jw-toolbar {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }
  .jw-search-form {
    display: flex;
    align-items: center;
    background: #f5f5f3;
    border: 0.5px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
    width: 280px;
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
    padding: 8px 14px;
    color: #0f0c08;
    font-size: 13px;
    cursor: pointer;
    font-family: var(--font-body);
    font-weight: 500;
    transition: background 0.15s;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .jw-search-form button:hover { background: var(--gold-light); }

  /* Botones */
  .jw-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 14px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: opacity 0.15s, transform 0.1s;
    font-family: var(--font-body);
    white-space: nowrap;
    line-height: 1;
  }
  .jw-btn:active { transform: scale(0.97); }
  .jw-btn-new {
    background: var(--dark-bg);
    color: var(--gold) !important;
    border: 1px solid var(--gold-border);
  }
  .jw-btn-new:hover { background: var(--dark-surface); }
  .jw-btn-edit {
    background: rgba(59,130,246,0.1);
    color: #1d4ed8;
    border: 0.5px solid rgba(59,130,246,0.2);
  }
  .jw-btn-edit:hover { background: rgba(59,130,246,0.18); }
  .jw-btn-delete {
    background: rgba(239,68,68,0.08);
    color: #b91c1c;
    border: 0.5px solid rgba(239,68,68,0.2);
  }
  .jw-btn-delete:hover { background: rgba(239,68,68,0.15); }

  /* Tabla */
  .jw-table { width: 100%; border-collapse: collapse; }
  .jw-table thead tr { border-bottom: 1px solid #f0f0f0; }
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

  /* Celda de producto */
  .jw-product-cell {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .jw-product-thumb {
    width: 48px;
    height: 48px;
    border-radius: 9px;
    object-fit: cover;
    border: 0.5px solid rgba(0,0,0,0.08);
    flex-shrink: 0;
  }
  .jw-product-thumb-placeholder {
    width: 48px;
    height: 48px;
    border-radius: 9px;
    background: linear-gradient(135deg, #f5e8c0, #D4AF37);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }
  .jw-product-name {
    font-size: 13px;
    font-weight: 500;
    color: #1a1a1a;
  }

  /* ID y código */
  .jw-id-badge {
    font-family: var(--font-display);
    font-size: 15px;
    color: #1a1a1a;
    font-weight: 500;
  }
  .jw-codigo {
    font-size: 11px;
    background: rgba(212,175,55,0.12);
    color: #92700a;
    border: 0.5px solid var(--gold-border);
    padding: 3px 9px;
    border-radius: 6px;
    font-family: monospace;
    letter-spacing: 0.5px;
  }

  /* Precio */
  .jw-precio {
    font-family: var(--font-display);
    font-size: 15px;
    color: #1a1a1a;
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

  /* Modal eliminar */
  .jw-modal .modal-content {
    border: 0.5px solid rgba(239,68,68,0.2);
    border-radius: 14px;
    overflow: hidden;
  }
  .jw-modal .modal-header {
    background: #fff5f5;
    border-bottom: 0.5px solid rgba(239,68,68,0.15);
    padding: 16px 20px;
  }
  .jw-modal .modal-title {
    font-family: var(--font-display);
    font-size: 17px;
    color: #b91c1c;
  }
  .jw-modal .modal-body {
    padding: 20px;
    font-size: 13px;
    color: #374151;
  }
  .jw-modal .modal-footer {
    border-top: 0.5px solid rgba(0,0,0,0.06);
    padding: 12px 20px;
    gap: 8px;
  }
</style>
@endpush

@section('contenido')
<div class="app-content">
  <div class="container-fluid py-3">

    <div class="jw-card">

      {{-- Header --}}
      <div class="jw-card-header">
        <h3 class="jw-section-title">
          <i class="bi bi-gem me-2" style="color:var(--gold);font-size:18px;"></i>
          Productos
        </h3>
        <div class="jw-toolbar">
          <form action="{{ route('productos.index') }}" method="get" class="jw-search-form">
            <input name="texto" type="text" value="{{ $texto }}" placeholder="Buscar producto...">
            <button type="submit">
              <i class="bi bi-search"></i> Buscar
            </button>
          </form>
          @can('producto-create')
          <a href="{{ route('productos.create') }}" class="jw-btn jw-btn-new">
            <i class="bi bi-plus-lg"></i> Nuevo producto
          </a>
          @endcan
        </div>
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
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
              </tr>
            </thead>
            <tbody>
              @if(count($registros) <= 0)
                <tr class="empty-row">
                  <td colspan="6">
                    <i class="bi bi-gem" style="font-size:32px;display:block;margin-bottom:8px;color:var(--gold);opacity:0.4;"></i>
                    No hay productos que coincidan con la búsqueda
                  </td>
                </tr>
              @else
                @foreach($registros as $reg)
                <tr>
                  {{-- Acciones --}}
                  <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                      @can('producto-edit')
                      <a href="{{ route('productos.edit', $reg->id) }}" class="jw-btn jw-btn-edit">
                        <i class="bi bi-pencil-fill"></i> Editar
                      </a>
                      @endcan
                      @can('producto-delete')
                      <button class="jw-btn jw-btn-delete"
                              data-bs-toggle="modal"
                              data-bs-target="#modal-eliminar-{{ $reg->id }}">
                        <i class="bi bi-trash-fill"></i> Eliminar
                      </button>
                      @endcan
                    </div>
                  </td>

                  {{-- ID --}}
                  <td><span class="jw-id-badge">#{{ $reg->id }}</span></td>

                  {{-- Código --}}
                  <td><span class="jw-codigo">{{ $reg->codigo }}</span></td>

                  {{-- Nombre con imagen inline --}}
                  <td>
                    <div class="jw-product-cell">
                      @if($reg->imagen)
                        <img src="{{ asset('uploads/productos/' . $reg->imagen) }}"
                             alt="{{ $reg->nombre }}"
                             class="jw-product-thumb">
                      @else
                        <div class="jw-product-thumb-placeholder">💍</div>
                      @endif
                      <span class="jw-product-name">{{ $reg->nombre }}</span>
                    </div>
                  </td>

                  {{-- Precio --}}
                  <td>
                    <span class="jw-precio">${{ number_format($reg->precio, 2) }}</span>
                  </td>

                  {{-- Imagen grande (columna separada) --}}
                  <td>
                    @if($reg->imagen)
                      <img src="{{ asset('uploads/productos/' . $reg->imagen) }}"
                           alt="{{ $reg->nombre }}"
                           style="width:64px;height:64px;object-fit:cover;border-radius:9px;border:0.5px solid rgba(0,0,0,0.08);">
                    @else
                      <span style="font-size:11px;color:#9ca3af;font-style:italic;">Sin imagen</span>
                    @endif
                  </td>
                </tr>

                {{-- Modal eliminar --}}
                @can('producto-delete')
                  @include('producto.delete')
                @endcan

                @endforeach
              @endif
            </tbody>
          </table>
        </div>

      </div>

      {{-- Footer paginación --}}
      <div class="jw-card-footer">
        {{ $registros->appends(['texto' => $texto])->links() }}
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuAlmacen').classList.add('menu-open');
  document.getElementById('itemProducto').classList.add('active');
</script>
@endpush