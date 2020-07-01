<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function insert($data = array())
    {
        return $this->db->insert('user', $data);
    }

    public function getUserData($email)
    {
        return $this->db->query("SELECT * FROM user WHERE `email` = '$email'")->row_array();
    }

    public function updateUserData($new_data = array())
    {
        $first_name = $new_data['first_name'];
        $last_name = $new_data['last_name'];
        $email = $new_data['email'];
        $image = $new_data['image'];

        $query = "UPDATE user SET `first_name` = '$first_name', `last_name` = '$last_name', `image` = '$image' WHERE `email` = '$email'";
        return $this->db->query($query);
    }

    public function updatePassword($email, $password)
    {
        return $this->db->query("UPDATE user SET `password` = '$password' WHERE `email` = '$email'");
    }
}
