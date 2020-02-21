<?php
class Task_model extends CI_Model
{
        public function __construct()
        {
                $this->load->database();
        }
        public function insert_task($data)
        {
                if ($this->db->insert('tasks', $data))
                        return true;
                else
                        return false;
        }
        public function insert_announcement($data)
        {
                if ($this->db->insert('task_announcements', $data))
                        return true;
                else
                        return false;
        }
        function getUsers($getData, $task_id)
        {
                $response = array();
                if (isset($getData['search'])) {
                        $this->db->select('*');
                        $this->db->where("verified = '1' AND is_active = '1' AND role = 'user' AND (student_id like '%" . $getData['search'] . "%' OR name like '%" . $getData['search'] . "%' )");
                        $records = $this->db->get('users')->result();
                        foreach ($records as $row) {
                                $this->db->where(array(
                                        "task_id" => $task_id,
                                        "username" => $row->username
                                ));
                                $check = $this->db->get('task_participants')->row();
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
        function getTeams($getData, $task_id)
        {
                $response = array();
                if (isset($getData['search'])) {
                        $this->db->select('*');
                        $this->db->where("coach = '" . $this->username . "' AND name like '%" . $getData['search'] . "%'");
                        $records = $this->db->get('teams')->result();
                        foreach ($records as $row) {
                                $name       = $row->name;
                                $id         = $row->id;
                                $nameID     = $name;
                                $response[] = array(
                                        "label" => $nameID,
                                        "value" => $id
                                );
                        }
                }
                return $response;
        }
        function getGroups($getData, $task_id)
        {
                $response = array();
                if (isset($getData['search'])) {
                        $this->db->select('*');
                        $this->db->where("mentor = '" . $this->username . "' AND name like '%" . $getData['search'] . "%'");
                        $records = $this->db->get('groups')->result();
                        foreach ($records as $row) {
                                $name       = $row->name;
                                $id         = $row->id;
                                $nameID     = $name;
                                $response[] = array(
                                        "label" => $nameID,
                                        "value" => $id
                                );
                        }
                }
                return $response;
        }
        public function get_participation_by_id($data)
        {
                $query = $this->db->get_where('task_participants', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function insert_participant($data)
        {
                if ($this->db->insert('task_participants', $data))
                        return true;
                else
                        return false;
        }
        public function delete_task($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('tasks');
        }
        public function delete_task_participant($id, $username)
        {
                $this->db->where('task_id', $id);
                $this->db->where('username', $username);
                $this->db->delete('task_participants');
        }
        public function get_task($data)
        {
                $this->db->order_by("start_on", "desc");
                $query = $this->db->get_where('tasks', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_task_all()
        {
                $this->db->order_by("start_on", "desc");
                $query = $this->db->get('tasks');
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_announcement($data)
        {
                $this->db->order_by("published_on", "asc");
                $query = $this->db->get_where('task_announcements', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function check_participant($data)
        {
                $query = $this->db->get_where('task_participants', $data);
                if ($query) {
                        return $query->result();
                }
                return false;
        }
        public function get_task_by_id($data)
        {
                $query = $this->db->get_where('tasks', $data);
                if ($query) {
                        return $query->row();
                }
                return false;
        }
        public function update($data, $id)
        {
                $this->db->where('id', $id);
                if ($this->db->update('tasks', $data))
                        return true;
                else
                        return false;
        }
}