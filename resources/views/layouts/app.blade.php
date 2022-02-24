<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Sistemas</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-fluid">
        @if(Auth::check())    
            @component('layouts.componente_navbar')
            @endcomponent
        @endif
        
        <main role="main">

            @hasSection ('body')
                @yield('body')
            @endif
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    @hasSection('javascript')
        @yield('javascript')
    @endif

</body>
</html>