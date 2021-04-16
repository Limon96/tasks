<?php

class LoginController extends Controller {

    public function index()
    {
        $json = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($this->request->post['login']) || !$this->request->post['login']) {
                $json['error_login'] = 'Entry login';
            }

            if (!isset($this->request->post['password']) || !$this->request->post['password']) {
                $json['error_password'] = 'Entry password';
            }

            if (!$json) {
                $user_id = $this->user->login([
                    "login" => $this->request->post['login'],
                    "password" => $this->request->post['password'],
                ]);

                if ($user_id) {
                    $json['success'] = 'Success';
                } else {
                    $json['error_auth'] = 'Incorrect login or password';
                }
            }
        }

        return json_encode($json);
    }

}