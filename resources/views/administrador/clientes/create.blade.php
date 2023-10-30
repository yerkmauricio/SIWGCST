@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo cliente</h1>
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

            <form method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data">

                @csrf {{-- evita sql inyection --}}


                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="{{ $nombre ?? old('nombre') }}"
                        placeholder="Ingrese el nombre del cliente">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- apellido --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido" value="{{ $apellido ?? old('apellido') }}"
                        placeholder="Ingrese el apellido del cliente">
                    @error('apellido')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                {{-- hotel --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Hotel del cliente</label>
                    <input type="text" class="form-control" name="hotel" value="{{ old('hotel') }}"
                        placeholder="Ingrese el hotel del cliente">
                    @error('hotel')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- nroom --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Numero de habitación del cliente</label>
                    <input type="number" class="form-control" name="nroom" value="{{ old('nroom') }}"
                        placeholder="Ingrese el alergia habitacion del cliente">
                    @error('nroom')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del cliente</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                            value="{{ old('whatsapp') }}" placeholder="Seleccion el codigo de pais y el numero">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- dni --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ $dni ?? old('dni') }}"
                        placeholder="Ingrese el Documento nacional de identidad del cliente">
                    @error('dni')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                {{-- nacionalidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nacionalidad del cliente</label>
                    <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad') }}"
                        placeholder="Ingrese la nacionalidad del cliente">
                    @error('nacionalidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- altura --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Altura del cliente</label>
                    <input type="number" class="form-control" name="altura" step="0.01" value="{{ old('altura') }}"
                        placeholder="Ingrese la altura del cliente en metros">
                    @error('altura')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- talla --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">talla del cliente</label>
                    <select class="form-control" name="talla">
                        <option value="S" @if (old('talla') == 'S') selected @endif>S</option>
                        <option value="M" @if (old('talla') == 'M') selected @endif>M</option>
                        <option value="L" @if (old('talla') == 'L') selected @endif>L</option>
                        <option value="XL" @if (old('talla') == 'XL') selected @endif>XL</option>
                        <option value="XXL" @if (old('talla') == 'XXL') selected @endif>XXL</option>
                    </select>
                    @error('talla')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- genero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Genero del cliente</label>
                    <select class="form-control" name="genero">
                        <option value="1" @if (old('genero') == '1') selected @endif>Masculino</option>
                        <option value="0" @if (old('genero') == '0') selected @endif>Femenino</option>
                    </select>
                    @error('genero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- alergia --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Alergia del cliente</label>
                    <input type="text" class="form-control" name="alergia" value="{{ old('alergia') }}"
                        placeholder="Ingrese la alergia del cliente">
                    @error('alergia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- fnacimiento --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de nacimiento del cliente</label>
                    <input type="date" class="form-control" name="fnacimiento" value="{{ old('fnacimiento') }}">
                    @error('fnacimiento')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- alimento --}}
                <div class="form-group">
                    <label for="alimento">Alimento:</label>
                    <select name="alimento_id" class="form-control">
                        <option value="" selected disabled>Seleccione el alimento</option>
                        @foreach ($alimentos as $alimentoId => $alimentoNombre)
                            <option value="{{ $alimentoId }}"
                                {{ old('alimento_id') == $alimentoId ? 'selected' : '' }}>
                                {{ $alimentoNombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('alimento_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success float-center">
                        <i class="fas fa-plus"></i>
                        Agregar cliente
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
