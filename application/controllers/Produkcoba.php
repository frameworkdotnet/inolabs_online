<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Produkcoba extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('product');
    }
    
    function index(){
        $data = array();
        //get products data from database
        $data['products'] = $this->product->getRows();
        //pass the products data to view
        $this->load->view('products/index', $data);
    }
    
    function buy($id){
        //Set variables for paypal form
        $returnURL = base_url().'index.php/paypal/success'; //payment success url
        $cancelURL = base_url().'index.php/paypal/cancel'; //payment cancel url
        $notifyURL = base_url().'index.php/paypal/ipn'; //ipn url
        //get particular product data
        $product = $this->product->getRows($id);
        $userID = 1; //current user id
        $logo = base_url().'assets/images/codexworld-logo.png';
        $harga = $product['total']/13600;
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['id_pesanan']) ;
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $harga);        
        $this->paypal_lib->image($logo);
        
        $this->paypal_lib->paypal_auto_form();
    }
}