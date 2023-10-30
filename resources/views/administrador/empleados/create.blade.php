@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo empleado</h1>
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

            <form method="POST" action="{{ route('empleados.store') }}" enctype="multipart/form-data">

                @csrf {{-- evita sql inyection --}}

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del empleado</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}"
                        placeholder="Ingrese el nombre del empleado">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- apellidopaterno --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido paterno del empleado</label>
                    <input type="text" class="form-control" name="apellidopaterno" value="{{ old('apellidopaterno') }}"
                        placeholder="Ingrese el apellido paterno del empleado">
                    @error('apellidopaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- apellidomaterno --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido materno del empleado</label>
                    <input type="text" class="form-control" name="apellidomaterno" value="{{ old('apellidomaterno') }}"
                        placeholder="Ingrese el apellido materno del empleado">
                    @error('apellidomaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- dni --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ old('dni') }}"
                        placeholder="Ingrese el Documento nacional de identidad del empleado">
                    @error('dni')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- domicilio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Domicilio del empleado</label>
                    <input type="text" class="form-control" name="domicilio" value="{{ old('domicilio') }}"
                        placeholder="Ingrese la domicilio del empleado">
                    @error('domicilio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- nacionalidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nacionalidad del empleado</label>
                    <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad') }}"
                        placeholder="Ingrese la nacionalidad del empleado">
                    @error('nacionalidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- genero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Genero del empleado</label>
                    <select class="form-control" name="genero">
                        <option value="1" @if (old('estado') == '1') selected @endif>Masculino</option>
                        <option value="0" @if (old('estado') == '0') selected @endif>Femenino</option>
                    </select>
                    @error('genero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del empleado</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                            value="{{ old('whatsapp') }}" placeholder="seleccion el codigo de pais y el numero">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- fnacimiento --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de nacimiento del empleado</label>
                    <input type="date" class="form-control" name="fnacimiento" value="{{ old('fnacimiento') }}">
                    @error('fnacimiento')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- cargo --}}
                <div class="form-group">
                    <label for="area">Cargo:</label>
                    <select name="cargo_id" class="form-control">
                        <option value="" selected disabled>Seleccione el cargo</option>

                        @foreach ($cargos as $cargoId => $cargoNombre)
                            <option value="{{ $cargoId }}" {{ old('cargo_id') == $cargoId ? 'selected' : '' }}>
                                {{ $cargoNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('cargo_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- n_jerarquico --}}
                <div class="form-group">
                    <label for="n_jerarquico">Nivel jerarquico:</label>
                    <select name="n_jerarquico_id" class="form-control">
                        <option value="" selected disabled>Seleccione el nivel jerarquico</option>

                        @foreach ($n_jerarquicos as $n_jerarquicoId => $n_jerarquicoNombre)
                            <option value="{{ $n_jerarquicoId }}"
                                {{ old('n_jerarquico_id') == $n_jerarquicoId ? 'selected' : '' }}>
                                {{ $n_jerarquicoNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('n_jerarquico_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- foto --}}
                <div class="form-group">
                    <label>Foto del empleado</label>
                    <input type="file" class="form-control-file" name="foto" accept=".jpg, image/jpeg"
                        value="{{ old('foto') }}" onchange="previewImage(event)">
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
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar empleado
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
