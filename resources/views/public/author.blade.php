@extends('layouts.public')

@section('content')
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <h2 class="page-heading">  {{ $user->first_name  }} {{ $user->last_name  }} | Role: {{$user->role}} </h2>
                    {{-- // for repeating the author post content --}}
                    @foreach ($posts as $post )
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="{{ route('posts.show.single', $post->id) }}"><img src="{{ asset('storage/'. $post->post_image) }}" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="{{ route('posts.show.single', $post->id) }}">{{ $post->title ?? 'N/A' }}</a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href="{{ route('posts.show.category', $post->category->id) }}">{{ $post->category->category_name ?? 'N/A' }}</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="{{ route('posts.show.author', $post->user_id) }}">{{ $post->user->first_name  ?? 'No name'}}</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ $post->created_at->format('F j, Y')  ?? 0}}
                                        </span>
                                    </div>
                                    <p class="description">
                                       {{ $post->description ?? 'N/A'}}
                                    </p>
                                    <a class='read-more pull-right' href="{{ route('posts.show.single', $post->id) }}">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                   
                </div><!-- /post-container -->
            </div>
        </div>
    </div>
</div>
@endsection
