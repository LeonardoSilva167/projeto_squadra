<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ route('sistemas.index')}}">Manter Sistema</a>
          </li>
        </ul>
      </div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item float-right" >
            <label class="nav-link active" for="">{{ Auth::user()->name }}</label>
          </li>
          <li class="nav-item float-right" >
            <a class="nav-link  active" aria-current="page" href="{{ route('home.logout')}}">Sair</a>
          </li>
        </ul>
    </div>
  </nav>