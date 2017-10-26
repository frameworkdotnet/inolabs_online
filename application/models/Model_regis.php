<?php
	class Model_regis extends CI_Model{
		public function tambah($username, $email, $password, $group){
			$data = array(
				'username' => $username,
				'email' => $email,
				'password' => $password,
				'group' => $group,
				);
			$this->db->insert('users',$data);
		}
	} 
?>