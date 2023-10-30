@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('modificar la foto tour:') }}&nbsp;{{ ucfirst($foto_tour->nombre) }}</h1>
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
            <form method="POST" style="font-family: 'Times New Roman', Times, serif;"
                action="{{ route('foto_tours.update', $foto_tour) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($foto_tour->foto) }}" class="img-fluid custom-img" alt="">
                </div>
                {{-- esto es de la foto --}}

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre de la foto</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $foto_tour->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del alimento</label>
                    <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $foto_tour->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- foto --}}
                <div class="form-group">
                    <label>Foto del tour</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg"
                        onchange="previewImage(event)">
                    @error('foto')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Imagen seleccionada:</label>
                    <img id="imagePreview" src="#" alt="Imagen seleccionada"
                        style="max-width: 200px; display: none;">
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar foto del Tour
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')
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

    {{-- foto --}}
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
