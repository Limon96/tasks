<?php

class LoginController extends Controller {

    public function index() {

        return $this->view->load('login');
    }

    public function login()
    {
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($this->request->post['login']) || !$this->request->post['login']) {
                $json['error_login'] = 'Введите логин';
            }

            if (!isset($this->request->post['password']) || !$this->request->post['password']) {
                $json['error_password'] = 'Введите пароль';
            }

            if (!$json) {
                $user_id = $this->user->login([
                    "login" => $this->request->post['login'],
                    "password" => $this->request->post['password'],
                ]);

                if ($user_id) {
                    $json['success'] = 'Успешно авторизован!';
                } else {
                    $json['error_auth'] = 'Неверные логин или пароль';
                }
            }
        }

        return json_encode($json);
    }

}