<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Tambah Barang Keluar</h3>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
                <div class="card-body">
						<h4 class="card-title">Form Tambah Keranjang</h4>
						<p class="card-description">Silahkan isi sesuai petunjuk</p>
						<form action="<?=base_url('knn/uji_action')?>" method="post">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="pt-3">No Faktur</label>
									<input type="number" name="kill" class="form-control" placeholder="Masukkan jumlah kill">
									<label class="pt-3">Nama Barang</label>
									<input type="number" name="assist" class="form-control" placeholder="Masukkan jumlah Assist">
								</div>
								<div class="form-group col-md-6">
                                    <label class="pt-3">Jumlah</label>
									<input type="number" name="kill" class="form-control" placeholder="Masukkan jumlah kill">
									<input type="submit" class="btn btn-primary form-control" style="margin-top: 37px;" value="Tambahkan">
								</div>
							</div>
						</form>
					</div>
					<div class="card-body">
						<h4 class="card-title">Keranjang</h4>
						</p>
						<div class="table-responsive">
							<table class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Faktur</th>
										<th>Pelanggan</th>
										<th>Tgl</th>
										<th>Total</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($suplier as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->kode?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->alamat?></td>
										<td><?=$data->email?></td>
										<td align="center">
											<a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('suplier/delete/'.$data->id)?>">
												<button class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></button>
											</a>
										</td>
									</tr>
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
