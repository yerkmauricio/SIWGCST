@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="card">
        <div class="card-body" style="font-family: 'Times New Roman', Times, serif;">
            <strong>Lista de los clientes</strong>
            @can('clientes.create')
                <a class="btn btn-success float-right" href="{{ route('clientes.create') }}">
                    <i class="fas fa-plus"></i>
                    Agregar cliente
                </a>
            @endcan

        </div>
    </div>

@stop

@section('content')
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('cliente') }}</h1>
    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">
            <table class="table" id="cliente">{{-- el id producto del DATATABLE --}}
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Whatsapp</th>
                        <th scope="col">Nacionalidad</th>
                        <th scope="col">Alimento</th>
                        <th scope="col">hotel</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <th scope="row">{{ $cliente->id }}</th>
                            <td>{{ ucfirst($cliente->nombre) }}</td>
                            <td>{{ ucfirst($cliente->apellido) }}</td>
                            @if ($cliente->genero == 1)
                                <td>Masculino</td>
                            @else
                                <td>Femenino</td>
                            @endif

                            <td>
                                <a href="https://wa.me/{{ $cliente->whatsapp }}" target="_blank">
                                    {{ '+' . str_replace(' ', '', $cliente->whatsapp) }}
                                </a>
                            </td>
                            <td>{{ ucfirst($cliente->nacionalidad) }}</td>
                            <td>{{ ucfirst($cliente->alimento->nombre) }}</td>
                            <td>{{ ucfirst($cliente->hotel) }}</td>

                            <td>
                                {{-- para eliminar es con formulario --}}
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                    class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    @can('clientes.show')
                                        <a class="btn btn-secondary" href="{{ route('clientes.show', $cliente) }}">
                                            <i class="fas fa-eye"></i>Ver
                                        </a>
                                    @endcan

                                    @can('clientes.edit')
                                        <a class="btn btn-primary" href="{{ route('clientes.edit', $cliente) }}">
                                            <i class="fas fa-edit"></i>Editar
                                        </a>
                                    @endcan

                                    @can('clientes.destroy')
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
        $('#cliente').DataTable({
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
