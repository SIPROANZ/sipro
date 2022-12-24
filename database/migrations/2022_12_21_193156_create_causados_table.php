<?php

use App\Compra;
use App\Unidadadministrativa;
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
        Schema::create('causados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('compromiso_id')->unsigned();
            $table->string('codigo', 10);
            $table->date('fecha');
            $table->date('fechaanulacion');
            $table->double('montocausado', 25, 2);
            $table->double('montopagado', 25, 2)->nullable();
            $table->tinyInteger('status');

            $table->foreign('compromiso_id')->references('id')->on('compromisos')->onDelete('cascade');
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
        Schema::dropIfExists('causados');
    }
};
