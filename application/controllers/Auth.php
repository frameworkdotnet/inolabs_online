<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Auth extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
    }
  
    public function index()
    {
        $this->load->view("login.php");
    }
  
    public function hai()
    {
        print_r($this->session->userdata('login'));
    }
  
    public function log_with_google()
    {
        # cek sudah login belum
        if (!empty($this->session->userdata('login'))) {
            redirect('admin/products');
        }
  
        # redirect ke auth url google
        $client = $this->get_google_client();
        $auth_url = $client->createAuthUrl();
        redirect($auth_url);
    }
 
    public function logout()
    {
        $this->session->set_userdata('login', null);
 
        redirect('auth');
    }
  
    public function google()
    {
        # kalo sudah login atau tidak ada get code, redirect
        if (!empty($this->session->userdata('login')) OR empty($_GET['code'])) {
            redirect('auth/hai');
        }
  
        $client = $this->get_google_client();
        $client->authenticate($_GET['code']);
  
        # ambil profilenya
        $plus = new Google_Service_Plus($client);
        $profile = $plus->people->get("me");
  
        # cek dulu sudah ada belum
		$user = $this->AuthModel->retrieve("", $profile['emails'][0]['value']);
		# jika belum ada, simpan
		if (empty($user)) {
			$user_id = $this->AuthModel->create(
            $profile['emails'][0]['value'],
            "",
            $profile['name']['familyName'],
            $profile['image']['url']
        );
 
        $user = $this->AuthModel->retrieve($user_id);
		}
 
		$this->session->set_userdata('login', $user);
 
		redirect('admin/products');
    }
  
    private function get_google_client()
    {
        $client = new Google_Client();
        $client->setAuthConfigFile(APPPATH . 'client_secret.json'); //rename file ini supaya lebih aman nanti
        $client->setRedirectUri("http://localhost/inolabs_online/index.php/auth/google");
        $client->setScopes(array(
            "https://www.googleapis.com/auth/plus.login",
            "https://www.googleapis.com/auth/userinfo.email",
            "https://www.googleapis.com/auth/userinfo.profile",
            "https://www.googleapis.com/auth/plus.me",
        ));
  
        return $client;
    }
}