@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Datos del recibo:
                    {{ $recibo->id }}&nbsp;{{ $recibo->clientes->nombre }}&nbsp;{{ $recibo->clientes->apellido }} </h1>
            </strong>
            <a class="btn btn-success float-left" href="{{ route('recibos.pdf', $recibo) }}">
                <i class="fas fa-plus"></i>
                PDF
            </a>

        </div>
    </div>

@stop

@section('content')



    <div class="card principal" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="display: flex; align-items: center;">

            {{-- Logo en el lado izquierdo --}}
            <div style="flex: 1; ">
                <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo"><br>
                <img class="lugar" src="{{ asset('img/lugar.png') }}" alt="Lugar">
            </div>

            {{-- H1 en el centro --}}
            <div style="flex: 1; text-align: center;">

                <h1 style="text-transform: uppercase;"><b>recibo</b></h1>

                {{-- fecha --}}
                <div class="form-row" style="display: flex; justify-content: center;">
                    <div class='card'>
                        <div class="card-body fecha">
                            <h5>dia</h5>
                            <h6>{{ \Carbon\Carbon::parse($recibo->f_registro)->locale('es_ES')->isoFormat('D') }}</h6>
                        </div>
                    </div>
                    <div class='card'>
                        <div class="card-body fecha ">
                            <h5>mes</h5>
                            <h6>{{ \Carbon\Carbon::parse($recibo->f_registro)->locale('es_ES')->isoFormat('MMMM') }}</h6>
                        </div>
                    </div>
                    <div class='card'>
                        <div class="card-body fecha ">
                            <h5>año</h5>
                            <h6>{{ \Carbon\Carbon::parse($recibo->f_registro)->locale('es_ES')->isoFormat('YYYY') }}</h6>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ul class="list-group" en el lado derecho --}}
            <div style="flex: 1; text-align: right;">
                <ul class="list-group">
                    <div class="form-row" style="">
                        <h3><b>{{ $recibo->moneda }}:</b></h3>&nbsp;
                        <div class="card" style="width: 17rem;">
                            @if ($recibo->cuenta == 0)
                                <div class="card-body datos">
                                    <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $recibo->monto }}0</b></h2>
                                </div>
                            @else
                                <div class="card-body datos">
                                    <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $recibo->cuenta }}.00</b>
                                    </h2>
                                </div>
                            @endif

                        </div>
                    </div>
                </ul>

                <ul class="list-group" style="margin-right: 10rem;">
                    <h2 style="color: red"><b>N° {{ $recibo->id }}</b></h2>
                </ul>

            </div>
        </div>

        <div class='card cliente'>
            <div class="card-body">
                @if ($recibo->clientes->genero == 1)
                    <h3><b>He recibo del
                            Sr:</b>&nbsp;{{ ucfirst($recibo->clientes->nombre) }}&nbsp;{{ ucfirst($recibo->clientes->apellido) }}
                        a mi persona
                        <b>{{ $recibo->empleados->nombre }}&nbsp;{{ ucfirst($recibo->empleados->apellidopaterno) }}</b>
                    </h3>
                @else
                    <h3><b>He recibo de la
                            Sra:</b>&nbsp;{{ ucfirst($recibo->clientes->nombre) }}&nbsp;{{ ucfirst($recibo->clientes->apellido) }}
                        a mi persona
                        <b>{{ $recibo->empleados->nombre }}&nbsp;{{ ucfirst($recibo->empleados->apellidopaterno) }}</b>
                    </h3>
                @endif

            </div>
        </div>
        <div class='card cliente'>
            <div class="card-body">
                @if ($recibo->cuenta == null)
                    <h3><b>La suma de:</b>&nbsp;{{ ucfirst($montoliteral) }}&nbsp;{{ $recibo->moneda }} </h3>
                @else
                    <h3><b>La suma de:</b>&nbsp;{{ ucfirst($cuentaliteral) }}&nbsp;{{ $recibo->moneda }} </h3>
                @endif

            </div>
        </div>
        <div class='card cliente'>
            <div class="card-body">
                @if ($recibo->descuentos->porcentaje == 0)
                    <h3>
                        <b>Por concepto de:</b>&nbsp;{{ ucfirst($recibo->tours->ndia) }} dias al destino de
                        &nbsp;{{ ucfirst($recibo->tours->destino->nombre) }}
                        con una dificulta {{ $recibo->tours->dificultad }}&nbsp; el cual comienza el
                        {{ $recibo->finicio }} y terminando {{ $recibo->ffin }}
                    </h3>
                @else
                    <h3>
                        <b>Por concepto de:</b>&nbsp;Viaje de {{ ucfirst($recibo->tours->ndia) }} dias al destino de
                        &nbsp;{{ ucfirst($recibo->tours->destino->nombre) }}
                        con una dificulta {{ $recibo->tours->dificultad }}, el cual comienza el
                        {{ \Carbon\Carbon::parse($recibo->finicio)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}
                        terminando el
                        {{ \Carbon\Carbon::parse($recibo->ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}.
                        Este tour tiene un descuento del {{ $recibo->descuentos->porcentaje }}% por
                        <b>{{ $recibo->descuentos->nombre }}</b>
                    </h3>
                @endif
            </div>
        </div>


        <div class="form-row" style="">
            {{-- total --}}
            <div style="flex: 1; text-align: right;">
                <div class="form-row" style="">
                    <h3><b>TOTAL:</b></h3>&nbsp;
                    <div class="card" style="width: 17rem;">
                        <div class="card-body datos">
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $recibo->monto }}0</b></h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- a cuenta --}}
            <div style="flex: 1; text-align: right;">
                <div class="form-row" style="">
                    <h3><b>A CUENTA:</b></h3>&nbsp;
                    <div class="card" style="width: 17rem;">
                        <div class="card-body datos" style="">
                            @if ($recibo->cuenta==null)
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>0.00 </b></h2>
                            @else
                                <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $recibo->cuenta }}.00 </b></h2>
                            @endif
                            
                        </div>
                    </div>
                </div>

            </div>

            {{-- saldo --}}
            <div style="flex: 1; text-align: right;">

                <div class="form-row" style="">
                    <h3><b>SALDO:</b></h3>&nbsp;
                    <div class="card" style="width: 17rem;">
                        <div class="card-body datos">
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $recibo->saldo }}0 </b></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Watermark --}}
        <div class="card-watermark">
            <img src="{{ asset('img/logo.png') }}" alt="Logo"
                style="opacity: 0.2; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 300px;">
            @if ($recibo->estado == 0)
                <h1 class="watermark-text">Anulado</h1>
            @endif
        </div>



    </div>




