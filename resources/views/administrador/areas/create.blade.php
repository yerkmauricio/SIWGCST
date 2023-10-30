@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nueva area</h1>
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
            <form method="POST" action="{{ route('areas.store') }}">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre de la area</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre la area">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de la area</label>
                    <select class="form-control" name="tipo">
                        <option value="finanzas" @if (old('tipo') == 'finanzas') selected @endif>Finanzas</option>
                        <option value="produccion" @if (old('tipo') == 'produccion') selected @endif>Produccion</option>
                        <option value="ventas" @if (old('tipo') == 'ventas') selected @endif>Ventas</option>
                        <option value="marketing" @if (old('tipo') == 'marketing') selected @endif>Marketing</option>
                        <option value="logistica" @if (old('tipo') == 'logistica') selected @endif>Logistica</option>
                        <option value="servicio al cliente" @if (old('tipo') == 'servicio al cliente') selected @endif>Servicio al
                            cliente</option>
                        <option value="legal" @if (old('tipo') == 'legal') selected @endif>Legal</option>
                        <option value="administracion" @if (old('tipo') == 'administracion') selected @endif>Administracion
                        </option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion de la area</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                        placeholder="Ingrese la descripcion area">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar area
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
