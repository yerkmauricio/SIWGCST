@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo hospedaje</h1>
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
            <form method="POST" action="{{ route('hospedajes.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del hospedaje</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del hospedaje">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 {{-- tipo --}}
                 <div class="form-group">
                    <label for="formGroupExampleInput">Tipo del producto</label>
                    <select class="form-control" name="tipo" >
                        <option value="hotel"  @if(old('tipo') == 'hotel') selected @endif>Hotel</option>
                        <option value="alojamiento"  @if(old('tipo') == 'alojamiento') selected @endif>Alojamiento</option>
                        <option value="camping"  @if(old('tipo') == 'camping') selected @endif>Camping</option>
                        <option value="alberge"  @if(old('tipo') == 'alberge') selected @endif>Alberge</option>
                        <option value="casas rurales"  @if(old('tipo') == 'casas rurales') selected @endif>Casas rurales</option>
                        <option value="B&B"  @if(old('tipo') == 'B&B') selected @endif>B&B</option>
                        <option value="hostal"  @if(old('tipo') == 'hostal') selected @endif>Hostal</option>
                        <option value="clamping"  @if(old('tipo') == 'clamping') selected @endif>Clamping</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- empresa --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Empresa del hospedaje</label>
                    <input type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" placeholder="Ingrese el nombre de la empresa a la que pertenece">
                    @error('empresa')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del hospedaje</label>
                    <input type="number" class="form-control" name="precio" step="0.1" value="{{ old('precio') }}" placeholder="Ingrese el precio por persona">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del hospedaje</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Seleccion el codigo de pais y el numero">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- ubicacion --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Ubicacion del hospedaje</label>
                    <input type="text" class="form-control" name="ubicacion" value="{{ old('ubicacion') }}"  placeholder="Ingrese la ubicación del hospedaje">
                    @error('ubicacion')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto del hospedaje</label>
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
                        Agregar hospedaje
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
