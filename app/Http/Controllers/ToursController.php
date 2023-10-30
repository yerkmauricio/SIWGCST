<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourCotizacionRequest;
use App\Http\Requests\StoreToursRequest;
use App\Http\Requests\UpdateToursRequest;
use App\Models\Alimentos;
use App\Models\Destinos;
use App\Models\Foto_tour;
use App\Models\Hospedajes;
use App\Models\Lisali;
use App\Models\Obs_include;
use App\Models\Obs_noinclude;
use App\Models\Tours;
use App\Models\Transporte;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    // metodo que retringe el ingreso de link manual
    public function __construct()
    {
        $this->middleware('can:tours.index')->only('index');
        $this->middleware('can:tours.create')->only('create', 'store');
        $this->middleware('can:tours.edit')->only('edit', 'update');
        $this->middleware('can:tours.destroy')->only('destroy');
    }

    public function index()
    {
        $tours = Tours::all();
        //dd($tours);
        return view('administrador.tours.index', compact('tours'));
    }


    public function create()
    {
        //llamando la variable de latabla alimento
        $cotizacion = 0;
        $destinos = Destinos::pluck('nombre', 'id');
        $alimentos = Alimentos::pluck('nombre', "id");
        $transportes = Transporte::pluck('nombre', 'id');
        $hospedajes = Hospedajes::pluck('nombre', 'id');
        $obs_includes = Obs_include::pluck('nombre', 'id');
        $obs_noincludes = Obs_noinclude::pluck('nombre', 'id');

        $foto_tours = Foto_tour::distinct()->get(['nombre', 'id']);

        //dd($foto_tours);
        $lisalis = Lisali::pluck('nombre', 'id');

        return view('administrador.tours.create', compact('lisalis', 'cotizacion', 'destinos', 'alimentos', 'transportes', 'hospedajes', 'obs_includes', 'obs_noincludes', 'foto_tours'));
    }
    public function cotizacion()
    {
        $cotizacion = 1;
        $destinos = Destinos::pluck('nombre', 'id');
        $alimentos = Alimentos::pluck('nombre', "id");
        $transportes = Transporte::pluck('nombre', 'id');
        $hospedajes = Hospedajes::pluck('nombre', 'id');
        $obs_includes = Obs_include::pluck('nombre', 'id');
        $obs_noincludes = Obs_noinclude::pluck('nombre', 'id');
        //$foto_tours = Foto_tour::select('nombre')->distinct()->pluck('nombre', 'nombre');
        $foto_tours = Foto_tour::distinct()->get(['nombre', 'id']);
        return view('administrador.tours.create', compact('cotizacion', 'destinos', 'alimentos', 'transportes', 'hospedajes', 'obs_includes', 'obs_noincludes', 'foto_tours'));
    }


    public function store(StoreToursRequest $request)
    {


        if ($request->cotizacion == 1) {
            $alimentoId = $request->alimento_id;
            $precioalimento = 0;

            // Ejecutar la consulta en la base de datos y obtener una colección
            $preali = Lisali::where('alimento_id', $alimentoId)->get();

            foreach ($preali as $lisali) {
                $precioalimento += $lisali->producto->precio;
            }
            $transporte_id = Transporte::find($request->transporte_id);
            $hospedaje_id = Hospedajes::find($request->hospedaje_id);

            $costofijo = 13;
            //calculando costo bariable

            $transporte = (($transporte_id->precio) / $request->personas);
            $guia = (($request->guia) / $request->personas) * ($request->ndia);
            $gastosextras = ($request->gastosextras);
            $hospedaje = ($hospedaje_id->precio) * ($request->ndia);
            $costovarible = $transporte + $guia + $gastosextras + $hospedaje + ($precioalimento * ($request->ndia));

            //calculando costo de venta
            $costoventa = $costovarible + $costofijo;

            //calculando precio de venta
            $precioventa =  $costoventa / (1 - (($request->utilidad) / 100));

            //calculando para un tour privado
            $tourprivado = ($costofijo + ($request->transporte->precio) + ($request->guia * ($request->ndia)) + $gastosextras +
                ($hospedaje  * ($request->ndia)) + ($precioalimento * ($request->ndia)))
                / (1 - (($request->utilidad) / 100));

            $tour = new tours();
            $tour->precio = $precioventa;

            $tour->precioprivado = $tourprivado;
            $tour->ndia = $request->input('ndia');
            $tour->dificultad = $request->input('dificultad');
            $tour->hinicio = $request->input('hinicio');
            $tour->hfin = $request->input('hfin');
            $tour->recomendaciones = $request->input('recomendaciones');
            $tour->llevar = $request->input('llevar');
            $tour->destino_id = $request->input('destino_id');
            $tour->lisali_id  = 5;
            $tour->transporte_id = $request->input('transporte_id');
            $tour->hospedaje_id = $request->input('hospedaje_id');
            $tour->obs_include_id = $request->input('obs_include_id');
            $tour->obs_noinclude_id = $request->input('obs_noinclude_id');
            $tour->foto_tour_id = $request->input('foto_tour_id');
            $tour->save();
            return redirect('tours')->with('guardar', 'ok');
        } else {
            // dd($request);
            $tour = Tours::create($request->all());

            $tour->save();
            return redirect('tours')->with('guardar', 'ok');
        }
    }



    public function show(Tours $tour)
    {
        $nombrefoto = $tour->foto_tour->nombre;
        
        // Obtén todos los registros de la tabla foto_tour con el mismo nombre
        $fotosRelacionadas = Foto_tour::where('nombre', $nombrefoto)->get();
        //dd($fotosRelacionadas);
        return view('administrador.tours.show', compact('tour', 'fotosRelacionadas'));
    }

    public function edit(Tours $tour)
    {
        return view('administrador.tours.edit', compact('tour'));
    }

    public function update(UpdateToursRequest $request, Tours $tour)
    {
        $tour->update($request->all());
        $tour->save();
        return  redirect('/tours')->with('editar', 'ok');
    }

    public function destroy(Tours $tour)
    {
        $tour->delete();
        return redirect('tours')->with('eliminar', 'ok');
    }
}
