@extends('layouts.public')

@section('content')
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                
                <div class="post-container">
                    <div class="post-content single-post">
                        <h3>{{ $post->title  }}</h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                 {{ $post->category->category_name  }}
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <a href="{{ route('posts.show.author', $post->user_id) }}">{{ $post->user->first_name  }}</a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                {{ $post->created_at->format('F j, Y') }}
                            </span>
                        </div>
                        <img class="single-feature-image" src="{{ asset('storage/'. $post->post_image) }}" alt="Post Title" />
                        <p class="description">
                           {{ $post->description  }} 
                        </p>
                    </div>
                </div>
               
                <!-- /post-container -->
            </div>

           
        </div>
    </div>
</div>
@endsection
