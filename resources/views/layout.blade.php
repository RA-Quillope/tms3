<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Laravel</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Task Management System v3.0</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/user">Users</a>
                    <a class="nav-link active" aria-current="page" href="/">Tasks</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">

        @yield('main-content')

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {

        let id_task;
        let id_user;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //TASK PAGINATION
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_task_data(page);
        });

        function fetch_task_data(page) {
            $.ajax({
                url: 'fetch_task_data?page=' + page,
                success: function(data) {
                    $('#task-pagination').html(data);
                }
            });
        }

        //USER PAGINATION
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_user_data(page);
        });

        function fetch_user_data(page) {
            $.ajax({
                url: 'fetch_user_data?page=' + page,
                success: function(data) {
                    $('#user-pagination').html(data);
                }
            });
        }

        //SHOW ADD TASK MODAL
        $(document).on('click', '#show-add-task', function(e) {

            $('#task-form').trigger("reset");
            $('#save-task-btn').hide();
            $('#add-task-btn').show();
            $('#task-error-msg').hide();
            $('#exampleModalLabel').text('New Task');
        });

        //SHOW ADD USER MODAL
        $(document).on('click', '#show-add-user', function(e) {

            $('#user-form').trigger("reset");
            $('#save-user-btn').hide();
            $('#add-user-btn').show();
            $('#user-error-msg').hide();
            $('#userModalLabel').text('Edit User');
        });

        //ADD TASK
        $(document).on('click', '#add-task-btn', function(e) {
            var title = $('#title').val();
            var desc = $('#desc').val();
            var user_id = $('#user_id').val();
            $.ajax({
                url: '/task',
                method: 'POST',
                data: {
                    title: title,
                    desc: desc,
                    user_id: user_id
                },
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    $('#task-pagination').load("/fetch_task_data",
                        function() {
                            $('#task-pagination').fadeIn();
                        });
                },
                error: function(response) {

                    $('#task-error-msg').show();
                }
            });
        });

        //ADD USER
        $(document).on('click', '#add-user-btn', function(e) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            $.ajax({
                url: '/user',
                method: 'POST',
                data: {
                    firstname: firstname,
                    lastname: lastname
                },
                success: function(response) {
                    $('#userModal').modal('hide');
                    $('#user-pagination').load("/fetch_user_data",
                        function() {
                            $('#user-pagination').fadeIn();
                        });
                },
                error: function(response) {

                    $('#user-error-msg').show();
                }
            });
        });

        //DELETE TASK
        $(document).on('click', '#delete-task', function(e) {
            var id = $(this).data('id');
            $.ajax({
                url: 'task/' + id,
                method: 'DELETE',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#task-pagination').load("/fetch_task_data",
                        function() {
                            $('#task-pagination').fadeIn();
                        });
                }
            });
        });

        //DELETE USER
        $(document).on('click', '#delete-user', function(e) {
            var id = $(this).data('id');
            $.ajax({
                url: 'user/' + id,
                method: 'DELETE',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#user-pagination').load("/fetch_user_data",
                        function() {
                            $('#user-pagination').fadeIn();
                        });
                }
            });
        });

        //SHOW EDIT TASK MODAL
        $(document).on('click', '#show-edit-task', function(e) {

            $('#save-task-btn').show();
            $('#add-task-btn').hide();
            $('#exampleModalLabel').text('Edit Task');

            var title = $(this).data('title');
            var desc = $(this).data('desc');
            var user_id = $(this).data('user_id');
            $('#title').val(title);
            $('#desc').val(desc);
            $('#user_id').val(user_id);
            id_task = $(this).data('id');
            $('#task-error-msg').hide();

        });

        //SHOW EDIT USER MODAL
        $(document).on('click', '#show-edit-user', function(e) {

            $('#save-user-btn').show();
            $('#add-user-btn').hide();
            $('#userModalLabel').text('Edit User');

            var firstname = $(this).data('firstname');
            var lastname = $(this).data('lastname');
            $('#firstname').val(firstname);
            $('#lastname').val(lastname);
            id_user = $(this).data('id');
            $('#user-error-msg').hide();

        });

        //EDIT TASK
        $(document).on('click', '#save-task-btn', function(e) {
            var title = $('#title').val();
            var desc = $('#desc').val();
            var user_id = $('#user_id').val();

            $.ajax({
                url: 'task/' + id_task,
                method: 'PATCH',
                data: {
                    title: title,
                    desc: desc,
                    user_id: user_id
                },
                success: function(response) {
                    $('#exampleModal').modal('hide');
                    $('#task-pagination').load("/fetch_task_data",
                        function() {
                            $('#task-pagination').fadeIn();
                        });
                },
                error: function(response) {

                    $('#task-error-msg').show();
                }
            });
        });

        //EDIT USER
        $(document).on('click', '#save-user-btn', function(e) {
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();

            $.ajax({
                url: 'user/' + id_user,
                method: 'PATCH',
                data: {
                    firstname: firstname,
                    lastname: lastname
                },
                success: function(response) {
                    $('#userModal').modal('hide');
                    $('#user-pagination').load("/fetch_user_data",
                        function() {
                            $('#user-pagination').fadeIn();
                        });
                },
                error: function(response) {

                    $('#user-error-msg').show();
                }
            });
        });

        //SHOW USER TASKS
        $(document).on('click', '#show-user-tasks', function(e) {
            $('#table-body').empty();
            var firstname = $(this).data('firstname');
            $('#userTasksLabel').text(firstname + "'s Tasks")
            url = $(this).data('route');
            $.ajax({
                url: url,
                success: function(data) {
                    $('#table-body').html(data);
                }
            });
        });

    });

</script>
