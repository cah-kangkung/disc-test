<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    public function makePayment($data = array())
    {
        return $this->db->insert('payment', $data);
    }

    public function getAllPayment()
    {
        return $this->db->query("SELECT * FROM payment")->result_array();
    }

    public function getPaymentByID($payment_id)
    {
        return $this->db->query("SELECT * FROM payment WHERE `payment_id` = $payment_id")->row_array();
    }

    public function editSenderBank($new_data = array())
    {
        $bank = $new_data['bank'];
        $bank_account_name = $new_data['bank_account_name'];
        $bank_account_number = $new_data['bank_account_number'];
        $payment_id = $new_data['payment_id'];
        $query = "UPDATE payment SET `bank` = '$bank', `bank_account_name` = '$bank_account_name', `bank_account_number` = '$bank_account_number' WHERE `payment_id` = $payment_id";
        return $this->db->query($query);
    }

    public function updateStatus($type, $payment_id)
    {
    }

    public function deletePayment($payment_id)
    {
        $query = "DELETE FROM payment WHERE `payment` = $payment_id";
        return $this->db->query($query);
    }
}
