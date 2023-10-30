@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1 style="text-transform: uppercase; font-weight: bold;">Actualizar areas: {{ $area->nombre }} </h1>
        </div>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos .</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" style="font-family: 'Times New Roman', Times, serif;"
                action="{{ route('areas.update', $area) }}">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre de la area</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $area->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de la area</label>
                    <select class="form-control" name="tipo">
                        <option value="finanzas" @if (old('tipo', $area->tipo) == 'finanzas') selected @endif>Finanzas</option>
                        <option value="produccion" @if (old('tipo', $area->tipo) == 'produccion') selected @endif>Produccion</option>
                        <option value="ventas" @if (old('tipo', $area->tipo) == 'ventas') selected @endif>Ventas</option>
                        <option value="marketing" @if (old('tipo', $area->tipo) == 'marketing') selected @endif>Marketing</option>
                        <option value="logistica" @if (old('tipo', $area->tipo) == 'logistica') selected @endif>Logistica</option>
                        <option value="servicio al cliente" @if (old('tipo', $area->tipo) == 'servicio al cliente') selected @endif>Servicio al
                            cliente</option>
                        <option value="legal" @if (old('tipo', $area->tipo) == 'legal') selected @endif>Legal</option>
                        <option value="administracion" @if (old('tipo', $area->tipo) == 'administracion') selected @endif>Administracion
                        </option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion de la area</label>
                    <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $area->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- Estado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado de la area</label>
                    <select class="form-control" name="estado">
                        <option value="1" @if (old('estado',$area->estado) == '1') selected @endif>Activo</option>
                        <option value="0" @if (old('estado',$area->estado) == '0') selected @endif>Inactivo</option>
                    </select>
                    @error('estado')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar area
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
