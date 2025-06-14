@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">
                   {{ isset($posts) ? 'Edit Post' : 'Add new post'}}     
                </h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action=" {{ isset($posts) ? route('posts.update', $posts->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($posts))
                        @method('PUT')
                    @endif
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="title" class="form-control" autocomplete="off" value="{{ old('title', $posts->title ?? '') }}">
                          @error('title')
                              <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror  
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="description" class="form-control" rows="5"  > {{ $posts->description ?? '' }}</textarea>
                          @error('description')
                              <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option value="" selected disabled> Select Category</option>
                              @foreach ($categorys as $category)
                                  <option
                                    value="{{ $category->id }}"{{ old('category', $posts->category ?? '') == $category->id ? 'selected' : '' }}
                                    >
                                    {{ $category->category_name ??  ''}}
                                   </option>
                              @endforeach
                          </select>
                           @error('category')
                              <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror 
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="post_image" value=" {{ $posts->post_image ?? '' }}" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])">
                        <div style="width:100px; overflow:hidden;">
                            @if(isset($posts))
                            <img  
                                id="output"
                                src="{{ asset('/storage/'.$posts->post_image) }}" 
                                alt="Post Image" 
                                style="width:100%; height:auto; display:block;"
                            >
                            </div>
                            @endif
                           @error('post_image')
                              <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror 
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save"  />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
@endsection
