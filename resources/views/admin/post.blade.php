@extends('layouts.app')

@section('content')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="{{ route('posts.create') }}">Add post</a>
            </div>
            <div class="col-md-4" style="margin-bottom: 10px;">
                <input type="text" class="form-control" id="searchInput" name="search"
                    placeholder="Search posts..." value="{{ request('search') }}">
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
                            <th>Status</th>
                            <th>Download</th>
                            @if(Auth::user()->role == 'admin')
                            <th>Actions</th>
                            @endif    
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody id="postResults">
                        @include('admin.post-list', ['posts' => $posts])
                    </tbody>

                </table> 

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.action-btn').on('click', function() {
            var postId = $(this).data('id');
            var status = $(this).data('status');
           
            $.ajax({
                url: '/update-status' ,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                     id: postId,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Failed to update post status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while updating the post status.');
                }
            });
        });


       $('#searchInput').on('keyup', function() {
    var query = $(this).val();
    $.ajax({
        url: '{{ route('posts.index') }}',
        type: 'GET',
        data: { search: query },
        success: function(data) {
            $('#postResults').html(data);
        },
        error: function(xhr, status, error) {
            console.error('Search error:', error);
        }
    });
});

    });
</script>
@endsection
