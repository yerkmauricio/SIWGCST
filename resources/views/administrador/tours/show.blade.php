@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card' style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>
                <h1> Datos del tour: {{ $tour->destino->nombre }}</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class='card' style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">

            @if ($tour->ndia == 1)
                <h2>Oferta {{ $tour->destino->nombre }} de
                    {{ $tour->ndia }} dia </h2>
            @else
                @if ($tour->ndia == 2)
                    <h2>Oferta {{ $tour->destino->nombre }} de {{ $tour->ndia }} dias y
                        {{ $tour->ndia - 1 }}
                        noche </h2>
                @else
                    <h2>Oferta {{ $tour->destino->nombre }} de {{ $tour->ndia }} dias y
                        {{ $tour->ndia - 1 }}
                        noches </h2>
                @endif
            @endif
        </div>
        <div class="card-body">


            <div class="form-row">
                <div class="media-body">
                    <img src="{{ Storage::url($tour->foto_tour->foto) }}" alt="" class="mr-3 custom-img">
                </div>
                <div class="media-body">

                    <h5 class="mt-0">Codigo: {{ $tour->id }} </h5>
                    <h5>descripcion</h5>
                    <h6 class="mt-0"> {{ ucfirst($tour->destino->descripcion) }}</h6>

                </div>
            </div>

            <div class="form-row">
                <div class="media-body">

                    <h6 class="mt-0"><strong>PRECIO:</strong> Los precios son <b>{{ $tour->precio }}0 bs tour compartido
                            {{ $tour->precioprivado }}0 bs tour privado</b> para israelitas <b>
                            {{ $israelita }}.00 bs para israelitas</b></h6>
                    <h6 class="mt-0"><strong>DIFICULTAD:</strong> El tour tiene una dificultad
                        <b>{{ $tour->dificultad }}</b> de realizar
                    </h6>
                    <h6 class="mt-0"><strong>HORA DE INICIO:</strong> El tour empezara a las <b>{{ $tour->hinicio }}</b>
                    </h6>
                    <h6 class="mt-0"><strong>HORA DE FINALIZACION:</strong> El tour termina a las
                        <b>{{ $tour->hfin }}</b>
                    </h6>
                    <h6 class="mt-0"><strong>INCLUYE:</strong> <b>{!! nl2br($tour->obs_include->descripcion) !!}</b></h6>
                    <h6 class="mt-0"><strong>NO INCLUYE:</strong> <b>{!! nl2br($tour->obs_noinclude->descripcion) !!}</b></h6>
                    <h6 class="mt-0"><strong>DISTANCIA: </strong>El tour posee una distancia de
                        <b>{{ $tour->destino->distancia }}</b> kilometros
                    </h6>
                    <h6 class="mt-0"><strong>ALTURA: </strong>El tour posee una altura de <b>{{ $tour->destino->altura }}
                            metros</b></h6>
                    <h6 class="mt-0"><strong>CLIMA: </strong>El tour posee un clima de <b>{{ $tour->destino->clima }}</b>
                    </h6>
                </div>
                <div class="media-body">
                    <img src="{{ Storage::url($tour->foto_tour->foto) }}" alt="" class="mr-3 custom-img">
                </div>
            </div>
        </div>
        <div style="display: flex;">
            @if ($tour->trasporte_id != null)
                <div class="myCard">
                    <div class="innerCard">
                        <div class="frontSide">
                            <img width="200" height="200" src="{{ Storage::url($tour->transporte->foto) }}"
                                alt="" class="mr-3 custom-img">
                            <h5 class="mt-0">Transporte</h5>
                        </div>
                        <div class="backSide">
                            <h5 class="mt-0">Transporte</h5>
                            <br>
                            <h6 class="mt-0">Nombre: {{ ucfirst($tour->transporte->nombre) }}</h6>
                            <h6 class="mt-0">Tipo: {{ ucfirst($tour->transporte->tipo) }}</h6>
                            <h6 class="mt-0">Empresa: {{ ucfirst($tour->transporte->empresa) }}</h6>
                            <h6 class="mt-0">Numero de pasajeros: {{ $tour->transporte->npasajero }}</h6>
                            <h6 class="mt-0">Precio: {{ $tour->transporte->precio }}0 bs por persona.</h6>
                            <h6 class="mt-0">Whatsapp: +{{ $tour->transporte->whatsapp }}</h6>
                        </div>
                    </div>
                </div>
            @endif

            @if ($tour->hospedaje_id != null)
                <div class="myCard">
                    <div class="innerCard">
                        <div class="frontSide">
                            <img width="200" height="200" src="{{ Storage::url($tour->hospedaje->foto) }}"
                                alt="" class="mr-3 custom-img">
                            <h5 class="mt-0">Hospedaje</h5>
                        </div>
                        <div class="backSide">
                            <h5 class="mt-0">Hospedaje</h5>
                            <br>
                            <h6 class="mt-0">Nombre: {{ ucfirst($tour->hospedaje->nombre) }}</h6>
                            <h6 class="mt-0">Tipo: {{ ucfirst($tour->hospedaje->tipo) }}</h6>
                            <h6 class="mt-0">Precio: {{ $tour->hospedaje->precio }}0 bs por persona.</h6>
                            <h6 class="mt-0">whatsapp: +{{ $tour->hospedaje->whatsapp }}</h6>
                        </div>
                    </div>
                </div>
            @endif
            <div class="myCard">
                <div class="innerCard">
                    <div class="frontSide">
                        <img width="200" height="200" src="{{ Storage::url($tour->destino->foto) }}" alt=""
                            class="mr-3 custom-img">
                        <h5 class="mt-0">Destino</h5>
                    </div>
                    <div class="backSide">
                        <h5 class="mt-0">Destino</h5>
                        <br>
                        <h6 class="mt-0">Nombre: {{ ucfirst($tour->destino->nombre) }}</h6>
                        <h6 class="mt-0">Entrada: {{ $tour->destino->entrada }}0 bs por persona.</h6>
                        <h6 class="mt-0">Categoria: {{ ucfirst($tour->destino->categoria) }}</h6>
                        <h6 class="mt-0">Distancia: {{ ucfirst($tour->destino->distancia) }} km </h6>
                        <h6 class="mt-0">Altura: {{ ucfirst($tour->destino->altura) }} metros a nivel del mar </h6>
                        <h6 class="mt-0">whatsapp: +{{ $tour->destino->whatsapp }}</h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- aqui las fotos rotativas con un clik --}}
        <div class="card-watermark">
            <img src="{{ asset('img/logo.png') }}" alt="Logo"
                style="opacity: 0.2; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 300px;">
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="container">
            <h1 class="row justify-content-center">{{ ucfirst($tour->foto_tour->nombre) }}</h1>

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div id="tourCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($fotosRelacionadas as $key => $foto)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ Storage::url($foto->foto) }}" alt="{{ $foto->nombre }}"
                                        class="d-block w-100">
                                    <div class="carousel-caption text-center"> <!-- Agregar la clase "carousel-caption" -->
                                        <p style="font-size: 24px; color: #00ff00;"> <b>Foto del tour
                                                {{ $tour->foto_tour->nombre }}</b></p>
                                        <p style="font-size: 24px; color: #03ff03;">
                                            <b>FOT-{{ $tour->foto_tour->id }}-ST</b></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>




    </div>

