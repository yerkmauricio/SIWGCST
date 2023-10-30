 
<table class="table">{{-- el id tour al DATATABLE --}}
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Destino</th>
            <th scope="col">Hospedaje</th>
            <th scope="col">Transporte</th>
            <th scope="col">Dias</th>
            <th scope="col">Dificultad</th>
            <th scope="col">Precio</th>
             

        </tr>
    </thead>
    <tbody>
        @foreach ($tours as $tour)
            <tr>
                <th scope="row">{{ $tour->id }}</th>
                <td>{{ ucfirst($tour->destino->nombre) }}</td>
                <td>
                    @if ($tour->hospedaje)
                        {{ ucfirst($tour->hospedaje->nombre) }}
                    @else
                        No necesario
                    @endif
                </td> 

                <td>
                    @if ($tour->transporte)
                        {{ ucfirst($tour->transporte->nombre) }}
                    @else
                        No necesario
                    @endif
                </td>

                @if ($tour->ndia == 1)
                    <td>{{ ucfirst($tour->ndia) }} dia</td>
                @else
                    <td>{{ ucfirst($tour->ndia) }} dias</td>
                @endif

                <td>{{ ucfirst($tour->dificultad) }}</td>
                <td>{{ $tour->precio }}0 Bs por persona.</td>
         

            </tr>
        @endforeach

    </tbody>
</table>
