@extends('layouts.app')
@section('body')

<div class="container col-xl-8 col-xxl-6 px-4 py-5">
    <div class="card w-50 card-login">
        <form action="{{ route('sistemas.store.do')}}" method="POST" id="form">
            @csrf
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-12 form-label text-center">Projeto Squadra</label>
            </div>
            <hr>
            <div class="row mb-3 form-group">
                <label for="name" class="col-sm-4 form-label">Nome</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name"  maxlength="50" value="{{ old('name') }}" placeholder="Digite seu nome">
                    @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif()
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="email" class="col-sm-4 form-label">E-mail</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email"  maxlength="50" value="{{ old('email') }}" placeholder="Digite seu endereço de email">
                    @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                    @endif()
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="password" class="col-sm-4 form-label">Senha</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" maxlength="20" placeholder="Digite sua senha">
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                    @endif()
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="password_confirm" class="col-sm-4 form-label">Confirme a senha</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control {{ $errors->has('password_confirm') ? 'is-invalid' : '' }}" id="password_confirm" name="password_confirm" maxlength="20" placeholder="Confirme sua senha">
                    @if($errors->has('password_confirm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password_confirm') }}
                    </div>
                    @endif()
                </div>
            </div>
            
            <div class="row mb-3 ml-2 form-group">
                <label for="pass_user" class="col-sm-4 form-label">&nbsp;</label>
                <button type="submit" form="form"  class="btn btn-success form-control col-sm-3"><strong>Cadastrar</strong></button>
                <a href="{{ route('login')}}" class="btn btn-defalt form-control text-danger float-right btn-no-board col-sm-3" ><strong>Cancelar</strong></a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('javascript')
    <script>
        
    </script>   
@endsection