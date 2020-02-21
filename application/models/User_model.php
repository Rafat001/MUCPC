<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  function getUsers($getData){
     $response = array();

     if(isset($getData['search']) ){
       // Select record
       $this->db->select('*');
       $this->db->where("verified = '1' AND is_active = '1' AND role = 'user' AND (student_id like '%".$getData['search']."%' OR name like '%".$getData['search']."%' )");

       $records = $this->db->get('users')->result();

       foreach($records as $row ){
		   $name = $row->name;
		   $id = $row->student_id;
       $username=$row->username;
		   $nameID=$name.' ['.$id . ']';
		   //array_push($response,$nameID);
           $response[] = array("label"=>$nameID, "value"=>$username);
       }

     }

     return $response;
  }

}