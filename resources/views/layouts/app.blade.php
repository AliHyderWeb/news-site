<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- bootstra --}}
</head>
<body>

    {{-- Header --}}
    @include('partials.header')

    {{-- Page Content --}}
    @yield('content')


    <div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>© Copyright 2019 News | Powered by <a href="https://github.com/AliHyderWeb/news-site">Ali Hyder</a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
