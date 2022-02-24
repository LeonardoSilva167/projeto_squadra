@php
    $status = array('1' => 'Ativo', '0' => 'cancelado');    
    if(isset($sist) && count($sist) > 0)
    {
        $total = $sist->total();
        $paginaAtual = $sist->currentPage();
        $limit = $sist->perPage();
        
        $paginas = ceil($total/$limit);
        $inicio = (($paginas - $paginaAtual) <= 5 )? $paginas - 10 : $paginaAtual - 5 ;
        $fim = ($paginas >= 10 && $paginaAtual <= 5)? $paginaAtual + (10-$paginaAtual) : $paginaAtual + 5;

        $primeira = true;
        if($inicio < 0){
            $inicio = 0;
            $primeira = false;
            $blocBack = 'disabled';
        };

        $ultima = true;
        if($fim > $paginas){
            $fim = $paginas;
            $ultima = false;
        };

        $link = "buscar?page=";
    }
@endphp
@extends('layouts.app')
@section('body')
<div class="card">
    <div class="card-header border">
        <label for="">Pesquisar Sistema</label>
    </div>
    <div class="card-body border">
        
            <form action="{{ route('sistemas.search') }}" method="GET" id="form">
                @csrf
                <input type="hidden" name="limit" value="">
                <div class="row mb-6 form-group">
                    <label for="descricao" class="col-sm-6 col-form-label text-success">Filtro de Consulta</label>
                </div>
                <hr>
                <div class="row mb-6 form-group">
                    <label for="descricao" class="col-sm-6 col-form-label">Descrição</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control search" name="descricao" id="descricao" value="{{ isset($data->descricao)? $data->descricao : '' }}">
                    </div>
                </div>
                <div class="row mb-6 form-group">
                    <label for="sigla" class="col-sm-6 col-form-label">Sigla</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control search" name="sigla" id="sigla" value="{{ isset($data->sigla)? $data->sigla : '' }}">
                    </div>
                </div>
                <div class="row mb-6 form-group">
                    <label for="email" class="col-sm-6 col-form-label">E-mail de atendimento do sistema</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control search" id="email" name="email" value="{{ isset($data->email)? $data->email : '' }}">
                    </div>
                </div>
            </form>
        @if(isset($sist) && count($sist) > 0)
        <br>
        <hr>
        <div class="row mb-3">
            <label for="descricao" class="col-sm-6 col-form-label text-success">Resultado da Consulta</label>
        </div>
        <div class="row">
            <div class=" form-group col-sm-12  horizontal containerLimit">                
                <table class="table table-ordered table-hover border">
                    <thead class="table-success">
                        <th>Descrição</th>
                        <th>Sigla</th>
                        <th>E-mail de atendimento</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($sist as $sistema)
                        <tr>
                            <td>{{ $sistema->descricao }}</td>
                            <td>{{ $sistema->sigla }}</td>
                            <td>{{ $sistema->email }}</td>
                            <td>{{ $sistema->url }}</td>
                            <td>{{ $status[$sistema->status] }}</td>
                            <td>
                                <a href="editar/{{$sistema->id}}"> <img src="{{ asset('img/edit.png')}}" width="15" height="15"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-12 text-center" >
                    <label class="col-sm-6 col-form-label text-success">listando {{count($sist)}} resultados de {{$total}}</label>
                </div>
            </div>
        </div>        
        @if ($paginas > 1)
        <div class="row mb-3 col-sm-12 ">            
            <nav class="nav-pagination">
                <ul class="pagination" role="navigation">

                @if($paginaAtual == 1)
                <li class="page-item disabled"><span class="page-link"><<</span></li>
                <li class="page-item disabled"><span class="page-link"><</span></li>
                @else                                    
                    <li class="page-item"><a class="page-link" href="{{$link}}1"><<</a></li>
                    <li class="page-item"><a class="page-link" href="{{$link.($paginaAtual-1)}}"><</a></li>
                @endif                

                @for ($pag=$inicio+1;$pag<=$fim;$pag++)
                    <li class="page-item {{$paginaAtual==$pag ? "active" : ''}}" {{$paginaAtual==$pag ? 'aria-current="page"' : ''}}>
                        <a class="page-link" href="{{$link.$pag}}">{{$pag}}</a>
                    </li>
                @endfor

                @if($paginas == $paginaAtual)
                    <li class="page-item disabled"><span class="page-link">></span></li>
                    <li class="page-item disabled"><span class="page-link">>></span></li>
                @else                                    
                    <li class="page-item"><a class="page-link" href="{{$link.($paginaAtual+1)}}">></a></li>
                    <li class="page-item"><a class="page-link" href="{{$link.($paginas)}}">>></a></li>
                @endif     

                </ul>
              </nav>
        </div>
        @endif   
        @endif   
    </div>
    <div class="card-footer border" style="">
        <div class="row">            
            <div class="col-md-6"></div>            
            <div class="col-md-6">            
                <div class="form-group">
                    <button type="button" form="form" class="btn btn-defalt text-success col-sm-3" id="pesquisar"><strong>Pesquisar</strong> <img src="{{ asset('img/search.png')}}" width="15" height="15"></button>                    
                    <a href="{{ route('sistemas.index')}}" class="btn btn-defalt text-success col-sm-3" id="limpar"><strong>Limpar</strong> <img src="{{ asset('img/clean.png')}}" width="15" height="15"></a>      
                    @if(Helper::sis_permissao(2))
                    <a href="{{ route('sistemas.create')}}" class="btn btn-defalt text-success col-sm-3"><strong>Novo Sistema</strong> <img src="{{ asset('img/new.png')}}" width="15" height="15"></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="msg" tabindex="-1" aria-labelledby="msgLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="msgLabel">Atenção</h5>
            </div>
            <div class="modal-body" id="msgBody">
                <label id="msgText" >
                    @if(isset($resp) && $resp)
                    {{ $resp['msg'] }}
                    @endif

                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            
            $('#limpar').on('click', function(){
                $('.search').val('');
                $('#form').submit
            });

            $('#pesquisar').on('click', function(){
                if(checaCampos())
                    $('#form').submit();
            });

        });
                
        function checaCampos()
        {
            let email = $('#email');

            if(email.val().trim() != '' && !validaEmail())
            {
                mensagemAlerta('E-mail inválido.')
                return false;
            }

            return true; 
        }
        
        function mensagemAlerta(msg)
        {
            $('#msgText').html(msg);
            $('#msg').modal('show');
        }

        function validaEmail()
        {
            var regexEmail = /[\w-\.]{1,}@([\w-]{2,}\.)*([\w-]{1,}\.)[\w-]{2,4}/;
            if (regexEmail.test($('#email').val().trim())) 
                return true;
                
            return false;
        }

    </script>
    @if(isset($resp) && $resp)
        <script>
            $('#msg').modal('show');
        </script>    
    @endif
@endsection

