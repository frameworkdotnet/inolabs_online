<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Track extends CI_Controller {

	
    public function __construct() {
        parent::__construct();
        $this->load->model('mtracking');

    }
 
    public function index()
    {
		$this->load->view('tracking');
    }
}