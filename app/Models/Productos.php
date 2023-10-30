<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model
{
   use HasFactory, SoftDeletes;
   //asignacion masiva
   protected $fillable = [
      'nombre',
      'tipo',
      'precio',
      'descripcion',
      'categoria',
      'cantidad',
      'foto',
      'f_registro'

   ];
   //fecha y hora automatica

   public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
      });
   }
   //estableciendo una relacion de 1 a * lisali y producto inversa
   public function lisali()
   {
      return $this->belongsTo(Lisali::class);
   }
   
}
