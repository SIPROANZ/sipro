<?php

use App\Analisi;
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
            $table->foreignIdFor(Analisi::class)->constrained('analisis');
            $table->foreignIdFor(Unidadadministrativa::class)->constrained('unidadadministrativas');
            $table->string('codigo', 10);
            $table->date('fecha');
            $table->tinyInteger('estatus');
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
