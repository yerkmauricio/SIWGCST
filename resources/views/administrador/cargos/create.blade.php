@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo cargo</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('cargos.store') }}">

                @csrf {{-- evita sql inyection --}}

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del cargo</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del cargo">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del cargo</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                        placeholder="Ingrese la descripcion del cargo">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- salario --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Salario del cargo</label>
                    <input type="number" class="form-control" name="salario" step="0.1" value="{{ old('salario') }}"
                        placeholder="Ingrese el monto del salario">
                    @error('salario')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- horario --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Horario del cargo</label>
                    <input type="number" class="form-control" name="horario" value="{{ old('horario') }}"
                        placeholder="Ingrese la cantidad de horas">
                    @error('horario')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- area --}}
                <div class="form-group">
                    <label for="area">Area:</label>
                    <select name="area_id" class="form-control">
                        <option value="" selected disabled>Seleccione el Area</option>

                        @foreach ($areas as $areaId => $areaNombre)
                            <option value="{{ $areaId }}" {{ old('area_id') == $areaId ? 'selected' : '' }}>
                                {{ $areaNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('area_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- n_jerarquico --}}
                <div class="form-group">
                    <label for="n_jerarquico">Nivel jerarquico:</label>
                    <select name="n_jerarquico_id" class="form-control">
                        <option value="" selected disabled>Seleccione el nivel jerarquico</option>

                        @foreach ($n_jerarquicos as $n_jerarquicoId => $n_jerarquicoNombre)
                            <option value="{{ $n_jerarquicoId }}"
                                {{ old('n_jerarquico_id') == $n_jerarquicoId ? 'selected' : '' }}>
                                {{ $n_jerarquicoNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('n_jerarquico_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar cargo
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
