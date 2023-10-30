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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', $precision = 5, $scale = 1)->unsigned()->notNull();
            $table->decimal('precioprivado', $precision = 5, $scale = 1)->unsigned()->notNull();
            $table->integer('ndia')->length(1)->unsigned()->notNull();
            $table->string('dificultad',15)->notNull();
            $table->time('hinicio')->notnull();
            $table->time('hfin')->notnull();
            $table->text('recomendaciones')->notnull();
            $table->text('llevar')->notnull();

            $table->unsignedBigInteger('destino_id');
            $table->foreign('destino_id')->references('id')
                ->on('destinos')->onDelete('cascade');

            $table->unsignedBigInteger('lisali_id')->nullable();
            $table->foreign('lisali_id')->references('id')
                ->on('lisalis')->onDelete('cascade');

            $table->unsignedBigInteger('transporte_id')->nullable();
            $table->foreign('transporte_id')->references('id')
                ->on('transportes')->onDelete('cascade');

            $table->unsignedBigInteger('hospedaje_id')->nullable();
            $table->foreign('hospedaje_id')->references('id')
                ->on('hospedajes')->onDelete('cascade');

            $table->unsignedBigInteger('obs_include_id');
            $table->foreign('obs_include_id')->references('id')
                ->on('obs_includes')->onDelete('cascade');

            $table->unsignedBigInteger('obs_noinclude_id');
            $table->foreign('obs_noinclude_id')->references('id')
                ->on('obs_noincludes')->onDelete('cascade');

            $table->unsignedBigInteger('foto_tour_id');
            $table->foreign('foto_tour_id')->references('id')
                ->on('foto_tours')->onDelete('cascade');

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
        Schema::dropIfExists('tours');
    }
};
