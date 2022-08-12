<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Produk</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<a href="<?=base_url('produk/pdf')?>" target="_blank" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text mr-2">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</a>
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal"
					data-target=".tambah">
					<i class="mdi mdi-plus-circle"></i>Data Produk</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Produk</h4>
						</p>
						<div class="table-responsive">
							<!-- Modal -->
							<div class="modal fade tambah" tabindex="-1" role="dialog"
								aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-fade">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('produk/store')?>" method="post">
												<div class="row">
													<div class="form-group col-md-6">
														<label class="pt-3">Suplier</label>
														<select name="suplier_id" class="form-control" required="required">
															<option value="">Pilih Suplier</option>
															<?php 
																foreach($suplier as $sup){
															?>
															<option value="<?=$sup->id?>"><?=$sup->nama?></option>
															<?php } ?>
														</select>
														<label class="pt-3">Kode Barang</label>
														<input required="required" type="text" name="kode_barang" class="form-control" placeholder="Masukkan kode barang">
														<label class="pt-3">Barcode</label>
														<input required="required" type="text" name="barcode" class="form-control" placeholder="Masukkan barcode">
														<label class="pt-3">Nama Barang</label>
														<input required="required" type="text" name="nama" class="form-control" placeholder="Masukkan nama barang">
														<label class="pt-3">C2</label>
														<input required="required" type="text" name="c2" class="form-control" placeholder="Masukkan C2">
													</div>
													<div class="form-group col-md-6">
														<label class="pt-3">Stok</label>
														<input required="required" type="number" name="stok" class="form-control" placeholder="Masukkan stok">
														<label class="pt-3">Umur Barang</label>
														<input required="required" type="text" name="umur" class="form-control" placeholder="Masukkan umur barang">
														<label class="pt-3">Retur</label>
														<input required="required" type="text" name="retur" class="form-control" placeholder="Masukkan retur">
														<label class="pt-3">Harga Barang</label>
														<input required="required" type="number" name="harga" class="form-control" placeholder="Masukkan harga barang (Rp)">
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Simpan</button>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal End -->
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Barang</th>
										<th>Suplier</th>
										<th>Barcode</th>
										<th>Nama</th>
										<th>C2</th>
										<th>Stok</th>
										<th>Umur</th>
										<th>retur</th>
										<th>harga</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($produk as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->kode_barang?></td>
										<td><?=$data->suplier?></td>
										<td><?=$data->barcode?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->c2?></td>
										<td><?=$data->stok?></td>
										<td><?=$data->umur?></td>
										<td><?=$data->retur?></td>
										<td>Rp <?=number_format($data->harga)?></td>
										<td>
											<button class="btn btn-primary btn-sm" data-toggle="modal"
												data-target=".edit<?=$data->id?>">Edit</button>
											<a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('produk/delete/'.$data->id)?>">
												<button class="btn btn-danger btn-sm">Hapus</button>
											</a>
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade edit<?=$data->id?>" tabindex="-1" role="dialog"
										aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-fade">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?=base_url('produk/update')?>" method="post">
													<div class="row">
														<div class="form-group col-md-6">
															<label class="pt-3">Kode Barang</label>
															<input type="hidden" name="id" value="<?=$data->id?>">
															<input required="required" type="text" name="kode_barang" value="<?=$data->kode_barang?>" class="form-control" placeholder="Masukkan kode barang">
															<label class="pt-3">Barcode</label>
															<input required="required" type="text" name="barcode" value="<?=$data->barcode?>" class="form-control" placeholder="Masukkan barcode">
															<label class="pt-3">Nama Barang</label>
															<input required="required" type="text" name="nama" value="<?=$data->nama?>" class="form-control" placeholder="Masukkan nama barang">
															<label class="pt-3">C2</label>
															<input required="required" type="text" name="c2" value="<?=$data->c2?>" class="form-control" placeholder="Masukkan C2">
														</div>
														<div class="form-group col-md-6">
															<label class="pt-3">Stok</label>
															<input required="required" type="number" name="stok" value="<?=$data->stok?>" class="form-control" placeholder="Masukkan stok">
															<label class="pt-3">Umur Barang</label>
															<input required="required" type="text" name="umur" value="<?=$data->umur?>" class="form-control" placeholder="Masukkan umur barang">
															<label class="pt-3">Retur</label>
															<input required="required" type="text" name="retur" value="<?=$data->retur?>" class="form-control" placeholder="Masukkan retur">
															<label class="pt-3">Harga Barang</label>
															<input required="required" type="number" name="harga" value="<?=$data->harga?>" class="form-control" placeholder="Masukkan harga barang (Rp)">
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Ubah</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal End -->
									<?php } ?>
							</table>
						</div>
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
