<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Training</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal"
					data-target=".tambah">
					<i class="mdi mdi-plus-circle"></i>Data Training</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Training</h4>
						</p>
						<div class="table-responsive">
							<!-- Modal -->
							<div class="modal fade tambah" tabindex="-1" role="dialog"
								aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('knn/train_store')?>" method="post">
												<div class="row">
													<div class="form-group col-md-6">
														<label class="pt-3">Kill</label>
														<input type="number" name="kill" class="form-control" placeholder="Masukkan jumlah kill">
														<label class="pt-3">Assist</label>
														<input type="number" name="assist" class="form-control" placeholder="Masukkan jumlah Assist">
														<label class="pt-3">K/D</label>
														<input type="text" name="kd" class="form-control" placeholder="Masukkan jumlah K/D">
													</div>
													<div class="form-group col-md-6">
														<label class="pt-3">Senjata</label>
														<select name="senjata" class="form-control">
															<option value="M416">M416</option>
															<option value="AKM">AKM</option>
															<option value="UMP">UMP</option>
															<option value="SCARL">SCARL</option>
														</select>
														<label class="pt-3">Score</label>
														<input type="number" name="score" class="form-control" placeholder="Masukkan jumlah score">
														<label class="pt-3">Result</label>
														<select name="result" class="form-control">
															<option value="VICTORY">VICTORY</option>
															<option value="DEFEAT">DEFEAT</option>
														</select>
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
										<th>Kill</th>
										<th>Assist</th>
										<th>K/D</th>
										<th>Senjata</th>
										<th>Score</th>
										<th>Result</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($train as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->kill?></td>
										<td><?=$data->assist?></td>
										<td><?=$data->kd?></td>
										<td><?=$data->senjata?></td>
										<td><?=$data->score?></td>
										<td><?=$data->result?></td>
										<td>
											<button class="btn btn-primary btn-sm" data-toggle="modal"
												data-target=".edit<?=$data->id?>">Edit</button>
											<a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('knn/del_train/'.$data->id)?>">
												<button class="btn btn-danger btn-sm">Hapus</button>
											</a>
										</td>
									</tr>
									<!-- Modal -->
									<div class="modal fade edit<?=$data->id?>" tabindex="-1" role="dialog"
										aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?=base_url('knn/train_update')?>" method="post">
													<div class="row">
														<div class="form-group col-md-6">
															<label class="pt-3">Kill</label>
															<input type="hidden" name="id" value="<?=$data->id?>">
															<input type="number" name="kill" class="form-control" value="<?=$data->kill?>">
															<label class="pt-3">Assist</label>
															<input type="number" name="assist" class="form-control" value="<?=$data->assist?>">
															<label class="pt-3">K/D</label>
															<input type="text" name="kd" class="form-control" value="<?=$data->kd?>">
														</div>
														<div class="form-group col-md-6">
															<label class="pt-3">Senjata</label>
															<select name="senjata" class="form-control">
																<option <?php $data->senjata == "M416" ? 'selected' : '' ?> value="M416">M416</option>
																<option <?php $data->senjata == "AKM" ? 'selected' : '' ?> value="AKM">AKM</option>
																<option <?php $data->senjata == "UMP" ? 'selected' : '' ?> value="UMP">UMP</option>
																<option <?php $data->senjata == "SCARL" ? 'selected' : '' ?> value="SCARL">SCARL</option>
															</select>
															<label class="pt-3">Score</label>
															<input type="number" name="score" class="form-control" value="<?=$data->score?>">
															<label class="pt-3">Result</label>
															<select name="result" class="form-control">
																<option <?php $data->senjata == "VICTORY" ? 'selected' : '' ?> value="VICTORY">VICTORY</option>
																<option <?php $data->senjata == "DEFEAT" ? 'selected' : '' ?> value="DEFEAT">DEFEAT</option>
															</select>
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
