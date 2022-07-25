<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Barang Keluar</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <a href="<?=base_url('keluar/create')?>" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
					<i class="mdi mdi-plus-circle"></i>Barang Keluar
                </a>
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
										<th>Tgl</th>
										<th>Total</th>
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
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
										<td>Rp <?=number_format($data->total)?></td>
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
