<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDestinosRequest;
use App\Http\Requests\UpdateDestinosRequest;
use App\Models\Destinos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:destinos.index')->only('index');
        $this->middleware('can:destinos.create')->only('create', 'store');
        $this->middleware('can:destinos.edit')->only('edit', 'update');
        $this->middleware('can:destinos.destroy')->only('destroy');
    }
    public function index()
    {
        $destinos = destinos::all();
        return view('administrador.destinos.index',compact('destinos'));
    }

    public function create()
    {
       return view('administrador.destinos.create');
    }

    public function store(StoreDestinosRequest $request)
    {
        $destino =  Destinos::create($request->all());
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('destinos'); //el nombre de la carpeta public
            $destino->foto = $foto;
        }
        $destino->save();
        return redirect('destinos')->with('guardar', 'ok');
    }

     
    public function show(Destinos $destino)
    {
        return view('administrador.destinos.show', compact('destino'));
    }

      
    public function edit(Destinos $destino)
    {
        return view('administrador.destinos.edit', compact('destino'));
    }

    public function update(UpdateDestinosRequest $request, Destinos $destino)
    {
        $validated = $request->validated(); 
        $destino->update($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('destinos'); //el nombre de la carpeta public
            $destino->foto = $foto;
        }
        $destino->save();
        return  redirect('/destinos')->with('editar', 'ok');
    }

    
    public function destroy(Destinos $destino)
    {
        // Obtener el nombre de la imagen del producto a eliminar
    $imagen = $destino->foto;

    // Eliminar la imagen de la carpeta
    Storage::delete('public/destinos/' . $imagen);

    // Eliminar el producto de la base de datos
    $destino->delete();
    return redirect('destinos')->with('eliminar', 'ok');
    }
}