@stop

@section('css')

    <style>
        .custom-img {
            width: 350px;
            height: auto;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(10, 186, 10)) 1;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }

        .principal {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            border: 5px solid transparent;
            border-width: 15px;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(10, 186, 10)) 1;
            border-image-slice: 5;
        }

        .fecha {
            width: 100px;
            /* ancho*/
            height: 80px;
            /* alto */
            margin-right: 20px;
            margin-left: 20px;
            /*el espacio*/
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            /*sombra al div*/
            border: 3px solid blue;
            /* Borde de color azul */
            border-radius: 20px;
            /* Esquina superior isquierda doblada */
            border-color: blue green blue green;
            /* Colores de borde alternados (azul y verde) */
        }

        .datos {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            /*sombra al div*/
            border: 3px solid blue;
            /* Borde de color azul */
            border-radius: 20px;
            /* Esquina superior isquierda doblada */
            border-color: blue green blue green;
            /* Colores de borde alternados (azul y verde) */
        }



        .form-row {
            display: flex;
            align-items: center;
            margin-left: 25px;
        }


        .logo {
            width: 250px;
            height: auto;
            margin-left: 30px;
        }

        .lugar {
            width: 350px;
            height: auto;
        }

        h5 {
            text-transform: uppercase;
            font-weight: bold;
        }

        .cliente {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            border: 3px solid rgb(108, 108, 139);
            margin-left: 20px;
            margin-right: 20px;


        }

        /* .card-watermark {
                                                        position: relative;
                                                        width: 100%;
                                                        height: 100%;
                                                    } */

        .watermark-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            transform-origin: center center;
            font-size: 15rem;
            /* Aumenta el tamaño del texto */
            opacity: 0.5;
            color: red;
            padding: 20px;
        }

        /* estilos para el qr*/
        .qr-code-container {
            width: 500px;
            height: 500px;
            margin: auto;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .qr-code-container img {
            width: 100%;
            height: 100%;
        }

        /* .qr-container {
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            margin-top: 20px;
                                        }

                                        .qr-code {
                                            margin-right: 20px;
                                             
                                        }

                                        .qr-logo img {
                                            
                                            width: 200px;
                                             
                                            height: auto;
                                        } */
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
