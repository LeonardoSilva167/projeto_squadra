<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sistemas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao',100);            
            $table->string('sigla',10);                           
            $table->string('url',50)->nullable();            
            $table->string('email',100)->nullable();
            $table->unsignedBigInteger('user_id');  
            $table->enum('status', ['1', '0'])->default('1');     
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sistemas');
    }
}
