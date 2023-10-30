<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientesRequest;
use App\Http\Requests\StoreEmpleadosRequest;
use App\Http\Requests\UpdateClientesRequest;
use App\Http\Requests\UpdateEmpleadosRequest;
use App\Models\Alimentos;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{

    public function __construct() 
    {
        $this->middleware('can:clientes.index')->only('index');
        $this->middleware('can:clientes.create')->only('create', 'store');
        $this->middleware('can:clientes.edit')->only('edit', 'update');
        $this->middleware('can:clientes.destroy')->only('destroy');
    }
    public function index()
    {
        $clientes = clientes::all();
        return view('administrador.clientes.index', compact('clientes'));
    }

    public function create()
    {
        $nombre = Session::get('nombre');
        Session::put('nom', $nombre);

        $apellido = Session::get('apellido');
        Session::put('ape', $apellido);

        $dni = Session::get('dni');
        Session::put('d', $dni);

        $finicio = Session::get('finicio');
        Session::put('fecha', $finicio);

        $tour_id = Session::get('tour_id');
        Session::put('tou', $tour_id);


        $npersona = Session::get('npersona');
        Session::put('npe', $npersona);

        $metodo = Session::get('metodo');
        Session::put('met', $metodo);

        $tipo = Session::get('tipo');
        Session::put('tip', $tipo);

        $descripcion = Session::get('descripcion');
        Session::put('obs', $descripcion);
         

        $moneda = Session::get('moneda');
        Session::put('mon', $moneda);

        $idioma = Session::get('idioma');
        Session::put('idi', $idioma);

        $cuenta = Session::get('cuenta');
        Session::put('cue', $cuenta);

        $descuento_id = Session::get('descuento_id');
        Session::put('des', $descuento_id);

        //dd($nombre, $apellido, $dni, $finicio, $tour_id, $npersona, $metodo, $descuento_id);
        $alimentos = Alimentos::pluck('nombre', 'id');
        return view('administrador.clientes.create', compact('alimentos', 'nombre', 'apellido', 'dni'));
    }


    public function store(StoreClientesRequest $request)
    {
        $fecha = Session::get('fecha');
        $tou = Session::get('tou');
        $nom = Session::get('nom');
        $ape = Session::get('ape');
        $d = Session::get('d');

        $npe = Session::get('npe');
        $des = Session::get('des');

        $met = Session::get('met');
        $tip = Session::get('tip');
        $obs = Session::get('obs');
        $tou = Session::get('tou');
        $mon = Session::get('mon');
        $cue = Session::get('cue');
        $idi = Session::get('idi');

        //dd($request, $met, $tou,$des);
        $clienteData = $request->all();
        if ($idi == null) {
            $clienteData['nviaje'] = 0; 
        } else {
            $clienteData['nviaje'] = 1; 
        }
 
        $cliente =  clientes::create($clienteData);

        if ($tou == null) { // verifica si $tou es nulo
            
            $cliente->save();
            return redirect('clientes')->with('guardar', 'ok');
        } else {
           
            if ($met == null) { //verifica si $met es nulo
                //esto es de recerva
                return redirect()->route('reservas.create')
                    ->with('nom', $nom)
                    ->with('ape', $ape)
                    ->with('d', $d)
                    ->with('fecha', $fecha)
                    ->with('tou', $tou)
                    ->with('tip', $tip)
                    ->with('cliente_id', $cliente->id);
            } else {
                //esto es de recibo

                return redirect()->route('recibos.create')
                    ->with('nom', $nom)
                    ->with('ape', $ape)
                    ->with('d', $d)
                    ->with('fecha', $fecha)
                    ->with('tou', $tou)
                    ->with('npe', $npe)
                    ->with('met', $met)
                    ->with('des', $des)
                    ->with('mon', $mon)
                    ->with('tip', $tip)
                    ->with('cue', $cue)
                    ->with('idi', $idi)
                    ->with('obs', $obs)
                    ->with('cliente_id', $cliente->id);
            }
        }
    }

    public function show(Clientes $cliente)
    {
        return view('administrador.clientes.show', compact('cliente'));
    }

    public function edit(Clientes $cliente)
    {
        $alimentos = Alimentos::pluck('nombre', 'id');
        return view('administrador.clientes.edit', compact('cliente', 'alimentos')); //tiene que estar segun lo enviado *
    }


    public function update(UpdateClientesRequest $request, Clientes $cliente)

    {
        $cliente->update($request->all());
        $cliente->save();
        return  redirect('/clientes')->with('editar', 'ok'); //redirecciona a la vista principal
    }


    public function destroy(Clientes $cliente)
    {
        $cliente->delete();
        return redirect('clientes')->with('eliminar', 'ok');
    }
}
