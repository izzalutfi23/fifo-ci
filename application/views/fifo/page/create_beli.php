<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Tambah Barang Masuk</h3>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
                	<div class="card-body">
						<h4 class="card-title">Form Tambah Keranjang</h4>
						<p class="card-description">Silahkan isi sesuai petunjuk</p>
						<form action="<?=base_url('pembelian/storeCart')?>" method="post">
							<div class="row">
								<div class="form-group col-md-6">                                  
                                    <label class="pt-3">Barcode</label>
									<input type="text" name="barcode" class="form-control" required placeholder="Masukkan Barcode" id="barcode" onchange="autofill2(<?= $this->uri->segment(3) ?>)">
									<label class="pt-3">Nama Barang</label>
									<input type="hidden" name="barang_id" id="barang_id">
									<input type="text" name="nama" class="form-control" required="required" id="nama" readonly="readonly">
                                    <label class="pt-3">Retur Hari</label>
									<input type="text" name="retur" class="form-control" required="required" id="retur" readonly="readonly">
									<label class="pt-3">C2</label>
									<input type="text" name="c2" class="form-control" required="required" id="c2" readonly="readonly">
                                </div>
								<div class="form-group col-md-6">
                                    <label class="pt-3">No Faktur</label>
                                    <input type="hidden" name="sid" value="<?= $this->uri->segment(3) ?>">
									<input type="text" name="faktur" readonly value="<?=$faktur?>" class="form-control" placeholder="Masukkan jumlah kill">  
                                    <label class="pt-3">Suplier</label>
									<input type="text" name="sup" class="form-control" value="<?=$suplier->nama?>" readonly="readonly">
                                    <label class="pt-3">Jumlah</label>
									<input type="number" required name="jumlah" class="form-control" placeholder="Masukkan jumlah">
                                    <label class="pt-3">Harga Satuan</label>
									<input type="number" required name="harga" class="form-control" placeholder="Masukkan harga">
									<input type="submit" class="btn btn-primary form-control" style="margin-top: 37px;" value="Tambahkan Keranjang">
								</div>
							</div>
						</form>
					</div>
					<div class="card-body">
						<h4 class="card-title">Keranjang</h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Barang</th>
                                        <th>Barcode</th>
                                        <th>Kode Barang</th>
                                        <th>Retur</th>
                                        <th>C2</th>
										<th>Harga Satuan</th>
										<th>Jumlah (Crt)</th>
										<th>Subtotal</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1;
										$total = 0;
                                        foreach($cart as $data){
										$total += ($data->jumlah*$data->c2) * $data->harga;
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->nama?></td>
                                        <td><?=$data->barcode?></td>
                                        <td><?=$data->kode_barang?></td>
                                        <td><?=$data->retur?></td>
                                        <td><?=$data->c2?></td>
										<td>Rp <?=number_format($data->harga)?></td>
										<td><?=$data->jumlah*$data->c2?></td>
										<td>Rp <?=number_format(($data->jumlah*$data->c2) * $data->harga)?></td>
										<td align="center">
											<a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('pembelian/delcart/'.$data->barang_id.'/'.$this->uri->segment(3))?>">
												<button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="7">Total</td>
										<td colspan="2">Rp <?=number_format($total)?></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="card-body">
						<form action="<?=base_url('pembelian/storeBeli')?>" method="post">
							<div class="row">
							<div class="form-group col-md-6">
									
								</div>
								<div class="form-group col-md-6">
									<!-- <label class="pt-3">Tanggal</label> -->
									<input type="hidden" name="total" value="<?=$total?>">
									<input type="hidden" name="faktur" value="<?=$faktur?>">
                                    <input type="hidden" name="sid" value="<?= $this->uri->segment(3) ?>">
									<input type="hidden" name="tanggal" value="<?=date('Y-m-d')?>" required="required" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<input type="submit" class="btn btn-primary form-control" style="margin-top: 37px;" value="Simpan Barang Masuk">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->

	<!-- partial:partials/_footer.html -->
	<footer class="footer">
		<div class="d-sm-flex justify-content-center justify-content-sm-between">
			<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
			BENY ANGGRIAWAN 2022</span>
			<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
					href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a>
				from Bootstrapdash.com</span>
		</div>
	</footer>
	<!-- partial -->
</div>
<!-- main-panel ends -->
