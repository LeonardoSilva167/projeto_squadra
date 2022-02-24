@extends('layouts.app')
@section('body')
<section class="py-2 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-12 col-md-8 mx-auto">
        <h3 class="fw-light">Seja bem vindo(a), {{Auth::user()->name}}</h3>
      </div>
    </div>
  </section>
@endsection
