<?php

class Qonimax_models extends CI_Model {

   
   public function __construct()
   {
      // Call the CI_Model constructor
      parent::__construct();
   }

   public function load_data(){
      $daftar_film=$this->db->get('daftar_film')->result();
      //update rating
      $sql=$this->db->get('daftar_film')->result();
      foreach ($sql as $row) {
         $rating=0;$i=0;
         $sql2 = $this->db->get_where('user_reviews',array('id_film'=>$row->id_film));
         foreach ($sql2->result() as $row2) {
            $rating+=$row2->rating;$i++;
         }
         if($i!=0)
            $rating = $rating/$i;
         $this->db->where('id_film',$row->id_film);
         $this->db->update('daftar_film',array('rating'=>$rating));
      }
      $this->db->order_by("rating", "desc"); 
      $this->db->limit(1);
      $top_rated = $this->db->get_where('daftar_film',array('awal_tayang <'=> date('Y-m-d'),'akhir_tayang >' =>date('Y-m-d')))->result();
      $nowplaying=$this->db->get_where('daftar_film',array('awal_tayang <'=> date('Y-m-d'),'akhir_tayang >' =>date('Y-m-d')))->result();
      
      $data = array('daftar_film'=>$daftar_film,'top_rated'=>$top_rated,'nowplaying'=>$nowplaying);
      return $data;
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
      $sql=$this->db->get_where('user',array('username'=>$username,'password'=>$password));
      var_dump($sql->result());
      if($sql->num_rows()!=0){
         $session = array(
            'username' => $sql->row()->username,
            'name' => $sql->row()->name,
            'password' => $sql->row()->password,
            'saldo' => $sql->row()->saldo,
            'privilege' =>$sql->row()->privilege
         );
         $this->session->set_userdata($session);
      }
      //echo $this->session->userdata('name');

   }

   public function nowplaying()
   {
      $this->db->order_by("rating", "desc"); 
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

   public function comingsoon()
   {
      $daftar_film=$this->db->get('daftar_film')->result();
      $comingsoon=$this->db->get_where('daftar_film',array('awal_tayang >'=> date('Y-m-d'),'akhir_tayang >' =>date('Y-m-d')))->result();
      $data =array('comingsoon' => $comingsoon,'daftar_film'=>$daftar_film);

      return $data;
   }

   public function beli_voucher($harga)
   {
      $no_voucher = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ"), 0, 15);
      $this->db->insert('voucher',array('harga'=>$harga,'no_voucher'=>$no_voucher,'status'=>0));
      $voucher=$this->db->get_where('voucher',array('no_voucher'=>$no_voucher))->row();
      return $voucher;
   }

   public function random_voucher()
   {
      $this->db->empty_table('voucher');
   }
}
?>