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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30)->notNull();
            $table->string('apellido', 20)->notNull();
            $table->string('hotel', 20)->nullable();
            $table->integer('nroom')->length(3)->nullable();
            $table->string('whatsapp', 15)->notNull();
            $table->string('dni', 20)->notNull()->unique();
            $table->string('nacionalidad', 30)->notNull();
            $table->decimal('altura', $precision = 3, $scale = 2)->unsigned()->notNull();
            $table->string('talla', 5)->notNull();
            $table->boolean('genero')->notNull();
            $table->integer('nviaje')->length(3)->unsigned()->notNull();
            $table->string('alergia', 20)->notNull();
            $table->date('fnacimiento')->notNull();

            $table->unsignedBigInteger('alimento_id');
            $table->foreign('alimento_id')->references('id')
                ->on('alimentos')->onDelete('cascade');

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
        Schema::dropIfExists('clientes');
    }
};
