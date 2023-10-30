<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css') {{-- Incluir sección CSS --}}

    <style>
        .texto {
            /* font-size: 24px; */
            /* Tamaño de fuente más grande */
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            /* Texto en negrita */
            text-transform: uppercase;
            /* Texto en mayúsculas */
            color: rgb(255, 255, 255);
            /* Color del texto verde */
            text-shadow: 15px 15px 15px rgb(0, 0, 67);
            /* Sombra de texto azul */
            text-align: center;
            /* Texto centrado */


        }

        .a {
            /* font-size: 24px; */
            /* Tamaño de fuente más grande */
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            /* Texto en negrita */
            text-transform: uppercase;
            /* Texto en mayúsculas */
            color: rgb(172, 149, 4);
            /* Color del texto verde */
            text-shadow: 25px 25px 25px rgb(1, 1, 53);
            /* Sombra de texto azul */
            /* text-align: left; */
            /* Texto centrado */
            padding-left: 50px;
        }

        body {
            background-image: url('{{ asset('img/login.jpg') }}');
            /* Establece la imagen de fondo */
            background-size: cover;
            /* Ajusta la imagen para cubrir todo el fondo */
            background-position: center;
            /* Centra la imagen en el fondo */
        }

        .full-screen-image {
            width: 100%;
            /* El ancho de la imagen será el 100% del ancho de la ventana */
            height: 100vh;
            /* La altura de la imagen será el 100% de la altura de la ventana */
            object-fit: cover;
            /* La imagen se ajustará para cubrir el contenedor sin distorsionarla */
        }

        .custom-img {

            width: 470px;
            height: auto;
            /* padding-left: 50px; */
            border: 10px solid transparent;
            /* Agrega un borde transparente */
            border-width: 10px;
            border-style: solid;
            border-image: linear-gradient(to right, rgb(255, 225, 32), rgb(143, 138, 3)) 1;
            box-shadow: 10px 10px 10px rgba(255, 255, 255, 0.759);

        }

        .dashboard-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .icon-link {
            font-size: 30px;
            display: flex;
            align-items: center;
            margin: 10px;
            text-decoration: none;

            color: goldenrod;
            /* Hace que el texto sea transparente */
            background-image: url('{{ asset('img/dorado.jpg') }}');
            /* Establece la imagen de fondo */
            background-size: cover;
            /* Ajusta la imagen para cubrir el fondo */
            background-clip: text;
            /* Hace que la imagen de fondo solo se muestre en el área del texto */
            -webkit-background-clip: text;
            /* Para navegadores basados en WebKit */
            color: transparent;
            /* Restablece el texto a transparente para ocultarlo */
            background-position: left top;
            box-shadow: 10px 10px 10px rgba(255, 255, 255, 0.5);

        }

        .icon-link i {
            margin-right: 10px;
            font-size: 40px;

        }
    </style>

</head>

