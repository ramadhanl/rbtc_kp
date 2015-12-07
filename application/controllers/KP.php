<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KP extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function tes(){
		$phrase = "MEKANISME KEAMANAN APLIKASI DAN PENETRATION TESTING DENGAN PENDEKATAN OSI LAYER";
		$this->load->model('KP_models','kp');
		$this->kp->tes($phrase);
		//return str_replace($tokens, $compounds, $phrase);
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->database('kp');
		$this->load->model('KP_models','kp');
		$this->load->view('KP/home',array('tags' => $this->kp->load_data()));
		$this->load->view('layout/footer');
	}

	public function tag($tag_tahun)
	{
		$arg = explode("_", $tag_tahun);
		$tag=$arg[0];
		$tahun=$arg[1];
		if ($arg[1]=='all')
			$tahun=9999;
		$this->load->view('layout/header');
		$this->load->database('kp');
		$this->load->model('KP_models','kp');
		$this->load->view('KP/home',array('tag_tahun'=>$tahun,'selected_tag'=>$tag,'taglist'=>$this->kp->taglist($tag,9999),'tags' => $this->kp->load_data()));
		$this->load->view('layout/footer');
	}

	public function tfidf(){
		$this->load->database('kp');
		$this->load->model('KP_models','kp');
		$this->kp->calculate_tfidf();
	}

	public function generate_tags(){
		$this->load->database('kp');
		$this->load->model('KP_models','kp');
		$this->kp->generate_tags();
	}

	public function search(){
		$this->load->database('kp');
		$this->load->model('KP_models','kp');
		//$search_results=$this->kp->search($this->input->post('searchbox'));
		$this->load->view('layout/header');
		$data = $this->kp->search($this->input->post('searchbox'));
		$this->load->view('KP/home',array('tags' => $this->kp->load_data(),'total'=>count($data['search_results'])-1,'query'=>$this->input->post('searchbox'),'search_results'=>$data['search_results'],'totaltime'=>$data['totaltime']));
		$this->load->view('layout/footer');
	}


}

/* End of file KP.php */
/* Location: ./application/controllers/KP.php */