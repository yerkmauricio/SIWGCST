@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body" style="text-align: center;">
            <strong>
                @if ($cotizacion == 0)
                    <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para agregar un nuevo tour</h1>
                @else
                    <h1 style="text-transform: uppercase; font-weight: bold;">Formulario para cotizar un tour</h1>
                @endif

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
            @if ($cotizacion == 0)
                <form method="POST" action="{{ route('tours.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="cotizacion" value="0">
                    <input type="hidden" name="guia" value="50">
                    <input type="hidden" name="utilidad" value="1">
                    <input type="hidden" name="personas" value="5">

                    {{-- destino_id --}}
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <select name="destino_id" class="form-control">
                            <option value="" selected disabled>Seleccione el destino</option>
                            @foreach ($destinos as $destinoId => $destinoNombre)
                                <option value="{{ $destinoId }}" {{ old('destino_id') == $destinoId ? 'selected' : '' }}>
                                    {{ $destinoNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('destino_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- hospedaje_id --}}
                    <div class="form-group">
                        <label for="hospedaje">Hospedaje:</label>
                        <select name="hospedaje_id" class="form-control">
                            <option value="" selected disabled>Seleccione el hospedaje</option>
                            @foreach ($hospedajes as $hospedajeId => $hospedajeNombre)
                                <option value="{{ $hospedajeId }}"
                                    {{ old('hospedaje_id') == $hospedajeId ? 'selected' : '' }}>
                                    {{ $hospedajeNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('hospedaje_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- ndia --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Cantidad de dias </label>
                        <input type="number" class="form-control" name="ndia" value="{{ old('ndia') }}"
                            placeholder="Ingrese la cantidad de dias ">
                        @error('ndia')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- dificultad --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Dificultad del tour</label>
                        <select class="form-control" name="dificultad">
                            <option value="muy facil" @if (old('dificultad') == 'muy facil') selected @endif>Muy facil</option>
                            <option value="facil" @if (old('dificultad') == 'facil') selected @endif>Facil</option>
                            <option value="normal" @if (old('dificultad') == 'normal') selected @endif>Normal</option>
                            <option value="dificil" @if (old('dificultad') == 'dificil') selected @endif>Dificil </option>
                            <option value="muy dificil" @if (old('dificultad') == 'muy dificil') selected @endif>Muy dificil
                            </option>
                        </select>
                        @error('dificultad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">

                        {{-- hinicio --}}
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput">Hora de inicio</label>
                            <input type="time" class="form-control" name="hinicio" value="{{ old('hinicio') }}">
                            @error('hinicio')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- hfin --}}
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput">Hora de finilizacion </label>
                            <input type="time" class="form-control" name="hfin" value="{{ old('hfin') }}">
                            @error('hfin')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- precio --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Precio del tour</label>
                        <input type="number" class="form-control" name="precio" step="0.1"
                            value="{{ old('precio') }}" placeholder="Ingrese el precio">
                        @error('precio')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- precioprivado --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Precio privado del tour</label>
                        <input type="number" class="form-control" name="precioprivado" step="0.1"
                            value="{{ old('precioprivado') }}" placeholder="Ingrese el precio privado">
                        @error('precioprivado')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- recomendaciones --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Recomendaciones del tour</label>
                        <input type="text" class="form-control" name="recomendaciones"
                            value="{{ old('recomendaciones') }}" placeholder="Ingrese la recomendaciones">
                        @error('recomendaciones')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- llevar --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Objetos a llevar</label>
                        <input type="text" class="form-control" name="llevar" value="{{ old('llevar') }}"
                            placeholder="Ingrese las cosas que el turista tiene que llevar">
                        @error('llevar')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- alimento_id --}}
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


                    {{-- transporte_id --}}
                    <div class="form-group">
                        <label for="transporte">Transporte:</label>
                        <select name="transporte_id" class="form-control">
                            <option value="" selected disabled>Seleccione el transporte</option>
                            @foreach ($transportes as $transporteId => $transporteNombre)
                                <option value="{{ $transporteId }}"
                                    {{ old('transporte_id') == $transporteId ? 'selected' : '' }}>
                                    {{ $transporteNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('transporte_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">

                        {{-- obs_include_id --}}
                        <div class="col-md-6 mb-3">
                            <label for="obs_include">Incluye:</label>
                            <select name="obs_include_id" class="form-control">
                                <option value="" selected disabled>Seleccione lo que incluye</option>
                                @foreach ($obs_includes as $obs_includeId => $obs_includeNombre)
                                    <option value="{{ $obs_includeId }}"
                                        {{ old('obs_include_id') == $obs_includeId ? 'selected' : '' }}>
                                        {{ $obs_includeNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('obs_include_id')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- obs_noinclude_id --}}
                        <div class="col-md-6 mb-3">
                            <label for="obs_noinclude">No incluye:</label>
                            <select name="obs_noinclude_id" class="form-control">
                                <option value="" selected disabled>Seleccione lo que no incluye</option>
                                @foreach ($obs_noincludes as $obs_noincludeId => $obs_noincludeNombre)
                                    <option value="{{ $obs_includeId }}"
                                        {{ old('obs_noinclude_id') == $obs_noincludeId ? 'selected' : '' }}>
                                        {{ $obs_noincludeNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('obs_noinclude_id')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- foto_tour_id --}}
                    <div class="form-group">
                        <label for="foto_tour">Nombre de la foto:</label>
                        <select name="foto_tour_id" class="form-control">
                            <option value="" selected disabled>Seleccione el nombre de la foto</option>
                            @php
                                $seen = [];
                            @endphp
                            @foreach ($foto_tours as $foto_tour)
                                @if (!in_array($foto_tour->nombre, $seen))
                                    <option value="{{ $foto_tour->id }}"
                                        {{ old('foto_tour_id') == $foto_tour->id ? 'selected' : '' }}>
                                        {{ $foto_tour->nombre }}
                                    </option>
                                    @php
                                        $seen[] = $foto_tour->nombre;
                                    @endphp
                                @endif
                            @endforeach
                        </select>


                        @error('foto_tour_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>



                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-success float-center">
                            <i class="fas fa-plus"></i>
                            Agregar tour
                        </button>
                    </div>
                </form>
            @else
                <div class="card1">
                    <div class="card1-content">
                        <p class="card1-title">REQUISITOS
                        </p>
                        <p class="card1-para">1. Tener el destino</p>
                        <p class="card1-para">2. Tener el hospedaje si hay la nesesidad</p>
                        <p class="card1-para">3. Tener el Trasporte si hay la necesidad</p>
                        <p class="card1-para">4. Tener la lista de objetos que incluyen</p>
                        <p class="card1-para">5. Tener la lista de objetos que no incluyen</p>
                        <p class="card1-para">6. Tener fotos del destino</p>
                    </div>
                </div>
                <br>

                <form method="POST" action="{{ route('tours.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cotizacion" value="1">
                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label for="guia">Precio guia:</label>
                            <input type="number" class="form-control" name="guia" value="{{ old('guia') }}"
                                placeholder="Ingrese el precio del guia">
                            @error('guia')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="utilidad">Pocentaje de utilidad:</label>
                            <input type="number" class="form-control" name="utilidad" value="{{ old('utilidad') }}"
                                placeholder="Ingrese la utilidad">
                            @error('utilidad')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="personas">Cantidad de personas:</label>
                            <input type="number" class="form-control" name="personas" value="{{ old('personas') }}"
                                placeholder="Ingrese la cantidad de personas">
                            @error('personas')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- destino_id --}}
                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <select name="destino_id" class="form-control">
                            <option value="" selected disabled>Seleccione el destino</option>
                            @foreach ($destinos as $destinoId => $destinoNombre)
                                <option value="{{ $destinoId }}"
                                    {{ old('destino_id') == $destinoId ? 'selected' : '' }}>
                                    {{ $destinoNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('destino_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- hospedaje_id --}}
                    <div class="form-group">
                        <label for="hospedaje">Hospedaje:</label>
                        <select name="hospedaje_id" class="form-control">
                            <option value="" selected disabled>Seleccione el hospedaje</option>
                            @foreach ($hospedajes as $hospedajeId => $hospedajeNombre)
                                <option value="{{ $hospedajeId }}"
                                    {{ old('hospedaje_id') == $hospedajeId ? 'selected' : '' }}>
                                    {{ $hospedajeNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('hospedaje_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- ndia --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Cantidad de dias </label>
                        <input type="number" class="form-control" name="ndia" value="{{ old('ndia') }}"
                            placeholder="Ingrese la cantidad de dias ">
                        @error('ndia')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- dificultad --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Dificultad del tour</label>
                        <select class="form-control" name="dificultad">
                            <option value="muy facil" @if (old('dificultad') == 'muy facil') selected @endif>Muy facil</option>
                            <option value="facil" @if (old('dificultad') == 'facil') selected @endif>Facil</option>
                            <option value="normal" @if (old('dificultad') == 'normal') selected @endif>Normal</option>
                            <option value="dificil" @if (old('dificultad') == 'dificil') selected @endif>Dificil </option>
                            <option value="muy dificil" @if (old('dificultad') == 'muy dificil') selected @endif>Muy dificil
                            </option>
                        </select>
                        @error('dificultad')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">

                        {{-- hinicio --}}
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput">Hora de inicio</label>
                            <input type="time" class="form-control" name="hinicio" value="{{ old('hinicio') }}">
                            @error('hinicio')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- hfin --}}
                        <div class="col-md-6 mb-3">
                            <label for="formGroupExampleInput">Hora de finilizacion </label>
                            <input type="time" class="form-control" name="hfin" value="{{ old('hfin') }}">
                            @error('hfin')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- recomendaciones --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Recomendaciones del tour</label>
                        <input type="text" class="form-control" name="recomendaciones"
                            value="{{ old('recomendaciones') }}" placeholder="Ingrese la recomendaciones">
                        @error('recomendaciones')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- llevar --}}
                    <div class="form-group">
                        <label for="formGroupExampleInput">Objetos a llevar</label>
                        <input type="text" class="form-control" name="llevar" value="{{ old('llevar') }}"
                            placeholder="Ingrese las cosas que el turista tiene que llevar">
                        @error('llevar')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- alimento_id --}}
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


                    {{-- transporte_id --}}
                    <div class="form-group">
                        <label for="transporte">Transporte:</label>
                        <select name="transporte_id" class="form-control">
                            <option value="" selected disabled>Seleccione el transporte</option>
                            @foreach ($transportes as $transporteId => $transporteNombre)
                                <option value="{{ $transporteId }}"
                                    {{ old('transporte_id') == $transporteId ? 'selected' : '' }}>
                                    {{ $transporteNombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('transporte_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">

                        {{-- obs_include_id --}}
                        <div class="col-md-6 mb-3">
                            <label for="obs_include">Incluye:</label>
                            <select name="obs_include_id" class="form-control">
                                <option value="" selected disabled>Seleccione lo que incluye</option>
                                @foreach ($obs_includes as $obs_includeId => $obs_includeNombre)
                                    <option value="{{ $obs_includeId }}"
                                        {{ old('obs_include_id') == $obs_includeId ? 'selected' : '' }}>
                                        {{ $obs_includeNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('obs_include_id')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- obs_noinclude_id --}}
                        <div class="col-md-6 mb-3">
                            <label for="obs_noinclude">No incluye:</label>
                            <select name="obs_noinclude_id" class="form-control">
                                <option value="" selected disabled>Seleccione lo que no incluye</option>
                                @foreach ($obs_noincludes as $obs_noincludeId => $obs_noincludeNombre)
                                    <option value="{{ $obs_includeId }}"
                                        {{ old('obs_noinclude_id') == $obs_noincludeId ? 'selected' : '' }}>
                                        {{ $obs_noincludeNombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('obs_noinclude_id')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    {{-- foto_tour_id --}}
                    <div class="form-group">
                        <label for="foto_tour">Nombre de la foto:</label>
                        <select name="foto_tour_id" class="form-control">
                            <option value="" selected disabled>Seleccione el nombre de la foto</option>
                            @php
                                $seen = [];
                            @endphp
                            @foreach ($foto_tours as $foto_tour)
                                @if (!in_array($foto_tour->nombre, $seen))
                                    <option value="{{ $foto_tour->id }}"
                                        {{ old('foto_tour_id') == $foto_tour->id ? 'selected' : '' }}>
                                        {{ $foto_tour->nombre }}
                                    </option>
                                    @php
                                        $seen[] = $foto_tour->nombre;
                                    @endphp
                                @endif
                            @endforeach
                        </select>


                        @error('foto_tour_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-success float-center">
                            <i class="fas fa-plus"></i>
                            Agregar tour
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <style>
        select.form-control:hover,
        input[type="time"]:hover,
        input[type="text"]:hover,
        input[type="number"]:hover,
        input[type="time"]:focus {
            border-color: rgb(51, 103, 214);
            box-shadow: 0 0 5px rgb(13, 57, 123);
            outline: none;
        }
    </style>

    <style>
        .card1 {
            width: 300px;
            height: 350px;
            background-color: #FF3CAC;
            background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%);
            color: white;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            perspective: 1000px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            cursor: pointer;
        }

        .card1-content {
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .card1:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card1:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background-color: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
            z-index: 1;
        }

        .card1:hover:before {
            opacity: 1;
        }

        .card1 .card1-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: capitalize;
        }

        .card1 .card1-para {
            font-size: 16px;
            opacity: 0.8;
        }

        .card1-content {
            transform: translateY(50%);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .card1:hover .card1-content {
            transform: translateY(0%);
        }
    </style>
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
