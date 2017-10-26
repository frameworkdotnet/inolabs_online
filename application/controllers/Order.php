<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		/*if(!$this->session->userdata('username'))
		{
			redirect('login');
		}*/
		$this->load->model('model_orders');
	}
	
	public function index()
	{
		$this->model_orders->delete_totalnol();
		$email 	= set_value('email');
		$telp	= set_value('telp');
		$nama	= set_value('nama');
		$nama1 	= strtolower(str_replace(" ","",substr(set_value('nama'),0,6)));
		$id		= $nama1."".$telp."".date('ymdHis');
		$is_processed = $this->model_orders->process($id);
		if($is_processed){
			
			$this->cart->destroy();
			$data['orders'] = $this->model_orders->tampil_data($email)->result();
			$data['invoices'] = $this->model_orders->tampil_invoices($email)->result();
			$this->model_orders->cetakpdf($email);
			$this->model_orders->sendMail($email,$nama,$id);
			$this->load->view('order_success',$data);
			//redirect('order/success');
		} else {
			$this->session->set_flashdata('error','Failed to processed your order, please try again!');
			redirect('welcome/cart');
		}
	}

	public function success()
	{
		$this->load->view('order_success');
	}
}