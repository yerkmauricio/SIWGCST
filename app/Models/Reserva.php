<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'finicio',
        'ffin',
        'estado', 
        'tipo',
        'cliente_id',
        'tour_id',
        'empleado_id',
        'f_registro'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
            $model->estado = "por confirmar" ;  
        });
    }
    //relacion de 1 a * reserva y cliente
    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    //relacion de 1 a * reserva y tour  
    public function tours()
    {
        return $this->belongsTo(Tours::class, 'tour_id');
    }

    //relacion de 1 a * reserva y empleado  
    public function empleados()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }
   
}
