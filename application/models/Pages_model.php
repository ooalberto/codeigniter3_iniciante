<?php

class Pages_model extends CI_Model
{
	private $table_name = 'pages';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get($id = null)
	{
		if ($id === null) {  #virificar o vl e o tp tem q ser null e n false 
			$query = $this->db->get($this->table_name);
			return $query->result();
		}
		$query = $this->db->get_where($this->table_name, ['id' => $id]);
		return $query->first_row();
	}

	public function insert()
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), '_', true);

		$data = [
			'title' => $this->input->post('title'),
			'body'  => $this->input->post('body'),
			'slug'  => $slug
		];

		return $this->db->insert($this->table_name, $data);
	}

	public function update($id)
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), '_', true);

		$data = [
			'title' => $this->input->post('title'),
			'body' => $this->input->post('body'),
			'slug' => $slug
		];

		return $this->db->update($this->table_name, $data);
	}

	public function delete($id)
	{
	  return $this->db->delete($this->table_name, ['id' => $id]);
 
	}
}
