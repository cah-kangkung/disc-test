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

    public function getPaymentByUser($user_id, $status = '')
    {
        $query = "";
        if ($status == '') {
            $query = "SELECT * FROM payment WHERE `user_id` = $user_id ORDER BY `date_created` DESC";
        } else {
            $query = "SELECT * FROM payment WHERE `user_id` = $user_id AND `status` = $status ORDER BY `date_created` DESC";
        }
        return $this->db->query($query)->result_array();
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

    public function updateStatus($type, $payment_id, $user_id)
    {
        $query1 = '';
        $query2 = '';
        if ($type == 'cancel') {
            $query1 = "UPDATE payment SET `status` = 0 WHERE `payment_id` = $payment_id";
            $query2 = "UPDATE active_test SET `status` = 0 WHERE `user_id` = $user_id";
        }

        $this->db->trans_start();
        $this->db->query($query1);
        $this->db->query($query2);
        $this->db->trans_complete();
    }

    public function deletePayment($payment_id)
    {
        $query = "DELETE FROM payment WHERE `payment` = $payment_id";
        return $this->db->query($query);
    }
}
