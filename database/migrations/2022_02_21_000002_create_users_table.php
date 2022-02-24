<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('perfil_id');            
            $table->foreign('perfil_id')->references('id')->on('perfil_usuarios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // Cria um Arrau pra da insert iniciais do Sistema
        $data =  array(
            [
                'name' => 'Master',
                'email' => 'master@squadra.com',                
                'password' => Hash::make('12345'),
                'perfil_id' => '1',
            ],
            [
                'name' => 'Super Administrador',
                'email' => 'super@squadra.com',
                'password' => Hash::make('12345'),
                'perfil_id' => '3',
            ],
            [
                'name' => 'Administrador do Sistema',
                'email' => 'admsist@squadra.com',
                'password' => Hash::make('12345'),
                'perfil_id' => '4',
            ],
            [
                'name' => 'Responsável Técnico',
                'email' => 'resp@squadra.com',
                'password' => Hash::make('12345'),                
                'perfil_id' => '5',
            ],
        );
        
        // Executa o Array criando as informações
        foreach ($data as $datum){
            $user = new User();
            $user->name = $datum['name'];
            $user->email = $datum['email'];
            $user->password = $datum['password'];
            $user->perfil_id = $datum['perfil_id'];
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
