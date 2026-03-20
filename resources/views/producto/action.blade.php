@extends('plantilla.app')

@push('estilos')
<style>
  .jw-form-wrapper { max-width: 860px; }
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
    gap: 14px;
  }
  .jw-card-header-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: var(--dark-bg);
    border: 1px solid var(--gold-border);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 18px; flex-shrink: 0;
  }
  .jw-card-title {
    font-family: var(--font-display);
    font-size: 20px; font-weight: 500; color: #1a1a1a; margin: 0;
  }
  .jw-card-subtitle { font-size: 12px; color: #9ca3af; margin-top: 1px; }
  .jw-card-body   { padding: 28px 28px 20px; }
  .jw-card-footer {
    padding: 16px 28px;
    border-top: 0.5px solid rgba(0,0,0,0.06);
    background: #fafaf8;
    display: flex; justify-content: flex-end; gap: 10px;
  }

  /* Edit pill */
  .jw-edit-pill {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(212,175,55,0.1); color: #92700a;
    border: 0.5px solid var(--gold-border);
    font-size: 11px; padding: 3px 10px; border-radius: 20px;
    margin-left: auto;
  }

  /* Secciones */
  .jw-form-section {
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 0.5px solid rgba(0,0,0,0.05);
  }
  .jw-form-section:last-child {
    margin-bottom: 0; padding-bottom: 0; border-bottom: none;
  }
  .jw-section-label {
    font-size: 10px; text-transform: uppercase;
    letter-spacing: 1.5px; color: #9ca3af;
    font-weight: 500; margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
  }
  .jw-section-label::after {
    content: ''; flex: 1; height: 0.5px; background: rgba(0,0,0,0.07);
  }

  /* Campos */
  .jw-label {
    display: block; font-size: 13px; font-weight: 500;
    color: #374151; margin-bottom: 6px; letter-spacing: 0.2px;
  }
  .jw-label .required { color: var(--gold); margin-left: 3px; }
  .jw-input,
  .jw-textarea {
    width: 100%; padding: 9px 14px;
    border: 0.5px solid rgba(0,0,0,0.14);
    border-radius: 8px; font-size: 14px;
    font-family: var(--font-body); color: #1a1a1a;
    background: #fff; outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .jw-textarea { resize: vertical; min-height: 110px; line-height: 1.6; }
  .jw-input:focus,
  .jw-textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
  }
  .jw-input.is-invalid,
  .jw-textarea.is-invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
  }
  .jw-input::placeholder,
  .jw-textarea::placeholder { color: #c0c0c0; }
  .jw-error {
    font-size: 11px; color: #ef4444;
    margin-top: 4px; display: flex; align-items: center; gap: 4px;
  }
  .jw-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }

  /* Input con prefijo (precio) */
  .jw-input-group {
    display: flex; align-items: stretch;
    border: 0.5px solid rgba(0,0,0,0.14);
    border-radius: 8px; overflow: hidden;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  .jw-input-group:focus-within {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
  }
  .jw-input-group.is-invalid { border-color: #ef4444; }
  .jw-input-prefix {
    padding: 9px 12px;
    background: #f5f5f3;
    border-right: 0.5px solid rgba(0,0,0,0.1);
    font-size: 14px; color: #9ca3af;
    display: flex; align-items: center;
    font-family: var(--font-display);
    flex-shrink: 0;
  }
  .jw-input-group .jw-input {
    border: none !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    flex: 1;
  }

  /* Upload de imagen */
  .jw-upload-area {
    border: 1.5px dashed rgba(212,175,55,0.4);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    position: relative;
    background: rgba(212,175,55,0.02);
  }
  .jw-upload-area:hover {
    border-color: var(--gold);
    background: rgba(212,175,55,0.05);
  }
  .jw-upload-area.dragging {
    border-color: var(--gold);
    background: rgba(212,175,55,0.08);
  }
  .jw-upload-area input[type="file"] {
    position: absolute; inset: 0;
    opacity: 0; cursor: pointer; width: 100%; height: 100%;
  }
  .jw-upload-icon {
    font-size: 28px; color: var(--gold);
    opacity: 0.6; margin-bottom: 8px; display: block;
  }
  .jw-upload-text { font-size: 13px; color: #6b7280; }
  .jw-upload-text strong { color: var(--gold); }
  .jw-upload-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }

  /* Preview imagen */
  .jw-img-preview-wrap {
    margin-top: 14px;
    display: flex; align-items: flex-start; gap: 12px;
  }
  .jw-img-preview {
    width: 100px; height: 100px;
    object-fit: cover; border-radius: 10px;
    border: 0.5px solid rgba(0,0,0,0.1);
  }
  .jw-img-preview-placeholder {
    width: 100px; height: 100px;
    border-radius: 10px;
    background: linear-gradient(135deg, #f5e8c0, #D4AF37);
    display: flex; align-items: center; justify-content: center;
    font-size: 40px; flex-shrink: 0;
  }
  .jw-img-meta { font-size: 12px; color: #6b7280; padding-top: 4px; }
  .jw-img-meta strong { color: #1a1a1a; display: block; margin-bottom: 2px; font-size: 13px; }
  .jw-img-remove {
    font-size: 11px; color: #ef4444;
    background: none; border: none; cursor: pointer;
    padding: 0; margin-top: 6px; display: flex;
    align-items: center; gap: 4px; font-family: var(--font-body);
  }
  .jw-img-remove:hover { text-decoration: underline; }

  /* Botones */
  .jw-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 20px; border-radius: 8px; font-size: 13px;
    font-weight: 500; border: none; cursor: pointer;
    text-decoration: none; transition: all 0.15s;
    font-family: var(--font-body); line-height: 1;
  }
  .jw-btn:active { transform: scale(0.98); }
  .jw-btn-cancel {
    background: transparent; color: #6b7280;
    border: 0.5px solid rgba(0,0,0,0.15);
  }
  .jw-btn-cancel:hover { background: #f5f5f3; color: #374151; }
  .jw-btn-save {
    background: var(--dark-bg); color: var(--gold);
    border: 1px solid var(--gold-border);
  }
  .jw-btn-save:hover { background: var(--dark-surface); }
</style>
@endpush

@section('contenido')
<div class="app-content">
  <div class="container-fluid py-3">
    <div class="jw-form-wrapper">
      <div class="jw-card">

        {{-- Header --}}
        <div class="jw-card-header">
          <div class="jw-card-header-icon">
            <i class="bi bi-gem"></i>
          </div>
          <div>
            <h3 class="jw-card-title">
              {{ isset($registro) ? 'Editar producto' : 'Nuevo producto' }}
            </h3>
            <div class="jw-card-subtitle">
              {{ isset($registro) ? 'Modifica los datos del producto' : 'Completa los datos para registrar un nuevo producto' }}
            </div>
          </div>
          @isset($registro)
          <div class="jw-edit-pill" style="margin-left:auto;">
            <i class="bi bi-tag" style="font-size:10px;"></i>
            {{ $registro->codigo }}
          </div>
          @endisset
        </div>

        {{-- Formulario --}}
        <form action="{{ isset($registro) ? route('productos.update', $registro->id) : route('productos.store') }}"
              method="POST" enctype="multipart/form-data" id="formProducto">
          @csrf
          @isset($registro)
            @method('PUT')
          @endisset

          <div class="jw-card-body">

            {{-- ── Sección 1: Identificación ── --}}
            <div class="jw-form-section">
              <div class="jw-section-label">
                <i class="bi bi-tag" style="font-size:11px;color:var(--gold);"></i>
                Identificación del producto
              </div>

              <div class="row g-3">
                <div class="col-md-4">
                  <label for="codigo" class="jw-label">
                    Código <span class="required">*</span>
                  </label>
                  <input type="text"
                         class="jw-input @error('codigo') is-invalid @enderror"
                         id="codigo" name="codigo"
                         value="{{ old('codigo', $registro->codigo ?? '') }}"
                         placeholder="Ej. SKU-0012"
                         required>
                  @error('codigo')
                    <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-5">
                  <label for="nombre" class="jw-label">
                    Nombre <span class="required">*</span>
                  </label>
                  <input type="text"
                         class="jw-input @error('nombre') is-invalid @enderror"
                         id="nombre" name="nombre"
                         value="{{ old('nombre', $registro->nombre ?? '') }}"
                         placeholder="Ej. Anillo Solitario Oro 18k"
                         required>
                  @error('nombre')
                    <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-3">
                  <label for="precio" class="jw-label">
                    Precio <span class="required">*</span>
                  </label>
                  <div class="jw-input-group @error('precio') is-invalid @enderror">
                    <span class="jw-input-prefix">$</span>
                    <input type="number"
                           class="jw-input"
                           id="precio" name="precio"
                           value="{{ old('precio', $registro->precio ?? '') }}"
                           placeholder="0.00"
                           step="0.01" min="0"
                           required>
                  </div>
                  @error('precio')
                    <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            {{-- ── Sección 2: Descripción e imagen ── --}}
            <div class="jw-form-section">
              <div class="jw-section-label">
                <i class="bi bi-card-text" style="font-size:11px;color:var(--gold);"></i>
                Descripción e imagen
              </div>

              <div class="row g-3">

                {{-- Descripción --}}
                <div class="col-md-7">
                  <label for="descripcion" class="jw-label">Descripción</label>
                  <textarea name="descripcion"
                            class="jw-textarea @error('descripcion') is-invalid @enderror"
                            id="descripcion"
                            placeholder="Describe el producto: materiales, características, medidas...">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>
                  @error('descripcion')
                    <div class="jw-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                  @enderror
                  <div class="jw-hint">
                    <span id="charCount">0</span> caracteres
                  </div>
                </div>

                {{-- Imagen --}}
                <div class="col-md-5">
                  <label class="jw-label">Imagen del producto</label>

                  <div class="jw-upload-area" id="uploadArea">
                    <input type="file"
                           id="imagen" name="imagen"
                           accept="image/*"
                           onchange="handleImageChange(this)">
                    <i class="bi bi-cloud-arrow-up jw-upload-icon"></i>
                    <div class="jw-upload-text">
                      <strong>Haz clic</strong> o arrastra una imagen aquí
                    </div>
                    <div class="jw-upload-hint">PNG, JPG, WEBP · Máx. 2MB</div>
                  </div>
                  @error('imagen')
                    <div class="jw-error mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                  @enderror

                  {{-- Preview nueva imagen --}}
                  <div class="jw-img-preview-wrap" id="newPreview" style="display:none;">
                    <img src="" id="newPreviewImg" class="jw-img-preview" alt="Preview">
                    <div class="jw-img-meta">
                      <strong id="newPreviewName">—</strong>
                      <span id="newPreviewSize">—</span>
                      <button type="button" class="jw-img-remove" onclick="removeImage()">
                        <i class="bi bi-x-circle"></i> Quitar imagen
                      </button>
                    </div>
                  </div>

                  {{-- Imagen actual (modo edición) --}}
                  @isset($registro)
                    @if($registro->imagen)
                    <div class="jw-img-preview-wrap" id="currentPreview">
                      <img src="{{ asset('uploads/productos/' . $registro->imagen) }}"
                           class="jw-img-preview" alt="{{ $registro->nombre }}">
                      <div class="jw-img-meta">
                        <strong>Imagen actual</strong>
                        <span>{{ $registro->imagen }}</span>
                        <span style="font-size:11px;color:#9ca3af;margin-top:2px;display:block;">
                          Sube una nueva para reemplazarla
                        </span>
                      </div>
                    </div>
                    @endif
                  @endisset

                </div>
              </div>
            </div>

          </div>{{-- /card-body --}}

          {{-- Footer --}}
          <div class="jw-card-footer">
            <button type="button" class="jw-btn jw-btn-cancel"
                    onclick="window.location.href='{{ route('productos.index') }}'">
              <i class="bi bi-x-lg"></i> Cancelar
            </button>
            <button type="submit" class="jw-btn jw-btn-save">
              <i class="bi bi-check-lg"></i>
              {{ isset($registro) ? 'Guardar cambios' : 'Crear producto' }}
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('mnuAlmacen').classList.add('menu-open');
  document.getElementById('itemProducto').classList.add('active');

  // ── Contador de caracteres en descripción ──
  const descripcion = document.getElementById('descripcion');
  const charCount   = document.getElementById('charCount');
  function updateCount() {
    charCount.textContent = descripcion.value.length;
  }
  updateCount();
  descripcion.addEventListener('input', updateCount);

  // ── Preview de imagen ──
  const uploadArea  = document.getElementById('uploadArea');
  const newPreview  = document.getElementById('newPreview');
  const newImg      = document.getElementById('newPreviewImg');
  const newName     = document.getElementById('newPreviewName');
  const newSize     = document.getElementById('newPreviewSize');
  const currentPrev = document.getElementById('currentPreview');

  function handleImageChange(input) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
      newImg.src         = e.target.result;
      newName.textContent = file.name;
      newSize.textContent = (file.size / 1024).toFixed(1) + ' KB';
      newPreview.style.display = 'flex';
      // Ocultar imagen actual si se reemplaza
      if (currentPrev) currentPrev.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }

  function removeImage() {
    document.getElementById('imagen').value = '';
    newPreview.style.display = 'none';
    newImg.src = '';
    // Restaurar imagen actual si existe
    if (currentPrev) currentPrev.style.display = 'flex';
  }

  // ── Drag & drop visual ──
  uploadArea.addEventListener('dragover',  e => { e.preventDefault(); uploadArea.classList.add('dragging'); });
  uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragging'));
  uploadArea.addEventListener('drop', e => {
    e.preventDefault();
    uploadArea.classList.remove('dragging');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
      const input = document.getElementById('imagen');
      const dt    = new DataTransfer();
      dt.items.add(file);
      input.files = dt.files;
      handleImageChange(input);
    }
  });
</script>
@endpush