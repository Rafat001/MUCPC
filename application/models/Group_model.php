<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Group_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function create_group($data)
    {
        $insert = $this->db->insert('groups', $data);
        if ($insert)
            return true;
        return false;
    }
    public function insert_participant($data)
    {
        if ($this->db->insert('group_participants', $data))
            return true;
        else
            return false;
    }
    public function get_group($data)
    {
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get_where('groups', $data);
        if ($query) {
            return $query->result();
        }
        return false;
    }
    public function get_group_by_id($data)
    {
        $query = $this->db->get_where('groups', $data);
        if ($query) {
            return $query->row();
        }
        return false;
    }
    public function delete_group($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('groups');
    }
    public function delete_group_participant($id, $username)
    {
        $this->db->where('group_id', $id);
        $this->db->where('username', $username);
        $this->db->delete('group_participants');
    }
    public function get_participation_by_id($data)
    {
        $query = $this->db->get_where('group_participants', $data);
        if ($query) {
            return $query->result();
        }
        return false;
    }
    public function update_group($data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update('groups', $data))
            return true;
        else
            return false;
    }
    public function check_participant($data)
    {
        $query = $this->db->get_where('group_participants', $data);
        if ($query) {
            return $query->result();
        }
        return false;
    }
    function getUsers($getData, $group_id)
    {
        $response = array();
        if (isset($getData['search'])) {
            $this->db->select('*');
            $this->db->where("verified = '1' AND is_active = '1' AND role = 'user' AND (student_id like '%" . $getData['search'] . "%' OR name like '%" . $getData['search'] . "%' )");
            $records = $this->db->get('users')->result();
            foreach ($records as $row) {
                $this->db->where(array(
                    "group_id" => $group_id,
                    "username" => $row->username
                ));
                $check = $this->db->get('group_participants')->row();
                if ($check != false) {
                    continue;
                }
                $name       = $row->name;
                $id         = $row->student_id;
                $username   = $row->username;
                $nameID     = $name . ' [' . $id . ']';
                $response[] = array(
                    "label" => $nameID,
                    "value" => $username
                );
            }
        }
        return $response;
    }
    public function get_group_all()
    {
        $this->db->order_by("created_on", "desc");
        $query = $this->db->get('groups');
        if ($query) {
            return $query->result();
        }
        return false;
    }
    public function send_message()
    {
        $this->username = $this->session->userdata('username');
        $data           = array(
            'group_id' => htmlentities($this->input->post('group_id')),
            'sender' => $this->username,
            'body' => htmlentities($this->input->post('message'))
        );
        $insert         = $this->db->insert('group_chat', $data);
        return $insert;
    }
    public function get_chats($group_id)
    {
        $data = array(
            'group_id' => $group_id
        );
        $this->db->select('*');
        $messages = $this->db->get_where('group_chat', $data);
        return $messages->result();
    }
}