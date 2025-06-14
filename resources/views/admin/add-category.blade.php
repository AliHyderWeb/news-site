@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">
                   {{ isset($category) ? 'Edit Category' : 'Add New Category' }} 
                </h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="{{ isset($category) ? route('category.update', $category->id) :  route('category.store') }}" method="POST" autocomplete="off">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{ old('category_name', $category->category_name ?? '') }}" required>
                      </div>
                      <button type="submit" name="save" class="btn btn-primary" value="Save" >Save</button>
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
@endsection

