<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }

    public function create_team($data)
    {
        $insert = $this->db->insert('teams', $data);
        if ($insert) return true;
        return false;
    }

    public function get_team($data)
    {
      $this->db->order_by("created_on", "desc");
      $query = $this->db->get_where('teams', $data);
      if ($query) {
        return $query->result();
      }
      return false;
    }

    public function update_team($data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update('teams', $data))
            return true;
        else
            return false;
    }

    public function get_team_by_id($data)
                {
                                $query = $this->db->get_where('teams', $data);
                              //  echo $this->db->last_query(); die();
                                if ($query) {
                                                return $query->row();
                                }
                                return false;
                }
    public function get_team_all()
    {
        $query = $this->db->get('teams');
        if ($query) {
                        return $query->result();
        }
        return false;
    }


    public function delete_team($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('teams');
    }

    public function validate_members($data)
    {
        $this->db->select('*');
        $this->db->where("username= '".$data['member1']."' OR username ='".$data['member2']."' OR username ='".$data['member3']."'");

        $records = $this->db->get('users');

        if($records->num_rows()==3)
            return true;
        else
            return false;
    }

    public function send_message()
    {
        $this->username = $this->session->userdata('username');
        $data             = array(
                'team_id' => htmlentities($this->input->post('team_id')),
                'sender'  => $this->username,
                'body'    => htmlentities($this->input->post('message'))
                );
        $insert = $this->db->insert('team_chat', $data);
        return $insert;

        /////////////// send message with page reload starts here with param = $data ////////////

        // $insert = $this->db->insert('team_chat', $data);
        // if ($insert) return true;
        // return false;

        /////////////// send message with page reload ends here ////////////
    }
    public function get_chats($team_id)
    {
        $data=array('team_id'=>$team_id);
        $this->db->select('*');
        $messages = $this->db->get_where('team_chat', $data);
        return $messages->result();
    }
}