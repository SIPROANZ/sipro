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
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuentasbancaria_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('ordenpago_id')->unsigned();
            $table->double('montotransferencia', 25, 2);
            $table->date('fechaanulacion');
            $table->string('concepto', 10);
            $table->bigInteger('egreso')->unsigned();
            $table->double('montoorden', 25, 2);
            $table->string('referenciabancaria', 10);
            $table->string('conceptoanulacion', 10);
            $table->foreign('cuentasbancaria_id')->references('id')->on('cuentasbancarias')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('ordenpago_id')->references('id')->on('ordenpagos')->onDelete('cascade');
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
        Schema::dropIfExists('transferencias');
    }
};
