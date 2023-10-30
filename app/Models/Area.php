<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
   use HasFactory, SoftDeletes;
   protected $fillable = [
      'nombre',
      'tipo',
      'descripcion',
      'estado',
      'f_registro'
   ];
   public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
         $model->estado = 1;
      });
   }
   //estableciendo una relacion de 1 a * cargo y area inversa
   public function cargos()
   {
      return $this->belongsTo(Cargo::class);
   }
}
