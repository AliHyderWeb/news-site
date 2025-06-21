<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search ....."> 
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->

    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        @foreach ($latestPosts as $latestPost )
        <div class="recent-post">
            <a class="post-img" href=" {{ route('posts.show.single', $latestPost->id) }}">
                <img  src="{{ asset('storage/' . $latestPost->post_image) }}" alt="Post Image" />
            </a>
            <div class="post-content">
                <h5><a href="{{ route('posts.show.single', $latestPost->id) }}">{{ $latestPost->title }}</a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href="{{ route('posts.show.category', $latestPost->category->id) }}">{{ $latestPost->category->category_name }}</a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                   {{ $latestPost->created_at->format('F j, Y') }}
                </span>
                <a class="read-more" href="{{ route('posts.show.single', $latestPost->id) }}">read more</a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /recent posts box -->
</div>
