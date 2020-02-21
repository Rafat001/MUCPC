<?php
class News_model extends CI_Model
{
        public function __construct()
        {
                $this->load->database();
        }
        public function insert_news($data)
        {
                if ($this->db->insert('news', $data))
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
        public function get_news_all()
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get('news');
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_news($data)
        {
                $this->db->order_by("published_on", "desc");
                $query = $this->db->get_where('news', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function delete_news($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('news');
        }
        public function update_news($data, $news_id)
        {
                $this->db->where('id', $news_id);
                if ($this->db->update('news', $data))
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
        public function get_news_by_id($data)
        {
                $query = $this->db->get_where('news', $data);
                if ($query) {
                        return $query->row();
                }
                return false;
        }
}