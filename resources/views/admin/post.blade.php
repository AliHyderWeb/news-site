@extends('layouts.app')

@section('content')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="{{ route('posts.create') }}">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td class='id'>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->category_name }}</td>
                            <td>{{ date('d M, Y', strtotime($post->created_at)) }}</td>
                            <td>{{ $post->user->first_name ?? 'Unknown' }}</td>
                            <td class='edit'><a href="{{ route('posts.edit', $post->id) }}"><i class='fa fa-edit'></i></a></td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <td class='delete'><button type="submit"><i class='fa fa-trash-o'></i></button></td>
                            </form>
                        </tr>
                        @endforeach
                        @if($posts->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No posts available</td>
                        </tr>
                        @endif
                    </tbody>
                </table> 
                 <div class="primary">
                    @if($posts )
                    <div class="btn primary-btn">{{ $posts->links() }}</div> 
                     <div class="text-black"> Total records are {{ $posts->total() }} <br> Current Page is  {{ $posts->currentPage() }}</div>   
                    @endif
                   
                </div>
                <div class="primary">
                    @if(session('success'))
                        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
