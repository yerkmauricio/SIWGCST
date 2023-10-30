<table class="table" id="cliente">{{-- el id producto del DATATABLE --}}
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Genero</th>
             
            <th scope="col">Nacionalidad</th>
            <th scope="col">Alimento</th>
            <th scope="col">hotel</th>
            
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

                
                <td>{{ ucfirst($cliente->nacionalidad) }}</td>
                <td>{{ ucfirst($cliente->alimento->nombre) }}</td>
                <td>{{ ucfirst($cliente->hotel) }}</td>
               
            </tr>
        @endforeach


    </tbody>
</table>