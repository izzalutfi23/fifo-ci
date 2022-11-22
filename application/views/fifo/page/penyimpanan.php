<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Penyimpanan Barang</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<a href="<?= base_url('penyimpanan/pdf') ?>" target="_blank" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text mr-2">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</a>
				<?php 
					if($this->session->userdata('data')->role == 'super-admin' || $this->session->userdata('data')->role == 'operator'){
				?>
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal"
					data-target=".tambah">
					<i class="mdi mdi-plus-circle"></i>Penyimpanan</button>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Penyimpanan Barang</h4>
						</p>
						<div class="table-responsive">
							<!-- Modal -->
							<div class="modal fade tambah" tabindex="-1" role="dialog"
								aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-fade">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Tambah Penyimpanan Barang</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('penyimpanan/store')?>" method="post">
												<div class="row">
													<div class="form-group col-md-12">
                                                        <label class="pt-3">Tgl Penyimapanan</label>
														<input required="required" type="date" name="tgl" value="<?=date('Y-m-d')?>" class="form-control">
														<label class="pt-3">Line</label>
														<select name="line" required="required" class="form-control">
                                                            <option value="">Pilih Line</option>
                                                            <?php
                                                                $line = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
                                                                for($i=0; $i<15; $i++){
                                                            ?>
                                                            <option value="<?=$line[$i]?>"><?=$line[$i]?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="pt-3">Rak</label>
														<select name="rak" required="required" class="form-control">
                                                            <option value="">Pilih Rak</option>
                                                            <?php 
                                                                for($x=1; $x<=30; $x++){
                                                            ?>
                                                            <option value="<?=$x?>"><?=$x?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="pt-3">Kode Barang</label>
                                                        <input type="text" name="barcode" class="form-control" placeholder="Masukkan Kode Barang" id="barcode" onchange="autofill()">
                                                        <label class="pt-3">Nama Barang</label>
                                                        <input type="hidden" name="barang_id" id="barang_id">
                                                        <input type="text" name="nama" class="form-control" required="required" id="nama" readonly="readonly">
                                                        <label class="pt-3">Retur Hari</label>
                                                        <input type="text" name="retur" class="form-control" required="required" id="retur" readonly="readonly">
                                                        <label class="pt-3">C2</label>
                                                        <input type="text" name="c2" class="form-control" required="required" id="c2" readonly="readonly">
														<label class="pt-3">Jumlah (Qty)</label>
														<input required="required" type="number" name="jumlah" class="form-control" placeholder="Masukkan email">
                                                        <label class="pt-3">Expire Date</label>
														<input required="required" type="date" name="expire_date" class="form-control" placeholder="Masukkan tgl expired">
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
										<th>Nama Barang</th>
										<th>Kode Barang</th>
                                        <th>Rak</th>
                                        <th>Line</th>
                                        <th>C2</th>
                                        <th>Retur Hari</th>
                                        <th>Tanggal Penyimpanan</th>
										<th>Jumlah</th>
                                        <th>Expire Date</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($simpan as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->kode_barang?></td>
                                        <td><?=$data->rak?></td>
                                        <td><?=$data->line?></td>
                                        <td><?=$data->c2?></td>
                                        <td><?=$data->retur?></td>
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
										<td><?=$data->jumlah?></td>
                                        <td><?=date('d M Y', strtotime($data->expire_date))?></td>
										<td>
                                            <a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('penyimpanan/delete/'.$data->id)?>">
												<button class="btn btn-danger btn-sm">Hapus</button>
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
