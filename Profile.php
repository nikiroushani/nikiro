<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller
{
    public function index() {
        $data['error'] = "";
        $data['firstname'] = "";
        $data['middlename'] = "";
        $data['lastname'] = "";
        $data['address'] = "";
        $data['suburb'] = "";
        $data['postcode'] = "";
        $data['gender'] = "";
        $data['dob'] = "";
        $data['medicare'] = "";
        $data['origin'] = "";
        $data['phone'] = "";
        $data['cohort'] = "";
        $data['email'] = "";

        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->model('user_model');
        $this->load->model('ContactDetails_model');
        $this->load->view('template/header');

        if (!$this->session->userdata('logged_in'))//check if user already login
		{
			$this->load->view('login', $data); //if user has not login ask user to login
		}else{
            $email = $this->session->userdata('email');
            $id = $this->user_model->get_id($email);
            if ($this->ContactDetails_model->check_details_exist($id[0]->id)) {
                
                $userinfo = $this->ContactDetails_model->get_details($id[0]->id);
                
                $data['firstname'] = $userinfo['firstname'];
                $data['middlename'] = $userinfo['middlename'];
                $data['lastname'] = $userinfo['lastname'];
                $data['address'] = $userinfo['address'];
                $data['suburb'] = $userinfo['suburb'];
                $data['postcode'] = $userinfo['postcode'];
                $data['gender'] = $userinfo['gender'];
                $data['dob'] = $userinfo['dob'];
                $data['medicare'] = $userinfo['medicare'];
                $data['origin'] = $userinfo['origin'];
                $data['phone'] = $userinfo['phone'];
                $data['cohort'] = $userinfo['cohort'];
                $data['email'] = $userinfo['email'];
            }
			$this->load->view('profile', $data); //if user already logined show main page
		}
		$this->load->view('template/footer');
        
    }

    public function update() {
        $data['error'] = "";
        $data['firstname'] = "";
        $data['middlename'] = "";
        $data['lastname'] = "";
        $data['address'] = "";
        $data['suburb'] = "";
        $data['postcode'] = "";
        $data['gender'] = "";
        $data['dob'] = "";
        $data['medicare'] = "";
        $data['origin'] = "";
        $data['phone'] = "";
        $data['cohort'] = "";
        $data['email'] = ""; 
        // load model and helpers
        $this->load->model('user_model');
        $this->load->model('ContactDetails_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('template/header');

        // get form input
        $email = $this->session->userdata('email');
        $id = ($this->user_model->get_id($email))[0]->id;
        $middlename = NULL;
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname = $this->input->post('lastname');
        $address = $this->input->post('address');
        $suburb = $this->input->post('suburb');
        $postcode = $this->input->post('postcode');
        $gender = $this->input->post('gender');
        $dob = $this->input->post('dob');
        $medicare = $this->input->post('medicare');
        $origin = $this->input->post('origin');
        $phone = $this->input->post('phone');
        $cohort = $this->input->post('cohort');

        if ($this->ContactDetails_model->check_details_exist($id)) {
            $this->ContactDetails_model->update_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort);
            $data['error'] = "<div class=\"alert alert-success\" role=\"alert\">Details Updated!</div>";
        }
        else {
            $this->ContactDetails_model->add_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort);
            $data['error'] = "<div class=\"alert alert-success\" role=\"alert\">Details Updated!</div>";
        }

        $userinfo = $this->ContactDetails_model->get_details($id);
        
        $data['firstname'] = $userinfo['firstname'];
        $data['middlename'] = $userinfo['middlename'];
        $data['lastname'] = $userinfo['lastname'];
        $data['address'] = $userinfo['address'];
        $data['suburb'] = $userinfo['suburb'];
        $data['postcode'] = $userinfo['postcode'];
        $data['gender'] = $userinfo['gender'];
        $data['dob'] = $userinfo['dob'];
        $data['medicare'] = $userinfo['medicare'];
        $data['origin'] = $userinfo['origin'];
        $data['phone'] = $userinfo['phone'];
        $data['cohort'] = $userinfo['cohort'];
        $data['email'] = $userinfo['email'];
        
        $this->load->view('profile', $data);
        $this->load->view('template/footer');
    }

}