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
            <div class="col-md-12 mb-3" style="margin-bottom:10px;">
                <div class="row">
                    <div class="col-md-3 col-sm-12 mb-2">
                        <input type="text" class="form-control" id="searchInput" name="search"
                            placeholder="Search posts..." value="{{ request('search') }}">
                    </div>

                    @if(Auth::user()->role == 'admin')
                    <div class="col-md-3 col-sm-12 mb-2 text-md-right" style="margin-left:550px;  ">
                        <select id="statusFilter" class="form-control w-100" style="cursor: pointer;">
                            <option value="">-- Select Status --</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                            <option value="approved">Approved</option>                 
                        </select>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <table class="content-table" id="">
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
       // Handle the click event for action buttons 
       $(document).on('click', '.action-btn', function () {s
            
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

        //Search functionality
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

        //Filter of status 
        $('#statusFilter').on('change', function () {
            var status = $(this).val();

            $.ajax({
                url: '{{ route('posts.filter') }}',
                type: 'GET',
                dataType: 'json',
                data: { status: status },
                success: function(response) {
                    if (response.success) {
                        var html = '';
                        if (response.data.length === 0) {
                            html = '<tr><td colspan="10" class="text-center">No posts found</td></tr>';
                        }
                        $.each(response.data, function(index, post) {
                            var isFinal = (post.status === 'approved' || post.status === 'rejected');
                            var disabled = isFinal ? 'disabled' : '';

                            html += '<tr>';
                            html += '<td>' + post.id + '</td>';
                            html += '<td>' + capitalizeFirstLetter(post.title) + '</td>';
                            html += '<td>' + post.category.category_name + '</td>';
                            html += '<td>' + new Date(post.created_at).toLocaleDateString() + '</td>';
                            html += '<td>' + post.user.first_name + '</td>';
                            html += '<td>' + capitalizeFirstLetter(post.status) + '</td>';
                            html += '<td><a href="/export-post-pdf/' + post.id + '" class="btn btn-secondary"><i class="fa fa-download"></i></a></td>';

                            if ('{{ Auth::user()->role }}' === 'admin') {
                                html += '<td>';
                                html += '<button class="btn-primary action-btn" data-id="' + post.id + '" data-status="approved" ' + disabled + '>Approve</button>'; //To do the correction of this..
                                html += '<button class="btn-danger action-btn" data-id="' + post.id + '" data-status="rejected" ' + disabled + '>Reject</button>'; 
                                html += '</td>';
                            }

                            if (isFinal) {
                                html += '<td class="edit"><a href="javascript:void(0)" class="disabled-link"><i class="fa fa-edit"></i></a></td>';
                                html += '<td class="delete"><button class="disabled-btn" disabled><i class="fa fa-trash-o"></i></button></td>';
                            } else {
                                html += '<td class="edit"><a href="/posts/' + post.id + '/edit"><i class="fa fa-edit"></i></a></td>';
                                html += '<td class="delete"><form method="POST" action="/posts/' + post.id + '" class="delete-form" style="display:inline; background: none;">';
                                html += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                                html += '<input type="hidden" name="_method" value="DELETE">';
                                html += '<button type="submit" onclick="return confirm(\'Are you sure?\')"><i class="fa fa-trash-o"></i></button>';
                                html += '</form></td>';
                            }

                            html += '</tr>';
                        });

                        $('#postResults').html(html);
                    }
                },
                error: function(xhr) {
                    console.error('Error loading posts:', xhr);
                }
            });
        });

        //function to capitalize the first letter of a string
        function capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
         
    });
</script>
@endsection
