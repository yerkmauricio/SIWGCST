<?php

namespace App\Http\Controllers;

use App\Models\Alimentos;
use App\Models\Clientes;
use App\Models\Empleados;
use App\Models\Recibos;
use App\Models\Tours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;
use App\Exports\ToursExport;
use App\Exports\ReciboExport;
use App\Models\Destinos;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:estadisticas.index')->only('index');
        $this->middleware('can:estadisticas.create')->only('create', 'store');
        $this->middleware('can:estadisticas.edit')->only('edit', 'update');
        $this->middleware('can:estadisticas.destroy')->only('destroy');
    }
    public function index()
    {
        $recibos = Recibos::all();
        $tours = Tours::all();
        $empleados = Empleados::all();
        $clientes = Clientes::all();
        $reservas = Reserva::all();

        $alimentoIdMasComun = $clientes->groupBy('alimento_id')->map->count()->sortDesc()->keys()->first();
        $alimentoMasComun = Alimentos::find($alimentoIdMasComun)->nombre;

        $fechaActual = Carbon::now();
        $fechas = [];

        // grafico genero
        $masculinos = [];
        $femeninos = [];
        for ($i = 3; $i >= 0; $i--) {
            $fecha = $fechaActual->copy()->subMonths($i);
            $fechas[] = $fecha->format('M Y');
            $masculinos[] = Clientes::where('genero', 1)
                ->whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->count();
            $femeninos[] = Clientes::where('genero', 0)
                ->whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->count();
        }
        // clientes registrados por mes 
        $clientesRegistrados = [];
        $fechasClientesRegistrados = [];

        for ($i = 3; $i >= 0; $i--) {
            $fecha = $fechaActual->copy()->subMonths($i);
            $fechasClientesRegistrados[] = $fecha->format('M Y');
            $clientesRegistrados[] = Clientes::whereYear('created_at', $fecha->year)
                ->whereMonth('created_at', $fecha->month)
                ->count();
        }
        // tour
        $cantot = $tours->count(); //cantidad de tours

        $cantouid = $recibos->groupBy('tour_id')->map->count()->sortDesc()->keys()->first();
        $cantou = Destinos::find($cantouid)->nombre; //destino mas comun

        $horario = $tours->groupBy('hinicio')->map->count();
        $horcom = $horario->sortDesc()
            ->keys()
            ->first(); //tour mas comun

        // En tu controlador

        $fechaActual = Carbon::now();
        $fechaHace4Meses = $fechaActual->copy()->subMonths(4);

        $tours = Recibos::where('created_at', '>=', $fechaHace4Meses)
            ->groupBy('tour_id')
            ->select('tour_id', DB::raw('count(*) as cantidad'))
            ->get();
        $tourIds = $tours->pluck('tour_id')->toArray();
        $tourNombres = Tours::whereIn('tours.id', $tourIds)
            ->leftJoin('destinos as d', 'd.id', '=', 'tours.destino_id')
            ->pluck('d.nombre', 'tours.id')
            ->toArray();

        $labels = [];
        $data = [];

        foreach ($tours as $tour) {
            $labels[] = $tourNombres[$tour->tour_id];
            $data[] = $tour->cantidad;
        }
        // recibo
        $fechasMontos = [];

        // Genera las etiquetas de los últimos 4 meses
        for ($i = 3; $i >= 0; $i--) {
            $fecha = $fechaActual->copy()->subMonths($i);
            $fechasMontos[] = $fecha->format('F Y');
        }
        
        $montosTotales = Recibos::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(monto) as monto')
        )
            ->where('created_at', '>=', $fechaHace4Meses)
            ->groupBy('year', 'month')
            ->get();
        
        $montos = [];
        
        // Procesa los resultados para estructurar los datos necesarios para el gráfico
        foreach ($fechasMontos as $fechaEtiqueta) {
            $fecha = Carbon::createFromFormat('F Y', $fechaEtiqueta);
        
            $montoTotal = $montosTotales
                ->where('year', $fecha->year)
                ->where('month', $fecha->month)
                ->first();
        
            // Si se encuentra un monto total para la etiqueta, agrega el monto; de lo contrario, agrega 0.
            $montos[] = $montoTotal ? $montoTotal->monto : 0;
        }
        // dd($montos);

        return view('administrador.estadisticas.index', compact('fechasMontos', 'montos', 'reservas', 'labels', 'data', 'cantot', 'cantou', 'horcom', 'recibos', 'tours', 'empleados', 'clientes', 'alimentoMasComun', 'masculinos', 'femeninos', 'fechas', 'clientesRegistrados', 'fechasClientesRegistrados'));
    }


    public function create(Request $request)
    {
        $clave = $request->input('clave');
        // dd($clave);

        if ($clave == 1) {
            return Excel::download(new ClientesExport, 'clientes.xlsx');
        } else {
            if ($clave == 2) {
                  return Excel::download(new ToursExport, 'Tours.xlsx');
            } else {
                return Excel::download(new ReciboExport, 'Recibos.xlsx');
            } 
           
        }
    }

    
}
