@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>
                @if ($tour->ndia == 1)
                    <h1 style="text-transform: uppercase; font-weight: bold;">Actualizar tours: {{ $tour->destino->nombre }} de 
                        {{ $tour->ndia }} dia </h1>
                @else
                    @if ($tour->ndia == 2)
                        <h1 style="text-transform: uppercase; font-weight: bold;">Actualizar tours:
                            {{ $tour->destino->nombre }} de {{ $tour->ndia }}  dias y
                            {{ $tour->ndia - 1 }}
                            noche </h1>
                    @else
                        <h1 style="text-transform: uppercase; font-weight: bold;">Actualizar tours:
                            {{ $tour->destino->nombre }} dias y
                            {{ $tour->ndia - 1 }}
                            noches </h1>
                    @endif
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
                    <p>Lo sentimos, está ingresando datos incorrectos o inexistentes. Por favor, verifique los campos .</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('tours.update', $tour) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                {{-- dificultad --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Dificultad del tour</label>
                    <select class="form-control" name="dificultad">
                        <option value="muy facil" @if (old('dificultad', $tour->dificultad) == 'muy facil') selected @endif>muy facil</option>
                        <option value="facil" @if (old('dificultad', $tour->dificultad) == 'facil') selected @endif>facil</option>
                        <option value="normal" @if (old('dificultad', $tour->dificultad) == 'normal') selected @endif>normal</option>
                        <option value="dificil" @if (old('dificultad', $tour->dificultad) == 'dificil') selected @endif>dificil </option>
                        <option value="muy dificil" @if (old('dificultad', $tour->dificultad) == 'muy dificil') selected @endif>muy dificil</option>
                    </select>
                    @error('dificultad')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">

                    {{-- hinicio --}}
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput">Hora de inicio</label>
                        <input type="time" class="form-control" name="hinicio"
                            value="{{ old('hinicio', $tour->hinicio) }}">
                        @error('hinicio')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- hfin --}}
                    <div class="col-md-6 mb-3">
                        <label for="formGroupExampleInput">Hora de finilizacion </label>
                        <input type="time" class="form-control" name="hfin" value="{{ old('hfin', $tour->hfin) }}">
                        @error('hfin')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del tour</label>
                    <input type="number" class="form-control" name="precio" step="0.1"
                        value="{{ old('precio', $tour->precio) }}" placeholder="Ingrese el precio">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- precioprivado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio privado del tour</label>
                    <input type="number" class="form-control" name="precio privado" step="0.1"
                        value="{{ old('precioprivado', $tour->precioprivado) }}" placeholder="Ingrese el precio privado">
                    @error('precioprivado')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- recomendaciones --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Recomendaciones del tour</label>
                    <input type="text" class="form-control" name="recomendaciones"
                        value="{{ old('recomendaciones', $tour->recomendaciones) }}"
                        placeholder="ingrese la recomendaciones">
                    @error('recomendaciones')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- llevar --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Objetos a llevar</label>
                    <input type="text" class="form-control" name="llevar" value="{{ old('llevar', $tour->llevar) }}"
                        placeholder="ingrese las cosas que el turista tiene que llevar">
                    @error('llevar')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>



                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar tour
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
