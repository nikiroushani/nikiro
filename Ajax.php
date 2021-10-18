<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajax extends CI_Controller {
    public function fatch() {
        $this->load->model('locations_model'); // load product_model 
        $output = '';
        $query = '';

        if($this->input->get('query')) { 
            $query = $this->input->get('query'); // get search query send from ajax search form
        }

        $data = $this->locations_model->fetch_data($query); //send query to product_model and put result to $data
        if(!$data == null) {
            echo json_encode ($data->result()); //send result back
        }
        else {
            echo  ""; // no result found
        }
    }
}
?>
