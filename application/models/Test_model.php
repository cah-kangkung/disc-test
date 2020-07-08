<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_model extends CI_Model
{

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
        $dominant = $new_data['dominant'];
        $correct = $new_data['correct'];
        $stable = $new_data['stable'];
        $id = $new_data['id'];
        $query = "UPDATE test_question SET `influence` = '$influence', `dominant` = '$dominant', `correct` = '$correct', `stable` = '$stable' WHERE `question_id` = $id";
        return $this->db->query($query);
    }

    public function deleteQuestion($id)
    {
        $query = "DELETE FROM test_question WHERE `question_id` = '$id'";
        return $this->db->query($query);
    }
}
