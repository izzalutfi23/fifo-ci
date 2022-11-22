<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data User</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
				<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal"
					data-target=".tambah">
					<i class="mdi mdi-plus-circle"></i>User</button>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data User</h4>
						</p>
						<div class="table-responsive">
							<!-- Modal -->
							<div class="modal fade tambah" tabindex="-1" role="dialog"
								aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-fade">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Tambah Suplier</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('user/store')?>" method="post">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="pt-3">Nama</label>
														<input required="required" type="text" name="nama" class="form-control" placeholder="Masukkan Nama">
														<label class="pt-3">Username</label>
														<input required="required" type="text" name="username" class="form-control" placeholder="Masukkan username">
														<label class="pt-3">Password</label>
														<input required="required" type="text" name="password" class="form-control" placeholder="Masukkan password">
														<label class="pt-3">Role</label>
														<select name="role" class="form-control">
															<option value="super-admin">Super Admin</option>
															<option value="admin">Admin</option>
															<option value="operator">Operator</option>
															<option value="manager">Manager</option>
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
										<th>Nama</th>
										<th>username</th>
										<th>Role</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($user as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->username?></td>
										<td><?=$data->role?></td>
										<td>
											<button class="btn btn-primary btn-sm" data-toggle="modal"
												data-target=".edit<?=$data->id?>">Edit</button>
                                            <?php 
                                                if($this->session->userdata('user') != $data->username){
                                            ?>
											<a onclick="return confirm('Data akan dihapus!')"
												href="<?=base_url('user/delete/'.$data->id)?>">
												<button class="btn btn-danger btn-sm">Hapus</button>
											</a>
                                            <?php } ?>
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
													<form action="<?=base_url('user/update')?>" method="post">
													<div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label class="pt-3">Nama</label>
                                                            <input type="hidden" name="id" value="<?=$data->id?>">
                                                            <input required="required" type="text" name="nama" value="<?=$data->nama?>" class="form-control" placeholder="Masukkan Nama">
                                                            <label class="pt-3">Username</label>
                                                            <input required="required" type="text" name="username" value="<?=$data->username?>" class="form-control" placeholder="Masukkan username">
                                                            <label class="pt-3">Password</label>
                                                            <input type="text" name="password" class="form-control" placeholder="Masukkan password (opsional)">
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
