<?php

class TaskController extends Controller {

    public function index()
    {
        if (isset($this->request->get['task_id'])) {
            $task_id = (int)$this->request->get['task_id'];
        } else {
            $task_id = 0;
        }

        $task_model = new TaskModel();

        $task_info = $task_model->getTask($task_id);

        $json = array();

        if ($task_info) {
            $json['task'] = [
                "task_id" => $task_info['task_id'],
                "name" => $task_info['name'],
                "email" => $task_info['email'],
                "text" => $task_info['text'],
                "status" => $task_info['status']
            ];
        }
        return json_encode($json);
    }
    
    public function add()
    {
        $json = array();

        if (!isset($this->request->post['name']) || strlen($this->request->post['name']) < 1) {
            $json['error_name'] = 'Введите имя';
        }

        if (!isset($this->request->post['email']) || strlen($this->request->post['email']) < 1) {
            $json['error_email'] = 'Введите Email';
        } else {
            if (!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
                $json['error_email'] = 'Введен не корректный Email ';
            }
        }

        if (!isset($this->request->post['text']) || strlen($this->request->post['text']) < 1) {
            $json['error_text'] = 'Введите текст задачи';
        }

        if (!$json) {
            $task_model = new TaskModel();

            $task_id = $task_model->addTask([
                "name" => $this->request->post['name'],
                "email" => $this->request->post['email'],
                "text" => $this->request->post['text'],
            ]);

            $json['success'] = 'Успешно добавлено';
            $json['task_id'] = $task_id;
        }

        return json_encode($json);
    }

    public function edit()
    {
        $json = array();

        if (!isset($this->request->post['text']) || strlen($this->request->post['text']) < 1) {
            $json['error_text'] = 'Введите текст задачи';
        }

        if (!isset($this->request->post['task_id']) || $this->request->post['task_id'] < 1) {
            $json['error_unknown'] = 'Неизвестная ошибка! Повторите позже';
        }

        if (!$this->user->isLogged()) {
            $json['error_auth'] = 'Доступ запрещен';
        }

        if (!$json) {

            $task_model = new TaskModel();

            $task_info = $task_model->getTask($this->request->post['task_id']);

            if ($task_info) {

                if ($task_info['text'] != $this->request->post['text']) {
                    $admin_edit = 1;
                } else {
                    $admin_edit = 0;
                }

                $task_model->editTask($this->request->post['task_id'], [
                    "text" => $this->request->post['text'],
                    "admin_edit" => $admin_edit,
                    "status" => (isset($this->request->post['status']) ? $this->request->post['status']: 0),
                ]);
                $json['success'] = 'Успешно сохранено';

            } else {
                $json['error_not_found'] = 'Задача не найдена';
            }
        }

        return json_encode($json);
    }

}