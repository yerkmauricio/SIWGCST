@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('Asisnar un rol:') }}&nbsp;{{ ucfirst($usuario->empleado->nombre) }}</h1>
        </div>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class = "alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos y no
                        olvide subir la foto.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('usuarios.update', $usuario) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($usuario->empleado->foto) }}" class="img-fluid custom-img" alt="">
                </div>
                {{-- esto es de la foto --}}
                {{-- <h2 class="h5">listado de roles</h2>
                @foreach ($roles as $role)
                    <div>
                        <label>
                            @csrf
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-1">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach --}}

                <h2 class="h5">Listado de roles</h2>
                @foreach ($roles as $role)
                    <div>
                        <label>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="mr-1"
                                {{ $usuario->hasRole($role->name) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Asignar un rol
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <style>
        .custom-img {
            width: 350px;
            height: auto;
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(14, 14, 121), rgb(10, 186, 10)) 1;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@stop
