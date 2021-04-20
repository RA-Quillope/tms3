<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-3">First Name</th>
            <th class="col-3">Last Name</th>
            <th class="col-3">Number of tasks</th>
            <th class="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->tasks->count() }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userTasks"
                        id="show-user-tasks" data-id="{{ $user->id }}" data-firstname="{{ $user->firstname }}"
                        data-route="{{ route('fetch_user_tasks', $user->id) }}">
                        Show
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#userModal"
                        data-id="{{ $user->id }}" data-firstname="{{ $user->firstname }}"
                        data-lastname="{{ $user->lastname }}" id="show-edit-user">Edit</button>
                    <button type="button" class="btn btn-danger" id="delete-user"
                        data-id="{{ $user->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
