@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card" style="font-family: 'Times New Roman', Times, serif;">
    <div class="card-body">
        <h1>{{ ucfirst('modificar al transporte:') }}&nbsp;{{ ucfirst($transporte->nombre) }}</h1>
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
            <form method="POST" action="{{ route ('transportes.update', $transporte )}}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                <div class="d-flex justify-content-center align-items-center" style="height: auto">
                    <img src="{{ Storage::url($transporte->foto) }}" class="img-fluid custom-img"
                        alt="">
                </div>
                {{--esto es de la foto --}}
                
                {{-- nombre --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Nombre del transporte</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $transporte->nombre) }}">
                    @error('nombre')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo del destino</label>
                    <select class="form-control" name="tipo" >
                        <option value="minibus"  @if(old('tipo',$transporte->tipo) == 'minibus') selected @endif>Minibus</option>
                        <option value="vagoneta"  @if(old('tipo',$transporte->tipo) == 'vagoneta') selected @endif>Vagoneta</option>
                        <option value="vans"  @if(old('tipo',$transporte->tipo) == 'vans') selected @endif>Vans</option>
                        <option value="flota"  @if(old('tipo',$transporte->tipo) == 'flota') selected @endif>Flota</option>
                        <option value="motocicleta"  @if(old('tipo',$transporte->tipo) == 'motocicleta') selected @endif>Motocicleta</option>
                        <option value="camioneta"  @if(old('tipo',$transporte->tipo) == 'camioneta') selected @endif>Camioneta</option>
                        <option value="jeep"  @if(old('tipo',$transporte->tipo) == 'jeep') selected @endif>Jeep</option>
                        <option value="automovil"  @if(old('tipo',$transporte->tipo) == 'automovil') selected @endif>Automovil</option>
                        <option value="camion"  @if(old('tipo',$transporte->tipo) == 'camion') selected @endif>Camion</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- empresa --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Empresa del transporte</label>
                    <input type="text" class="form-control" name="empresa" value="{{ old('empresa', $transporte->empresa) }}">
                    @error('empresa')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- npasajero --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Número de pasajero del transporte</label>
                    <input type="number" class="form-control" name="npasajero" value="{{ old('npasajero', $transporte->npasajero) }}">
                    @error('npasajero')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- precio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Precio del transporte</label>
                    <input type="number" class="form-control" name="precio" value="{{ old('precio', $transporte->precio) }}">
                    @error('precio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                {{-- whatsapp --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Whatsapp del transporte</label>
                    <div class="input-group">
                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $transporte->whatsapp) }}">
                        <input type="hidden" id="codigoPais" name="codigoPais">
                    </div>
                    @error('whatsapp')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Foto del transporte</label>
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
                        Actualizar transporte
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