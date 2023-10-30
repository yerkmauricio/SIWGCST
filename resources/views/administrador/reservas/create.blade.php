@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar una nueva reserva</h1>
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

            <form method="POST" action="{{ route('reservas.store') }}">

                @csrf {{-- evita sql inyection --}}

                <input type="hidden" name="cliente_id" value="0">

                {{-- nombre --}}
                <div class="form-group">

                    @if ($nom != null)
                        <h3><b style="color: darkgreen ">CLIENTE YA REGISTRADO</b></h3>
                    @endif

                    <label for="formGroupExampleInput">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="{{ $nom ?? old('nombre') }}"
                        placeholder= "Ingrese el nombre del cliente">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- apellido --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido" value="{{ $ape ?? old('apellido') }}"
                        placeholder="Ingrese el apellido  del cliente">
                    @error('apellido')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- dni --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Documento nacional de Identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ $d ?? old('dni') }}"
                        placeholder="Ingrese el Documento nacional de identidad del cliente">
                    @error('dni')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                 
                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de tour</label>
                    <select class="form-control" name="tipo">
                        <option value="compartido"    {{old('tipo',$tip) === 'compartido' ? 'selected' : ''}}   >Compartido</option>
                        <option value="privado"   {{old('tipo',$tip) === 'privado' ? 'selected' : ''}}    >Privado</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tour  --}}
                <div class="form-group">
                    <label for="tour">Tour:</label>
                    <select name="tour_id" class="form-control">
                        <option value="" selected disabled>Seleccione el tour</option>
                        @foreach ($tours as $tour)
                            @php
                                $selectedValue = old('tour_id') === $tour->id . '|' . $tour->ndia ? 'selected' : '';
                            @endphp

                            <option value="{{ $tour->id }}|{{ $tour->ndia }}" {{ $selectedValue }}
                                {{ ($tou ?? old('tour_id' | 'tour->ndia')) == $tour->id ? 'selected' : '' }}>
                                @if ($tour->ndia == 1)
                                    {{ ucfirst($tour->destino->nombre) }} de un {{ $tour->ndia }} día
                                @else
                                    {{ ucfirst($tour->destino->nombre) }} de {{ $tour->ndia }} días
                                @endif

                            </option>
                        @endforeach
                    </select>
                    @error('tour_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- finicio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de inicio del tour</label>
                    <input type="date" class="form-control" name="finicio" value="{{ $fecha ?? old('finicio') }}">
                    @error('finicio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar reserva
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
