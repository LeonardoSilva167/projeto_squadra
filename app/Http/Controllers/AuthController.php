<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PerfilUsuario;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{    
       /**
    * Recebe array dos dados
    * @var request
    */
    protected $request;

    function __construct(Request $request)
    {
        //atribui request ao tributo request
        $this->request = $request;
    }

    /**
     * Metodo responsavél redirecionar para home
     * @method home
     * @return view
     **/
    public function home()
    {
        //verifica se o usuário esta logado
        if(Auth::check() === true)
            return view('home');                

        return redirect()->route('login');                
    }

    /**
     * Metodo responsavél redirecionar para tela de login
     * @method showLoginForm
     * @return view
     **/
    public function loginShow()
    {
        return view('includes.sistema_login');
    }

    /**
     * Metodo responsavél por verificar realizar o login do usuário no sistema
     * @method login
     * @return view
     **/
    public function login()
    {
        //verifica se o email foi informado e se é um email válido
        if(!empty(trim($this->request->email)) == !filter_var($this->request->email, FILTER_VALIDATE_EMAIL))
            return redirect()->back()->withInput(['email' => $this->request->email])->withErrors(['O email informado não é válido']);                

        //verifica se o email e a senha foram informados
        if(empty(trim($this->request->email)) && empty(trim($this->request->password)))
            return redirect()->route('login');

        $credentials = [
            'email' => $this->request->email,
            'password' => $this->request->password,
        ];

        //verifica se o email e a senha existem no banco, e se existir faz login
        if(!Auth::attempt($credentials))
            return redirect()->back()->withInput(['email' => $this->request->email])->withErrors(['Email ou senha incorretos.']);                
        
        //cria sessão com informações de acesso do usuário
        $perfil_id = Auth::user()->perfil_id;    
        $perfilUsuario = PerfilUsuario::find($perfil_id);
        $permissao = explode('|',$perfilUsuario->permissao);
        Session::put('ACESSO_PERMISSAO', $permissao );
        // dd(Session::all());
        return redirect()->route('home');         
    }

    /**
     * Metodo responsavél deslogar usuário do sistema
     * @method login
     * @return view
     **/
    public function logout()
    {
        //desloga o usuario
        Auth::logout();
        return redirect()->route('login');                
    }
    
}
