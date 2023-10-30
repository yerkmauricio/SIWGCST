<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;//asisgnado roles 5

class N_jerarquico extends Model
{
   use HasFactory, SoftDeletes;
   use HasRoles;//asisgnado roles 6

   protected $fillable = [
      'nombre',
      'descripcion',
      'n_orden',
      'n_superior',
      'f_registro'
   ];
   public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
         $model->n_superior = $model->n_orden - 1;
      });
   }
   //estableciendo una relacion de 1 a * cargo y n_jerarquico inversa
   public function cargos()
   {
      return $this->belongsTo(Cargo::class);
   }

   //estableciendo una relacion de 1 a * empleado n_jerarquico inversa
   // public function empleados()
   // {
   //   return $this->belongsTo(Empleados::class);
   // }
}
