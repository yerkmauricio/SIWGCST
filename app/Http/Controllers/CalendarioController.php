<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Empleados;
use App\Models\Lisali;
use App\Models\Recibos;
use App\Models\Reserva;
use App\Models\Tours;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use TCPDF;

class CalendarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:calendarios.index')->only('index');
        $this->middleware('can:calendarios.create')->only('create', 'store');
        $this->middleware('can:calendarios.edit')->only('edit', 'update');
        $this->middleware('can:calendarios.destroy')->only('destroy');
    }
    public function index()
    {

        $fechasRecibo = Recibos::select('finicio')->where('estado', '<>', 0)->distinct()->pluck('finicio')->toArray();
        $fechasReserva = Reserva::select('finicio')->where('estado', '<>', 'cancelado')->distinct()->pluck('finicio')->toArray();
        $fechasActividad = array_unique(array_merge($fechasRecibo, $fechasReserva));

        return view('administrador.calendarios.index', compact('fechasActividad'));
    }
    public function edit($tour_id)
    {

        //recibiendo los datos de fecha
        $fecha = Session::get('fecha');

        $recibos = Recibos::all();
        $reservas = Reserva::all();

        $recibos = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 0)
            ->get();

        $reservas = Reserva::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 'cancelado')
            ->get();

        $fmod = Carbon::parse($fecha)->locale('es_ES')->isoFormat('dddd D [de] MMMM [de] YYYY');

        $primerRecibo = $recibos->first();

        if ($primerRecibo == null) {
            $primerReserva = $reservas->first();

            $destino = $primerReserva->tours->destino->nombre;
        } else {
            $destino = $primerRecibo->tours->destino->nombre;
        }



        return view('administrador.calendarios.edit', compact('recibos', 'fmod', 'destino', 'reservas', 'tour_id')); //tiene que estar segun lo enviado *
    }

    public function show($fecha)
    {
        $recibos = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('estado', '<>', 0) // Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();

        $reservas = Reserva::where('finicio', 'like', '%' . $fecha . '%')
            ->where('estado', '<>', 'cancelado')  //Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();

        // enviando la fecha a la vista edit
        Session::put('fecha', $fecha); //nueva forma de usar un sesion de gurdado creo esto esta mejor 

        $fmod = Carbon::parse($fecha)->locale('es_ES')->isoFormat('dddd D [de] MMMM [de] YYYY');

        return view('administrador.calendarios.show', compact('fecha', 'fmod', 'recibos', 'reservas'));
    }

    public function pdf($tour_id)
    {
        $fecha = Session::get('fecha');
        $recibos = Recibos::all();
        $reservas = Reserva::all();
        $primerRecibo = $recibos->first();
        if ($primerRecibo == null) {
            $primerReserva = $reservas->first();
            $destino = $primerReserva->tours->destino->nombre;
        } else {
            $destino = $primerRecibo->tours->destino->nombre;
        }

        $recibos = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 0) // Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();

        $reservas = Reserva::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', 'confirmado')  //Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();

        $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');

        $pdf->setPrintHeader(false); // No mostrar el encabezado
        $pdf->setPrintFooter(false); // No mostrar el pie de página

        // Agregar una página
        $pdf->AddPage();

        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'LISTA DE CLIENTES A ' . strtoupper($destino), 0, 1, 'C');

        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(255, 0, 0);

        $pdf->SetTextColor(0, 0, 0);

        $fmod = Carbon::parse($fecha)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');

        $pdf->Cell(0, 10, 'FECHA: ' . $fmod, 0, 1, 'L');


        $pdf->SetDrawColor(0, 81, 119);
        $pdf->SetLineWidth(2);
        $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());

        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $html = '<table border="2">
        <thead>
            <tr style="background-color: #1b8233; color: white; text-align: center;">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Whatsapp</th>
                <th scope="col">Nacionalidad</th>
                <th scope="col">Género</th>
                <th scope="col">Alergia</th>
                <th scope="col">Alimento</th>
            </tr>
        </thead>
        <tbody>';

        $contador = 1; // Inicializamos el contador

        foreach ($recibos as $recibo) {
            $genero = $recibo->clientes->genero == 1 ? 'Masculino' : 'Femenino';
            $style = ($recibo->tipo == 'privado') ? 'background-color: gold;' : '';

            $html .= '<tr style=" text-align: center;' . $style . '">
            <td>' . $contador++ . '</td>
            <td>' . ucfirst($recibo->clientes->nombre) . ' ' . ucfirst($recibo->clientes->apellido) . '</td>
            <td><a href="https://wa.me/' . $recibo->clientes->whatsapp . '" target="_blank">' . $recibo->clientes->whatsapp . '</a></td>
            <td>' . ucfirst($recibo->clientes->nacionalidad) . '</td>
            <td>' . $genero . '</td>
            <td>' . ucfirst($recibo->clientes->alergia) . '</td>
            <td>' . ucfirst($recibo->clientes->alimento->nombre) . '</td>

        </tr>';
        }
        // registros de reserva
        foreach ($reservas as $reserva) {
            $genero = $reserva->clientes->genero == 1 ? 'Masculino' : 'Femenino';
            $styles = ($reserva->tipo == 'privado') ? 'background-color: gold;' : '';
            $html .= '<tr style="background-color: #a4f8b8; text-align: center;' . $styles . '">
            <td>' . $contador++ . '</td>
            <td>' . ucfirst($reserva->clientes->nombre) . ' ' . ucfirst($reserva->clientes->apellido) . '</td>
            <td><a href="https://wa.me/' . $reserva->clientes->whatsapp . '" target="_blank">' . $reserva->clientes->whatsapp . '</a></td>
            <td>' . ucfirst($reserva->clientes->nacionalidad) . '</td>
            <td>' . $genero . '</td>
            <td>' . ucfirst($reserva->clientes->alergia) . '</td>
            <td>' . ucfirst($reserva->clientes->alimento->nombre) . '</td>

        </tr>';
        }
        $html .= '</tbody></table>';

        // Insertar la tabla en el PDF
        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);

        // Agregar marca de agua (logo)
        $logoPath = 'img/logo50.png';
        $pdf->Image($logoPath, 50, 120, 100, 0, 'PNG');

        $cabecera = 'img/cabecera.png';
        $pdf->Image($cabecera, 0, 0, $pdf->getPageWidth(), 0, 'PNG');

        $pie = 'img/pie.png';
        $pdf->Image($pie, 0, 208, $pdf->getPageWidth(), 0, 'PNG');

        $pdf->Output('Lista ' . $destino . ' de ' . $fecha . '.pdf', 'I');

        return redirect('administrador.calendarios.edit');
    }
    public function alimento($tour_id)
    {
        $fecha = Session::get('fecha');

        $recibos = Recibos::all();
        $reservas = Reserva::all();
        $lisalis = Lisali::all();

        // Obtén los registros de Recibos que cumplen con las condiciones
        $recibos = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 0)
            ->get();

        $reservas = Reserva::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', 'confirmado')
            ->get();

        $primerRecibo = $recibos->first();
        if ($primerRecibo == null) {
            $primerReserva = $reservas->first();
            $destino = $primerReserva->tours->destino->nombre;
        } else {
            $destino = $primerRecibo->tours->destino->nombre;
        }

        $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');


        $PDF_HEADER_LOGO = 'logo.jpg';
        $PDF_HEADER_TITLE = 'SOUTH TREKS ';
        $PDF_HEADER_STRING = 'TRAVEL AGENCY - TOUR OPERADOR';

        $PDF_HEADER_LOGO_WIDTH = 2;


        $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING, array(0, 128, 0), array(0, 81, 119));

        $pdf->setFooterData(array(0, 64, 0), array(0, 81, 119));

        // set header and footer fonts
        $pdf->setHeaderFont(array('times', 'I', 14));
        $pdf->setFooterFont(array('times', 'I', 12));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Agregar una página
        $pdf->AddPage();
        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->SetFont('times', 'B', 18);
        $pdf->Cell(0, 10, 'LISTA DE PRODUCTOS A COMPRAR PARA ', 0, 1, 'C');
        $pdf->Cell(0, 10, strtoupper($destino), 0, 1, 'C');

        $pdf->SetFont('times', '', 10);
        $pdf->SetTextColor(255, 0, 0);

        $pdf->SetTextColor(0, 0, 0);

        $fmod = Carbon::parse($fecha)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');

        $pdf->Cell(0, 10, 'FECHA: ' . $fmod, 0, 1, 'L');


        $pdf->SetDrawColor(0, 81, 119);
        $pdf->SetLineWidth(2);
        $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());

        $pdf->Cell(0, 10, '', 0, 2, 'L');

        // Inicializa un arreglo para contar los tipos de alimentos
        $conteoAlimentos = [];
        $cantidadtotal = 0;
        foreach ($recibos as $recibo) {
            // Obtén el nombre del alimento del cliente asociado al recibo
            $alimentoNombre = $recibo->clientes->alimento->nombre;

            // Si el tipo de alimento ya existe en el arreglo, incrementa su conteo, de lo contrario, inicializa en 1
            if (array_key_exists($alimentoNombre, $conteoAlimentos)) {
                $conteoAlimentos[$alimentoNombre]++;
            } else {
                $conteoAlimentos[$alimentoNombre] = 1;
            }
            $cantidadtotal = $cantidadtotal + 1;
        }
        foreach ($reservas as $reserva) {
            // Obtén el nombre del alimento del cliente asociado al recibo
            $alimentoNombre = $reserva->clientes->alimento->nombre;
            // Si el tipo de alimento ya existe en el arreglo, incrementa su conteo, de lo contrario, inicializa en 1
            if (array_key_exists($alimentoNombre, $conteoAlimentos)) {
                $conteoAlimentos[$alimentoNombre]++;
            } else {
                $conteoAlimentos[$alimentoNombre] = 1;
            }
            $cantidadtotal = $cantidadtotal + 1;
        }


        // Luego, en tu vista PDF, puedes mostrar los resultados
        $html = '';

        // Primera tabla
        $html .= '<ul>';

        foreach ($conteoAlimentos as $nombre => $cantidad) {
            $html .= '<li>' . 'Hay ' . $cantidad . ' pers. ' . strtoupper($nombre)  . '</li>';
        }

        $html .= '</ul>';
        $monto = 0;
        // Segundo bucle para crear tablas separadas

        foreach ($conteoAlimentos as $nombre => $cantidad) {
            $html .= '<h2>' . ucfirst($nombre) . '</h2>'; // Título de la categoría

            $html .= '<table border="2">
        <thead>
            <tr style="background-color: #1b8233; color: white; text-align: center;">
                <th scope="col">#</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>';

            $contador = 1; // Inicializamos el contador
            $total = 0;

            foreach ($lisalis as $lisali) {

                if ($lisali->alimento->nombre == $nombre) {
                    $html .= '<tr style=" text-align: center;">
                    <td>' . 'N° = ' . $contador++ . '</td>
                    <td>' . 'Para ' . $lisali->producto->cantidad * $cantidad . ' pers.' . '</td>
                    <td>' . ucfirst($lisali->producto->nombre) . '</td>
                    <td style="  background-color: rgb(170, 255, 0);">' . $lisali->producto->precio * $cantidad . ' Bs' . '</td>
                </tr>';

                    $total = ($lisali->producto->precio * $cantidad) + $total;
                }
            }

            $html .= '</tbody></table>';

            if (fmod($total, 1) != 0) {
                $html .= '<p style="text-align: right;"> <span style="background-color: rgb(170, 255, 0);">' . 'Total: ' . $total . '0 Bs </span></p>';
            } else {
                $html .= '<p style="text-align: right;"> <span style="background-color: rgb(170, 255, 0);">' . 'Total: ' . $total . '.00 Bs </span></p>';
            }
            $monto = $total + $monto;
        }
        if (fmod($monto, 1) != 0) {
            $pdf->Cell(0, 10, 'Se tiene que comprar los alimentos para ' . $cantidadtotal . ' personas y se gastara un total de ' . $monto . '0 Bs', 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, 'Se tiene que comprar los alimentos para ' . $cantidadtotal . ' personas y se gastara un total de ' . $monto . '.00 Bs', 0, 1, 'L');
        }

        // Inserta la tabla en el PDF
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf->Output('Lista alimentos ' . $destino . ' de ' . $fmod . '.pdf', 'I');

        return redirect('administrador.calendarios.edit');
    }
    public function voucher($tour_id)
    {
        $fecha = Session::get('fecha');
        $recibos = Recibos::all(); //llamando a la tabla tour 
        $tour = Tours::find($tour_id);


        $finicio = Carbon::parse($fecha); //combertiondo el date de obejto strin 

        $fecaxi = $fecha; //recuperando el finicio y no se modifique 

        $ffin = $finicio->addDays($tour->ndia - 1);

        $recibo = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 0) // Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();
        $pax = $recibo->count();

        $recibo = $recibo->first(); //obteniendo el primer registro del recibo
        $destino = $recibo->tours->destino->nombre;
        //dd($destino);

        $empleado = auth()->user()->name;


        $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');
        $pdf->SetDrawColor(129, 201, 250);
        $pdf->SetLineWidth(2);

        $pdf->setPrintHeader(false); // No mostrar el encabezado
        $pdf->setPrintFooter(false); // No mostrar el pie de página
        // CREANDO VOUCHER

        $pdf->SetFont('times', '', 12);
        $pdf->AddPage(); // Agregar una página
        $pdf->SetTextColor(0, 0, 0); // Establece el color del texto en negro
        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, 'FECHA: ' . $fecha, 0, 1, 'R');
        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->Cell(0, 10, 'VOUCHER', 0, 1, 'C');

        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);
        //$pdf->Ln(8); 
        $pdf->SetX($pdf->GetX() + 40);
        // $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');

        $pdf->SetX($pdf->GetX() - 40);
        $pdf->Cell(0, 10, 'Cliente:', 0, 0, 'L');
        $pdf->SetX($pdf->GetX() - 110);
        // $pdf->Cell(0, 10, '+' . $recibo->empleados->whatsapp, 0, 0, 'C');
        $pdf->SetX($pdf->GetX() - 20);
        $pdf->Cell(0, 10, ucwords($empleado), 0, 1, 'R');

        // linea horizontal
        $x1 = 125;
        $y1 = $pdf->getY();
        $x2 = $pdf->getPageWidth() - 10;
        $y2 = $pdf->getY();
        $pdf->Line($x1, $y1, $x2, $y2);

        $x1 = 7;
        $y1 = 91 + (4 * $pax);
        $x2 = 125;
        $y2 = 91 + (4 * $pax);
        $pdf->Line($x1, $y1, $x2, $y2);

        $x1 = 125;
        $y1 = $pdf->getY() + 11;
        $x2 = $pdf->getPageWidth() - 10;
        $y2 = $pdf->getY() + 11;
        $pdf->Line($x1, $y1, $x2, $y2);

        $x1 = 7;
        $y1 =  230;
        $x2 = $pdf->getPageWidth() - 10;
        $y2 =  230;
        $pdf->Line($x1, $y1, $x2, $y2);

        $x1 = 7; // Ajusta el valor según tu necesidad
        $y1 = 185; // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
        $y2 =  185; // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

        $x1 = 7; // Ajusta el valor según tu necesidad
        $y1 = 215; // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 55; // Ajusta el valor según tu necesidad
        $y2 = 215; // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

        $x1 = 7; // Ajusta el valor según tu necesidad
        $y1 = 200; // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 55; // Ajusta el valor según tu necesidad
        $y2 = 200; // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

        // linea vertical
        $x1 = 125; // Ajusta el valor según tu necesidad
        $y1 = $pdf->getY() - 1; // La línea comenzará en la posición actual de la página
        $x2 = 125; // Misma coordenada x que x1 para que sea vertical
        $y2 = $y1 + 97; // Ajusta el valor para determinar la longitud de la línea
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea vertical

        $pdf->SetFont('times', '', 9);
        $html = '<ul>';
        $registros = Recibos::where('finicio', 'like', '%' . $fecha . '%')
            ->where('tour_id', $tour_id)
            ->where('estado', '<>', 0) // Agregar esta línea para filtrar registros con estado diferente de 0
            ->get();
        foreach ($registros as $registro) {
            // Obtener datos de cada registro
            $nombre = ucfirst($registro->clientes->nombre);
            $apellido = ucfirst($registro->clientes->apellido);
            $dni = $registro->clientes->dni;
            $html .= '<li>' . $nombre . ' ' . $apellido . ' - DNI: ' . $dni . '</li>';
        }

        $pdf->writeHTML($html, true, 0, true, 0);

        $pdf->SetFont('times', '', 12);
        //$pdf->Cell(0, 10, $recibo->tours->obs_noinclude->descripcion, 0, 1, 'C');



        $pdf->SetX($pdf->GetX());
        $pdf->Cell(0, 10, 'Servicios:', 0, 1, 'L');
        // $pdf->SetX($pdf->GetX() - 121);

        $pdf->SetX($pdf->GetX() + 20);
        $pdf->SetFont('times', 'BU', 14); // B para negritas, U para subrayado
        if ($tour->ndia == 1) {

            $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DÍA ' . $recibo->tours->destino->nombre), 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, strtoupper($tour->ndia . ' DÍAS ' . $tour->destino->nombre), 0, 1, 'L');
        }
        $pdf->SetFont('times', ' ', 10);
        $elementos = explode('-', $recibo->tours->obs_include->descripcion);
        $html = '<ul>';
        foreach ($elementos as $elemento) {
            // $cellX = 10; // Ajusta la posición X según tus necesidades
            // $cellY = 120; // Ajusta la posición Y para que esté cerca del borde inferior
            // $pdf->SetXY($cellX, $cellY);
            $html .= '<li>' . trim($elemento) . '</li>';
        }
        $html .= '</ul>';

        $pdf->writeHTML($html, true, 0, true, 0);

        $elementos = explode('-', $recibo->tours->obs_noinclude->descripcion);

        $html = '<ul>';
        $contador = 1;
        foreach ($elementos as $elemento) {
            // $html .= '<li>' . trim($elemento) . '</li>'; 
            $cellX = 128; // Ajusta la posición X según tus necesidades
            $cellY = 108 + $contador; // Ajusta la posición Y para que esté cerca del borde inferior
            $pdf->SetXY($cellX, $cellY);
            $elemento = trim($elemento);
            $pdf->Cell(100, 10, '-  ' . ucwords($elemento), 0, 1, 'L');
            $contador = $contador + 5;
        }
        $html .= '</ul>';

        $pdf->writeHTML($html, true, 0, true, 0);

        //$pdf->Cell(0, 10, $recibo->tours->obs_noinclude->descripcion, 0, 1, 'C');



        //$pdf->Cell(0, 10, $recibo->tours->obs_include->descripcion, 0, 1, 'L');

        $pdf->SetFont('times', ' ', 12);
        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 185; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);
        if ($tour->ndia == 1) {
            $pdf->Cell(0, 10, 'Fecha de servicios: ' . $tour->ndia . ' día, solo el ' . $fecaxi, 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, 'Fecha de servicios: ' . $tour->ndia . ' días, ' . $fecaxi . ' a ' . $ffin, 0, 1, 'L');
        }

        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 200; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);

        $pdf->Cell(0, 10, 'Observaciones: ', 0, 1, 'L');


        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 215; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);
        // $pdf->Cell(0, 10, 'Forma de pago: El cliente pago mediante ' . $recibo->metodo, 0, 1, 'L');

        $cellX = 126;
        $cellY = 90;
        $pdf->SetXY($cellX, $cellY);
        $pdf->Cell(0, 10, 'Confirmado por:', 0, 2, 'L');
        $pdf->Cell(0, 10, 'No incluye:', 0, 1, 'L');

        $cellX = 165;
        $cellY = 190;
        $pdf->SetXY($cellX, $cellY);
        $pdf->Cell(0, 10, 'PAX:', 0, 2, 'L');
        $pdf->SetFont('times', '', 50);
        $pdf->Cell(0, 10, $pax, 0, 1, 'L');

        $voucher = 'img/voucher.png';
        $posX = 0; // Ajusta este valor para mover la imagen hacia la derecha
        $posY = 0; // Ajusta este valor para mover la imagen hacia abajo

        // Tamaño de la imagen ajustado al tamaño carta (Letter)
        $anchoImagen = 220; // Ancho en milímetros (aproximadamente 21.59 cm)
        $altoImagen = 280;  // Alto en milímetros (aproximadamente 27.94 cm)

        $pdf->Image($voucher, $posX, $posY, $anchoImagen, $altoImagen, 'PNG');
        //$pdf->Image('@' . $qrImage, 159, 188, 40, 40, 'PNG');

        // TEXTO DEL PDF
        $pdf->Output('Voucher ' . $destino . ' de ' .$pax . ' pax el '. $fecha . '.pdf', 'I');

        return redirect('recibos');
    }
}
