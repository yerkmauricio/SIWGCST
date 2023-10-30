@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>{{ ucfirst('modificar al producto:') }}&nbsp;{{ ucfirst($producto->nombre) }}</h1>
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
            <form method="POST" action="{{ route('productos.update', $producto) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($producto->foto) }}" class="img-fluid custom-img"
                        alt="">
                </div>

                {{-- esto es de la foto --}}

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $producto->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo del producto</label>
                    <select class="form-control" name="tipo">
                        <option value="verdura" @if (old('tipo', $producto->tipo) == 'verdura') selected @endif>Verdura</option>
                        <option value="fruta" @if (old('tipo', $producto->tipo) == 'fruta') selected @endif>Fruta</option>
                        <option value="liquido" @if (old('tipo', $producto->tipo) == 'liquido') selected @endif>liquido</option>
                        <option value="carne" @if (old('tipo', $producto->tipo) == 'carne') selected @endif>carne</option>
                        <option value="postre" @if (old('tipo', $producto->tipo) == 'postre') selected @endif>postre</option>
                        <option value="lacteo" @if (old('tipo', $producto->tipo) == 'lacteo') selected @endif>Lacteos</option>
                        <option value="grasas" @if (old('tipo', $producto->tipo) == 'grasas') selected @endif>Grasas</option>
                        <option value="accesorio" @if (old('tipo', $producto->tipo) == 'accesorio') selected @endif>Accesorios</option>
                        <option value="proteinas" @if (old('tipo', $producto->tipo) == 'proteinas') selected @endif>Proteinas</option>
                        <option value="dulce" @if (old('tipo', $producto->tipo) == 'dulce') selected @endif>Dulces</option>
                        <option value="carbohidrato" @if (old('tipo', $producto->tipo) == 'carbohidrato') selected @endif>Carbohidratos
                        </option>
                        <option value="salsa" @if (old('tipo', $producto->tipo) == 'salsa') selected @endif>Salsas</option>
                        <option value="repostería" @if (old('tipo', $producto->tipo) == 'repostería') selected @endif>Reposterías</option>
                        <option value="especia" @if (old('tipo', $producto->tipo) == 'especia') selected @endif>Especias</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del producto</label>
                    <input type="number" class="form-control" name="precio" step="0.1"
                        value="{{ old('precio', $producto->precio) }}">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del producto</label>
                    <input type="text" class="form-control" name="descripcion"
                        value="{{ old('descripcion', $producto->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- categoria --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Categoría del producto</label>
                    <select class="form-control" name="categoria">
                        <option value="kilos" @if (old('categoria', $producto->categoria) == 'kilos') selected @endif>Kilos</option>
                        <option value="litros" @if (old('categoria', $producto->categoria) == 'litros') selected @endif>Litros</option>
                        <option value="unidad" @if (old('categoria', $producto->categoria) == 'unidad') selected @endif>Unidad</option>
                        <option value="libras" @if (old('categoria', $producto->categoria) == 'libras') selected @endif>Libras</option>
                        <option value="sobres" @if (old('categoria', $producto->categoria) == 'sobres') selected @endif>Sobre</option>
                    </select>
                    @error('categoria')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                {{-- cantidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Cantidad del producto</label>
                    <input type="text" class="form-control" name="cantidad"
                        value="{{ old('cantidad', $producto->cantidad) }}">
                    @error('cantidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto del producto</label>
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
                        Actualizar Producto
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
