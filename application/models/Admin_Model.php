<?php defined('BASEPATH') OR exit('invalied');

class Admin_Model extends CI_Model{

  protected $table = 'admins';


function get_admin_email($email){
return $this->db->get_where($this->table,['email'=>$email])->row();


}
}



?>