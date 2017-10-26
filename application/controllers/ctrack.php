<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ctrack extends CI_Controller {

	
    public function __construct() {
        parent::__construct();
        $this->load->model('mtracking');

    }
 
    public function index()
    {
		$id = set_value('id');
		$data['invoices'] = $this->mtracking->track_data($id)->result();
		$this->load->view('tracking_success',$data);
    }
}