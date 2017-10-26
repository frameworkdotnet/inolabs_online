<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_orders extends CI_Model {
	
	function __construct() {
        parent::__construct();
		
		$this->load->library('dompdf_gen');
    }
	
	public function process($id)
	{
		$email 	= set_value('email');
		$nama 	= strtolower(str_replace(" ","",substr(set_value('nama'),0,6)));
		$telp	= set_value('telp'); 
		//create new invoice
		$invoice = array(
			'nama'		=> set_value('nama'),
			'alamat'	=> set_value('alamat'),
			'telp'		=> set_value('telp'),
			'email'		=> set_value('email'),
			'id_pesanan'=> $id,
			'tgl_pesan'	=> date('Y-m-d H:i:s'),
			'due_date'	=> date('Y-m-d H:i:s', mktime( date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
			'status'	=> 'pending',
			'total'		=> $this->cart->total()
		);
		$this->db->insert('invoices', $invoice);
		$invoice_id = $this->db->insert_id();
		
		// put ordered items in orders table
		foreach($this->cart->contents() as $item){
			$data = array(
				'invoice_id'		=> $invoice_id,
				'email'				=> set_value('email'),
				'product_id'		=> $item['id'],
				'product_name'		=> $item['name'],
				'qty'				=> $item['qty'],
				'price'				=> $item['price']
			);
			$this->db->insert('orders', $data);
		}
				
		return TRUE;
	}
	
    public function all()
    {
        //Get all invoices from Invoices table
        $hasil = $this->db->get('invoices');
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else {
            return false;
        }
    }

    public function get_invoice_by_id($invoice_id)
    {
        $hasil = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
        if($hasil->num_rows() > 0){
            return $hasil->row();
        } else {
            return false;
        }
    }

    public function get_orders_by_invoice($invoice_id)
    {
        $hasil = $this->db->where('invoice_id',$invoice_id)->get('orders');
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else {
            return false;
        }
    }
	
	
	public function tampil_data($email)
	{
		$this->db->where('email',$email);
		return $this->db->get('orders');
	}
	
	public function tampil_invoices($email)
	{
		$this->db->limit(1);
		$this->db->order_by('id','DESC');
		$this->db->where('email',$email);
		$this->db->where('total >',0);
		return $this->db->get('invoices');
	}
	
	public function delete_totalnol()
	{
		$this->db->where('total',0);
		$this->db->delete('invoices');
	}
	
	 function sendMail($email,$nama,$id) {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "inolabshop@gmail.com";
        $config['smtp_pass'] = "inolabs2017";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('inolabshop@gmail.com', 'Toko Online Inolabs');
        $list = array($email);
        $ci->email->to($list);
        $ci->email->subject('[Inolabs Online] Transaksi Pembelian Atas Nama : '.$nama);
        $ci->email->message('Selamat '.$nama.', Pembelian Anda telah terverifikasi dengan ID Pesanan : '.$id.', silahkan lakukan pembayaran sebelum 1x24 jam. 
		Berikut Kami Lampirkan Detail Pesanan anda');
		$this->email->attach('assets/pdf/'.$email.'.pdf');
        if ($this->email->send()) {
            echo '';
        } else {
            show_error($this->email->print_debugger());
        }
    }
	
	 function sendMailAdmin($email,$nama,$id,$invoice_id) {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "inolabshop@gmail.com";
        $config['smtp_pass'] = "inolabs2017";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('inolabshop@gmail.com', 'Toko Online Inolabs');
        $list = array($email);
        $ci->email->to($list);
        $ci->email->subject('[Inolabs Online] Transaksi Pembelian Atas Nama : '.$nama);
        $ci->email->message('Selamat '.$nama.', Pembelian Anda telah Disetujui dengan ID Pesanan : '.$id.', Silahkan tunggu kurir kami mengantarkan pesanan Anda. 
		Berikut Kami Lampirkan Detail Pesanan anda');
		$this->email->attach('assets/pdf/'.$invoice_id.'.pdf');
        if ($this->email->send()) {
            echo '';
        } else {
            show_error($this->email->print_debugger());
        }
    }
	
	function sendMailAdminReject($email,$nama,$id,$invoice_id) {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "inolabshop@gmail.com";
        $config['smtp_pass'] = "inolabs2017";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        
        $ci->email->initialize($config);
 
        $ci->email->from('inolabshop@gmail.com', 'Toko Online Inolabs');
        $list = array($email);
        $ci->email->to($list);
        $ci->email->subject('[Inolabs Online] Transaksi Pembelian Atas Nama : '.$nama);
        $ci->email->message('Mohon Maaf, '.$nama.', Pembelian Anda telah Dibatalakan dengan ID Pesanan : '.$id.', Silahkan melakukan pembelian kembali. 
		Berikut Kami Lampirkan Detail Pesanan anda');
		$this->email->attach('assets/pdf/'.$invoice_id.'.pdf');
        if ($this->email->send()) {
            echo '';
        } else {
            show_error($this->email->print_debugger());
        }
    }
	
	function getAllItem($email) {
		
        $query = $this->db->order_by('id', 'DESC')->limit(1)->where('email',$email)->where('total >',0)->get('invoices');
        return $query->result();
    }
	
	function getAllID($invoice_id) {
		
        $query = $this->db->where('id',$invoice_id)->get('invoices');
        return $query->result();
    }
	
	public function cetakpdf($email){
        $data['title'] = 'Cetak Transaksi Pembelian'; //judul title
        $data['qbarang'] = $this->model_orders->getAllItem($email); //query model semua barang
 
        $this->load->view('vcetaklaporan', $data);
 
        $paper_size  = 'A4'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        //$this->dompdf->stream("laporan.pdf");
		$output = $this->dompdf->output();
		file_put_contents("assets/pdf/".$email.".pdf", $output);
    }
	
	public function cetakpdfbyid($invoice_id){
        $data['title'] = 'Cetak Transaksi Pembelian'; //judul title
        $data['qbarang'] = $this->model_orders->getAllID($invoice_id); //query model semua barang
 
        $this->load->view('backend/view_konfirm_success', $data);
 
        $paper_size  = 'A4'; //paper size
        $orientation = 'landscape'; //tipe format kertas
        $html = $this->output->get_output();
 
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        //$this->dompdf->stream("laporan.pdf");
		$output = $this->dompdf->output();
		file_put_contents("assets/pdf/".$invoice_id.".pdf", $output);
    }
	
	public function konfirm_admin($invoice_id)
	{
		//change status pembayaran
		$this->db->set('status','approved');
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices');
						
		return TRUE;
	}
	
	public function reject_admin($invoice_id)
	{
		//change status pembayaran
		$this->db->set('status','rejected');
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices');
						
		return TRUE;
	}
}
