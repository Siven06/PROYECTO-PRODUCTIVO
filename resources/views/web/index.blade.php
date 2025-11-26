@extends('web.app')
@section('header')
@endsection
@section('contenido')
<style>
    /* ==== ESTILO GENERAL ELEGANTE ==== */
    body {
        background: #0e0e0e; 
        font-family: "Poppins", sans-serif;
    }

    /* Buscador y filtros */
    .lux-input, .lux-select {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 215, 0, 0.3);
        color: #fff;
    }

    .lux-input:focus, .lux-select:focus {
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 12px rgba(255, 215, 0, 0.7);
        border-color: #FFD700;
        color: #fff;
    }

    .lux-label {
        background: rgba(255, 215, 0, 0.15);
        border: 1px solid rgba(255, 215, 0, 0.4);
        color: #FFD700;
    }

    .btn-lux-search {
        border: 1px solid #FFD700;
        color: #FFD700;
    }

    .btn-lux-search:hover {
        background: #FFD700;
        color: black;
        box-shadow: 0 0 10px #FFD700;
    }

    /* ==== TARJETAS DE PRODUCTO ==== */

    .lux-card {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 215, 0, 0.25);
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    }

    .lux-card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 25px rgba(255, 215, 0, 0.6);
        border-color: rgba(255, 215, 0, 0.6);
    }

    .lux-card img {
        height: 250px;
        object-fit: cover;
        border-bottom: 1px solid rgba(255, 215, 0, 0.3);
    }

    .lux-title {
        font-weight: 600;
        color: #FFD700;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .lux-price {
        color: white;
        font-size: 16px;
        opacity: 0.9;
    }

    .btn-lux-view {
        border: 1px solid #FFD700;
        color: #FFD700;
        transition: 0.3s;
    }

    .btn-lux-view:hover {
        background: #FFD700;
        color: black;
        box-shadow: 0 0 12px #FFD700;
    }

    /* ==== PAGINACIÓN ==== */
    .pagination .page-link {
        background: rgba(255, 255, 255, 0.08);
        color: #FFD700;
        border: 1px solid rgba(255, 215, 0, 0.3);
    }

    .pagination .page-link:hover {
        background: #FFD700;
        color: black;
        border-color: #FFD700;
    }

    .pagination .active .page-link {
        background: #FFD700 !important;
        color: black !important;
        border-color: #FFD700 !important;
    }
</style>
<form method="GET" action="{{route('web.index')}}">
    <div class="container px-4 px-lg-5 mt-4">
        <div class="row">
            <!-- Buscador -->
            <div class="col-md-8 mb-3">
                <div class="input-group">
                    <input type="text" 
                        class="form-control lux-input" 
                        id="searchInput" 
                        placeholder="Buscar productos..."
                        name="search" 
                        value="{{request('search')}}">

                    <button class="btn btn-lux-search" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>

            <!-- Orden -->
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <label class="input-group-text lux-label" for="sortSelect">Ordenar por:</label>
                    <select class="form-select lux-select" id="sortSelect" name="sort">
                        <option value="priceAsc" {{ request('sort') == 'priceAsc' ? 'selected' : '' }}>
                            Precio: menor a mayor
                        </option>
                        <option value="priceDesc" {{ request('sort') == 'priceDesc' ? 'selected' : '' }}>
                            Precio: mayor a menor
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Section-->
<!-- PRODUCTOS -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-1">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach($productos as $producto)
            <div class="col mb-5">
                <div class="card h-100 lux-card">

                    <!-- Imagen -->
                    <img src="{{asset('uploads/productos/'. $producto->imagen)}}" 
                         class="card-img-top" 
                         alt="{{$producto->nombre}}">

                    <!-- Detalles -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="lux-title">{{$producto->nombre}}</h5>
                            <div class="lux-price">$ {{number_format($producto->precio, 2)}}</div>
                        </div>
                    </div>

                    <!-- Botón -->
                    <div class="card-footer p-3 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-lux-view mt-auto"
                                href="{{route('web.show', $producto->id)}}">
                                Ver producto
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach

        </div>

        <!-- Paginación -->
        <div class="card-footer clearfix">
            {{ $productos->appends(['search' => request('search'), 'sort' => request('sort')])->links() }}
        </div>
    </div>
</section>
@endsection