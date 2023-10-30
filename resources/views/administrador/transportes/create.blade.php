@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo transporte</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos y no olvide subir la foto.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('transportes.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del transporte</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el modelo del transporte">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de transporte</label>
                    <select class="form-control" name="tipo" >
                        <option value="minibus"  @if(old('tipo') == 'minibus') selected @endif>Minibus</option>
                        <option value="vagoneta"  @if(old('tipo') == 'vagoneta') selected @endif>Vagoneta</option>
                        <option value="vans"  @if(old('tipo') == 'vans') selected @endif>Vans</option>
                        <option value="flota"  @if(old('tipo') == 'flota') selected @endif>Flota</option>
                        <option value="motocicleta"  @if(old('tipo') == 'motocicleta') selected @endif>Motocicleta</option>
                        <option value="camioneta"  @if(old('tipo') == 'camioneta') selected @endif>Camioneta</option>
                        <option value="jeep"  @if(old('tipo') == 'jeep') selected @endif>Jeep</option>
                        <option value="automovil"  @if(old('tipo') == 'automovil') selected @endif>Automovil</option>
                        <option value="camion"  @if(old('tipo') == 'camion') selected @endif>Camion</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- empresa --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Empresa del transporte</label>
                    <input type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" placeholder="Ingrese el nombre de la empresa a la que pertenece el transporte">
                    @error('empresa')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- npasajero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Número de pasajero del transporte</label>
                    <input type="number" class="form-control" name="npasajero" value="{{ old('npasajero') }}" placeholder="Ingrese el numero de pasajeros del transporte">
                    @error('npasajero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del transporte</label>
                    <input type="number" class="form-control" name="precio" value="{{ old('precio') }}" step="0.1" placeholder="Ingrese el precio por persona">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del transporte</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Ingrese el whatsapp del transporte">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto del transporte</label>
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
                        Agregar transporte
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
    
@stop
