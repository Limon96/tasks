<?php

class LogoutController extends Controller {

    public function index()
    {
        $this->user->logout();

        $json['success'] = 'Success';

        return json_encode($json);
    }

}