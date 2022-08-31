<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Barang Masuk</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
			<button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text" data-toggle="modal"
				data-target=".tambah">
				<i class="mdi mdi-plus-circle"></i>Barang Masuk</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Barang Masuk</h4>
						</p>
						<div class="table-responsive">
							<!-- Modal -->
							<div class="modal fade tambah" tabindex="-1" role="dialog"
								aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-fade">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Pilih Suplier Terlebih Dahulu</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('pembelian/before')?>" method="post">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="pt-3">Suplier</label>
														<select name="suplier_id" class="form-control" required="required">
                                                            <option value="">Pilih Suplier</option>
                                                            <?php
                                                                foreach($suplier as $sup){
                                                            ?>
                                                            <option value="<?=$sup->id?>"><?=$sup->nama?></option>
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
							<!-- Modal End -->
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Faktur Pembelian</th>
                                        <th>Tanggal</th>
										<th>Suplier</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                        $no=1; 
                                        foreach($pembelian as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->faktur?></td>
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
										<td><?=$data->nama?></td>
                                        <td align="center">
										<?php
											if($data->status == '1'){
										?>
										<button class="btn btn-success btn-sm">
										<i class="mdi mdi-check"></i></button>
										<?php }else{ ?>
										<button class="btn btn-danger btn-sm">
										Belum Konfirmasi</button>
										<?php } ?>
										<a href="<?=base_url('pembelian/detail/'.$data->id)?>">
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
