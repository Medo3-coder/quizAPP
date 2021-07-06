@extends('backend.layouts.master')

	@section('title','All Users')


	@section('content')

    <div class="span9">
        <div class="content">

            @if (Session::has('message'))

            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>

          @endif

            <div class="module">
                <div class="module-head">
                    <h3>All Users</h3>
                </div>

                <div class="module-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>name</th>
                          <th>email</th>

                          <th>password</th>
                          <th>occupation</th>
                          <th>address</th>
                          <th>phone</th>

                        </tr>
                      </thead>
                      <tbody>

                        @if (count($users) > 0)

                        @foreach ($users as $key=>$user)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->visible_password }}</td>
                          <td>{{ $user->occupation }}</td>
                          <td>{{ $user->address }}</td>
                          <td>{{ $user->phone }}</td>


                          <td>
                              <a href="{{ route('user.edit',[$user->id]) }}">
                                  <button class="btn btn-primary">Edit</button>
                              </a>
                          </td>

                          <td>

                            {{-- to delete record --}}

                            <form action="{{ route('user.destroy',[$user->id]) }}" id="delete-form{{ $user->id }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}

                            </form>

                            <a href="#"
                            onclick="if(confirm('Do you Want To Delete ?')){
                              event.preventDefault();
                              document.getElementById('delete-form{{ $user->id }}').submit()
                            }
                            else
                            {
                                event.preventDefault();
                            }
                            ">
                            <input type="submit" value="Delete" class="btn btn-danger">
                            </a>



                          </td>

                        </tr>
                        @endforeach

                        @else

                        <td>No User To Display</td>

                        @endif



                      </tbody>
                    </table>
                    {{-- bootstrap Pagination  --}}
                    <div class="pagination pagination-centered">
                        {{ $users->links() }}
                    </div>

                   </div>
               </div>

            </div>

           </div>
    </div>


    @endsection


