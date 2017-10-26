<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {
	public function __construct(){
		parent::__construct();
	/*	
		if($this->session->userdata('group') != '1'){
			$this->session->set_flashdata('error','Sorry, you are not logged in!');
			redirect('login');
		}
	*/	
		//load model -> model_products
		$this->load->model('model_orders');
	}
	
	public function index()
	{
		$this->model_orders->delete_totalnol();
		$data['invoices'] = $this->model_orders->all();
		$this->load->view('backend/view_all_invoices', $data);
	}

    public function detail($invoice_id)
    {
        $data['invoice'] = $this->model_orders->get_invoice_by_id($invoice_id);
        $data['orders']  = $this->model_orders->get_orders_by_invoice($invoice_id);
		$this->load->view('backend/view_invoice_detail', $data);
    }
	
	public function admin_konfirm($invoice_id)
    {
		$is_konfirmasi = $this->model_orders->konfirm_admin($invoice_id);
		if ($is_konfirmasi){
			$this->model_orders->cetakpdfbyid($invoice_id);
			$data['info'] = $this->model_orders->getAllID($invoice_id);
			foreach ($data['info'] as $u){
			$email = $u->email;
			$nama = $u->nama;
			$id = $u->id_pesanan;
			$this->model_orders->sendMailAdmin($email,$nama,$id,$invoice_id);
			}
			//
			$data['invoices'] = $this->model_orders->all();
			$this->load->view('backend/konfirm_admin_success', $data);
		}else{
			echo "error";
		}
    }
	
	public function admin_reject($invoice_id)
    {
		$is_reject = $this->model_orders->reject_admin($invoice_id);
		if ($is_reject){
			$this->model_orders->cetakpdfbyid($invoice_id);
			$data['info'] = $this->model_orders->getAllID($invoice_id);
			foreach ($data['info'] as $u){
			$email = $u->email;
			$nama = $u->nama;
			$id = $u->id_pesanan;
			$this->model_orders->sendMailAdminReject($email,$nama,$id,$invoice_id);
			}
			//
			$data['invoices'] = $this->model_orders->all();
			$this->load->view('backend/konfirm_admin_success', $data);
		}else{
			echo "error";
		}
    }
}