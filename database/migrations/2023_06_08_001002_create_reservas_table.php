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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('finicio')->notNull();
            $table->date('ffin')->notNull();
            $table->string('estado', 15)->notNull();
            $table->string('tipo', 10)->notNull();

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')
                ->on('clientes')->onDelete('cascade');

            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->references('id')
                ->on('tours')->onDelete('cascade');

            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')
                ->on('empleados')->onDelete('cascade');

            $table->date('f_registro')->default(now());
            $table->softDeletes(); //eso hace que el borado sea logico 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
