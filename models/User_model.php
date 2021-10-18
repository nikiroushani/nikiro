<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($email, $password){
        $this->db->select('password')->from('users')->where('email',$email);
        $query = $this->db->get();
		$hash = $query->row()->password;
        
        if (password_verify($password, $hash)) {
			return true;
		}
		else {
			return false;
        }
    }

    public function register($email, $password) {
        $query = $this->db->query("SELECT email FROM users WHERE email ='$email'");
        $data = array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );
        if ($query->num_rows() == 1) {
            return false;
        }
        else {
            $query2 = $this->db->insert('users', $data);
            return true;
        }
    }

    public function get_id($email) {
        $query = $this->db->query("SELECT id AS id FROM users WHERE email = '$email'");
        return $query->result();
    }
}
?>
