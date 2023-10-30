@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card'style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;"> Datos del producto: {{ $producto->nombre }}</h1>
            </strong>

        </div>
    </div>
@stop

@section('content')
    <div class="row" style="font-family: 'Times New Roman', Times, serif;">
        <div class="col-md-3">
            <img src="{{ Storage::url($producto->foto) }}" alt="" class="custom-img mx-auto">
        </div>

        <div class="col-md-6">
            <ul>
                <br>
                <h5 class="mt-0" style="text-transform: uppercase;"><b>producto</b></h5>
                <li class="mt-0"><b>Nombre: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($producto->nombre) }}</li>
                <li class="mt-0"><b>Codigo: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $producto->id }}</li>
                <li class="mt-0"><b>Tipo: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($producto->tipo) }}</li>
                <li class="mt-0"><b>Precio: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $producto->precio }}0 bs.</li>
                <li class="mt-0"><b>Descripcion: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($producto->descripcion) }}</li>
                <li class="mt-0"><b>Categoria: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($producto->categoria) }} </li>
                <li class="mt-0"><b>Cantidad: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $producto->cantidad }}
                    {{ $producto->nombre }}</li>
                <li class="mt-0"><b>Fecha de registro: </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $producto->f_registro }}</li>


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
