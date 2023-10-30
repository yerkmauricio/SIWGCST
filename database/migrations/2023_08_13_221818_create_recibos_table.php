<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->id();
            $table->date('f_registro')->default(now());
            $table->text('descripcion')->nullable();
            $table->text('qr')->notNull();
            
            $table->string('metodo', 30)->notNull();
            $table->boolean('estado')->notNull();
            $table->decimal('monto', $precision = 5, $scale = 1)->unsigned()->notNull();
            $table->date('finicio')->notNull();
            $table->date('ffin')->notNull();
            $table->string('moneda')->notNull();
            $table->integer('cuenta')->length(5)->notNull()->nullable() ;
            $table->decimal('saldo', $precision = 5, $scale = 1)->unsigned()->notNull();
            $table->string('tipo', 10)->notNull();

            $table->unsignedBigInteger('descuento_id');
            $table->foreign('descuento_id')->references('id')
                ->on('descuentos')->onDelete('cascade');

            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')
                ->on('tours')->onDelete('cascade');

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')
                ->on('empleados')->onDelete('cascade');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')
                ->on('clientes')->onDelete('cascade');

            $table->softDeletes(); //eso hace que el borado sea logico 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recibos');
    }
};
