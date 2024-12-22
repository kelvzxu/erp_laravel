<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/web_assets_apps.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/web_assets_apps.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3 laravel_database_list">
                                <img src="https://laravel.com/img/logotype.min.svg" class="my-3 img-fluid d-block mx-auto">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Copyright &copy; 
                    <span id="laravel_copyright">
                        <script>document.getElementById('laravel_copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                    </span>
                    kelvzxu
                </footer>
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