<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function getAllReport()
    {
        return $this->db->query("SELECT * FROM Report")->result_array();
    }

    public function getReportByID($report_id)
    {
        return $this->db->query("SELECT * FROM report WHERE `report_id` = $report_id")->row_array();
    }

    public function getReportByUser($user_id)
    {
        return $this->db->query("SELECT * FROM report WHERE `user_id` = $user_id")->result_array();
    }

    public function makeReport($data = array())
    {
        return $this->db->insert('report', $data);
    }
}
