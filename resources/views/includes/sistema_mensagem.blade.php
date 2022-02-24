@php
    
@endphp
@extends('layouts.app') @section('body')

<div class="card">
    <div class="card-header border">
        Mensagem
    </div>
    <div class="card-body border">
        <form action="{{ route('sistemas.store')}}" method="POST" id="form">
            @csrf
            <div class="row mb-6 form-group">
                <label for="descricao" class="col-sm-12 form-label text-center">{{$data->msg}}</label>
            </div>
            <hr>
            <div class="row mb-3 form-group">
                <div class="col-sm-7">
                    <a href="Novo"></a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection