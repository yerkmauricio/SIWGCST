<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleados extends Model
{
    use HasFactory, SoftDeletes;
    //asignacion masiva
    protected $fillable = [
        'nombre',
        'apellidopaterno',
        'apellidomaterno',
        'dni',
        'est_laboral',
        'domicilio',
        'nacionalidad',
        'genero',
        'whatsapp',
        'fnacimiento',
        'finicio',
        'fsuspension',
        'foto',
        'cargo_id',
        'n_jerarquico_id',
        'f_regstro'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
            $model->est_laboral = 1;
            $model->finicio = now();
        });
    }

    //relacion de 1 a * empleado y cargo 
    public function cargos()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
    // relacion de 1 a * empleado y n_jerarquico
    public function n_jerarquicos()
    {
        return $this->belongsTo(N_jerarquico::class, 'n_jerarquico_id');
    }
    //estableciendo una relacion de 1 a * recibo y empleado inversa
    public function Recibos()
    {
        return $this->belongsTo(Recibos::class);
    }
    //estableciendo una relacion de 1 a * reserva y empleado inversa
    public function Reservas()
    {
        return $this->belongsTo(Reserva::class);
    }
    //estableciendo una relacion de 1 a 1 user y empleado inversa
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