@stop

@section('css')
    <style>
        h5 {
            text-transform: uppercase;
            font-weight: bold;
        }

        .custom-img {
            width: 60%;
            height: 60%;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(10, 186, 10)) 1;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }



        h2 {

            position: relative;
            color: rgb(25, 25, 75);
            font-family: Edwardian Script ITC;
            font-size: 70px;
            font-weight: bold;

        }

        .myCard {
            background-color: transparent;
            width: 400px;
            height: 300px;
            perspective: 1000px;
            margin-right: 10px;
        }

        .title {
            font-size: 1.5em;
            font-weight: 900;
            text-align: center;
            margin: 0;
        }

        .innerCard {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
            cursor: pointer;
        }

        .myCard:hover .innerCard {
            transform: rotateY(180deg);
        }

        .frontSide,
        .backSide {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 1rem;
            color: white;
            box-shadow: 0 0 0.3em rgba(255, 255, 255, 0.5);
            font-weight: 700;
        }

        .frontSide,
        .frontSide::before {
            background: linear-gradient(43deg, rgb(65, 67, 208) 0%, rgb(142, 212, 242) 46%, rgb(17, 195, 35) 100%);
        }

        .backSide,
        .backSide::before {
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
        }

        .backSide {
            transform: rotateY(180deg);
        }

        .frontSide::before,
        .backSide::before {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            content: '';
            width: 110%;
            height: 110%;
            position: absolute;
            z-index: -1;
            border-radius: 1em;
            filter: blur(20px);
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            0% {
                opacity: 0.3;
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0.3;
            }
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
    <script>
        $(document).ready(function() {
            // Detecta el cambio de carrusel y actualiza el texto
            $('#tourCarousel').on('slid.bs.carousel', function() {
                var activeSlide = $(this).find('.carousel-item.active');
                var fotoNombre = activeSlide.find('img').attr('alt');
                var fotoId = activeSlide.find('img').data('id');
                $('.carousel-caption p').eq(0).text('foto de ' + fotoNombre);
                $('.carousel-caption p').eq(1).text('FOT-' + fotoId + '-ST');
            });
        });
    </script>
@stop
