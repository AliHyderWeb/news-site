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
                              <td class='edit'><a href='{{ route('users.edit', $user->id) }}'><i class='fa fa-edit'></i></a></td>
                              <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
                              @csrf
                              @method('DELETE')
                              <td class='delete'><button type="submit"><i class='fa fa-trash-o'></i></button></td>
                              </form>
                          </tr>   
                        @endforeach
                        @endif
                      </tbody>
                  </table> 
                  <div class="primary">
                    @if($users )
                    <div class="btn primary-btn">{{ $users->links() }}</div> 
                     <div class="text-black"> Total records are {{ $users->total() }} <br> Current Page is  {{ $users->currentPage() }}</div>   
                    @endif
                   
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
