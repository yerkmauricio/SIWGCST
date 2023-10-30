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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->notNull();
            $table->text('descripcion')->notNull();
            $table->unsignedDecimal('salario', $precision = 6, $scale = 1)->unsigned()->notNull();
            $table->integer('horario')->length(2)->unsigned()->notNull();

            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')
                ->on('areas')->onDelete('cascade');

            $table->unsignedBigInteger('n_jerarquico_id');
            $table->foreign('n_jerarquico_id')->references('id')
                ->on('n_jerarquicos')->onDelete('cascade');

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
        Schema::dropIfExists('cargos');
    }
};
