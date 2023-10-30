@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <h1>{{ ucfirst('modificar al destino:') }}&nbsp;{{ ucfirst($destino->nombre) }}</h1>
    </div>
</div>
@stop

@section('content') 
    
    <div class="card">
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
            <form method="POST" style="font-family: 'Times New Roman', Times, serif;" action="{{ route ('destinos.update', $destino )}}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($destino->foto) }}" class="img-fluid custom-img"
                        alt="">
                </div>
                {{--esto es de la foto --}}
                
                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del destino</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $destino->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 {{-- ubicacion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">ubicacion del hospedaje</label>
                    <input type="text" class="form-control" name="ubicacion" value="{{ old('ubicacion',  $destino->ubicacion)}}">
                    @error('ubicacion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- entrada --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Entrada del destino</label>
                    <input type="number" class="form-control" name="entrada" value="{{ old('entrada', $destino->entrada) }}">
                    @error('entrada')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            
                 {{-- categoria --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">categoria del destino</label>
                    <select class="form-control" name="categoria" >
                        <option value="sol y playa"  @if(old('categoria', $destino->categoria) == 'sol y playa') selected @endif>sol y playa</option>
                        <option value="rural"  @if(old('categoria', $destino->categoria) == 'rural') selected @endif>rural</option>
                        <option value="gatronomico"  @if(old('categoria', $destino->categoria) == 'camping') selected @endif>gatronomico</option>
                        <option value="naturaleza"  @if(old('categoria', $destino->categoria) == 'naturaleza') selected @endif>naturaleza</option>
                         <option value="cultural"  @if(old('categoria', $destino->categoria) == 'cultural') selected @endif>cultural</option>
                        <option value="montaña"  @if(old('categoria', $destino->categoria) == 'montaña') selected @endif>montaña</option>
                    </select>
                    @error('categoria')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                 {{-- descripcion --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del destino</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion', $destino->descripcion) }}">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- distancia --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">distancia del destino</label>
                    <input type="number" class="form-control" name="distancia" step="0.01" value="{{ old('distancia', $destino->distancia) }}">
                    @error('distancia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                
                 {{-- altura --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Altura del destino</label>
                    <input type="number" class="form-control" name="altura" step="0.01" value="{{ old('altura', $destino->altura) }}" placeholder="Ingrese la altura del destino en kilometros">
                    @error('altura')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- clima --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">clima del destino</label>
                    <select class="form-control" name="clima" >
                        <option value="frio"  @if(old('clima', $destino->clima) == 'frio') selected @endif>Frio</option>
                        <option value="templado"  @if(old('clima', $destino->clima) == 'templado') selected @endif>Templado</option>
                        <option value="tropical"  @if(old('clima', $destino->clima) == 'tropical') selected @endif>Tropical</option>
                        <option value="templado"  @if(old('clima', $destino->clima) == 'templado') selected @endif>Templado</option>
                        <option value="calido"  @if(old('clima', $destino->clima) == 'calido') selected @endif>Calido</option>
                    </select>
                    @error('clima')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">whatsapp del destino</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $destino->whatsapp) }}">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- foto --}}
                <div class="form-group">
                    <label>Foto del destino</label>
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
                        Actualizar destino
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