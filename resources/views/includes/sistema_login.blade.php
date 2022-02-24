@extends('layouts.app')
@section('body')

<div class="container col-xl-8 col-xxl-6 px-4 py-5">
    <div class="card w-50 card-login">

        <form action="{{ route('home.login.do')}}" class="needs-validation" method="POST" id="form" novalidate>
            @csrf
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-12 form-label text-center">Projeto Squadra</label>
            </div>
            @if($errors->all())
                @foreach($errors->all() as $er)
                    <div class="alert alert-danger" role="alert">
                    {{ $er}}
                  </div>
                @endforeach
            @endif
            <hr>
            <div class="row mb-3 form-group">
                <label for="email_user" class="col-sm-3 form-label">E-mail</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" required id="email" name="email" value="{{ old('email') }}" maxlength="50" placeholder="Digite seu endereço de email">
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label for="pass_user" class="col-sm-3 form-label">Senha</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" required id="password" name="password" maxlength="20" placeholder="Digite sua senha">
                </div>
            </div>
            
            <div class="row mb-3 ml-2 form-group">
                <label for="pass_user" class="col-sm-3 form-label">&nbsp;</label>
                <button type="submit" class="btn btn-success form-control col-sm-3"><strong>Login</strong></button>
                <a href="{{ route('sistemas.cadastro')}}" class="btn btn-defalt form-control text-success float-right btn-no-board col-sm-3" ><strong>Cadastre-se</strong></a>
            </div>
        </form>
    </div>
</div>

@endsection