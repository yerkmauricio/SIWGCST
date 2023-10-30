@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar el descuento:') }} {{ ucfirst($descuento->nombre) }}</h1>
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
                action="{{ route('descuentos.update', $descuento) }}">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del descuento</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $descuento->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de descuento</label>
                    <select class="form-control" name="tipo" >
                        <option value="cantidad"  @if(old('tipo', $descuento->tipo) == 'cantidad') selected @endif>Cantidad</option>
                        <option value="temporada"  @if(old('tipo', $descuento->tipo) == 'temporada') selected @endif>Temporada</option>
                        <option value="lealtad"  @if(old('tipo', $descuento->tipo) == 'lealtad') selected @endif>Lealtad</option>
                        <option value="promocion"  @if(old('tipo', $descuento->tipo) == 'promocion') selected @endif>Promocion</option>
                        <option value="temporada especial"  @if(old('tipo', $descuento->tipo) == 'temporada especial') selected @endif>Temporada especial</option>
                        <option value="israelitas"  @if(old('tipo', $descuento->tipo) == 'israelitas') selected @endif>Israelitas</option>
                        <option value="niños"  @if(old('tipo', $descuento->tipo) == 'niños') selected @endif>Niños</option>
                        <option value="habitual"  @if(old('tipo', $descuento->tipo) == 'habitual') selected @endif>Habitual</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- porcentaje --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Porcentaje </label>
                    <input type="number" class="form-control" name="porcentaje" value="{{ old('porcentaje', $descuento->porcentaje) }}" placeholder="Ingrese la porcentaje a descontar">
                    @error('porcentaje')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>  



                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar descuento
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
