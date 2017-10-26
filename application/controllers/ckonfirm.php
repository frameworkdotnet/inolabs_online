<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ckonfirm extends CI_Controller {

	
    public function __construct() {
        parent::__construct();
        $this->load->model('mkonfirm');

    }
 
    public function index()
    {
		$email 	= set_value('email');
		$nama 	= set_value('nama');
		$id 	= set_value('id'); 
		$is_processed = $this->mkonfirm->cek_pesanan($email,$nama,$id);
		if($is_processed){
			$is_konfirmasi = $this->mkonfirm->konfirmasi();
				if($is_konfirmasi){
					$this->mkonfirm->cetakpdf($id,$email);
					$this->mkonfirm->sendMail($email,$nama,$id);
				}else{
					redirect('welcome');
				}
			$data['invoices'] = $this->mkonfirm->getAllItem($id);	
			$this->load->view('konfirm_success',$data);
			//redirect('order/success');
		} else {
			redirect('welcome');
		}
    }
}