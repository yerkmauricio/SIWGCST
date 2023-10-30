<?php

namespace App\Http\Controllers;

use App\Models\Obs_noinclude;
use App\Http\Requests\StoreObs_noincludeRequest;
use App\Http\Requests\UpdateObs_noincludeRequest;

class ObsNoincludeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:obs_noincludes.index')->only('index');
        $this->middleware('can:obs_noincludes.create')->only('create', 'store');
        $this->middleware('can:obs_noincludes.edit')->only('edit', 'update');
        $this->middleware('can:obs_noincludes.destroy')->only('destroy');
    }
    public function index()
    {
        $obs_noincludes = obs_noinclude::all();
        return view('administrador.obs_noincludes.index',compact('obs_noincludes'));
    }

    
    public function create()
    {
        return view('administrador.obs_noincludes.create');
    }

    
    public function store(StoreObs_noincludeRequest $request)
    {
        $obs_noinclude =  Obs_noinclude::create($request->all());
        $obs_noinclude->save();
        return redirect('obs_noincludes')->with('guardar', 'ok');
    }

    
     
    public function edit(Obs_noinclude $obs_noinclude)
    {
        return view('administrador.obs_noincludes.edit', compact('obs_noinclude'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObs_noincludeRequest $request, Obs_noinclude $obs_noinclude)
    {
        $validated = $request->validated(); 
        $obs_noinclude->update($request->all());
        $obs_noinclude->save();
        return  redirect('/obs_noincludes')->with('editar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obs_noinclude $obs_noinclude)
    {
        // Eliminar el producto de la base de datos
    $obs_noinclude->delete();
    return redirect('obs_noincludes')->with('eliminar', 'ok');
    }
}
