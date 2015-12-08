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

   public function nowplaying()
   {
      $nowplaying=$this->db->get_where('daftar_film',array('awal_tayang <'=> date('Y-m-d'),'akhir_tayang >' =>date('Y-m-d')))->result();
      foreach ($nowplaying as $row) {
         $reviews[$row->id_film]=$this->db->get_where('user_reviews',array('id_film' => $row->id_film ))->result();
         $jadwal[$row->id_film]=$this->db->get_where('jadwal',array('id_film'=>$row->id_film))->result();
         $xjadwal=$this->db->get_where('jadwal',array('id_film'=>$row->id_film))->result();
         foreach ($xjadwal as $row2) {
            $kursi[$row2->id_jadwal]=$this->db->get_where('kursi',array('id_jadwal'=>$row2->id_jadwal,'status'=>0))->result();
         }
      }
      $data =array('nowplaying' => $nowplaying,'reviews'=>$reviews,'jadwal'=>$jadwal,'kursi'=>$kursi);
      return $data;
   }
}
?>