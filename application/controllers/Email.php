<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Email extends CI_Controller {
 
 
    function sendMail() {
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
        $email = 'hkr.shoichi@gmail.com';
        
        $ci->email->initialize($config);
 
        $ci->email->from('your_email@gmail.com', 'Your Name');
        $list = array($email);
        $ci->email->to($list);
        $ci->email->subject('judul email');
        $ci->email->message('isi email');
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
 
}
?>