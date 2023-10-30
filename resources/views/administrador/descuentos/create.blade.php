@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo descuento</h1>
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
            <form method="POST" action="{{ route('descuentos.store') }}" >
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del descuento</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del descuento">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div> 

                 {{-- tipo --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de descuento</label>
                    <select class="form-control" name="tipo" >
                        <option value="cantidad"  @if(old('tipo') == 'cantidad') selected @endif>Cantidad</option>
                        <option value="temporada"  @if(old('tipo') == 'temporada') selected @endif>Temporada</option>
                        <option value="lealtad"  @if(old('tipo') == 'lealtad') selected @endif>Lealtad</option>
                        <option value="promocion"  @if(old('tipo') == 'promocion') selected @endif>Promocion</option>
                        <option value="temporada especial"  @if(old('tipo') == 'temporada especial') selected @endif>Temporada especial</option>
                        <option value="israelitas"  @if(old('tipo') == 'israelitas') selected @endif>Israelitas</option>
                        <option value="niños"  @if(old('tipo') == 'niños') selected @endif>Niños</option>
                        <option value="habitual"  @if(old('tipo') == 'habitual') selected @endif>Habitual</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- porcentaje --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Porcentaje </label>
                    <input type="number" class="form-control" name="porcentaje" value="{{ old('porcentaje') }}" placeholder="Ingrese la porcentaje a descontar">
                    @error('porcentaje')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>  

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar descuento
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
