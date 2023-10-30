<?php

namespace App\Http\Controllers;

use App\Models\N_jerarquico;
use App\Http\Requests\StoreN_jerarquicoRequest;
use App\Http\Requests\UpdateN_jerarquicoRequest;

// usando los permisos 1
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class NJerarquicoController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:n_jerarquicos.index')->only('index');
        $this->middleware('can:n_jerarquicos.create')->only('create', 'store');
        $this->middleware('can:n_jerarquicos.edit')->only('edit', 'update');
        $this->middleware('can:n_jerarquicos.destroy')->only('destroy');
    }
    public function index()
    {
        $n_jerarquicos = N_jerarquico::all();
        return view('administrador.n_jerarquicos.index', compact('n_jerarquicos'));
    }


    public function create()
    {
        $permissions = Permission::all(); //añadiendo para el persmiso 2
        return view('administrador.n_jerarquicos.create', compact('permissions'));
    }


    public function store(StoreN_jerarquicoRequest $request)
    {
        $nJerarquico = N_Jerarquico::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'n_orden' => $request->n_orden,
        ]);

        // Crea un nuevo rol basado en el nombre del nivel jerárquico
        $rolNombre = str::slug($nJerarquico->nombre); // Convierte el nombre en un slug
        $rol = Role::create(['name' => $rolNombre]);

        // Asigna los permisos seleccionados al rol
        $permissions = $request->input('permissions', []);
        $permissions = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
        $rol->givePermissionTo($permissions);

        return redirect()->route('n_jerarquicos.index')
            ->with('success', 'Nivel jerárquico creado con éxito.');
    }

    public function edit(N_jerarquico $n_jerarquico)
    {
        $permissions = Permission::all(); //añadiendo para el persino 6
        $roles = Role::get(); // Obtén todos los roles disponibles en tu aplicación

        $selectedRole = Role::where('name', Str::slug($n_jerarquico->nombre))->first();

        $selectedPermissions = [];

        if ($selectedRole) {
            $selectedPermissions = $selectedRole->permissions; // Esto debe ser una colección de objetos de permisos
        }
        //dd($selectedPermissions);
        return view('administrador.n_jerarquicos.edit', compact('n_jerarquico', 'roles', 'permissions','selectedPermissions'));
    }


    public function update(UpdateN_jerarquicoRequest $request, N_jerarquico $n_jerarquico)
    {

        $n_jerarquico->nombre = $request->input('nombre');
        $n_jerarquico->descripcion = $request->input('descripcion');
        $n_jerarquico->n_orden = $request->input('n_orden');

        // Guarda los cambios en el modelo
        $n_jerarquico->save();

        // Actualiza los permisos del rol
        $rolNombre = Str::slug($n_jerarquico->nombre);

        $rol = Role::findByName($rolNombre);

        // Actualiza los permisos del rol
        $permisosSeleccionados = $request->input('permissions', []);

        $todosLosPermisos = Permission::all();

        foreach ($todosLosPermisos as $permiso) {
            if (in_array($permiso->id, $permisosSeleccionados)) {
                $rol->givePermissionTo($permiso);
            } else {
                $rol->revokePermissionTo($permiso);
            }
        }

        return redirect()->route('n_jerarquicos.index')->with('success', 'Nivel jerárquico actualizado correctamente');
    }


    public function destroy(N_jerarquico $n_jerarquico)
    {
        $n_jerarquico->delete();
        return redirect('n_jerarquicos')->with('eliminar', 'ok');
    }
}
