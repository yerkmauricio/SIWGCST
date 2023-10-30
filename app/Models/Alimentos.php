<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alimentos extends Model
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

     //estableciendo una relacion de 1 a 1 lisali y alimento inversa
     public function lisali()
     {
        return $this->belongsTo(Lisali::class);
     }
     //estableciendo una relacion de 1 a 1 cliente y alimento inversa
     public function cliente()
     {
        return $this->belongsTo(Clientes::class);
     }
     //estableciendo una relacion de 1 a 1 recibo y alimento inversa
     public function recibo()
     {
        return $this->belongsTo(Recibos::class);
     }
   
}
