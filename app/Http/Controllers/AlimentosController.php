<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlimentoRequest;
use App\Http\Requests\UpdateAlimentoRequest;
use App\Models\Alimentos;
use Illuminate\Http\Request;

class AlimentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:alimentos.index')->only('index');
        $this->middleware('can:alimentos.create')->only('create', 'store');
        $this->middleware('can:alimentos.edit')->only('edit', 'update');
        $this->middleware('can:alimentos.destroy')->only('destroy');
    }
    public function index()
    {
        $alimentos = Alimentos::all();
        return view('administrador.alimentos.index', compact('alimentos'));
    }
     
    public function create()
    {
        return view('administrador.alimentos.create');
    }

    public function store(StoreAlimentoRequest $request)
    {
        $alimento =  Alimentos::create($request->all());
        $alimento->save();
        return redirect('alimentos')->with('guardar', 'ok');
    }

    public function show(Alimentos $alimentos)
    {
        
    }
   
    public function edit(Alimentos $alimento)
    {
        return view('administrador.alimentos.edit', compact('alimento'));
    }
   
    public function update(UpdateAlimentoRequest $request, Alimentos $alimento)
    {
        $validated = $request->validated();
        $alimento->update($request->all());
        $alimento->save();
        return  redirect('/alimentos')->with('editar', 'ok');
    }

    public function destroy(Alimentos $alimento)
    {
        // Eliminar el producto de la base de datos
        $alimento->delete();
        return redirect('alimentos')->with('eliminar', 'ok');
    }
}
