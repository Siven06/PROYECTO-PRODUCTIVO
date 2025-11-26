@extends('web.app')
@section('contenido')
<style>
    body {
        background: #0e0e0e;
        font-family: "Poppins", sans-serif;
    }

    /* ===== CONTENEDORES ===== */
    .lux-card {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    .lux-header {
        background: rgba(255, 215, 0, 0.1) !important;
        border-bottom: 1px solid rgba(255, 215, 0, 0.3);
        color: #FFD700 !important;
        font-weight: 600;
    }

    /* ===== TÍTULOS ===== */
    .lux-title {
        color: #FFD700;
        font-weight: 700;
    }

    /* ===== ITEMS DEL CARRITO ===== */
    .cart-item img {
        border-radius: 10px;
        border: 1px solid rgba(255, 215, 0, 0.4);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.35);
    }

    .cart-item h6 {
        color: #fff;
        font-weight: 600;
    }

    .cart-item small {
        color: #c9c9c9 !important;
    }

    .subtotal {
        color: #FFD700;
    }

    .total-label {
    color: #FFD700 !important; /* dorado */
}
    hr {
        border-top: 1px solid rgba(255, 215, 0, 0.2);
    }

    /* ===== INPUT CANTIDAD ===== */
    .input-group-sm .form-control {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,215,0,0.3);
    }

    .input-group-sm .btn {
        border: 1px solid rgba(255,215,0,0.4);
        color: #FFD700;
    }

    .input-group-sm .btn:hover {
        background: #FFD700;
        color: black;
    }

    /* ===== BOTONES ===== */
    .btn-lux-danger {
        border: 1px solid #ff6b6b;
        color: #ff6b6b;
    }

    .btn-lux-danger:hover {
        background: #ff6b6b;
        color: black;
    }

    .btn-lux-gold {
        border: 1px solid #FFD700;
        color: #FFD700;
    }

    .btn-lux-gold:hover {
        background: #FFD700;
        color: black;
    }

    /* ===== RESUMEN DEL PEDIDO ===== */
    .order-summary {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,215,0,0.3);
    }

    .order-total {
        color: #FFD700;
        font-size: 1.4rem;
        font-weight: 700;
    }

    /* ALERTAS */
    .alert-success {
        background: rgba(50, 150, 50, 0.3) !important;
        border: 1px solid rgba(0,255,0,0.3);
        color: #d6ffd6 !important;
    }

    .alert-danger {
        background: rgba(150, 0, 0, 0.3) !important;
        border: 1px solid rgba(255,0,0,0.3);
        color: #ffd6d6 !important;
    }

</style>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-12 my-5">

        <h2 class="fw-bold mb-4 lux-title">Detalle de su Pedido</h2>

        <div class="row">

            <!-- CARRITO -->
            <div class="col-lg-8">
                <div class="card mb-4 lux-card">

                    <div class="card-header lux-header">
                        <div class="row">
                            <div class="col-md-5"><strong>Producto</strong></div>
                            <div class="col-md-2 text-center"><strong>Precio</strong></div>
                            <div class="col-md-2 text-center"><strong>Cantidad</strong></div>
                            <div class="col-md-3 text-end"><strong>Subtotal</strong></div>
                        </div>
                    </div>

                    <div class="card-body" id="cartItems">

                        @forelse($carrito as $id => $item)

                        <div class="row align-items-center mb-3 cart-item">

                            <!-- Producto -->
                            <div class="col-md-5 d-flex align-items-center">
                                <img src="{{ asset('uploads/productos/' . $item['imagen']) }}"
                                     style="width: 80px; height: 80px; object-fit: cover;"
                                     alt="{{ $item['nombre'] }}">
                                <div class="ms-3">
                                    <h6 class="mb-0">{{ $item['nombre'] }}</h6>
                                    <small>{{ $item['codigo'] }}</small>
                                </div>
                            </div>

                            <!-- Precio -->
                            <div class="col-md-2 text-center">
                                <span class="fw-bold subtotal">
                                    ${{ number_format($item['precio'], 2) }}
                                </span>
                            </div>

                            <!-- Cantidad -->
                            <div class="col-md-2 d-flex justify-content-center">
                                <div class="input-group input-group-sm" style="max-width: 100px;">
                                    <a class="btn" href="{{ route('carrito.restar', ['producto_id' => $id]) }}">-</a>
                                    <input type="text" class="form-control text-center" value="{{ $item['cantidad'] }}" readonly>
                                    <a class="btn btn-sm" href="{{ route('carrito.sumar', ['producto_id' => $id]) }}">+</a>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="col-md-3 d-flex align-items-center justify-content-end">
                                <div class="text-end me-3 subtotal">
                                    ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                </div>
                                <a class="btn btn-sm btn-lux-danger"
                                   href="{{ route('carrito.eliminar', $id) }}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>

                        </div>

                        <hr>

                        @empty
                        <div class="text-center text-light">
                            <p>Tu carrito está vacío</p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Mensajes --}}
                    @if (session('mensaje'))
                        <div class="alert alert-success alert-dismissible fade show mt-3">
                            {{ session('mensaje') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card-footer p-3">
                        <div class="row">
                            <div class="col text-end">
                                <a class="btn btn-lux-danger me-2" href="{{route('carrito.vaciar')}}">
                                    <i class="bi bi-x-circle me-1"></i> Vaciar carrito
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RESUMEN -->
            <div class="col-lg-4">
                <div class="card order-summary lux-card">

                    <div class="card-header lux-header">
                        <h5 class="mb-0">Resumen del Pedido</h5>
                    </div>

                    <div class="card-body">

                        @php
                            $total = 0;
                            foreach ($carrito as $item) {
                                $total += $item['precio'] * $item['cantidad'];
                            }
                        @endphp

                        <div class="d-flex justify-content-between mb-4">
                            <strong class="total-label">Total</strong>
                            <strong class="order-total">${{ number_format($total, 2) }}</strong>
                        </div>

                        <!-- Realizar Pedido -->
                        <form action="{{route('pedido.realizar')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-lux-gold w-100">
                                <i class="bi bi-credit-card me-1"></i>
                                Realizar pedido
                            </button>
                        </form>

                        <!-- Seguir comprando -->
                        <a href="/" class="btn btn-outline-secondary w-100 mt-3">
                            <i class="bi bi-arrow-left me-1"></i> Continuar comprando
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection