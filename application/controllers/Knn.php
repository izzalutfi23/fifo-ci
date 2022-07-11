<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Knn extends CI_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model('Mhome');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$train = $this->Mhome->get_train()->result();
        $data = [
            'title' => 'Home | KNN',
			'train' => count($train)
        ];
        $this->load->view('knn/_header', $data);
        $this->load->view('knn/page/home');
        $this->load->view('knn/_footer');
    }

    public function training(){
        $train = $this->Mhome->get_train()->result();
        $data = [
            'title' => 'Data Training | KNN',
            'train' => $train
        ];
        $this->load->view('knn/_header', $data);
        $this->load->view('knn/page/train');
        $this->load->view('knn/_footer');
    }

    public function train_store(){
		$input = $this->input->post(null, true);
		$this->Mhome->train_insert($input);
		redirect('knn/training');
	}

	public function train_update(){
		$id = $this->input->post('id');
		$data = [
			'kill' => $this->input->post('kill'),
			'assist' => $this->input->post('assist'),
			'kd' => $this->input->post('kd'),
			'senjata' => $this->input->post('senjata'),
			'score' => $this->input->post('score'),
			'result' => $this->input->post('result'),
		];
		$this->Mhome->train_update($data, $id);
		redirect('knn/training');
	}

	public function del_train($id){
		$this->Mhome->deltrain($id);
		redirect('knn/training');
	}

	public function del_result($id){
		$this->Mhome->delresult($id);
		redirect('knn/result');
	}

	public function uji(){
        $data = [
            'title' => 'Data Uji | KNN'
        ];
		$this->load->view('knn/_header', $data);
		$this->load->view('knn/page/uji');
		$this->load->view('knn/_footer');
	}

	public function uji_action(){
		$trains = $this->Mhome->get_train()->result();

		$senjata = [
			'M416' => '1',
			'AKM' => '2',
			'UMP' => '3',
			'SCARL' => '4'
		];

		$isi = [];
		$this->Mhome->delresult();
		foreach($trains as $train){
			$senjataku = $senjata[$this->input->post('senjata')];
			$senjatatrain = $senjata[$train->senjata];
			$hasil = sqrt(
				(pow($this->input->post('kill') - $train->kill,2)) +
				(pow($this->input->post('assist') - $train->assist,2)) +
				(pow($this->input->post('kd') - $train->kd,2)) +
				(pow($senjataku - $senjatatrain,2)) +
				(pow($this->input->post('score') - $train->score,2)) 
			);
			$array = [
				'amount' => $hasil,
				'result' => $train->result,
			];
			$this->Mhome->insertresult($array);			
		}

		$results = $this->Mhome->getResult($this->input->post('k'))->result();
		$victory = 0;
		$defeat = 0;
		foreach($results as $result){
			if($result->result == 'VICTORY'){
				$victory++;
			}
			else{
				$defeat++;
			}
		}
		// print_r(json_encode($result));
		if($victory > $defeat){
			$hasilAkhir = 'VICTORY';
		}
		else{
			$hasilAkhir = 'DEFEAT';
		}

		$data = [
            'title' => 'Hasil Uji | KNN',
			'hasil' => $hasilAkhir,
			'results' => $results,
			'input' => $this->input->post(null, true)
        ];

		$this->load->view('knn/_header', $data);
		$this->load->view('knn/page/hasil');
		$this->load->view('knn/_footer');
	}
}