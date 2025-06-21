@include('partials.public-header')

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @yield('content')
            </div>
            @include('partials.public-sidebar')
        </div>
    </div>
</div>

@include('partials.public-footer')
