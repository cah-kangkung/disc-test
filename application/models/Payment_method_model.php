<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_method_model extends CI_Model
{

    public function insertPaymentMethod($data = array())
    {
        return $this->db->insert('payment_method', $data);
    }

    public function getAllPM()
    {
        return $this->db->query("SELECT * FROM payment_method")->result_array();
    }

    public function getPaymentMethod($id)
    {
        return $this->db->query("SELECT * FROM payment_method WHERE `id` = $id")->row_array();
    }

    public function editPaymentMethod($new_data = array())
    {
        $bank = $new_data['bank'];
        $bank_account_name = $new_data['bank_account_name'];
        $bank_account_number = $new_data['bank_account_number'];
        $id = $new_data['id'];
        $query = "UPDATE payment_method SET `bank` = '$bank', `bank_account_name` = '$bank_account_name', `bank_account_number` = '$bank_account_number' WHERE `id` = $id";
        return $this->db->query($query);
    }

    public function deletePaymentMethod($id)
    {
        $query = "DELETE FROM payment_method WHERE `id` = '$id'";
        return $this->db->query($query);
    }
}
