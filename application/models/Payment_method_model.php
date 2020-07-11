<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_method_model extends CI_Model
{

    public function insertPaymentDestination($data = array())
    {
        return $this->db->insert('payment_destination', $data);
    }

    public function getAllPD()
    {
        return $this->db->query("SELECT * FROM payment_destination")->result_array();
    }

    public function getPaymentDestination($id)
    {
        return $this->db->query("SELECT * FROM payment_destination WHERE `id` = $id")->row_array();
    }

    public function editPaymentDestination($new_data = array())
    {
        $bank = $new_data['bank'];
        $bank_account_name = $new_data['bank_account_name'];
        $bank_account_number = $new_data['bank_account_number'];
        $id = $new_data['id'];
        $query = "UPDATE payment_destination SET `bank` = '$bank', `bank_account_name` = '$bank_account_name', `bank_account_number` = '$bank_account_number' WHERE `id` = $id";
        return $this->db->query($query);
    }

    public function deletePaymentDestination($id)
    {
        $query = "DELETE FROM payment_destination WHERE `id` = '$id'";
        return $this->db->query($query);
    }
}
