<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Book extends CI_Controller
{
    public function index() {
        $data['id'] = "";
        $data['error'] = "";
        $data['regerror'] = "";
        $data['bookings'] = "";
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
        $data['cancelmessage'] = "";
        $data['hasbookings'] = FALSE;
        
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->model('user_model');
        $this->load->model('ContactDetails_model');
        $this->load->model('Appointments_model');
        $this->load->view('template/header');

        if (!$this->session->userdata('logged_in'))//check if user already login
		{
			$this->load->view('login', $data); //if user has not login ask user to login
		}else{
            $email = $this->session->userdata('email');
            $id = $this->user_model->get_id($email);
            $data['id'] = $id[0]->id;
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
            // check appointments exist
            if ($this->Appointments_model->check_appointments_exist($id[0]->id)) {
                
                $data['hasbookings'] = TRUE;
                $data['bookings'] = $this->Appointments_model->get_details($id[0]->id);
                $this->load->view('display_bookings', $data);
            }
			$this->load->view('new_booking', $data); //if user already logined show main page
		}
		$this->load->view('template/footer');
        
    }

    public function make_booking() {
        $data['error'] = "";
        $data['cancelmessage'] = "";
        $data['id'] = "";
        $data['bookings'] = "";
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
        $data['hasbookings'] = FALSE;
        
        // load model and helpers
        $this->load->model('user_model');
        $this->load->model('ContactDetails_model');
        $this->load->model('Appointments_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->view('template/header');

        // get form input
        $email = $this->session->userdata('email');
        $id = ($this->user_model->get_id($email))[0]->id;
        $data['id'] = $id;
        // contact details
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
        // get appointment details
        $bookingdate = $this->input->post('bookingdate');
        $bookingtime = $this->input->post('bookingtime');
        $location = $this->input->post('location');
        $dose = $this->input->post('dose');

        // Add contact details or update database
        if ($this->ContactDetails_model->check_details_exist($id)) {
            $this->ContactDetails_model->update_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort);
            
        }
        else {
            $this->ContactDetails_model->add_details($id, $firstname, $middlename, $lastname, $gender, $dob, $medicare, $address, $suburb, $postcode, $origin, $email, $phone, $cohort);
            
        }

        // Check chosen app available
        if ($this->Appointments_model->check_appointment_available($bookingdate, $bookingtime, $location)) {
            // Add appointment
            $this->Appointments_model->new_appointment($id, $bookingdate, $bookingtime, $location, $dose);
            $data['error'] = "<div class=\"alert alert-success\" role=\"alert\">Appointment Booked!</div>";
        }
        else { 
            $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\">Appointment Not Available, Please Choose A Different Date, Time or Location</div>";
        }
        if ($this->Appointments_model->check_appointments_exist($id)) {
            $data['hasbookings'] = TRUE;
            $data['bookings'] = $this->Appointments_model->get_details($id);
            $this->load->view('display_bookings', $data);
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
        $data['cancelmessage'] = "";
       
        $this->load->view('new_booking', $data);
        $this->load->view('template/footer');
    }

    public function remove_booking() {
        $data['error'] = "";
        $data['id'] = "";
        $data['bookings'] = "";
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
        $data['hasbookings'] = FALSE;
        
        $data['cancelmessage'] = "";
        
        // load model and helpers
        $this->load->model('user_model');
        $this->load->model('ContactDetails_model');
        $this->load->model('Appointments_model');
        $this->load->helper('form');
        $this->load->helper('url');

        $email = $this->session->userdata('email');
        $id = ($this->user_model->get_id($email))[0]->id;
        $canceldate = $this->input->get('canceldate');
        $canceltime = $this->input->get('canceltime');
        $cancellocation = $this->input->get('cancellocation');
       
        // Cancel appointment
        $this->Appointments_model->cancel_appointment($id, $canceldate, $canceltime, $cancellocation);
        $data['cancelmessage'] = "<div class=\"alert alert-success\" role=\"alert\">Appointment Cancelled!</div>";
        $this->load->view('template/header');

        if ($this->ContactDetails_model->check_details_exist($id)) {
                
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
        }

        if ($this->Appointments_model->check_appointments_exist($id)) {
            $data['hasbookings'] = TRUE;
            $data['bookings'] = $this->Appointments_model->get_details($id);
        }
        $this->load->view('display_bookings', $data);
        $this->load->view('new_booking', $data);
        $this->load->view('template/footer');

    }

}