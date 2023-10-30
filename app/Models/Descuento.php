<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Descuento extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'tipo',
        'porcentaje',
        'f_registro'
    ];
    public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
      });
   }
    //estableciendo una relacion de 1 a * recibo y descuento inversa
    public function Recibos()
    {
        return $this->belongsTo(Recibos::class);
    }
}
