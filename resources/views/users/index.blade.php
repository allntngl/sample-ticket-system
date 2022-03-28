<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Create a Users</a>
                  <hr>


                  <form >
                      <input type="text" class="form-control" name="searchbox" id="searchbox" >
                      <button type="submit" class="btn btn-warning btn-sm">Search</button>
                  </form>

                  <hr>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>


                        <th>
                            Created_at
                        </th>

                        <th>
                            Updated_at
                        </th>

                        <th>
                            Role
                        </th>





                      </tr>

                    </thead>
                    <tbody>


                        @foreach ($user as $user)
                        <tr>
                            <td>
                              {{ $user->id }}
                            </td>

                            <td>
                              {{ $user->name }}
                           </td>

                            <td>
                              {{ $user->email }}
                           </td>

                           <td>
                            {{date('M d, Y h:i', strtotime($user->created_at )) }}
                        </td>

                        <td>
                            {{date('M d, Y h:i', strtotime($user->updated_at )) }}
                        </td>


                        <td>
                            {{ $user->role }}
                         </td>

                        <td>
                            <a href="/users/{{ $user->id }}">
                                <button type="button" class="btn btn-outline-primary">Edit</button>
                            </a>
                            <form method="POST" action="/users/{{ $user->id }}">
                                @method('DELETE')
                                @csrf
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                        </td>


                        @endforeach
                  </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
