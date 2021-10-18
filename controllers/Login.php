<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$data['regerror']="";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		// User is not logged in
		if (!$this->session->userdata('logged_in'))//check if user already login
		{
			
			$this->load->view('login', $data); //if user has not login ask user to login
		}else{
			$this->load->view('home'); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}

	public function check_login() {
		$this->load->model('user_model');		//load user model
		$data['regerror']="";
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$email = $this->input->post('email'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			if ( $this->user_model->login($email, $password) )//check username and password
			{
				$user_data = array(
					'email' => $email,
					'logged_in' => true 	//create session variable
				);
				$this->session->set_userdata($user_data); //set user status to login in session
				redirect('login'); // direct user home page
			}
			else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			{
				redirect('login'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}

	public function check_registration() {
		// load model
		$this->load->model('user_model');
		$data['error']="";
		$data['regerror']= "<div class=\"alert alert-success\" role=\"alert\">Registration Successful</div> ";
		// load healpers
		$this->load->helper('form');
		$this->load->helper('url');
		// load header
		$this->load->view('template/header');

		// get username and password values from form
		$email = $this->input->post('regemail'); //getting username from login form
		$password = $this->input->post('regpassword'); //getting password from login form
		$confirmpassword = $this->input->post('confirmpassword');
		$check_unique_and_add = $this->user_model->register($email, $password);

		// If user is not logged in
		if (!$this->session->userdata('logged_in')){
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$data['regerror']= "<div class=\"alert alert-danger\" role=\"alert\">Email Is Not Valid</div> ";
			}
			if ($password != $confirmpassword) {
				$data['regerror']= "<div class=\"alert alert-danger\" role=\"alert\">Passwords Do Not Match</div> ";
			}
			if (!$check_unique_and_add) {
				$data['regerror']= "<div class=\"alert alert-danger\" role=\"alert\">Email Already Registered</div> ";
			}
		}
		// User is logged in
		else {
			redirect('home'); //if user already logined direct user to home page
		}
		// load footer
		$this->load->view('login', $data);
		$this->load->view('template/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		redirect('login'); // redirect user back to login
	}
}
?>
