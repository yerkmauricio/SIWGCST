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
        Schema::create('transportes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30)->notNull();
            $table->string('tipo',30)->notNull();
            $table->string('empresa',30);
            $table->integer('npasajero')->length(2)->unsigned()->notNull();
            $table->decimal('precio', $precision = 5, $scale = 1 )->unsigned()->notNull();
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
        Schema::dropIfExists('transportes');
    }
};
