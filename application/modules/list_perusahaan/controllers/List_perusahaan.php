<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_perusahaan extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global', 'global');
	}

	public function index()
	{
		$data['list_perusahaan'] 	= $this->global->get('tb_perusahaan')->result_array();
		$this->slice->view('v_list_perusahaan', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_perusahaan', 'nama_perusahaan', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->slice->view('f_list_perusahaan');
		} else {
			// get vaiable post
			$nama_perusahaan 	= $this->input->post('nama_perusahaan');
			$data_perusahaan = [
				'nama_perusahaan'	=> $nama_perusahaan
			];
			$this->global->create('tb_perusahaan', $data_perusahaan);
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Success Added!';
	        echo json_encode($result);	
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('nama_perusahaan', 'nama_perusahaan', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id 						= decode($this->uri->segment(3));
			$data['list_perusahaan'] 	= $this->db->get_where('tb_perusahaan', array('id_perusahaan'=>$id))->row_array();
			$this->slice->view('f_list_perusahaan', $data);	
		} else {
			$data= [
				'nama_perusahaan'	=> $this->input->post('nama_perusahaan')
			];

			$this->global->update('tb_perusahaan', $data, array('id_perusahaan' => $this->input->post('id')));
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Data has been updated!';
			echo json_encode($result);
		}	
		
	}

	public function delete()
	{
		$id = decode($this->input->post('id'));
		
		if($id != NULL || $id != '') {
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Data has been deleted!';
			$this->global->delete('tb_perusahaan', array('id_perusahaan' => $id));
		} else {
			$result['error']	= TRUE;
			$result['type']		= 'error';
			$result['message']	= 'Data fail to delete!';	
		}
		echo json_encode($result);
	}

}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/Users.php */