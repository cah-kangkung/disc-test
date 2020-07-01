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

    public function updateUserData($email, $firstName, $lastName, $gender, $locale, $phone, $image)
    {
        $get_email_id = $this->db->query("SELECT id FROM accounts WHERE account_email = '$email'")->row_array();
        $email_id = (int) $get_email_id["id"];

        $store_procedure = "CALL update_user_profile($email_id, '$firstName', '$lastName', '$gender', '$locale', '$phone', '$image')";
        return $this->db->query($store_procedure);
    }

    public function updatePassword($email, $password)
    {
        return $this->db->query("UPDATE accounts SET `account_password` = '$password' WHERE `account_email` = '$email'");
    }

    public function oaRegister($userData)
    {
        // var_dump($userData);
        // die;
        $provider       = $userData['user_oauth_provider'];
        $uid            = $userData['user_oauth_uid'];
        $first_name     = $userData['user_firstName'];
        $last_name      = $userData['user_lastName'];
        $email          = $userData['user_email'];
        $local          = $userData['user_locale'];
        // $image = $userData['user_image'];       
        $role           = $userData['role'];
        $store_procedure = "CALL make_account_oa('$email', '$uid', '$provider', '$first_name', '$last_name', '$local', $role)";
        // var_dump($store_procedure);
        // die;
        $this->db->query($store_procedure);

        return $this->db->query("SELECT * FROM view_users WHERE uid = '$uid' AND provider = '$provider'")->row_array();
    }

    public function oaLogin($userData)
    {
        $email = $userData['user_email'];
        $uid = $userData['user_oauth_uid'];
        $provider = $userData['user_oauth_provider'];

        // var_dump($uid);
        // var_dump($provider);
        // die;

        $data = $this->db->query("SELECT `id akun` FROM view_users WHERE `E-mail` = '$email'")->row_array();
        // $ap = $this->db->query("SELECT * FROM account_provider WHERE `uid` = '$uid' AND `provider` = '$provider'")->row_array();

        // var_dump($data);
        // var_dump($ap);
        // die;

        if ($this->db->query("SELECT * FROM view_users WHERE `E-mail` = '$email' AND `uid` = '$uid' AND `provider` = '$provider'")->row_array() == null) {
            $acc_id = (int) $data["id akun"];
            // var_dump($acc_id);
            // die;
            $this->db->query("INSERT INTO account_provider VALUES ($acc_id, '$provider', '$uid')");

            return $this->db->query("SELECT * FROM view_users WHERE uid = '$uid' AND provider = '$provider'")->row_array();
        }

        // else if($this->db->query("SELECT * FROM view_users WHERE `E-mail` = '$email' AND `uid` = '$uid' AND `provider` = '$provider'")){
        //     $acc_id = (int) $data["id akun"];
        //     // var_dump($acc_id);
        //     // die;
        //     $this->db->query("INSERT INTO account_provider VALUES ($acc_id, $provider', '$uid')");

        //     return $this->db->query("SELECT * FROM view_users WHERE uid = '$uid' AND provider = '$provider'")->row_array();

        // }

        return $this->db->query("SELECT * FROM view_users WHERE uid = '$uid' AND provider = '$provider'")->row_array();
    }
}

/*
class User extends CI_Model
{

    function __construct()
    {
        $this->tableName = 'users';
        $this->primaryKey = 'user_ID';
    }

    public function checkUser($data = array())
    {
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);

        $con = array(
            'user_oauth_provider' => $data['user_oauth_provider'],
            'user_oauth_uid' => $data['user_oauth_uid']
        );
        $this->db->where($con);

        $query = $this->db->get();

        $check = $query->num_rows();

        if ($check > 0) {
            // Get prev user data
            $result = $query->row_array();

            // Update user data
            $data['user_modifiedTime'] = date("Y-m-d H:i:s");
            $update = $this->db->update($this->tableName, $data, array('user_ID' => $result['user_ID']));

            // user id
            $userID = $result['user_ID'];
        } else {
            // Insert user data
            $data['user_createdTime'] = date("Y-m-d H:i:s");
            $data['user_modifiedTime'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName, $data);

            // user id
            $userID = $this->db->insert_id();
        }

        // Return user id
        return $userID ? $userID : false;
    }
*/
