@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($empleado->genero == 1)
                <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar al empleado:') }}
                    {{ $empleado->nombre }}</h1>
            @else
                <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar a la empleada:') }}
                    {{ $empleado->nombre }}</h1>
            @endif

        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos y no
                        olvide subir la foto.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('empleados.update', $empleado) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')
                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($empleado->foto) }}" class="img-fluid custom-img" alt="">
                </div>
                <br>
                {{-- esto es de la foto --}}

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del empleado</label>
                    <input type="text" class="form-control" name="nombre"
                        value="{{ old('nombre', $empleado->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- apellidopaterno --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido paterno del empleado</label>
                    <input type="text" class="form-control" name="apellidopaterno"
                        value="{{ old('apellidopaterno', $empleado->apellidopaterno) }}">
                    @error('apellidopaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- apellidomaterno --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido materno del empleado</label>
                    <input type="text" class="form-control" name="apellidomaterno"
                        value="{{ old('apellidomaterno', $empleado->apellidomaterno) }}">
                    @error('apellidomaterno')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- dni --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ old('dni', $empleado->dni) }}">
                    @error('dni')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- domicilio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Domicilio del empleado</label>
                    <input type="text" class="form-control" name="domicilio"
                        value="{{ old('domicilio', $empleado->domicilio) }}">
                    @error('domicilio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- nacionalidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nacionalidad del empleado</label>
                    <input type="text" class="form-control" name="nacionalidad"
                        value="{{ old('nacionalidad', $empleado->nacionalidad) }}">
                    @error('nacionalidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- genero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Genero del empleado</label>
                    <select class="form-control" name="genero">
                        <option value="1" @if (old('genero', $empleado->genero) == '1') selected @endif>Masculino</option>
                        <option value="0" @if (old('genero', $empleado->genero) == '0') selected @endif>Femenino</option>
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
                            value="{{ old('whatsapp', $empleado->whatsapp) }}">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- fnacimiento --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de nacimiento del empleado</label>
                    <input type="date" class="form-control" name="fnacimiento"
                        value="{{ old('fnacimiento', $empleado->fnacimiento) }}">
                    @error('fnacimiento')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- est_laboral --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado laboral del empleado</label>
                    <select class="form-control" name="est_laboral">
                        <option value="1" @if (old('estado', $empleado->est_laboral) == '1') selected @endif>Trabajando</option>
                        <option value="0" @if (old('estado', $empleado->est_laboral) == '0') selected @endif>No trabajando</option>
                    </select>
                    @error('est_laboral')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- fsuspension --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de suspension del empleado</label>
                    <input type="date" class="form-control" name="fsuspension"
                        value="{{ old('fsuspension', $empleado->fsuspension) }}">
                    @error('fsuspension')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- cargo --}}
                <div class="form-group">
                    <label for="area">Cargo:</label>
                    <select name="cargo_id" class="form-control">
                        <option value="" selected disabled>Seleccione el cargo</option>

                        @foreach ($cargos as $cargoId => $cargoNombre)
                            <option value="{{ $cargoId }}"
                                {{ old('cargo_id', $empleado->cargo_id) == $cargoId ? 'selected' : '' }}>
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
                                {{ old('n_jerarquico_id', $empleado->n_jerarquico_id) == $n_jerarquicoId ? 'selected' : '' }}>
                                {{ $n_jerarquicoNombre }}
                            </option>
                        @endforeach

                    </select>
                    @error('n_jerarquico_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Foto del empleado</label>
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
                        Actualizar empleado
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
