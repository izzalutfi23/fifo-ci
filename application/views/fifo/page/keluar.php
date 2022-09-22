<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Barang Keluar</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<a href="<?=base_url('keluar/pdf')?>" target="_blank" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text mr-2">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</a>
                <button data-toggle="modal" data-target=".tambah" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
					<i class="mdi mdi-plus-circle"></i>Barang Keluar
				</button>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade tambah" tabindex="-1" role="dialog"
			aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-fade">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Pilih Toko Terlebih Dahulu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?=base_url('keluar/before')?>" method="post">
							<div class="row">
								<div class="form-group col-md-12">
									<label class="pt-3">Pilih Toko</label>
									<select class="form-control" required="required" name="toko_id">
										<option value="">Pilih Toko</option>
										<?php 
											foreach($toko as $dtoko){
										?>
										<option value="<?=$dtoko->id?>"><?=$dtoko->nama?></option>
										<?php } ?>
									</select>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Ok</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Barang Keluar</h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Faktur</th>
										<th>Toko</th>
										<th>Tgl</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($penjualan as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->faktur?></td>
										<td><?=$data->nama?></td>
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
										<td align="center">
											<?php 
												if($data->jml > 0){
											?>
											<button class="btn btn-danger btn-sm">
											Belum Konfirmasi</button>
											<?php }else{ ?>
											<button onclick="return confirm('Barang keluar akan dikonfirmasi')" href="<?= base_url('keluar/confirm/'.$data->id) ?>" class="btn btn-success btn-sm">
											<i class="mdi mdi-check"></i>Konfirmasi</a>
											<?php } ?>
											<a href="<?=base_url('keluar/detail/'.$data->id)?>">
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
