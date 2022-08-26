<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends CI_Controller {

    function __construct(){
		parent::__construct();
        $this->load->model('Mproduk');
        $this->load->model('Msuplier');
        $this->load->model('Mkeluar');
        $this->load->model('Mpembelian');
        $this->load->model('Mtoko');
		if($this->session->userdata('user')){
            
        }
        else{
            redirect('login');
        }
	}

    public function index(){
		$penjualan = $this->Mkeluar->getPenjualan()->result();
        foreach($penjualan as $j){
            $detail = $this->db->get_where('detail_keluar', ['penjualan_id' => $j->id, 'status' => '0'])->result();
            $j->jml = count($detail);
        }
        $toko = $this->Mtoko->getToko()->result();
        $data = [
            'title' => 'Barang Keluar | Fifo',
			'penjualan' => $penjualan,
            'toko' => $toko
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/keluar');
        $this->load->view('fifo/_footer');
    }

    public function before(){
        $id = $this->input->post('toko_id');
        redirect('keluar/create/'.$id);
    }

    public function create($id){
        $this->db->select('RIGHT(faktur,5) as kode', FALSE);
        $this->db->order_by('kode','DESC');    
        $this->db->limit(1);
        $query = $this->db->get('penjualan');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $faktur = "OUT-".$batas;
		$cart = $this->Mkeluar->getCart()->result();
        $produk = $this->Mproduk->getProduk()->result();
        $toko = $this->db->get_where('toko', ['id' => $id])->row();
        $data = [
            'title' => 'Tambah Barang Keluar | Fifo',
			'cart' => $cart,
            'faktur' => $faktur,
            'produk' => $produk,
            'toko' => $toko
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/create');
        $this->load->view('fifo/_footer');
    }

    public function detail($id){
        $detail = $this->Mkeluar->getByPenjualan($id)->result();
        $penjualan = $this->db->get_where('penjualan', ['id' => $id])->row();
        $data = [
            'title' => 'Detail Barang Keluar | Fifo',
            'detail' => $detail,
            'penjualan' => $penjualan
        ];
        $this->load->view('fifo/_header', $data);
        $this->load->view('fifo/page/detail');
        $this->load->view('fifo/_footer');
    }

    public function storeCart(){
        $data = [
            'barang_id' => $this->input->post('barang_id'),
            'jumlah' => $this->input->post('jumlah')
        ];
        $cek = count($this->Mkeluar->getByProduk($this->input->post('barang_id'))->result());
        if($cek < 1){
            $this->Mkeluar->storeCart($data);
        }
        else{
            $id_barang = $this->input->post('barang_id');
            $barang = $this->Mkeluar->getCartById($id_barang)->row();
            $payload = [
                'jumlah' => $barang->jumlah + $this->input->post('jumlah')
            ];
            $this->Mkeluar->updateCart($payload, $id_barang);
        }
		redirect('keluar/create/'.$this->input->post('toko_id'));
    }

    public function delcart($id, $toko){
        $this->Mkeluar->delCart($id);
        redirect('keluar/create/'.$toko);
    }

    public function store(){
        $keluar = [
            'toko_id' => $this->input->post('toko_id'),
            'faktur' => $this->input->post('faktur'),
            'tgl' => $this->input->post('tanggal'),
            'total' => $this->input->post('total')
        ];
		$this->Mkeluar->storePenjualan($keluar);
        $last_id = $this->db->insert_id();
        $carts = $this->Mkeluar->getCart()->result();
        foreach($carts as $cart){
            $produk = $this->Mproduk->getById($cart->barang_id)->row();
            $data = [
                'penjualan_id' => $last_id,
                'barang_id' => $cart->barang_id,
                'jumlah' => $cart->jumlah,
                'status' => '0'
            ];
            $this->Mkeluar->storeDetail($data);
        }
        $this->Mkeluar->deleteCart();
		redirect('keluar');
    }

    public function update(){
        $data = [
            'jumlah' => $this->input->post('jumlah')
        ];
        $this->Mkeluar->updateDetail($data, $this->input->post('id'));
        redirect('keluar/detail/'.$this->input->post('penjualan_id'));
    }

    public function confirm($id){
        $carts = $this->db->get_where('detail_keluar', ['penjualan_id' => $id])->result();
        $penjualan = $this->db->get_where('penjualan', ['id' => $id])->row();
        foreach($carts as $cart){
            $produk = $this->Mproduk->getById($cart->barang_id)->row();
            if($produk->stok >= $cart->jumlah){
                if($produk->qty < $cart->jumlah){
                    // Create Trx
                    $arr = [
                        'jumlah' => $produk->qty,
                        'harga' => $produk->harga
                    ];
                    $saldo = [
                        'jumlah' => $produk->qty,
                        'harga' => $produk->harga
                    ];
                    $input = [
                        'barang_id' => $cart->barang_id,
                        'penjualan_id' => $id,
                        'faktur' => $penjualan->faktur,
                        'tgl' => $penjualan->tgl,
                        'status' => '0',
                        'hpp' => json_encode($arr),
                        'saldo' => json_encode($saldo),
                        'type' => 'penjualan'
                    ];
                    $this->Mpembelian->store($input);
    
                    // Update Produk
                    $sisa = $cart->jumlah - $produk->qty;
                    $trx = $this->Mkeluar->getTrx($cart->barang_id)->result();
                    $temp = json_decode($trx[1]->pembelian);
                    $data = [
                        'stok' => $produk->stok - $produk->qty,
                        'trx_id' => $trx[1]->id,
                        'qty' => $temp->jumlah - $sisa,
                        'harga' => $temp->harga
                    ];
                    $this->Mproduk->update($data, $cart->barang_id);
                    $this->Mkeluar->updateTrx(['terpakai' => '1'], $trx[0]->id);
    
                    // Kedua
                    $produk2 = $this->Mproduk->getById($cart->barang_id)->row();
                    $arr2 = [
                        'jumlah' => $sisa,
                        'harga' => $produk2->harga
                    ];
                    $saldo2 = [
                        'jumlah' => $sisa,
                        'harga' => $produk2->harga
                    ];
                    $input2 = [
                        'barang_id' => $cart->barang_id,
                        'penjualan_id' => $id,
                        'faktur' => $penjualan->faktur,
                        'tgl' => $penjualan->tgl,
                        'status' => '0',
                        'hpp' => json_encode($arr2),
                        'saldo' => json_encode($saldo2),
                        'type' => 'penjualan'
                    ];
    
                    $newStok = $produk2->stok - $sisa;
                    $dataProduk = [
                        'stok' => $newStok
                    ];
                    $this->Mproduk->update($dataProduk, $cart->barang_id);
    
                    $this->Mpembelian->store($input2);
                }
                elseif($produk->qty == $cart->jumlah){
                    // Create Trx
                    $arr = [
                        'jumlah' => $produk->qty,
                        'harga' => $produk->harga
                    ];
                    $saldo = [
                        'jumlah' => $produk->qty,
                        'harga' => $produk->harga
                    ];
                    $input = [
                        'barang_id' => $cart->barang_id,
                        'penjualan_id' => $id,
                        'faktur' => $penjualan->faktur,
                        'tgl' => $penjualan->tgl,
                        'status' => '0',
                        'hpp' => json_encode($arr),
                        'saldo' => json_encode($saldo),
                        'type' => 'penjualan'
                    ];
                    $this->Mpembelian->store($input);
    
                    // Update Produk
                    $sisa = $cart->jumlah - $produk->qty;
                    $trx = $this->Mkeluar->getTrx($cart->barang_id)->result();
                    $temp = json_decode($trx[1]->pembelian);
                    // echo $trx[0]->id;
                    $data = [
                        'stok' => $produk->stok - $produk->qty,
                        'trx_id' => $trx[1]->id,
                        'qty' => $temp->jumlah - $sisa,
                        'harga' => $temp->harga
                    ];
                    $this->Mproduk->update($data, $cart->barang_id);
                    $this->Mkeluar->updateTrx(['terpakai' => '1'], $trx[0]->id);
                }
                else{
                    $arr = [
                        'jumlah' => $cart->jumlah,
                        'harga' => $produk->harga
                    ];
                    $saldo = [
                        'jumlah' => $cart->jumlah,
                        'harga' => $produk->harga
                    ];
                    $input = [
                        'barang_id' => $cart->barang_id,
                        'penjualan_id' => $id,
                        'faktur' => $penjualan->faktur,
                        'tgl' => $penjualan->tgl,
                        'status' => '0',
                        'hpp' => json_encode($arr),
                        'saldo' => json_encode($saldo),
                        'type' => 'penjualan'
                    ];
    
                    $newStok = $produk->stok - $cart->jumlah;
                    $dataProduk = [
                        'stok' => $newStok,
                        'qty' => $produk->qty - $cart->jumlah
                    ];
                    $this->Mproduk->update($dataProduk, $cart->barang_id);
    
                    $this->Mpembelian->store($input);
                }
            }
            $data = [
                'status' => '1'
            ];
            $this->Mkeluar->updateDetail($data, $cart->id);
        }
        redirect('keluar/detail/'.$id);
    }

    public function delete($id){
		$this->Msuplier->delete($id);
		redirect('suplier');
	}

    public function pdf(){
        $penjualan = $this->Mkeluar->getPenjualan()->result();
        foreach($penjualan as $data){
            $detail = $this->Mkeluar->getByPenjualan($data->id)->result();
            $jml = 0;
            foreach($detail as $beli){
                $beli->hpp = json_decode($beli->hpp);
                $jml += 1;
            }
            $data->detail = $detail;
            $data->jml = $jml;
        }
        $datas = [
            'penjualan' => $penjualan
        ];
        $this->load->library('pdf');
        $file_pdf = 'laporan-barang-keluar.pdf';
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('fifo/page/pdf/keluar',$datas, true);
        $this->pdf->generate($html, $file_pdf,$paper,$orientation);
    }
}