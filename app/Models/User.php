<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'empleado_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //usando imagen en user a)
    // public function adminlte_image()
    // {
    //     $user = Auth::user(); //no te okvides deimportar  el auth
    //     $foto = $user->empleado->foto;
    //     return $foto;
    // }
    public function adminlte_image()
    {
        $empleado = $this->empleado;
        if ($empleado) {
            $foto = $empleado->foto; // Obtiene el nombre de archivo de la imagen desde la base de datos
            if ($foto) {
                $url = asset('storage/' . $foto); // Genera la URL completa de la imagen
                return $url;
            }
        }

        // En caso de que no haya imagen, puedes proporcionar una imagen por defecto o regresar una URL de imagen genérica.
        return asset('path/a/imagen/por/defecto.jpg');
    }
    //relacionde de 1 a 1 user y empleado
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id'); //talvez lo borre pero esta por verse 
    }
}
