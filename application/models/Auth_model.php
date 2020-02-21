<?php
class Auth_model extends CI_Model
{
                                public function __construct()
                                {
                                                                $this->load->database();
                                }
                                public function auth_check($data)
                                {
                                                                $query = $this->db->get_where('users', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function get_news()
                                {
                                                                $this->db->order_by("published_on", "desc");
                                                                $query = $this->db->get('news');
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function delete_rank($id)
                                {
                                                                $this->db->where('id', $id);
                                                                $this->db->delete('participation');
                                }
                                public function createRank($data)
                                {
                                                                if ($this->db->insert('participation', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function delete_user($username)
                                {
                                                                $this->db->where('username', $username);
                                                                $this->db->delete('users');
                                }

                                public function deleteCode($id)
                                {
                                                                $this->db->where('id', $id);
                                                                $this->db->delete('recovery');
                                }
                                public function get_user_all()
                                {
                                                                $query = $this->db->get('users');
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function get_participation($data)
                                {
                                                                $this->db->order_by("year", "desc");
                                                                $query = $this->db->get_where('participation', $data);
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function get_news_by_id($data)
                                {
                                                                $query = $this->db->get_where('news', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function get_user($data)
                                {
                                                                $query = $this->db->get_where('users', $data);
                                                                if ($query) {
                                                                                                return $query->result();
                                                                }
                                                                return false;
                                }
                                public function get_user_by_id($data)
                                {
                                                                $query = $this->db->get_where('users', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function get_recovery_code_by_id($data)
                                {
                                                                $query = $this->db->get_where('recovery', $data);
                                                                if ($query) {
                                                                                                return $query->row();
                                                                }
                                                                return false;
                                }
                                public function verify_profile($data, $username)
                                {
                                                                $this->db->where('username', $username);
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function update_profile($data)
                                {
                                                                $this->db->where('username', $this->session->userdata('username'));
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function updatePassword($data, $username)
                                {
                                                                $this->db->where('username', $username);
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function changeRole($data, $username)
                                {
                                                                $this->db->where('username', $username);
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function changeActive($data, $username)
                                {
                                                                $this->db->where('username', $username);
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function updateRating($data, $username)
                                {
                                                                $this->db->where('username', $username);
                                                                if ($this->db->update('users', $data))
                                                                                                return true;
                                                                else
                                                                                                return false;
                                }
                                public function insert_user($data)
                                {
                                                                if ($this->db->insert('users', $data)) {
                                                                                                return true;
                                                                } else
                                                                                                return false;
                                }
                                public function insert_recovery_code($data)
                                {
                                                                if ($this->db->insert('recovery', $data)) {
                                                                                                return true;
                                                                } else
                                                                                                return false;
                                }
}