<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
            {{ __('Tickets / Create') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form  method="POST" action="./">
                @csrf

                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

                <div>
                    <label for="subject" class="form-label">Subjects</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                </div>

                <div>
                    <label for="label" class="form-label">Label</label>
                    <input type="text" class="form-control" id="label" name="label" placeholder="Label">
                </div>

                <div>
                    <label for="assignee_id" class="form-label">Assignee</label>
                    <select class="form-select" aria-label="Default select example" id="assignee_id" name="assignee_id" >

                        @foreach ($users as $user)
                        <option value="{{$user->id}}" {{($user->assignee_id==$user->id) ?"selected" :""}}>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="priority" class="form-label">Priority</label>
                    <select class="form-select" aria-label="Default select example" id="priority" name="priority">

                        <option value="High" {{($user->priority=='High') ?"selected" :"''"}}>High</option>
                        <option value="Mid" {{($user->priority=='Mid') ?"selected" :"''"}}>Mid</option>
                        <option value="Low" {{($user->priority=='Low') ?"selected" :"''"}}>Low</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" id="status" name="status">

                    <option value="Rejected" {{($user->status=='Rejected') ?"selected" :"''"}}>Rejected</option>
                    <option value="Resolve" {{($user->status=='Resolve') ?"selected" :"''"}}>Resolve</option>
                    </select>
                </div>



                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn btn-success">Create Ticket</button>
                </div>

                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
