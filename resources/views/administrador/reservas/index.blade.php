@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>Lista de las reservas</strong>
            <a class="btn btn-success float-right" href="{{ route('reservas.create') }}">
                <i class="fas fa-plus"></i>
                Agregar reserva
            </a>
        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('reserva') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="reserva">{{-- el id producto del DATATABLE --}}
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Whatsapp</th>
                        <th scope="col">Tour</th>
                        <th scope="col">Numero de dias</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Fecha de inicio</th>
                        <th scope="col">Fecha de finalización</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        <tr>
                            <th scope="row">{{ $reserva->id }}</th>

                            <td>{{ ucfirst($reserva->clientes->nombre) }} {{ ucfirst($reserva->clientes->apellido) }}</td>

                            <td>
                                <a href="https://wa.me/{{ $reserva->clientes->whatsapp }}" target="_blank">
                                    {{ '+' . str_replace(' ', '', $reserva->clientes->whatsapp) }}
                                </a>
                            </td>

                            <td>{{ ucfirst($reserva->tours->destino->nombre) }}</td>

                            @if ($reserva->tours->ndia == 1)
                                <td>{{ ucfirst($reserva->tours->ndia) }} dia</td>
                            @else
                                <td>{{ ucfirst($reserva->tours->ndia) }} dias</td>
                            @endif

                            <td>{{ ucfirst($reserva->tipo) }}</td>

                            <td>{{ \Carbon\Carbon::parse($reserva->finicio)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($reserva->ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}
                            </td>

                            @if ($reserva->estado == 'cancelado')
                                <td style="color: rgb(192, 3, 3)">{{ ucfirst($reserva->estado) }} </td>
                            @else
                                @if ($reserva->estado == 'confirmado')
                                    <td style="color: rgb(36, 144, 36)">{{ ucfirst($reserva->estado) }} </td>
                                @else
                                    <td>{{ ucfirst($reserva->estado) }} </td>
                                @endif
                            @endif



                            <td>
                                {{-- para eliminar es con formulario --}}
                                <form action="{{ route('reservas.destroy', $reserva) }}" method="POST"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-primary"
                                        href="{{ route('reservas.edit', ['reserva' => $reserva, 'cal' => 0]) }}">
                                        <i class="fas fa-edit"></i>Editar
                                    </a>

                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>Eliminar
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- linea de importaciode para usar sweet alert --}}
    {{-- mensaje de advertencia para guardar --}}
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire(
                'Creado!',
                'El dato ha sido Creado.',
                'success'
            )
        </script>
    @endif
    {{-- mensaje de advertencia para eliminar --}}
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El dato ha sido eliminado.',
                'success'
            )
        </script>
    @endif

    {{-- mensaje de advertencia para editar --}}
    @if (session('editar') == 'ok')
        <script>
            Swal.fire(
                'Actualizado!',
                'El dato ha sido actulizado.',
                'success'
            )
        </script>
    @endif

    <script>
        //llega lo del formulacio de ariba
        $('.form-eliminar').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Esta seguro?',
                text: "¡El dato se eliminará!",
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        });
    </script>

    {{-- DATATABLE y sus ralaciones 1 --}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4min.js"></script>
    {{-- esto cambia el idioma de ingles a español --}}
    <script>
        $('#reserva').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Lo sentimos, pero no hay datos para mostrar",
                "info": "Mostrando página_PAGE_de_PAGES_",
                "infoEmpty": "Lo sentimos, pero no hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
@stop
