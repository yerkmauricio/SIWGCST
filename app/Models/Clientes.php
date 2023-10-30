<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    use HasFactory, SoftDeletes;
    //asignacion masiva
    protected $fillable = [
        'nombre',
        'apellido',
        'hotel',
        'nroom',
        'whatsapp',
        'dni',
        'nacionalidad',
        'altura',
        'talla',
        'genero',
        'nviaje',
        'alergia',
        'fnacimiento',
        'alimento_id',
        'f_registro'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual

        });
    }

    //relacion de de 1 a 1 lisali y alimento
    public function alimento()
    {
        return $this->belongsTo(Alimentos::class, 'alimento_id');
    }

    //estableciendo una relacion de 1 a * reserva y cliente inversa
    public function reservas()
    {
        return $this->belongsTo(Reserva::class);
    }

    //estableciendo una relacion de 1 a * recibo y cliente inversa
    public function Recibos()
    {
        return $this->belongsTo(Recibos::class);
    }
}
