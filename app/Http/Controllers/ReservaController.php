<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Models\Clientes;
use App\Models\Tours;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon; //para el uso de las fechas 

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reservas.index')->only('index');
        $this->middleware('can:reservas.create')->only('create', 'store');
        $this->middleware('can:reservas.edit')->only('edit', 'update');
        $this->middleware('can:reservas.destroy')->only('destroy');
    }
    public function index()
    {
        $reservas = Reserva::all();
        return view('administrador.reservas.index', compact('reservas'));
    }


    public function create()
    {
        $nom = Session::get('nom');
        $ape = Session::get('ape');
        $d = Session::get('d');
        $fecha = Session::get('fecha');
        $tip = Session::get('tip');
        $tou = Session::get('tou');

        $tours = Tours::pluck('destino_id', 'id');
        $tours = Tours::with('destino')->get(); //llamando el nombre
        return view('administrador.reservas.create', compact('tours', 'tou', 'fecha', 'nom', 'ape', 'd','tip'));
    }


    public function store(StoreReservaRequest $request)
    {

        $cliente = Clientes::where('nombre', $request->nombre) //verificando si hay cliente
            ->where('apellido', $request->apellido)
            ->where('dni', $request->dni)
            ->first();

        $tour_id = $request->input('tour_id');
        list($id, $ndia) = explode('|', $tour_id); //separando las variables 
        $tourId = $id;

        $empleadoId = auth()->user()->empleado_id;

        if (!$cliente) {
            return redirect()->route('clientes.create')
                ->with('nombre', $request->nombre)
                ->with('apellido', $request->apellido)
                ->with('dni', $request->dni)
                ->with('tipo', $request->tipo)        
                ->with('finicio', $request->finicio)
                ->with('empleado_id', $empleadoId)
                ->with('tour_id', $tourId);
        }

        // Ahora creamos la reserva asociada a ese cliente
        $finicio = Carbon::parse($request->finicio); //combertiondo el date de obejto strin 
        $fecaxi = $request->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($ndia - 1);

        $empleadoId = auth()->user()->empleado_id;

        $reserva = new Reserva([
            'finicio' => $fecaxi,
            'ffin' => $ffin,
            'tipo' => $request->tipo,
            'cliente_id' => $cliente->id, // Asociamos la reserva al cliente creado o existente
            'tour_id' => $tourId,
            'empleado_id' => $empleadoId,
        ]);

        $reserva->save();
        return redirect('reservas');
    }


    public function edit(Reserva $reserva)
    {
        $cal = request('cal');
        
        $clientes = Clientes::pluck('nombre', 'id');

        $tours = Tours::pluck('destino_id', 'id');
        $tours = Tours::with('destino')->get(); //llamando el nombre
        return view('administrador.reservas.edit', compact('reserva', 'clientes', 'tours', 'cal'));
    }


    public function update(UpdateReservaRequest $request, Reserva $reserva)
    {
        $tour_id = $request->input('tour_id');
        list($id, $ndia) = explode('|', $tour_id);  
        $tourId = $id;

        // Ahora creamos la reserva asociada a ese cliente
        $finicio = Carbon::parse($request->finicio); //combertiondo el date de obejto strin 
        $fecaxi = $request->finicio; //recuperando el finicio y no se modifique 
        $ffin = $finicio->addDays($ndia - 1);
        $reserva->finicio = $fecaxi;
        $reserva->ffin = $ffin;
        $reserva->estado = $request->estado;
        $reserva->tour_id = $tourId;

        $reserva->save();
        //dd($request->cal);
        if ($request->cal == 1 ) {
            return redirect('calendarios')->with('modificado', 'ok');
        } else {
            return redirect('reservas')->with('modificado', 'ok');
        }
        
        //return redirect('reservas');
    }


    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect('reservas')->with('eliminar', 'ok');
    }
}
