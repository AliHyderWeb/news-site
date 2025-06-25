<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
        <!-- Custom stylesheet -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="{{ asset('assets/images/news.jpg') }}">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action=" {{ route('users.login') }} " method ="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror"  value="{{ old('email') }}" >
                                {{-- Display validation error for email --}}
                               @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}">
                                 @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                            <a href="{{ route('posts.show') }}"  class="btn btn-danger"> Cancel</a>
                        </form>
                        <!-- /Form  End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
