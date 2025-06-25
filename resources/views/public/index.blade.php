@extends('layouts.public')

@section('content')
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    {{-- Repeat post-content 6 times as dummy --}}
                    @foreach($posts  as $post)
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="{{ route('posts.show.single', $post->id) }}"><img src="{{ asset('storage/' . $post->post_image) }}" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="{{ route('posts.show.single', $post->id) }}"> {{ $post->title }} </a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                           <a href="{{ route('posts.show.category', $post->category->id) }}">{{ $post->category->category_name }}</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="{{ route('posts.show.author', $post->user_id) }}">{{ $post->user->first_name }}</a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ $post->created_at->format('F j, Y') }}
                                        </span>
                                    </div>
                                    <p class="description">
                                        {{ $post->description }}
                                    </p>
                                    <a class='read-more pull-right' href=" {{ route('posts.show.single', $post->id) }} ">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                            <div>
                                @if($posts->hasPages())
                                    {{ $posts->links('pagination::bootstrap-4') }}
                                @endif
                            </div>
                            <div class="text-black">
                                Total records: {{ $posts->total() }} <br>
                                Current Page: {{  $posts->currentPage() }}
                            </div>
                        </div>
                </div><!-- /post-container -->
            </div>
        </div>
    </div>
</div>
@endsection
