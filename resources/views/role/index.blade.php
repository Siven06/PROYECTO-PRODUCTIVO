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
  .jw-card-body  { padding: 20px 24px; }
  .jw-card-footer {
    padding: 14px 24px;
    border-top: 0.5px solid rgba(0,0,0,0.06);
    background: #fafaf8;
  }

  /* Toolbar */
  .jw-toolbar { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
  .jw-search-form {
    display: flex; align-items: center;
    background: #f5f5f3;
    border: 0.5px solid rgba(0,0,0,0.1);
    border-radius: 8px; overflow: hidden; width: 280px;
  }
  .jw-search-form input {
    flex: 1; border: none; background: transparent;
    padding: 8px 14px; font-size: 13px; color: #1a1a1a;
    outline: none; font-family: var(--font-body);
  }
  .jw-search-form input::placeholder { color: #aaa; }
  .jw-search-form button {
    background: var(--gold); border: none; padding: 8px 14px;
    color: #0f0c08; font-size: 13px; cursor: pointer;
    font-family: var(--font-body); font-weight: 500;
    transition: background 0.15s;
    display: flex; align-items: center; gap: 5px;
  }
  .jw-search-form button:hover { background: var(--gold-light); }

  /* Botones */
  .jw-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 12px; border-radius: 7px; font-size: 12px;
    font-weight: 500; border: none; cursor: pointer;
    text-decoration: none; transition: opacity 0.15s, transform 0.1s;
    font-family: var(--font-body); white-space: nowrap; line-height: 1;
  }
  .jw-btn:active { transform: scale(0.97); }
  .jw-btn-new {
    background: var(--dark-bg); color: var(--gold) !important;
    border: 1px solid var(--gold-border);
  }
  .jw-btn-new:hover { background: var(--dark-surface); }
  .jw-btn-edit {
    background: rgba(59,130,246,0.1); color: #1d4ed8;
    border: 0.5px solid rgba(59,130,246,0.2);
  }
  .jw-btn-edit:hover { background: rgba(59,130,246,0.18); }
  .jw-btn-delete {
    background: rgba(239,68,68,0.08); color: #b91c1c;
    border: 0.5px solid rgba(239,68,68,0.2);
  }
  .jw-btn-delete:hover { background: rgba(239,68,68,0.15); }

  /* Tabla */
  .jw-table { width: 100%; border-collapse: collapse; }
  .jw-table thead tr { border-bottom: 1px solid #f0f0f0; }
  .jw-table th {
    font-size: 10px; text-transform: uppercase; letter-spacing: 1px;
    color: #9ca3af; font-weight: 500; padding: 10px 14px;
    text-align: left; white-space: nowrap;
  }
  .jw-table td {
    padding: 14px 14px; font-size: 13px; color: #374151;
    border-bottom: 0.5px solid #f5f5f5; vertical-align: middle;
  }
  .jw-table tr:last-child td { border-bottom: none; }
  .jw-table tbody tr:hover td { background: #fafaf8; }
  .jw-table .empty-row td { text-align: center; padding: 40px; color: #9ca3af; }

  /* Celda de rol */
  .jw-role-cell { display: flex; align-items: center; gap: 12px; }
  .jw-role-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: var(--dark-bg);
    border: 1px solid var(--gold-border);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 16px; flex-shrink: 0;
  }
  .jw-role-name { font-size: 14px; font-weight: 500; color: #1a1a1a; }
  .jw-role-id   { font-size: 11px; color: #9ca3af; }

  /* Permisos */
  .jw-perms-wrap {
    display: flex; flex-wrap: wrap; gap: 5px;
    max-width: 600px;
  }
  .jw-perm-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10px; padding: 3px 9px; border-radius: 20px;
    font-weight: 500; white-space: nowrap;
    border: 0.5px solid transparent;
  }
  /* Color según prefijo del permiso */
  .perm-user    { background: rgba(59,130,246,0.1);  color: #1d4ed8; border-color: rgba(59,130,246,0.2); }
  .perm-rol     { background: rgba(139,92,246,0.1);  color: #6d28d9; border-color: rgba(139,92,246,0.2); }
  .perm-producto{ background: rgba(212,175,55,0.12); color: #92700a; border-color: var(--gold-border); }
  .perm-pedido  { background: rgba(16,185,129,0.1);  color: #065f46; border-color: rgba(16,185,129,0.2); }
  .perm-default { background: rgba(107,114,128,0.1); color: #374151; border-color: rgba(107,114,128,0.2); }
  .jw-no-perms  { font-size: 12px; color: #9ca3af; font-style: italic; }

  /* Contador de permisos */
  .jw-perm-count {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 11px; color: #9ca3af; margin-top: 4px;
  }

  /* Paginación */
  .jw-card-footer .pagination { margin: 0; }
  .jw-card-footer .page-link {
    border-color: rgba(0,0,0,0.08); color: #374151;
    font-size: 13px; border-radius: 6px !important; margin: 0 2px;
  }
  .jw-card-footer .page-item.active .page-link {
    background: var(--gold); border-color: var(--gold); color: #0f0c08;
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
          <i class="bi bi-shield-check me-2" style="color:var(--gold);font-size:18px;"></i>
          Roles
        </h3>
        <div class="jw-toolbar">
          <form action="{{ route('roles.index') }}" method="get" class="jw-search-form">
            <input name="texto" type="text" value="{{ $texto }}" placeholder="Buscar rol...">
            <button type="submit">
              <i class="bi bi-search"></i> Buscar
            </button>
          </form>
          @can('rol-create')
          <a href="{{ route('roles.create') }}" class="jw-btn jw-btn-new">
            <i class="bi bi-plus-lg"></i> Nuevo rol
          </a>
          @endcan
        </div>
      </div>

      {{-- Body --}}
      <div class="jw-card-body">

        @if(Session::has('mensaje'))
        <div class="alert alert-info alert-dismissible fade show mb-3"
             style="border-radius:8px;font-size:13px;">
          {{ Session::get('mensaje') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="table-responsive">
          <table class="jw-table">
            <thead>
              <tr>
                <th>Acciones</th>
                <th>Rol</th>
                <th>Permisos asignados</th>
              </tr>
            </thead>
            <tbody>

              @if(count($registros) <= 0)
                <tr class="empty-row">
                  <td colspan="3">
                    <i class="bi bi-shield" style="font-size:32px;display:block;margin-bottom:8px;color:var(--gold);opacity:0.4;"></i>
                    No hay roles que coincidan con la búsqueda
                  </td>
                </tr>
              @else
                @foreach($registros as $reg)
                <tr>

                  {{-- Acciones --}}
                  <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;align-items:center;">
                      @can('rol-edit')
                      <a href="{{ route('roles.edit', $reg->id) }}" class="jw-btn jw-btn-edit">
                        <i class="bi bi-pencil-fill"></i> Editar
                      </a>
                      @endcan
                      @can('rol-delete')
                      <button class="jw-btn jw-btn-delete"
                              data-bs-toggle="modal"
                              data-bs-target="#modal-eliminar-{{ $reg->id }}">
                        <i class="bi bi-trash-fill"></i> Eliminar
                      </button>
                      @endcan
                    </div>
                  </td>

                  {{-- Rol (icono + nombre + id) --}}
                  <td>
                    <div class="jw-role-cell">
                      <div class="jw-role-icon">
                        <i class="bi bi-shield-lock"></i>
                      </div>
                      <div>
                        <div class="jw-role-name">{{ $reg->name }}</div>
                        <div class="jw-role-id">#{{ $reg->id }}</div>
                      </div>
                    </div>
                  </td>

                  {{-- Permisos --}}
                  <td>
                    @if($reg->permissions->isNotEmpty())
                      <div class="jw-perms-wrap">
                        @foreach($reg->permissions as $permiso)
                          @php
                            $prefix = explode('-', $permiso->name)[0];
                            $colorClass = match($prefix) {
                              'user'     => 'perm-user',
                              'rol'      => 'perm-rol',
                              'producto' => 'perm-producto',
                              'pedido'   => 'perm-pedido',
                              default    => 'perm-default',
                            };
                          @endphp
                          <span class="jw-perm-badge {{ $colorClass }}">
                            <i class="bi bi-check" style="font-size:10px;"></i>
                            {{ $permiso->name }}
                          </span>
                        @endforeach
                      </div>
                      <div class="jw-perm-count">
                        <i class="bi bi-key" style="font-size:10px;"></i>
                        {{ $reg->permissions->count() }} {{ $reg->permissions->count() === 1 ? 'permiso' : 'permisos' }}
                      </div>
                    @else
                      <span class="jw-no-perms">Sin permisos asignados</span>
                    @endif
                  </td>

                </tr>

                {{-- Modal eliminar --}}
                @can('rol-delete')
                  @include('role.delete')
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
  document.getElementById('mnuSeguridad').classList.add('menu-open');
  document.getElementById('itemRole').classList.add('active');
</script>
@endpush