<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PerfilUsuario;

class CreatePerfilUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao', 50);
            $table->text('permissao');
            $table->timestamps();
            $table->softDeletes();
        });
           
        //Array com dados do insert inicial
        $data =  array(
            [
                'descricao' => 'Master',
                'permissao' => '1',
            ],
            [
                'descricao' => 'Usuário',
                'permissao' => '3',
            ],
            [
                'descricao' => 'Super Administrador',
                'permissao' => '2|3',
            ],
            [
                'descricao' => 'Administrador do Sistema',
                'permissao' => '2|3',
            ],
            [
                'descricao' => 'Responsável Técnico',
                'permissao' => '2|3',
            ]

        );
        //cadastra as informações no banco
        foreach ($data as $datum){
            $perfil = new PerfilUsuario();
            $perfil->descricao = $datum['descricao'];
            $perfil->permissao = $datum['permissao'];
            $perfil->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_usuarios');
    }
}
