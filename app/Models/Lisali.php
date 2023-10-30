<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lisali extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'alimento_id',
        'producto_id',
        'f_registro'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
        });
    }
    //relacionde de 1 a 1 lisali y alimento
    public function alimento()
    {
        return $this->belongsTo(Alimentos::class, 'alimento_id');
    }
    //relacion de 1 a * lisali y producto
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    //estableciendo una relacion de 1 a * tour y lisali inversa
    public function tours()
    {
      return $this->belongsTo(Tours::class);
    }
}
