<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notacreditos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ejercicio_id')->unsigned();
            $table->bigInteger('cuentasbancaria_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('institucione_id')->unsigned();
            $table->double('montonc', 25, 2);
            $table->date('fecha')->nullable();           
            $table->string('referencianc', 10);
            $table->string('descripcion', 10);
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
            $table->foreign('cuentasbancaria_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('institucione_id')->references('id')->on('instituciones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notacreditos');
    }
};
