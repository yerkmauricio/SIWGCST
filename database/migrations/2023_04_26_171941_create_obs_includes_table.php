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
        Schema::create('obs_includes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30)->notNull();
            $table->text('descripcion')->notNull();
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
        Schema::dropIfExists('obs_includes');
    }
};
