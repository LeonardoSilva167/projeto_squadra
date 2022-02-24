<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
    * Recebe array dos dados
    * @var request
    */
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Metodo responsavél por carregar a view de cadastrar usuário
     * @method create
     * @return response
     **/
    public function create()
    {
        return view('includes.sistema_cadastro');
        
    }

    /**
     * Metodo responsavél inserir Usuario no banco
     * @method store
     * @return response
     **/
    public function store()
    {
        $user = new User;
        // regras de cada elemento do formulario
        $regras = ([
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5',
            'password_confirm' => 'required|same:password',
        ]);        

        // tratamento de mensagens referentes ao elemento
        $mensagens = [
            'required' => 'Dados obrigatórios não informados.' ,

            'name.required' => 'Por favor informe o nome.',
            'name.min' => 'É necessario no minimo 3 caracteres para o nome.',
            
            'email.required' => 'Digite o endereço de email.',
            'email.unique' => 'email já cadastrado.',
            'email.email' => 'E-mail inválido.',
            
            'password.required' => 'Por favor informe a senha',
            'password.min' => 'É necessario no minimo 5 caracteres para a senha.',
            'password_confirm.required' => 'Por favor confirme a senha',
            'password_confirm.same' => 'A confirmação de senha não corresponde a senha informada',
            
        ];

        // verifica se campos passando regras e mensagens
        $this->request->validate($regras,$mensagens);
    
        try {
            // preenche o objeto model com os dados do formulario
            $user->name = addslashes($this->request->input('name'));
            $user->email = addslashes($this->request->input('email'));
            $user->password = Hash::make(addslashes($this->request->input('password')));        
            $user->perfil_id = 2; //novos usuários salvando com tipo_perfil de usuario
            $success = $user->save();  

            if($success)
            {
                //se su tudo certo, faz login do novo usuário
                $auth = new AuthController($this->request);
                $auth->login();   
                return redirect()->route('home');                         
            }
    
            return redirect()->route('sistemas.cadastro');    
            
        } catch (\Exception $e) {
            //se erro carrega informaçães da operação dentro de uma sessão
            $this->request->session()->put('sist',[
                                                    'result' => false, 
                                                    'data' => null, 
                                                    'msg' => 'Algo deu errado, por favor tente novamente.',
                                                    'error' => $e
                                                   ]
                                         );
        }

        return redirect()->route('sistemas.cadastro');                
        exit;
    }
}
