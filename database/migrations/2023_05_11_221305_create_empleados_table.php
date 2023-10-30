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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->notNull();
            $table->string('apellidopaterno', 20)->notNull();
            $table->string('apellidomaterno', 20)->notNull();
            $table->string('dni', 20)->notNull()->unique();
            $table->boolean('est_laboral')->notNull();
            $table->string('domicilio', 30)->notNull();
            $table->string('nacionalidad', 30)->notNull();
            $table->boolean('genero')->notNull();
            $table->string('whatsapp', 15)->notNull();
            $table->date('fnacimiento')->notNull();
            $table->date('finicio')->notNull();
            $table->date('fsuspension')->nullable();
            $table->string('foto', 100)->notnull();

            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')
                ->on('cargos')->onDelete('cascade');

            $table->unsignedBigInteger('n_jerarquico_id');
            $table->foreign('n_jerarquico_id')->references('id')
                ->on('n_jerarquicos')->onDelete('cascade');

            $table->date('f_registro')->default(now());
            $table->softDeletes(); //eso hace que el borado sea logico
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
