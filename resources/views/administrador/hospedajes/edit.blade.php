@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <h1>{{ ucfirst('modificar al hospedaje:') }}&nbsp;{{ ucfirst($hospedaje->nombre) }}</h1>
    </div>
</div>
@stop

@section('content') 
    
    <div class="card"  style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos  .</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" action="{{ route ('hospedajes.update', $hospedaje )}}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($hospedaje->foto) }}" class="img-fluid custom-img"
                        alt="">
                </div>
                {{--esto es de la foto --}}
                
                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del hospedaje</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $hospedaje->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                 {{-- tipo --}} 
                 <div class="form-group">
                    <label for="formGroupExampleInput">Tipo del producto</label>
                    <select class="form-control" name="tipo" >
                        <option value="hotel"  @if(old('tipo', $hospedaje->tipo) == 'hotel') selected @endif>Hotel</option>
                        <option value="alojamiento"  @if(old('tipo', $hospedaje->tipo) == 'alojamiento') selected @endif>Alojamiento</option>
                        <option value="camping"  @if(old('tipo', $hospedaje->tipo) == 'camping') selected @endif>Camping</option>
                        <option value="alberge"  @if(old('tipo', $hospedaje->tipo) == 'alberge') selected @endif>Alberge</option>
                        <option value="casas rurales"  @if(old('tipo', $hospedaje->tipo) == 'casas rurales') selected @endif>Casas rurales</option>
                        <option value="B&B"  @if(old('tipo', $hospedaje->tipo) == 'B&B') selected @endif>B&B</option>
                        <option value="hostal"  @if(old('tipo', $hospedaje->tipo) == 'hostal') selected @endif>Hostal</option>
                        <option value="clamping"  @if(old('tipo', $hospedaje->tipo) == 'clamping') selected @endif>Clamping</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- empresa --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Empresa del hospedaje</label>
                    <input type="text" class="form-control" name="empresa" value="{{ old('empresa', $hospedaje->empresa) }}">
                    @error('empresa')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del hospedaje</label>
                    <input type="number" class="form-control" name="precio" value="{{ old('precio', $hospedaje->precio) }}">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- ubicacion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Ubicacion del hospedaje</label>
                    <input type="text" class="form-control" name="ubicacion" value="{{ old('ubicacion',  $hospedaje->ubicacion)}}">
                    @error('ubicacion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">whatsapp del hospedaje</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $hospedaje->whatsapp) }}">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Foto del hospedaje</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg" onchange="previewImage(event)">
                    @error('foto')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Imagen seleccionada:</label>
                    <img id="imagePreview" src="#" alt="Imagen seleccionada" style="max-width: 200px; display: none;">
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar hospedaje
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