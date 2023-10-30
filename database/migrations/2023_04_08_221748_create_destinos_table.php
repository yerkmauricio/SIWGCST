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
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30)->notNull();
            $table->string('ubicacion',30)->notnull();
            $table->decimal('entrada', $precision = 5, $scale = 1 );
            $table->string('categoria',30)->notNull();
            $table->text('descripcion')->notNull();
            $table->decimal('distancia', $precision = 7, $scale = 2 )->notNull();
            $table->decimal('altura', $precision = 7, $scale = 2 )->notNull();
            $table->string('clima',10)->notNull();
            $table->string('whatsapp',15)->notNull();
            $table->string('foto',100)->notnull();
            $table->date('f_registro')->default(now());
            $table->softDeletes();//eso hace que el borado sea logico  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};
