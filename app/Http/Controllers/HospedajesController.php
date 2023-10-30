<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHospedajesRequest;
use App\Http\Requests\UpdateHospedajesRequest;
use App\Models\Hospedajes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HospedajesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:hospedajes.index')->only('index');
        $this->middleware('can:hospedajes.create')->only('create', 'store');
        $this->middleware('can:hospedajes.edit')->only('edit', 'update');
        $this->middleware('can:hospedajes.destroy')->only('destroy');
    }
     
    public function index()
    {
        $hospedajes = Hospedajes::all();
        return view('administrador.hospedajes.index',compact('hospedajes'));
    }

     
    public function create()
    {
        return view('administrador.hospedajes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHospedajesRequest $request)
    {
        $hospedaje =  hospedajes::create($request->all());
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('hospedajes'); //el nombre de la carpeta public
            $hospedaje->foto = $foto;
        }
        
        $hospedaje->save();
        return redirect('hospedajes')->with('guardar', 'ok');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospedajes $hospedaje)
    {
        return view('administrador.hospedajes.show', compact('hospedaje'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospedajes $hospedaje)
    {
        return view('administrador.hospedajes.edit', compact('hospedaje')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHospedajesRequest $request, Hospedajes $hospedaje)
    {
        $validated = $request->validated(); 
        $hospedaje->update($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('hospedajes'); //el nombre de la carpeta public
            $hospedaje->foto = $foto;
        }
        $hospedaje->save();
        return  redirect('/hospedajes')->with('editar', 'ok');
    }

     
    public function destroy(Hospedajes $hospedaje)
    {
        // Obtener el nombre de la imagen del producto a eliminar
    $imagen = $hospedaje->foto;

    // Eliminar la imagen de la carpeta
    Storage::delete('public/hospedajes/' . $imagen);

    // Eliminar el producto de la base de datos
    $hospedaje->delete();

    return redirect('hospedajes')->with('eliminar', 'ok');
    }
}
