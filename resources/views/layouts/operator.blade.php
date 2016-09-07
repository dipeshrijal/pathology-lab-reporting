<!DOCTYPE html>
<html>

    <head>
        <title>XYZ Lab - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link href="/css/core/materialize.css" rel="stylesheet"/>
        <link rel="stylesheet" href="/css/libs/sweetalert/sweetalert.css">
        <link rel="stylesheet" href="/css/libs/toastr/toastr.css">
        <link rel="stylesheet" href="/css/libs/select2/select2.css">
        <link href="/css/core/style.css" rel="stylesheet"/>

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        <style>
            @import 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700';
            html, body {
                font-family: 'Open Sans', sans-serif;
            }
        </style>
    </head>

    <body>
        <div class="navbar-fixed">

            <nav class="cyan darken-3 white-text">

                <div class="nav-wrapper">
                    <a class="brand-logo" data-activates="slide-out" href="#!">
                        <i class="material-icons">menu</i>XYZ Lab
                    </a>

                </div>
            </nav>



        </div>

        @if (isset($searchbar))

        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper white">
                  <form>
                    <div class="input-field">
                      <input id="search" name="q" value="{{ $q }}" placeholder="{{ $search or 'Search' }}" type="search">
                      <label for="search"><i class="material-icons">search</i></label>
                      <i class="material-icons">close</i>
                    </div>
                  </form>
                </div>
            </nav>
        </div>

        @endif



        @role('operator')
            @include('layouts.partials._operator_sidebar')
        @else
            @include('layouts.partials._patients_sidebar')
        @endrole

        @yield('content')

        @section('scripts')
            <script src="/js/core/jquery.min.js" type="text/javascript"></script>
            <script src="/js/core/materialize.min.js"></script>
            <script src="/js/libs/jquery-validation/jquery.validate.min.js"></script>
            <script src="/js/libs/jquery-validation/additional-methods.js"></script>
            <script type="text/javascript" src="/js/libs/sweetalert/sweetalert.min.js"></script>
            <script type="text/javascript" src="/js/libs/toastr/toastr.min.js"></script>
            <script src="/js/libs/select2/select2.js"></script>
            <script src="/js/core/init.js"></script>
        @show


        @include('layouts.partials._alerts')


    </body>
</html>
