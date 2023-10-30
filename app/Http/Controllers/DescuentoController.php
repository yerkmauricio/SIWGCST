<?php

namespace App\Http\Controllers;

use App\Models\Descuento;
use App\Http\Requests\StoreDescuentoRequest;
use App\Http\Requests\UpdateDescuentoRequest;

class DescuentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:descuentos.index')->only('index');
        $this->middleware('can:descuentos.create')->only('create', 'store');
        $this->middleware('can:descuentos.edit')->only('edit', 'update');
        $this->middleware('can:descuentos.destroy')->only('destroy');
    }
    public function index()
    {
        $descuentos = Descuento::all();
        return view('administrador.descuentos.index', compact('descuentos'));
    }


    public function create()
    {
        return view('administrador.descuentos.create');
    }


    public function store(StoreDescuentoRequest $request)
    {
        $descuento =  Descuento::create($request->all());
        $descuento->save();
        return redirect('descuentos')->with('guardar', 'ok');
    }



    public function edit(Descuento $descuento)
    {
        return view('administrador.descuentos.edit', compact('descuento'));
    }


    public function update(UpdateDescuentoRequest $request, Descuento $descuento)
    {
        $validated = $request->validated();
        $descuento->update($request->all());
        $descuento->save();
        return  redirect('/descuentos')->with('editar', 'ok');
    }


    public function destroy(Descuento $descuento)
    {
        // Eliminar el producto de la base de datos
        $descuento->delete();
        return redirect('descuentos')->with('eliminar', 'ok');
    }
}
