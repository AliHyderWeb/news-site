<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>

     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <div class="container">
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ route('posts.show') }}" id="logo"><img src="{{ asset('assets/images/news.jpg') }}" alt="News Logo"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->

<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="menu">
                     <li><a href="{{ route('login') }}">Login</a></li>
                     <li><a href="{{ route('posts.show') }}">Home</a></li>
                    @foreach ($categories as $cat )
                        <li>
                            <a href="{{ route('posts.show.category', $cat->id) }}" class="{{ isset($category) && $cat->id == $category->id ? 'active' : '' }}"
                                >{{ $cat->category_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
