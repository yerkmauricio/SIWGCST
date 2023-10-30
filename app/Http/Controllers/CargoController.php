<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Area;
use App\Models\N_jerarquico;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:cargos.index')->only('index');
        $this->middleware('can:cargos.create')->only('create', 'store');
        $this->middleware('can:cargos.edit')->only('edit', 'update');
        $this->middleware('can:cargos.destroy')->only('destroy');
    }
    public function index()
    {
        $cargos = Cargo::all();
        return view('administrador.cargos.index',compact('cargos'));
    }

     
    public function create()
    {
        $areas = Area::pluck('nombre','id');
        $n_jerarquicos = N_jerarquico::pluck('nombre','id');
        return view('administrador.cargos.create', compact('areas','n_jerarquicos'));
    }

    
    public function store(StoreCargoRequest $request)
    {
        $cargo =  Cargo::create($request->all()); 
        return redirect('cargos');
    }
     
    public function edit(Cargo $cargo)
    {
        return view('administrador.cargos.edit',compact('cargo'));
    }

     
    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        $validated = $request->validated();
        $cargo->update($request->all());
        $cargo->save();
        return  redirect('/cargos')->with('editar', 'ok');
    }

    
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return redirect('cargos')->with('eliminar','ok');
    }
}
