<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_data extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global', 'global');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{

		if(isset($_GET['tahun'])){
			$tahun  = $_GET['tahun'];
			$sql 	= "SELECT a.*, b.nama_perusahaan FROM tb_data_keuangan a
						JOIN  tb_perusahaan b on b.id_perusahaan = a.id_perusahaan
						WHERE a.tahun = $tahun";			
			$data['list_data'] 	= $this->db->query($sql)->result_array();
		}else{
			// Distinct nama perusahaan
			$sql_d = "SELECT DISTINCT(b.nama_perusahaan) FROM tb_data_keuangan a,
						tb_perusahaan b WHERE a.id_perusahaan = b.id_perusahaan";
			$data['nama_perusahaan'] = $this->db->query($sql_d)->result_array();

			$sql 	= "SELECT a.*, b.nama_perusahaan FROM tb_data_keuangan a,
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
		}
		// dd($temp2);

		$this->slice->view('v_list_data', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('id_perusahaan', 'id_perusahaan', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['list_perusahaan'] 	= $this->global->get('tb_perusahaan')->result_array();
			$this->slice->view('f_list_data', $data);
		} else {
			$id_perusahaan 		= $this->input->post('id_perusahaan');
			$tahun		 		= $this->input->post('tahun');
			$fileName 			= $_FILES['file']['name'];
			  $config['upload_path'] = './assets/upload/'; 
			  $config['file_name'] = $fileName;
			  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
			  $config['max_size'] = 10000;

			  $this->load->library('upload', $config);
			  $this->upload->initialize($config); 
			  
			  if (!$this->upload->do_upload('file')) {
				   $error = array('error' => $this->upload->display_errors());
			  } else {
			   $media = $this->upload->data();
			   $inputFileName = './assets/upload/'.$media['file_name'];
			   try {
			    $inputFileType = IOFactory::identify($inputFileName);
			    $objReader = IOFactory::createReader($inputFileType);
			    $objPHPExcel = $objReader->load($inputFileName);
			   } catch(Exception $e) {
			    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			   }

			   $sheet = $objPHPExcel->getSheet(0);
			   $highestRow = $sheet->getHighestRow();
			   $highestColumn = $sheet->getHighestColumn();
			   $cek = $this->db->query("SELECT * FROM tb_data_keuangan WHERE id_perusahaan = $id_perusahaan AND tahun = $tahun")->row_array();
				if(!empty($cek)){
					$result['error']	= FALSE;
					$result['type']		= 'Failed';
					$result['message']	= 'Data exist!';
				}else{
				   for ($row = 1; $row <= $highestRow; $row++){  
				     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
						$data = [
							'id_perusahaan'			=> $id_perusahaan,
							'tahun' 				=> $tahun,
							'laba_bersih' 			=> $rowData[0][0],
							'jumlah_saham' 			=> $rowData[0][1],
							'dividen_tunai' 		=> $rowData[0][2],
							'jumlah_modal' 			=> $rowData[0][3]
						];			   
					$this->global->create('tb_data_keuangan', $data);
				  	}
					$result['error']	= FALSE;
					$result['type']		= 'success';
					$result['message']	= 'Success Added!';
				}
		        echo json_encode($result);	
			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules('id_perusahaan', 'id_perusahaan', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$id 	= $this->uri->segment(3);
			$tahun 	= $this->uri->segment(4);
			$data['list_data'] 	= $this->db->get_where('tb_data_keuangan', array('id_perusahaan'=>$id, 'tahun'=>$tahun))->row_array();
			$data['all_perusahaan'] 	= $this->global->get('tb_perusahaan')->result_array();
			$data['update_perusahaan'] 	= $this->db->query("SELECT * FROM tb_data_keuangan WHERE id_perusahaan= $id AND tahun = $tahun")->row_array();
			$this->slice->view('f_list_data', $data);	
		} else {
			$id_perusahaan 		= $this->input->post('id_perusahaan');
			$tahun		 		= $this->input->post('tahun');
			$laba 			 	= $this->input->post('laba');
			$saham 				= $this->input->post('saham');
			$dividen 	 		= $this->input->post('dividen');
			$modal 				= $this->input->post('modal');

			$data = [
				'id_perusahaan'			=> $id_perusahaan,
				'tahun' 				=> $tahun,
				'laba_bersih' 			=> $laba,
				'jumlah_saham' 			=> $saham,
				'dividen_tunai' 		=> $dividen,
				'jumlah_modal' 			=> $modal
			];

			$this->global->update('tb_data_keuangan', $data, array('id_perusahaan' => $this->input->post('id_perusahaan')));
        	$this->db->trans_commit();
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Data has been updated!';
			echo json_encode($result);
		}	
		
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if($id != NULL || $id != '') {
			$result['error']	= FALSE;
			$result['type']		= 'success';
			$result['message']	= 'Data has been deleted!';
			$this->global->delete('tb_data_keuangan', array('id' => $id));
		} else {
			$result['error']	= TRUE;
			$result['type']		= 'error';
			$result['message']	= 'Data fail to delete!';	
		}
		echo json_encode($result);
	}

	function hitung(){
		$lb15 		= $_GET['lb15'];
	    $lb16 		= $_GET['lb16'];
	    $lb17 		= $_GET['lb17'];
	    $modal15 	= $_GET['modal15'];
	    $modal16 	= $_GET['modal16'];
	    $modal17 	= $_GET['modal17'];
	    $saham15 	= $_GET['saham15'];
	    $saham16 	= $_GET['saham16'];
	    $saham17 	= $_GET['saham17'];
	    $div15 		= $_GET['div15'];
	    $div16 		= $_GET['div16'];
	    $div17 		= $_GET['div17'];

	    $P0 = 2; // Po dapat darimana ?

	    // Hitung DPS = dividen tunai/jumlah saham
	    $dps_15 = $div15/$saham15;
	    $dps_16 = $div16/$saham16;
	    $dps_17 = $div17/$saham17;

	    // Hitung EPS = laba_bersih/jumlah saham
	    $eps_15 = $lb15/$saham15;
	    $eps_16 = $lb16/$saham16;
	    $eps_17 = $lb17/$saham17;

	    // Hitung ROE = laba bersih/ jumlah modal * 100%
	    $roe_15 = ($lb15/$modal15);

	    // Hitung DPR = DPS /EPS
	    $dpr_15 = ($dps_15/$eps_15);
	    $dpr_16 = ($dps_16/$eps_16);
	    $dpr_17 = ($dps_17/$eps_17);
	    // DPR rata-rata
	    $dpr_rata2 = ( $dpr_15 + $dpr_16 + $dpr_17 ) / 3;
		// Hitung g
	    $g = $roe_15*(1-$dpr_15);

	    // Hitung epst 
	    $eps_t = $eps_15 *(1+ $g);

	    // Hitung dpst 
	    $dps_t = $eps_t * $dpr_rata2;

	    // Hitung k
	    $k = ( $dps_t/$P0  ) * $g;
	    // dd($k);
	    
	    // Hitung estimasi PER
	    $PER_t = ($dps_t / $eps_t ) / ($k - $g );
	    // dd($estimasi_PER);

	    //Hitung Instrinsik
	    $intrinsik_saham = $eps_t * $PER_t;
	    // dd($intrinsik_saham );


	}

}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/Users.php */