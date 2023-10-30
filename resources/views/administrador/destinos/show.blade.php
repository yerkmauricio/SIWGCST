@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'>
        <div class="card-body">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
                    Datos del destino: {{ $destino->nombre }}</h1>
            </strong>

        </div>
    </div>
@stop

@section('content')

    @php
        $m = $destino->distancia * 1000;
        $ma = $destino->altura * 1000;
    @endphp
    <div class="row" style="font-family: 'Times New Roman', Times, serif;">
        <div class="col-md-3">
            <img src="{{ Storage::url($destino->foto) }}" alt="" class="custom-img mx-auto">
        </div>

        <div class="col-md-6">
            <ul>
                <br>
                <h5 class="mt-0" style="text-transform: uppercase;"><b>destino</b></h5>
                <li class="mt-0"><b>Nombre: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->nombre) }}</li>
                <li class="mt-0"><b>Codigo: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $destino->id }}</h6>
                <li class="mt-0"><b>Ubicacion: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->ubicacion) }}</li>
                <li class="mt-0"><b>Entrada: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $destino->entrada }}0 bs por persona.</li>
                <li class="mt-0"><b>Categoria: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->categoria) }}</li>
                <li class="mt-0"><b>Descripcion: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->descripcion) }}</li>
                <li class="mt-0"><b>Distancia: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->distancia) }} km o
                    {{ $m }} metros</li>
                <li class="mt-0"><b>Altura: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->altura) }} km o
                    {{ $ma }} metros a nivel del mar</li>
                <li class="mt-0"><b>Clima: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($destino->clima) }}</li>
                @if ($destino->whatsapp != null)
                    <li class="mt-0"><b>whatsapp: </b>&nbsp;&nbsp;&nbsp;&nbsp;+{{ $destino->whatsapp }}</li>
                @endif
                <li class="mt-0"><b>Fecha de registro: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $destino->f_registro }}</li>
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
