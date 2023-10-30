@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar el cargo') }} {{ $cargo->nombre }}</h1>
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
            <form method="POST" action="{{ route ('cargos.update', $cargo )}}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')
                
                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $cargo->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del cargo</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion', $cargo->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- salario --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Salario del cargo</label>
                    <input type="number" class="form-control" name="salario" step="0.1" value="{{ old('salario', $cargo->salario) }}">
                    @error('salario')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- horario --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Horario del cargo</label>
                    <input type="number" class="form-control" name="horario" value="{{ old('horario', $cargo->horario) }}">
                    @error('horario') 
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar cargo
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