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
        <a class="btn btn-secondary" href="/">Home</a>
    </div>
    <div class="clearfix"></div>
</header>
<section>
    <div class="container">
        <div id="auth-form" class="card text-center">
            <div class="card-header">
                Auth
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="input-login">Login</label>
                    <input id="input-login" type="text" name="login" class="form-control">
                </div>
                <div class="form-group">
                    <label for="input-password">Password</label>
                    <input id="input-password" type="password" name="password" class="form-control">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-primary btn-auth">Login</button>
            </div>
        </div>
    </div>
</section>
</body>
</html>