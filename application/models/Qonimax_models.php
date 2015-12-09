<?php

class Qonimax_models extends CI_Model {

   
   public function __construct()
   {
      // Call the CI_Model constructor
      parent::__construct();
   }

   public function add_rating($id_film,$rating,$review)
   {
      $this->db->insert('user_reviews',array('user'=>$this->session->userdata('username'),'tanggal_review'=>date('Y-m-d'),'id_film'=>$id_film,'rating'=>$rating,'review'=>$review));
   }

   public function beli_tiket($id_jadwal,$no_kursi)
   {
      $this->db->where('id_jadwal', $id_jadwal);
      $this->db->where('no_kursi', $no_kursi);
      $this->db->update('kursi',array('status' => 1));
      $sisa_kursi=$this->db->get_where('kursi',array('id_jadwal'=>$id_jadwal,'status'=>0))->num_rows();
      $this->db->where('id_jadwal', $id_jadwal);
      $this->db->update('jadwal',array('sisa_kursi'=>$sisa_kursi));
   }

   public function generate_data()
   {
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $starttime = $mtime;

      $this->db->empty_table('kursi');
      $this->db->empty_table('jadwal');
      $nowplaying=$this->db->get_where('daftar_film',array('awal_tayang <'=> date('Y-m-d'),'akhir_tayang >' =>date('Y-m-d')))->result();
      $x=1;
      foreach ($nowplaying as $row1) {
         $this->db->insert('jadwal',array('teater'=>$x,'jam_mulai' => "11:30",'jam_selesai'=>"16:00",'id_film'=>$row1->id_film,'tipe'=>$row1->kualitas));
         $this->db->insert('jadwal',array('teater'=>$x,'jam_mulai' => "16:00",'jam_selesai'=>"18:30",'id_film'=>$row1->id_film,'tipe'=>$row1->kualitas));
         $this->db->insert('jadwal',array('teater'=>$x,'jam_mulai' => "18:30",'jam_selesai'=>"21:00",'id_film'=>$row1->id_film,'tipe'=>$row1->kualitas));
         $this->db->insert('jadwal',array('teater'=>$x,'jam_mulai' => "21:00",'jam_selesai'=>"23:30",'id_film'=>$row1->id_film,'tipe'=>$row1->kualitas));
         $x++;
      }

      $jadwal=$this->db->get('jadwal');
      foreach ($jadwal->result() as $row) {
         for($i='A';$i<='P';$i++){
            for($j=1;$j<=18;$j++){
               $no_kursi=$i.$j;
               $this->db->insert('kursi',array('no_kursi' => $no_kursi,'id_jadwal'=>$row->id_jadwal,'status'=>0));
            }
         }
      $this->db->where('id_jadwal', $row->id_jadwal);
      $this->db->update('jadwal',array('sisa_kursi' => 288));
      }

      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $endtime = $mtime; 
      $totaltime = ($endtime - $starttime);
      echo "Running time : ".$totaltime." seconds";
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