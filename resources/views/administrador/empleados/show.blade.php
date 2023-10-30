@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                @if ($empleado->genero == 1)
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos del empleado: {{ $empleado->nombre }}&nbsp;{{ $empleado->apellidopaterno }} </h1>
                @else
                    <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                        Datos de la empleada: {{ $empleado->nombre }}&nbsp;{{ $empleado->apellidopaterno }} </h1>
                @endif

            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="row" style="font-family: 'Times New Roman', Times, serif;">
        <div class="col-md-3">
            <img src="{{ Storage::url($empleado->foto) }}" alt="" class="custom-img mx-auto">
        </div>
        
        <div class="col-md-6">
            <ul>
                <br>
                <h5 class="mt-0" style="text-transform: uppercase;"><b>empleado</b></h5>
                <li class="mt-0"><b>Nombre:</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($empleado->nombre) }} </li>
                <li class="mt-0"><b>Apellido paterno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($empleado->apellidopaterno) }} </li>
                <li class="mt-0"><b>Apellido materno:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($empleado->apellidomaterno) }} </li>
                <li class="mt-0"><b>Documento nacional de identidad :</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($empleado->dni) }} </li>

                @if ($empleado->est_laboral == 1)
                    <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; Trabajando </li>
                @else
                    <li class="mt-0"><b>Estado laboral:</b>&nbsp;&nbsp;&nbsp;&nbsp; No trabajado </li>
                @endif

                <li class="mt-0"><b>Domicilio:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->domicilio) }} </li>
                <li class="mt-0"><b>Nacionalidad:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->nacionalidad) }}
                </li>

                @if ($empleado->genero == 1)
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Masculino </li>
                @else
                    <li class="mt-0"><b>Genero:</b>&nbsp;&nbsp;&nbsp;&nbsp; Femenino </li>
                @endif

                <li class="mt-0"><b>Whatsapp:</b>&nbsp;&nbsp;&nbsp;&nbsp; +{{ ucfirst($empleado->whatsapp) }} </li>
                <li class="mt-0"><b>Fecha de nacimiento:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($empleado->fnacimiento) }} </li>
                <li class="mt-0"><b>Fecha de inicio:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->finicio) }} </li>

                @if ($empleado->est_laboral == 0)
                    <li class="mt-0"><b>Fecha de suspension:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ ucfirst($empleado->fsuspension) }} </li>
                @endif

                <li class="mt-0"><b>Cargo:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->cargos->nombre) }} </li>
                <li class="mt-0"><b>Nivel jerarquico:</b>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ ucfirst($empleado->n_jerarquicos->nombre) }}</li>

                @if ($empleado->cargos->salario<=500)
                <li class="mt-0"><b>Salario:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->cargos->salario) }}0 Bs por tour del dia </li>
                @else
                <li class="mt-0"><b>Salario:</b>&nbsp;&nbsp;&nbsp;&nbsp; {{ ucfirst($empleado->cargos->salario) }}0 Bs mensual </li>    
                @endif
            </ul>
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
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
