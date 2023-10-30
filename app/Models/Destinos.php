<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destinos extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'ubicacion',
        'entrada',
        'categoria',
        'descripcion',
        'distancia',
        'altura',
        'clima',
        'whatsapp',
        'foto',
        'f_registro'
    ];
    
    public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
      });
   }

   //estableciendo una relacion de 1 a 1 tour y destino inversa
     public function tours()
     {
       return $this->belongsTo(Tours::class);
     }

     
}
