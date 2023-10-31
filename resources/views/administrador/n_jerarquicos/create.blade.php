@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo nivel jerarquico
                </h1>
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
            <form method="POST" action="{{ route('n_jerarquicos.store') }}">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del nivel</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre ">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del nivel</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}"
                        placeholder="Ingrese la descripcion ">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- n_orden --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Numero de orden</label>
                    <input type="text" class="form-control" name="n_orden" value="{{ old('n_orden') }}"
                        placeholder="Ingrese el nivel jerarquico">
                    @error('n_orden')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                
                <h2 class="h3">Lista de permisos</h2>
                @foreach ($permissions as $permission)
                    <div>
                        <label>
                           @csrf 
                           
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1">
                            {{ $permission->description }}

                        </label>
                    </div>
                @endforeach

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar nivel jerarquico
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
