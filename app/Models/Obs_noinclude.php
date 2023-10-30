<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obs_noinclude extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'descripcion',
        'f_registro'
    ];
    public static function boot()
   {
      parent::boot();

      self::creating(function ($model) {
         $model->f_registro = now(); // Establece la fecha y hora actual
      });
   }
   //estableciendo una relacion de 1 a * tour y obs_noinclude inversa
   public function tours()
   {
     return $this->belongsTo(Tours::class);
   }
}
