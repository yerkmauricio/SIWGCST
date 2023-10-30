<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:areas.index')->only('index');
        $this->middleware('can:areas.create')->only('create', 'store');
        $this->middleware('can:areas.edit')->only('edit', 'update');
        $this->middleware('can:areas.destroy')->only('destroy');
    }
    public function index()
    {
        $areas = area::all();
        return view('administrador.areas.index',compact('areas'));
    }
    
    public function create()
    {
        return view('administrador.areas.create');
    }
   
    public function store(StoreAreaRequest $request)
    {
        $area =  area::create($request->all());
        $area->estado = 1;
        $area->save();
        return redirect('areas')->with('guardar', 'ok');
    }
    
    public function edit(Area $area)
    {
        return view('administrador.areas.edit', compact('area'));
    }
     
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $validated = $request->validated(); 
        $area->update($request->all());
        $area->save();
        return  redirect('/areas')->with('editar', 'ok');
    }
     
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('areas')->with('eliminar', 'ok');
    }
}
