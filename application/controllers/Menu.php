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

	public function beli_tiket()
	{
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->qoni->beli_tiket($this->input->post('id_jadwal'),$this->input->post('no_kursi'));
		redirect(base_url("menu/nowplaying"));	
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
		$this->load->view('display/saldo');
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