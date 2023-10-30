@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@section('content')
    <br>
    <h1 style="font-family: 'Times New Roman', Times, serif;">{{ ucfirst('lista de alimentos para el tour') }}</h1><br><br>

    <div class="card" style="font-family: 'Times New Roman', Times, serif;">
        <div class="card-body">

            {{-- bucar el nombre de la lista --}}
            <form action="{{ route('lisalis.index') }}" class="float-right " method="GET">
                <select name="search" class="input btn btn-outline-secondary">
                    <option value="">Seleccione un alimento</option>
                    @foreach ($alimentos as $id => $nombre)
                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-custom">Buscar</button>
            </form>

            <tbody>
                @if ($search == null)
                    @foreach ($muestras as $muestra)
                        <ul>
                            <li>Lista {{ $muestra->nombre }}</li>
                        </ul>
                    @endforeach
                @else
                    <h4 style="text-transform: uppercase; font-weight: bold; text-align: center;">lista de alimento
                        {{ $search }} </h4><br><br>
                    @php
                        $t = 0;
                    @endphp
                    <h5>{{ ucfirst($search) }}</h5><br>

                    @foreach ($lisalis as $lisali)
                        <tr>
                            @if ($lisali->producto)
                                <td>{{ ucfirst($lisali->producto->nombre) }}.................</td>
                                <td>{{ $lisali->producto->precio }}0 bs</td>
                                @php
                                    $t = $lisali->producto->precio + $t;
                                @endphp
                                <br>
                            @endif

                        </tr>
                    @endforeach

                    @if ($search)
                        <div class="card float-right" style="width: 18rem; ">
                            <div class="card-body ">
                                <h5 class="card-title">{{ ucfirst($search) }}</h5>
                                <p class="card-text"> {{ ucfirst($lisali->alimento->descripcion) }}</p>
                            </div>
                        </div>
                    @endif
                    <br>

                    @if (fmod($t, 1) != 0)
                        <td ucfirst>Total = {{ $t }}0 bs.</td>
                    @else
                        <td ucfirst>Total = {{ $t }} bs.</td>
                    @endif
                @endif

            </tbody>

        </div>
    </div>

    <a href="{{ route('lisalis.admin') }}">
        <i class="btn btn-primary float-right">
            Administrar productos </i>
    </a>
    @can('lisalis.create')
        <a class="btn btn-success float-right" href="{{ route('lisalis.create') }}">
            <i class="fas fa-plus"></i>
            Agregar alimentos
        </a>
    @endcan

@stop



@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    {{-- DATATABLEy sus ralaciones 2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/reponsive.bootstrap4.min.css">



    {{-- css del botton --}}
    <style>
        .btn-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
            cursor: pointer;
            width: 80px;
            height: 25px;
            background-image: linear-gradient(to top, #D8D9DB 0%, #fff 80%, #FDFDFD 100%);
            border-radius: 30px;
            border: 1px solid #8F9092;
            transition: all 0.2s ease;
            font-family: "Source Sans Pro", sans-serif;
            font-size: 15px;
            font-weight: 300;
            color: #606060;
            text-shadow: 0 1px #fff;
        }

        .btn-custom:hover {
            box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 3px 3px #CECFD1;
        }

        .btn-custom:active {
            box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 5px 3px #999, inset 0 0 30px #aaa;
        }

        .btn-custom:focus {
            box-shadow: 0 4px 3px 1px #FCFCFC, 0 6px 8px #D6D7D9, 0 -4px 4px #CECFD1, 0 -6px 4px #FEFEFE, inset 0 0 5px 3px #999, inset 0 0 30px #aaa;
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
        $('#lisali').DataTable({
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
