<?php

namespace App\Http\Controllers;

use App\Models\Obs_include;
use App\Http\Requests\StoreObs_includeRequest;
use App\Http\Requests\UpdateObs_includeRequest;

class ObsIncludeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:obs_includes.index')->only('index');
        $this->middleware('can:obs_includes.create')->only('create', 'store');
        $this->middleware('can:obs_includes.edit')->only('edit', 'update');
        $this->middleware('can:obs_includes.destroy')->only('destroy');
    }
    public function index()
    {
        $obs_includes = obs_include::all();
        return view('administrador.obs_includes.index',compact('obs_includes'));
    }

     
    public function create()
    {
        return view('administrador.obs_includes.create');
    }

     
    public function store(StoreObs_includeRequest $request)
    {
        $obs_include =  obs_include::create($request->all());
        $obs_include->save();
        return redirect('obs_includes')->with('guardar', 'ok');
    }
     
    public function edit(Obs_include $obs_include)
    {
       return view('administrador.obs_includes.edit', compact('obs_include'));
    }

    public function update(UpdateObs_includeRequest $request, Obs_include $obs_include)
    {
        $validated = $request->validated(); 
        $obs_include->update($request->all());
        $obs_include->save();
        return  redirect('/obs_includes')->with('editar', 'ok');
    }

    
    public function destroy(Obs_include $obs_include)
    {
    // Eliminar el producto de la base de datos
    $obs_include->delete();
    return redirect('obs_includes')->with('eliminar', 'ok');
    }
}
