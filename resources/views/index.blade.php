@extends('layouts.app')
@section('body')

<div class="card">
    <div class="card-header border">
        Manter Sistema <span style="float:right" class="text-danger"> * Campo Obrigatório</span>
    </div>
    <div class="card-body border">
        <form action="{{ route('sistemas.store')}}" method="POST" id="form">
            @csrf
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-4 form-label">Dados do Sistema</label>
            </div>
            <hr>
            <div class="row mb-3 form-group">
                <label for="descricao" class="col-sm-4 form-label">Descrição <span class="text-danger"> *</span></label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="descricao" id="descricao" maxlength="100" required>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="sigla" class="col-sm-4 form-label">Sigla <span class="text-danger"> *</span></label>
                <div class="col-sm-7">
                <input type="text" class="form-control" name="sigla" id="sigla" maxlength="10" required>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="email" class="col-sm-4 form-label">E-mail de atendimento do sistema</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="email" name="email" maxlength="50">
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="url" class="col-sm-4 form-label">URL</label>
                <div class="col-sm-7">
                <input type="text" class="form-control" id="url" name="url" maxlength="50">
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer border">
        <a href="{{ route('sistemas.index')}}" class="btn btn-defalt text-success text-left col-sm-3"><strong>Voltar</strong></a>
        <button type="submit" form="form"  class="btn btn-defalt text-success text-right col-sm-3" style="float:right;"><strong>Salvar</strong></button>
    </div>
</div>

@endsection

@section('javascript')
    <script>
        
    </script>   
@endsection