@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo producto</h1>
            </strong>
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
            <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del producto</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del producto">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">tipo del producto</label>
                    <select class="form-control" name="tipo" >
                        <option value="verduras"  @if(old('tipo') == 'verdura') selected @endif>Verduras</option>
                        <option value="frutas"  @if(old('tipo') == 'fruta') selected @endif>Frutas</option>
                        <option value="snack"  @if(old('tipo') == 'snack') selected @endif>Snack</option>
                        <option value="bebidas"  @if(old('tipo') == 'bebidas') selected @endif>Bebidas</option>
                        <option value="carne"  @if(old('tipo') == 'carne') selected @endif>Carnes</option>
                        <option value="lacteo"  @if(old('tipo') == 'lacteo') selected @endif>Lacteos</option>
                        <option value="grasas"  @if(old('tipo') == 'grasas') selected @endif>Grasas</option>
                        <option value="accesorio"  @if(old('tipo') == 'accesorio') selected @endif>Accesorios</option>
                        <option value="proteinas"  @if(old('tipo') == 'proteinas') selected @endif>Proteinas</option>
                        <option value="dulce"  @if(old('tipo') == 'dulce') selected @endif>Dulces</option>
                        <option value="carbohidrato"  @if(old('tipo') == 'carbohidrato') selected @endif>Carbohidratos</option>
                        <option value="salsa"  @if(old('tipo') == 'salsa') selected @endif>Salsas</option>
                        <option value="repostería"  @if(old('tipo') == 'repostería') selected @endif>Reposterías</option>
                        <option value="especia"  @if(old('tipo') == 'especia') selected @endif>Especias</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del producto</label>
                    <input type="number" class="form-control" name="precio" step="0.1" value="{{ old('precio') }}" placeholder="Ingrese el monto del precio">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del producto</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="Ingrese la descripcion del producto">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- categoria --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Categoría del producto</label>
                    <select class="form-control" name="categoria" >
                        <option value="kilos" @if(old('categoria') == 'kilos') selected @endif>Kilos</option>
                        <option value="litros" @if(old('categoria') == 'litros') selected @endif>Litros</option>
                        <option value="unidad" @if(old('categoria') == 'unidad') selected @endif>Unidad</option>
                        <option value="libras" @if(old('categoria') == 'libras') selected @endif>Libras</option>
                        <option value="sobres" @if(old('categoria') == 'sobres') selected @endif >Sobre</option>
                    </select>
                    @error('categoria')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- cantidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Cantidad del producto</label>
                    <input type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}" placeholder="Ingrese la cantidad del producto por persona">
                    @error('cantidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto del Producto</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg" value="{{ old('foto') }}" onchange="previewImage(event)">
                    @error('foto')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label>Imagen seleccionada:</label>
                    <img id="imagePreview" src="#" alt="Imagen seleccionada" style="max-width: 200px; display: none;">
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar producto
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

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
