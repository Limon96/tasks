<?php

class TaskModel extends Model {

    public function getTasks($data = array())
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "task";

        $order_list = array(
            'name',
            'email',
            'status',
        );

        if (isset($data['order']) && in_array($data['order'], $order_list)) {
            $sql .= " ORDER BY " . $this->db->escape($data['order']);
        } else {
            $sql .= " ORDER BY name";
        }

        if (isset($data['sort']) && $data['sort'] == 'DESC') {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || $data['limit']) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }
            if ($data['limit'] < 0) {
                $data['limit'] = 0;
            }
            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

        } else {
            $sql .= " LIMIT 0,20";
        }

        $result = $this->db->query($sql);

        $task_data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $task_data[] = $row;
            }
        }
        return $task_data;
    }

    public function getTotalTasks($data = array())
    {
        $sql = "SELECT COUNT(1) AS total FROM " . DB_PREFIX . "task";

        $result = $this->db->query($sql);

        $row = $result->fetch_assoc();
        if (isset($row['total'])) {
            return (int)$row['total'];
        }
        return 0;
    }

    public function getTask($task_id)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "task WHERE task_id = '" . (int)$task_id . "'";

        $result = $this->db->query($sql);

        $row = $result->fetch_assoc();
        if ($row) {
            return $row;
        }
        return false;
    }

    public function addTask($data)
    {
        $this->db->query("INSERT INTO " . DB_PREFIX . "task SET 
            name = '" . $this->db->escape($data['name']) . "',
            email = '" . $this->db->escape($data['email']) . "',
            text = '" . $this->db->escape($data['text']) . "'
        ");

        return $this->db->getLastId();
    }

    public function editTask($task_id, $data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . "task SET 
            text = '" . $this->db->escape($data['text']) . "',
            status = '" . (int)$data['status'] . "',
            admin_edit = '" . (int)$data['admin_edit'] . "'
            WHERE task_id = '" . (int)$task_id . "'
        ");
    }

}