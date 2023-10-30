@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo destino</h1>
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
            <form method="POST" action="{{ route('destinos.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del destino</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del destino">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div> 
                
                {{-- ubicacion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Ubicacion del destino</label>
                    <input type="text" class="form-control" name="ubicacion" value="{{ old('ubicacion') }}"  placeholder="Ingrese la ubicación del destino departamento y provincia">
                    @error('ubicacion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- entrada --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Entrada del destino</label>
                    <input type="number" class="form-control" name="entrada" step="0.1" value="{{ old('entrada') }}" placeholder="Ingrese el entrada por persona">
                    @error('entrada')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 {{-- categoria --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Categoria del destino</label>
                    <select class="form-control" name="categoria" >
                        <option value="sol y playa"  @if(old('categoria') == 'sol y playa') selected @endif>Sol y playa</option>
                        <option value="rural"  @if(old('categoria') == 'rural') selected @endif>Rural</option>
                        <option value="gastronomico"  @if(old('categoria') == 'gastronomico') selected @endif>Gastronomico</option>
                        <option value="naturaleza"  @if(old('categoria') == 'naturaleza') selected @endif>Naturaleza</option>
                        <option value="cultural"  @if(old('categoria') == 'cultural') selected @endif>Cultural</option>
                        <option value="montaña"  @if(old('categoria') == 'montaña') selected @endif>Montaña</option>
                    </select>
                    @error('categoria')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- descripcion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Descripcion del destino</label>
                    <input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="Ingrese la descripcion del destino">
                    @error('descripcion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- distancia --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Distancia del destino</label>
                    <input type="number" class="form-control" name="distancia" step="0.01" value="{{ old('distancia') }}" placeholder="Ingrese la distancia del destino en kilometros">
                    @error('distancia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 {{-- altura --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Altura del destino</label>
                    <input type="number" class="form-control" name="altura" step="0.01" value="{{ old('altura') }}" placeholder="Ingrese la altura del destino en kilometros">
                    @error('altura')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- clima --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">clima del destino</label>
                    <select class="form-control" name="clima" >
                        <option value="frio"  @if(old('clima') == 'frio') selected @endif>Frio</option>
                        <option value="templado"  @if(old('clima') == 'templado') selected @endif>Templado</option>
                        <option value="tropical"  @if(old('clima') == 'tropical') selected @endif>Tropical</option>
                        <option value="templado"  @if(old('clima') == 'templado') selected @endif>Templado</option>
                        <option value="calido"  @if(old('clima') == 'calido') selected @endif>Calido</option>
                    </select>
                    @error('clima')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del destino</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Seleccion el codigo de pais y el numero">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

               
                {{-- foto--}}
                <div class="form-group">
                    <label>Foto del destino</label>
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
                        Agregar destino
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <script>
        var input = document.querySelector("#whatsapp");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Agregado
        });
    
        input.addEventListener("countrychange", function() {
            var countryCode = iti.getSelectedCountryData().dialCode;
            var phoneNumber = input.value;
            var phoneNumberWithCountryCode = countryCode + phoneNumber;
            input.value = phoneNumberWithCountryCode;
        });
    
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

     {{-- trabajando con mapa --}}
     
    
@stop 
