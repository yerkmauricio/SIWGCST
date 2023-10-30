<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    
    <title>Recibo pdf</title>
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
            width: 50px;
            /* ancho*/
            height: 30px;
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
            width: 100px;
            height: auto;
            margin-left: 30px;
        }

        .lugar {
            width: 100px;
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

         .card-watermark {
                                                position: relative;
                                                width: 100%;
                                                height: 100%;
                                            } 

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

        .cuadro {
        width: 80px; /* Ancho del cuadro */
        margin: 20px; /* Margen para centrarlo */
        padding: 20px; /* Espaciado interno */
        border: 2px solid #000; /* Borde sólido */
        border-radius: 10px; /* Borde redondeado */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); /* Sombra */
        background-color: #f0f0f0; /* Color de fondo */
    }
    </style>
</head>
<body>
    
    
    <div class="card principal" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="display: flex; align-items: center;">

            {{-- Logo en el lado izquierdo --}}
            <div style="flex: 1; ">
                <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo"><br>
                <img class="lugar" src="{{ asset('img/lugar.png') }}" alt="Lugar">
            </div>

            {{-- H1 en el centro --}}
            <div style="flex: 1; text-align: center;">

                <h6 style="text-transform: uppercase;"><b>recibo</b></h6>

                {{-- fecha --}}
                <div class="form-row" style="display: flex; justify-content: center;">
                    <div class='cuadro'>
                        <div class="card-body fecha">
                            <h5>dia</h5>
                            <h6>{{ \Carbon\Carbon::parse($reciboS->finicio)->locale('es_ES')->isoFormat('D') }}</h6>
                        </div>
                    </div>
                    <div class='card'>
                        <div class="card-body fecha ">
                            <h5>mes</h5>
                            <h6>{{ \Carbon\Carbon::parse($reciboS->finicio)->locale('es_ES')->isoFormat('MMMM') }}</h6>
                        </div>
                    </div>
                    <div class='card'>
                        <div class="card-body fecha ">
                            <h5>año</h5>
                            <h6>{{ \Carbon\Carbon::parse($reciboS->finicio)->locale('es_ES')->isoFormat('YYYY') }}</h6>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ul class="list-group" en el lado derecho --}}
            <div style="flex: 1; text-align: right;">
                <ul class="list-group">
                    <div class="form-row" style="">
                        <h3><b>{{ $reciboS->moneda }}:</b></h3>&nbsp;
                        <div class="card" style="width: 17rem;">
                            <div class="card-body datos">
                                <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $reciboS->monto }}0</b></h2>
                            </div>
                        </div>
                    </div>
                </ul>

                <ul>
                    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->merge(public_path('img/logo.png'), 0.4, true)->generate(route('recibos.show', $reciboS->id))) }}"
                        alt="">
                </ul>

                <ul class="list-group" style="margin-right: 10rem;">
                    <h2 style="color: red"><b>N° {{ $reciboS->id }}</b></h2>
                </ul>

            </div>
        </div>

        <div class='card cliente'>
            <div class="card-body">
                @if ($reciboS->clientes->genero == 1)
                    <h3><b>He recibo del
                            Sr:</b>&nbsp;{{ ucfirst($reciboS->clientes->nombre) }}&nbsp;{{ ucfirst($reciboS->clientes->apellido) }}
                        a mi persona
                        {{ $reciboS->empleados->nombre }}&nbsp;{{ ucfirst($reciboS->empleados->apellidopaterno) }}
                    </h3>
                @else
                    <h3><b>He recibo de la
                            Sra:</b>&nbsp;{{ ucfirst($reciboS->clientes->nombre) }}&nbsp;{{ ucfirst($reciboS->clientes->apellido) }}
                        a mi persona
                        {{ $reciboS->empleados->nombre }}&nbsp;{{ ucfirst($reciboS->empleados->apellidopaterno) }}
                    </h3>
                @endif

            </div>
        </div>
        <div class='card cliente'>
            <div class="card-body">
                <h3><b>La suma de:</b>&nbsp;{{ ucfirst($montoliteral) }}&nbsp;{{ $reciboS->moneda }} </h3>
            </div>
        </div>
        <div class='card cliente'>
            <div class="card-body">
                @if ($reciboS->descuentos->porcentaje == 0)
                    <h3>
                        <b>Por concepto de:</b>&nbsp;{{ ucfirst($reciboS->tours->ndia) }} dias al destino de
                        &nbsp;{{ ucfirst($recibSo->tours->destino->nombre) }}
                        con una dificulta {{ $reciboS->tours->dificultad }}&nbsp; el cual comienza el
                        {{ $reciboS->finicio }} y terminando {{ $reciboS->ffin }}
                    </h3>
                @else
                    <h3>
                        <b>Por concepto de:</b>&nbsp;Viaje de {{ ucfirst($reciboS->tours->ndia) }} dias al destino de
                        &nbsp;{{ ucfirst($reciboS->tours->destino->nombre) }}
                        con una dificulta {{ $reciboS->tours->dificultad }}, el cual comienza el
                        {{ \Carbon\Carbon::parse($reciboS->finicio)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }},
                        terminando el
                        {{ \Carbon\Carbon::parse($reciboS->ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}.
                        Este tour tiene un descuento del {{ $reciboS->descuentos->porcentaje }}% por
                        <b>{{ $reciboS->descuentos->nombre }}</b>
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
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $reciboS->monto }}0 Bs.</b></h2>
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
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $reciboS->cuenta }}.00 Bs.</b></h2>
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
                            <h2 class="mt-0" style="text-transform: uppercase;"><b>{{ $reciboS->saldo }}.00 Bs</b></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- Watermark --}}
        <div class="card-watermark">
            <img src="{{ asset('img/logo.png') }}" alt="Logo"
                style="opacity: 0.2; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 400px; height: 300px;">
            @if ($reciboS->estado == 0)
                <h1 class="watermark-text">Anulado</h1>
            @endif
        </div>



    </div>
</body>
</html>

