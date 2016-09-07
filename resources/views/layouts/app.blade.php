<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>XYZ Lab - @yield('title')</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="/css/core/materialize.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
        <link rel="stylesheet" href="/css/core/style.css">

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        </script>
    </head>

    <body>
        <nav class="cyan darken-2 white-text">
            <div class="nav-wrapper">
            </div>
        </nav>

        @yield('content')

        <!-- Scripts -->
        <script src="/js/core/jquery.min.js">
        </script>
        <script src="/js/core/materialize.min.js">
        </script>
        <script src="/js/libs/jquery-validation/jquery.validate.min.js">
        </script>
        <script src="/js/core/init.js">
        </script>

        @include('layouts.partials._alerts')


    </body>

</html>
