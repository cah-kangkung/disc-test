<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Active_test_model extends CI_Model
{
    public function insertActiveTest($data = array())
    {
        return $this->db->insert('active_test', $data);
    }

    public function getActiveTest($user_id)
    {
        return $this->db->query("SELECT * FROM active_test WHERE `user_id` = $user_id AND `status` = 2 OR `status` = 3")->row_array();
    }

    // public function updateStatus($type, $id, $status)
    // {
    //     $query = '';

    //     if ($type == 'waiting') {
    //         $query = "UPDATE active_test SET `status` = $status WHERE `id` = $id";
    //     }
    // }
}
