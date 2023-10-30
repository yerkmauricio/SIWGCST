@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <strong>Lista de los usuarios</strong>
            @can('usuarios.create')
                <a class="btn btn-success float-right" href="{{ route('usuarios.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar usuario
                </a>
            @endcan

        </div>
    </div>
@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('usuarios') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="usuario">{{-- el id destino lla al DATATABLE --}}
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Whatsapp</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <th scope="row">{{ $usuario->id }}</th>
                            <td>{{ ucfirst($usuario->empleado->nombre) }}</td>
                            <td>{{ ucfirst($usuario->empleado->apellidopaterno) }}</td>
                            <td>{{ ucfirst($usuario->usuario) }}</td>
                            <td>
                                <a href="https://wa.me/{{ $usuario->empleado->whatsapp }}" target="_blank">
                                    {{ '+' . str_replace(' ', '', $usuario->empleado->whatsapp) }}
                                </a>
                            </td>

                            <td>{{ ucfirst($usuario->empleado->cargos->nombre) }}</td>

                            <td><img width="70" height="70" src="{{ Storage::url($usuario->empleado->foto) }}"
                                    alt="">
                            </td>{{-- esto se hace en imagen --}}

                            <td>

                                {{-- para eliminar es con formulario --}}
                                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    @can('usuarios.show')
                                        <a class="btn btn-secondary" href="{{ route('usuarios.show', $usuario) }}">
                                            <i class="fas fa-eye"></i>Ver
                                        </a>
                                    @endcan

                                    @can('usuarios.edit')
                                        <a class="btn btn-primary" href="{{ route('usuarios.edit', $usuario) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    @endcan

                                    @can('usuarios.destroy')
                                        <button class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>Eliminar
                                        </button>
                                    @endcan

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

    {{-- DATATABLEy sus ralaciones 2 --}}
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
        $('#usuario').DataTable({
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
