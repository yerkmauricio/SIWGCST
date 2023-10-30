<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporte extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [

        'nombre',
        'tipo',
        'empresa',
        'npasajero',
        'precio',
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
   //estableciendo una relacion de * a * tour y transporte inversa
   public function tours()
   {
     return $this->belongsToMany(Tours::class);
   }
}
