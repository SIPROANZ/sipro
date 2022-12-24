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
        Schema::create('detallecausados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('causado_id')->unsigned();
            $table->bigInteger('retencion_id')->unsigned()->nullable();
            $table->double('monto', 25, 2);

            $table->foreign('causado_id')->references('id')->on('causados')->onDelete('cascade');
            $table->foreign('retencion_id')->references('id')->on('retenciones')->onDelete('cascade');
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
        Schema::dropIfExists('detallecausados');
    }
};

