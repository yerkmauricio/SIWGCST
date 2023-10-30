<?php

namespace App\Http\Controllers;

use App\Models\Foto_tour;
use App\Http\Requests\StoreFoto_tourRequest;
use App\Http\Requests\UpdateFoto_tourRequest;
use App\Models\Destinos;

class FotoTourController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:foto_tours.index')->only('index');
        $this->middleware('can:foto_tours.create')->only('create', 'store');
        $this->middleware('can:foto_tours.edit')->only('edit', 'update');
        $this->middleware('can:foto_tours.destroy')->only('destroy');
    }
    public function index()
    {
        $foto_tours = foto_tour::all();
        return view('administrador.foto_tours.index', compact('foto_tours'));  
    }

     
    public function create()
    {
        $destinos = Destinos::pluck('nombre', 'nombre');
        return view('administrador.foto_tours.create', compact('destinos'));
    }

    
    public function store(StoreFoto_tourRequest $request)
    {
       
        $foto_tour =  foto_tour::create($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_tours'); //el nombre de la carpeta public
            $foto_tour->foto = $foto;
        }

        $foto_tour->save();
        return redirect('foto_tours')->with('guardar', 'ok');
    }

    public function edit(Foto_tour $foto_tour)
    {
        return view('administrador.foto_tours.edit', compact('foto_tour'));
    }

     
    public function update(UpdateFoto_tourRequest $request, Foto_tour $foto_tour)
    {
         
        $foto_tour->update($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_tours'); //el nombre de la carpeta public
            $foto_tour->foto = $foto;
        }
        
        $foto_tour->save();
        return  redirect('/foto_tours')->with('editar', 'ok');
    }

    public function destroy(Foto_tour $foto_tour)
    {
        $foto_tour->delete();
        return redirect('foto_tours')->with('eliminar', 'ok');
    }
}
