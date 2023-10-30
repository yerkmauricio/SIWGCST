<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreEmpleadosRequest;
use App\Http\Requests\UpdateEmpleadosRequest;
use App\Models\Cargo;
use App\Models\Empleados;
use App\Models\N_jerarquico;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:empleados.index')->only('index');
        $this->middleware('can:empleados.create')->only('create', 'store');
        $this->middleware('can:empleados.edit')->only('edit', 'update');
        $this->middleware('can:empleados.destroy')->only('destroy');
    }
    public function index()
    {
        $empleados = Empleados::all();
        return view('administrador.empleados.index',compact('empleados'));
    }

    
    public function create()
    {
        $cargos = Cargo::pluck('nombre', 'id'); //llamando la variable de latabla alimento
        $n_jerarquicos = N_jerarquico::pluck('nombre', 'id');
        return view('administrador.empleados.create', compact('cargos','n_jerarquicos'));
    }

    public function store(StoreEmpleadosRequest $request)
    {
        
        $empleado =  Empleados::create($request->all()); 
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('empleados'); //el nombre de la carpeta public
            $empleado->foto = $foto;
        }

        $empleado->save();
        
        return redirect('empleados')->with('guardar', 'ok');
    }

    public function show(Empleados $empleado)// cambiar a singular 
    {
        
        return view('administrador.empleados.show', compact('empleado')); //,'cargos','n_jerarquicos'
        
    }

    
    public function edit(Empleados $empleado)//ojo estan reciviendo empleado y no esmpleados es es el proble 
    {
        $cargos = Cargo::pluck('nombre', 'id');
        $n_jerarquicos = N_jerarquico::pluck('nombre', 'id');
        return view('administrador.empleados.edit',compact('empleado','cargos','n_jerarquicos'));//tiene que estar segun lo enviado *
    }

  
    public function update(UpdateEmpleadosRequest $request, Empleados $empleado)//tienes que cambiareste request a updatenombrerequest
    {
        //tines que cambiar el valos de empleados a empleado
        $validated = $request->validated();
        $empleado->update($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('empleados'); //el nombre de la carpeta public
            $empleado->foto = $foto;
        }
        $empleado->save();
        return  redirect('/empleados')->with('editar','ok');//redirecciona a la vista principal
    }

     
    public function destroy(Empleados $empleado)
    {
        $empleado->delete();
        return redirect('empleados')->with('eliminar','ok');
    }
}
