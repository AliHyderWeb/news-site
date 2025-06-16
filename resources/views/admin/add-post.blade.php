@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">
                      {{ isset($posts) ? 'Edit Post' : 'Add New Post' }}
                  </h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="{{ isset($posts) ? route('posts.update', $posts->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @if(isset($posts))
                          @method('PUT')
                      @endif

                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $posts->title ?? '') }}" autocomplete="off">
                          @error('title')
                              <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $posts->description ?? '') }}</textarea>
                          @error('description')
                              <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                      <!-- Category Dropdown -->
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $posts->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                      <div class="form-group">
                          <label for="post_image">Post Image</label>
                          <input type="file" name="post_image" class="form-control-file" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])">
                          @if(isset($posts) && $posts->post_image)
                              <div class="mt-2" style="width:100px; overflow:hidden;">
                                  <img id="output" src="{{ asset('/storage/' . $posts->post_image) }}" alt="Post Image" style="width:100%; height:auto; display:block;">
                              </div>
                          @endif
                          @error('post_image')
                              <p class="text-danger">{{ $message }}</p>
                          @enderror
                      </div>

                      <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                  <!-- Form End -->
              </div>
          </div>
      </div>
  </div>
@endsection
