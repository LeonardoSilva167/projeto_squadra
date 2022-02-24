<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PermissaoUsuario;

class CreatePerfilPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissao_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        $data =  array(
            [
                'name' => 'Completo',
            ],
            [
                'name' => 'Cadastrar e Editar Sistemas',
            ],
            [
                'name' => 'Consultar Sistemas',
            ],
        );

        foreach ($data as $datum){
            $permissao = new PermissaoUsuario();
            $permissao->descricao = $datum['name'];
            $permissao->save();
        }
}


        
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissao_usuarios');
    }
}
