<?php

class User {

    private $user_id;

    public function __construct()
    {
        $this->user_id = $this->auth();
    }

    public function auth()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
            $user_model = new UserModel();

            $user_info = $user_model->getUser([
                'login' => $_SESSION['login'],
                'password' => $_SESSION['password']
            ]);

            if ($user_info) {
                return $user_info['user_id'];
            } else {
                $this->logout();
            }
        }

        return false;
    }

    public function login($data)
    {
        if (isset($data['login']) && isset($data['password'])) {
            $user_model = new UserModel();

            $user_info = $user_model->getUser([
                'login' => $data['login'],
                'password' => md5($data['password'])
            ]);

            if ($user_info) {
                $_SESSION['login'] = $data['login'];
                $_SESSION['password'] = md5($data['password']);
                return $user_info['user_id'];
            }
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['password']);
    }

    public function isLogged()
    {
        return $this->user_id;
    }

}