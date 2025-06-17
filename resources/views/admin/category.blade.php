@extends('layouts.app')

@section('content')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="{{ route('category.create') }}">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category )
                            <tr>
                            <td class='id'> {{ $category->id }} </td>
                            <td>{{ $category->category_name}}</td>
                            <td>{{ $category->posts }}</td>
                            <td class='edit'><a href=' {{ route('category.edit', $category->id) }} '><i class='fa fa-edit'></i></a></td>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <td class='delete'><button type="submit" onclick="return confirm('Are you sure?')"><i class='fa fa-trash-o'></i></button></td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table> 
                 <div class="primary">
                   <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div>
                            @if($categories->hasPages())
                                {{ $categories->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                        <div class="text-black">
                            Total records: {{ $categories->total() }} <br>
                            Current Page: {{ $categories->currentPage() }}
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
