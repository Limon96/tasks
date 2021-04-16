$(document).on('click','#addTaskModal .btn-task-save', function (e) {
    e.preventDefault();
    $('.error').remove();

    $.ajax({
        url : '../index.php?v=task&act=add',
        method : 'POST',
        data : $('#addTaskModal input, #addTaskModal textarea'),
        dataType : 'json',
        success : function (json) {
            if (json['error_name']) {
                $('#addTaskModal input[name=name]').after("<div class='error'>" + json['error_name'] + "</div>");
            }
            if (json['error_email']) {
                $('#addTaskModal input[name=email]').after("<div class='error'>" + json['error_email'] + "</div>");
            }
            if (json['error_text']) {
                $('#addTaskModal textarea[name=text]').after("<div class='error'>" + json['error_text'] + "</div>");
            }

            if (json['success']) {
                $('.container').prepend("<div class='alert alert-success'>" + json['success'] + "</div>");
                $('.task-content').load(location.href + ' .task-content > div');
                $('#addTaskModal').modal('hide');
                $('#addTaskModal input[name=name]').val('');
                $('#addTaskModal input[name=email]').val('');
                $('#addTaskModal textarea[name=text]').val('');
            }
        }
    });
});

$(document).on('click','#editTaskModal .btn-task-save', function (e) {
    e.preventDefault();
    $('.error').remove();

    $.ajax({
        url : '../index.php?v=task&act=edit',
        method : 'POST',
        data : $('#editTaskModal input, #editTaskModal textarea'),
        dataType : 'json',
        success : function (json) {
            if (json['error_text']) {
                $('#editTaskModal textarea[name=text]').after("<div class='error'>" + json['error_text'] + "</div>");
            }
            if (json['error_auth']) {
                $('.task-content').load(location.href + ' .task-content > div');
                $('#editTaskModal .modal-body').prepend("<div class='alert alert-danger'>" + json['error_auth'] + "</div>");
            }

            if (json['success']) {
                $('.container').prepend("<div class='alert alert-success'>" + json['success'] + "</div>");
                $('.task-content').load(location.href + ' .task-content > div');
                $('#editTaskModal').modal('hide');
                $('#editTaskModal input[name=task_id]').val('');
                $('#editTaskModal input[name=status]').prop('checked', false);
                $('#editTaskModal textarea[name=text]').val('');
            }
        }
    });
});

$(document).on('click','.btn-edit', function (e) {
    e.preventDefault();
    var task_id = parseInt($(this).data('task_id'));
    $.ajax({
        url : '../index.php?v=task&task_id=' + task_id,
        method : "GET",
        dataType : 'json',
        success : function (json) {
            if (json['task']) {
                $('#editTaskModal').modal('show');
                $('#editTaskModal input[name=task_id]').val(json['task']['task_id']);
                $('#editTaskModal input[name=status]').prop('checked', (json['task']['status'] == 1 ? true: false));
                $('#editTaskModal textarea[name=text]').val(json['task']['text']);
            }
        }
    });

});

$(document).on('click','#auth-form .btn-auth', function (e) {
    e.preventDefault();
    $('.error, .alert').remove();

    $.ajax({
        url : '../index.php?v=login&act=login',
        method : 'POST',
        data : $('#auth-form input'),
        dataType : 'json',
        success : function (json) {
            if (json['error_login']) {
                $('#auth-form input[name=login]').after("<div class='error'>" + json['error_login'] + "</div>");
            }
            if (json['error_password']) {
                $('#auth-form input[name=password]').after("<div class='error'>" + json['error_password'] + "</div>");
            }
            if (json['error_auth']) {
                $('#auth-form .card-body').prepend("<div class='alert alert-danger'>" + json['error_auth'] + "</div>");
            }

            if (json['success']) {
                location.href = '/';
            }
        }
    });
});

$(document).on('click','.btn-logout', function (e) {
    e.preventDefault();
    $.ajax({
        url : '../index.php?v=logout',
        method : 'GET',
        success : function (json) {
            location.reload();
        }
    });
});