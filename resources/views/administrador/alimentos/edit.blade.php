@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     
    <div class="card">
        <div class="card-body">
            <strong>Actualizar alimento</strong>
            
        </div>
    </div>
@stop

@section('content') 
    
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos </p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" style="font-family: 'Times New Roman', Times, serif;" action="{{ route ('alimentos.update', $alimento )}}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')
                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del alimento</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $alimento->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del alimento</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion', $alimento->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar alimento
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