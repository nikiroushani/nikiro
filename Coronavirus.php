<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Coronavirus extends CI_Controller
{
    public function index() {
        
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->view('template/header');
        $this->load->view('coronavirus');
		$this->load->view('template/footer');
    }

}