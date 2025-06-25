<!-- resources/views/partials/header.blade.php -->

<div id="header-admin">
    <div class="container">
        <div class="row">
            <!-- LOGO -->
            <div class="col-md-2">
                <a href="{{ route('posts.index') }}">
                    <img class="logo" src="{{ asset('assets/images/news.jpg') }}" alt="Logo">
                </a>
            </div>
            <!-- /LOGO -->

            <!-- LOGOUT -->
  <div class="col-md-offset-9 col-md-3">
    <form action="{{ route('users.logout') }}" method="POST" style="background: transparent; margin-bottom: 10px; ; padding: 0; border: none;">
        @csrf
        <a href="{{ route('users.logout') }}" 
           class="dropdown-item d-flex align-items-center " 
           onclick="event.preventDefault(); this.closest('form').submit();" 
           style="color: #fff; font-weight: bold; font-size:20px; background:#0000007c; padding:10px;">
            <span>Sign out | {{ Auth::user()->first_name }}</span>
        </a>          
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
                   <li>
                        <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.index') ? 'active' : '' }}">Posts</a>
                    </li>

                    @if(Auth::user()->role == 'admin')
                    <li>
                        <a href="{{ route('category.index') }}" class="{{ request()->routeIs('category.index') ? 'active' : '' }}">Category</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">Users</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
