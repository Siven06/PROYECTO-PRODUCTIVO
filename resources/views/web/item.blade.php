@extends('web.app')
@section('contenido')
<style>
    body {
        background: #0e0e0e;
        font-family: "Poppins", sans-serif;
    }

    /* ==== CONTENEDOR PRINCIPAL ==== */
    .product-container {
        background: rgba(255, 255, 255, 0.06);
        padding: 30px;
        border-radius: 15px;
        border: 1px solid rgba(255, 215, 0, 0.3);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
    }

    /* ==== IMAGEN ==== */
    .product-image {
        border-radius: 10px;
        border: 1px solid rgba(255, 215, 0, 0.35);
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.25);
        transition: 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.02);
        box-shadow: 0 0 35px rgba(255, 215, 0, 0.6);
    }

    /* ==== TEXTOS ==== */
    .product-sku {
        color: #e6c97a;
        opacity: 0.8;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .product-title {
        color: #FFD700;
        font-weight: 700;
        font-size: 2.2rem;
    }

    .product-price {
        font-size: 1.7rem;
        color: #fff;
        font-weight: 500;
        border-left: 3px solid #FFD700;
        padding-left: 10px;
    }

    .product-description {
        color: #ccc;
        font-size: 1rem;
        line-height: 1.6;
        margin-top: 15px;
    }

    /* ==== INPUT CANTIDAD ==== */
    .qty-input {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 215, 0, 0.4);
        color: white;
    }

    .qty-input:focus {
        background: rgba(255, 255, 255, 0.18);
        border-color: #FFD700;
        box-shadow: 0 0 12px rgba(255, 215, 0, 0.8);
        color: white;
    }

    /* ==== BOTONES ==== */
    .btn-lux {
        border: 1px solid #FFD700;
        color: #FFD700;
        transition: 0.3s;
        font-weight: 500;
    }

    .btn-lux:hover {
        background: #FFD700;
        color: black;
        box-shadow: 0 0 15px #FFD700;
    }

    .btn-back {
        border: 1px solid #999;
        color: #ccc;
    }

    .btn-back:hover {
        background: #ccc;
        color: black;
    }

    /* Alertas */
    .alert-success {
        background: rgba(0, 100, 0, 0.4);
        color: #d4f5d6;
        border: 1px solid rgba(0, 255, 0, 0.3);
    }
</style>
<!-- Section-->
<form action="{{route('carrito.agregar')}}" method="POST" class="d-flex">
@csrf

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">

        <div class="product-container">

            <div class="row gx-4 gx-lg-5 align-items-center">

                <!-- IMAGEN -->
                <div class="col-md-6 mb-4">
                    <img class="card-img-top product-image"
                         src="{{asset('uploads/productos/' . $producto->imagen)}}"
                         alt="{{$producto->nombre}}">
                </div>

                <!-- INFORMACIÓN DEL PRODUCTO -->
                <div class="col-md-6">

                    <div class="product-sku">
                        SKU: {{$producto->codigo}}
                    </div>

                    <h1 class="product-title mt-2">
                        {{$producto->nombre}}
                    </h1>

                    <div class="product-price mb-4">
                        ${{ number_format($producto->precio, 2) }}
                    </div>

                    <p class="product-description">
                        {{$producto->descripcion}}
                    </p>

                    @if (session('mensaje'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session('mensaje') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- CANTIDAD + BOTONES -->
                    <div class="d-flex mt-4">

                        <input type="hidden" name="producto_id" value="{{$producto->id}}">

                        <input class="form-control text-center me-3 qty-input"
                            id="inputQuantity"
                            type="number"
                            name="cantidad"
                            min="1"
                            value="1"
                            style="max-width: 4rem" />

                        <button class="btn btn-lux flex-shrink-0" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Agregar al carrito
                        </button>

                        <a class="btn btn-back ms-2" href="javascript:history.back()">
                            Regresar
                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

</form>
@endsection