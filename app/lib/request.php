<?php

class Request {

    public $get;
    public $post;

    public function __construct()
    {
        $this->get = $this->secure($_GET);
        $this->post = $this->secure($_POST);
    }

    private function secure($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                unset($data[$key]);

                $data[$this->secure($key)] = $this->secure($value);
            }
        } else {
            $data = htmlspecialchars($data);
        }

        return $data;
    }
}