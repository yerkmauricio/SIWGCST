@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


@stop

@section('content')
    <div class="container" style="font-family: 'Times New Roman', Times, serif;">

        <div class="btn btn-primary btn-lg btn-block">

            <div class="container text-center">
                <h1> <i class="fas fa-calendar-check"> Calendario</i></h1>
            </div>
        </div>
        <div>
            <div id='calendar'>

            </div>
        </div>
    </div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css">
    <link rel="stylesheet" href="/ruta/a/tu/estilo/fullcalendar_custom.css">


    <style>
        /* Estilo para el contenedor del calendario */
        .calendar-container {
            position: relative;
            /* Permite que la marca de agua sea relativa a este contenedor */
        }



        #calendar .fc-day {
            border: 2px solid #ffffff;
            border-radius: 25px
                /* Define el estilo del borde */
        }

        /* Personalizar el encabezado de día en FullCalendar */
        #calendar .fc-day-header {
            background-color: rgba(6, 51, 147, 0.789);
            color: white;
            /* Cambia YourColor al color deseado */
            font-size: 18px;

            /* Cambia el tamaño de fuente según tus preferencias */
            /* Otras personalizaciones de estilo aquí */
        }


        /* Personalizar otros elementos de FullCalendar */
        #calendar .fc-event {
            /* Tu personalización de eventos aquí */
        }

        /* Personalizar las celdas del calendario */
        #calendar .fc-day {
            /* Tu personalización de celdas aquí */
        }

        #calendar .fc-day-number {

            /* Cambia 'green' al color deseado */
            color: rgb(0, 0, 0);
            /* Cambia 'white' al color deseado para el texto */

            /* Esto redondeará los números si lo deseas */
            padding: 10px;
            /* Ajusta el espaciado interior según sea necesario */
            font-size: 25px;
        }

        /* Cambiar el color de fondo del día actual a rojo */
        #calendar .fc-day.fc-today {
            background-color: rgb(0, 255, 8) !important;
            border: 10px solid transparent;
            
        }

        /* Cambiar el fondo de los días seleccionados a un color diferente (por ejemplo, azul) */
        #calendar .fc-day.fc-widget-content.fc-past,
        #calendar .fc-day.fc-widget-content.fc-today,
        #calendar .fc-day.fc-widget-content.fc-future {
            background-color: rgba(0, 255, 0, 0.455);
            /* Cambia 'blue' al color deseado */
        }

       
    </style>
@stop

@section('js')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>


    <script>
    
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";

            var calendar = $('#calendar').fullCalendar({
                
                locale: 'es',
                
                events: SITEURL + "/fullcalendar",
                displayEventTime: false,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var selectedDate = start.format('YYYY-MM-DD');
                    window.location.href = SITEURL + '/calendarios/' + selectedDate;
                },
                eventRender: function(event, element, view) {
                    if (event.title === 'hay actividad') {
                        element.css('background-color',
                        'red'); // Personaliza el color de fondo para indicar actividad
                    }
                },
                events: [
                    @foreach ($fechasActividad as $fecha)
                        {
                            title: 'HAY ACTIVIDAD',
                            start: '{{ $fecha }}'
                        },
                    @endforeach
                ]
            });
        });
    </script>



    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> --}}

@stop
