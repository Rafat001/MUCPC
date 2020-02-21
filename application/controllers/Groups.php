 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Groups extends CI_Controller
{
        public function __construct()
        {
                date_default_timezone_set("Asia/Dhaka");
                parent::__construct();
                $this->load->model('Blog_model');
                $this->load->model('Task_model');
                $this->load->model('Auth_model');
                $this->load->model('User_model');
                $this->load->model('Group_model');
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
                $this->title = "Group";
                $this->group  = $this->Group_model->get_group_by_id($data);
                if ($this->group == false) {
                        redirect(base_url());
                }

                if (!(($this->username == $this->group->mentor && $this->session->userdata('role') == "mentor") || $this->Group_model->get_participation_by_id(array("group_id" => $this->group->id, "username" => $this->username)) != false)) {
                  redirect(base_url());
                }
                $data['id'] = $id;
                $this->load->view('templates/header', $data);
                $this->load->view('pages/group', $data);
                $this->load->view('templates/footer', $data);
        }
        public function index()
        {
                $this->load->view('pages/creategroup');
        }

        public function suggest($group_id)
        {
                $postData = $this->input->post();
                $data     = $this->Group_model->getUsers($postData, $group_id);
                echo json_encode($data);
        }
        
        public function create()
        {
                if ($this->session->userdata('role') != "mentor") {
                        redirect(base_url());
                }
                $this->username = $this->session->userdata('username');
                $data           = array(
                        'name' => htmlentities($this->input->post('name')),
                        'mentor' => $this->username
                );
                $user = array(
                        'success_msg' => "Group Created Successfully!"
                );
                $this->session->set_userdata($user);
                $insert = $this->Group_model->create_group($data);
                if ($insert) {
                        redirect(base_url('mentoring?locate=group'));
                } else {
                        redirect(base_url());
                }
        }
        public function update()
        {
                if ($this->session->userdata('role') != "mentor") {
                        redirect(base_url());
                }
                if ($this->Group_model->get_group_by_id(array(
                        "mentor" => $this->username,
                        "id" => htmlentities($this->input->post('group_id'))
                )) == false) {
                        redirect(base_url());
                }
                $data           = array(
                        'name' => htmlentities($this->input->post('name')),
                );
                $user = array(
                        'success_msg' => "Group Updated Successfully!"
                );
                $this->session->set_userdata($user);
                $this->Group_model->update_group($data, htmlentities($this->input->post('group_id')));
                redirect(base_url('group/' . htmlentities($this->input->post('group_id')) . "?locate=settings"));
        }
        public function delete($group_id)
        {
                if ($this->session->userdata('role') != 'mentor' && $this->session->userdata('role') != 'admin') {
                        redirect(base_url());
                }
                if ($this->Group_model->get_group_by_id(array(
                        "mentor" => $this->username,
                        "id" => $group_id
                )) == false && $this->session->userdata('role') == 'mentor') {
                        redirect(base_url());
                }
                $this->Group_model->delete_group($group_id);
                $user = array(
                        'success_msg' => "Group Deleted Successfully!"
                );
                $this->session->set_userdata($user);
                if ($this->session->userdata('role') == 'mentor')
                        redirect(base_url('mentoring?locate=group'));
                else
                        redirect(base_url('admin/group'));
        }

        public function removeParticipant($group_id, $username)
        {
                if ($this->session->userdata('role') != 'mentor' && $this->session->userdata('role') != 'admin') {
                        redirect(base_url());
                }
                if ($this->Group_model->get_group_by_id(array(
                        "mentor" => $this->username,
                        "id" => $group_id
                )) == false && $this->session->userdata('role') == 'mentor') {
                        redirect(base_url());
                }

                if($this->Group_model->check_participant(array("group_id" => $group_id, "username" => $username)) == false) {
                  $user = array(
                          'warning_msg' => "User Doesn't Exists!"
                  );
                  $this->session->set_userdata($user);
                  redirect(base_url('group/' . $group_id));
                }


                $this->Group_model->delete_group_participant($group_id, $username);
                $user = array(
                        'success_msg' => "Participant Removed Successfully!"
                );
                $this->session->set_userdata($user);
                redirect(base_url('group/'.$group_id));
        }
        public function send_chat()
        {
                $details    = array(
                        'group_id' => htmlentities($this->input->post('group_id')),
                        'sender' => $this->username,
                        'body' => htmlentities($this->input->post('message'))
                );
                $validation = $this->Group_model->get_group_by_id(array(
                        'id' => htmlentities($this->input->post('group_id'))
                ));
                if(trim(htmlentities($this->input->post('message'))) == "") {
                        return;
                }
                if ($validation == false)
                        redirect(base_url());
                $data = $this->Group_model->send_message();
                echo json_encode($data);
        }
        public function get_chats($group_id)
        {
                $data = $this->Group_model->get_chats($group_id);
                foreach ($data as $chat) {
                        $chat->created_on = date("M d, Y g:i A", strtotime($chat->created_on));
                        $chat->photo      = $this->Auth_model->get_user_by_id(array(
                                "username" => $chat->sender
                        ))->photo;
                }
                echo json_encode($data);
        }
        public function invite()
        {
                if ($this->session->userdata('role') != 'mentor') {
                        redirect(base_url());
                }
                $this->form_validation->set_rules('group_id', 'Task ID', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                $this->form_validation->set_message('required', 'Enter %s');

                if ($this->form_validation->run() === FALSE) {
                        $user = array(
                                'error_msg' => validation_errors()
                        );
                        $this->session->set_userdata($user);
                        redirect(base_url('group/' . htmlentities($this->input->post('group_id'))));
                } 

                $data = array(
                        "group_id" => htmlentities($this->input->post('group_id')),
                        "username" => htmlentities($this->input->post('username')),
                );


                if($this->Group_model->get_group_by_id(array("id" => $this->input->post('group_id'), "mentor" => $this->username)) == false) {
                  redirect(base_url());
                }

                if ($this->Auth_model->get_user_by_id(array(
                        "username" => $this->input->post('username')
                )) == false) {
                        $user = array(
                                'warning_msg' => "User Dosen't Exists!"
                        );
                        $this->session->set_userdata($user);
                        redirect(base_url('group/' . htmlentities($this->input->post('group_id'))));
                }

                if($this->Group_model->check_participant($data) != false) {
                  $user = array(
                          'warning_msg' => "User Already Invited!"
                  );
                  $this->session->set_userdata($user);
                  redirect(base_url('group/' . htmlentities($this->input->post('group_id'))));
                }

                if ($this->Group_model->insert_participant($data) != false) {
                        $user = array(
                        'success_msg' => "Participant Invited Successfully!"
                        );
                        $this->session->set_userdata($user);
                        redirect(base_url('group/' . $this->input->post('group_id')));
                }
                else {
                    redirect(base_url());
                }
        }

}
