<?php

namespace App\Http\Controllers;

use App\HistoricoSistemas;
use App\Sistemas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SistemasController extends Controller
{
    /**
    * Recebe array dos dados
    * @var request
    */
    protected $request;
    /**
    * limit de arquivos por página
    * @var limit
    */
    protected $limit;
    /**
    * numero da paginação atual 
    * @var pagina_atual
    */
    protected $pagina_atual;

    function __construct(Request $request, $limit = 2, $pagina_atual = 0)
    {
        $this->limit = $limit;
        $this->pagina_atual = $pagina_atual;
        $this->request = $request;
    }

    /**
     * Metodo responsavél redirecionar para tela de lista de sistema
     * @method index
     * @return response
     **/
    public function index()
    {        
        $resp = false;
        // verifica se existe uma sessão com nome sist
        if ($this->request->session()->has('sist'))
            // transfere os dados da sessão para variavel e depois limpa sessão
            $resp = $this->request->session()->pull('sist', []);        
        
        // busca todos os registros  não deletados da tabela sistemas
        $sist =  Sistemas::orderBy('descricao', 'asc')
                ->orderBy('sigla', 'asc')
                ->orderBy('email', 'asc')
                ->paginate($this->limit);
                
        return view('includes.sistema_lista', compact('sist', 'resp'));
    }

    /**
     * Metodo responsavél redirecionar para tela de cadastrar sistema
     * @method index
     * @return view
     **/
    public function create()
    {
        return view('includes.sistema_novo');        
    }

    /**
     * Metodo responsavél por inserir dados na tabela de sistemas
     * @method store
     * @return response
     **/
    public function store()
    {
        $sist = new Sistemas;
        
        try {
            // preenche o objeto model com os dados do formulario
            $sist->descricao = addslashes($this->request->input('descricao'));
            $sist->sigla = addslashes($this->request->input('sigla'));
            $sist->email = addslashes($this->request->input('email'));
            $sist->user_id = Auth::user()->id;
            $sist->url = addslashes($this->request->input('url'));
            $sist->save();
            
            //se deu tudo certo carrega informaçães da operação dentro de uma sessão
            $this->request->session()->put('sist', [
                                                    'result' => true, 
                                                    'data' => $sist, 
                                                    'msg' => 'Operação realizada com sucesso.'                                            
                                                   ]
                                    );
                                                
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

        return redirect()->route('sistemas.index');        
        exit;


    }

    /**
     * Metodo responsavél por carregar view de editar com informações 
     * @method edit
     * @return response
     **/
    public function edit($id)
    {
        // busca informações do sistema
        $sist = DB::table('sistemas')
                ->where('sistemas.id', '=', $id)
                ->join('users', 'users.id', '=', 'sistemas.user_id')
                ->select('sistemas.*', 'users.name', 'sistemas.email')
                ->get();


        // busca informações do historico de justificativas
        $just = HistoricoSistemas::where('sistemas_id', '=', $id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(1)
                                    ->get()
                                    ->pluck('justificativa');
        if(isset($sist))
            $sist = $sist[0];

        if(!isset($just[0]))
            $just[0] = '';

        return view('includes.sistema_editar', compact('sist','just'));

    }

    /**
     * Metodo responsavél por atualizar dados do id na tabela sistemas
     * @method update
     * @return response
     **/
    public function update($id)
    {
        
        $hist = new HistoricoSistemas;
        $sist = Sistemas::find($id);

        if(isset($sist))
        {
            try{
                // preenche o objeto model com os dados do formulario
                $sist->descricao = addslashes($this->request->input('descricao'));
                $sist->sigla = addslashes($this->request->input('sigla'));
                $sist->email = addslashes($this->request->input('email'));
                $sist->url = addslashes($this->request->input('url'));
                $sist->status = addslashes($this->request->input('status'));
                $sist->update();       
                
                // preenche o objeto model com os dados do formulario
                $hist->sistemas_id = $id;
                $hist->user_id = Auth::user()->id;
                $hist->justificativa = addslashes($this->request->input('justificativa_alteracao'));
                $hist->save();
                
                //se deu tudo certo carrega informaçães da operação dentro de uma sessão
                $this->request->session()->put('sist',  [
                                                            'result' => true, 
                                                            'data' => $sist, 
                                                            'msg' => 'Operação realizada com sucesso.'                                            
                                                        ]
                                                );
            
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
        
        }
        else
        {
            //se erro carrega informaçães da operação dentro de uma sessão
            $this->request->session()->put('sist',[
                                                    'result' => false, 
                                                    'data' => null, 
                                                    'msg' => 'Algo deu errado, por favor tente novamente.',
                                                ]
                                            );
        }

        return redirect()->route('sistemas.index');        
        exit;
    }

    /**
     * Metodo responsavél por buscar informaçãoes na tabela de sistemas
     * @method search
     * @return array
     **/
    public function search($page = 1)
    {

        $descricao = addslashes($this->request->input('descricao'));
        $sigla = addslashes($this->request->input('sigla'));
        $email = addslashes($this->request->input('email'));
        
        // objeto com dados do formulario de pesquisa
        $data = (object) array();
        $data->descricao = $descricao;
        $data->sigla = $sigla;
        $data->email = $email;

        $resp = false;
            
        // busca dados da pesquisa
        $sist = Sistemas::when($descricao ,function($query, $descricao) {
                            $query->where('descricao', 'like', '%'.$descricao.'%');
                        })->when($sigla,function($query, $sigla){
                                $query->orWhere('sigla', 'like', '%'.$sigla.'%');
                        })->when($email,function($query, $email){
                                $query->orWhere('email', 'like', '%'.$email.'%');
                        })
                        ->orderBy('descricao', 'asc')
                        ->orderBy('sigla', 'asc')
                        ->orderBy('email', 'asc')
                        ->paginate($this->limit);
        
        // se busca não conter resultados
        if($sist->total() == 0)
        {
            $resp = [
                        'result' => false, 
                        'data' => null, 
                        'msg' => 'Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa!',
            ];
        }

        return view('includes.sistema_lista', compact('sist','resp', 'data'));        
    }
}
