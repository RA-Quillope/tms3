@extends('layout')
@section('main-content')

    <div class="float-start mb-5">
        <h4>Tasks</h4>
    </div>

    <div class="float-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
            id="show-add-task">
            Add Task
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="task-form">

                        <span class="text-danger" id="task-error-msg">All fields are required</span>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desc" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="desc">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="user_id" class="col-sm-2 col-form-label">User</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="user_id">
                                    @foreach ($users as $user)
                                        <option value={{ $user->id }}>
                                            {{ $user->firstname . ' ' . $user->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add-task-btn">Add</button>
                    <button type="button" class="btn btn-primary" id="save-task-btn">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div id="task-pagination">
        @include('task.pagination')
    </div>

@endsection
