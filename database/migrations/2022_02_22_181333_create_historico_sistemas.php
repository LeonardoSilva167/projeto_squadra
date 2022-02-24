<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoSistemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_sistemas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sistemas_id');
            $table->unsignedBigInteger('user_id');  
            $table->text('justificativa', 500);
            $table->foreign('sistemas_id')->references('id')->on('sistemas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('historico_sistemas');
    }
}
