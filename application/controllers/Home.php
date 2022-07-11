<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
	}

	public function index()
	{
		$train = $this->Mhome->get_train()->result();
		// print_r($train);
		$data = [
			'train' => $train
		];
		$this->load->view('_header', $data);
		$this->load->view('home');
		$this->load->view('_footer');
	}

	public function train_store(){
		$input = $this->input->post(null, true);
		$this->Mhome->train_insert($input);
		redirect('home');
	}

	public function train_update(){
		$id = $this->input->post('id');
		$data = [
			'umur' => $this->input->post('umur'),
			'penerima_bantuan' => $this->input->post('penerima_bantuan'),
			'sts_kawin' => $this->input->post('sts_kawin'),
			'penghasilan' => $this->input->post('penghasilan'),
			'sts_rumah' => $this->input->post('sts_rumah'),
			'kondisi_rumah' => $this->input->post('kondisi_rumah'),
			'pekerjaan' => $this->input->post('pekerjaan'),
			'label' => $this->input->post('label')
		];
		$this->Mhome->train_update($data, $id);
		redirect('home');
	}

	public function uji(){
		$this->load->view('_header');
		$this->load->view('uji');
		$this->load->view('_footer');
	}

	public function uji_action(){
		$input = $this->input->post(null, true);
		$train = $this->Mhome->get_train()->result();
		$true = $this->Mhome->get_train('1')->result();
		$false = $this->Mhome->get_train('0')->result();
		
		$all = count($train);
		$numtrue = count($true);
		$numfalse = count($false);

		// Probabilitas Memenuhi
		$yesumur = 0;
		$yespenerima_bantuan = 0;
		$yessts_kawin = 0;
		$yespenghasilan = 0;
		$yessts_rumah = 0;
		$yeskondisi_rumah = 0;
		$yespekerjaan = 0;
		$yeslabel = 0;		
		foreach($true as $yes){
			if($yes->umur==$input['umur']){
				$yesumur++;
			}
			if($yes->penerima_bantuan==$input['penerima_bantuan']){
				$yespenerima_bantuan++;
			}
			if($yes->sts_kawin==$input['sts_kawin']){
				$yessts_kawin++;
			}
			if($yes->penghasilan==$input['penghasilan']){
				$yespenghasilan++;
			}
			if($yes->sts_rumah==$input['sts_rumah']){
				$yessts_rumah++;
			}
			if($yes->kondisi_rumah==$input['kondisi_rumah']){
				$yeskondisi_rumah++;
			}
			if($yes->pekerjaan==$input['pekerjaan']){
				$yespekerjaan++;
			}
		}
		$hityesumur = $yesumur/$numtrue;
		$hityespenerima_bantuan = $yespenerima_bantuan/$numtrue;
		$hityessts_kawin = $yessts_kawin/$numtrue;
		$hityespenghasilan = $yespenghasilan/$numtrue;
		$hityessts_rumah = $yessts_rumah/$numtrue;
		$hityeskondisi_rumah = $yeskondisi_rumah/$numtrue;
		$hityespekerjaan = $yespekerjaan/$numtrue;
		$hityeslabel = $numtrue/$all;
		$hasil_yes = $hityesumur*$hityespenerima_bantuan*$hityessts_kawin*$hityespenghasilan*$hityessts_rumah*$hityeskondisi_rumah*$hityespekerjaan*$hityeslabel;
		// echo $hasil_yes;

		// Probabilitas Tidak Memenuhi
		$noumur = 0;
		$nopenerima_bantuan = 0;
		$nosts_kawin = 0;
		$nopenghasilan = 0;
		$nosts_rumah = 0;
		$nokondisi_rumah = 0;
		$nopekerjaan = 0;
		$nolabel = 0;		
		foreach($false as $no){
			if($no->umur==$input['umur']){
				$noumur++;
			}
			if($no->penerima_bantuan==$input['penerima_bantuan']){
				$nopenerima_bantuan++;
			}
			if($no->sts_kawin==$input['sts_kawin']){
				$nosts_kawin++;
			}
			if($no->penghasilan==$input['penghasilan']){
				$nopenghasilan++;
			}
			if($no->sts_rumah==$input['sts_rumah']){
				$nosts_rumah++;
			}
			if($no->kondisi_rumah==$input['kondisi_rumah']){
				$nokondisi_rumah++;
			}
			if($no->pekerjaan==$input['pekerjaan']){
				$nopekerjaan++;
			}
		}
		$hitnoumur = $noumur/$numfalse;
		$hitnopenerima_bantuan = $nopenerima_bantuan/$numfalse;
		$hitnosts_kawin = $nosts_kawin/$numfalse;
		$hitnopenghasilan = $nopenghasilan/$numfalse;
		$hitnosts_rumah = $nosts_rumah/$numfalse;
		$hitnokondisi_rumah = $nokondisi_rumah/$numfalse;
		$hitnopekerjaan = $nopekerjaan/$numfalse;
		$hitnolabel = $numfalse/$all;
		$hasil_no = $hitnoumur*$hitnopenerima_bantuan*$hitnosts_kawin*$hitnopenghasilan*$hitnosts_rumah*$hitnokondisi_rumah*$hitnopekerjaan*$hitnolabel;
		
		// Hasil
		if($hasil_yes>$hasil_no){
			$hasil_final = $hasil_yes;
		}
		else{
			$hasil_final = $hasil_no;
		}

		$arrhasil = [
			'memenuhi' => $hasil_yes,
			'tidakmemenuhi' => $hasil_no,
			'hasil' => $hasil_final
		];
		print_r($arrhasil);
	}
}