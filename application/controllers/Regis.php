<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Regis extends CI_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('model_regis');
		}

		public function index(){
			$username=$this->input->post('username');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$group=$this->input->post('group');
			$this->model_regis->tambah($username,$email,$password,$group);
			redirect('regis/member');
		}
		public function member(){
			$this->load->view('form_regis');
		}
		public function tambah(){
			$this->load->view('form_login');
		}
	}
?>