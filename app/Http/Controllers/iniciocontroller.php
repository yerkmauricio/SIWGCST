<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class iniciocontroller extends Controller
{
   
    public function login()
    {
        return view('auth.login');
    }
    // public function show()
    // {
    //     return view('pasante.listado');
    // }
    // public function tour()
    // {
    //     return view('administrador.tour');
    // }
    // public function welcome()
    // {
    //     return view('welcome');
    // }
    public function dashboard()
    {
        $usuario = auth()->user();

        return view('administrador.dashboard', compact('usuario'));
    }
    // public function usuarios()
    // {
    //     return view('administrador.usuarios.index');
    // }
}
