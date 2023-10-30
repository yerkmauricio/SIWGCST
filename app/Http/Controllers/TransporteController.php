<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use App\Http\Requests\StoreTransporteRequest;
use App\Http\Requests\UpdateTransporteRequest;

class TransporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:transportes.index')->only('index');
        $this->middleware('can:transportes.create')->only('create', 'store');
        $this->middleware('can:transportes.edit')->only('edit', 'update');
        $this->middleware('can:transportes.destroy')->only('destroy');
    }
    public function index()
    {
        $transportes = Transporte::all();
        return view('administrador.transportes.index', compact('transportes'));
    }

    
    public function create()
    {
        return view('administrador.transportes.create');
    }

     
    public function store(StoreTransporteRequest $request)
    {
        $transporte =  Transporte::create($request->all());
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('transportes'); //el nombre de la carpeta public
            $transporte->foto = $foto;
        }
        $transporte->save();
        return redirect('transportes')->with('guardar', 'ok');
    }

    
    public function show(Transporte $transporte)
    {
        return view('administrador.transportes.show', compact('transporte'));
    }

    
    public function edit(Transporte $transporte)
    {
        return view('administrador.transportes.edit', compact('transporte'));
    }

     
    public function update(UpdateTransporteRequest $request, Transporte $transporte)
    {
        $validated = $request->validated(); 
        $transporte->update($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('transportes'); //el nombre de la carpeta public
            $transporte->foto = $foto;
        }
        $transporte->save();
        return  redirect('/transportes')->with('editar', 'ok');
    }

   
    public function destroy(Transporte $transporte)
    {
        $transporte->delete();
        return redirect('transportes')->with('eliminar', 'ok');
    }
}
