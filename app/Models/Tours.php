<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tours extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'precio',
        'precioprivado',
        'ndia',
        'dificultad',
        'hinicio',
        'hfin',
        'recomendaciones',
        'llevar',
        'destino_id',
        'lisali_id',//cambiar por alimento
        'transporte_id',
        'hospedaje_id',
        'obs_include_id',
        'obs_noinclude_id',
        'foto_tour_id',
        'f_registro'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
        });
    }
    //relacion de 1 a 1 tour y destino
    public function destino()
    {
        return $this->belongsTo(Destinos::class, 'destino_id');
    }

    //relacion de 1 a * tour y lisali
    public function lisalis()
    {
        return $this->belongsTo(Lisali::class, 'lisali_id');
    }

    //relacion de * a * tour y trasporte
    public function transporte()
    {
        return $this->belongsTo(Transporte::class, 'transporte_id');
    }
    //relacion de 1 a * tour y hospedaje
    public function hospedaje()
    {
        return $this->belongsTo(Hospedajes::class, 'hospedaje_id');
    }

    //relacion de 1 a * tour y obs_include
    public function obs_include()
    {
        return $this->belongsTo(Obs_include::class, 'obs_include_id');
    }

    //relacion de 1 a * tour y obs_noinclude
    public function obs_noinclude()
    {
        return $this->belongsTo(Obs_noinclude::class, 'obs_noinclude_id');
    }

    //relacion de 1 a * tour y foto_tour
    public function foto_tour()
    {
        return $this->belongsTo(foto_tour::class, 'foto_tour_id');
    }

    //estableciendo una relacion de 1 a * reserva y tour inversa
    public function reservas()
    {
        return $this->belongsTo(Reserva::class);
    }

    //estableciendo una relacion de 1 a * recibo y tour inversa
    public function Recibos()
    {
        return $this->belongsTo(Recibos::class);
    }
}
