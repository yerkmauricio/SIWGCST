@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class='card' style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body " style="text-align: center;">
            <strong>
                <h1>ESTADISTICA</h1>
            </strong>
        </div>
    </div>
@stop

@section('content')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>CLIENTES</h1>
            <a class="btn btn-success float-right" href="{{ route('estadisticas.create', ['clave' => 1]) }}">
                <i class="fas fa-user-circle"></i>
                Reporte cliente
            </a>
            <br><br><br><br>

            <div class="form-row">
                @php
                    $canCli = $clientes->count();
                    // Agrupar los clientes por nacionalidad y contar cuántos hay de cada nacionalidad
                    $nacionalidades = $clientes->groupBy('nacionalidad')->map->count();

                    // Obtener la nacionalidad más común
                    $nacionalidadMasComun = $nacionalidades
                        ->sortDesc()
                        ->keys()
                        ->first();

                    // Agrupar los clientes por alimento_id y contar cuántos hay de cada alimento_id
                    $alimentos = $clientes->groupBy('alimento_id')->map->count();

                @endphp

                <div class="carda col-md-3 " style="background-color: #003785;">
                    <h2>Hay un total de {{ $canCli }} clientes </h2>
                </div>

                <div class="carda col-md-3" style="background-color: #1465bb;">
                    <h2>Hay mas clientes de nacionalidad {{ $nacionalidadMasComun }}</h2>

                </div>
                <div class="carda col-md-3" style="background-color: #2196f3;">
                    <h2>Alimentos {{ $alimentoMasComun }}</h2>

                </div>
            </div>
            <div class="form-row  ">
                <div class="row col-4 gra">
                    <canvas id="myLineChart" width="750" height="650"></canvas>
                </div>
                <div class="row col-4 gra">
                    <canvas id="myLineChartClientes" width="750" height="650"></canvas>

                </div>
            </div>
        </div>
    </div>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>TOUR</h1>
            <a class="btn btn-success float-right" href="{{ route('estadisticas.create', ['clave' => 2]) }}">
                <i class="fas fa-map-marker-alt "></i>
                Reporte tours
            </a>
            <br><br><br><br>

            <div class="form-row">

                <div class="carda col-md-3 " style="background-color: #853400;">
                    <h2>Hay un total de {{ $cantot }} tours</h2>
                </div>

                <div class="carda col-md-3" style="background-color: #c06500">
                    <h2>El tour mas vendido es {{ $cantou }}</h2>

                </div>
                <div class="carda col-md-3" style="background-color: #ff9800">
                    <h2>La hora de comienzo mas comun es {{ $horcom }}</h2>

                </div>
            </div>
            <div class="form-row  ">
                <div class="row col-4 gra">
                    <canvas id="tourChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <h1>RECIBOS Y RESERVAS</h1>
            <a class="btn btn-success float-right" href="{{ route('estadisticas.create', ['clave' => 3]) }}">
                <i class="fas fa-wallet"></i>
                Reporte recibos
            </a>
            <br><br><br><br>

            <div class="form-row">
                @php
                    $canrec = $recibos->count();
                    $canres = $reservas->count();
                    $metcom = $recibos->groupBy('metodo')->map->count();
                    $metodo = $metcom
                        ->sortDesc()
                        ->keys()
                        ->first();
                @endphp

                <div class="carda col-md-3 " style="background-color: #003400;">
                    <h2>Hay un total de {{ $canrec }} recibos </h2>
                </div>

                <div class="carda col-md-3" style="background-color: #006414;">
                    <h2>Hay un total de {{ $canres }} reservas</h2>

                </div>
                <div class="carda col-md-3" style="background-color: #009929;">
                    <h2>Se paga mas por {{ $metodo }}</h2>

                </div>
            </div>
            <div class="form-row  ">
                <div class="row col-4 gra">
                    <canvas id="myLineChartMontos"></canvas>

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <style>
        .carda {
            width: 254px;
            height: 254px;
            /* background: #089370; */
            position: relative;
            display: flex;
            place-content: center;
            place-items: center;
            overflow: hidden;
            border-radius: 20px;
            margin-left: 50px;
            margin-top: 10px;


        }

        .carda h2 {
            font-family: Edwardian Script ITC;
            z-index: 1;
            color: white;
            font-size: 2em;



        }



        .carda::after {
            content: '';
            position: absolute;
            /* background: #089370; */

            inset: 5px;
            border-radius: 15px;
        }

        .gra {
            display: flex;
            margin-left: 100px;
            margin-top: 50px;

        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        var ctxClientes = document.getElementById('myLineChartClientes').getContext('2d');

        var dataClientes = {
            labels: {!! json_encode($fechasClientesRegistrados) !!},
            datasets: [{
                label: 'Clientes Registrados',
                data: {!! json_encode($clientesRegistrados) !!},
                borderColor: 'green',
                backgroundColor: 'rgba(0, 255, 0, 0.2)',
            }],
        };

        var configClientes = {
            type: 'line',
            data: dataClientes,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        };

        var myLineChartClientes = new Chart(ctxClientes, configClientes);
    </script>

    {{-- genero --}}

    <script>
        var ctx = document.getElementById('myLineChart').getContext('2d');

        var data = {
            labels: {!! json_encode($fechas) !!}, // Utiliza las fechas calculadas
            datasets: [{
                    label: 'Masculino',
                    data: {!! json_encode($masculinos) !!}, // Datos de clientes masculinos
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                },
                {
                    label: 'Femenino',
                    data: {!! json_encode($femeninos) !!}, // Datos de clientes femeninos
                    borderColor: 'red',
                    backgroundColor: 'rgba(255, 192, 203, 0.2)',
                },
            ],
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        };

        var myLineChart = new Chart(ctx, config);
    </script>
    {{-- recibos --}}

    <script>
        var ctxMontos = document.getElementById('myLineChartMontos').getContext('2d');
    
        var dataMontos = {
            labels: {!! json_encode($fechasMontos) !!},
            datasets: [{
                label: 'Monto Total de Recibos',
                data: {!! json_encode($montos) !!},
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.2)',
            }],
        };
    
        var configMontos = {
            type: 'line',
            data: dataMontos,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        };
    
        var myLineChartMontos = new Chart(ctxMontos, configMontos);
    </script>

    {{-- tour --}}
    <script>
        var ctx = document.getElementById('tourChart').getContext('2d');
        var tourData = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Cantidad de Tours',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: tourData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop