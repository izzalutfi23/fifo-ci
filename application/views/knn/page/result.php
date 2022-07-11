<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Hasil Verifikasi</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
				<div class="card-body">
						<a href="<?=base_url('kades/result/1')?>"><button class="btn btn-success mb-3">Memenuhi Syarat</button></a>
						<a href="<?=base_url('kades/result/0')?>"><button class="btn btn-danger mb-3">Tidak Memenuhi Syarat</button></a>
						<h4 class="card-title">Hasil Verifikasi</h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>RT</th>
										<th>RW</th>
										<th>Verifikasi</th>
										<th width="12%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($result as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->nama?></td>
										<td><?=$data->alamat?></td>
										<td><?=$data->rt?></td>
										<td><?=$data->rw?></td>
										<td><?= ($data->label==1?'Memenuhi Syarat':'Tidak Memenuhi') ?></td>
										<td>
											<a href="<?=base_url('kades/detail/'.$data->id)?>">
												<button class="btn btn-success btn-sm">Lihat Hasil</button>
											</a>
											<a onclick="return confirm('Data akan dihapus!')" href="<?=base_url('kades/del_result/'.$data->id)?>">
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
