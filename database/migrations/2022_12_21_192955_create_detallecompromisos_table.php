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
        Schema::create('detallecompromisos', function (Blueprint $table) {

            $table->bigInteger('compromiso_id')->unsigned();
            $table->bigInteger('requidetclaspres_id')->unsigned();
            $table->double('monto', 25, 2);
            $table->foreign('compromiso_id')->references('id')->on('compromisos')->onDelete('cascade');
            $table->foreign('requidetclaspres_id')->references('id')->on('requidetclaspres')->onDelete('cascade');
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
        Schema::dropIfExists('detallecompromisos');
    }
};
