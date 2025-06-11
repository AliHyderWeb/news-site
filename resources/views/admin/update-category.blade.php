@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action=" {{ route('category.update', $category->id) }} " method ="POST">
                    @csrf
                    @method('PUT')
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value=" {{ $category->category_name }} "  placeholder="" >
                      </div>
                      <button type="submit" name="sumbit" class="btn btn-primary" >Update</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection
