@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar la recibo:') }}
                {{ ucfirst($recibo->clientes->nombre) }} {{ ucfirst($recibo->clientes->apellido) }} </h1>
        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('recibos.update', $recibo) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- finicio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de inicio del tour</label>
                    <input type="date" class="form-control" name="finicio"
                        value="{{ old('finicio', $recibo->finicio) }}">
                    @error('finicio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

               

                {{-- método --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Método</label>
                    <select class="form-control" name="metodo">
                        <option value="efectivo" {{ old('metodo',$recibo->metodo) === 'efectivo' ? 'selected' : '' }}>Efectivo
                        </option>
                        <option value="transferencia" {{ old('metodo',$recibo->metodo) === 'transferencia' ? 'selected' : '' }}>
                            Transferencia</option>
                        <option value="tarjeta" {{ old('metodo',$recibo->metodo) === 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                    </select>
                    @error('metodo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- estado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado</label>
                    <select class="form-control" name="estado">
                        <option value="1" @if (old('estado', $recibo->estado) == '1') selected @endif>Activo</option>
                        <option value="0" @if (old('estado', $recibo->estado) == '0') selected @endif>Inactivo</option>
                    </select>
                    @error('estado')
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

                            <option value="{{ $tour->id }}|{{ $tour->ndia }}"{{ $selectedValue }}
                                {{ old('tour_id', $recibo->tour_id) == $tour->id ? 'selected' : '' }}>
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

                
                 {{-- descuento  --}}
                 <div class="form-group">
                    <label for="descuento">Descuento:</label>
                    <select name="descuento_id" class="form-control">
                        <option value="" selected disabled>Seleccione el descuento</option>
                        @foreach ($descuentos as $descuento)
                            <option value="{{ $descuento->id }}" {{ old('descuento_id', $recibo->descuento_id) == $descuento->id ? 'selected' : '' }}>
                                {{ $descuento->porcentaje }}% por {{ $descuento->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('descuento_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar recibo
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
