<?php 


class Pages extends CI_Controller
{
	public function index()
	{
		#echo 'Retornando um controler dinanimo na rota Pages -: index()';
		$this->load->model('pages_model');
		$result = $this->pages_model->get();

		$this->load->view('templates/header.php');
		$this->load->view('pages/index.php',['pages'=>$result]);
		$this->load->view('templates/footer.php');
		
	}

	public function view($id = 'sem vl')
		{

			echo 'retornando uma view da View('.$id.')';
		}
	
}
