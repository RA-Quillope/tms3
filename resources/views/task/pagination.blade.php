<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-3">User</th>
            <th class="col-3">Title</th>
            <th class="col-3">Description</th>
            <th class="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->user->firstname . ' ' . $task->user->lastname }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->desc }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-id="{{ $task->id }}" data-title="{{ $task->title }}" data-desc="{{ $task->desc }}"
                        data-user_id="{{ $task->user_id }}" id="show-edit-task">Edit</button>
                    <button type="button" class="btn btn-danger" id="delete-task"
                        data-id="{{ $task->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $tasks->links('pagination::bootstrap-4') }}
</div>
