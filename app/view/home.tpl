<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>
    <link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script type="text/javascript" src="../assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
</head>
<body>
<header>
    <div class="auth-control">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#addTaskModal">Add New</button>
        <?php if ($is_logged) { ?>
        <button class="btn btn-primary btn-logout">Logout</button>
        <?php } else { ?>
        <button class="btn btn-primary" data-toggle="modal" data-target="#authModal">Auth</button>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</header>
<section>
    <div class="container">
        <div class="sorts">
            <?php foreach ($sorts as $item) { ?>
            <?php if ($item['order'] == $order) { ?>
            <a class="active" href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?><span><?php echo ($sort == 'DESC' ? 'v': '^'); ?></span></a>
            <?php } else { ?>
            <a href="<?php echo $item['href']; ?>"><?php echo $item['name']; ?></a>
            <?php } ?>
            <?php } ?>
        </div>
        <div class="task-content">
        <?php if ($tasks) { ?>
        <?php foreach ($tasks as $task) { ?>
        <div class="card">
            <div class="card-body">
                <h4><?php echo $task['name']; ?></h4>
                <h5><?php echo $task['email']; ?></h5>
                <p class="card-text"><?php echo $task['text']; ?></p>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-edit" data-task_id="<?php echo $task['task_id']; ?>">Edit</button>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
        </div>
        <ul class="pagination">
        <?php if ($pagination) { ?>
        <?php foreach ($pagination['items'] as $item) { ?>
            <?php if ($pagination['current'] == $item['text']) { ?>
            <li class="active"><?php echo $item['text']; ?></li>
            <?php } else { ?>
            <li><a href="<?php echo $item['href']; ?>"><?php echo $item['text']; ?></a></li>
            <?php } ?>
        <?php } ?>
        <?php } ?>
        </ul>
    </div>
</section>
<!-- taskModal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskLabel">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-add-name">Name</label>
                    <input id="input-add-name" type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="input-add-email">Email</label>
                    <input id="input-add-email" type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="textarea-add-text">Text</label>
                    <textarea id="textarea-add-text" name="text" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-task-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php if ($is_logged) { ?>
<!-- taskModal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="textarea-edit-text">Text</label>
                    <textarea id="textarea-edit-text" name="text" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="input-edit-status">Status</label>
                    <input id="input-edit-status" type="checkbox" name="status" value="1" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="task_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-task-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!-- authModal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authLabel">Auth</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-login">Login</label>
                    <input id="input-login" type="text" name="login" class="form-control">
                </div>
                <div class="form-group">
                    <label for="input-password">Password</label>
                    <input id="input-password" type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-auth">Login</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>