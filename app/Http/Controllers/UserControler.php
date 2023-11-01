<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Cargo;
use App\Models\Empleados;
use App\Models\N_jerarquico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role; //para los roles

class UserControler extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:usuarios.index')->only('index');
    //     $this->middleware('can:usuarios.create')->only('create', 'store');
    //     $this->middleware('can:usuarios.edit')->only('edit', 'update');
    //     $this->middleware('can:usuarios.destroy')->only('destroy');
    // }

    public function index()
    {
        //lista de usuarios que van a usar el sistemas
        $usuarios = User::all();
        return view('administrador.usuarios.index', compact('usuarios'));
        
    }

    public function create()
    {
        $empleados = Empleados::all();
        return view('administrador.usuarios.create', compact('empleados'));
    }

    public function store(StoreUserRequest $request)
    { 
        $id = $request->empleado_id;
        // Validar los datos del formulario
        $empleados = Empleados::find($id);

        // Realizar la transformación de los datos
        $apellidopaterno = ucfirst($empleados->apellidopaterno);
        $dni = $empleados->dni;
        $fnacimiento = date('Y-m-d', strtotime($empleados->fnacimiento));

        $usuario = ucfirst($empleados->nombre) . ' ' . ucfirst($empleados->apellidopaterno);
        $password = substr($apellidopaterno, 0, 2) . substr($dni, 0, 3) . substr($apellidopaterno, 2) . date('d', strtotime($fnacimiento));

        // Crear un nuevo usuario con los datos transformados
        $user = new User([
            'name' => $usuario,
            'password' => Hash::make($password), // Aquí estamos hasheando la contraseña
            'email' => $request->email,
            'empleado_id' => $id,
        ]);

        // Guardar el usuario en la base de datos
        $user->save();
        $nJerarquico = $empleados->n_jerarquicos;

        if ($nJerarquico) {
            $rolName = $nJerarquico->nombre;
            $rol = Role::where('name', $rolName)->first();

            if ($rol) {
                $user->assignRole($rol);
            }
        }
       
        return redirect('usuarios')->with('guardar', 'ok');
    }


    public function show(User $usuario)
    {
        $empleado = $usuario->empleado;
        return view('administrador.usuarios.show', compact('empleado'));
    }


    public function edit(User $usuario)
    {
        $roles = Role::all();
        return view('administrador.usuarios.edit', compact('usuario', 'roles'));
    }


    public function update(Request $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);
        return redirect('usuarios')->with('guardar', 'ok');
    }


    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect('usuarios')->with('eliminar', 'ok');
    }
}
