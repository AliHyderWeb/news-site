@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12"> 
                  <h1 class="admin-heading">{{ isset($user) ? 'Edit user' : 'Add  User' }}</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action=" {{ isset($user) ?  route('users.update', $user->id) : route('users.store') }}" method ="POST" autocomplete="off">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="first_name" class="form-control  @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name', $user->first_name ?? '')  }}" >
                            @error('first_name')
                               <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name' ,$user->last_name ?? '') }}" >
                          @error('last_name')
                               <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label>User Email</label>
                          <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username" value="{{ old('email', $user->email ?? '') }}" >
                          @error('email')
                               <p class="text-danger bold">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                       @if(!isset($user))
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value= " {{ old('password') }} " >
                          @error('password')
                             <p class="text-danger">
                                  {{ $message }}
                              </p>
                          @enderror
                      </div>
                       @endif 
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                               <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Normal User</option>
                                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                          </select>
                      </div>
                          <button type="submit"  name="save" class="btn btn-primary" > Save </button>
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
@endsection
