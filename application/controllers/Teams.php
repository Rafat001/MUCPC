 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teams extends CI_Controller
{
        public function __construct()
        {
                date_default_timezone_set("Asia/Dhaka");
                parent::__construct();
                $this->load->model('Blog_model');
                $this->load->model('Task_model');
                $this->load->model('Auth_model');
                $this->load->model('User_model');
                $this->load->model('Team_model');
                $this->load->library(array(
                        'form_validation',
                        'session'
                ));
                $this->load->helper(array(
                        'url',
                        'html',
                        'form'
                ));
                $this->db->query("SET SESSION sql_mode = ''");
                $this->username = $this->session->userdata('username');
        }
        public function view($id = '')
        {
                $data        = array(
                        'id' => $id
                );
                $this->title = "Team";
                $this->team  = $this->Team_model->get_team_by_id($data);
                if ($this->team == false) {
                        redirect(base_url());
                }
                if(!($this->session->userdata('role') == "admin" || ($this->username == $this->team->coach && $this->session->userdata('role') == "coach") || $this->username == $this->team->member1 || $this->username == $this->team->member2 || $this->username == $this->team->member3)) {
                        redirect(base_url());
                }
                $data['id'] = $id;
                $this->load->view('templates/header', $data);
                $this->load->view('pages/team', $data);
                $this->load->view('templates/footer', $data);
        }
        public function index()
        {
                $this->load->view('pages/createteam');
        }
        public function suggest()
        {
                $postData = $this->input->post();
                $data     = $this->User_model->getUsers($postData);
                echo json_encode($data);
        }
        public function create()
        {
                if ($this->session->userdata('role') != "coach") {
                        redirect(base_url());
                }
                $this->username = $this->session->userdata('username');
                $data           = array(
                        'name' => htmlentities($this->input->post('name')),
                        'coach' => $this->username,
                        'member1' => htmlentities($this->input->post('member1')),
                        'member2' => htmlentities($this->input->post('member2')),
                        'member3' => htmlentities($this->input->post('member3'))
                );
                $validation     = $this->Team_model->validate_members($data);
                if ($validation == false) {

                        $user = array(
                                'error_msg' => "Invalid entries!"
                        );
                        $this->session->set_userdata($user);
                        redirect(base_url('training?locate=team'));
                        return;
                }
                $insert = $this->Team_model->create_team($data);
                if ($insert) {
                        $user = array(
                                'success_msg' => "Team Created Successfully!"
                        );
                        $this->session->set_userdata($user);
                        redirect(base_url('training?locate=team'));
                } else {
                        redirect(base_url());
                }
        }
        public function update()
        {
                if ($this->session->userdata('role') != "coach") {
                        redirect(base_url());
                }
                if ($this->Team_model->get_team_by_id(array(
                        "coach" => $this->username,
                        "id" => htmlentities($this->input->post('team_id'))
                )) == false) {
                        redirect(base_url());
                }
                $data           = array(
                        'name' => htmlentities($this->input->post('name')),
                );
                $user = array(
                        'success_msg' => "Team Updated Successfully!"
                );
                $this->session->set_userdata($user);
                $this->Team_model->update_team($data, htmlentities($this->input->post('team_id')));
                redirect(base_url('team/' . htmlentities($this->input->post('team_id')) . "?locate=settings"));
        }
        public function delete($team_id)
        {
                if ($this->session->userdata('role') != 'coach' && $this->session->userdata('role') != 'admin') {
                        redirect(base_url());
                }
                if ($this->Team_model->get_team_by_id(array(
                        "coach" => $this->username,
                        "id" => $team_id
                )) == false && $this->session->userdata('role') == 'coach') {
                        redirect(base_url());
                }
                $this->Team_model->delete_team($team_id);
                $user = array(
                        'success_msg' => "Team Deleted Successfully!"
                );
                $this->session->set_userdata($user);
                if ($this->session->userdata('role') == 'coach')
                        redirect(base_url('training?locate=team'));
                else
                        redirect(base_url('admin/team'));
        }
        public function send_chat()
        {
                $details    = array(
                        'team_id' => htmlentities($this->input->post('team_id')),
                        'sender' => $this->username,
                        'body' => htmlentities($this->input->post('message'))
                );
                if(trim(htmlentities($this->input->post('message'))) == "") {
                        return;
                }
                $validation = $this->Team_model->get_team_by_id(array(
                        'id' => htmlentities($this->input->post('team_id'))
                ));
                if ($validation == false)
                        redirect(base_url());
                $data = $this->Team_model->send_message();
                echo json_encode($data);
        }
        public function get_chats($team_id)
        {
                $data = $this->Team_model->get_chats($team_id);
                foreach ($data as $chat) {
                        $chat->created_on = date("M d, Y g:i A", strtotime($chat->created_on));
                        $chat->photo      = $this->Auth_model->get_user_by_id(array(
                                "username" => $chat->sender
                        ))->photo;
                }
                echo json_encode($data);
        }
}
