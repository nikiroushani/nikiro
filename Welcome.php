<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$this->load->view('home'); //if user already logined show main page
		$this->load->view('template/footer');
	}
}
