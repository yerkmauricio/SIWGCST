<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'descripcion',
        'salario',
        'horario',
        'area_id',
        'n_jerarquico_id',
        'f_registro'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->f_registro = now(); // Establece la fecha y hora actual
        });
    }
    //relacion de 1 a * cargo y area
    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    //relacion de 1 a * cargo y area
    public function n_jerarquicos()
    {
        return $this->belongsTo(N_jerarquico::class, 'n_jerarquico_id');
    }
    //estableciendo una relacion de 1 a * empleado cargo inversa
    public function empleados()
    {
      return $this->belongsTo(Empleados::class);
    }

}
