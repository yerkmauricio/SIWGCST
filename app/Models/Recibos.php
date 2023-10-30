<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recibos extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'f_registro',
        'descripcion',
        'qr',
        'metodo',
        'estado',
        'monto',
        'tipo',
        'descuento_id',
        'tour_id',
        'empleado_id',
        'cliente_id',
        'alimento_id',
        'finicio',
        'ffin',
        'moneda',
        'cuenta',
        'saldo'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
            $model->estado = 1;
          
        });
    }
    //relacion de 1 a * recibo y descuento
    public function descuentos()
    {
        return $this->belongsTo(Descuento::class, 'descuento_id');
    }

    //relacion de 1 a * recibo y tour  
    public function tours()
    {
        return $this->belongsTo(Tours::class, 'tour_id');
    }

    //relacion de 1 a * recibo y empleado  
    public function empleados()
    {
        return $this->belongsTo(empleados::class, 'empleado_id');
    }

    //relacion de 1 a * recibo y cliente
    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    //relacionde de 1 a 1 recibo y alimento 
    public function alimento()
    {
        return $this->belongsTo(Alimentos::class, 'alimento_id'); //talvez lo borre pero esta por verse 
    }
}
