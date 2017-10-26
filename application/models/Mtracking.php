<?php
class Mtracking extends CI_Model {

 
    function __construct() {
        parent::__construct();
    }
	
    public function track_data($id)
	{
		$this->db->where('id_pesanan',$id);
		return $this->db->get('invoices');
	}
}
?>