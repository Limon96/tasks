<?php

class UserModel extends Model {

    public function getUser($data)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "user WHERE login = '" . $this->db->escape($data['login']) . "' AND password = '" . $this->db->escape($data['password']) . "'";

        $result = $this->db->query($sql);

        $row = $result->fetch_assoc();
        if (isset($row['user_id'])) {
            return $row;
        }
        return false;
    }

}