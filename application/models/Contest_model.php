<?php
class Contest_model extends CI_Model
{
                                public function __construct()
                                {
                                                                $this->load->database();
                                }
                                public function insert_contest($data)
                                {
                                                                if ($this->db->insert('contests', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function update($data, $id)
                                {
                                                                $this->db->where('id', $id);
                                                                if ($this->db->update('contests', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function get_contest($data)
                                {
                                                                $this->db->order_by("start_on", "desc");
                                                                $query = $this->db->get_where('contests', $data);
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function delete_contest($id)
                                {
                                                                $this->db->where('id', $id);
                                                                $this->db->delete('contests');
                                }
                                public function get_contest_all()
                                {
                                                                $this->db->order_by("start_on", "desc");
                                                                $query = $this->db->get('contests');
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function get_participants_by_contest_id($data)
                                {
                                                                $query = $this->db->get_where('contest_participants', $data);
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function get_contest_participation_by_id($data)
                                {
                                                                $query = $this->db->get_where('contest_participants', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function get_contest_by_id($data)
                                {
                                                                $query = $this->db->get_where('contests', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function register_contest($data)
                                {
                                                                if ($this->db->insert('contest_participants', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
}