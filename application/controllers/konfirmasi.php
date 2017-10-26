<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Konfirmasi extends CI_Controller {

	
    public function __construct() {
        parent::__construct();
        $this->load->model('mkonfirm');

    }
 
    public function index()
    {
		$this->load->view('vkonfirm');
    }
}