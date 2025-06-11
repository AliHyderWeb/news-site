<!-- resources/views/partials/header.blade.php -->

<div id="header-admin">
    <div class="container">
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-2">
                <a href="{{ url('admin/posts') }}">
                    <img class="logo" src="{{ asset('assets/images/news.jpg') }}" alt="Logo">
                </a>
            </div>
            <!-- /LOGO -->

            <!-- LOGOUT -->
            <div class="col-md-offset-9 col-md-1">
                <form action="{{ route('users.logout') }}" method="POST">
                    @csrf
                    <button type="submit" >  Logout</button> {{ Auth::user()->first_name ?? 'N/' }}
                </form>
            </div>
            <!-- /LOGOUT -->
        </div>
    </div>
</div>

<!-- Menu Bar -->
<div id="admin-menubar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="admin-menu">
                    <li><a href="{{ route('posts') }}">Post</a></li>
                    <li><a href="{{ route('category.index') }}">Category</a></li>  
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
