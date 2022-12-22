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
        Schema::create('compromisos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Compra::class)->constrained('compras');
            $table->foreignIdFor(Unidadadministrativa::class)->constrained('unidadadministrativas');
            $table->bigInteger('tipocompromiso')->unsigned();
            $table->string('codigo', 10);
            $table->date('fecha');
            $table->date('fechaanulacion');
            $table->string('concepto', 255);
            $table->double('montocompromiso', 25, 2);
            $table->double('montocausado', 25, 2)->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('compromisos');
    }
};
