@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            @if ($cliente->genero == 1)
                <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar al cliente:') }}
                    {{ ucfirst($cliente->nombre) }} {{ ucfirst($cliente->apellido) }}</h1>
            @else
                <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar a la cliente:') }}
                    {{ ucfirst($cliente->nombre) }} {{ ucfirst($cliente->apellido) }}</h1>
            @endif

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
            <form method="POST" action="{{ route('clientes.update', $cliente) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del cliente</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- apellido --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Apellido del cliente</label>
                    <input type="text" class="form-control" name="apellido"
                        value="{{ old('apellido', $cliente->apellido) }}">
                    @error('apellido')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- hotel --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Hotel del cliente</label>
                    <input type="text" class="form-control" name="hotel" value="{{ old('hotel', $cliente->hotel) }}">
                    @error('hotel')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- nroom --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Numero de habitación del cliente</label>
                    <input type="number" class="form-control" name="nroom" value="{{ old('nroom', $cliente->nroom) }}">
                    @error('nroom')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del cliente</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                            value="{{ old('whatsapp', $cliente->whatsapp) }}">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- dni --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Documento nacional de identidad</label>
                    <input type="text" class="form-control" name="dni" value="{{ old('dni', $cliente->dni) }}">
                    @error('dni')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- nacionalidad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nacionalidad del cliente</label>
                    <input type="text" class="form-control" name="nacionalidad"
                        value="{{ old('nacionalidad', $cliente->nacionalidad) }}">
                    @error('nacionalidad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- altura --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Altura del cliente</label>
                    <input type="number" class="form-control" name="altura" step="0.01"
                        value="{{ old('altura', $cliente->altura) }}">
                    @error('altura')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- talla --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">talla del cliente</label>
                    <select class="form-control" name="talla">
                        <option value="S" @if (old('talla',$cliente->talla) == 'S') selected @endif>S</option>
                        <option value="M" @if (old('talla',$cliente->talla) == 'M') selected @endif>M</option>
                        <option value="L" @if (old('talla',$cliente->talla) == 'L') selected @endif>L</option>
                        <option value="XL" @if (old('talla',$cliente->talla) == 'XL') selected @endif>XL</option>
                        <option value="XXL" @if (old('talla',$cliente->talla) == 'XXL') selected @endif>XXL</option>
                    </select>
                    @error('talla')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- genero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Genero del cliente</label>
                    <select class="form-control" name="genero">
                        <option value="1" @if (old('genero', $cliente->genero) == '1') selected @endif>Masculino</option>
                        <option value="0" @if (old('genero', $cliente->genero) == '0') selected @endif>Femenino</option>
                    </select>
                    @error('genero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                 

                {{-- alergia --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Alergia del cliente</label>
                    <input type="text" class="form-control" name="alergia"
                        value="{{ old('alergia', $cliente->alergia) }}">
                    @error('alergia')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- fnacimiento --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de nacimiento del cliente</label>
                    <input type="date" class="form-control" name="fnacimiento"
                        value="{{ old('fnacimiento', $cliente->fnacimiento) }}">
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
                                {{ old('alimento_id', $cliente->alimento_id) == $alimentoId ? 'selected' : '' }}>
                                {{ $alimentoNombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('alimento_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar cliente
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
