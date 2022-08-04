<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">Data Barang Masuk</h3>
			<div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
			<a href="<?=base_url('pembelian/pdf')?>" target="_blank" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text mr-2">
					<i class="mdi mdi-plus-circle"></i>Cetak PDF</a>
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
											<h5 class="modal-title" id="exampleModalLongTitle">Tambah Barang Masuk</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?=base_url('pembelian/store')?>" method="post">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="pt-3">Faktur</label>
														<input required="required" type="text" name="faktur" value="<?=$faktur?>" readonly="readonly" class="form-control">
														<label class="pt-3">Produk</label>
														<select name="barang_id" class="form-control" required="required">
                                                            <option value="">Pilih Produk</option>
                                                            <?php
                                                                foreach($produk as $prod){
                                                            ?>
                                                            <option value="<?=$prod->id?>"><?=$prod->nama?></option>
                                                            <?php } ?>
                                                        </select>
														<label class="pt-3">Suplier</label>
														<select name="suplier_id" class="form-control" required="required">
                                                            <option value="">Pilih Suplier</option>
                                                            <?php
                                                                foreach($suplier as $sup){
                                                            ?>
                                                            <option value="<?=$sup->id?>"><?=$sup->nama?></option>
                                                            <?php } ?>
                                                        </select>
														<label class="pt-3">Tgl</label>
														<input required="required" type="date" name="tgl" value="<?=date('Y-m-d')?>" class="form-control">
														<label class="pt-3">Jumlah (Qty)</label>
														<input required="required" type="number" name="jumlah" class="form-control" placeholder="Masukkan email">
                                                        <label class="pt-3">Harga Per Unit (Satuan)</label>
														<input required="required" type="harga" name="harga" class="form-control" placeholder="Masukkan harga">
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
										<th>Faktur Pembelian</th>
										<th>Nama Barang</th>
										<th>Suplier</th>
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
                                        foreach($pembelian as $data){
                                    ?>
									<tr>
										<td><?=$no++?></td>
										<td><?=$data->faktur?></td>
										<td><?=$data->barang?></td>
										<td><?=$data->suplier?></td>
										<td><?=date('d M Y', strtotime($data->tgl))?></td>
										<td><?=$data->c2?></td>
										<td><?=$data->pembelian->jumlah?></td>
										<td><?=number_format($data->pembelian->harga)?></td>
                                        <td><?=number_format($data->pembelian->harga*$data->pembelian->jumlah)?></td>
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
