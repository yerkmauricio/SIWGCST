@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar una nueva lista de alimento
                </h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('lisalis.store') }}">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre de la lista</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="ingrese el nombre del articulo">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- alimento --}}
                <div class="form-group">
                    <label for="alimento">Alimento:</label>
                    <select name="alimento_id" class="form-control">
                        <option value="" selected disabled>Seleccione el alimento</option>
                        @foreach ($alimentos as $alimentoId => $alimentoNombre)
                            <option value="{{ $alimentoId }}" {{ old('alimento_id') == $alimentoId ? 'selected' : '' }}>
                                {{ $alimentoNombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('alimento_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar lista
                    </button>
                </div>

                <div class="form-group">
                    <label for="productos">Productos:</label>
                    <div class="product-images">
                        @foreach ($productos as $producto)
                            <div class="checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" name="productos_seleccionados[]"
                                        value="{{ $producto->id }}">
                                    <span class="checkbox-tile">
                                        <img width="200" height="200" src="{{ asset('storage/' . $producto->foto) }}"
                                            alt="{{ $producto->nombre }}">
                                        <span class="checkbox-label">{{ ucfirst($producto->nombre) }}</span>
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>


            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .product-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .product-images>div {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .product-images img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
        }

        .product-images p {
            margin-top: 10px;
        }

        .checkbox-wrapper-16 *,
        .checkbox-wrapper-16 *:after,
        .checkbox-wrapper-16 *:before {
            box-sizing: border-box;
        }

        .checkbox-wrapper-16 .checkbox-input {
            clip: rect(0 0 0 0);
            -webkit-clip-path: inset(100%);
            clip-path: inset(100%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
            background-color: #2260ff;
            border-color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-icon,
        .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-label {
            color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile {
            border-color: #2260ff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
        }

        .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
        }

        .checkbox-wrapper-16 .checkbox-tile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 7rem;
            min-height: 7rem;
            border-radius: 0.5rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.15s ease;
            cursor: pointer;
            position: relative;
        }

        .checkbox-wrapper-16 .checkbox-tile:before {
            content: "";
            position: absolute;
            display: block;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #b5bfd9;
            background-color: #fff;
            border-radius: 50%;
            top: 0.25rem;
            left: 0.25rem;
            opacity: 0;
            transform: scale(0);
            transition: 0.25s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }

        .checkbox-wrapper-16 .checkbox-tile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .checkbox-wrapper-16 .checkbox-tile:hover {
            border-color: #2260ff;
        }

        .checkbox-wrapper-16 .checkbox-tile:hover:before {
            transform: scale(1);
            opacity: 1;
        }

        .checkbox-wrapper-16 .checkbox-icon {
            transition: 0.375s ease;
            color: #494949;
        }

        .checkbox-wrapper-16 .checkbox-icon svg {
            width: 3rem;
            height: 3rem;
        }

        .checkbox-wrapper-16 .checkbox-label {
            color: #707070;
            transition: 0.375s ease;
            text-align: center;
        }
    </style>

@stop

@section('js')

@stop
