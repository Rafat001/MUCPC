<?php
class Question_model extends CI_Model
{
        public function __construct()
        {
                $this->load->database();
        }
        public function insert_question($data)
        {
                if ($this->db->insert('questions', $data))
                        return true;
                else
                        return false;
        }
        public function insert_answer($data)
        {
                if ($this->db->insert('answers', $data))
                        return true;
                else
                        return false;
        }
        public function insert_helpful($data)
        {
                if ($this->db->insert('helpful', $data))
                        return true;
                else
                        return false;
        }
        public function get_question_all()
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get('questions');
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function sizeOfHelpful($id)
        {
                $query = $this->db->get_where('helpful', array("answer_id" => $id));
                if ($query) {
                        return sizeof($query->result());
                }
                return 0;
        }
        public function get_question($data)
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get_where('questions', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_helpful($data)
        {
                $query = $this->db->get_where('helpful', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function delete_question($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('questions');
        }
        public function update_question($data, $question_id)
        {
                $this->db->where('id', $question_id);
                if ($this->db->update('questions', $data))
                        return true;
                else
                        return false;
        }
        public function get_answer($data)
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get_where('answers', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_question_by_id($data)
        {
                $query = $this->db->get_where('questions', $data);
                if ($query) {
                        return $query->row();
                }
                return false;
        }
}