<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class ContactDetails_model extends CI_Model{

    public function get_details($id) {
        $query = $this->db->query("SELECT * FROM contactDetails WHERE id ='$id'");
        foreach ($query->result() as $row) {
            $data = array(
                'firstname' => $row->firstname, 
                'middlename' => $row->middlename, 
                'lastname' => $row->lastname,
                'gender' => $row->gender,
                'dob' => $row->dob, 
                'medicare' => $row->medicare,
                'address' => $row->address,
                'suburb' => $row->suburb, 
                'postcode' => $row->postcode,
                'origin' => $row->origin,
                'email' => $row->email,
                'phone' => $row->phone,
                'id' => $row->id,
                'cohort' => $row->cohort
            );
        }
        return $data;
    }

    public function add_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort) {
        $data = array(
            'id' => $id,
            'firstname' => $firstname, 
            'middlename' => $middlename, 
            'lastname' => $lastname,
            'gender' => $gender,
            'dob' => $dob, 
            'medicare' => $medicare,
            'address' => $address,
            'suburb' => $suburb, 
            'postcode' => $postcode,
            'origin' => $origin,
            'email' => $email,
            'phone' => $phone,
            'cohort' => $cohort
        );
        $query = $this->db->insert('contactDetails', $data);
    }

    public function check_details_exist($id) {
        
        $query = $this->db->query("SELECT * FROM contactDetails WHERE id ='$id'");
        
        if ($query->num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function update_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort) {
        $query = $this->db->query("UPDATE contactDetails SET firstname='$firstname', middlename='$middlename', lastname='$lastname', gender='$gender', dob='$dob', medicare='$medicare', address='$address', suburb='$suburb', postcode='$postcode', origin='$origin', email='$email', phone='$phone', cohort='$cohort' WHERE id = '$id'");
    }
}
?>
