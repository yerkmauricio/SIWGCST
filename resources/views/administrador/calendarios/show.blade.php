@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card' style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>
                <h1> Tours para el dia {{ $fmod }}</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')

    @php
        $eventos = collect($recibos)->merge($reservas);
        $toursMostrados = collect();
    @endphp
    <h3
        style=" font-family: 'Times New Roman', Times, serif; text-transform: uppercase; font-weight: bold; text-align: center;">
        Lista de tour
    </h3>

    <div class='card' style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body frec">
            @if ($eventos->isEmpty())
                <h3>No hay actividad para este dia . ¡Felicidades, disfruta la mañana!</h3>
            @else
                <ul>

                    @foreach ($eventos as $evento)
                        @php
                            $nombreTour = $evento->tours->destino->nombre;
                            $ndiaTour  = $evento->tours->ndia;
                        @endphp
                        @if (!$toursMostrados->contains(function ($tour) use ($nombreTour, $ndiaTour) {
                            return $tour['nombre'] === $nombreTour && $tour['ndia'] === $ndiaTour;
                        }))
                            <li>

                                <a href="{{ route('calendarios.edit', $evento->tour_id) }}">
                                    <div class='card a' style="font-family: 'Times New Roman', Times, serif;">
                                        <div class="card-body b fres">
                                            <strong>
                                                @if ($evento->tours->ndia==1)
                                                    <p style=" font-size: 25px; color: #000000;">{{ $nombreTour }} {{$evento->tours->ndia}} dia</p>
                                                @else
                                                <p style=" font-size: 25px; color: #000000;">{{ $nombreTour }} {{$evento->tours->ndia}} dias</p>
                                                @endif
                                                
                                            </strong>
                                        </div>
                                    </div>
                                </a>

                            </li>
                            @php
                                 $toursMostrados->push(['nombre' => $nombreTour, 'ndia' => $ndiaTour]);
                            @endphp
                        @endif
                    @endforeach
                </ul>

            @endif
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .a {
            width: auto;
            height: 74px;
            background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
            border-radius: 20px;
            transition: all .3s;

        }

        .b {
            width: auto;
            height: 74px;
            background-color: #ffffff;
            border-radius: ;
            transition: all .2s;
        }

        .frec {
            background-color: #58a5dc6c;
        }

        .fres {
            background-color: #45c8596c;
        }

        .b:hover {
            transform: scale(0.98);
            border-radius: 20px;
        }

        .a:hover {
            box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
        }
    </style>


@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
