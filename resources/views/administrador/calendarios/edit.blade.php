@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>Lista del tours para el dia {{ $fmod }}</strong><br><br>

            <a class="btn btn-outline-primary float-left" href="{{ route('calendarios.alimento', $tour_id) }}">
                <i class="fas fa-utensils"></i>
                Alimentos
            </a>
            <a class="btn btn-outline-success float-left" href="{{ route('calendarios.pdf', $tour_id) }}">
                <i class="fas fa-users"></i>
                Lista de cliente
            </a>
            <a class="btn btn-success float-right" href="{{ route('calendarios.voucher',$tour_id) }}">
                <i class="fas fa-plus"></i>
                Generar voucher
            </a>

        </div>
    </div>
@stop

@section('content')
    <h1
        style=" font-family: 'Times New Roman', Times, serif; text-transform: uppercase; font-weight: bold; text-align: center;">

        {{ $destino }}
    </h1>
    @if ($recibos->isNotEmpty())
        <h3 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('recibo') }}</h3>
        <div class="card" style="font-family: 'Times New Roman', Times, serif;">
            <div class="card-body frec">
                <table class="table" id="recibo">{{-- el id producto del DATATABLE --}}
                    <thead class="reccab">
                        <tr>

                            <th scope="col">Nombre</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">Alimento</th>
                            <th scope="col">Monto</th>

                            <th scope="col">Saldo</th>
                            <th scope="col">A cuenta</th>
                            <th scope="col">Registrador por</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($recibos as $recibo)
                            <tr class="{{ $recibo->tipo == 'privado' ? 'golden-row' : '' }}">



                                <td>{{ ucfirst($recibo->clientes->nombre) }} {{ ucfirst($recibo->clientes->apellido) }}
                                </td>

                                <td>
                                    <a href="https://wa.me/{{ $recibo->clientes->whatsapp }}" target="_blank">
                                        {{ '+' . str_replace(' ', '', $recibo->clientes->whatsapp) }}
                                    </a>
                                </td>

                                <td>{{ ucfirst($recibo->clientes->nacionalidad) }}</td>
                                <td>{{ ucfirst($recibo->clientes->alimento->nombre) }}</td>


                                @if ($recibo->moneda == 'Bolivianos')
                                    <td>{{ $recibo->monto }}0 bs</td>

                                    <td>{{ $recibo->saldo }}0 bs</td>
                                    <td>{{ $recibo->cuenta }}.00 bs</td>
                                @else
                                    <td>{{ $recibo->monto }}0 $</td>
                                    <td>{{ $recibo->saldo }}0 $</td>
                                    <td>{{ $recibo->cuenta }}.00 $</td>
                                @endif

                                <td>{{ ucfirst($recibo->empleados->nombre) }}
                                    {{ ucfirst($recibo->empleados->apellidopaterno) }}</td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ route('recibos.show', $recibo) }}">
                                        <i class="fas fa-eye"></i>Ver
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- reservas --}}
    @if ($reservas->isNotEmpty())
        <h3 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('reserva') }}</h3>
        <div class="card" style="font-family: 'Times New Roman', Times, serif;">
            <div class="card-body fres">
                <table class="table" id="reserva">{{-- el id producto del DATATABLE --}}
                    <thead class="rescab">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Nacionalidad</th>
                            <th scope="col">Alimento</th>
                            <th scope="col">Registrador por</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $reserva)
                            <tr  class="{{ $reserva->tipo == 'privado' ? 'golden-row' : '' }}">
                                <td>{{ ucfirst($reserva->clientes->nombre) }} {{ ucfirst($reserva->clientes->apellido) }}
                                </td>

                                <td>
                                    <a href="https://wa.me/{{ $reserva->clientes->whatsapp }}" target="_blank">
                                        {{ '+' . str_replace(' ', '', $reserva->clientes->whatsapp) }}
                                    </a>
                                </td>

                                <td>{{ ucfirst($reserva->clientes->nacionalidad) }}</td>
                                <td>{{ ucfirst($reserva->clientes->alimento->nombre) }}</td>

                                <td>{{ ucfirst($reserva->empleados->nombre) }}
                                    {{ ucfirst($reserva->empleados->apellidopaterno) }}</td>

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
                                    <a class="btn btn-primary"
                                        href="{{ route('reservas.edit', ['reserva' => $reserva, 'cal' => 1]) }}">
                                        <i class="fas fa-edit"></i>Editar
                                    </a>
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">
    <style>
        .frec {
            background-color: #58a5dc6c;
        }

        .reccab {
            background-color: #1e488f;
            /* Puedes ajustar el color a tu preferencia */
            color: white;
            /* Color del texto en el encabezado */
        }

        .fres {
            background-color: #02f22671;
        }

        .rescab {
            background-color: #1b8233;
            /* Puedes ajustar el color a tu preferencia */
            color: white;
            /* Color del texto en el encabezado */
        }

        .golden-row {
            background-image: url('{{ asset('img/dorado.jpg') }}');
            /* Ruta relativa a la carpeta public */
            background-size: cover;
            /* Ajusta la imagen al tamaño de la fila */
            background-repeat: no-repeat;
            /* Evita que la imagen se repita */
            /* Otros estilos, como colores de texto, márgenes, etc. */
        }
    </style>

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
        $('#recibo').DataTable({
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
