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
		$this->load->view('layout/header',array('display'=>"home"));
		$this->load->view('display/home');
		$this->load->view('layout/footer');
	}
	public function nowplaying()
	{
		$this->load->view('layout/header',array('display'=>"nowplaying"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('display/nowplaying');
		$this->load->view('layout/footer');
	}
	public function comingsoon()
	{
		$this->load->view('layout/header',array('display'=>"comingsoon"));
		$this->load->database('qonimax');
		$this->load->model('Qonimax_models','qoni');
		$this->load->view('display/comingsoon');
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

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */