<?php
class Blog_model extends CI_Model
{
        public function __construct()
        {
                $this->load->database();
        }
        public function insert_blog($data)
        {
                if ($this->db->insert('blogs', $data))
                        return true;
                else
                        return false;
        }
        public function insert_comment($data)
        {
                if ($this->db->insert('comments', $data))
                        return true;
                else
                        return false;
        }
        public function get_blog_all()
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get('blogs');
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_blog($data)
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get_where('blogs', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function delete_blog($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('blogs');
        }
        public function update_blog($data, $blog_id)
        {
                $this->db->where('id', $blog_id);
                if ($this->db->update('blogs', $data))
                        return true;
                else
                        return false;
        }
        public function get_comment($data)
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get_where('comments', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_blog_by_id($data)
        {
                $query = $this->db->get_where('blogs', $data);
                if ($query) {
                        return $query->row();
                }
                return false;
        }
}