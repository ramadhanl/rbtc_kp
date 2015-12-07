<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anotasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('anotasi');
		$this->load->view('layout/footer');
	}

}

/* End of file Anotasi.php */
/* Location: ./application/controllers/Anotasi.php */