<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Detail Barang Keluar</h3>
		</div>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Detail Barang Keluar</h4>
						</p>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Faktur</th>
										<th>Nama Barang</th>
                                        <th>Tanggal</th>
										<th>Jumlah</th>
										<th>C2</th>
										<th>Harga Satuan</th>
                                        <th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($detail as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->faktur?></td>
										<td><?=$data->barang?></td>
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
                                        <td><?=$data->hpp->jumlah?></td>
										<td><?=$data->c2?></td>
										<td><?=number_format($data->hpp->harga)?></td>
                                        <td><?=number_format($data->hpp->harga*$data->hpp->jumlah)?></td>
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
