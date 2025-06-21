@extends('layouts.public')

@section('content')
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading">Search : Search Term</h2>

                 
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="#"><img src="{{ asset('images/post-format.jpg') }}" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="#">PHP</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="#">Admin</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            01 Nov, 2019
                                        </span>
                                    </div>
                                    <p class="description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua....
                                    </p>
                                    <a class='read-more pull-right' href="#">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  

                    <ul class='pagination'>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                    </ul>
                </div><!-- /post-container -->
            </div>

            @include('partials.sidebar')
        </div>
    </div>
</div>
@endsection
