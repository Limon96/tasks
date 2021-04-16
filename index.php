<?php
mb_internal_encoding("UTF-8");

set_include_path(
    get_include_path() . PATH_SEPARATOR .
    "app/controller" . PATH_SEPARATOR .
    "app/lib" . PATH_SEPARATOR .
    "app/model" . PATH_SEPARATOR .
    "app/view" . PATH_SEPARATOR
);
spl_autoload_extensions(".php");
spl_autoload_register();

include __DIR__ . '/app/lib/config.php';

session_start();

if (isset($_GET['v']) && $_GET['v'] == 'task') {
    $controller = new TaskController();
} elseif (isset($_GET['v']) && $_GET['v'] == 'login') {
    $controller = new LoginController();
} elseif (isset($_GET['v']) && $_GET['v'] == 'logout') {
    $controller = new LogoutController();
} else {
    $controller = new HomeController();
}

if (isset($_GET['act']) && $_GET['act'] == 'login') {
    $output = $controller->login();
} elseif (isset($_GET['act']) && $_GET['act'] == 'add') {
    $output = $controller->add();
} elseif (isset($_GET['act']) && $_GET['act'] == 'edit') {
    $output = $controller->edit();
} else {
    $output = $controller->index();
}

echo $output;