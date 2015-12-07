<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TA extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$this->load->database('stki');
		$this->load->view('layout/header');
		$data['sidebar']['name'] = "Rumpun Mata Kuliah";
		$data['sidebar']['list'] = array( 1 => 'Komputasi Berbasis Jaringan', 2 => 'Komputasi Cerdas dan Visi', 3 => 'Rekayasa Perangkat Lunak', 4 => 'Arsitektur dan Jaringan Komputer', 5 => 'Manajemen Informasi', 6 => 'Dasar dan Terapan Komputasi', 7 => 'Algoritma dan Pemrograman', 8 => 'Interaksi Grafik dan Seni' );
		$data['sidebar']['detail_url'] = 'RMK';
		$this->load->view('layout/sidebar',$data);
		$this->load->view('TA/default');
		$this->load->view('layout/footer');
	}

	public function RMK($id_rmk='')
	{
		$this->load->database('stki');
		$this->load->view('layout/header');
		$data['sidebar']['name'] = "Rumpun Mata Kuliah";
		$data['sidebar']['list'] = array( 1 => 'Komputasi Berbasis Jaringan', 2 => 'Komputasi Cerdas dan Visi', 3 => 'Rekayasa Perangkat Lunak', 4 => 'Arsitektur dan Jaringan Komputer', 5 => 'Manajemen Informasi', 6 => 'Dasar dan Terapan Komputasi', 7 => 'Algoritma dan Pemrograman', 8 => 'Interaksi Grafik dan Seni' );
		$data['sidebar']['detail_url'] = 'RMK';
		$this->load->view('layout/sidebar',$data);
		$this->load->view('TA/default');
		$this->load->view('layout/footer');
	}

}

/* End of file TA.php */
/* Location: ./application/controllers/TA.php */ ?>