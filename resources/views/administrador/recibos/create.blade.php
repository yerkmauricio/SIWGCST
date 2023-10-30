@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo recibo</h1>
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

            <form method="POST" action="{{ route('recibos.store') }}">

                @csrf {{-- evita sql inyection --}}

                <input type="hidden" name="cliente_id" value="0">

                {{-- nombre --}}
                <div class="form-group">

                    @if ($nom != null)
                        <h3><b style="color: darkgreen ">CLIENTE YA REGISTRADO</b></h3>
                    @endif

                    <label for="formGroupExampleInput">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="{{ $nom ?? old('nombre') }}"
                        placeholder="Ingrese el nombre del cliente">
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
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ $d ?? old('dni') }}"
                        placeholder="ingrese el Documento nacional de identidad del cliente">
                    @error('dni')
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

                {{-- método --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Método</label>
                    <select class="form-control" name="metodo">
                        <option value="efectivo" {{ old('metodo', $met) === 'efectivo' ? 'selected' : '' }}>Efectivo
                        </option>
                        <option value="transferencia" {{ old('metodo', $met) === 'transferencia' ? 'selected' : '' }}>
                            Transferencia</option>
                        <option value="tarjeta" {{ old('metodo', $met) === 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    </select>
                    @error('metodo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- moneda --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de moneda</label>
                    <select class="form-control" name="moneda">
                        <option value="Bolivianos" {{ old('moneda', $mon) === 'Bolivianos' ? 'selected' : '' }}>Bolivianos
                        </option>
                        <option value="Dolares" {{ old('moneda', $mon) === 'Dolares' ? 'selected' : '' }}>Dólares</option>
                    </select>
                    @error('moneda')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- cuenta --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Cuenta</label>
                    <input type="number" class="form-control" name="cuenta" value="{{ $cue ?? old('cuenta') }}">
                    @error('cuenta')
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

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de tour</label>
                    <select class="form-control" name="tipo">
                        <option value="compartido"    {{old('tipo',$tip) === 'compartido' ? 'selected' : ''}}   >Compartido</option>
                        <option value="privado"   {{old('tipo', $tip) === 'privado' ? 'selected' : ''}}    >Privado</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descuento  --}}
                <div class="form-group">
                    <label for="descuento">Descuento:</label>
                    <select name="descuento_id" class="form-control">
                        <option value="" selected disabled>Seleccione el descuento</option>
                        @foreach ($descuentos as $descuento)
                            <option value="{{ $descuento->id }}"
                                {{ $des == $descuento->id || old('descuento_id') == $descuento->id ? 'selected' : '' }}>
                                {{ $descuento->porcentaje }}% por {{ $descuento->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('descuento_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- idioma --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de idioma del PDF</label>
                    <select class="form-control" name="idioma">
                        <option value="español" {{ old('idioma', $idi) === 'español' ? 'selected' : '' }}>Español</option>
                        <option value="ingles" {{ old('idioma', $idi) === 'ingles' ? 'selected' : '' }}>Inglés</option>
                    </select>
                    @error('idioma')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del producto</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ $obs ?? old('descripcion') }}" placeholder="Ingrese la descripcion del producto">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success floaSt-center">
                        <i class="fas fa-plus"></i>
                        Agregar recibo
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
