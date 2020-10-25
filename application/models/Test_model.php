<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_model extends CI_Model
{
    public function getAllTest()
    {
        return $this->db->query("SELECT * FROM test")->result_array();
    }

    public function getTestByID($test_id)
    {
        return $this->db->query("SELECT * FROM test WHERE `test_id` = $test_id")->row_array();
    }

    public function addTest($data = array())
    {
        null;
    }

    public function udpateTest($data)
    {
        $price = $data['price'];
        $duration = $data['duration'];
        $query = "UPDATE test SET `price` = $price, `duration` = $duration WHERE `test_id` = 1";
        return $this->db->query($query);
    }

    public function deleteTest($data = array())
    {
        null;
    }

    public function insertQuestion($data = array())
    {
        return $this->db->insert('test_question', $data);
    }

    public function getAllQuestion()
    {
        return $this->db->query("SELECT * FROM test_question")->result_array();
    }

    public function getQuestionByID($id)
    {
        return $this->db->query("SELECT * FROM test_question WHERE `question_id` = $id")->row_array();
    }

    public function editQuestion($new_data = array())
    {
        $influence = $new_data['influence'];
        $dominance = $new_data['dominance'];
        $compliance = $new_data['compliance'];
        $steadiness = $new_data['steadiness'];
        $id = $new_data['id'];
        $query = "UPDATE test_question SET `influence` = '$influence', `dominance` = '$dominance', `compliance` = '$compliance', `steadiness` = '$steadiness' WHERE `question_id` = $id";
        return $this->db->query($query);
    }

    public function deleteQuestion($id)
    {
        $query = "DELETE FROM test_question WHERE `question_id` = '$id'";
        return $this->db->query($query);
    }
}
