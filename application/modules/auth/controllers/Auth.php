<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth','auth');
	}

	public function index()
	{	
			$sql_d = "SELECT nama_perusahaan, keputusan FROM tb_perusahaan" ;
			$data['keputusan'] = $this->db->query($sql_d)->result_array();
			
			// Group nama_perusahaan
			foreach ($data['keputusan'] as $key => $value) {
					$nm_perusahaan = $value['nama_perusahaan'];
					$temps[$value['nama_perusahaan']][]= $value['keputusan'];
			}
			
			$data['keputusan'] = $temps;

			$sql 	= "SELECT a.*, b.nama_perusahaan, b.keputusan FROM tb_data_keuangan a,
						tb_perusahaan b WHERE a.id_perusahaan = b.id_perusahaan";			
			$data['all_data'] 	= $this->db->query($sql)->result_array();

			// Group by array by nama->tahun
			foreach ($data['all_data'] as $key => $value) {
					$t_tahun = $value['tahun'];
					$temp[$value['nama_perusahaan']][$t_tahun][] = $value;
			}

			// Sorting array tahun
			foreach ($temp as $key2 => $value2) {
				ksort($value2);
				$temp2[$key2] = $value2;
			}
			$data['all_data'] 	= $temp2;
			// dd($data['keputusan']['PT. GreenHill Tbk'][0]);
		$this->slice->view('v_login', $data);
	}
	
	public function do_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$result['error'] 	= TRUE;
			$result['message'] 	= validation_errors();
		} else {
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$user 		= $this->auth->check_login($username);
			
			if(!empty($user)) {
				if(password_verify($password, $user['password'])) {
					// set session
					$sess_data = [
						'logged_in' => TRUE,
						'role_id'	=> $user['role_id'],
						'id'		=> $user['id'],
						'username'	=> $user['username'],
						'redirect_back' => $_SERVER['HTTP_REFERER'],
					];
					$this->session->set_userdata($sess_data);

					// update last login
					$data['last_login'] = date('Y-m-d H:i:s');
					(isset($user['id'])) ? $this->global->update('users', $data, array('id'=> $user['id'])) : '';
					$result['error'] 	= FALSE;
					$result['user']  	= $sess_data;
				} else {
					$result['error'] 	= TRUE;
					$result['message'] 	= 'Wrong password';
				}
			} else {
				$result['error'] 	= TRUE;
				$result['message']	= 'User not found';
			}
			echo json_encode($result);
		}
	}

	public function do_logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}

/* End of file Auth.php */
/* Location: ./application/modules/auth/controllers/Auth.php */