<body>


    <br><br><br><br>
    <div class="container">
        <h1 class="texto"> sistema de información web para la gestión y control de
            servicios turísticos</h1>
    </div>
    <br><br><br><br><br>


    <div class="row" style="font-family: 'Times New Roman', Times, serif;">
        <br><br>
        <div class="col-md-4">
            <div style="margin-left: 100px;">
                <img src="{{ Storage::url($usuario->empleado->foto) }}" alt="" class="custom-img mx-auto">
            </div>

            <br><br>
            <div>
                @if ($usuario->empleado->genero == 1)
                    <h3 class="a">Bienvenido señor {{ $usuario->name }}</h3>
                @else
                    <h3 class="a">Bienvenido señorita {{ $usuario->name }}</h3>
                @endif

            </div>

        </div>


        <div class="col-md-6">
            <div class="form-row" style="margin-left: 125px;">

                <div class="col-md-6 mb-3">
                    @can('usuarios.index')
                        <a href="{{ route('usuarios.index') }}" class="icon-link">
                            <i class="fas fa-user fa-2x"></i> Usuarios
                        </a>
                        <br>
                    @endcan

                    @can('calendarios.index')
                        <a href="{{ route('calendarios.index') }}" class="icon-link">
                            <i class="fas fa-calendar-check fa-2x"></i> Calendario
                        </a>
                        <br>
                    @endcan

                    @can('reservas.index')
                        <a href="{{ route('reservas.index') }}" class="icon-link">
                            <i class="fas fa-book fa-2x"></i> Reserva
                        </a>
                        <br>
                    @endcan

                    @can('recibos.index')
                        <a href="{{ route('recibos.index') }}" class="icon-link">
                            <i class="fas fa-wallet fa-2x"></i> Recibo
                        </a>
                        <br>
                    @endcan

                    @can('alimentos.index')
                        <a href="{{ route('alimentos.index') }}" class="icon-link">
                            <i class="fas fa-utensils fa-2x"></i> Alimentacion
                        </a>
                        <br>
                    @endcan

                    @can('productos.index')
                        <a href="{{ route('productos.index') }}" class="icon-link">
                            <i class="fas fa-hotdog fa-2x"></i> Producto
                        </a>
                        <br>
                    @endcan

                    @can('lisalis.index')
                        <a href="{{ route('lisalis.index') }}" class="icon-link">
                            <i class="fas fa-list-ul fa-2x"></i> Lista de alimentos
                        </a>
                        <br>
                    @endcan

                    @can('transportes.index')
                        <a href="{{ route('transportes.index') }}" class="icon-link">
                            <i class="fas fa-bus fa-2x"></i> Transporte
                        </a>
                        <br>
                    @endcan

                    @can('destinos.index')
                        <a href="{{ route('destinos.index') }}" class="icon-link">
                            <i class="fas fa-map-signs fa-2x"></i> Destino
                        </a>
                        <br>
                    @endcan

                    @can('hospedajes.index')
                        <a href="{{ route('hospedajes.index') }}" class="icon-link">
                            <i class="fas fa-hotel fa-2x"></i> Hospedaje
                        </a>
                        <br>
                    @endcan

                </div>
                <div class="col-md-6 mb-4">

                    @can('obs_includes.index')
                        <a href="{{ route('obs_includes.index') }}" class="icon-link">
                            <i class="fas fa-plus-square fa-2x"></i> Incluye
                        </a>
                        <br>
                    @endcan

                    @can('obs_noincludes.index')
                        <a href="{{ route('obs_noincludes.index') }}" class= "icon-link">
                            <i class="fas fa-minus-square fa-2x"></i> No incluye
                        </a>
                        <br>
                    @endcan

                    @can('foto_tours.index')
                        <a href="{{ route('foto_tours.index') }}" class="icon-link">
                            <i class="fas fa-images fa-2x"></i> Fotos del tour
                        </a>
                        <br>
                    @endcan

                    @can('tours.index')
                        <a href="{{ route('tours.index') }}" class="icon-link">
                            <i class="fas fa-map-marker-alt fa-2x"></i> Tour
                        </a>
                        <br>
                    @endcan

                    @can('clientes.index')
                        <a href="{{ route('clientes.index') }}" class="icon-link">
                            <i class="fas fa-user-circle fa-2x"></i> Cliente
                        </a>
                        <br>
                    @endcan

                    @can('estadisticas.index')
                        <a href="{{ route('estadisticas.index') }}" class="icon-link">
                            <i class="fas fa-chart-bar fa-2x"></i> Estadistica
                        </a>
                        <br>
                    @endcan

                    @can('n_jerarquicos.index')
                        <a href="{{ route('n_jerarquicos.index') }}" class="icon-link">
                            <i class="fas fa-level-up-alt fa-2x"></i> Nivel jerarquico
                        </a>
                        <br>
                    @endcan

                    @can('areas.index')
                        <a href="{{ route('areas.index') }}" class="icon-link">
                            <i class="fas fa-square fa-2x"></i> Area
                        </a>
                        <br>
                    @endcan

                    @can('cargos.index')
                        <a href="{{ route('cargos.index') }}" class="icon-link">
                            <i class="far fa-address-card fa-2x"></i> Cargo
                        </a>
                        <br>
                    @endcan

                    @can('empleados.index')
                        <a href="{{ route('empleados.index') }}" class="icon-link">
                            <i class="fas fa-users fa-2x"></i> Empleado
                        </a>
                        <br>
                    @endcan

                    @can('descuentos.index')
                        <a href="{{ route('descuentos.index') }}" class="icon-link">
                            <i class="fas fa-tag fa-2x"></i> Descuento
                        </a>
                        <br>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>

</html>
