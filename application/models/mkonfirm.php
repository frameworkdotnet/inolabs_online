<?php
class Mkonfirm extends CI_Model {

 
    function __construct() {
        parent::__construct();
		$this->load->library('dompdf_gen');
    }
	
    public function konfirmasi()
	{
		//change status pembayaran
		$id	= set_value('id');
		
		$this->db->set('status','confirmed');
		$this->db->where('id_pesanan',$id);
		$this->db->update('invoices');
						
		return TRUE;
	}
	
	public function cek_pesanan($email,$nama,$id)
	{
		//cek data pesanan
		$cek = array(
			'nama'		=> set_value('nama'),
			'email'		=> set_value('email'),
			'id_pesanan'=> set_value('id')			 
		);
		$this->db->where($cek);
		$this->db->get('invoices');						
		return TRUE;
	}
	
	public function cetakpdf($id,$email){
        $data['title'] = 'Cetak Transaksi Pembelian'; //judul title
        $data['qbarang'] = $this->mkonfirm->getAllItem($id); //query model semua barang
 
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
		file_put_contents("assets/pdf/".$id.".pdf", $output);
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
        $ci->email->message('Selamat '.$nama.', Pembelian Anda dengan ID Pesanan : '.$id.' telah dikonfirmasi, silahkan tunggu persetujuan dari kami paling lambat 1x24 jam. 
		Berikut Kami Lampirkan Detail Status Pesanan anda');
		$this->email->attach('assets/pdf/'.$id.'.pdf');
        if ($this->email->send()) {
            echo '';
        } else {
            show_error($this->email->print_debugger());
        }
    }
	
	function getAllItem($id) {
		
        $query = $this->db->order_by('id', 'DESC')->limit(1)->where('id_pesanan',$id)->where('total >',0)->get('invoices');
        return $query->result();
    }
}
?>