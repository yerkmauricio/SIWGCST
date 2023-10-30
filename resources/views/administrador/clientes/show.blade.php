@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                @if ($cliente->genero == 1)
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos del cliente: {{ $cliente->nombre }}&nbsp;{{ $cliente->apellido }} </h1>
                @else
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos de la cliente: {{ $cliente->nombre }}&nbsp;{{ $cliente->apellido }} </h1>
                @endif

            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="card c" style="background-image: url('{{ asset('img/acliente.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">

            <div class='card b'>
                <div class="card-body" style="background-image: url('{{ asset('img/cliente.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
                    <h2 style="text-align: center;">{{ ucfirst($cliente->nombre) }} {{ ucfirst($cliente->apellido) }}    <b>Cod:</b> CLI-{{$cliente->id}}-ST</h2>
                    <br>
                    <div class="form-row">
                        <h2><b>DNI: </b>{{ ucfirst($cliente->dni) }}&nbsp;&nbsp;&nbsp;</h2>
                        <h2><b>Altura: </b>{{ ucfirst($cliente->altura) }} metros</h2>
                    </div>
                    <div class="form-row">
                        @if ($cliente->genero == 1)
                            <h2><b>Genero: </b>Masculino&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                        @else
                            <h2><b>Genero: </b>Femenino&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                        @endif
                        {{-- obteniendo la edad apartir de la fecha --}}
                        <?php
                        $fobj = new DateTime($cliente->fnacimiento);
                        $factual = new DateTime();
                        $d = $factual->diff($fobj);
                        $edad = $d->y;
                        ?>

                        <h2><b>Edad: </b>{{ ucfirst($edad) }} años</h2>
                    </div>
                </div>
            </div>



            <div class="form-row">

                <div class='card a  col-md-6 mb-3 mx-auto text-center' style="background-color: #ef593400;">
                    <div class="card-body">
                        <h3><b>Hotel:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->hotel) }}</h3>
                        <h3><b>Numero de habitacion:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->nroom) }}</h3>
                    </div>
                </div>

                <div class='card a  col-md-6 mb-3 mx-auto text-center' style="background-color: #d9ee3d00;">
                    <div class="card-body">
                        <h3><b>Alimento:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->alimento->nombre) }}</h3>
                    </div>
                </div>

            </div>

            <div class="form-row">

                <div class='card a  col-md-6 mb-3 mx-auto text-center' style="background-color: #9ff72c00;">
                    <div class="card-body" >
                        <h3><b>Numero de viajes:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->nviaje) }}</h3>
                    </div>
                </div>

                <div class='card a  col-md-6 mb-3 mx-auto text-center' style="background-color: #037db500;">
                    <div class="card-body">
                         <h3><b>Talla:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->talla) }}</h3> 
                    </div>
                </div>

            </div>

            <div class="form-row   ">

                <div class='card a col-md-6 mb-3 mx-auto text-center ' style="background-color: #c5fd7c00;">
                    <div class="card-body ">
                        <h3><b>Alergia:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->alergia) }}</h3>
                    </div>
                </div>
                <br>
                <div class='card a col-md-6 mb-3 mx-auto text-center' style="background-color: #c5fd7c00;">
                    <div class="card-body">
                        <h3><b>Nacionalidad:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($cliente->nacionalidad) }}</h3>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" class="float-center" style="background-color: #c5fd7c00; color:green;">
                    <h2>
                        <i class="fab fa-whatsapp" style="color: #0da80b;"></i>  +{{ $cliente->whatsapp }}
                    </h2>
                </button>
            </div>
            

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .custom-img {
            width: 350px;
            height: auto;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(10, 186, 10)) 1;

        }

        .a {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            width: 400px;
            height: 200px;
            border-width: 1px;
            /* border-style: dashed;
            border-color: #000000; */
        }

        .b {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);

            height: 200px;
        }

        .c {
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
            width: auto;
            height: auto;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
