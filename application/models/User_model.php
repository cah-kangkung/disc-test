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
        $full_name = $new_data['full_name'];
        $email = $new_data['email'];
        $no_hp = $new_data['no_hp'];
        $birth = $new_data['birth'];
        $sex = $new_data['sex'];
        $is_completed = 1;
        $image = $new_data['image'];

        $query = "UPDATE user SET `full_name` = '$full_name', `no_hp` = '$no_hp', `birth` = '$birth', `sex` = '$sex', `is_completed` = $is_completed , `image` = '$image' WHERE `email` = '$email'";
        return $this->db->query($query);
    }

    public function activateUser($email)
    {
        $query = "UPDATE user SET `is_active` = 1 WHERE `email` = '$email'";
        return $this->db->query($query);
    }

    public function deleteUser($email)
    {
        $query = "DELETE FROM user WHERE `email` = '$email'";
        return $this->db->query($query);
    }

    public function updatePassword($email, $password)
    {
        return $this->db->query("UPDATE user SET `password` = '$password' WHERE `email` = '$email'");
    }

    public function insertToken($user_token)
    {
        return $this->db->insert('user_token', $user_token);
    }

    public function getUserToken($token)
    {
        return $this->db->get_where('user_token', ['token' => $token])->row_array();
    }

    public function deleteUserToken($email)
    {
        return $this->db->delete('user_token', ['email' => $email]);
    }
}
