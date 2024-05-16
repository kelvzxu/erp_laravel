<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/web_assets_apps.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/web_assets_apps.js') }}" defer></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 laravel_database_list">
                <img src="https://laravel.com/img/logotype.min.svg" class="my-3 img-fluid d-block mx-auto">
                @yield('content')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 laravel_database_list">
                <small class="mt-5">
                    Copyright &copy; 
                    <span id="laravel_copyright">
                        <script>document.getElementById('laravel_copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                    </span>
                    kelvzxu
                </small>
            </div>
        </div>
    </div>
    <script>
        function ShowPassword(id){
            var element = document.getElementById(id);
            if (element.type === "password") {
                element.type = "text";
            } else {
                element.type = "password";
            }
        }
    </script>
</body>
</html>