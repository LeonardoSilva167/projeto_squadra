@php
$status = array('1' => 'Ativo', '0' => 'Cancelado');    
@endphp

@extends('layouts.app')
@section('body')

<div class="card">
    <div class="card-header border">
        Manter Sistema <span class="text-danger float-right"> * Campo Obrigatório</span>
    </div>
    <div class="card-body border">
        <form action="{{ route('sistemas.update', $sist->id) }}" method="POST" id="form">
            @csrf
            <input type="hidden" name="user_id" value="2">
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-4 form-label">Dados do Sistema</label>
            </div>
            <hr>
            <div class="row mb-3 form-group">
                <label for="descricao" class="col-sm-4 form-label">Descrição <span class="text-danger"> *</span></label>
                <div class="col-sm-7">
                <input type="text" class="form-control obrigatorio" name="descricao" id="descricao" maxlength="100" value="{{$sist->descricao}}">
                <div class="invalid-feedback">
                    Campo Obrigatório.
                </div>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="sigla" class="col-sm-4 form-label">Sigla <span class="text-danger"> *</span></label>
                <div class="col-sm-7">
                <input type="text" class="form-control obrigatorio" name="sigla" id="sigla" maxlength="10" value="{{$sist->sigla}}">
                <div class="invalid-feedback">
                    Campo Obrigatório.
                </div>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="email" class="col-sm-4 form-label">E-mail de atendimento do sistema</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="email" name="email" maxlength="50" value="{{$sist->email}}">
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="url" class="col-sm-4 form-label">URL</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="url" name="url" maxlength="50" value="{{$sist->url}}">
                </div>
            </div>
            <br>
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-4 form-label">Controle do Sistema</label>
            </div>
            <hr>
            <div class="row mb-3 form-group">
                <label for="status" class="col-sm-4 form-label">Status <span class="text-danger"> *</span></label>
                <div class="col-sm-7">
                   <select name="status" id="status" class="form-control">
                       @foreach ($status as $key => $sts )
                       <option value="{{$key}}" {{ $sist->status == $key? 'selected' : ''}}>{{ $sts}}</option>
                       @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="user_alteracao" class="col-sm-4 form-label">Usuário responsável pela última alteração</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="user_alteracao" name="user_alteracao" maxlength="50" value="{{$sist->name}}" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="data_alteracao" class="col-sm-4 form-label">Data da última alteração</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="data_alteracao" name="data_alteracao" maxlength="50" value="{{ date('d/m/Y H:i:s', strtotime($sist->updated_at) )  }}" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="justificativa_ultima_alteracao" class="col-sm-4 form-label">Justificativa da última alteração
                </label>
                
                <div class="col-sm-7">
                <textarea name="justificativa_ultima_alteracao" id="justificativa_ultima_alteracao" class="form-control formField contador" cols="75" rows="3" maxlength="500" disabled>{{$just[0]}}</textarea>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="justificativa_alteracao" class="col-sm-4 form-label">Justificativa da última alteração <span class="text-danger"> *</span>
                    <p class="text-success">Quantidade de caracteres disponíveis: <strong><span class="caracteres">500</span></strong></p>
                </label>
                
                <div class="col-sm-7">
                <textarea name="justificativa_alteracao" id="justificativa_alteracao" class="form-control obrigatorio" cols="75" rows="3" maxlength="500" ></textarea>
                <div class="invalid-feedback">
                    Campo Obrigatório.
                </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer border">
        <a href="{{ route('sistemas.index')}}" class="btn btn-defalt text-success text-left col-sm-3"><img src="{{ asset('img/back.png')}}" width="15" height="15"> <strong>Voltar</strong></a>
        <button type="button" class="btn btn-defalt text-success text-right col-sm-3 float-right" id="salvar"><strong>Salvar</strong> <img src="{{ asset('img/save.png')}}" width="15" height="15"></button>
    </div>
</div>
<div class="modal fade" id="msg" tabindex="-1" aria-labelledby="msgLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="msgLabel">Atenção</h5>
            </div>
            <div class="modal-body" id="msgBody">
                <label id="msgText" ></label>
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
            $('#justificativa_alteracao').on('keyup keydown', function(){
                let maxlength = $(this).attr('maxlength');
                let totalCaracters = $(this).val().length;
                let resultado = maxlength - totalCaracters;

                $('.caracteres').html(resultado);                
            });
                    
            $('#salvar').on('click', function(){
                if(checaCampos())
                    $('#form').submit();
            });

            $('.obrigatorio').on('keyup keydown', function(){
                let id = $(this).attr('id');
                $('#'+id).removeClass('is-invalid');
            })

        });
        
        function checaCampos()
        {
            let descricao = $('#descricao');
            let sigla = $('#sigla');
            let justificativa_alteracao = $('#justificativa_alteracao');

            if(descricao.val().trim() == '' || sigla.val().trim() == '' || justificativa_alteracao.val().trim() == '')
            {
                if(descricao.val().trim() == '' )
                    $('#descricao').addClass('is-invalid')
                if(sigla.val().trim() == '' )
                    $('#sigla').addClass('is-invalid')
                if(justificativa_alteracao.val().trim() == '' )
                    $('#justificativa_alteracao').addClass('is-invalid')
                

                mensagemAlerta('Dados obrigatórios não informados.')
                return false;
            }
            else if(!validaEmail())
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
@endsection