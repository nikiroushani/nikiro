<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Appointments_model extends CI_Model{

    public function get_details($id) {
        $query = $this->db->query("SELECT * FROM appointments WHERE id ='$id'");
        return $query->result();
    }

    public function new_appointment($id, $date, $time, $location, $dose) {
        $data = array(
            'id' => $id, 
            'date' => $date, 
            'time' => $time,
            'location' => $location,
            'dose' => $dose
        );
        $query = $this->db->insert('appointments', $data);
    }

    public function check_appointments_exist($id) {
        $query = $this->db->query("SELECT * FROM appointments WHERE id ='$id'");
        if ($query->num_rows() >= 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function check_appointment_available($date, $time, $location) {
        $query = $this->db->query("SELECT * FROM appointments WHERE date ='$date' AND time = '$time' AND location = '$location'");
        if ($query->num_rows() == 1) {
            return false;
        }
        else {
            return true;
        }
    }

    public function cancel_appointment($id, $date, $time, $location) {
        $query = $this->db->query("DELETE FROM appointments WHERE id = '$id' AND date = '$date' AND time = '$time' AND location = '$location'");
    }
}
?>
