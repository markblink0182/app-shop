@extends('layouts.app')
@section('body-class', 'landing-page')
@section('styles')
    <style>
        .team .row .col-md-4
        {
        margin-bottom: 3em;

        }
        .row{
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }
        .row > [class*='col']{
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection
@section('title', 'Bienvenido a App Shop')
@section('content')

    <div class="header header-filter"
         style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title">Bienvenido a APP SHOP</h1>
                    <h4>Realiza pedidos en Línea y te Contactaremos</h4>
                    <br/>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
                        <i class="fa fa-play"></i> ¿Cómo funciona?
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center section-landing">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="title">Demo Página de Pedidos</h2>
                        <h5 class="description">Ofrecemos amplica gama en productos, revisa y elige el que interese Tu compra siempre será segura y protegida</h5>
                    </div>
                </div>

                <div class="features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-primary">
                                    <i class="material-icons">chat</i>
                                </div>
                                <h4 class="info-title">Atendemos tus dudas</h4>
                                <p>Atendemos cualquier consulta que tengas vía Chat</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="material-icons">verified_user</i>
                                </div>
                                <h4 class="info-title">Pago seguro</h4>
                                <p>Todo pago que realices será confirmado vía SMS. Sino confías en los pagos en línea puedes pagar en la Entega</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info">
                                <div class="icon icon-danger">
                                    <i class="material-icons">fingerprint</i>
                                </div>
                                <h4 class="info-title">Información Privada</h4>
                                <p>Los pedidos que realices solo los conocerás tú por medio de un panel personal. Nadie mas que tú tendrá acceso</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section text-center">
                <h2 class="title">Productos Disponibles</h2>

                <div class="team">
                    <div class="row">
                        @foreach($products as $product)

                        <div class="col-md-4">
                            <div class="team-player">
                                {{--<img src="{{$product->images->first()->image}}" alt="Thumbnail Image" class="img-raised img-circle">--}}
                                <img src="{{$product->featured_image_url }}" alt="Thumbnail Image" class="img-raised img-circle">
                                <h4 class="title">
                                    <a href="{{ url('/products/'.$product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                    <br/>
                                    <small class="text-muted">{{ $product->category ? $product->category->name : 'General'}}</small>
                                </h4>
                                <p class="description">{{ $product->descripcion }}</p>

                            </div>
                        </div>
                        @endforeach
                    </div>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
                </div>

            </div>


            <div class="section landing-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center title">¿Aun no te has registrado?</h2>
                        <h4 class="text-center description">Registrate ingresando tus datos básicos y podrás realizar tus pedidos a través de tu carrito de compras. Si aun no te decides
                        de cualquier forma, con tu cuenta de usuario podrás hacer consultas sin compromiso.</h4>
                        <form class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tu nombre</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Tu email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">Tu mensaje</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 text-center">
                                    <button class="btn btn-primary btn-raised">
                                        Enviar Mensaje
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @include('includes.footer');

@endsection