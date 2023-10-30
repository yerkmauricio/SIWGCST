@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('modificar la reserva:') }}
                {{ ucfirst($reserva->clientes->nombre) }} {{ ucfirst($reserva->clientes->apellido) }} </h1>
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
            <form method="POST" action="{{ route('reservas.update', $reserva) }}" enctype="multipart/form-data">
                @csrf {{-- evita sql inyection --}}
                @method('PUT')

                 <input type="hidden" name="cal" value="{{ $cal}}">{{-- reserva calendario --}}

                {{-- finicio --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Fecha de inicio del tour</label>
                    <input type="date" class="form-control" name="finicio"
                        value="{{ old('finicio', $reserva->finicio) }}">
                    @error('finicio')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- estado --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Estado</label>
                    <select class="form-control" name="estado">
                        <option value="confirmado" @if (old('estado', $reserva->estado) == 'confirmado') selected @endif>Confirmado</option>
                        <option value="cancelado" @if (old('estado', $reserva->estado) == 'cancelado') selected @endif>Cancelado</option>
                    </select>
                    @error('estado')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- tipo --}}
                <div class="form-group">
                    <label for="formGroupExampleInput">Tipo de tour</label>
                    <select class="form-control" name="tipo" >
                        <option value="compartido"  @if(old('tipo',$reserva->tipo) == 'compartido') selected @endif>Compartido</option>
                        <option value="privado"  @if(old('tipo',$reserva->tipo) == 'privado') selected @endif>Privado</option>
                    </select>
                    @error('tipo')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>


                {{-- tour  --}}
                <div class="form-group">
                    <label for="tour">Tour:</label>
                    <select name="tour_id" class="form-control">
                        <option value="" selected disabled>Seleccione el tour</option>
                        @foreach ($tours as $tour)
                            @php
                                $selectedValue = old('tour_id') === $tour->id . '|' . $tour->ndia ? 'selected' : '';
                            @endphp

                            <option value="{{ $tour->id }}|{{ $tour->ndia }}"{{ $selectedValue }}
                                {{ old('tour_id', $reserva->tour_id) == $tour->id ? 'selected' : '' }}>
                                @if ($tour->ndia == 1)
                                    {{ ucfirst($tour->destino->nombre) }} de un {{ $tour->ndia }} día
                                @else
                                    {{ ucfirst($tour->destino->nombre) }} de {{ $tour->ndia }} días
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('tour_id')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary float-center">
                        <i class="fas fa-edit"></i>
                        Actualizar reserva
                    </button>
                </div>
            </form>

        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
