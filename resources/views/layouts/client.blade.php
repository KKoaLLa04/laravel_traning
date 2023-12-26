<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('asset/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/clients/css/style.css')}}">
    @yield('css')
</head>
<body>
    @include('clients/blocks/header')
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-4">
                        @section('sidebar')
                            @include('clients.blocks.sidebar')
                        @show
                </div>
                <div class="col-8">
                     @yield('content')
                </div>
            </div>
        </div>
       
       
    </main>
    @include('clients.blocks.footer')

    @yield('js')
    <script src="{{asset('asset/clients/js/bootstrap.min.js')}}"></script>
</body>
</html>