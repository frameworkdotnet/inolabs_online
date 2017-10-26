<?php
class Mlaporan extends CI_Model {
 
    var $tabel = 'invoices';
 
    function __construct() {
        parent::__construct();
    }
    function getAllItem($email) {
        $this->db->from($this->tabel);
        $query = $this->db->where('email',$email)->get();
        return $query->result();
    }
 
}
?>