<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <title>{{$title}}</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <script type="text/javascript" src="{{asset('/js/jquery-1.11.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap-filestyle.min.js')}}"></script>

</head>
<body>

<header id="header_wrapper">
    @yield('header')


    @if(session('success'))
        <div class="alert alert-success" role="alert" id="true">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>
            {{ session()->get('success') }}
        </div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert" id="true">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                {{ $error }}
            </div>
        @endforeach
    @endif

</header>
@yield('content')
</body>
</html>
