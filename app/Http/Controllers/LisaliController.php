<?php

namespace App\Http\Controllers;

use App\Models\Lisali;
use App\Http\Requests\StoreLisaliRequest;
use App\Http\Requests\UpdateLisaliRequest;
use App\Models\Alimentos;
use App\Models\Productos;
use Illuminate\Http\Request;

class LisaliController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:lisalis.index')->only('index');
        $this->middleware('can:lisalis.create')->only('create', 'store');
        $this->middleware('can:lisalis.edit')->only('edit', 'update');
        $this->middleware('can:lisalis.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        $search = $request->input('search'); // Obtener la palabra clave ingresada por el usuario
    
        $alimentos = Alimentos::pluck('nombre', 'id');
        $muestras = Alimentos::all();
        
        $lisalis = Lisali::with('alimento', 'producto')
            ->where('nombre', 'LIKE', "%$search%")
            ->orWhereHas('alimento', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%$search%");
            })
            ->orWhereHas('producto', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%$search%");
            })
            ->get();


        return view('administrador.lisalis.index', compact('lisalis', 'search', 'alimentos','muestras'));
    }

    public function admin()
    {
        $lisalis = Lisali::all();
        return view('administrador.lisalis.admin', compact('lisalis'));
    }

    public function create()
    {
        $alimentos = Alimentos::pluck('nombre', 'id'); //llamando la variable de latabla alimento
        $productos = Productos::pluck('nombre', 'id');
        $productos = Productos::select('id', 'nombre', 'foto')->get(); // Obtener los productos con la columna 'foto'
        return view('administrador.lisalis.create', compact('alimentos', 'productos'));
    }


    public function store(StoreLisaliRequest $request)
    {
        $selpro = $request->input('productos_seleccionados');
        $nombre = $request->input('nombre');
        $alimento_id = $request->input('alimento_id');

        for ($i = 0; $i < count($selpro); $i++) {
            $producto_id = $selpro[$i];

            $lisali = new Lisali();
            $lisali->nombre = $nombre;
            $lisali->alimento_id = $alimento_id;
            $lisali->producto_id = $producto_id;
            $lisali->save();
        }

        return redirect()->route('lisalis.admin')->with('guardar', 'ok');
    }


    public function show(Lisali $lisali)
    {
        return view('administrador.lisalis.lista', compact('lisali'));
    }

    public function destroy(Lisali $lisali)
    {
        $lisali->delete();
        return redirect()->route('lisalis.admin')->with('eliminar', 'ok');
    }
}
