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
        Schema::create('pagados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ordenpago_id')->unsigned();
            $table->bigInteger('beneficiario_id')->unsigned();
            $table->bigInteger('tipomovimiento_id')->unsigned();
            $table->double('montopagado', 25, 2);
            $table->date('fechaanulacion')->nullable();
            $table->string('status', 10);
            $table->integer('correlativo')->unsigned();
            $table->bigInteger('tipoordenpago')->unsigned();
            $table->foreign('ordenpago_id')->references('id')->on('ordenpagos')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('tipomovimiento_id')->references('id')->on('tipomovimientos')->onDelete('cascade');
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
        Schema::dropIfExists('pagados');
    }
};
