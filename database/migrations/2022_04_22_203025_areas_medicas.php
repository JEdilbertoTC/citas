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
        Schema::create('areas_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('medico_id')->unsigned()->index()->nullable();
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
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
        //
    }
};
