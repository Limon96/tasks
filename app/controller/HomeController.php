<?php

class HomeController extends Controller {

    public function index() {

        if (isset($this->request->get['page'])) {
            $page = (int)$this->request->get['page'];
        } else {
            $page = 1;
        }

        $limit = 3;

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'status';
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'ASC';
        }

        $data['is_logged'] = $this->user->isLogged();

        $task_model = new TaskModel();

        $filter_data = array(
            "order" => $order,
            "sort" => $sort,
            "start" => ($page - 1) * $limit,
            "limit" => $limit
        );

        $tasks = $task_model->getTasks($filter_data);
        $total_tasks = $task_model->getTotalTasks($filter_data);
        $data['total_tasks'] = $total_tasks;
        $data['tasks'] = array();

        if ($tasks) {
            foreach ($tasks as $task) {
                $data['tasks'][] = [
                    "task_id" => $task['task_id'],
                    "name" => $task['name'],
                    "email" => $task['email'],
                    "text" => $task['text'],
                    "status" => $task['status'],
                    "admin_edit" => $task['admin_edit'],
                ];
            }
        }

        $data['pagination'] = array();

        if ($total_tasks > $limit) {

            $url = '';

            if (isset($this->request->get['order'])) {
                $url .= "&order=" . $this->request->get['order'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= "&sort=" . $this->request->get['sort'];
            }

            $end = ceil($total_tasks / $limit);
            $items = array();

            for ($i = 1; $i <= $end; $i++) {
                $items[] = array(
                    "text" => $i,
                    "href" => '/?page=' . $i . $url
                );
            }

            $data['pagination'] = array(
                "current" => $page,
                "total" => $total_tasks,
                "items" => $items
            );
        }

        $data['sorts'] = array();

        $data['sorts'][] = array(
            "name" => 'Name',
            "order" => 'name',
            "href" => '/?order=name&sort=' . ($sort == 'DESC' ? 'ASC': 'DESC')
        );

        $data['sorts'][] = array(
            "name" => 'Email',
            "order" => 'email',
            "href" => '/?order=email&sort=' . ($sort == 'DESC' ? 'ASC': 'DESC')
        );

        $data['sorts'][] = array(
            "name" => 'Status',
            "order" => 'status',
            "href" => '/?order=status&sort=' . ($sort == 'DESC' ? 'ASC': 'DESC')
        );

        $data['order'] = $order;
        $data['sort'] = $sort;

        return $this->view->load('home', $data);
    }

}