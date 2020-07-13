<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Active_test_model extends CI_Model
{
    public function insertActiveTest($data = array())
    {
        return $this->db->insert('active_test', $data);
    }

    public function updateActiveTest($new_data = array())
    {
        $time_start = $new_data['time_start'];
        $time_end = $new_data['time_end'];
        $status = $new_data['status'];
        $user_id = $new_data['user_id'];
        $payment_id = $new_data['payment_id'];
        $query = "UPDATE active_test SET `payment_id` = '$payment_id', `time_start` = '$time_start', `time_end` = '$time_end', `status` = '$status' WHERE `user_id` = $user_id";
        return $this->db->query($query);
    }

    public function getActiveTest($user_id)
    {
        return $this->db->query("SELECT * FROM active_test WHERE `user_id` = $user_id")->row_array();
    }

    public function getTimeEnd($user_id)
    {
        return $this->db->query("SELECT `time_end` FROM active_test WHERE `user_id` = $user_id")->row_array();
    }

    public function updateStatus($user_id, $status)
    {
        $query = "UPDATE active_test SET `status` = $status WHERE `user_id` = $user_id";
        return $this->db->query($query);
    }
}
