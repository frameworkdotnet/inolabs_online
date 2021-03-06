<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Model{
    //get and return product rows
    public function getRows($id = ''){
        $this->db->select('id,id_pesanan,total');
        $this->db->from('invoices');
        if($id){
            $this->db->where('id',$id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('id','asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    //insert transaction data
    public function insertTransaction($data = array()){
        $insert = $this->db->insert('payments',$data);
        return $insert?true:false;
    }
}