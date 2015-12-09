<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('layout/header',array('display'=>"home",'data'=>$this->qoni->load_data()));
		$this->load->view('display/home');
		$this->load->view('layout/footer');
	}

	public function generate_data()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->generate_data();
	}

	public function transaksi()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('layout/header',array('display'=>"transaksi",'data'=>$this->qoni->load_datatransaksi()));
		$this->load->view('display/transaksi');
		$this->load->view('layout/footer');
	}

	public function beli_tiket()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->beli_tiket($this->input->post('id_jadwal'),$this->input->post('no_kursi'));
		redirect(base_url("menu/transaksi"));	
	}

	public function add_rating()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->add_rating($this->input->post('id_film'),$this->input->post('rating'),$this->input->post('review'));
		redirect(base_url("menu/nowplaying"));	
	}

	public function nowplaying()
	{
		$this->load->view('layout/header',array('display'=>"nowplaying"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('display/nowplaying',array('data'=>$this->qoni->nowplaying()));
		$this->load->view('layout/footer');
	}
	public function comingsoon()
	{
		$this->load->view('layout/header',array('display'=>"comingsoon"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('display/comingsoon',array('data'=>$this->qoni->comingsoon()));
		$this->load->view('layout/footer');
	}
	public function saldo()
	{
		$this->load->view('layout/header',array('display'=>"saldo"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$data=null;
		$this->load->view('display/saldo',array('data'=>$data));
		$this->load->view('layout/footer');
	}

	public function isi_saldo()
	{
		$this->load->view('layout/header',array('display'=>"saldo"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$status = $this->qoni->isi_saldo($this->input->post('no_voucher'));
		$data = array('status' => $status);
		$this->load->view('display/saldo',array('data'=>$data));
		$this->load->view('layout/footer');
	}

	public function login()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->login($this->input->post('username'),$this->input->post('password'));
		redirect(base_url(""));		
	}
	
	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function random_voucher()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->random_voucher();
		
	}

	public function display_voucher()
	{
		$this->load->view('layout/header',array('display'=>"displayvoucher"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$data = array('status_beli' => 0 );
		$this->load->view('display/pegawai/display_voucher',array('data'=>$data));
		$this->load->view('layout/footer');
	}

	public function tambahfilm()
	{
		$this->load->view('layout/header',array('display'=>"tambahfilm"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$data=null;
		$this->load->view('display/pegawai/tambahfilm',array('data'=>$data));
		$this->load->view('layout/footer');
	}

	public function proses_tambahfilm()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		
		$config['upload_path'] = 'C:/wamp/www/qonimax/static/images/film/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp';
		$config['max_size']	= '300';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']  = TRUE;
		$file = $_FILES['userfile']['name'];
		$ext = substr(strrchr($file, '.'), 1);
		$new_name = $this->input->post('judul_film').".$ext";
		$config['file_name'] = $new_name;
		$config['convert_dots'] = FALSE;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if(!$this->upload->do_upload('userfile')){
			$upload_data = $this->upload->data();
			echo $this->upload->display_errors();
			$sukses=0;
		}
		else{
			$file_data = $this->upload->data();
			$data = base_url().'images/'.$file_data['file_name'];
			$sukses=1;
		}


		$this->qoni->proses_tambahfilm($file,$this->input->post('judul_film'),$this->input->post('sinposis'),$this->input->post('durasi'),$this->input->post('kategori'),$this->input->post('awal_tayang'),$this->input->post('akhir_tayang'));
		$data = array('sukses' => $sukses);
		$this->load->view('layout/header',array('display'=>"tambahfilm"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('display/pegawai/tambahfilm',array('data'=>$data));
		$this->load->view('layout/footer');
	}

	public function beli_voucher()
	{
		$harga = $this->input->post('harga');
		$this->load->view('layout/header',array('display'=>"displayvoucher"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$data = array('status_beli' => 1,'voucher'=>$this->qoni->beli_voucher($harga));
		$this->load->view('display/pegawai/display_voucher',array('data'=>$data));
		$this->load->view('layout/footer');
	}	
}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */