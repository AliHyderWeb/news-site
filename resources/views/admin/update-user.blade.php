@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="{{ route('users.update', $user->id) }}" method ="POST">
                    @csrf
                    @method('PUT')
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" placeholder="" >
                           @error('first_name')
                             <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" placeholder="" >
                           @error('last_name')
                             <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label>User Email</label>
                          <input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="" >
                           @error('email')
                             <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Normal User</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update"  />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
@endsection
