<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Locations_model extends CI_Model{
    public function fetch_data($query) {
        if($query == '') {
            return null;
        }
        else {

            $this->db->select("*");
            $this->db->from("locations");
            $this->db->where('postcode >=', $query - 5);
            $this->db->where('postcode <=', $query + 5);
            return $this->db->get();
        }
    }
}
?>
