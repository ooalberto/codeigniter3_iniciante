<?php


class Pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
	}
	public function index()
	{
		#echo 'Retornando um controler dinanimo na rota Pages -: index()';
		#$this->load->model('pages_model');
		$result = $this->pages_model->get();
		$this->load->view('templates/header');
		$this->load->view('pages/index', ['pages' => $result]);
		$this->load->view('templates/footer');
	}

	public function view($id)
	{
		$page = $this->pages_model->get($id);
		$this->load->view('pages/view',['page'=>$page]);
	}

	public function insert()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('body', 'Conteúdo', 'required');

		if ($this->form_validation->run() === false) {
			$this->load->view('templates/header');
			$this->load->view('pages/insert');
			$this->load->view('templates/footer');
		} else {
			$data['back'] = '/pages';
			$this->pages_model->insert();
			$this->load->view('templates/success', $data);
		}
	}

	public function edit($id = null)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('body', 'Conteúdo', 'required');

		if ($this->form_validation->run() === false) {
			$this->load->view('templates/header');
			
			$page = $this->pages_model->get($id);

			$this->load->view('pages/edit', ['page'=>$page]);
			$this->load->view('templates/footer');
		} else {
			$data['back'] = '/pages/' . $id;
			$this->pages_model->update($id);
			$this->load->view('templates/success', $data);
		}
	}

	public function delete($id = null)
	{
		// $this->pages_model->delete($id);
		// $this->load->view('templates/header');
		// $this->load->view('/pages/');
		// $this->load->view('templates/footer');

		$data['back'] = '/pages';
        $this->pages_model->delete($id);
        $this->load->view('templates/success', $data);
	}
}
