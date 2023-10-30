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
        Schema::create('lisalis', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30)->notNull();

            $table->unsignedBigInteger('alimento_id');
            $table->foreign('alimento_id')->references('id')
                  ->on('alimentos')->onDelete('cascade');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')
                  ->on('productos')->onDelete('cascade');
           
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
        Schema::dropIfExists('lisalis');
    }
};
