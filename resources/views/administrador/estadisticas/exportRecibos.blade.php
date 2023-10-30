<table class="table">{{-- el id producto del DATATABLE --}}
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
           
            <th scope="col">Nacionalidad</th>
            <th scope="col">Tour</th>
            <th scope="col">Monto</th>
            <th scope="col">Numero de dias</th>
            <th scope="col">Fecha de inicio</th>
            <th scope="col">Fecha de finalización</th>
            <th scope="col">Estado</th>
         
        </tr>
    </thead>
    <tbody>
        @foreach ($recibos as $recibo)
            <tr>
                <th scope="row">{{ $recibo->id }}</th>

                <td>{{ ucfirst($recibo->clientes->nombre) }} {{ ucfirst($recibo->clientes->apellido) }}</td>

                

                <td>{{ ucfirst($recibo->clientes->nacionalidad) }}</td>
                <td>{{ ucfirst($recibo->tours->destino->nombre) }}</td>

                <td>{{ $recibo->monto }}0 {{ $recibo->moneda }}</td>

                @if ($recibo->tours->ndia == 1)
                    <td>{{ ucfirst($recibo->tours->ndia) }} dia</td>
                @else
                    <td>{{ ucfirst($recibo->tours->ndia) }} dias</td>
                @endif



                <td>{{ \Carbon\Carbon::parse($recibo->finicio)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}
                </td>
                <td>{{ \Carbon\Carbon::parse($recibo->ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY') }}
                </td>
                @if ($recibo->estado == 1)
                    <td style="color: rgb(3, 157, 3)">Confirmado</td>
                @else
                    <td style="color: rgb(192, 3, 3)">Anulado</td>
                @endif




            </tr>
        @endforeach

    </tbody>
</table>
