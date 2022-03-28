<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm">Create a Ticket</a>
                <hr>
                <form action="">
                       <input type="text" class="form-control" id="searchbox" name="searchbox">
                       <button type="submit" class="btn btn-warning btn-sm">Search</button>
                </form>
                <hr>
                <table class="table table-bordered">

                       <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Label</th>
                        <th>Assignee ID</th>
                        <th>Submitter ID</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Actions</th>


                       </tr>

                    @foreach ($tickets as $ticket)
                       <tr>
                        <td>{{ $ticket->id }} </td>
                        <td>{{ $ticket->name }} </td>
                        <td>{{ $ticket->subject }} </td>
                        <td>{{ $ticket->label }}</td>
                        <td>{{ $ticket->assignee->name}} </td>
                        <td>{{ $ticket->submitter->name }} </td>
                        <td>{{ $ticket->priority }} </td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ date('M d, Y h:i',strtotime($ticket->created_at)) }}</td>
                        <td>{{ date('M d, Y h:i',strtotime($ticket->updated_at)) }}</td>
                        <td><a href ='/tickets/{{$ticket->id}}' ><button type="button" class="btn btn-outline-primary">Edit</button></a>
                        <form method="POST" action="/tickets/{{$ticket->id}}">
                        @method('DELETE')
                        @csrf
                        <a href = ''><button type="submit" class="btn btn-outline-danger" >Delete</button></a>
                        </form>
                    </td>

                       </tr>
                    @endforeach

                   </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
