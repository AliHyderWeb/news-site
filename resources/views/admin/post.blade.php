@extends('layouts.app')

@section('content')
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="{{ route('add.post') }}">add post</a>
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
                        {{-- Dummy Data Rows --}}
                        <tr>
                            <td class='id'>1</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Html</td>
                            <td>01 Nov, 2019</td>
                            <td>Admin</td>
                            <td class='edit'><a href="#"><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href="#"><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <tr>
                            <td class='id'>2</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Html</td>
                            <td>01 Nov, 2019</td>
                            <td>Admin</td>
                            <td class='edit'><a href="#"><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href="#"><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <tr>
                            <td class='id'>3</td>
                            <td>Lorem ipsum dolor sit amet</td>
                            <td>Html</td>
                            <td>01 Nov, 2019</td>
                            <td>Admin</td>
                            <td class='edit'><a href="#"><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href="#"><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        {{-- aur jitni rows chahiye, vaise daal sakte ho --}}
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
