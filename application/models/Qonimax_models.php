<?php

class Qonimax_models extends CI_Model {

   
   public function __construct()
   {
      // Call the CI_Model constructor
      parent::__construct();
   }

   public function login($username,$password)
   {
      $sql=$this->db->get_where('account',array('username'=>$username,'pass'=>$password));
      if($sql->num_rows()!=0){
         $session = array(
            'username' => $sql->row()->username,
            'nama' => $sql->row()->nama,
            'pass' => $sql->row()->pass,
            'saldo' => $sql->row()->saldo,
            'hak_akses' =>$sql->row()->hak_akses
         );
         $this->session->set_userdata($session);
      }

   }
}
?>