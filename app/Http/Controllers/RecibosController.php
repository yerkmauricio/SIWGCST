<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecibosRequest;
use App\Models\Clientes;
use App\Models\Descuento;
use App\Models\Destinos;
use App\Models\Empleados;
use App\Models\Recibos;
use App\Models\Tours;
use Carbon\Carbon; //obstencion del tiempo actual
use Illuminate\Support\Facades\Session; //sesion de envio
use NumberFormatter; //comversion de los numeros
use SimpleSoftwareIO\QrCode\Facades\QrCode; //par el qr
use Illuminate\Http\Request;
use TCPDF;
use DateTime;
use Illuminate\Support\Facades\Auth;

class RecibosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:recibos.index')->only('index');
        $this->middleware('can:recibos.create')->only('create', 'store');
        $this->middleware('can:recibos.edit')->only('edit', 'update');
        $this->middleware('can:recibos.destroy')->only('destroy');
    }
    public function index()
    {
        $recibos = Recibos::all();
    
        return view('administrador.recibos.index', compact('recibos'));
    }


    public function create()
    {
        $nom = Session::get('nom');
        $ape = Session::get('ape');
        $d = Session::get('d');
        $fecha = Session::get('fecha');

        $tou = Session::get('tou');
        $npe = Session::get('npe');
        $des = Session::get('des');
        $met = Session::get('met');
        $mon = Session::get('mon');
        $idi = Session::get('idi');
        $tip = Session::get('tip');
        $cue = Session::get('cue');
        $obs = Session::get('obs');

        $descuentos = Descuento::all();
        $tours = Tours::pluck('destino_id', 'id');
        $empleados = Empleados::all();

        $tours = Tours::with('destino')->get(); //llamando el nombre
        return view('administrador.recibos.create', compact('obs', 'tip', 'tours', 'descuentos', 'empleados', 'tou', 'fecha', 'nom', 'ape', 'd', 'npe', 'des', 'met', 'mon', 'cue', 'idi'));
    }


    public function store(StoreRecibosRequest $request)
    {

        $cliente = Clientes::where('nombre', $request->nombre) //verificando si hay cliente
            ->where('apellido', $request->apellido)
            ->where('dni', $request->dni)
            ->first();

        $tour_id = $request->input('tour_id');
        list($id, $ndia) = explode('|', $tour_id); //separando las variables 
        $tourf = $id;

        if (!$cliente) {
            return redirect()->route('clientes.create')
                ->with('nombre', $request->nombre)
                ->with('apellido', $request->apellido)
                ->with('dni', $request->dni)
                ->with('finicio', $request->finicio)
                ->with('npersona', $request->npersona)
                ->with('metodo', $request->metodo)
                ->with('descuento_id', $request->descuento_id)
                ->with('cuenta', $request->cuenta)
                ->with('moneda', $request->moneda)
                ->with('tipo', $request->tipo)
                ->with('descripcion', $request->descripcion)
                ->with('saldo', $request->saldo)
                ->with('idioma', $request->idioma)
                ->with('tour_id', $tourf);
        }

        // Calculando la fecha de finalizacion
        $finicio = Carbon::parse($request->finicio); //combertiondo el date de obejto strin 
        $fecaxi = $request->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($ndia - 1);

        // Calculando la fecha de finalizacion
        $finicio = Carbon::parse($request->finicio); //combertiondo el date de obejto strin 
        $fecaxi = $request->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($ndia - 1);

        //calculando el monto a cobrar 
        // Obtener los datos del formulario nesesarios para el monto
        $tourId = $request->input('tour_id');
        $descuentoId = $request->input('descuento_id');
        $tour = Tours::find($tourId);
        $descuento = Descuento::find($descuentoId);


        // Calcular el monto utilizando el precio y el porcentaje
        if ($request->tipo == 'privado') {
            $precio = $tour->precioprivado;
        } else {
            $precio = $tour->precio;
        }

        // usando api para encontra el precio del dolar en tiempo real 
        $apiKey = 'cdc638d5ce5e7c9ecfbd0801d70e0cda';
        // URL de la API para obtener tasas de cambio más recientes
        $url = "http://api.exchangeratesapi.io/v1/latest?access_key=$apiKey";
        // Realiza una solicitud HTTP GET a la API
        $response = file_get_contents($url, false, stream_context_create([
            'http' => [
                'header' => "Authorization: Bearer $apiKey",
            ],
        ]));
        // Decodifica la respuesta JSON
        $data = json_decode($response, true);
        // Verifica si se obtuvo una respuesta exitosa y si el precio del dólar está presente en la respuesta
        if (isset($data['rates']['BOB'])) {
            $precioDolar = $data['rates']['BOB'];
        } else {
            // No se pudo obtener el precio del dólar
            $precioDolar = 7;
        }

        if ($request->moneda == 'Dolares') {
            $porcentaje = $descuento->porcentaje;
            $monto = round(($precio - ($precio * ($porcentaje / 100))) / $precioDolar);
        } else {
            $porcentaje = $descuento->porcentaje;
            $monto = $precio - ($precio * ($porcentaje / 100));
        }

        if ($request->cuenta == null) {
            $saldo = 0;
        } else {
            $saldo = $monto - ($request->cuenta);
        }
        $empleadoId = auth()->user()->empleado_id;


        $recibo = new Recibos([

            'finicio' => $fecaxi,
            'ffin' => $ffin,
            'cliente_id' => $cliente->id, // Asociamos la reserva al cliente creado o existente
            'tour_id' => $tourf,
            'npersona' => $request->npersona,
            'metodo' => $request->metodo,
            'moneda' => $request->moneda,
            'cuenta' => $request->cuenta,
            'tipo' => $request->tipo,
            'saldo' => $saldo,
            'monto' => $monto,
            'descripcion' => $request->descripcion,
            'qr' => 0,  //Asignar el valor del código QR generado
            'descuento_id' => $request->descuento_id,
            'empleado_id' => $empleadoId,

        ]);
        $recibo->save();

        // actualizando el valor de nviaje
        if ($saldo == 0) {
            $cliente = Clientes::find($cliente->id); // Donde $clienteId es el ID del cliente que deseas modificar
            if ($cliente) {
                $cliente->nviaje = $cliente->nviaje + 1;
                $cliente->save(); // Guarda el cliente modificado en la base de datos
            }
        }

        $reciboId = $recibo->id;

        $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT); //cambiando el numero de numerico a string
        $montoliteral = $formatter->format($recibo->monto);

        //codigo qr
        $qrCode = QrCode::size(200)
            // ->merge(public_path('img/logo.png'), 0.5, true)
            ->generate(route('recibos.show', $reciboId));
        $recibo->qr =  $qrCode;


        $recibo->save();

        // creando un pdf

        if ($request->idioma == 'español') {

            $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');

            $pdf->setPrintHeader(false); // No mostrar el encabezado
            $pdf->setPrintFooter(false); // No mostrar el pie de página

            // Agregar una página
            $pdf->AddPage();

            // Establecer el estilo de fuente


            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');

            $pdf->SetFont('times', 'B', 25);
            $pdf->Cell(0, 10, 'RECIBO', 0, 1, 'C');

            $pdf->SetFont('times', '', 16);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(0, 10, 'N° = ' . $reciboId, 0, 30, 'R');
            $pdf->SetTextColor(0, 0, 0);

            $recibo = Recibos::find($reciboId);
            $fechaRegistro = $recibo->f_registro; // Guarda la fecha de registro original
            //dd($fechaRegistro);
            $fecha = Carbon::parse($fechaRegistro)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');
            $pdf->Cell(0, 10, 'FECHA: ' . $fecha, 0, 1, 'R');

            $pdf->Cell(0, 10, 'DE: ' . ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');
            $pdf->Cell(0, 10, 'PARA: ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido), 0, 1, 'L');

            if ($recibo->tours->ndia == 1) {
                $pdf->Cell(0, 10, 'Por concepto de : Viaje de ' . $recibo->tours->ndia . ' dia al destino de ' . $recibo->tours->destino->nombre .
                    ', con una dificultad ', 0, 1, 'L');
            } else {
                $pdf->Cell(0, 10, 'Por concepto de : Viaje de ' . $recibo->tours->ndia . ' dias al destino de ' . $recibo->tours->destino->nombre .
                    ', con una dificultad ', 0, 1, 'L');
            }
            $fecaxi = Carbon::parse($fecaxi)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');
            $ffin = Carbon::parse($ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');


            $pdf->Cell(0, 10, $recibo->tours->dificultad . ' y el tour comienza el  ' . $fecaxi . ' y termina el ', 0, 2, 'L');
            $pdf->Cell(0, 10,  $ffin,   0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');


            $pdf->SetDrawColor(129, 201, 250);
            $pdf->SetLineWidth(2);
            $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());

            $pdf->Cell(0, 10, 'Detalles', 0, 2, 'L');

            $qrImage = QrCode::format('png')
                ->size(200)
                ->color(0, 81, 110) // Color azul (RGB)
                ->generate(route('recibos.show', $reciboId));

            $pdf->Image('@' . $qrImage, 15, 155, 50, 50, 'PNG');


            $pdf->Cell(0, 10, '             Precio del tour ', 0, 0, 'C');
            if ($recibo->moneda == 'Bolivianos') {
                if ($recibo->tipo == 'privado') {
                    $pdf->Cell(0, 10, $recibo->tours->precioprivado . '0 ' . $recibo->moneda, 0, 1, 'R');
                } else {
                    $pdf->Cell(0, 10, $recibo->tours->precio . '0 ' . $recibo->moneda, 0, 1, 'R');
                }
            } else {
                //crera que loo voy a modificar simon
                if ($recibo->tipo == 'privado') {
                    $dollar = $recibo->tours->precioprivado / $precioDolar;
                } else {
                    $dollar = $recibo->tours->precio / $precioDolar;
                }

                $dollarRedondeado = round($dollar); // Redondear a número entero
                $pdf->Cell(0, 10, $dollarRedondeado . '.00 ' . $recibo->moneda, 0, 1, 'R');
            }

            $pdf->Cell(0, 10, '              Tipo de moneda ', 0, 0, 'C');
            $pdf->Cell(0, 10, $recibo->moneda, 0, 1, 'R');

            if ($recibo->descuentos->porcentaje != 0) {
                $pdf->Cell(0, 10, '        Descuento  ', 0, 0, 'C');
                $pdf->Cell(0, 10, $recibo->descuentos->porcentaje . ' % ' . $recibo->monto . ' ' . $recibo->moneda, 0, 1, 'R');
            }

            if ($recibo->cuenta != null) {

                $pdf->Cell(0, 10, ' Cuenta ', 0, 0, 'C');
                $pdf->Cell(0, 10, $recibo->cuenta . '.00 ' . $recibo->moneda, 0, 1, 'R');

                $pdf->Cell(0, 10, 'Saldo ', 0, 0, 'C');
                $saldo = number_format($recibo->saldo, 2); // Formatea el monto con dos decimales
                $pdf->Cell(0, 10, $saldo . '  ' . $recibo->moneda, 0, 1, 'R');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            } else {

                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            }

            if ($recibo->descuentos->porcentaje == 0) {
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            }

            if ($recibo->cuenta != null) {
                $montoliteral = $formatter->format($recibo->cuenta);
                $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(0, 170, 35);
                $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);
                $cuenta = number_format($recibo->cuenta, 2); // Formatea el monto con dos decimales
                $pdf->Cell(0, 10, $cuenta . ' ' . $recibo->moneda, 0, 1, 'R', 1);
                $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
            } else {
                $montoliteral = $formatter->format($recibo->monto);
                $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(0, 170, 35);
                $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);

                $total = number_format($recibo->monto, 2); // Formatea el monto con dos decimales
                $pdf->Cell(0, 10, $total . ' ' . $recibo->moneda, 0, 1, 'R', 1);

                $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
            }
            $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);

            // Agregar marca de agua (logo)
            $logoPath = 'img/logo50.png';
            $pdf->Image($logoPath, 50, 120, 100, 0, 'PNG');

            $cabecera = 'img/cabecera.png';
            $pdf->Image($cabecera, 0, 0, $pdf->getPageWidth(), 0, 'PNG');

            $pie = 'img/pie.png';
            $pdf->Image($pie, 0, 208, $pdf->getPageWidth(), 0, 'PNG');

            // CREANDO VOUCHER

            if ($saldo == 0) {
                $pdf->AddPage(); // Agregar una página
                $pdf->SetTextColor(0, 0, 0); // Establece el color del texto en negro
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, 'FECHA: ' . $fecha, 0, 1, 'R');
                $pdf->Cell(0, 10, '', 0, 2, 'L');




                $pdf->Cell(0, 10, 'VOUCHER', 0, 1, 'C');

                $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);
                //$pdf->Ln(8); 
                $pdf->SetX($pdf->GetX() + 40);
                $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');

                $pdf->SetX($pdf->GetX() - 40);
                $pdf->Cell(0, 10, 'Cliente:', 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 110);
                $pdf->Cell(0, 10, '+' . $recibo->empleados->whatsapp, 0, 0, 'C');
                $pdf->SetX($pdf->GetX() - 20);
                $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 1, 'R');
                // linea horizontal
                $x1 = 125; // Ajusta el valor según tu necesidad
                $y1 = $pdf->getY(); // La línea comenzará en la posición actual de la página
                $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
                $y2 = $pdf->getY(); // La línea terminará en la misma posición vertical que la inicial
                $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

                $x1 = 7; // Ajusta el valor según tu necesidad
                $y1 = $pdf->getY() + 11; // La línea comenzará en la posición actual de la página
                $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
                $y2 = $pdf->getY() + 11; // La línea terminará en la misma posición vertical que la inicial
                $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

                $x1 = 7; // Ajusta el valor según tu necesidad
                $y1 =  230; // La línea comenzará en la posición actual de la página
                $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
                $y2 =  230; // La línea terminará en la misma posición vertical que la inicial
                $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

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
                $pdf->Line($x1, $y1, $x2, $y2);
                // Dibuja la línea vertical


                $pdf->Cell(0, 10, '- ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido) . '  ' . $recibo->clientes->dni, 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 109);
                $pdf->Cell(0, 10, 'Confirmado por:', 0, 1, 'C');

                $pdf->Cell(0, 10, 'Servicios:', 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 121);
                $pdf->Cell(0, 10, 'No incluye:', 0, 1, 'C');
                $pdf->SetX($pdf->GetX() + 25);
                $pdf->SetFont('times', 'BU', 16); // B para negritas, U para subrayado
                if ($recibo->tours->ndia == 1) {

                    $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DÍA ' . $recibo->tours->destino->nombre), 0, 0, 'L');
                } else {
                    $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DÍAS ' . $recibo->tours->destino->nombre), 0, 0, 'L');
                }
                $pdf->SetFont('times', ' ', 10);

                //$pdf->SetX($pdf->GetX() + 121);

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


                $elementos = explode('-', $recibo->tours->obs_include->descripcion);
                $html = '<ul>';
                foreach ($elementos as $elemento) {
                    $cellX = 10; // Ajusta la posición X según tus necesidades
                    $cellY = 120; // Ajusta la posición Y para que esté cerca del borde inferior
                    $pdf->SetXY($cellX, $cellY);
                    $html .= '<li>' . trim($elemento) . '</li>';
                }
                $html .= '</ul>';

                $pdf->writeHTML($html, true, 0, true, 0);
                //$pdf->Cell(0, 10, $recibo->tours->obs_include->descripcion, 0, 1, 'L');

                $pdf->SetFont('times', ' ', 12);
                $cellX = 10; // Ajusta la posición X según tus necesidades
                $cellY = 185; // Ajusta la posición Y para que esté cerca del borde inferior
                $pdf->SetXY($cellX, $cellY);
                if ($recibo->tours->ndia == 1) {
                    $pdf->Cell(0, 10, 'Fecha de servicios: ' . $recibo->tours->ndia . ' día, solo el ' . $fecaxi, 0, 1, 'L');
                } else {
                    $pdf->Cell(0, 10, 'Fecha de servicios: ' . $recibo->tours->ndia . ' días, ' . $fecaxi . ' a ' . $ffin, 0, 1, 'L');
                }

                $cellX = 10; // Ajusta la posición X según tus necesidades
                $cellY = 200; // Ajusta la posición Y para que esté cerca del borde inferior
                $pdf->SetXY($cellX, $cellY);

                if ($recibo->descripcion == null) {
                    $pdf->Cell(0, 10, 'Observaciones: No hay ninguna observacion', 0, 1, 'L');
                } else {
                    $pdf->Cell(0, 10, 'Observaciones: ' . $recibo->descripcion, 0, 1, 'L');
                }

                $cellX = 10; // Ajusta la posición X según tus necesidades
                $cellY = 215; // Ajusta la posición Y para que esté cerca del borde inferior
                $pdf->SetXY($cellX, $cellY);
                $pdf->Cell(0, 10, 'Forma de pago: El cliente pagó mediante ' . $recibo->metodo, 0, 1, 'L');

                $voucher = 'img/voucher.png';
                $posX = 0; // Ajusta este valor para mover la imagen hacia la derecha
                $posY = 0; // Ajusta este valor para mover la imagen hacia abajo

                // Tamaño de la imagen ajustado al tamaño carta (Letter)
                $anchoImagen = 220; // Ancho en milímetros (aproximadamente 21.59 cm)
                $altoImagen = 280;  // Alto en milímetros (aproximadamente 27.94 cm)

                $pdf->Image($voucher, $posX, $posY, $anchoImagen, $altoImagen, 'PNG');
                $pdf->Image('@' . $qrImage, 159, 188, 40, 40, 'PNG');
            }


            $pdf->Output('Recibo ' . $recibo->clientes->nombre . ' ' . $recibo->clientes->apellido . ' de ' . $fecha . '.pdf', 'I');
        } else {
            $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();

            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');

            $pdf->SetFont('times', 'B', 25);
            $pdf->Cell(0, 10, 'RECEIPT', 0, 1, 'C');

            $pdf->SetFont('times', '', 16);
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(0, 10, 'Receipt Number: ' . $reciboId, 0, 30, 'R');
            $pdf->SetTextColor(0, 0, 0);

            $recibo = Recibos::find($reciboId);
            $fechaRegistro = $recibo->f_registro;
            $fecha = Carbon::parse($fechaRegistro)->locale('en_US')->isoFormat('dddd D - MMMM - YYYY');
            $pdf->Cell(0, 10, 'DATE: ' . $fecha, 0, 1, 'R');

            $pdf->Cell(0, 10, 'FROM: ' . ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');
            $pdf->Cell(0, 10, 'TO: ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido), 0, 1, 'L');

            if ($recibo->tours->ndia == 1) {
                $pdf->Cell(0, 10, 'For: 1-day trip to ' . $recibo->tours->destino->nombre . ' with a difficulty of ', 0, 1, 'L');
            } else {
                $pdf->Cell(0, 10, 'For: ' . $recibo->tours->ndia . ' days trip to ' . $recibo->tours->destino->nombre . ' with a difficulty of ', 0, 1, 'L');
            }

            $fecaxi = Carbon::parse($fecaxi)->locale('en_US')->isoFormat('dddd D - MMMM - YYYY');
            $ffin = Carbon::parse($ffin)->locale('en_US')->isoFormat('dddd D - MMMM - YYYY');

            $dificultad = '';
            if ($recibo->tours->dificultad === 'facil') {
                $dificultad = 'easy';
            } elseif ($recibo->tours->dificultad === 'muy facil') {
                $dificultad = 'very easy';
            } elseif ($recibo->tours->dificultad === 'normal') {
                $dificultad = 'normal';
            } elseif ($recibo->tours->dificultad === 'dificil') {
                $dificultad = 'difficult';
            } elseif ($recibo->tours->dificultad === 'muy dificil') {
                $dificultad = 'very difficult';
            }


            $pdf->Cell(0, 10, $dificultad . ' and the tour starts on ' . $fecaxi . ' and ends on ', 0, 2, 'L');
            $pdf->Cell(0, 10, $ffin, 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');

            $pdf->SetDrawColor(129, 201, 250);
            $pdf->SetLineWidth(2);
            $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());

            $pdf->Cell(0, 10, 'Details', 0, 2, 'L');

            $qrImage = QrCode::format('png')
                ->size(200)
                ->color(0, 81, 110)
                ->generate(route('recibos.show', $reciboId));

            $pdf->Image('@' . $qrImage, 15, 155, 50, 50, 'PNG');

            $pdf->Cell(0, 10, 'Tour Price ', 0, 0, 'C');
            if ($recibo->moneda == 'Bolivianos') {
                if ($recibo->tipo == 'privado') {
                    $pdf->Cell(0, 10, $recibo->tours->precioprivado . '.00 ' . $recibo->moneda, 0, 1, 'R');
                } else {
                    $pdf->Cell(0, 10, $recibo->tours->precio . '.00 ' . $recibo->moneda, 0, 1, 'R');
                }
            } else {
                if ($recibo->tipo == 'privado') {
                    $dollar = $recibo->tours->precioprivado / $precioDolar;
                } else {
                    $dollar = $recibo->tours->precio / $precioDolar;
                }
                $dollarRedondeado = round($dollar);
                $pdf->Cell(0, 10, $dollarRedondeado . '.00 ' . $recibo->moneda, 0, 1, 'R');
            }

            $pdf->Cell(0, 10, 'Currency Type ', 0, 0, 'C');
            $pdf->Cell(0, 10, $recibo->moneda, 0, 1, 'R');

            if ($recibo->descuentos->porcentaje != 0) {
                $pdf->Cell(0, 10, 'Discount ', 0, 0, 'C');
                $pdf->Cell(0, 10, $recibo->descuentos->porcentaje . ' % ' . $recibo->monto . ' ' . $recibo->moneda, 0, 1, 'R');
            }

            if ($recibo->cuenta != null) {
                $pdf->Cell(0, 10, ' Account ', 0, 0, 'C');
                $pdf->Cell(0, 10, $recibo->cuenta . '.00 ' . $recibo->moneda, 0, 1, 'R');

                $pdf->Cell(0, 10, 'Balance ', 0, 0, 'C');
                $saldo = number_format($recibo->saldo, 2);
                $pdf->Cell(0, 10, $saldo . '  ' . $recibo->moneda, 0, 1, 'R');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            } else {
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            }

            if ($recibo->descuentos->porcentaje == 0) {
                $pdf->Cell(0, 10, '', 0, 2, 'L');
            }

            if ($recibo->cuenta != null) {
                $montoliteral = $formatter->format($recibo->cuenta);
                $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(0, 170, 35);
                $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);
                $cuenta = number_format($recibo->cuenta, 2);
                $pdf->Cell(0, 10, $cuenta . ' ' . $recibo->moneda, 0, 1, 'R', 1);
                $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
            } else {
                $montoliteral = $formatter->format($recibo->monto);
                $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(0, 170, 35);
                $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);
                $total = number_format($recibo->monto, 2);
                $pdf->Cell(0, 10, $total . ' ' . $recibo->moneda, 0, 1, 'R', 1);
                $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
            }

            $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);

            $logoPath = 'img/logo50.png';
            $pdf->Image($logoPath, 50, 120, 100, 0, 'PNG');

            $cabecera = 'img/cabecera.png';
            $pdf->Image($cabecera, 0, 0, $pdf->getPageWidth(), 0, 'PNG');

            $pie = 'img/pie.png';
            $pdf->Image($pie, 0, 208, $pdf->getPageWidth(), 0, 'PNG');


            // CREATING VOUCHER
            if ($saldo == 0) {
                $pdf->AddPage(); // Add a page
                $pdf->SetTextColor(0, 0, 0); // Set text color to black
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, '', 0, 2, 'L');
                $pdf->Cell(0, 10, 'DATE: ' . $fecha, 0, 1, 'R');
                $pdf->Cell(0, 10, '', 0, 2, 'L');

                $pdf->Cell(0, 10, 'VOUCHER', 0, 1, 'C');

                $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);
                $pdf->SetX($pdf->GetX() + 40);
                $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');
                $pdf->SetX($pdf->GetX() - 40);
                $pdf->Cell(0, 10, 'Customer:', 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 110);
                $pdf->Cell(0, 10, '+' . $recibo->empleados->whatsapp, 0, 0, 'C');
                $pdf->SetX($pdf->GetX() - 20);
                $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 1, 'R');

                // Horizontal lines
                $x1 = 125; // Adjust the value as needed
                $y1 = $pdf->getY();
                $x2 = $pdf->getPageWidth() - 10; // Adjust the value as needed
                $y2 = $pdf->getY();
                $pdf->Line($x1, $y1, $x2, $y2);

                $x1 = 7; // Adjust the value as needed
                $y1 = $pdf->getY() + 11;
                $x2 = $pdf->getPageWidth() - 10; // Adjust the value as needed
                $y2 = $pdf->getY() + 11;
                $pdf->Line($x1, $y1, $x2, $y2);

                $x1 = 7; // Adjust the value as needed
                $y1 =  230;
                $x2 = $pdf->getPageWidth() - 10; // Adjust the value as needed
                $y2 =  230;
                $pdf->Line($x1, $y1, $x2, $y2);

                $x1 = 7; // Adjust the value as needed
                $y1 = 185;
                $x2 = $pdf->getPageWidth() - 10; // Adjust the value as needed
                $y2 =  185;
                $pdf->Line($x1, $y1, $x2, $y2);

                $x1 = 7; // Adjust the value as needed
                $y1 = 215;
                $x2 = $pdf->getPageWidth() - 55; // Adjust the value as needed
                $y2 = 215;
                $pdf->Line($x1, $y1, $x2, $y2);

                $x1 = 7; // Adjust the value as needed
                $y1 = 200;
                $x2 = $pdf->getPageWidth() - 55; // Adjust the value as needed
                $y2 = 200;
                $pdf->Line($x1, $y1, $x2, $y2);

                // Vertical line
                $x1 = 125; // Adjust the value as needed
                $y1 = $pdf->getY() - 1;
                $x2 = 125;
                $y2 = $y1 + 97;
                $pdf->Line($x1, $y1, $x2, $y2);

                $pdf->Cell(0, 10, '- ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido) . '  ' . $recibo->clientes->dni, 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 109);
                $pdf->Cell(0, 10, 'Confirmed by:', 0, 1, 'C');

                $pdf->Cell(0, 10, 'Services:', 0, 0, 'L');
                $pdf->SetX($pdf->GetX() - 115);
                $pdf->Cell(0, 10, 'Not included:', 0, 1, 'C');
                $pdf->SetX($pdf->GetX() + 25);
                $pdf->SetFont('times', 'BU', 16);
                if ($recibo->tours->ndia == 1) {
                    $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DAY ' . $recibo->tours->destino->nombre), 0, 0, 'L');
                } else {
                    $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DAYS ' . $recibo->tours->destino->nombre), 0, 0, 'L');
                }
                $pdf->SetFont('times', ' ', 10);

                $elementos = explode('-', $recibo->tours->obs_noinclude->descripcion);
                $html = '<ul>';
                $contador = 1;
                foreach ($elementos as $elemento) {
                    $cellX = 128;
                    $cellY = 108 + $contador;
                    $pdf->SetXY($cellX, $cellY);
                    $elemento = trim($elemento);
                    $pdf->Cell(100, 10, '-  ' . ucwords($elemento), 0, 1, 'L');
                    $contador = $contador + 5;
                }
                $html .= '</ul';

                $pdf->writeHTML($html, true, 0, true, 0);

                $elementos = explode('-', $recibo->tours->obs_include->descripcion);
                $html = '<ul>';
                foreach ($elementos as $elemento) {
                    $cellX = 10;
                    $cellY = 120;
                    $pdf->SetXY($cellX, $cellY);
                    $html .= '<li>' . trim($elemento) . '</li>';
                }
                $html .= '</ul';

                $pdf->writeHTML($html, true, 0, true, 0);

                $pdf->SetFont('times', ' ', 12);
                $cellX = 10;
                $cellY = 185;
                $pdf->SetXY($cellX, $cellY);
                if ($recibo->tours->ndia == 1) {
                    $pdf->Cell(0, 10, 'Service Date: ' . $recibo->tours->ndia . ' day, only ' . $fecaxi, 0, 1, 'L');
                } else {
                    $pdf->Cell(0, 10, 'Service Date: ' . $recibo->tours->ndia . ' days, ' . $fecaxi . ' to ' . $ffin, 0, 1, 'L');
                }

                $cellX = 10;
                $cellY = 200;
                $pdf->SetXY($cellX, $cellY);
                if ($recibo->descripcion == null) {
                    $pdf->Cell(0, 10, 'Observations: There are no observations', 0, 1, 'L');
                } else {
                    $pdf->Cell(0, 10, 'Observations: ' . $recibo->descripcion, 0, 1, 'L');
                }

                $cellX = 10;
                $cellY = 215;
                $pdf->SetXY($cellX, $cellY);
                $metodo = '';
                if ($recibo->metodo === 'efectivo') {
                    $metodo = 'cash';
                } elseif ($recibo->metodo === 'transferencia') {
                    $metodo = 'transfer';
                } elseif ($recibo->metodo === 'tarjeta') {
                    $metodo = 'target ';
                }
                $pdf->Cell(0, 10, 'Payment Method: The customer paid with ' . $metodo, 0, 1, 'L');

                $voucher = 'img/voucherI.png';
                $posX = 0;
                $posY = 0;

                // Image size adjusted to letter size
                $anchoImagen = 220; // Width in millimeters (approximately 21.59 cm)
                $altoImagen = 280;  // Height in millimeters (approximately 27.94 cm)

                $pdf->Image($voucher, $posX, $posY, $anchoImagen, $altoImagen, 'PNG');
                $pdf->Image('@' . $qrImage, 159, 188, 40, 40, 'PNG');
            }

            $pdf->Output('Receipt ' . $recibo->clientes->nombre . ' ' . $recibo->clientes->apellido . ' ' . $fecha . '.pdf', 'I');
        }
        return redirect('recibos');
    }


    public function show(Recibos $recibo)
    {

        $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT); //cambiando el numero de numerico a string
        $montoliteral = $formatter->format($recibo->monto);
        $cuentaliteral = $formatter->format($recibo->cuenta);

        return view('administrador.recibos.show', compact('recibo', 'montoliteral', 'cuentaliteral'));
    }
    public function pdf(Recibos $recibo)
    {
        // Calculando la fecha de finalizacion
        $finicio = Carbon::parse($recibo->finicio); //combertiondo el date de obejto strin 

        $fecaxi = $recibo->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($recibo->tours->ndia - 1);

        $reciboId = $recibo->id;

        $formatter = new NumberFormatter('es', NumberFormatter::SPELLOUT); //cambiando el numero de numerico a string


        //codigo qr
        $qrCode = QrCode::size(200)
            // ->merge(public_path('img/logo.png'), 0.5, true)
            ->generate(route('recibos.show', $reciboId));
        $recibo->qr =  $qrCode;


        $recibo->save();

        // usando api para encontra el precio del dolar en tiempo real 
        $apiKey = 'cdc638d5ce5e7c9ecfbd0801d70e0cda';
        // URL de la API para obtener tasas de cambio más recientes
        $url = "http://api.exchangeratesapi.io/v1/latest?access_key=$apiKey";
        // Realiza una solicitud HTTP GET a la API
        $response = file_get_contents($url, false, stream_context_create([
            'http' => [
                'header' => "Authorization: Bearer $apiKey",
            ],
        ]));
        // Decodifica la respuesta JSON
        $data = json_decode($response, true);
        // Verifica si se obtuvo una respuesta exitosa y si el precio del dólar está presente en la respuesta
        if (isset($data['rates']['BOB'])) {
            $precioDolar = $data['rates']['BOB'];
        } else {
            // No se pudo obtener el precio del dólar
            $precioDolar = 7;
        }

        $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8');

        $pdf->setPrintHeader(false); // No mostrar el encabezado
        $pdf->setPrintFooter(false); // No mostrar el pie de página

        // Agregar una página
        $pdf->AddPage();

        // Establecer el estilo de fuente


        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');

        $pdf->SetFont('times', 'B', 25);
        $pdf->Cell(0, 10, 'RECIBO', 0, 1, 'C');

        $pdf->SetFont('times', '', 16);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(0, 10, 'N° = ' . $reciboId, 0, 30, 'R');
        $pdf->SetTextColor(0, 0, 0);

        $fechaRegistro = $recibo->f_registro; // Guarda la fecha de registro original
        $fecha = Carbon::parse($fechaRegistro)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');



        $pdf->Cell(0, 10, 'FECHA: ' . $fecha, 0, 1, 'R');

        $pdf->Cell(0, 10, 'DE: ' . ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');
        $pdf->Cell(0, 10, 'PARA: ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido), 0, 1, 'L');

        if ($recibo->tours->ndia == 1) {
            $pdf->Cell(0, 10, 'Por concepto de : Viaje de ' . $recibo->tours->ndia . ' dia al destino de ' . $recibo->tours->destino->nombre .
                ', con una dificultad ', 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, 'Por concepto de : Viaje de ' . $recibo->tours->ndia . ' dias al destino de ' . $recibo->tours->destino->nombre .
                ', con una dificultad ', 0, 1, 'L');
        }
        $fecaxi = Carbon::parse($fecaxi)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');
        $ffin = Carbon::parse($ffin)->locale('es_ES')->isoFormat('dddd D - MMMM - YYYY');

        $pdf->Cell(0, 10, $recibo->tours->dificultad . ' y el tour comienza el  ' . $fecaxi . ' y termina el ', 0, 2, 'L');
        $pdf->Cell(0, 10,  $ffin,   0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');


        $pdf->SetDrawColor(129, 201, 250);
        $pdf->SetLineWidth(2);
        $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());

        $pdf->Cell(0, 10, 'Detalles', 0, 2, 'L');

        $qrImage = QrCode::format('png')
            ->size(200)
            ->color(0, 81, 110) // Color azul (RGB)
            ->generate(route('recibos.show', $reciboId));

        $pdf->Image('@' . $qrImage, 15, 155, 50, 50, 'PNG');


        $pdf->Cell(0, 10, '             Precio del tour ', 0, 0, 'C');
        if ($recibo->moneda == 'Bolivianos') {
            if ($recibo->tipo == 'privado') {
                $pdf->Cell(0, 10, $recibo->tours->precioprivado . '0 ' . $recibo->moneda, 0, 1, 'R');
            } else {
                $pdf->Cell(0, 10, $recibo->tours->precio . '0 ' . $recibo->moneda, 0, 1, 'R'); 
            }

        } else {
            if ($recibo->tipo == 'privado') {
                $dollar = $recibo->tours->precioprivado / $precioDolar;
            } else {
                $dollar = $recibo->tours->precio / $precioDolar;
            }

            $dollarRedondeado = round($dollar); // Redondear a número entero
            $pdf->Cell(0, 10, $dollarRedondeado . '.00 ' . $recibo->moneda, 0, 1, 'R');
        }

        $pdf->Cell(0, 10, '              Tipo de moneda ', 0, 0, 'C');
        $pdf->Cell(0, 10, $recibo->moneda, 0, 1, 'R');

        if ($recibo->descuentos->porcentaje != 0) {
            $pdf->Cell(0, 10, '        Descuento  ', 0, 0, 'C');
            $pdf->Cell(0, 10, $recibo->descuentos->porcentaje . ' % ' . $recibo->monto . '0 ' . $recibo->moneda, 0, 1, 'R');
        }

        if ($recibo->cuenta != null) {

            $pdf->Cell(0, 10, ' Cuenta ', 0, 0, 'C');
            $pdf->Cell(0, 10, $recibo->cuenta . '.00 ' . $recibo->moneda, 0, 1, 'R');

            $pdf->Cell(0, 10, 'Saldo ', 0, 0, 'C');
            $saldo = number_format($recibo->saldo, 2); // Formatea el monto con dos decimales
            $pdf->Cell(0, 10, $saldo . '  ' . $recibo->moneda, 0, 1, 'R');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
        } else {

            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
            $pdf->Cell(0, 10, '', 0, 2, 'L');
        }

        if ($recibo->descuentos->porcentaje == 0) {
            $pdf->Cell(0, 10, '', 0, 2, 'L');
        }

        if ($recibo->cuenta != null) {
            $montoliteral = $formatter->format($recibo->cuenta);
            $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFillColor(0, 170, 35);
            $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);
            $cuenta = number_format($recibo->cuenta, 2); // Formatea el monto con dos decimales
            $pdf->Cell(0, 10, $cuenta . ' ' . $recibo->moneda, 0, 1, 'R', 1);
            $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
        } else {
            $montoliteral = $formatter->format($recibo->monto);
            $pdf->Line(10, $pdf->getY(), $pdf->getPageWidth() - 10, $pdf->getY());
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFillColor(0, 170, 35);
            $pdf->Cell(0, 10, 'TOTAL ', 0, 0, 'C', 1);

            $amount = number_format($recibo->monto, 2); // Formatea el monto con dos decimales
            $pdf->Cell(0, 10, $amount . ' ' . $recibo->moneda, 0, 1, 'R', 1);

            $pdf->Cell(0, 10, ucwords($montoliteral) . ' ' . $recibo->moneda, 0, 1, 'R', 1);
        }

        $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);

        // Agregar marca de agua (logo)
        $logoPath = 'img/logo50.png';
        $pdf->Image($logoPath, 50, 120, 100, 0, 'PNG');

        $cabecera = 'img/cabecera.png';
        $pdf->Image($cabecera, 0, 0, $pdf->getPageWidth(), 0, 'PNG');

        $pie = 'img/pie.png';
        $pdf->Image($pie, 0, 208, $pdf->getPageWidth(), 0, 'PNG');

        // CREANDO VOUCHER


        $pdf->AddPage(); // Agregar una página
        $pdf->SetTextColor(0, 0, 0); // Establece el color del texto en negro
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, '', 0, 2, 'L');
        $pdf->Cell(0, 10, 'FECHA: ' . $fecha, 0, 1, 'R');
        $pdf->Cell(0, 10, '', 0, 2, 'L');




        $pdf->Cell(0, 10, 'VOUCHER', 0, 1, 'C');

        $pdf->Line(10, $pdf->getPageHeight() - 10, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);
        //$pdf->Ln(8); 
        $pdf->SetX($pdf->GetX() + 40);
        $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 30, 'L');

        $pdf->SetX($pdf->GetX() - 40);
        $pdf->Cell(0, 10, 'Cliente:', 0, 0, 'L');
        $pdf->SetX($pdf->GetX() - 110);
        $pdf->Cell(0, 10, '+' . $recibo->empleados->whatsapp, 0, 0, 'C');
        $pdf->SetX($pdf->GetX() - 20);
        $pdf->Cell(0, 10, ucwords($recibo->empleados->nombre) . ' ' . ucwords($recibo->empleados->apellidopaterno), 0, 1, 'R');

        // linea horizontal
        $x1 = 125; // Ajusta el valor según tu necesidad
        $y1 = $pdf->getY(); // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
        $y2 = $pdf->getY(); // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

        $x1 = 7; // Ajusta el valor según tu necesidad
        $y1 = $pdf->getY() + 11; // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
        $y2 = $pdf->getY() + 11; // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

        $x1 = 7; // Ajusta el valor según tu necesidad
        $y1 =  230; // La línea comenzará en la posición actual de la página
        $x2 = $pdf->getPageWidth() - 10; // Ajusta el valor según tu necesidad
        $y2 =  230; // La línea terminará en la misma posición vertical que la inicial
        $pdf->Line($x1, $y1, $x2, $y2); // Dibuja la línea

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



        $pdf->Cell(0, 10, '- ' . ucwords($recibo->clientes->nombre) . ' ' . ucwords($recibo->clientes->apellido) . '  ' . $recibo->clientes->dni, 0, 0, 'L');
        $pdf->SetX($pdf->GetX() - 109);
        $pdf->Cell(0, 10, 'Confirmado por:', 0, 1, 'C');

        $pdf->Cell(0, 10, 'Servicios:', 0, 0, 'L');
        $pdf->SetX($pdf->GetX() - 121);
        $pdf->Cell(0, 10, 'No incluye:', 0, 1, 'C');
        $pdf->SetX($pdf->GetX() + 25);
        $pdf->SetFont('times', 'BU', 16); // B para negritas, U para subrayado
        if ($recibo->tours->ndia == 1) {

            $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DÍA ' . $recibo->tours->destino->nombre), 0, 0, 'L');
        } else {
            $pdf->Cell(0, 10, strtoupper($recibo->tours->ndia . ' DÍAS ' . $recibo->tours->destino->nombre), 0, 0, 'L');
        }
        $pdf->SetFont('times', ' ', 10);

        //$pdf->SetX($pdf->GetX() + 121);

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


        $elementos = explode('-', $recibo->tours->obs_include->descripcion);
        $html = '<ul>';
        foreach ($elementos as $elemento) {
            $cellX = 10; // Ajusta la posición X según tus necesidades
            $cellY = 120; // Ajusta la posición Y para que esté cerca del borde inferior
            $pdf->SetXY($cellX, $cellY);
            $html .= '<li>' . trim($elemento) . '</li>';
        }
        $html .= '</ul>';

        $pdf->writeHTML($html, true, 0, true, 0);
        //$pdf->Cell(0, 10, $recibo->tours->obs_include->descripcion, 0, 1, 'L');

        $pdf->SetFont('times', ' ', 12);
        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 185; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);
        if ($recibo->tours->ndia == 1) {
            $pdf->Cell(0, 10, 'Fecha de servicios: ' . $recibo->tours->ndia . ' día, solo el ' . $fecaxi, 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, 'Fecha de servicios: ' . $recibo->tours->ndia . ' días, ' . $fecaxi . ' a ' . $ffin, 0, 1, 'L');
        }

        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 200; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);
        if ($recibo->descripcion == null) {
            $pdf->Cell(0, 10, 'Observaciones: No hay ninguna observacion', 0, 1, 'L');
        } else {
            $pdf->Cell(0, 10, 'Observaciones: ' . $recibo->descripcion, 0, 1, 'L');
        }

        $cellX = 10; // Ajusta la posición X según tus necesidades
        $cellY = 215; // Ajusta la posición Y para que esté cerca del borde inferior
        $pdf->SetXY($cellX, $cellY);
        $pdf->Cell(0, 10, 'Forma de pago: El cliente pago mediante ' . $recibo->metodo, 0, 1, 'L');

        $voucher = 'img/voucher.png';
        $posX = 0; // Ajusta este valor para mover la imagen hacia la derecha
        $posY = 0; // Ajusta este valor para mover la imagen hacia abajo

        // Tamaño de la imagen ajustado al tamaño carta (Letter)
        $anchoImagen = 220; // Ancho en milímetros (aproximadamente 21.59 cm)
        $altoImagen = 280;  // Alto en milímetros (aproximadamente 27.94 cm)

        $pdf->Image($voucher, $posX, $posY, $anchoImagen, $altoImagen, 'PNG');
        $pdf->Image('@' . $qrImage, 159, 188, 40, 40, 'PNG');
    
        // TEXTO DEL PDF
        $pdf->Output('Recibo ' . $recibo->clientes->nombre . ' ' . $recibo->clientes->apellido . ' de ' . $fecha . '.pdf', 'I');

        return redirect('recibos');
    }

    public function edit(Recibos $recibo)
    {
        $descuentos = Descuento::all();
        $tours = Tours::pluck('destino_id', 'id');
        $tours = Tours::with('destino')->get();
        return view('administrador.recibos.edit', compact('recibo', 'tours', 'descuentos'));
    }


    public function update(Request $request, Recibos $recibo)
    {
        $tour_id = $request->input('tour_id');
        list($id, $ndia) = explode('|', $tour_id);
        $tourf = $id;


        // Ahora creamos la reserva asociada a ese cliente
        $finicio = Carbon::parse($request->finicio); //combertiondo el date de obejto strin 
        $fecaxi = $request->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($ndia - 1);

        //calculando el monto a cobrar 
        // Obtener los datos del formulario
        $tourId = $request->input('tour_id');
        $descuentoId = $request->input('descuento_id');

        // Obtener el registro del tour y el descuento correspondientes
        $tour = Tours::find($tourId);
        $descuento = Descuento::find($descuentoId);

        // Calcular el monto utilizando el precio y el porcentaje
        $precio = $tour->precio;
        $porcentaje = $descuento->porcentaje;
        $monto = $precio - ($precio * ($porcentaje / 100));


        $recibo->finicio = $fecaxi;
        $recibo->ffin = $ffin;
        $recibo->metodo = $request->metodo;
        $recibo->descuento_id = $request->descuento_id;

        $recibo->estado = $request->estado;
        $recibo->tour_id = $tourf;
        $recibo->monto = $monto;

        $recibo->save();
        return redirect('recibos');
    }


    public function destroy(Recibos $recibo)
    {
        $recibo->delete();
        return redirect('recibos')->with('eliminar', 'ok');
    }
}
