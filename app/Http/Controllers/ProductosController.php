<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductosRequest;
use App\Http\Requests\UpdateProductosRequest;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.create')->only('create', 'store');
        $this->middleware('can:productos.edit')->only('edit', 'update');
        $this->middleware('can:productos.destroy')->only('destroy');
    }
    public function index()
    {
        $productos = Productos::all();
        return view('administrador.productos.index',compact('productos'));
    }

    
    public function create()
    {
        return view('administrador.productos.create');
    }

    
    public function store(StoreProductosRequest $request)
    {
        $producto =  productos::create($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('productos'); //el nombre de la carpeta public
            $producto->foto = $foto;
        }
        $producto->save();
        return redirect('productos')->with('guardar', 'ok');
    }

    
    public function show(Productos $producto)
    {
        return view('administrador.productos.show', compact('producto'));
    }

    public function edit(Productos $producto)
    {
        return view('administrador.productos.edit', compact('producto'));
    }

    public function update(UpdateProductosRequest $request, Productos $producto)
    {
        $validated = $request->validated(); 
        $producto->update($request->all());
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('productos'); //el nombre de la carpeta public
            $producto->foto = $foto;
        }
        $producto->save();
        return  redirect('/productos')->with('editar', 'ok');
    }
 
    public function destroy(Productos $producto)
    {
        // Obtener el nombre de la imagen del producto a eliminar
    $imagen = $producto->foto;

    // Eliminar la imagen de la carpeta
    Storage::delete('public/productos/' . $imagen);

    // Eliminar el producto de la base de datos
    $producto->delete();

    return redirect('productos')->with('eliminar', 'ok');
    }
}
