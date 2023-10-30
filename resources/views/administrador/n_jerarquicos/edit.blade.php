@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card">
        <div class="card-body">
            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar el nivel jerarquico') }}</h1>
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
                action="{{ route('n_jerarquicos.update', $n_jerarquico) }}">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del nivel jerarquico</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $n_jerarquico->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del nivel</label>
                    <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $n_jerarquico->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- n_orden --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Numero de orden</label>
                    <input type="text" class="form-control" name="n_orden"
                        value="{{ old('n_orden', $n_jerarquico->n_orden) }}">
                    @error('n_orden')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- n_superior --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nivel superior</label>
                    <input type="text" class="form-control" name="n_superior"
                        value="{{ old('n_superior', $n_jerarquico->n_superior) }}">
                    @error('n_superior')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <h2 class="h3">Lista de permisos</h2>
                @foreach ($permissions as $permission)
                    <div>
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1"
                            {{ in_array($permission->id, $selectedPermissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $permission->description }}
                        </label>
                    </div>
                @endforeach


                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar niver jerarquico
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
