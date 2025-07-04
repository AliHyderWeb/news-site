@extends('layouts.app')

@section('content')
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="{{ route('users.create') }}">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Email</th>
                          <th>Role</th>
                          <th>Download</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        @if($users)
                        @foreach($users as $user)
                            <tr>
                              <td class='id'> {{ $user->id }} </td>
                              <td> {{ ucfirst($user->first_name )}}  {{ $user->last_name }}</td>
                              <td> {{ $user->email }}</td>
                              <td> {{ ucfirst($user->role) }}</td>
                              <td> <a href="{{ route('users.pdf', $user->id) }}"><i class='fa fa-download'></i></a> </td>
                              <td class='edit'><a href='{{ route('users.edit', $user->id) }}'><i class='fa fa-edit'></i></a></td>
                              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
                              @csrf
                              @method('DELETE')
                              <td class='delete'><button type="submit" onclick="return confirm('Are you sure?')"><i class='fa fa-trash-o'></i></button></td>
                              </form>
                          </tr>   
                        @endforeach
                         @if($users->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No Users available</td>
                        </tr>
                        @endif
                        @endif
                      </tbody>
                  </table> 
                 <div class="primary">
                   <div class="d-flex justify-content-between align-items-center flex-wrap mt-4">
                        <div>
                            @if($users->hasPages())
                                {{ $users->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                        <div class="text-black">
                            Total records: {{ $users->total() }} <br>
                            Current Page: {{ $users->currentPage() }}
                        </div>
                    </div>
                </div>
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
@endsection
