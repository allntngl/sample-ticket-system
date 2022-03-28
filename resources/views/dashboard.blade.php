<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <a href="{{ route('my.tickets.create') }}" class="btn btn-primary btn-sm">Submit a Ticket</a>
                <hr>
                <form action="">
                       <input type="text" class="form-control mr-sm-2" id="searchbox" name="searchbox">
                       <button type="submit" class="btn btn-warning btn-sm">Search</button>
                </form>
                <hr>
                @foreach ($tickets as $ticket)
                <table class="table table-striped">
                    <div class="album py- bg-light">
                        <div class="container">
                          <div class="card">
                            <div class="card text-center">

                                <div class="card-body ">
                                  <h1 class="card-text"><b>{{ $ticket->name }}</b></h1>
                                  <p class="card-text">Assignee: {{ $ticket->assignee->name}}</p>
                                  <p class="card-text">Status: {{ $ticket->status}}</p>
                                  <p class="card-text">Status: {{ $ticket->priority}}</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                      <div style="display: flex; justify-content: flex-end"><a href ='/my/tickets/{{$ticket->id}}' ><button type="button" class="btn btn-outline-primary">Edit</button></a>
                                        <form method="POST" action="/my/tickets/{{$ticket->id}}">
                                        @method('DELETE')
                                        @csrf
                                        </form>
                                    </div>
                                    </div>
                                    <a href = ''><button type="submit" class="btn btn-outline-danger" >Delete</button></a>
                                  </div>
                                </div>

                              </div>
                          </div>
                        </div>
                      </div>



{{--
                       <tr>
                        <td> {{ $ticket->id }}</td>
                        <td>{{ $ticket->name }} </td>
                        <td>{{ $ticket->subject }} </td>
                        <td>{{ $ticket->label }}</td>
                        <td>{{ $ticket->assignee->name}} </td>

                        <td>{{ $ticket->priority }} </td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ date('M d, Y h:i',strtotime($ticket->created_at)) }}</td>
                        <td>{{ date('M d, Y h:i',strtotime($ticket->updated_at)) }}</td>
                        <td><a href ='/my/tickets/{{$ticket->id}}' ><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                        <form method="POST" action="/my/tickets/{{$ticket->id}}">
                        @method('DELETE')
                        @csrf
                        <a href = ''><button type="submit" class="btn btn-danger btn-sm" >Delete</button></a>
                        </form>
                    </td>

                       </tr> --}}
                    @endforeach

                   </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
